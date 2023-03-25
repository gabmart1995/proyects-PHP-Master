<?php 

class Validator {
    static function validateLogin($postLogin) {
        // validacion de errores
        $errors = [];

        if ( 
            !isset($postLogin['email']) || 
            empty($postLogin['email']) || 
            !filter_var($postLogin['email'], FILTER_VALIDATE_EMAIL) 
        ) {
            $errors['email'] = 'El correo no es valido';
        }


        if ( 
            !isset($postLogin['password']) || 
            empty($postLogin['password']) 
        ) {
            $errors['password'] = 'El password no es valido';
        }

        return $errors;
    }

    static function validateRegister($postRegister) {
        // validacion de datos
        $errors = [];
        
        if (
            !isset($postRegister['name']) || 
            empty($postRegister['name']) || 
            is_numeric($postRegister['name']) || 
            preg_match('/[0-9]/', $postRegister['name'])
        ) {
            $errors['name'] = 'El nombre no es valido';
        }

        if (
            !isset($postRegister['surname']) || 
            empty($postRegister['surname']) || 
            is_numeric($postRegister['surname']) ||
            preg_match('/[0-9]/', $postRegister['surname'])
        ) {
            $errors['surname'] = 'El apellido no es valido';
        }

        if ( 
            !isset($postRegister['email']) || 
            empty($postRegister['email']) || 
            !filter_var($postRegister['email'], FILTER_VALIDATE_EMAIL) 
        ) {
            $errors['email'] = 'El correo no es valido';
        }


        if ( 
            !isset($postRegister['password']) || 
            empty($postRegister['password']) 
        ) {
            $errors['password'] = 'El password no es valido';
        }

        return $errors;
    }

    static function validateProduct($postProduct) {
        // validacion de datos
        $errors = [];
        
        if (
            !isset($postProduct['name']) || 
            empty($postProduct['name']) || 
            is_numeric($postProduct['name']) || 
            preg_match('/[0-9]/', $postProduct['name'])
        ) {
            $errors['name'] = 'El nombre no es valido';
        }

        if (
            !isset($postProduct['description']) || 
            empty($postProduct['description'])
        ) {
            $errors['description'] = 'La descripcion no es valida';
        }

        if ( 
            !isset($postProduct['price']) || 
            empty($postProduct['price']) || 
            !is_numeric($postProduct['price']) ||
            !preg_match('/[0-9]+/', $postProduct['price'])
        ) {
            $errors['price'] = 'El precio no es valido';
        }

        if ( 
            !isset($postProduct['stock']) || 
            empty($postProduct['stock']) || 
            !is_numeric($postProduct['stock']) ||
            !preg_match('/[0-9]+/', $postProduct['stock'])
        ) {
            $errors['stock'] = 'El stock no es valido';
        }

        if ( 
            !isset($postProduct['category_id']) || 
            empty($postProduct['category_id']) || 
            !is_numeric($postProduct['category_id']) ||
            !preg_match('/[0-9]+/', $postProduct['category_id'])
        ) {
            $errors['category_id'] = 'La cateogria no es valida';
        }

        return $errors;
    }

    static function validateOrder($postOrder) {
        $errors = [];

        if (
            !isset($postOrder['province']) || 
            empty($postOrder['province']) || 
            is_numeric($postOrder['province']) || 
            preg_match('/[0-9]/', $postOrder['province'])
        ) {
            $errors['province'] = 'La provincia no es valida';
        }

        if (
            !isset($postOrder['city']) || 
            empty($postOrder['city']) || 
            is_numeric($postOrder['city']) || 
            preg_match('/[0-9]/', $postOrder['city'])
        ) {
            $errors['city'] = 'La ciudad no es valida';
        }

        if (
            !isset($postOrder['address']) || 
            empty($postOrder['address'])
        ) {
            $errors['address'] = 'La dirección no es valida';
        }

        return $errors;
    }
}