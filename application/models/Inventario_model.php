<?php

class Inventario_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        // Your own constructor code
    }

    public function listar_inventario($local){
		$sql = "
            SELECT 
                p.codigo,
                i.departamento_codigo,
                p.nombre,
                p.descripcion,
                i.operacion_id,
                i.cantidad,
                DATE_FORMAT(MAX(i.fecha_movimiento), '%d-%m-%Y') AS fecha_movimiento,
                d.local_codigo
            FROM
                producto AS p
                LEFT JOIN
                inventario AS i ON (p.codigo = i.producto_codigo
                    AND p.departamento_codigo = i.departamento_codigo)
                JOIN
                departamento AS d
                    ON (i.departamento_codigo = d.codigo)
            WHERE
                i.operacion_id = 4
                AND d.local_codigo = ?";
        
        return $this->db->query($sql, array($local))->result_array();
    }

    public function historial_producto($codigo, $departamento, $local){
        $sql = "
            SELECT 
                P.codigo,
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
                departamento AS d ON (i.departamento_codigo = d.codigo)
                    JOIN
                operacion AS O ON (I.operacion_id = O.id)
            WHERE
                P.codigo = ?
                    AND P.departamento_codigo = ?
                    AND d.local_codigo = ?
            ORDER BY YEAR(fecha_movimiento) DESC , MONTH(fecha_movimiento) DESC , DAY(fecha_movimiento) DESC;";
        
        return $this->db->query($sql, array($codigo, $departamento, $local))->result_array();
    }

    public function obtener_movimientos($producto, $departamento, $operacion, $local){
        $sql = "
            SELECT 
                MONTH(i.fecha_movimiento) AS mes,
                YEAR(i.fecha_movimiento) AS ano,
                SUM(i.cantidad) AS total
            FROM
                inventario AS i
            JOIN
                departamento AS d
                ON (i.departamento_codigo = d.codigo)
            WHERE
                i.producto_codigo = ?
                    AND i.departamento_codigo = ?
                    AND i.operacion_id = ?
                    AND d.local_codigo = ?
                    AND YEAR(i.fecha_movimiento) = YEAR(now())
            GROUP BY YEAR(i.fecha_movimiento) , MONTH(i.fecha_movimiento)
            ORDER BY YEAR(i.fecha_movimiento) , MONTH(i.fecha_movimiento);
        ";

        return $this->db->query($sql, array($producto, $departamento, $operacion, $local))->result_array();
    }

    public function calculo_cantidad_actual($producto, $local){
        $sql = "
            SELECT 
                *
            FROM
                inventario
            WHERE
                producto_codigo = ?
                    AND id >= (SELECT 
                        MAX(id) AS id
                    FROM
                        inventario
                    WHERE
                        producto_codigo = ?
                            AND operacion_id = 4)
                    AND departamento_codigo IN (SELECT 
                        codigo
                    FROM
                        departamento
                    WHERE
                        local_codigo = ? AND id_estado = 1)
            ORDER BY fecha_movimiento ASC;";

        $historico = $this->db->query($sql, array($producto, $producto, $local))->result_array();
        $cantidad_inventario = 0;

        foreach ($historico as $key => $value) {
            switch ($value['operacion_id']) {
                case '1':
                    $cantidad_inventario += $value['cantidad'];
                    break;
                case '2':
                    $cantidad_inventario -= $value['cantidad'];
                    break;
                case '3':
                    $cantidad_inventario -= $value['cantidad'];
                    break;
                case '4':
                    $cantidad_inventario = $value['cantidad'];
                    break;
                default:
                    break;
            }
        }

        return $cantidad_inventario;
    }
}