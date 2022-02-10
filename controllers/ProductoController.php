<?php 

require_once 'models/producto.php';

class ProductoController{
    public function index(){

        $producto = new Producto();

        $productos = $producto->getRandom(6);

        require_once 'views/producto/destacados.php';
    }

    public function ver(){
     
        if(isset($_GET['id'])){
            $editar = true;
    
            $producto = new Producto();
            $producto->setId($_GET['id']);

            $prod = $producto->getOne();
    
            require_once 'views/producto/ver.php';
        }

    }

    public function gestion(){
        Utils::isAdmin();

        $producto = new Producto();

        $productos = $producto->getAll();

        require_once 'views/producto/gestion.php';
    }

    public function crear(){

        Utils::isAdmin();

        $errores = isset($_SESSION['prodErrors']) ? $_SESSION['prodErrors'] : null;

        require_once 'views/producto/crear.php';

        Utils::deleteSession('prodErrors');

    }

    public function save(){

        if(isset($_POST)){

            $location = 'crear';
            $errores = [];

            $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : null;
            $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : null;
            $precio = isset($_POST['precio']) ? floatval($_POST['precio']) : null;
            $stock = isset($_POST['stock']) ? $_POST['stock'] : null;
            $categoriaId = isset($_POST['categoria']) ? $_POST['categoria'] : null;

            if(empty($nombre) || !is_string($nombre)){
                $errores['nombre'] = 'Nombre incorrecto';
            }

            if(empty($descripcion) || !is_string($descripcion)){
                $errores['descripcion'] = 'Descripcion incorrecta';
            }

            if(empty($precio) || !is_float($precio)){
                $errores['precio'] = 'Precio incorrecto';
            }

            if(empty($stock) ||!is_numeric($stock)){
                $errores['stock'] = 'Stock incorrecto';
            }

            if(empty($categoriaId) || strlen($categoriaId) == 0){
                $errores['catId'] = 'Seleccione una categoria';
            }

            if(count($errores) == 0){

                $producto = new Producto();

                $producto->setNombre($nombre);
                $producto->setDescripcion($descripcion);
                $producto->setPrecio($precio);
                $producto->setStock($stock);
                $producto->setCategoria_id($categoriaId);

                //Guardar imagen
                $archivo = $_FILES['imagen'];
                $filename = $archivo['name'];
                $tipoArch = $archivo['type'];

                if($tipoArch == "image/jpg" || $tipoArch == "image/jpeg" || $tipoArch == "image/png" || $tipoArch == "image/gif"){

                    if(!is_dir('uploads/images')){
                        mkdir('uploads/images',0777,true);
                    }

                    move_uploaded_file($archivo['tmp_name'],'uploads/images/'. $filename);
                    $producto->setImagen($filename);
                }

                $save = $producto->save();

                if(!$save){
                    $_SESSION['prodErrors']['query'] = 'Error al agregar el producto';
                }else{
                    $location = 'gestion';
                    $_SESSION['correctProd'] = 'Agregado correctamente!';
                }

            }else{
                $_SESSION['prodErrors'] = $errores;
            }

        }else{
            $_SESSION['prodErrors']['general'] = 'Error al agregar el producto';
        }

        header('Location:'.base_url.'producto/'.$location);

    }

    public function saveEdit(){

        if(isset($_POST) && isset($_GET['id'])){

            $location = "editar&id={$_GET['id']}";
            $errores = [];

            $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : null;
            $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : null;
            $precio = isset($_POST['precio']) ? floatval($_POST['precio']) : null;
            $stock = isset($_POST['stock']) ? $_POST['stock'] : null;
            $categoriaId = isset($_POST['categoria']) ? $_POST['categoria'] : null;

            if(empty($nombre) || !is_string($nombre)){
                $errores['nombre'] = 'Nombre incorrecto';
            }

            if(empty($descripcion) || !is_string($descripcion)){
                $errores['descripcion'] = 'Descripcion incorrecta';
            }

            if(empty($precio) || !is_float($precio)){
                $errores['precio'] = 'Precio incorrecto';
            }

            if(empty($stock) ||!is_numeric($stock)){
                $errores['stock'] = 'Stock incorrecto';
            }

            if(empty($categoriaId) || strlen($categoriaId) == 0){
                $errores['catId'] = 'Seleccione una categoria';
            }

            if(count($errores) == 0){

                $producto = new Producto();

                $producto->setId($_GET['id']);
                $producto->setNombre($nombre);
                $producto->setDescripcion($descripcion);
                $producto->setPrecio($precio);
                $producto->setStock($stock);
                $producto->setCategoria_id($categoriaId);

                //Guardar imagen
                $archivo = $_FILES['imagen'];
                $filename = $archivo['name'];
                $tipoArch = $archivo['type'];

                if($tipoArch == "image/jpg" || $tipoArch == "image/jpeg" || $tipoArch == "image/png" || $tipoArch == "image/gif"){

                    if(!is_dir('uploads/images')){
                        mkdir('uploads/images',0777,true);
                    }

                    move_uploaded_file($archivo['tmp_name'],'uploads/images/'. $filename);
                    $producto->setImagen($filename);
                }

                $save = $producto->saveEdit();

                if(!$save){
                    $_SESSION['prodErrors']['query'] = 'Error al editar el producto';
                }else{
                    $location = 'gestion';
                    $_SESSION['correctProd'] = 'Modificado correctamente!';
                }

            }else{
                $_SESSION['prodErrors'] = $errores;
            }

        }else{
            $_SESSION['prodErrors']['general'] = 'Error al editar el producto';
        }

        header('Location:'.base_url.'producto/'.$location);

    }

    public function editar(){
        
        Utils::isAdmin();

        if(isset($_GET['id'])){
            $editar = true;
    
            $producto = new Producto();
            $producto->setId($_GET['id']);

            $prodObject = $producto->getOne();

            $errores = isset($_SESSION['prodErrors']) ? $_SESSION['prodErrors'] : null; 
    
            require_once 'views/producto/crear.php';

            Utils::deleteSession('prodErrors');
        }else{
            header('Location:'.base_url.'producto/gestion');
        }

    }

    public function eliminar(){

        Utils::isAdmin();

        if(isset($_GET['id'])){

            $producto = new Producto();

            $producto->setId($_GET['id']);

            $eliminar = $producto->eliminar();

            if($eliminar){
                $_SESSION['correctProd'] = 'Producto eliminado correctamente';
            }else{
                $_SESSION['errorProd'] = 'Error al eliminar';
            }

        }else{
            $_SESSION['errorProd'] = 'Error al eliminar';
        }

        header('Location:'.base_url.'producto/gestion');

    }
}

?>