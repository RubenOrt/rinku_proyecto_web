<?php
/*Se crea el menu bar para activar la navegacion entre los módulos del sistema.*/
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Rinku - Empresa Cinematográfica</title>
	<link rel="stylesheet" href="../assets/css/fontawesome-all.min.css">
	<link rel="stylesheet" href="../assets/css/2.css">
	<link rel="stylesheet" href="../assets/css/estilo.css">
	<!--<script type="text/javascript" src="../assets/js/funciones_js.js"></script>-->
</head>
<body>
	<nav class="navbar navbar-inverse navbar-fixed-top">
		<div class="container">
			<div class="navbar-header">
				<a class="navbar-brand" href="#">RINKU</a><img src='../assets/img/rinku.png' height="50px" width="150px"/>
			</div>
			<div id="navbar" class="collapse navbar-collapse">
				<ul class="nav navbar-nav">
					<li><a href="./vista_empleados.php">Empleados</a></li>
					<li><a href="./vista_movimientos.php">Movimientos</a></li>
					<li><a href="./vista_reporte.php">Reporte de Nomina</a></li>
				</ul>
			</div>
		</div>
	</nav>
</body>
</html>