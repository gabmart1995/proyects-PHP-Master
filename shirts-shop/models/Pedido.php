<?php

class Pedido {
    private $id;
    private $usuario_id;
    private $provincia;
    private $localidad;
    private $direccion;
    private $coste;
    private $estado;
    private $fecha;
    private $hora;
    private $db;

    function __construct() {
        $this->db = Database::connect();
    }
	
	function getHora() {
		return $this->hora;
	}
	
	function setHora($hora) {
		$this->hora = $hora;
	}

	function getFecha() {
		return $this->fecha;
	}
	
	function setFecha($fecha) {
		$this->fecha = $fecha;
	}

	function getEstado() {
		return $this->estado;
	}
	
	function setEstado($estado){
		$this->estado = $this->db->real_escape_string($estado);
	}

	function getCoste() {
		return $this->coste;
	}
	
	function setCoste($coste) {
		$this->coste = (float) $coste;
	}

	function getLocalidad() {
		return $this->localidad;
	}
	
	
	function setLocalidad($localidad) {
		$this->localidad = $this->db->real_escape_string($localidad);
	}

	function getProvincia() {
		return $this->provincia;
	}
	
	
	function setProvincia($provincia) {
		$this->provincia = $this->db->real_escape_string($provincia);
	}

	function getUsuarioId() {
		return $this->usuario_id;
	}
	
	function setUsuarioId($usuario_id) {
		$this->usuario_id = (int) $usuario_id;
	}

	function getId() {
		return $this->id;
	}
	
	function setId($id) {
		$this->id = (int) $id;
	}

	
	function getDireccion() {
		return $this->direccion;
	}
	
	function setDireccion($direccion) {
		$this->direccion = $this->db->real_escape_string($direccion);
	}

    function getAll() {
        return $this->db->query("SELECT * FROM pedidos ORDER BY id DESC;");
    }

    function getOne() {
        $order = $this->db->query("SELECT * FROM pedidos WHERE id = {$this->getId()}");
        return $order->fetch_object();
    }


    function getOneByUser() {
        $sql = "SELECT p.id, p.coste FROM pedidos p
            WHERE p.usuario_id = {$this->getUsuarioId()}
            ORDER BY id DESC LIMIT 1;
        ";
        $order = $this->db->query($sql);
        
        return $order->fetch_object();
    }

    function getAllByUser() {
        $sql = "SELECT p.* FROM pedidos p
            WHERE p.usuario_id = {$this->getUsuarioId()}
            ORDER BY id DESC;
        ";
        
        return $this->db->query($sql);
    }


    function getProductByOrder($id) {
        
        // subconsultas SQL
        /*$sqlSubconsult = "SELECT producto_id FROM lineas_pedidos WHERE pedido_id = {$id}";
        $sql = "SELECT * FROM productos WHERE id IN ({$sqlSubconsult});";*/
    
        $sql = "SELECT pr.*, lp.unidades FROM productos pr
            INNER JOIN lineas_pedidos lp ON lp.producto_id = pr.id
            WHERE lp.pedido_id = {$id};
        ";

        $products = $this->db->query($sql);    
        return $products;
    }

    function save() {
        $sql = "INSERT INTO pedidos VALUES(
            NULL,
            {$this->getUsuarioId()},
            '{$this->getProvincia()}',
            '{$this->getLocalidad()}',
            '{$this->getDireccion()}',
            {$this->getCoste()},
            '{$this->getEstado()}',
            CURDATE(),
            CURTIME()
        );";

        $save = $this->db->query($sql);
        $result = false;

        if ($save) {
            $result = true;
        }

        return $result;
    }

    function saveLine() {
        $sql = "SELECT LAST_INSERT_ID() AS 'pedido';";
        $order = $this->db->query($sql);
        $order = $order->fetch_object();
        
        $result = false;

        // consulta
        $sql = "INSERT lineas_pedidos VALUES ";
        $limit = (count($_SESSION['cart']) - 1);

        foreach ($_SESSION['cart'] as $index => $item) {
            $product = $item['producto'];
            $sql .= "(
                NULL,
                {$order->pedido},
                {$product->id},
                {$_SESSION['cart'][$index]['unidades']}
            )";
            
            if ($index != $limit) {
                $sql .= ", ";
            }
        }

        $sql .= ";";
        $save = $this->db->query($sql);

        if ($save) {
            $result = true;
        }

        return $result;
    }

    function updateOne() {
        $sql = "UPDATE pedidos SET estado = '{$this->getEstado()}' WHERE id = {$this->getId()}";
        $update = $this->db->query($sql);
        $result = false;

        if ($update) {
            $result = true;
        }

        return $result;
    }
}