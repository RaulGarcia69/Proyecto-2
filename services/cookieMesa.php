<?php
session_start();
if (isset($_SESSION['email']))
{
if(isset($_POST["enviar"])){
$idsala = $_POST['hiddensala'];
$sala="sala".$idsala;
$fecha_reserva=$_POST['fechareserva'];
$hora=$_POST['horareserva'];
$fecha=$_POST['fecha'];

setcookie("idsala", "", time() - 3153600000, "/");
setCookie('idsala', "$idsala", time()+30000, "/");
setcookie("sala", "", time() - 3153600000, "/");
setCookie('sala', "$sala", time()+30000, "/");
setcookie("fecha_reserva", "", time() - 3153600000, "/");
setCookie('fecha_reserva', "$fecha_reserva", time()+30000, "/");
setcookie("hora", "", time() - 3153600000, "/");
setCookie('hora', "$hora", time()+30000, "/");
setcookie("fecha", "", time() - 3153600000, "/");
setCookie('fecha', "$fecha", time()+30000, "/");
header("Location:../view/sala.php");
}else{
    header("Location:../view/menu.php");

}
}else
{
    header("Location:../view/login.php");
}
?>