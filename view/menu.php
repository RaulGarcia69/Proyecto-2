<!DOCTYPE html>
<?php
    session_start();
    if (isset($_SESSION['email']))
    {
    
    
        include_once '../services/sala.php';
        include_once '../services/mesa.php';
        include_once '../services/connection.php';
        $salas=$pdo->prepare("SELECT * from tbl_sala");
        $salas->execute();
        $salas=$salas->fetchAll(PDO::FETCH_ASSOC);
        $date = date('Y-m-d');
        $hour = date('H:i:s');

        if (isset($_REQUEST['day']) and isset($_REQUEST['hour']))
        {
            $fecha = $_REQUEST['day'];
            $hora = $_REQUEST['hour'];
        }
        else {
            $fecha=$date;
            $hora=$hour;
        }
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
<body class="menu">
        <div class="fechas-menu">
            <div class="fecha-div <?php if($fecha==date('Y-m-d', strtotime($date. ' + 0 days'))){echo "fecha-selected";} ?>"><a class="fecha-boton" href="menu.php?day=<?php echo date('Y-m-d', strtotime($date. ' + 0 days')); ?>&hour=<?php echo $hora; ?>"><?php echo date('Y/m/d', strtotime($date. ' + 0 days')); ?></a></div>
            <div class="fecha-div <?php if($fecha==date('Y-m-d', strtotime($date. ' + 1 days'))){echo "fecha-selected";} ?>"><a class="fecha-boton" href="menu.php?day=<?php echo date('Y-m-d', strtotime($date. ' + 1 days')); ?>&hour=<?php echo $hora; ?>"><?php echo date('Y/m/d', strtotime($date. ' + 1 days')); ?></a></div>
            <div class="fecha-div <?php if($fecha==date('Y-m-d', strtotime($date. ' + 2 days'))){echo "fecha-selected";} ?>"><a class="fecha-boton" href="menu.php?day=<?php echo date('Y-m-d', strtotime($date. ' + 2 days')); ?>&hour=<?php echo $hora; ?>"><?php echo date('Y/m/d', strtotime($date. ' + 2 days')); ?></a></div>
            <div class="fecha-div <?php if($fecha==date('Y-m-d', strtotime($date. ' + 3 days'))){echo "fecha-selected";} ?>"> <a class="fecha-boton" href="menu.php?day=<?php echo date('Y-m-d', strtotime($date. ' + 3 days')); ?>&hour=<?php echo $hora; ?>"><?php echo date('Y/m/d', strtotime($date. ' + 3 days')); ?></a></div>
            <div class="fecha-div <?php if($fecha==date('Y-m-d', strtotime($date. ' + 4 days'))){echo "fecha-selected";} ?>"> <a class="fecha-boton" href="menu.php?day=<?php echo date('Y-m-d', strtotime($date. ' + 4 days')); ?>&hour=<?php echo $hora; ?>"><?php echo date('Y/m/d', strtotime($date. ' + 4 days')); ?></a></div>
        </div>
        <?php
        $horas_bbdd=$pdo->prepare("SELECT * from tbl_horas_reservas");
        $horas_bbdd->execute();
        $horas_bbdd=$horas_bbdd->fetchAll(PDO::FETCH_ASSOC);
        ?>
        <div class="horas-menu">
        <?php
         foreach ($horas_bbdd as $horas_bbdd) {
        ?>

            <div class="hora-div <?php if($hora==$horas_bbdd['hora_hor']) {echo "hora-selected";} ?>"><a class="hora-boton" href="menu.php?day=<?php echo $fecha; ?>&hour=<?php echo $horas_bbdd['hora_hor']; ?>"><?php echo $horas_bbdd['hora_hor']; ?></a></div>
        <?php
         }
        ?>
        </div>
        <div class="ahora"><a class="ahora-boton" href="menu.php?day=<?php echo $fecha; ?>&hour=<?php echo date('H:i:s', strtotime($hour. ' + 0 hours')); ?>">Ahora</a></div>
        
        <div class="logout"><a href="../services/kill-login.php"><i class="fas fa-user-circle"></i></a></div>
   
    <div class="region-salas">
        <div class="grid-salas flex-cv">
        <?php
        foreach ($salas as $salas) {

            $capacidad_libre=$pdo->prepare("SELECT SUM(capacidad_mes) from tbl_mesa where status_mes = 'Libre' && id_sal_fk=?");
            $capacidad_libre->bindParam(1, $salas['id_sal']);
            $capacidad_libre->execute();
            $capacidad_libre = $capacidad_libre->fetch(PDO::FETCH_NUM);


            $mesas_libres=$pdo->prepare("SELECT * from tbl_mesa WHERE status_mes = 'Libre' && id_sal_fk = ?");
            $mesas_libres->bindParam(1, $salas['id_sal']);
            $mesas_libres->execute();
            $mesas_libres=$mesas_libres->fetchAll(PDO::FETCH_ASSOC);


            $mesas_ocupadas=$pdo->prepare("SELECT * from tbl_mesa WHERE status_mes = 'Ocupado/Reservado' && id_sal_fk = ?");
            $mesas_ocupadas->bindParam(1, $salas['id_sal']);
            $mesas_ocupadas->execute();
            $mesas_ocupadas=$mesas_ocupadas->fetchAll(PDO::FETCH_ASSOC);

                ?>
            <div class="sala" >
            <form  method="post" action="../services/cookieMesa.php"><input class="enviar" type="hidden" name="hiddensala" value="<?php echo $salas['id_sal'] ?>"><input name="enviar" type="submit"></form>
                <!-- <a href="sala2.php"></a> -->
                <img src="../media/icons/<?php echo $salas['imagen_sal']?>" alt="">
                <h2 class="nombre-sala"><?php echo $salas['nombre_sal'] ?></h2>
                <table>
                    <tbody>
                        <tr>
                            <th>Capacidad total: </th>
                            <td><?php echo $salas['capacidad_sal'] ?> personas</td>
                        </tr>
                        <tr>
                            <th>Capacidad libre: </th>
                            <td><?php echo  $capacidad_libre[0]?> personas</td>
                        </tr>
                        <tr>
                            <th>Mesas Libres: </th>
                            <td><?php echo count($mesas_libres) ?> mesas</td>
                        </tr>
                        <tr>
                            <th>Mesas ocupadas: </th>
                            <td><?php echo count($mesas_ocupadas) ?> mesas</td>
                        </tr>
                    </tbody>
                    
                </table>
                
            </div>

            <?php 
                    }
            ?>
            <div class="container-absolute">
                <a class="btn-reservas" href="historial.php">Reservas</a>
            </div>
    </div>
    <?php
    }else
    {
        header("Location:../view/login.php");
    }
    ?>
</body>
</html>

