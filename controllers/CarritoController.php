<?php 

require_once 'models/producto.php';

class CarritoController{

    public function inicio(){

        $carrito = isset($_SESSION['carrito']) ? $_SESSION['carrito'] : [] ;

        require_once 'views/cart/index.php';

        Utils::deleteSession('pedido');
    }

    public function add(){

        if(isset($_GET['id'])){

            $prod_id = $_GET['id'];

        }else{
            header('Location:' . base_url);
        }

        if(isset($_SESSION['carrito'])){

            foreach($_SESSION['carrito'] as $indice => $elemento){
                $contador = 0;
                if($elemento['id_producto'] === $prod_id){
                    $_SESSION['carrito'][$indice]['unidades']++;
                    $contador++;
                }

            }

        }

        if(!isset($contador) || $contador == 0){
            $producto = new Producto();
            $producto->setId($prod_id);
            $prod = $producto->getOne();

            if(is_object($prod)){
                $_SESSION['carrito'][] = [
                    "id_producto" => $prod->id,
                    "precio" => $prod->precio,
                    "unidades" => 1,
                    "producto" => $prod
                ];
            }
        }

        header('Location:' . base_url . 'carrito/inicio');

    }

    public function remove(){

        if(isset($_GET['indice'])){
            $indice = $_GET['indice'];

            
            $_SESSION['carrito'][$indice]['unidades']--;

            
            if($_SESSION['carrito'][$indice]['unidades'] == 0){
                unset($_SESSION['carrito'][$indice]);
            }

        }

        header('Location:'. base_url . 'carrito/inicio');

    }

    public function delete(){

        if(isset($_GET['indice'])){
            $indice = $_GET['indice'];
            unset($_SESSION['carrito'][$indice]);
        }

        header('Location:'. base_url . 'carrito/inicio');

    }

    public function clear(){
        unset($_SESSION['carrito']);
        header('Location:' . base_url . 'carrito/inicio');
    }

}

?>