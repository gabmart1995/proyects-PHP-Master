<?php

require_once 'models/Categoria.php';
require_once 'models/Producto.php';

class CategoriaController {
    function index() {
        Utils::isAdmin();

        $categories = (new Categoria())->getAll();
    
        require_once 'views/categoria/index.php';
    }

    function create() {
        Utils::isAdmin();
        
        require_once 'views/categoria/create.php';
    }

    function save() {
        Utils::isAdmin();

        if ( !isset($_POST) ) {
            $_SESSION['register-category'] = 'failed';
            header('Location:'.base_url.'Categoria/create');            
            return;
        }

        // validacion de datos
        $errors = [];
        
        if ( !isset($_POST['name']) || empty($_POST['name']) ) {
            $errors['name'] = 'El nombre no es valido';
        }

        if (count($errors) > 0) {
            $_SESSION['errors_category'] = $errors;
            header('Location:'.base_url.'Categoria/create');
            return;
        }

        $category = new Categoria();
        $category->setNombre($_POST['name']);
        
        if (!$category->save()) {
            $_SESSION['register'] = 'failed';
            header('Location:'.base_url.'Categoria/create');
            return;
        }

        $_SESSION['register'] = 'completed';
        header('Location:'.base_url.'Categoria/index');
    }

    function watch() {
        if (!isset($_GET['id']) && !is_numeric($_GET['id'])) {
            require_once 'views/categoria/watch.php';
            return;
        }

        // get category
        $categoryModel = new Categoria();
        $categoryModel->setId($_GET['id']);
        $category = $categoryModel->getOne();

        // get products
        $productModel = new Producto();
        $productModel->setCategoriaId($_GET['id']);

        $products = $productModel->getAllByCategory();

        require_once 'views/categoria/watch.php';
    }
}