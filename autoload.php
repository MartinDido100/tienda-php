<?php 

function controllers_autoload($className){

    require_once "controllers/$className.php"; 

}

spl_autoload_register('controllers_autoload');

?>