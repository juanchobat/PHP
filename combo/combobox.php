<?php
include 'config.inc.php';

if ($_GET[buscar]=="hijos")
{
	$consulta="SELECT
pmn_authors.nombre_rh,
pmn_authors.a_paterno_rh,
pmn_authors.a_materno_rh,
pmn_authors.puestos_rh,
pmn_sis_datos_contratacion_empleados.id_empleados_datos_contratacion_empleados,
pmn_sis_datos_contratacion_empleados.id_sucursal_datos_contratacion_empleados,
pmn_sis_datos_contratacion_empleados.id_puesto_datos_contratacion_empleados,
pmn_authors.aid
FROM
pmn_authors
INNER JOIN pmn_sis_datos_contratacion_empleados ON pmn_sis_datos_contratacion_empleados.id_empleados_datos_contratacion_empleados = pmn_authors.aid WHERE id_sucursal_datos_contratacion_empleados='".mysql_real_escape_string(intval($_GET["idpadre"]))."' AND pmn_sis_datos_contratacion_empleados.id_puesto_datos_contratacion_empleados = '5'order by nombre_rh";
	mysql_select_db($dbname);
	$todos=mysql_query($consulta);
	
	// Comienzo a imprimir el select
	echo "<select name='idhijo' id='idhijo'>";
	echo "<option value=''>Selecciona un Abogado...</option>";
	while($registro=mysql_fetch_array($todos))
	{
		// Convierto los caracteres conflictivos a sus entidades HTML correspondientes para su correcta visualizacion
		// Imprimo las opciones del select
		echo "<option value='".$registro["aid"]."'";
		if ($registro["aid"]==$valoractual) echo " selected";
		echo ">".utf8_encode($registro["nombre_rh"])." ".utf8_encode($registro["a_paterno_rh"])." ".utf8_encode($registro["a_materno_rh"])."</option>";
	}
	echo "</select>";
}


?>