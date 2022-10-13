<?php
/*Reporte global sobre la nomina total de cada empleado activo.*/
 include('menu_empleados.php');
 include ('../Controller/Mov_Controlador.php');
 $ctrl_mov = new Movimientos();
 $cat_mov = $ctrl_mov->Reporte_Mov();
?>
<?php

$Encabezado = "<h1 align='center'>Reporte</h1><br> 
			<table class='table table-bordered'>
				<thead>
					<tr align='center'>
						<td>#_Empleado</td>
						<td>Nombre_Completo</td>
						<td>Mes</td>
						<td>Rol</td>
						<td>Horas_Trabajadas</td>
						<td>Pago_Total_Entregas</td>
						<td>Pago_Total_Bonos</td>
						<td>Retenciones</td>
						<td>Vales</td>
						<td>Sueldo_Total</td>
					</tr>
				</thead>
				<tbody>";
	$Cuerpotbl = "";
	if(!empty($cat_mov))
	{
		foreach ($cat_mov as $employer) 
		{
			$Cuerpotbl .= "<tr align='center'>";
			$Cuerpotbl .= "<td>".$employer['#_Empleado']."</td>
						   <td>".$employer['Nombre_Completo']."</td>
						   <td>".$employer['Mes']."</td>
						   <td>".$employer['Rol']."</td>
						   <td>".$employer['Horas_Trabajadas']."</td>
						   <td>".$employer['Pago_Total_Entregas']."</td>
						   <td>".$employer['Pago_Total_Bonos']."</td>
						   <td>".$employer['Retenciones']."</td>
						   <td>".$employer['Vales']."</td>
						   <td>".$employer['Sueldo_Total']."</td>";
			$Cuerpotbl .= "</tr>";
		}
	 echo $Encabezado.$Cuerpotbl."</table>";
	}
?>