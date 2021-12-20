<!DOCTYPE html>
<?php include_once '../services/connection.php';?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mesas</title>
    <!-- librerias-->
    <script type="text/javascript" src="../js/jquery.js"></script><!-- jquery-->
    <!-- <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/js-cookie@2.2.0/src/js.cookie.min.js"></script><!-- cookie-->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script><!-- sweetalert-->
    <script type="text/javascript" src="../js/iconos_g.js"></script><!-- iconos FontAwesome-->
    <script type="text/javascript" src="../js/js.js"></script>
    <link rel="icon" type="image/png" href="../img/icon.png">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body class="historial">
        <div class="atras"><a href="menu.php?ahora=1"><i class="far fa-arrow-alt-square-left"></i></a></div>
        <div class="logout"><a href="../services/kill-login.php"><i class="fas fa-user-circle"></i></a></div>
<?php 
    $reserva=$pdo->prepare("SELECT r.id_res, r.horaIni_res, r.horaFin_res, r.datos_res, u.nombre_use, m.id_mes, s.nombre_sal
    FROM tbl_reserva r
    INNER JOIN tbl_usuario u ON r.id_use_fk=u.id_use 
    INNER JOIN tbl_mesa m ON r.id_mes_fk=m.id_mes
    INNER JOIN tbl_sala s ON m.id_sal_fk=s.id_sal;");
    $reserva->execute();
    $data = $reserva->fetchAll(PDO::FETCH_ASSOC);
?>
    
    
<div class="region-historial flex-cv">

        <table class="table-reservas">
        <thead>
            <tr><form action="./historial.php" method="POST">
                <th><input type="date" id="" name="horaIni_res" placeholder="Hora"></th>
                <th><input type="date" id="" value="" name="horaFin_res" placeholder="Hora"></th>
                <th><input type="text" id="" name="datos_res" placeholder="Nombre reserva"></th>
                <th><select name='nombre_use' value=''>
                <option value=''>Todos</option>
            <?php 
                $salas=$pdo->prepare("SELECT nombre_use FROM tbl_usuario where tipo_use = 'Camarero'");
                $salas->execute();
                $data = $salas->fetchAll(PDO::FETCH_ASSOC);
                foreach ($data as $reg) {
            ?>
                <option value="<?php echo $reg['nombre_use'];?>"><?php echo $reg['nombre_use'];?></option>
            <?php } ?>
            </select></th>
                <th><input type="number" id="" name="id_mes" placeholder="Número de mesa"></th>
                <th><select name='nombre_sal' value=''>
                <option value=''>Todos</option>
            <?php 
                $salas=$pdo->prepare("SELECT nombre_sal FROM tbl_sala GROUP BY nombre_sal");
                $salas->execute();
                $data = $salas->fetchAll(PDO::FETCH_ASSOC);
                foreach ($data as $reg) {
            ?>
                <option value="<?php echo $reg['nombre_sal'];?>"><?php echo $reg['nombre_sal'];?></option>
            <?php } ?>
            </select></th>
            <th><input class="boton-filtro" type="submit" value="Filtrar"></th>

                </form></tr>
<?php
    $queryGeneral = "SELECT r.id_res, r.horaIni_res, r.horaFin_res, r.datos_res, u.nombre_use, m.id_mes, s.nombre_sal
    FROM tbl_reserva r
    INNER JOIN tbl_usuario u ON r.id_use_fk=u.id_use 
    INNER JOIN tbl_mesa m ON r.id_mes_fk=m.id_mes
    INNER JOIN tbl_sala s ON m.id_sal_fk=s.id_sal WHERE id_res LIKE '%%'";


    if(isset($_POST['horaIni_res'])){
        $horaIni_res = $_POST['horaIni_res'];
        $queryhoraIni = "AND r.horaIni_res LIKE '%$horaIni_res%'";
        $queryGeneral = $queryGeneral.$queryhoraIni;
    }

    if(!empty($_POST['horaFin_res'])){//hacerlo con addtime
        $horaFin_res = $_POST['horaFin_res'];
        $queryhoraFin = "AND r.horaFin_res LIKE '%$horaFin_res%'";
        $queryGeneral = $queryGeneral.$queryhoraFin;
    }

    if(isset($_POST['datos_res'])){
        $datos_res = $_POST['datos_res'];
        $querydatos_res = "AND r.datos_res LIKE '%$datos_res%'";
        $queryGeneral = $queryGeneral.$querydatos_res;
    }

    if(isset($_POST['nombre_use'])){
        $nombre_use = $_POST['nombre_use'];
        $querynombreuse = "AND u.nombre_use LIKE '%$nombre_use%'";
        $queryGeneral = $queryGeneral.$querynombreuse;
    }

    if(isset($_POST['id_mes'])){
        $id_mes = $_POST['id_mes'];
        $queryidmes = "AND m.id_mes LIKE '%$id_mes%'";
        $queryGeneral = $queryGeneral.$queryidmes;
    }

    if(isset($_POST['nombre_sal'])){
        $nombre_sal = $_POST['nombre_sal'];
        $querynombresal = "AND s.nombre_sal LIKE '%$nombre_sal%'";
        $queryGeneral = $queryGeneral.$querynombresal;
    }
        $orderby=" order by horaIni_res desc";
        $queryGeneral = $queryGeneral.$orderby;
        $reserva=$pdo->prepare($queryGeneral);
        $reserva->execute();
        $data = $reserva->fetchAll(PDO::FETCH_ASSOC);
?>
                <tr>
                    <th>Inicio</th>
                    <th>Final</th>
                    <th>Nombre reserva</th>
                    <th>Responsable reserva</th>
                    <th>Mesa</th>
                    <th>Sala</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data as $datas) { ?>
                <tr>
                    <td><?php echo $datas['horaIni_res'] ?></td>
                    <td><?php echo $datas['horaFin_res'] ?></td>
                    <td><?php echo $datas['datos_res'] ?></td>
                    <td><?php echo $datas['nombre_use'] ?></td>
                    <td><?php echo $datas['id_mes'] ?></td>
                    <td><?php echo $datas['nombre_sal'] ?></td>
                    <td></td>
                </tr>

                <?php } ?>
            </tbody>
        </table>
  
    
</div>
<div class="overlay" id="overlay">
<div class="abrirFiltro" id="abrirFiltro">
            <div class="popup" id="popup">
                <a href="#" id="btn-cerrar-popup" class="btn-cerrarPop"><i class="fas fa-times"></i></a>
                <h3>Reservar mesa</h3>
                <form METHOD='POST' class="crearReserva" action="../services/reservar-mesa.php">
                    <input type="hidden" id="idMesa" class="idMesa" name="idMesa">
                    <label for="nombre">Nombre de la reserva</label>
                    <input type="text" id="nombre" name="nombre">

                    <input type="submit" value="Reservar" class="btn">
                </form>
            </div>
        </div>
</div>
</body>
</html>

<div class="hide">
<form action="./historial.php" method="POST">
        <p>Hora de reserva:</p> 
            <input type="date" id="" name="horaIni_res" placeholder="Hora"><br>
        <p>Hora fin reserva:</p> 
            <input type="date" id="" name="horaFin_res" placeholder="Hora"><br><br>
        <p>Mesa:</p>
            <input type="number" id="" name="id_mes" placeholder="Número de mesa"><br><br>
            <label for='seleccion-sala'>Sala:</label>
            <select name='nombre_sal' value=''>
                <option value=''>Todos</option>
            <?php 
                $salas=$pdo->prepare("SELECT nombre_sal FROM tbl_sala GROUP BY nombre_sal");
                $salas->execute();
                $data = $salas->fetchAll(PDO::FETCH_ASSOC);
                foreach ($data as $reg) {
            ?>
                <option value="<?php echo $reg['nombre_sal'];?>"><?php echo $reg['nombre_sal'];?></option>
            <?php } ?>
            </select>
            
        <input type="submit" value="Filtrar"><br>
    </form>

    </div>