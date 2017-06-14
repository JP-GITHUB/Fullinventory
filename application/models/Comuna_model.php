<?php

class Comuna_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        // Your own constructor code
    }

    public function get_lista(){
        $this->db->select('*');
        $this->db->from('comuna');
        return $this->db->get()->result_array();
    }    
}