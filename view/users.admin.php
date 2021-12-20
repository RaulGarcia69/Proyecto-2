<!DOCTYPE html>
<?php include_once '../services/connection.php';?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>
    <!-- librerias-->
    <script type="text/javascript" src="../js/jquery.js"></script><!-- jquery-->
    <!-- <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/js-cookie@2.2.0/src/js.cookie.min.js"></script><!-- cookie-->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script><!-- sweetalert-->
    <script type="text/javascript" src="../js/iconos_g.js"></script><!-- iconos FontAwesome-->
    <script type="text/javascript" src="../js/js.js"></script>
    <link rel="icon" type="image/png" href="../img/icon.png">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../css/style.css">
</head>

<body class="historial">
        <div class="atras"><a href="admin.php"><i class="far fa-arrow-alt-square-left"></i></a></div>
        <div class="logout"><a href="../services/kill-login.php"><i class="fas fa-user-circle"></i></a></div>
    
    
<div class="region-historial flex-cv">

        <table class="table-reservas">
        <thead>
            <tr><form action="./users.admin.php" method="POST">
                <th><input type="text" id="" name="nombre_use" placeholder="Nombre"></th>
                <th><input type="text" id="" name="email_use" placeholder="Email"></th>
                <th><select name='tipo_use' value=''>
                <option value=''>Todos</option>
            <?php 
                $tipo_use=$pdo->prepare("SELECT tipo_use FROM tbl_usuario GROUP BY tipo_use");
                $tipo_use->execute();
                $data = $tipo_use->fetchAll(PDO::FETCH_ASSOC);
                foreach ($data as $reg) {
            ?>
                <option value="<?php echo $reg['tipo_use'];?>"><?php echo $reg['tipo_use'];?></option>
            <?php } ?>
            </select></th>
            <th><input class="boton-filtro" type="submit" value="Filtrar"></th>
            </form>
            <th><button class="boton-filtro btn-abrirPop">Crear</button></th>
        </tr>
<?php
    $queryGeneral = "SELECT * FROM `tbl_usuario` WHERE id_use LIKE '%%'";


    if(isset($_POST['nombre_use'])){
        $nombre_use = $_POST['nombre_use'];
        $querynombre = "AND nombre_use LIKE '%$nombre_use%'";
        $queryGeneral = $queryGeneral.$querynombre;
    }

    if(isset($_POST['email_use'])){
        $email_use = $_POST['email_use'];
        $queryemail = "AND email_use LIKE '%$email_use%'";
        $queryGeneral = $queryGeneral.$queryemail;
    }

    if(isset($_POST['tipo_use'])){
        $tipo_use = $_POST['tipo_use'];
        $queryuse = "AND tipo_use LIKE '%$tipo_use%'";
        $queryGeneral = $queryGeneral.$queryuse;
    }

        $orderby=" order by tipo_use";
        $queryGeneral = $queryGeneral.$orderby;

        $reserva=$pdo->prepare($queryGeneral);
        $reserva->execute();
        $data = $reserva->fetchAll(PDO::FETCH_ASSOC);
?>
                <tr>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Tipo</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data as $datas) { ?>
                <tr>
                    <td><?php echo $datas['nombre_use'] ?></td>
                    <td><?php echo $datas['email_use'] ?></td>
                    <td><?php echo $datas['tipo_use'] ?></td>
                    <td></td>
                    <form action="../services/eliminar.user.php" method="post">
                        <input type="hidden" name="user" value="<?php echo $datas['id_use'] ?>">
                        <td><button class="btn btn-danger" type="submit">Eliminar</button></td>
                    </form>
                </tr>

                <?php } ?>
            </tbody>
        </table>
  
    
</div>
<div class="overlay" id="overlay">
        <div class="crear-user" id="crear-user">
            <div class="popup" id="popup">
                <a href="#" id="btn-cerrar-popup" class="btn-cerrarPop"><i class="fas fa-times"></i></a>
                <h3>Crear usuario</h3>
                <form METHOD='POST' class="crearReserva" action="../services/crear.user.php">
                    <label for="nombre">Nombre de usuario</label>
                    <input type="text" name="nombre">
                    <label for="email">Email de usuario</label>
                    <input type="text" name="email">
                    <label for="contra">Contraseña de usuario</label>
                    <input type="password" name="contra">
                    <label for="email">Tipo de usuario</label>
                    <select name="tipo">
                    <option value="camarero">Camarero</option>
                    <option value="admin">Admin</option>
                    <option value="mantenimineto">Mantenimineto</option>
                    </select>
                    <input type="submit" value="Crear" class="btn">
                </form>
            </div>
        </div>

    </div>