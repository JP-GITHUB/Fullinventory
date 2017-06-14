<?php

class Inventario_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        // Your own constructor code
    }

    public function listar_inventario(){
		$sql = "
            SELECT
                p.codigo,
                i.departamento_codigo,
                p.nombre,
                p.descripcion,
                i.operacion_id,
                i.cantidad,
                DATE_FORMAT(MAX(i.fecha_movimiento), '%d-%m-%Y') AS fecha_movimiento
            FROM
                producto AS p
                    LEFT JOIN inventario AS i ON (p.codigo = i.producto_codigo
                        AND p.departamento_codigo = i.departamento_codigo)
            WHERE
                i.operacion_id = 4
            GROUP BY i.fecha_movimiento;";
        
        return $this->db->query($sql)->result_array();
    }

    public function historial_producto($codigo, $departamento){
        $sql = "
            SELECT
            	P.codigo,
            	P.nombre,
            	P.descripcion,
            	I.operacion_id,
            	O.descripcion,
            	DATE_FORMAT(I.fecha_movimiento, '%d-%m-%Y %h:%i:%s') AS fecha_movimiento,
            	I.cantidad
            FROM
            	producto AS P
            		LEFT JOIN
            	inventario AS I ON (P.codigo = I.producto_codigo
            		AND P.departamento_codigo = I.departamento_codigo)
            		JOIN
            	operacion AS O ON(I.operacion_id = O.id)
            WHERE P.codigo = ?
            AND P.departamento_codigo = ? 
            ORDER BY fecha_movimiento;";
        
        return $this->db->query($sql, array($codigo, $departamento))->result_array();
    }
}