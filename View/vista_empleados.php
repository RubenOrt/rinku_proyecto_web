<?php
/*Pagina creada de empleados para la alta y la gestion del catalogo con colaboradores activos de la empresa.*/
include('menu_empleados.php');
include ('../Controller/Emp_Controlador.php');
$ctrl_emp = new Empleado();
$cat = $ctrl_emp->Lista_Emp();

?>
<div class="col-xs-12">
	<h1>Empleados</h1>
	<form method="post" action="../Model/Nuevo_Emp.php">
		<label for="numero_emp">Numero de Empleado:</label>
		<input class="form-control" name="num_emp" required type="text" id="num_emp" placeholder="Teclea el Número de Empleado" required>
		<br>
		<label for="numero_emp">Nombre Completo:</label>
		<input class="form-control" name="nombre" required type="text" id="nombre" placeholder="Teclea el Nombre Completo" required>
		<br>
		<label for="Rol_name">Rol:</label>
		<select name="Rol" id="Rol" class="form-control" required>
		  <option value="0">--------</option>
		  <option value="CH">Chofer</option>
		  <option value="CA">Cargador</option>
		  <option value="Aux">Auxiliar</option>
		</select>
		<br><br><input class="btn btn-info" type="submit" value="Registrar">
	</form>
</div>
<div class="col-xs-12">
<br>
<?php

$Encabezado = "<h1 align='center'>Reporte</h1><br> 
			<table class='table table-bordered'>
				<thead>
					<tr align='center'>
						<td>Editar</td>
						<td>#Empleado</td>
						<td>Nombre_Completo</td>
						<td>Rol</td>
					</tr>
				</thead>
				<tbody>";
	$Cuerpotbl = "";
	if(!empty($cat))
	{
		foreach ($cat as $employer) 
		{
			$Cuerpotbl .= "<tr align='center'>";
			$Cuerpotbl .= "<td><a href='Edita_View_Emp.php?Llave=".$employer['NumeroEmp']."'><button class='btn btn-xs btn-warning'><span class='glyphicon glyphicon-pencil'></span></button></a></td>";
			$Cuerpotbl .= "<td>".$employer['NumeroEmp']."</td>
						   <td>".$employer['Nombre_Completo']."</td>
						   <td>".$employer['Rol']."</td>";
			$Cuerpotbl .= "</tr>";
		}
	 echo $Encabezado.$Cuerpotbl."</table>";
	}
?>
</div>