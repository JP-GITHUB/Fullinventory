<?php

class Producto_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        // Your own constructor code
    }

    public function get_producto($codigo = null){
        $this->db->select('codigo, departamento_codigo, proveedor_codigo, estado_id');
        $this->db->from('producto');
        $this->db->where('codigo', $codigo);
        return $this->db->get()->row_array();
    }

    public function get_productos($local = null, $filtro = ""){
	    $sql = "
            SELECT 
                P.codigo,
                P.nombre,
                SUBSTRING(CONCAT(P.descripcion, SPACE(100)),
                    1,
                    100) AS descripcion,
                P.imagen,
                P.cantidad_minima,
                P.departamento_codigo,
                P.proveedor_codigo,
                P.estado_id,
                D.local_codigo
            FROM
                producto AS P
            JOIN
                departamento as D
                ON (P.departamento_codigo = D.codigo)
            WHERE P.nombre like '%".$this->db->escape_like_str($filtro)."%'
                AND D.local_codigo = ?";
        
        return $this->db->query($sql, array($local))->result_array();
    }

    public function save($data){
        $this->db->insert('producto', $data);
    }

    public function save_producto($codigo, $nombre, $descripcion, $cantidad, $codproveedor, $departamento, $imagen){

        $this->db->insert('producto', array(
            'codigo' => $codigo, 
            'nombre' => $nombre, 
            'descripcion' => $descripcion, 
            'imagen' => $imagen,
            'cantidad_minima' => $cantidad,
            'departamento_codigo' => $departamento,
            'proveedor_codigo' => $codproveedor,
            'estado_id' => 1
        ));

        return ($this->db->affected_rows() > 0) ? true : false;
    }
    
}