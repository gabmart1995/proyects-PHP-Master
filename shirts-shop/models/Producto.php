<?php

class Producto {
    private $id;
    private $categoria_id;
    private $nombre;
    private $descripcion;
    private $precio;
    private $stock;
    private $oferta;
    private $fecha;
    private $imagen;
    private $db;

    function __construct() {
        $this->db = Database::connect();
    }

	function getId() {
		return $this->id;
	}
	

	function setId($id) {
		$this->id = (int) $id;
	}

	
	function getCategoriaId() {
		return $this->categoria_id;
	}
	
	function setCategoriaId($categoria_id) {
		// casting
		$this->categoria_id = (int) $this->db->real_escape_string($categoria_id);
	}

	
	function getNombre() {
		return $this->nombre;
	}
	
	function setNombre($nombre) {
		$this->nombre = $this->db->real_escape_string($nombre);
	}

	
	function getDescripcion() {
		return $this->descripcion;
	}
	
	function setDescripcion($descripcion) {
		$this->descripcion = $this->db->real_escape_string($descripcion);
	}

	
	function getPrecio() {
		return $this->precio;
	}
	
	function setPrecio($precio) {
		$this->precio = (float) $this->db->real_escape_string($precio);
	}

	
	function getStock() {
		return $this->stock;
	}
	
	
	function setStock($stock) {
		$this->stock = (int) $this->db->real_escape_string($stock);
	}

	
	function getOferta() {
		return $this->oferta;
	}
	
	function setOferta($oferta) {
		$this->oferta = $this->db->real_escape_string($oferta);
	}

	
	function getFecha() {
		return $this->fecha;
	}
	
	function setFecha($fecha) {
		$this->fecha = $this->db->real_escape_string($fecha);
	}

	
	function getImagen() {
		return $this->db->real_escape_string($this->imagen);
	}
	
	function setImagen($imagen) {
		$this->imagen = $imagen;
	}

    function getAll() {
        return $this->db->query("SELECT * FROM productos ORDER BY id DESC;");
    }

	function getAllByCategory() {
		$sql = "SELECT p.*, c.nombre AS 'category_name' FROM productos p
			INNER JOIN categorias c ON c.id = p.categoria_id
			WHERE p.categoria_id = {$this->getCategoriaId()}
			ORDER BY p.id DESC;
		";

		$products = $this->db->query($sql);
		return $products;
    }

	function getOne() {
		$product =$this->db->query("SELECT * FROM productos WHERE id = {$this->getId()}");
		return $product->fetch_object();
	}

	function getRamdom($limit = 6) {
		return $this->db->query("SELECT * FROM productos ORDER BY RAND() LIMIT {$limit}");
	}

	function save() {
		$sql = "INSERT INTO productos VALUES (
			NULL,
			{$this->getCategoriaId()},
			'{$this->getNombre()}',
			'{$this->getDescripcion()}',
			{$this->getPrecio()},
			{$this->getStock()},
			NULL,
			CURDATE(),
			'{$this->getImagen()}'
		);";

		$save = $this->db->query($sql);
		$result = false;

		if ($save) {
			$result = true;
		}

		return $result;
	}

	function update() {
		$sql = "UPDATE productos SET
			categoria_id={$this->getCategoriaId()},
			nombre='{$this->getNombre()}',
			descripcion='{$this->getDescripcion()}',
			precio={$this->getPrecio()},
			stock={$this->getStock()}";

		// comprobamos si llega la imagen
		if ($this->getImagen() != null) {
			$sql .= ", imagen='{$this->getImagen()}' ";
		}

		$sql .= " WHERE id = {$this->getId()};";

		$update = $this->db->query($sql);
		$result = false;

		if ($update) {
			$result = true;
		}

		return $result;
	}

	function delete() {
		$sql = "DELETE FROM productos WHERE id = {$this->getId()}";
		$delete = $this->db->query($sql);

		$result = false;

		if ($delete) {
			$result = true;
		}

		return $result;
	}
}