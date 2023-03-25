<?php

require_once 'models/Usuario.php';

class UsuarioController {
    function index() {
        echo "Controlador usuarios acción index";
    }

    function register() {
        require_once 'views/usuario/register.php';
    }

    function save() {

        if ( !isset($_POST) ) {
            $_SESSION['register'] = 'failed';
            header('Location:'.base_url.'Usuario/register');            
            return;
        }

        $errors = Validator::validateRegister($_POST);

        if (count($errors) > 0) {
            $_SESSION['errors_register'] = $errors;
            header('Location:'.base_url.'Usuario/register');
            return;
        }
        
        $usuario = new Usuario();
        $usuario->setNombre($_POST['name']);
        $usuario->setApellidos($_POST['surname']);
        $usuario->setEmail($_POST['email']);
        $usuario->setPassword($_POST['password']);

        if (!$usuario->save()) {
            $_SESSION['register'] = 'failed';
            header('Location:'.base_url.'Usuario/register');
            return;
        }

        $_SESSION['register'] = 'completed';
        header('Location:'.base_url.'Usuario/register');
    }

    function login() {

        if (!isset($_POST)) {
            header('Location:'.base_url);
            return;
        }

        $errors = Validator::validateLogin($_POST); 

        if (count($errors) > 0) {
            $_SESSION['errors_login'] = $errors;
            header('Location:'.base_url);
            return;
        }

        $usuario = new Usuario();
        $usuario->setEmail($_POST['email']);
        $usuario->setPassword($_POST['password'], false);
        $identity = $usuario->login();

        if (!$identity) {
            $_SESSION['errors_login']['login'] = 'Credenciales inválidas';
            header('Location:'.base_url);
            return;
        }

        $_SESSION['identity'] = $identity;
        
        if ($identity->rol == 'admin') {
            $_SESSION['admin'] = true;
        }

        header('Location:'.base_url);
    }

    function logout() {

        if (isset($_SESSION['identity'])) {
            unset($_SESSION['identity']);
        }

        if (isset($_SESSION['admin'])) {
            unset($_SESSION['admin']);
        }

        header('Location:'.base_url);
    }
}