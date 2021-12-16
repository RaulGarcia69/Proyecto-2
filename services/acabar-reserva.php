<?php
session_start();
if (isset($_SESSION['email']))
{
include '../services/connection.php';
include '../services/reserva.php';
include '../services/mesa.php';
$mesa = $_POST['idMesa'];
$fecha = $_POST['fecha'];

$cancelar_reserva=$pdo->prepare("SELECT * from tbl_mesa INNER JOIN tbl_reserva on tbl_mesa.id_mes=tbl_reserva.id_mes_fk WHERE tbl_reserva.horaIni_res>? and tbl_mesa.id_mes=?");
$cancelar_reserva->bindParam(1, $fecha);
$cancelar_reserva->bindParam(2, $mesa);
$cancelar_reserva->execute();
$cancelar_reserva=$cancelar_reserva->fetchAll(PDO::FETCH_ASSOC);
$num=count($cancelar_reserva);
if($num==1)
{
    $stmt=$pdo->prepare("DELETE FROM tbl_reserva WHERE tbl_reserva.id_mes_fk=?");
    $stmt->bindParam(1, $mesa);
    $stmt->execute();
}
else {
    $stmt2=$pdo->prepare("UPDATE `tbl_reserva` SET `horaFin_res` = NOW() WHERE tbl_reserva.id_mes_fk = ?");
    $stmt2->bindParam(1, $mesa);
    $stmt2->execute();
}





//redirigir al sala.php desde donde se envio
header("Location:../View/sala.php");
}else
{
    header("Location:../view/login.php");
}
