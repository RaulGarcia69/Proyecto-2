<?php
include '../services/connection.php';

$user=$_POST['user'];

$stmt=$pdo->prepare("DELETE FROM tbl_usuario WHERE tbl_usuario.id_use=?");
$stmt->bindParam(1, $user);
$stmt->execute();

header("Location:../View/users.admin.php");