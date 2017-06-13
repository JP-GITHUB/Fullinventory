<?php

class Inventario_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        // Your own constructor code
    }

    public function listar(){
        $this->db->select('*');
        $this->db->from('producto');
        return $this->db->get()->result_array();
    }
}