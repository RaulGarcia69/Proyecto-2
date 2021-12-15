<?php


session_start();
if (isset($_SESSION['email']))
{
include '../services/connection.php';
include '../services/reserva.php';
include '../services/mesa.php';

$nombre = $_POST['nombre'];
$responsable = $_SESSION['email'];
$mesa = $_POST['idMesa'];
$fecha_ini = $_POST['fecha_ini'];
$fecha_fin = $_POST['fecha_fin'];
$hora_fin = $_POST['hora_fin'];

$fecha_fin=$fecha_fin." ".$hora_fin;

$idusu=$pdo->prepare("SELECT * from tbl_usuario where tbl_usuario.email_use=?");
$idusu->bindParam(1, $responsable);
$idusu->execute();

$idusu=$idusu->fetchAll(PDO::FETCH_ASSOC);
foreach ($idusu as $idusu) {
    $responsable = $idusu['id_use'];
}

echo $responsable;



$stmt=$pdo->prepare("INSERT INTO `tbl_reserva` (`id_res`, `horaIni_res`, `horaFin_res`, `datos_res`, `id_use_fk`, `id_mes_fk`) VALUES (NULL, ?, ?, ?, ?, ?)");
$stmt->bindParam(1, $fecha_ini);
$stmt->bindParam(2, $fecha_fin);
$stmt->bindParam(3, $nombre);
$stmt->bindParam(4, $responsable);
$stmt->bindParam(5, $mesa);
$stmt->execute();






//redirigir al sala.php desde donde se envio
header("Location:../View/sala.php");
}else
{
    header("Location:../view/login.php");
}
