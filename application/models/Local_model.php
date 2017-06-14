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
        return $this->db->get()->row_array();
    }

    public function get_otros_locales($local = null){
        $sql = "
            SELECT 
                codigo, nombre, direccion, empresa_id
            FROM
                local
            WHERE
                empresa_id = (
                    SELECT empresa_id FROM local WHERE codigo = ?
                );";
        
        return $this->db->query($sql, array($local))->result_array();
    }
    
    public function get_local($codigo = null){
        $this->db->select('codigo, nombre, direccion, empresa_id, estado_id');
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
            'empresa_id' => 5
        ));

        return ($this->db->affected_rows() > 0) ? true : false;
    }
}