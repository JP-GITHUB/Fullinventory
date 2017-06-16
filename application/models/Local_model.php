<?php

class Local_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        // Your own constructor code
    }

    public function get_empresa_del_local($local = null){

        $this->db->select('empresa_id');
        $this->db->from('local');
        $this->db->where('codigo', $local);

        return $this->db->get()->row();
    }

    public function get_otros_locales($local = null){
        $sql = "
            SELECT 
                codigo, nombre, direccion, empresa_id, estado_id
            FROM
                local
            WHERE
                empresa_id = (
                    SELECT empresa_id FROM local WHERE codigo = ?
                );";
        
        return $this->db->query($sql, array($local))->result_array();
    }     
    
    public function get_local($codigo = null){
        $this->db->select('codigo, nombre, direccion, comuna_id, empresa_id, estado_id');
        $this->db->from('local');
        $this->db->where('codigo', $codigo);
        return $this->db->get()->row_array();
    }

    public function save($codigo, $nombre, $direccion, $comuna, $empresa){

        $this->db->insert('local', array(
            'codigo' => $codigo, 
            'nombre' => $nombre, 
            'direccion' => $direccion, 
            'comuna_id' => $comuna,
            'estado_id' => 1,
            'empresa_id' => $empresa
        ));

        return ($this->db->affected_rows() > 0) ? true : false;
    }

    public function get_local_filter($codigo = null){

        $this->db->like('codigo', $codigo);       

        return $this->db->get('local')->result_array();
    }

    public function save_change_local($codigo, $nombre, $direccion, $comuna)
    {
        $data = array(            
            'nombre' => $nombre            
            ,'direccion' => $direccion
            ,'comuna_id' => $comuna
        );

        $this->db->where('codigo', $codigo);

        $this->db->update('local', $data);

        if($this->db->affected_rows() > 0)
        {         
            return true; 
        }
    }

    public function change_state($codigo, $id_estado)
    {
        $data = array(            
            'estado_id' => ($id_estado == '1' ? '2' : '1')
        );

        $this->db->where('codigo', $codigo);

        $this->db->update('local', $data);

        if($this->db->affected_rows() > 0)
        {         
            return true; 
        }
    }

}