<?php

class Categoria {
    private $id;
    private $nombre;
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

	function getNombre() {
		return $this->nombre;
	}
	
	function setNombre($nombre) {
		$this->nombre = $this->db->real_escape_string($nombre);
	}

    function getAll() {
        return $this->db->query("SELECT * FROM categorias ORDER BY id DESC;");
    }

    function getOne() {
        $category = $this->db->query("SELECT * FROM categorias WHERE id = {$this->getId()};");
        return $category->fetch_object();
    }

    function save() {
        $sql = "INSERT INTO categorias VALUES (NULL, '{$this->getNombre()}');";
        $save = $this->db->query($sql);
        
        $result = false;

        if ($save) {
            $result = true;
        }

        return $result;
    }
}