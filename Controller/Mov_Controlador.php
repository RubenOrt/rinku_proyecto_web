<?php
/*Se crea el controlador para organizar los movimientos de la nomina de manera automatica.*/
include('../Config/config_bd.php');

class Movimientos {
	
	private $Conn;

	/*Se crea un constructor interno para manejar la instancia de la conexion de la base de datos.*/
	public function __construct()
	{
		$this->Conn = new Config_bd();
	}
	
	/*Se ingresa nuevo movimiento*/
	public function Alta_Mov($Numero,$Nombre,$Rol,$Mes,$Cantidad_Entregas)
	{
		$FechaMov_Llave = date('Ymd');
		$Num = explode(" - ",$Numero);
		$Numero_Key = $Num[0];
		$Rol_Key = $Num[2];
		$IdMovimiento = $Numero_Key.$Rol_Key.$FechaMov_Llave;
		$Mes_Campo = "";
		
		if($Mes < 10){
			$Mes_Campo = date('Y')."0".$Mes;
		}else{
			$Mes_Campo = date('Y').$Mes;
		}
		
		$cn = $this->Conn->abrir_conexion();
		$db = mysql_select_db("rinku",$cn);
		$sql = "insert into movimientos(IdMovimiento,Numero_Emp,Mes,Cant_Entregas,Fecha_mov,Rol,Horas_Trabajadas_Mensuales) values('".$IdMovimiento."','".$Numero_Key."','".$Mes_Campo."',".$Cantidad_Entregas.",now(),'".$Rol_Key."',192);";
		$rs = mysql_query($sql,$cn);
		if(!$rs){
			 die('Empleado no fue ingresado, error: ' . mysql_error());
		}
		else{
			echo "Registro exitoso.";
		}
		
		$this->Conn->cerrar_conexion($cn);
		$this->CalcularSueldoBase();
		$this->CalcularBonosTotales();
		$this->CalcularPagosEntregas();
		$this->CalcularISRBase();
		$this->CalcularISRAdicional();
		$this->CalcularVales();
		
	}
	
	/*Metodos Creados para calcular la nomina en base a los criterios establecidos.*/
	public function CalcularSueldoBase(){
		$cn = $this->Conn->abrir_conexion();
		$db = mysql_select_db("rinku",$cn);
		$sql = "CALL `CalculoSueldoNeto`();";
		$rs = mysql_query($sql,$cn);
		$this->Conn->cerrar_conexion($cn);
	}
	
	public function CalcularBonosTotales(){
		$cn = $this->Conn->abrir_conexion();
		$db = mysql_select_db("rinku",$cn);
		$sql = "CALL `CalcularBonos`();";
		$rs = mysql_query($sql,$cn);
		$this->Conn->cerrar_conexion($cn);
	}
	
	public function CalcularPagosEntregas(){
		$cn = $this->Conn->abrir_conexion();
		$db = mysql_select_db("rinku",$cn);
		$sql = "CALL `CalcularPagoEntregas`();";
		$rs = mysql_query($sql,$cn);
		$this->Conn->cerrar_conexion($cn);
	}
	
	public function CalcularISRBase(){
		$cn = $this->Conn->abrir_conexion();
		$db = mysql_select_db("rinku",$cn);
		$sql = "CALL `CalculaRetenciones_ISRBase`();";
		$rs = mysql_query($sql,$cn);
		$this->Conn->cerrar_conexion($cn);
	}
	
	public function CalcularISRAdicional(){
		$cn = $this->Conn->abrir_conexion();
		$db = mysql_select_db("rinku",$cn);
		$sql = "CALL `Calcular_Retenciones_ISR_Adicional`();";
		$rs = mysql_query($sql,$cn);
		$this->Conn->cerrar_conexion($cn);
	}
	
	public function CalcularVales(){
		$cn = $this->Conn->abrir_conexion();
		$db = mysql_select_db("rinku",$cn);
		$sql = "CALL `Calcular_Vales`();";
		$rs = mysql_query($sql,$cn);
		$this->Conn->cerrar_conexion($cn);
	}
	
	/*Actualiza Movimiento.*/
	public function Edita_Mov($Numero,$Nombre,$Rol,$Mes,$Cantidad_Entregas,$IdMovimiento){
			$cn = $this->Conn->abrir_conexion();
			$db = mysql_select_db("rinku",$cn);	
			$Mes_Campo = "";
		
			if($Mes < 10){
				$Mes_Campo = date('Y')."0".$Mes;
			}else{
				$Mes_Campo = date('Y').$Mes;
			}
			$sql = "update movimientos 
					set
						IdMovimiento = '".$IdMovimiento."',
						Mes = '".$Mes_Campo."',
						Rol = '".$Rol."',
						Cant_Entregas = '".$Cantidad_Entregas."'
					where IdMovimiento = '".$IdMovimiento."'";
			$rs = mysql_query($sql,$cn);
			if(!$rs){
				 die('Empleado no fue ingresado, error: ' . mysql_error());
			}
			$this->Conn->cerrar_conexion($cn);
			$this->Conn->cerrar_conexion($cn);
			$this->CalcularSueldoBase();
			$this->CalcularBonosTotales();
			$this->CalcularPagosEntregas();
			$this->CalcularISRBase();
			$this->CalcularISRAdicional();
			$this->CalcularVales();
	 }
	 
	 /*Crea el reporte.*/
	 public function Reporte_Mov(){
			$cn = $this->Conn->abrir_conexion();
			$db = mysql_select_db("rinku",$cn);	
			$sql = "SELECT m.numero_emp as '#_Empleado', e.Nombre_Completo,m.Mes,r.NombreRol Rol, round(sum(m.`Horas_Trabajadas_Mensuales`),2) Horas_Trabajadas,
			round(sum(m.Pago_Total_Entregas),2) Pago_Total_Entregas, round(sum(Bono_Total_Entrega),2) Pago_Total_Bonos, round(sum(m.ISR_Base) + sum(m.ISR_Adicional),2) Retenciones, round(sum(m.Vales_Despensa),2) Vales, round((sum(m.Sueldo_Bruto) + sum(m.Vales_Despensa)) - (sum(m.ISR_Base) + sum(m.ISR_Adicional)),2) Sueldo_Total
			FROM movimientos m
			inner join empleados e on e.numero = m.numero_emp
			inner join roles r on r.IdRol = e.IdRol
			group by m.mes, m.numero_emp, e.Nombre_Completo";
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
