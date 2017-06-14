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