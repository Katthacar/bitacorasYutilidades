<?php
require_once("ftpClass.php");

//definiendo datos de conexión al servidor FTP //FTP privada: 10.6.6.13
//$serv = "10.6.6.13";
//$user = "amerika";
//$pass = "amerikaFTP01-";

//$serv = "190.131.213.242";antigua ip pública
//$user = "amksoporte";
//$pass = "Soporte01*";

$serv = "181.52.121.35";//"190.131.208.36";
$user = "amerika";
$pass = "amerikaFTP01-";

$ftp = new FTPClient($serv, $user, $pass);
$ftp->connect($serv, $user, $pass);
$arrayMensajes = $ftp->getMessages();

//nombre de directorio es nombre del cliente
$carpeta = $_SESSION['userCode'];

//mostrando directorio
//cambiamos al directorio
$directorio = 'Clientes_AmerikaTi/solicitudes/'.$carpeta.'/';
$ftp->changeDir($directorio);

//obtenemos el contenido
$contentsArray = $ftp->getDirListing();

//Si no existen carpetas en el directorio muestra un msj de la situación
if($ftp->msjVacio($serv, $contentsArray, $directorio, $user, $pass)){
	echo $serv."-".$contentsArray."-".$directorio."".$carpeta;
	echo '<center><h3>No tiene soluciones para revisar</h3></center>';
}else{
//subtítulo de la página
echo '<br/>';
//echo '<div id="main">';
?>
	<span>
		<h3>Agilize la b&uacute;squeda de su soluci&oacute;n presionando "ctrl + f", se abrirá un cuadro de b&uacute;squeda,
		<br/>escriba la soluci&oacute;n que necesita... las coincidencias se iran resaltando.</h3>
	</span>
<div id="selector">
<?php
echo '<ul>';

//invocando llamada al método que pinta árbol de directorios
$ftp->listAllTree($serv, $contentsArray, $directorio, $user, $pass);

echo '</ul>';
}
?>
</div>