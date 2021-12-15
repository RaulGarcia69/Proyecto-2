<?php
include_once '../services/connection.php';
$username = $_POST['username'];
$password = $_POST['password'];

$password = md5($password);

$stmt=$pdo->prepare("SELECT * FROM `tbl_usuario` WHERE pwd_use=? and email_use=?");
$stmt->bindParam(1, $password);
$stmt->bindParam(2, $username);


$stmt->execute();

$stmt=$stmt->fetchAll(PDO::FETCH_ASSOC);
$num=count($stmt);

try {
    if ($num==1)
    {
        session_start();
        
        foreach($stmt as $stmt)
        {
            if ($stmt['tipo_use']=="Admin")
            {
                $_SESSION['email_admin']=$username;
                header("Location:../view/admin.php");
            }
            else {
                $_SESSION['email']=$username;
                header("Location:../view/menu.php?ahora=1");
            }
        }
    }
    else {
        header("Location:../view/login.php");
    }
}catch(PDOException $e){
    header("Location:../view/login.php");
 }

