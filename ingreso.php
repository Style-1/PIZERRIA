<?php 
include("conexion.php");

$usu = $_POST['usuario'];
$clav = $_POST['clave'];

$sql = "SELECT * FROM TBUSUARIOS WHERE USUARIO='$usu' AND CLAVE='$clav'";
$resultado = mysqli_query($con, $sql);

if (mysqli_num_rows($resultado) > 0) {
    header("Location: zona_pedidos.php");
    exit;
} else {
    header("Location: login.php");
    exit;
}
?>
