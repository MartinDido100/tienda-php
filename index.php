<?php 

session_start();
require_once 'config/parameters.php';
require_once 'autoload.php';
require_once 'config/db.php';
require_once 'helpers/utils.php';

function chargeTop(){
    require_once 'views/layout/header.php';
    require_once 'views/layout/sidebar.php';
}

function chargeFooter(){
    require_once 'views/layout/footer.php';
}

function showError(){
    $error = new ErrorController();
    $error->index();
}

if(isset($_GET['controller'])){
    $nombreCont = $_GET['controller'] . 'Controller';
}elseif(!isset($_GET['controller']) && !isset($_GET['accion'])){
    $nombreCont = defaultController;
}else{
    showError();
    exit();
}

if(isset($nombreCont) && class_exists($nombreCont)){

    $controlador = new $nombreCont();

    if(isset($_GET['accion']) && method_exists($controlador,$_GET['accion'])){
        chargeTop();

        $action = $_GET['accion'];
        $controlador->$action();

        chargeFooter();
    }elseif(!isset($_GET['controller']) && !isset($_GET['accion'])){
        chargeTop();

        $defaultAction = defaultAction;
        $controlador->$defaultAction();

        chargeFooter();
    }else{
        showError();
    }


}else{
    showError();
}



?>
