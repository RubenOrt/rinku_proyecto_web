<?php
/*Módulo creado para gestionar algun movimiento erroneo o si hay que cambiar algun dato importante para la nomina.*/
include('menu_empleados.php');
include ('../Controller/Emp_Controlador.php');
$ctrl_emp = new Empleado();
$cat = $ctrl_emp->Lista_Emp();
 $Arreglo = "";
 if(isset($_GET['Llave'])){
	 $Arreglo = $ctrl_emp->Get_Mov($_GET['Llave']);
	 
	 $Numero = "";
	 $Nombre = "";
	 $Rol = "";
	 $IdRol = "";
	 $Cant_Entregas = "";
	 $Mes = "";
	 $Mes_Nombre = "";
	 $Mes_Numero = "";
	 $IdMovimiento = "";
	 foreach ($Arreglo as $employer){
		$Numero = $employer['numero_emp'];
		$Nombre = $employer['Nombre_Completo'];
		$Rol = $employer['NombreRol'];
		$IdRol = $employer['IdRol'];
		$Mes = $employer['mes'];
		$Cant_Entregas = $employer['Cant_Entregas'];
		$IdMovimiento = $employer['idmovimiento'];
		
		switch($Mes){
			case "202201":
				$Mes_Numero = 1;
				$Mes_Nombre = "Enero";
			break;
			case "202202":
				$Mes_Numero = 2;
				$Mes_Nombre = "Febrero";
			break;
			case "202203":
				$Mes_Numero = 3;
				$Mes_Nombre = "Marzo";
			break;
			case "202204":
				$Mes_Numero = 4;
				$Mes_Nombre = "Abril";
			break;
			case "202205":
				$Mes_Numero = 5;
				$Mes_Nombre = "Mayo";
			break;
			case "202206":
				$Mes_Numero = 6;
				$Mes_Nombre = "Junio";
			break;
			case "202207":
				$Mes_Numero = 7;
				$Mes_Nombre = "Julio";
			break;
			case "202208":
				$Mes_Numero = 8;
				$Mes_Nombre = "Agosto";
			break;
			case "202209":
				$Mes_Numero = 9;
				$Mes_Nombre = "Septiembre";
			break;
			case "202210":
				$Mes_Numero = 10;
				$Mes_Nombre = "Octubre";
			break;
			case "202211":
				$Mes_Numero = 11;
				$Mes_Nombre = "Noviembre";
			break;
			case "202210":
				$Mes_Numero = 12;
				$Mes_Nombre = "Diciembre";
			break;
			
		}
?>
<head>
<link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'>
<link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.11.2/css/bootstrap-select.min.css'>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js"></script>  
</head>
	<div class="col-xs-12">
		<h1>Edita - Movimientos x mes</h1>
		<form method="post" action="../Model/Edita_Mov.php">
		<div class="row-fluid">
			<label for="numero_emp">Numero de Empleado:</label>
			<select class="selectpicker" data-show-subtext="true" data-live-search="true" onChange="update()" id="Numero" name="Numero">
			<option value = "<?php echo $Numero." - ".$Nombre." - ".$$Rol;?>" selected><?php echo $Numero." - ".$Nombre;?></option>
			<option value = "0">-----------------------</option>
			<?php
				foreach ($cat as $employer) 
				{?>
					<option value="<?php echo $employer['NumeroEmp']." - ".$employer['Nombre_Completo']." - ".$employer['Rol']; ?>"><?php echo $employer['NumeroEmp']." - ".$employer['Nombre_Completo']; ?></option>
				<?php 
				}
			?>
			</select>
		</div>
			<br>
			<label for="numero_emp">Nombre Completo:</label>
			<input class="form-control" name="Nombre_Completo" required type="text" id="Nombre_Completo" placeholder="Nombre" value="<?php echo $Nombre;?>">
		<input class="form-control" name="IdMovimiento" required type="hidden" id="IdMovimiento" placeholder="IdMovimiento" value="<?php echo $IdMovimiento;?>">	
		<br>
		<label for="Rol_name">Rol:</label>
		<input class="form-control" name="Rol" required type="text" id="Rol" placeholder="Rol" value="<?php echo $IdRol;?>">
		<br>
		<label for="Rol_name">Mes:</label>
		<select name="Mes" id="Mes" class="form-control" required>
		  <option value="<?php echo $Mes_Numero;?>" selected><?php echo $Mes_Nombre;?></option>
		  <option value="0">--------</option>
		  <option value="1">Enero</option>
		  <option value="2">Febrero</option>
		  <option value="3">Marzo</option>
		  <option value="4">Abril</option>
		  <option value="5">Mayo</option>
		  <option value="6">Junio</option>
		  <option value="7">Julio</option>
		  <option value="8">Agosto</option>
		  <option value="9">Septiembre</option>
		  <option value="10">Octubre</option>
		  <option value="11">Noviembre</option>
		  <option value="12">Diciembre</option>
		</select>
		
		<br>
		<label for="numero_emp">Cantidad de Entregas:</label>
		<input class="form-control" name="Cantidad_Entregas" required type="text" id="Cantidad_Entregas" placeholder="Teclea Entregas" required value="<?php echo $Cant_Entregas;?>">	
			<br><br><input class="btn btn-info" type="submit" value="Actualizar">
		</form>
	</div>
<?php
	 }
 }
?>
<script type="text/javascript">
			function update() {
				var select = document.getElementById('Numero');
				var option = select.options[select.selectedIndex];
				const Array = option.value.split(" - ");
				var Nombre_Completo = Array[1];
				var Rol = Array[2];
				if(!Nombre_Completo){
					Nombre_Completo = "N/A";
				}
				if(!Rol){
					Rol = "N/A";
				}
				document.getElementById('Nombre_Completo').value = Nombre_Completo;
				document.getElementById('Rol').value = Rol;
			}
			update();
</script>