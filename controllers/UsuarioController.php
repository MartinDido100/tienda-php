<?php 

require_once 'models/usuario.php';

class UsuarioController{

    public function index(){
        echo "Controlador funcionando";
    }

    public function registro(){
        $errores = isset($_SESSION['errores']) ? $_SESSION['errores'] : null;
        require_once 'views/usuario/registro.php';
    }

    public function save(){

        if(isset($_POST)){

            $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
            $apellidos = isset($_POST['apellido']) ? $_POST['apellido'] : false;
            $email = isset($_POST['email']) ? $_POST['email'] : false;
            $password = isset($_POST['pass']) ? $_POST['pass'] : false;

            $errores = [];

            if(!$nombre || !is_string($nombre)){
                $errores['nombre'] = 'Completa el campo';
            }

            if(!$apellidos || !is_string(($apellidos))){
                $errores['apellidos'] = 'Completa el campo';
            }

            if(!$email || !filter_var($email,FILTER_VALIDATE_EMAIL)){
                $errores['email'] = 'Error en el email';
            }

            if(!$password || strlen($password) < 6){
                $errores['pass'] = 'Completa el campo, debe ser mayor a 6 caracteres';
            }

            if(count($errores) == 0){
                $usuario = new Usuario();
    
                $usuario->setNombre($nombre);
                $usuario->setApellidos($apellidos);
                $usuario->setEmail($email);
                $usuario->setPassword($password);
                $usuario->setRol('user');
    
                $save = $usuario->save();
    
                if($save){
                    $_SESSION['register'] = true;
                }else{
                    $errores['email'] = 'El email ya existe'; 
                    $_SESSION['register'] = false;
                }
            }

        }else{
            $_SESSION['register'] = false;
        }
        $_SESSION['errores'] = $errores;
        header("Location:". base_url . 'usuario/registro');

    }

    public function login(){
        if(isset($_POST)){

            $usuario = new Usuario();

            $usuario->setEmail($_POST['email']);

            $usuario->setPassword($_POST['pass']);

            $identity = $usuario->login();

            if(!$identity){
                $_SESSION['loginError'] = 'Credenciales incorrectas';
            }else{
                $_SESSION['usuario'] = $identity;
                if($identity->rol == 'admin'){
                    $_SESSION['isAdmin'] = true;
                }
            }

        }
        header('Location:'.base_url);
    }

    public function logout(){
        if(isset($_SESSION['usuario'])){
            unset($_SESSION['usuario']);
        }

        if(isset($_SESSION['isAdmin'])){
            unset($_SESSION['isAdmin']);
        }

        header('Location:'.base_url);
    }

}

?>