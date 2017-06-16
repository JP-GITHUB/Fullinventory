<?php

class Usuario_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        // Your own constructor code
    }

    public function verificar_existencia($email){
        $this->db->select('rut, nombre, apellido_paterno, email, clave, rol_id, estado_id, local_codigo');
        $this->db->from('usuario');        
        $this->db->where('email', $email);
        return $this->db->get()->row_array();
    }

   public function count_usuarios($local = null){
	    $sql = "SELECT count(1) AS total_usuarios 
                FROM usuario where local_codigo = ?;";
        
        return $this->db->query($sql, array($local))->row();
    }
}