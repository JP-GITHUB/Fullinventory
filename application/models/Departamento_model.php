<?php

class Departamento_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        // Your own constructor code
    }
    
    public function get_departamentos_by_local($local = null){
        $this->db->select('*');
        $this->db->from('departamento');
        $this->db->where('local_codigo', $local);
        return $this->db->get()->result_array();
    }

    public function save_departamento($local,$codigo, $nombre){

        $this->db->insert('departamento', array(
            'codigo' => $codigo, 
            'nombre' => $nombre, 
            'local_codigo' => $local
        ));

        return ($this->db->affected_rows() > 0) ? true : false;
    }

   public function change_state($codigo, $id_estado)
    {
        $data = array(            
            'id_estado' => ($id_estado == '1' ? '2' : '1')
        );

        $this->db->where('codigo', $codigo);

        $this->db->update('departamento', $data);

        if($this->db->affected_rows() > 0)
        {         
            return true; 
        }
    }

    public function get_departamento($codigo = null){
        
        $this->db->where('codigo', $codigo);
        
        return $this->db->get('departamento')->row_array();
    }

    public function save_change_departamento($codigo, $nombre)
    {
        $data = array(            
            'nombre' => $nombre                        
        );

        $this->db->where('codigo', $codigo);

        $this->db->update('departamento', $data);

        if($this->db->affected_rows() > 0)
        {         
            return true; 
        }
    }

   public function count_departamentos($local = null){
	    $sql = "SELECT count(1) AS total_departamento
                FROM departamento where local_codigo = ?";        
        return $this->db->query($sql, array($local))->row();
    }
}