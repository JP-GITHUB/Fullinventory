<?php

class Proveedor_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        // Your own constructor code
    }

    public function get_lista(){
        $this->db->select('*');
        $this->db->from('proveedor');
        return $this->db->get()->result_array();
    }

    public function  save_change_proveedor($codigo, $nombre, $telefono, $direccion, $comuna)
    {
        $data = array(            
            'nombre' => $nombre            
            ,'numero_telefonico' => $telefono
            ,'direccion' => $direccion
            ,'comuna_id' => $comuna
        );

        $this->db->where('codigo', $codigo);

        $this->db->update('proveedor', $data);

        if($this->db->affected_rows() > 0)
        {         
            return true; 
        }
    }
    public function change_state($codigo, $id_estado)
    {
        $data = array(            
            'id_estado' => ($id_estado == '1' ? '2' : '1')
        );

        $this->db->where('codigo', $codigo);

        $this->db->update('proveedor', $data);

        if($this->db->affected_rows() > 0)
        {         
            return true; 
        }
    }

    public function save_proveedor($codigo, $nombre, $telefono, $direccion, $comuna)
    {
        $data = array(
            'codigo' => $codigo
            ,'nombre' => $nombre            
            ,'numero_telefonico' => $telefono
            ,'direccion' => $direccion
            ,'comuna_id' => $comuna
        );

        $this->db->insert('proveedor', $data);

        if($this->db->affected_rows() > 0)
        {         
            return true; 
        }
    }


    public function existe_proveedor($codigo){

        $query = $this->db->get_where('proveedor', array('codigo' => $codigo));

        return $query->num_rows() > 0;
    }

    
    public function get_proveedor($codigo = null){

        $this->db->like('codigo', $codigo);       

        return $this->db->get('proveedor')->result_array();
    }
    

    public function get_productos($filtro = ""){
	    $sql = "
            SELECT  codigo, 
                    nombre, 
                    substring(concat(descripcion,SPACE(100)),1,100) as descripcion, 
                    imagen, 
                    cantidad_minima, 
                    departamento_codigo, 
                    proveedor_codigo, 
                    estado_id
			FROM producto 
            WHERE nombre like '%".$this->db->escape_like_str($filtro)."%'";
        
        return $this->db->query($sql)->result_array();
    }

    public function save($data){
        $this->db->insert('producto', $data);
    }

   public function count_proveedores($local = null){
	    $sql = "
            SELECT 
                count(1) as total_proveedores
            FROM
                (SELECT 
                    P.proveedor_codigo
                FROM
                    producto AS P
                JOIN departamento AS D ON (P.departamento_codigo = D.codigo)
                WHERE
                    D.local_codigo = ?
                GROUP BY P.proveedor_codigo) AS tmp_count";
        
        return $this->db->query($sql, array($local))->row();
    }
}