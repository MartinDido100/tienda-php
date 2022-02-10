<?php 

class Producto{

    private $id;
    private $nombre;
    private $categoria_id;
    private $descripcion;
    private $precio;
    private $stock;
    private $oferta;
    private $fecha;
    private $imagen;

    private $db;

    public function __construct(){
        $this->db = Database::connect();
    }

	public function getId(){
		return $this->id;
	}

	public function setId($id){
		$this->id = $id;
	}

	public function getNombre(){
		return $this->nombre;
	}

	public function setNombre($nombre){
		$this->nombre = $this->db->real_escape_string($nombre);
	}

	public function getCategoria_id(){
		return $this->categoria_id;
	}

	public function setCategoria_id($categoria_id){
		$this->categoria_id = $categoria_id;
	}

	public function getDescripcion(){
		return $this->descripcion;
	}

	public function setDescripcion($descripcion){
		$this->descripcion = $this->db->real_escape_string($descripcion);
	}

	public function getPrecio(){
		return $this->precio;
	}

	public function setPrecio($precio){
		$this->precio = $this->db->real_escape_string($precio);
	}

	public function getStock(){
		return $this->stock;
	}

	public function setStock($stock){
		$this->stock = $this->db->real_escape_string($stock);
	}

	public function getOferta(){
		return $this->oferta;
	}

	public function setOferta($oferta){
		$this->oferta = $this->db->real_escape_string($oferta);
	}

	public function getFecha(){
		return $this->fecha;
	}

	public function setFecha($fecha){
		$this->fecha = $this->db->real_escape_string($fecha);
	}

	public function getImagen(){
		return $this->imagen;
	}

	public function setImagen($imagen){
		$this->imagen = $this->db->real_escape_string($imagen);
	}

    public function getAll(){
        $productos = $this->db->query("SELECT * FROM productos ORDER BY id DESC");
        return $productos;
    }

	public function getOne(){

		$productos = $this->db->query("SELECT * FROM productos WHERE id = {$this->getId()}");
        return $productos->fetch_object();

	}

	public function getByCategory(){
		$sql = "SELECT p.*,c.nombre AS 'Categoria' FROM productos p
				INNER JOIN categorias c ON p.categoria_id = c.id
				WHERE p.categoria_id = {$this->getCategoria_id()}
				ORDER BY id DESC";

		$productos = $this->db->query($sql);

		return $productos;
	}

	public function getRandom($limit){

		$productos = $this->db->query("SELECT * FROM productos ORDER BY RAND() LIMIT $limit");

		return $productos;

	}

    public function save(){

        $sql = "INSERT INTO productos VALUES(null,{$this->getCategoria_id()},'{$this->getNombre()}','{$this->getDescripcion()}',{$this->getPrecio()},{$this->getStock()},null,CURDATE(),'{$this->getImagen()}')";

        $save = $this->db->query($sql);

        $result = false;

        if($save){
            $result = true;
        }

        return $result;
    }

    public function saveEdit(){

        $sql = "UPDATE productos SET categoria_id={$this->getCategoria_id()},nombre='{$this->getNombre()}',descripcion='{$this->getDescripcion()}',precio={$this->getPrecio()},stock={$this->getStock()},fecha=CURDATE() WHERE id = {$this->getId()};";
		
        $save = $this->db->query($sql);

        $result = false;

        if($save){
            $result = true;
        }

        return $result;
    }

    public function eliminar(){
        $sql = "DELETE FROM productos WHERE id = {$this->getId()}";

        $delete = $this->db->query($sql);

        $result = false;

        if($delete){
            $result = true;
        }

        return $result;
    }

}

?>