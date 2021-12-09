<!DOCTYPE html>
<html lang="en">
<head>
</head>

<body>
        <div class="atras"><a href="menu.php"><i class="far fa-arrow-alt-square-left"></i></a></div>
        <div class="logout"><a href="../services/kill-login.php"><i class="fas fa-user"></i></a></div>
    <form action="./reservas.php" method="POST">
        <h1>Búsqueda de reservas</h1>
        <p>Hora de reserva:</p> 
            <input type="date" id="" name="horaIni_res" placeholder="Hora"><br>
        <p>Hora fin reserva:</p> 
            <input type="date" id="" name="horaFin_res" placeholder="Hora"><br><br>

        <?php
            include_once '../services/connection.php';
            $responsable=$pdo->prepare("SELECT nombre_use FROM tbl_usuario");
            $responsable->execute();
            $data = $responsable->fetchAll(PDO::FETCH_ASSOC);
            //Select con opciones de la BBDD
            echo "<label for='seleccion-usuario'>Responsable de reserva:</label><br><br>";
            echo "<select name='nombre_use' value=''>";
            echo "<option value = ''></option>";
                foreach ($data as $reg) {
                    echo "<option value='{$reg['nombre_use']}'>{$reg['nombre_use']}</option>";
                }
            echo "</select><br>"
        ?>

        <p>Mesa:</p>
            <input type="number" id="" name="id_mes" placeholder="Número de mesa"><br><br>

        <?php
            //include '../services/connection.php';
            $salas=$pdo->prepare("SELECT nombre_sal FROM tbl_sala GROUP BY nombre_sal");
            $salas->execute();
            $data = $salas->fetchAll(PDO::FETCH_ASSOC);
            //Select con opciones de la BBDD
            echo "<label for='seleccion-sala'>Sala:</label><br><br>";
            echo "<select name='nombre_sal' value=''>";
            echo "<option value = ''></option>";
                foreach ($data as $reg) {
                    echo "<option value='{$reg['nombre_sal']}'>{$reg['nombre_sal']}</option>";
                }
            echo "</select><br><br>"
        ?>

        <input type="submit" value="Filtrar"><br>
    </form>
    <center>
        <h1>Historial de reservas</h1>
    </center>

    <?php 
        //include '../services/connection.php';
        //Variables formulario

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

        if(isset($_POST['horaFin_res'])){
            $horaFin_res = $_POST['horaFin_res'];
            $queryhoraFin = "AND r.horaFin_res LIKE '%$horaFin_res%'";
            $queryGeneral = $queryGeneral.$queryhoraFin;
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

            $reserva=$pdo->prepare($queryGeneral);
            $reserva->execute();
            $data = $reserva->fetchAll(PDO::FETCH_ASSOC);

            echo "<table width='100%' border='1' cellpadding='0' cellspacing='0'>";
            echo "<tr style='background-color:#FFDAA9';>";
                echo "<th>Número reserva</th>";
                echo "<th>Hora inicio</th>";
                echo "<th>Fin reserva</th>";
                echo "<th>Datos de la reserva</th>";
                echo "<th>Responsable de reserva</th>";
                echo "<th>Mesa</th>";
                echo "<th>Sala</th>";
            echo "</tr>";
            foreach ($data as $datas) {
                echo "<tr style='background-color:#E4EBFF';>";
                    echo "<td>".$datas['id_res']."</td>";
                    echo "<td>".$datas['horaIni_res']."</td>";
                    echo "<td>".$datas['horaFin_res']."</td>";
                    echo "<td>".$datas['datos_res']."</td>";
                    echo "<td>".$datas['nombre_use']."</td>";
                    echo "<td>".$datas['id_mes']."</td>";
                    echo "<td>".$datas['nombre_sal']."</td>";
                echo "</tr>";
            }
            echo "</table><br>";
    ?> 

</body>
</html>