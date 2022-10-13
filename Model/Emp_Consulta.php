<?php
if (!empty($_POST['c'])) {
        $num_emp = $_POST['c'];
		
	  include ('../Controller/Emp_Controlador.php');
      $ctrl_emp = new Empleado();
	  echo $ctrl_emp->GetEmp($num_emp);	
}
?>