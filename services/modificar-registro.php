<?php

session_start();
if (isset($_SESSION['email']))
{
include '../services/connection.php';
include '../services/reserva.php';

$nombre = $_POST['nombre'];
$registro = $_POST['registro'];





$stmt=$pdo->prepare("UPDATE `tbl_reserva` SET `datos_res` = ? WHERE `tbl_reserva`.`id_res` = ?");
$stmt->bindParam(1, $nombre);
$stmt->bindParam(2, $registro);
$stmt->execute();

//redirigir al sala.php desde donde se envio

header("Location:../View/sala.php");
}else
{
    header("Location:../view/login.php");
}
