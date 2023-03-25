<?php 

require_once 'models/Producto.php';

class CartController {
    function index() {
        $cart = $_SESSION['cart'] ?? [];

        require_once 'views/cart/index.php';
    }
    
    function add() {
        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            header('Location:'.base_url);
            return;
        }

        $productId = $_GET['id'];
        
        if (isset($_SESSION['cart'])) {
            $counter = 0;
            
            // si existe carrito recorremos y actualizamos el valor
            foreach ($_SESSION['cart'] as $index => $item) {
                
                if ($item['id_producto'] == $productId) {
                    $_SESSION['cart'][$index]['unidades']++;
                    $counter++;
                }
            }
        }

        // crea productos si counter no esta definida o este en 0
        if (!isset($counter) || ($counter == 0)) {

            $productModel = new Producto();
            $productModel->setId($productId);

            $product = $productModel->getOne();
            
            if (is_object($product)) {

                // añade al carrito
                $_SESSION['cart'][] = [
                    'id_producto' => $product->id,
                    'precio' => $product->precio,
                    'unidades' => 1,
                    'producto' => $product,
                ];
            }
        }

        header('Location:'.base_url.'Cart/index');
    }

    function remove() {
        if (!isset($_GET['index'])) {
            header('Location:'.base_url.'Cart/index');
            return;
        }

        $index = $_GET['index'];
        unset($_SESSION['cart'][$index]);

        header('Location:'.base_url.'Cart/index');
    }

    function deleteAll() {
        if (isset($_SESSION['cart'])) {
            unset($_SESSION['cart']);
        }

        header('Location:'.base_url.'Cart/index');
    }

    function addQuantity() {
        if (!isset($_GET['index'])) {
            header('Location:'.base_url.'Cart/index');
            return;
        }

        $index = $_GET['index'];
        
        // aumenta el valor
        $_SESSION['cart'][$index]['unidades']++;

        header('Location:'.base_url.'Cart/index');
    }

    function removeQuantity() {
        if (!isset($_GET['index']) || !is_numeric($_GET['index'])) {
            header('Location:'.base_url.'Cart/index');
            return;
        }
        
        $index = $_GET['index'];
        
        // disminuye el valor
        $_SESSION['cart'][$index]['unidades']--;
        
        if ($_SESSION['cart'][$index]['unidades'] == 0) {
            unset($_SESSION['cart'][$index]);
        }
        
        header('Location:'.base_url.'Cart/index');
    }
}