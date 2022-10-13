<?php
/*Se crea la pagina para automatizar los movimientos de la nomina de todos los empleados activos.*/
include('menu_empleados.php');
include ('../Controller/Emp_Controlador.php');
$ctrl_emp = new Empleado();
$cat = $ctrl_emp->Lista_Emp();
$cat_mov = $ctrl_emp->Lista_Mov();
?>
<head>
<link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'>
<link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.11.2/css/bootstrap-select.min.css'>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js"></script>  
</head>
<div class="col-xs-12">
	<h1>Movimientos por Mes</h1>
	<form method="post" action="../Model/Nuevo_Mov.php">
	 <div class="row-fluid">
		<label for="numero_emp">Numero de Empleado:</label>
		<select class="selectpicker" data-show-subtext="true" data-live-search="true" onChange="update()" id="Numero" name="Numero">
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
		<!--<label for="numero_emp">Nombre Completo:</label>-->
		<input class="form-control" name="Nombre_Completo" required type="hidden" id="Nombre_Completo" placeholder="Nombre">
		
		<!--<label for="Rol_name">Rol:</label>-->
		<input class="form-control" name="Rol" required type="hidden" id="Rol" placeholder="Rol">
	
		<label for="Rol_name">Mes:</label>
		<select name="Mes" id="Mes" class="form-control" required>
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
		<input class="form-control" name="Cantidad_Entregas" required type="text" id="Cantidad_Entregas" placeholder="Teclea Entregas" required>
		
		<br><br><input class="btn btn-info" type="submit" value="Registrar">
	</form>
</div>
<?php

$Encabezado = "<h1 align='center'>Reporte</h1><br> 
			<table class='table table-bordered'>
				<thead>
					<tr align='center'>
						<td>Editar</td>
						<td>Mes</td>
						<td>#Empleado</td>
						<td>Nombre_Completo</td>
						<td>Rol</td>
						<td>Cant. Entregas</td>
					</tr>
				</thead>
				<tbody>";
	$Cuerpotbl = "";
	if(!empty($cat_mov))
	{
		foreach ($cat_mov as $employer) 
		{
			$Cuerpotbl .= "<tr align='center'>";
			$Cuerpotbl .= "<td><a href='Edita_View_Mov.php?Llave=".$employer['idmovimiento']."'><button class='btn btn-xs btn-warning'><span class='glyphicon glyphicon-pencil'></span></button></a></td>";
			$Cuerpotbl .= "<td>".$employer['mes']."</td>
						   <td>".$employer['numero_emp']."</td>
						   <td>".$employer['Nombre_Completo']."</td>
						   <td>".$employer['NombreRol']."</td>
						   <td>".$employer['Cant_Entregas']."</td>";
			$Cuerpotbl .= "</tr>";
		}
	 echo $Encabezado.$Cuerpotbl."</table>";
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