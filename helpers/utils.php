<?php 

class Utils{
    public static function deleteSession($nombre){
        if(isset($_SESSION[$nombre])){
            $_SESSION[$nombre] = null;
            unset($_SESSION[$nombre]);
        }

        return $nombre;
    }

    public static function summError($errores,$campo){

        if(!empty($errores) && !empty($errores[$campo])){
            return "<h3 class='form-error'>{$errores[$campo]}</h3>";
        }elseif (empty($errores) && !empty($campo) && isset($_SESSION[$campo])) {
            return "<h3 class='form-error'>{$_SESSION[$campo]}</h3>";
        }

    }

    public static function isLogged(){

        if(!isset($_SESSION['usuario'])){
            header('Location:'.base_url);
        }else{
            return true;
        }

    }

    public static function isAdmin(){

        if(!isset($_SESSION['isAdmin'])){
            header('Location:'.base_url);
        }else{
            return true;
        }

    }

    public static function showCategorias(){

        require_once 'models/categoria.php';

        $categoria = new Categoria();

        $categorias = $categoria->getAll();

        return $categorias;
    }

    public static function totalProductos(){
        $total = 0;

        if(isset($_SESSION['carrito'])){
            $total = count($_SESSION['carrito']);
        }

        return $total;
    }

    public static function totalPrecio(){
        $total = 0;

        if(isset($_SESSION['carrito'])){
            foreach ($_SESSION['carrito'] as $indice => $elemento) {

                $total += $elemento['precio'] * $elemento['unidades'];

            }

        }

        return $total;
    }
}

?>