<?php
/*Pagina para actualizar datos del empleado.*/
include('menu_empleados.php');
include ('../Controller/Emp_Controlador.php');
 $ctrl_emp = new Empleado();
 $Arreglo = "";
 if(isset($_GET['Llave'])){
	 $Arreglo = $ctrl_emp->Get_Emp($_GET['Llave']);
	 $Numero = "";
	 $Nombre = "";
	 $Rol= "";
	 $Mes = "";
	 $Cantidad_Entregas = "";
	 foreach ($Arreglo as $employer){
		$Numero = $employer['NumeroEmp'];
		$Nombre = $employer['Nombre_Completo'];
		$Rol = $employer['Rol'];
		$IdRol = $employer['IdRol'];
?>
	<div class="col-xs-12">
		<h1>Edita - Empleados</h1>
		<form method="post" action="../Model/Edita_Emp.php">
			<label for="numero_emp">Numero de Empleado:</label>
			<input class="form-control" name="num_emp" required type="text" id="num_emp" placeholder="Teclea el Número de Empleado" required value="<?php echo $Numero; ?>">
			<br>
		<!--<label for="numero_emp">Nombre Completo:</label>-->
		<input class="form-control" name="Nombre_Completo" required type="hidden" id="Nombre_Completo" placeholder="Nombre">
		
		<!--<label for="Rol_name">Rol:</label>-->
		<input class="form-control" name="Rol" required type="hidden" id="Rol" placeholder="Rol">
		
			<label for="Rol_name">Rol:</label>
			<select name="Rol" id="Rol" class="form-control" required>
			<option value="<?php echo $IdRol; ?>" selected><?php echo $Rol; ?></option>
			  <option value="0">--------</option>
			  <option value="CH">Chofer</option>
			  <option value="CA">Cargador</option>
			  <option value="Aux">Auxiliar</option>
			</select>
			<br><br><input class="btn btn-info" type="submit" value="Actualizar">
		</form>
	</div>
<?php
	 }
 }
?>