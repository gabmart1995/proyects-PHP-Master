<?php

require_once 'models/Pedido.php';

class PedidoController {
    function index() {
        echo "Controlador Pedidos acción index";
    }

    function create() {
        require_once 'views/order/create.php';
    }

    function save() {
        // si no esta identificado
        if (!isset($_SESSION['identity'])) {
            header('Location:'.base_url);
            return;
        }

        if (!isset($_POST)) {
            $_SESSION['register-order'] = 'failed';
            header('Location:'.base_url.'Pedido/create');
            return;
        }

        $errors = Validator::validateOrder($_POST);

        if (count($errors) > 0) {
            $_SESSION['errors-order'] = $errors;
            header('Location:'.base_url.'Pedido/create');
            return;
        }

        // pedido
        $orderModel = new Pedido();
        $orderModel->setDireccion($_POST['address']);
        $orderModel->setLocalidad($_POST['city']);
        $orderModel->setProvincia($_POST['province']);
        $orderModel->setEstado('confirm');
        $orderModel->setUsuarioId($_SESSION['identity']->id);
        $orderModel->setCoste((Utils::statsCart())['total']);
        
        // crea la orden y la linea del pedidos
        if (!$orderModel->save() || !$orderModel->saveLine()) {
            $_SESSION['register-order'] = 'failed';
            header('Location:'.base_url.'Pedido/confirm');
            return;
        }

        // carga la vista
        $_SESSION['register-order'] = 'completed';
        header('Location:'.base_url.'Pedido/confirm');
    }
    
    
    function confirm() {

        // si no esta identificado
        if (!isset($_SESSION['identity'])) {
            header('Location:'.base_url);
            return;
        }

        $orderModel = new Pedido();
        $orderModel->setUsuarioId($_SESSION['identity']->id);
        $order = $orderModel->getOneByUser();
        $orderProducts = $orderModel->getProductByOrder($order->id);

        require_once 'views/order/confirmado.php';
    }


    function my_orders() {
        Utils::isLogged();

        // sacar los pedidos del usuario
        $orderModel = new Pedido();
        $orderModel->setUsuarioId(($_SESSION['identity'])->id);
        $orders = $orderModel->getAllByUser();

        require_once 'views/order/my-orders.php';
    }

    function detail() {
        Utils::isLogged();

        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            header('Location:'.base_url.'Pedido/orders');
            return;
        }

        // sacar el pedido
        $orderModel = new Pedido();
        $orderModel->setId($_GET['id']);
        $order = $orderModel->getOne();

        // sacar los productos
        $orderProducts = $orderModel->getProductByOrder($order->id);

        require_once 'views/order/detail.php';
    }

    function orders() {
        Utils::isAdmin();

        $gestion = true;

        $orderModel = new Pedido();
        $orders = $orderModel->getAll();

        require_once 'views/order/my-orders.php';
    }

    function state() {
        Utils::isAdmin();

        if (!isset($_POST) || !isset($_POST['estado']) || !isset($_POST['pedido_id'])) {
            header('Location:'.base_url);
            return;
        }

        $id = $_POST['pedido_id'];

        $orderModel = new Pedido();
        $orderModel->setId($id);
        $orderModel->setEstado($_POST['estado']);
        $orderModel->updateOne();

        header('Location:'.base_url.'Pedido/detail&id='.$id);
    }
}