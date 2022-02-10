<?php 

require_once 'models/categoria.php';
require_once 'models/producto.php';

class CategoriaController{
    public function inicio(){

        Utils::isAdmin();

        $categoria = new Categoria();

        $categorias = $categoria->getAll();

        require_once 'views/categoria/index.php';
    }

    public function ver(){

        if(isset($_GET['id'])){

            $categoria = new Categoria();
            $categoria->setId($_GET['id']);
            $cat = $categoria->getOne();

            $producto = new Producto();

            $producto->setCategoria_id($_GET['id']);

            $productos = $producto->getByCategory();
        }

        require_once 'views/categoria/ver.php';

    }

    public function crear(){

        Utils::isAdmin();

        $errores = isset($_SESSION['catErrors']) ? $_SESSION['catErrors'] : null;

        require_once 'views/categoria/crear.php';

        Utils::deleteSession('catErrors');
    }

    public function save(){

        Utils::isAdmin();

        if(isset($_POST) && isset($_POST['nombre'])){
            $categoria = new Categoria();

            $categoria->setNombre($_POST['nombre']);

            $guardar = $categoria->save();

            if(!$guardar){
                $_SESSION['catErrors']['exists'] = 'La categoria ya existe';
                header('Location:'.base_url.'categoria/crear');
            }else{
                header('Location:'.base_url.'categoria/inicio');
            }

        }

    }

}

?>