<?php
include '../services/connection.php';

$nombre=$_POST['nombre'];
$email=$_POST['email'];
$contra=$_POST['contra'];
$contra=md5($contra);
$tipo=$_POST['tipo'];


$stmt=$pdo->prepare("INSERT INTO `tbl_usuario` (`id_use`, `nombre_use`, `email_use`, `pwd_use`, `tipo_use`) VALUES (NULL, ?, ?, ?, ?)");
$stmt->bindParam(1, $nombre);
$stmt->bindParam(2, $email);
$stmt->bindParam(3, $contra);
$stmt->bindParam(4, $tipo);
$stmt->execute();

header("Location:../View/users.admin.php");