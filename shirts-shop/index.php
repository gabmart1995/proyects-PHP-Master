<?php

session_start();

require_once 'autoload.php';
require_once 'config/db.php';

// constants
require_once 'config/parameters.php';
require_once 'helpers/utils.php';
require_once 'models/Validator.php';

require_once 'views/layouts/header.php';
require_once 'views/layouts/sidebar.php';


function showError() {
    $error = new ErrorController();
    $error->index();
}

$controller_name = '';
$action = '';

// autoload logic's

if ( isset($_GET['controller']) && isset($_GET['action']) ) {
    $controller_name = $_GET['controller'].'Controller';
    $action = $_GET['action'];

} else {
    $controller_name = controller_default;
    $action = action_default;
    
}


if ( class_exists( $controller_name ) ) {
    $controller = new $controller_name();

    if ( method_exists($controller, $action) ) {      
        $controller->$action();

    } else {
        showError();
    
    }

} else {
    showError();  

}

require_once 'views/layouts/footer.php';
