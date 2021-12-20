<!DOCTYPE html>
<?php
    session_start();
    if (isset($_SESSION['email_admin']))
    {
    
    
        include_once '../services/sala.php';
        include_once '../services/mesa.php';
        include_once '../services/connection.php';
?>
        
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Salas</title>
    <!-- librerias-->
    <script type="text/javascript" src="../js/jquery.js"></script><!-- jquery-->
    <!-- <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/js-cookie@2.2.0/src/js.cookie.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script><!-- sweetalert-->
    <script type="text/javascript" src="../js/iconos_g.js"></script><!-- iconos FontAwesome-->
    <script type="text/javascript" src="../js/js.js"></script>
    <link rel="icon" type="image/png" href="../img/icon.png">
    <link rel="stylesheet" href="../css/style.css">
</head>
<?php
     $num_salas=$pdo->prepare("SELECT COUNT(*) FROM `tbl_sala`");
     $num_salas->execute();
     $num_salas = $num_salas->fetch(PDO::FETCH_NUM);

     $cant_mesas=$pdo->prepare("SELECT COUNT(*) FROM `tbl_mesa`");
     $cant_mesas->execute();
     $cant_mesas = $cant_mesas->fetch(PDO::FETCH_NUM);

     $cant_total=$pdo->prepare("SELECT SUM(capacidad_sal) FROM `tbl_sala`");
     $cant_total->execute();
     $cant_total = $cant_total->fetch(PDO::FETCH_NUM);


     $usu_admin=$pdo->prepare("SELECT COUNT(*) FROM `tbl_usuario` WHERE tipo_use='Admin'");
     $usu_admin->execute();
     $usu_admin = $usu_admin->fetch(PDO::FETCH_NUM);

     $usu_cam=$pdo->prepare("SELECT COUNT(*) FROM `tbl_usuario` WHERE tipo_use='Camarero'");
     $usu_cam->execute();
     $usu_cam = $usu_cam->fetch(PDO::FETCH_NUM);
     
     $usu_total=$pdo->prepare("SELECT COUNT(*) FROM `tbl_usuario`");
     $usu_total->execute();
     $usu_total = $usu_total->fetch(PDO::FETCH_NUM);
?>
<body class="admin">
    <div class="logout"><a href="../services/kill-login.php"><i class="fas fa-user-circle"></i></a></div>
    <div class="atras"><a href="admin.php"><i class="far fa-arrow-alt-square-left"></i></a></div>
    <div class="recursos"><h1>No lo he hecho xd &#128526;</h1><small>No me ha dado tiempo &#128532;</small></div>
</body>
</html>


<?php
}else
{
    header("Location:../view/login.php");
}

?>