<?php
session_start();
if (isset($_SESSION['email']))
{
include '../services/connection.php';
include '../services/reserva.php';
include '../services/mesa.php';
$mesa = $_POST['idMesa'];




$stmt=$pdo->prepare("UPDATE `tbl_reserva` SET `horaFin_res` = NOW() WHERE tbl_reserva.id_mes_fk = ? and tbl_reserva.horaFin_res is null");
$stmt->bindParam(1, $mesa);
$stmt->execute();



$stmt2=$pdo->prepare("UPDATE `tbl_mesa` SET `status_mes` = 'Libre' WHERE `tbl_mesa`.`id_mes` = ?");
$stmt2->bindParam(1, $mesa);
$stmt2->execute();




//redirigir al sala.php desde donde se envio
header("Location:../View/sala.php");
}else
{
    header("Location:../view/login.php");
}
