<?php
/*Modelo creado para el ingreso de los datos nuevos de los movimientos, validando cada dato importante para no ocasionar algun
ajuste erroneo en los calculos de la nomina.*/
 include ('../Controller/Mov_Controlador.php');
 $ctrl_mov = new Movimientos();
 
 $Numero = "";
 $Nombre = "";
 $Rol= "";
 $Mes = "";
 $Cantidad_Entregas = "";
 $IdMovimiento = "";
if(isset($_POST['Numero']))
{ 
	if($_POST['Numero'] <> '0')
	 {
		$Numero = $_POST['Numero']; 
		
		if(isset($_POST['Nombre_Completo']) && isset($_POST['Rol']))
		{
			if($_POST['Nombre_Completo'] <> 'N/A' && $_POST['Rol'] <> 'N/A')
			{
			   $Nombre = $_POST['Nombre_Completo'];
			   $Rol = $_POST['Rol'];
			   
			   if(isset($_POST['Mes']))
			   {
				   if($_POST['Mes'] <> '0')
				   {
					   $Mes = $_POST['Mes'];
					   
					   if(isset($_POST['Cantidad_Entregas']))
					   {
						   if($_POST['Cantidad_Entregas'] <> '0')
						   {
							   $Cantidad_Entregas = $_POST['Cantidad_Entregas'];
							   $IdMovimiento = $_POST['IdMovimiento'];
							   $ctrl_mov->Edita_Mov($Numero,$Nombre,$Rol,$Mes,$Cantidad_Entregas,$IdMovimiento);
							   header('Location: ../View/vista_movimientos.php');
						   }
					   }
				   }
			   }
			   else{
				   echo '<script type="text/JavaScript"> alert("Capturar el mes correctamente."); </script>';
			       header('Location: ../View/vista_movimientos.php');
			   }
			}
			else
			{
				 echo '<script type="text/JavaScript"> alert("Numero de empleado no existente."); </script>';
			     header('Location: ../View/vista_movimientos.php');
			}
		}
		else
		{
			echo '<script type="text/JavaScript"> alert("Numero de empleado no existente."); </script>';
			header('Location: ../View/vista_movimientos.php');
		}
	 }
	 else 
	 {
		 echo '<script type="text/JavaScript"> alert("Numero de empleado no existente."); </script>';
		 header('Location: ../View/vista_movimientos.php');
	 }
}
?>