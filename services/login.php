<?php
include_once '../services/connection.php';
$username = $_POST['username'];
$password = $_POST['password'];

$password = md5($password);

$stmt=$pdo->prepare("SELECT * FROM `tbl_usuario` WHERE pwd_use=? and email_use=?");
$stmt->bindParam(1, $password);
$stmt->bindParam(2, $username);


$stmt->execute();

$num=$stmt->fetchAll(PDO::FETCH_ASSOC);
$num=count($num);

try {
    if ($num==1)
    {
        session_start();
        $_SESSION['email']=$username;
        header("Location:../view/menu.php");
    }
    else {
        header("Location:../view/login.php");
    }
}catch(PDOException $e){
    header("Location:../view/login.php");
 }

