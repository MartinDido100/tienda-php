<?php 

require_once 'models/pedido.php';

class PedidoController{
    public function hacer(){
        
        $errores = isset($_SESSION['pedidoErr']) ? $_SESSION['pedidoErr'] : null;
        
        require_once 'views/pedido/hacer.php';

        if(!isset($_SESSION['usuario'])){
            require_once 'views/usuario/registro.php';
        }

        Utils::deleteSession('pedido');
        Utils::deleteSession('pedidoErr');

    }

    public function add(){

        $location = base_url;

        if(isset($_POST) && isset($_SESSION['usuario'])){

            $location .= 'pedido/hacer'; 

            $localidad = isset($_POST['localidad']) ? $_POST['localidad'] : null;
            $provincia = isset($_POST['provincia']) ? $_POST['provincia'] : null;
            $direccion = isset($_POST['direccion']) ? $_POST['direccion'] : null;

            $errores = [];

            if(empty($localidad) || !is_string($localidad)){
                $errores['localidad'] = 'Completa el campo';
            }

            if(empty($provincia) || !is_string(($provincia))){
                $errores['provincia'] = 'Completa el campo';
            }

            if(empty($direccion) || !is_string($direccion)){
                $errores['direccion'] = 'Completa el campo';
            }

            if(count($errores) == 0){
    
                $pedido = new Pedido();

                $pedido->setUsuario_id($_SESSION['usuario']->id);
                $pedido->setCoste(Utils::totalPrecio());
                $pedido->setDireccion($direccion);
                $pedido->setLocalidad($localidad);
                $pedido->setProvincia($provincia);

                $add = $pedido->add();

                $save_linea = $pedido->save_linea();

                if($add && $save_linea){
                    $location = base_url . 'carrito/clear';
                    $_SESSION['pedido'] = true;
                }else{
                    $_SESSION['pedido'] = false;
                }
            }

        }else{
            $_SESSION['pedido'] = false;
        }
        $_SESSION['pedidoErr'] = $errores;
        header("Location:". $location);

    }

    public function mis_pedidos(){

        Utils::isLogged();

        $textoH1 = 'Mis pedidos';

        $pedido = new Pedido();
        $pedido->setUsuario_id($_SESSION['usuario']->id);

        $pedidos = $pedido->getByUser();



        require_once 'views/pedido/misPedidos.php';
    }

    public function gestion(){

        Utils::isAdmin();

        $gestion = true;
        $textoH1 = 'Gestionar pedidos';

        $pedido = new Pedido();
        $pedidos = $pedido->getAll();

        require_once 'views/pedido/misPedidos.php';

        Utils::deleteSession('confirmarError');

    }

    public function confirmar(){

        Utils::isAdmin();

        if(isset($_GET['id'])){

            $pedido_id = $_GET['id'];

            $pedido = new Pedido();
            $pedido->setId($pedido_id);
            $confirmar = $pedido->confirmar();

            if(!$confirmar){
                $_SESSION['confirmarError'] = 'Error al confirmar';
            }

            header('Location:' . base_url . 'pedido/gestion');

        }else{
            header('Location:' . base_url);
        }

    }

}

?>