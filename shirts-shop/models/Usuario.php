<?php

class Usuario {
    private $id;
    private $nombre;
    private $apellidos;
    private $email;
    private $password;
    private $imagen;
    private $rol;

    private $db;

    function __construct() {
        $this->db = Database::connect();
    }

    function getId() {
        return $this->id;
    }

    function setId($id) {
        $this->id = $id;
    }

    function getNombre() {
        return $this->nombre;
    }

    function setNombre($nombre) {
        $this->nombre = $this->db->real_escape_string($nombre);
    }

    function getApellidos() {
        return $this->apellidos;
    }

    function setApellidos($apellidos) {
        $this->apellidos = $this->db->real_escape_string($apellidos);   
    }

    function getEmail() {
        return $this->email;
    }

    function setEmail($email) {
        $this->email = $this->db->real_escape_string($email);
    }

	function getPassword() {
		return $this->password;
	}
	
	function setPassword($password, $isPropertyEncrypted = true) {

        if ($isPropertyEncrypted) {
            $this->password = password_hash( 
                $this->db->real_escape_string($password), 
                PASSWORD_BCRYPT, 
                ['cost' => 4] 
            );

            return;
        }

        $this->password = $this->db->real_escape_string($password);
	}

    function getRol() {
		return $this->rol;
	}
	
    function setRol($rol) {
		$this->rol = $this->db->real_escape_string($rol);
	}
	
	function getImagen() {
		return $this->imagen;
	}
	
	function setImagen($imagen) {
		$this->imagen = $imagen;
	}

    /**
     * Guarda el registro de la BD
     */
    function save() {
        $sql = "INSERT INTO usuarios VALUES (
            NULL, 
            '{$this->getNombre()}', 
            '{$this->getApellidos()}', 
            '{$this->getEmail()}', 
            '{$this->getPassword()}',
            'user',
            NULL
        );
        ";

        $save = $this->db->query($sql);
        $result = false;

        if ($save) {
            $result = true;
        }

        return $result;
    }

    function login() {
        $sql = "SELECT * from usuarios WHERE email = '{$this->getEmail()}'";
        $login = $this->db->query($sql);
        
        if ( $login && $login->num_rows == 1 ) {
            $usuario = $login->fetch_object();
            
            if (password_verify($this->getPassword(), $usuario->password)) {
                return $usuario;
            }
        }

        return false;
    }
}
