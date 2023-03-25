<?php

require_once 'models/Producto.php';

class ProductoController {
    function index() {

        $products = (new Producto())->getRamdom();
        
        require_once 'views/producto/destacados.php';
    }

    function gestion() {
        Utils::isAdmin();

        $products = (new Producto())->getAll();

        require_once 'views/producto/gestion.php';
    }

    function create() {
        Utils::isAdmin();

        require_once 'views/producto/create.php';
    }

    function save() {
        Utils::isAdmin();

        if (!isset($_POST)) {
            $_SESSION['register-product'] = 'failed';
            header('Location:'.base_url.'Producto/create');            
            return;
        }
        
        $errors = Validator::validateProduct($_POST);

        if (count($errors) > 0) {
            $_SESSION['errors_product'] = $errors;
            header('Location:'.base_url.'Producto/create');
            return;
        }

        $product = new Producto();
        $product->setNombre($_POST['name']);
        $product->setDescripcion($_POST['description']);
        $product->setPrecio($_POST['price']);
        $product->setStock($_POST['stock']);
        $product->setCategoriaId($_POST['category_id']);

        // guardar la imagen
        if (isset($_FILES['image'])) {
            $file = $_FILES['image'];
            $fileName = $file['name'];
            $mimeType = $file['type'];

            if (preg_match("/image\/jpg|image\/jpeg|image\/png|image\/gif/", $mimeType)) {
                
                if (!is_dir('uploads/images')) {
                    mkdir('uploads/images', 0777, true);
                }

                // mueve el archivo
                move_uploaded_file($file['tmp_name'], 'uploads/images/'.$fileName);
                
                $product->setImagen($fileName);
            }
        }

        if (!$product->save()) {
            $_SESSION['register-product'] = 'failed';
            header('Location:'.base_url.'Producto/create');            
            return;
        }

        $_SESSION['register-product'] = 'completed';
        header('Location:'.base_url.'Producto/gestion');            
    }

    function edit() {
        Utils::isAdmin();

        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            header('Location:'.base_url.'Producto/gestion');
            return;
        }

        $edit = true;
        $product = new Producto();
        $product->setId($_GET['id']);

        $productDB = $product->getOne();

        require_once 'views/producto/create.php';
    }

    function update() {
        Utils::isAdmin();

        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            header('Location:'.base_url.'Producto/gestion');
            return;
        }

        if (!isset($_POST)) {
            $_SESSION['update-product'] = 'failed';
            header('Location:'.base_url.'Producto/edit&id='.$_GET['id']);            
            return;
        }
        
        $errors = Validator::validateProduct($_POST);

        if (count($errors) > 0) {
            $_SESSION['errors_product'] = $errors;
            header('Location:'.base_url.'Producto/edit&id='.$_GET['id']);
            return;
        }

        $product = new Producto();
        $product->setId($_GET['id']);
        $product->setNombre($_POST['name']);
        $product->setDescripcion($_POST['description']);
        $product->setPrecio($_POST['price']);
        $product->setStock($_POST['stock']);
        $product->setCategoriaId($_POST['category_id']);

        // guardar la imagen
        if (isset($_FILES['image'])) {
            $file = $_FILES['image'];
            $fileName = $file['name'];
            $mimeType = $file['type'];

            if (preg_match("/image\/jpg|image\/jpeg|image\/png|image\/gif/", $mimeType)) {
                
                if (!is_dir('uploads/images')) {
                    mkdir('uploads/images', 0777, true);
                }

                // mueve el archivo
                move_uploaded_file($file['tmp_name'], 'uploads/images/'.$fileName);
                
                $product->setImagen($fileName);
            }
        }

        if (!$product->update()) {
            $_SESSION['update-product'] = 'failed';
            header('Location:'.base_url.'Producto/edit&id='.$_GET['id']);          
            return;
        }

        $_SESSION['update-product'] = 'completed';
        header('Location:'.base_url.'Producto/gestion');
    }

    function delete() {
        Utils::isAdmin();

        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            header('Location:'.base_url.'Producto/gestion');
            return;
        }

        $product = new Producto();
        $product->setId($_GET['id']);

        if (!$product->delete()) {
            $_SESSION['delete-product'] = 'failed';
            header('Location:'.base_url.'Producto/gestion');
            return;
        }

        $_SESSION['delete-product'] = 'completed';
        header('Location:'.base_url.'Producto/gestion');
    }

    function watch() {
        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            require 'views/producto/watch.php';
            return;
        }

        $productModel = new Producto();
        $productModel->setId($_GET['id']);

        $product = $productModel->getOne();

        require 'views/producto/watch.php';
    }
}