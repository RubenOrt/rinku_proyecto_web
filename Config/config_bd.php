<?php
/*Pagina Creada para la conexion con la base de datos.*/
class Config_bd
{
	/*Metodo creado para abrir la base de datos.*/
	public function abrir_conexion()
	{
            $enlace = mysql_connect("localhost", "root","");
			if (!$enlace) {
              die('No se pudo conectar: ' . mysql_error());
            } 
            return $enlace;
    }

	/*Metodo creado para cerrar la base de datos.*/
	public function cerrar_conexion($conexion){
		mysql_close($conexion);
	}
	
}
?>