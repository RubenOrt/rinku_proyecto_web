<?php
/*Modelo creado para el ingreso de los datos nuevos de los movimientos, validando cada dato importante para no ocasionar algun
ajuste erroneo en los calculos de la nomina.*/
 include ('../Controller/Emp_Controlador.php');
 $ctrl_emp = new Empleado();
 $Numero = "";
 $Nombre_Completo = "";
 $Rol = "";
 
 if(isset($_POST['num_emp']))
 {
	 if($_POST['num_emp'] <> '0')
	 {
		
		$Numero = $_POST['num_emp'];
		
		if(isset($_POST['nombre']))
		 {
			 $Nombre_Completo = $_POST['nombre'];
			 
			 if(isset($_POST['Rol']))
			 {
				 if($_POST['Rol'] <> '0')
				 {
					$Rol = $_POST['Rol'];
					
					$ctrl_emp->Alta_Emp($Numero,$Nombre_Completo,$Rol);
					$empleados = $ctrl_emp->Lista_Emp();
					header('Location: ../View/vista_empleados.php');
				 }
				 else
				 {
					 echo '<script type="text/JavaScript"> alert("Elige un Rol."); </script>';
					 header('Location: ../View/vista_empleados.php');
				 }
			 }
		 }
		 else
		 {
			 echo '<script type="text/JavaScript"> alert("Teclea de favor el nombre completo."); </script>';
			 header('Location: ../View/vista_empleados.php');
		 }
	 }
	 else
	 {
		 echo '<script type="text/JavaScript"> alert("Numero de empleado no existente."); </script>';
		 header('Location: ../View/vista_empleados.php');
	 }
 }
?>