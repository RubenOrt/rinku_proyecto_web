<?php
/*Se crea el controlador para organizar los datos del empleado de la nomina de manera automatica.*/
include('../Config/config_bd.php');
 
 class Empleado {
	 
	private $Conn;


	/*Se crea un constructor interno para manejar la instancia de la conexion de la base de datos.*/
	public function __construct()
	{
		$this->Conn = new Config_bd();
	}
	
	/*Se ingresa nuevo empleado*/
	public function Alta_Emp($Numero,$Nombre,$Rol){
			$cn = $this->Conn->abrir_conexion();
			$db = mysql_select_db("rinku",$cn);	
			$sql = "insert into empleados(Numero,Nombre_Completo,IdRol) values(".$Numero.",'".$Nombre."','".$Rol."');";
			$rs = mysql_query($sql,$cn);
			if(!$rs){
				 die('Empleado no fue ingresado, error: ' . mysql_error());
			}
			else{
				echo "Registro exitoso.";
			}
			$this->Conn->cerrar_conexion($cn);
	 }
	 
	 /*Catalogo de empleados activos*/
	 public function Lista_Emp(){
			$cn = $this->Conn->abrir_conexion();
			$db = mysql_select_db("rinku",$cn);	
			$sql = "SELECT e.Numero as NumeroEmp, e.Nombre_Completo, r.NombreRol as Rol 
						FROM empleados e
						inner join roles r on r.IdRol = e.IdRol";
			$rs = mysql_query($sql,$cn);
			$retorno = [];
			$i = 0;
			while($fila = mysql_fetch_array($rs)){
				$retorno[$i] = $fila;
				$i++;
			}
			$this->Conn->cerrar_conexion($cn);
			return $retorno;
	 }
	 
	 /*Obtener algun empleado especifico.*/
	 public function Get_Emp($Numero){
			$cn = $this->Conn->abrir_conexion();
			$db = mysql_select_db("rinku",$cn);	
			$sql = "SELECT e.Numero as NumeroEmp, e.Nombre_Completo, r.NombreRol as Rol, e.IdRol IdRol
						FROM empleados e
						inner join roles r on r.IdRol = e.IdRol
						and e.numero = '".$Numero."'";
			$rs = mysql_query($sql,$cn);
			$retorno = [];
			$i = 0;
			while($fila = mysql_fetch_array($rs)){
				$retorno[$i] = $fila;
				$i++;
			}
			$this->Conn->cerrar_conexion($cn);
			return $retorno;
	 }
	 
	 	/*Actualiza empleado.*/
	 public function Edita_Emp($Numero,$Nombre,$IdRol){
			$cn = $this->Conn->abrir_conexion();
			$db = mysql_select_db("rinku",$cn);	
			$sql = "update empleados 
					set
						Numero = '".$Numero."',
						Nombre_Completo = '".$Nombre."',
						IdRol = '".$IdRol."'
					where Numero = '".$Numero."'";
			$rs = mysql_query($sql,$cn);
			if(!$rs){
				 die('Empleado no fue ingresado, error: ' . mysql_error());
			}
			$this->Conn->cerrar_conexion($cn);
	 }
	 
	 /*Lista de Movimientos.*/
	 public function Lista_Mov(){
			$cn = $this->Conn->abrir_conexion();
			$db = mysql_select_db("rinku",$cn);	
			$sql = "SELECT m.idmovimiento,m.numero_emp,m.mes, e.Nombre_Completo,r.NombreRol,e.IdRol,m.Cant_Entregas
				FROM movimientos m
				inner join empleados e on e.numero = m.numero_emp
				inner join roles r on r.IdRol = e.IdRol";
			$rs = mysql_query($sql,$cn);
			$retorno = [];
			$i = 0;
			while($fila = mysql_fetch_array($rs)){
				$retorno[$i] = $fila;
				$i++;
			}
			$this->Conn->cerrar_conexion($cn);
			return $retorno;
	 }
	 /*Obtiene algun movimiento en especifico*/
	 public function Get_Mov($IdMovimiento){
			$cn = $this->Conn->abrir_conexion();
			$db = mysql_select_db("rinku",$cn);	
			$sql = "SELECT m.idmovimiento,m.numero_emp,m.mes, e.Nombre_Completo,r.NombreRol,e.IdRol,m.Cant_Entregas
				FROM movimientos m
				inner join empleados e on e.numero = m.numero_emp
				inner join roles r on r.IdRol = e.IdRol
				and m.idmovimiento = '".$IdMovimiento."'";
			$rs = mysql_query($sql,$cn);
			$retorno = [];
			$i = 0;
			while($fila = mysql_fetch_array($rs)){
				$retorno[$i] = $fila;
				$i++;
			}
			$this->Conn->cerrar_conexion($cn);
			return $retorno;
	 }
 }
?>
