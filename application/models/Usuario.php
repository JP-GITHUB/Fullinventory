<?php

class Usuario extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        // Your own constructor code
    }

    public function verificar_existencia($email){
        $this->db->select('email, clave');
        $this->db->from('usuario');        
        $this->db->where('email', $email);
        return $this->db->get()->row_array();
    }
}