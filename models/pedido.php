<?php 

class Pedido{

    private $id;
    private $usuario_id;
    private $provincia;
    private $localidad;
    private $direccion;
    private $coste;
    private $estado;
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

	public function getUsuario_id(){
		return $this->usuario_id;
	}

	public function setUsuario_id($usuario_id){
		$this->usuario_id = $usuario_id;
	}

	public function getProvincia(){
		return $this->provincia;
	}

	public function setProvincia($provincia){
		$this->provincia = $this->db->real_escape_string($provincia);
	}

	public function getLocalidad(){
		return $this->localidad;
	}

	public function setLocalidad($localidad){
		$this->localidad = $this->db->real_escape_string($localidad);
	}

	public function getDireccion(){
		return $this->direccion;
	}

	public function setDireccion($direccion){
		$this->direccion = $this->db->real_escape_string($direccion);
	}

	public function getCoste(){
		return $this->coste;
	}

	public function setCoste($coste){
		$this->coste = $coste;
	}

	public function getEstado(){
		return $this->estado;
	}

	public function setEstado($estado){
		$this->estado = $this->db->real_escape_string($estado);
	}

	public function getAll(){
		$sql = "SELECT * FROM pedidos";
		$pedidos = $this->db->query($sql);
		return $pedidos;
	}

	public function getByUser(){
		$sql = "SELECT * FROM pedidos WHERE usuario_id = {$this->getUsuario_id()} ORDER BY id DESC";
		$pedidos = $this->db->query($sql);

		return $pedidos;
	}

    public function add(){
        $sql = "INSERT INTO pedidos VALUES(null,{$this->getUsuario_id()},'{$this->getProvincia()}','{$this->getLocalidad()}','{$this->getDireccion()}',{$this->getCoste()},'Pendiente',CURDATE(),CURRENT_TIMESTAMP());";
        $add = $this->db->query($sql);
        $result = false;

        if($add){
            $result = true;
        }

        return $result;
    }

    public function save_linea(){
        $sql = "SELECT LAST_INSERT_ID() AS 'pedido';";
        $query = $this->db->query($sql);
        $pedido_id = $query->fetch_object()->pedido;

        foreach ($_SESSION['carrito'] as $elemento) {
            $producto = $elemento['producto'];
            $insert = "INSERT INTO lineas_pedidos VALUES(null,{$pedido_id},{$producto->id},{$elemento['unidades']})";
            $add = $this->db->query($insert);
        }

        $result = false;

        if($add){
            $result = true;
        }

        return $result;

    }

	public function confirmar(){
		$sql = "UPDATE pedidos SET estado = 'Confirmado' WHERE id = {$this->getId()};";
		$updated = $this->db->query($sql);

		$resultado = false;

		if($updated){
			$resultado = true;
		}

		return $resultado;
	}

}

?>