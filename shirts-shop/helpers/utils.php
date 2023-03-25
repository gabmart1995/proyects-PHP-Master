<?php

class Utils {
    static function deleteSession($name) {
        if ( isset($_SESSION[$name]) ) {
            unset($_SESSION[$name]);
        }
    }

    static function isAdmin() {
        
        if (!$_SESSION['admin']) {
            header('Location:'.base_url);
        }
    }

    static function isLogged() {
        
        if (!$_SESSION['identity']) {
            header('Location:'.base_url);
        }
    }

    static function getCategories() {
        require_once 'models/Categoria.php';
        
        return (new Categoria())->getAll();
    }

    static function statsCart() {
        
        $stats = [
            'count' => 0,
            'total' => 0,
        ];
        
        if (isset($_SESSION['cart'])) {
            $stats['count'] = count($_SESSION['cart']);
            
            foreach ($_SESSION['cart'] as $item) {
                $stats['total'] += $item['precio'] * $item['unidades'];
            }
        }

        return $stats;
    }

    static function showStatus($status) {
        switch ($status) {
            case 'preparation':
                return 'En preparación';

            case 'ready':
                return 'Preparado para enviar';

            case 'sended':
                return 'Enviado';

            default:
                return 'Pendiente';
        }
    }
}