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

$idusu=$pdo->prepare("SELECT * from tbl_usuario where tbl_usuario.email_use=?");
$idusu->bindParam(1, $responsable);
$idusu->execute();

$idusu=$idusu->fetchAll(PDO::FETCH_ASSOC);
foreach ($idusu as $idusu) {
    $responsable = $idusu['id_use'];
}

echo $responsable;



$stmt=$pdo->prepare("INSERT INTO `tbl_reserva` (`id_res`, `horaIni_res`, `horaFin_res`, `datos_res`, `id_use_fk`, `id_mes_fk`) VALUES (NULL, NOW(), NULL, ?, ?, ?)");
$stmt->bindParam(1, $nombre);
$stmt->bindParam(2, $responsable);
$stmt->bindParam(3, $mesa);
$stmt->execute();


$stmt2=$pdo->prepare("UPDATE `tbl_mesa` SET `status_mes` = 'Ocupado/Reservado' WHERE `tbl_mesa`.`id_mes` = ?");
$stmt2->bindParam(1, $mesa);
$stmt2->execute();



//redirigir al sala.php desde donde se envio
header("Location:../View/sala.php");
}else
{
    header("Location:../view/login.php");
}
