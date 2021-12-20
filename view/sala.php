<?php //mirar si esta la sesion iniciada
    include_once '../services/mesa.php';
    include_once '../services/connection.php';
        session_start();
    if (isset($_SESSION['email']))
    {
        if(isset($_COOKIE["sala"])){
            $idsala = $_COOKIE["idsala"];
            $salas = $_COOKIE["sala"];
            $fecha_entera = $_COOKIE["fecha_reserva"];
            $fecha = $_COOKIE["fecha"];
            $hora = $_COOKIE["hora"];
    ?>
<!DOCTYPE html>
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
<body class="salass">
        <div class="atras"><a href="menu.php?ahora=1"><i class="far fa-arrow-alt-square-left"></i></a></div>
        <div class="logout"><a href="../services/kill-login.php"><i class="fas fa-user-circle"></i></a></div>


        <?php
        $hora_sala=$pdo->prepare("SELECT nombre_sal FROM `tbl_sala` where id_sal=?");
        $hora_sala->bindParam(1, $idsala);
        $hora_sala->execute();
        $hora_sala=$hora_sala->fetch(PDO::FETCH_NUM);
        ?>


        <div class="hora-sala"><h4><?php echo $hora_sala[0];?></h4><h4><?php echo $fecha_entera;?></h4></div>
    <div class="region-mesas flex-cv <?php echo $salas;?>">
            
            <div class="grid-mesas">
                <?php
                
                
                $mesa=$pdo->prepare("SELECT * from tbl_mesa WHERE id_sal_fk= $idsala");
                $mesa->execute();
                $mesa=$mesa->fetchAll(PDO::FETCH_ASSOC);

                foreach ($mesa as $mesa) {
                    $estatus=$pdo->prepare("SELECT tbl_mesa.id_mes from tbl_mesa INNER JOIN tbl_reserva on tbl_mesa.id_mes=tbl_reserva.id_mes_fk where (tbl_reserva.horaIni_res = ? and tbl_mesa.id_sal_fk=? and tbl_reserva.horaFin_res>? and tbl_mesa.id_mes=?) or (tbl_reserva.horaFin_res > ? and tbl_mesa.id_sal_fk=? and tbl_reserva.horaIni_res < ? and tbl_mesa.id_mes=?)");
                    $estatus->bindParam(1, $fecha_entera);
                    $estatus->bindParam(2, $idsala);
                    $estatus->bindParam(3, $fecha_entera);
                    $estatus->bindParam(4, $mesa['id_mes']);
                    $estatus->bindParam(5, $fecha_entera);
                    $estatus->bindParam(6, $idsala);
                    $estatus->bindParam(7,  $fecha_entera);
                    $estatus->bindParam(8,  $mesa['id_mes']);
                    $estatus->execute();
                    $estatus=$estatus->fetchall(PDO::FETCH_ASSOC);
                    $num=count($estatus);

                    $estatus2=$pdo->prepare("SELECT tbl_reserva.id_res FROM `tbl_reserva` where tbl_reserva.horaIni_res<CURRENT_TIMESTAMP and tbl_reserva.horaFin_res>CURRENT_TIMESTAMP and id_mes_fk=?");
                    $estatus2->bindParam(1, $mesa['id_mes']);
                    $estatus2->execute();
                    $estatus2=$estatus2->fetchAll(PDO::FETCH_ASSOC);
                    $num2=count($estatus2);



                ?>
               <div class="mesa btn-abrirPop mesasvg" data-id="<?php echo $mesa['id_mes']; ?>" data-status="<?php if($num==1 and $num2==1){echo "Ocupado/Reservado";}elseif($num==1 and $num2!=1){echo "Reservado";}else{echo $mesa['status_mes'];} ?>" >
                   
                    <?php
                    if($mesa['capacidad_mes'] ==2)
                    {
                        ?>
                        <div><img  data-status="<?php if($num==1 and $num2==1){echo "Ocupado/Reservado";}elseif($num==1 and $num2!=1){echo "Reservado";}else{echo $mesa['status_mes'];} ?>" src="../media/mesa2.svg" alt="mesa 2 personas" class="mesa-2"></div>
                        
                        <?php
                    }
                    elseif($mesa['capacidad_mes'] ==4)
                    {
                        ?>
                        <div><img data-id="<?php echo $mesa['id_mes']; ?>" data-status="<?php if($num==1 and $num2==1){echo "Ocupado/Reservado";}elseif($num==1 and $num2!=1){echo "Reservado";}else{echo $mesa['status_mes'];} ?>" class="mesa-4" src="../media/mesa4.svg" alt="mesa 4 personas"></div>
                        <?php    
                    }
                    elseif($mesa['capacidad_mes'] ==6)
                    {
                        ?>
                        <div><img data-id="<?php echo $mesa['id_mes']; ?>" data-status="<?php if($num==1 and $num2==1){echo "Ocupado/Reservado";}elseif($num==1 and $num2!=1){echo "Reservado";}else{echo $mesa['status_mes'];} ?>" class="mesa-6" src="../media/mesa6.svg" alt="mesa 6 personas"></div>
                        <?php
                    }
                    elseif($mesa['capacidad_mes'] ==10)
                    {
                        ?>
                        <div><img data-id="<?php echo $mesa['id_mes']; ?>" data-status="<?php if($num==1 and $num2==1){echo "Ocupado/Reservado";}elseif($num==1 and $num2!=1){echo "Reservado";}else{echo $mesa['status_mes'];} ?>" class="mesa-10" src="../media/mesa10.svg" alt="mesa 10 personas"></div>
                        <?php
                    }
                    else
                    {
                        ?>
                        <div><img data-id="<?php echo $mesa['id_mes']; ?>" data-status="<?php if($num==1 and $num2==1){echo "Ocupado/Reservado";}elseif($num==1 and $num2!=1){echo "Reservado";}else{echo $mesa['status_mes'];} ?>" class="mesa-4" src="../media/mesa4.svg" alt="mesa 4 personas"></div>
                        <?php
                    }
                    ?>
                    <div><p>Mesa nº <?php echo $mesa['id_mes']; ?></p></div>
                    <div><p>Mesa de <?php echo $mesa['capacidad_mes']; ?></p></div>
                    <div><p>Estado:  <?php if($num==1 and $num2==1){echo "Ocupado";}elseif($num==1 and $num2!=1){echo "Reservado";}else{echo $mesa['status_mes'];} ?></p></div>


                       
                </div>

                <?php
                }
                ?>

            </div>
      
    </div>

    <?php 
        
        
    ?>
    <div class="overlay" id="overlay">
        <div class="abrirReserva" id="abrirReserva">
            <div class="popup" id="popup">
                <a href="#" id="btn-cerrar-popup" class="btn-cerrarPop"><i class="fas fa-times"></i></a>
                <h3>Reservar mesa</h3>
                <form METHOD='POST' class="crearReserva" action="../services/reservar-mesa.php">
                    <input type="hidden" id="idMesa" class="idMesa" name="idMesa">
                    <label for="nombre">Nombre de reserva</label>
                    <input type="text" id="nombre" name="nombre">
                    <input type="hidden" id="fecha_entera" name="fecha_ini" value="<?php echo $fecha_entera; ?>">
                    <input type="hidden" id="fecha" name="fecha_fin" value="<?php echo $fecha; ?>">
                    <label for="fecha">Hora final de reserva</label>
                    <?php
                    //la cookie se cambia pero la pdo ya se ejecutó con el valor de la cookie anterior, asi que no es óptimo
                    if(isset($_COOKIE["mesa"])){
                        $mesa = $_COOKIE["mesa"];
                    }
                    $reservas_quedan=$pdo->prepare("SELECT horaIni_res FROM `tbl_reserva` WHERE horaIni_res>? and id_mes_fk=?");
                    $reservas_quedan->bindParam(1, $fecha_entera);
                    $reservas_quedan->bindParam(2, $mesa);
                    $reservas_quedan->execute();
                    $reservas_quedan=$reservas_quedan->fetchAll(PDO::FETCH_ASSOC);
                    $num=count($reservas_quedan);
                    if($num>0){
                        foreach ($reservas_quedan as $reservas_quedan) {
                            $final=$reservas_quedan['horaIni_res'];
                        }
                    }
                    else{
                        $final="23:59:00";
                    }
                    
                    
                    $horas=$pdo->prepare("SELECT * from tbl_horas_reservas where hora_hor>? and hora_hor<=?");
                    $horas->bindParam(1, $hora);
                    $horas->bindParam(2, $final);
                    $horas->execute();
                    $horas=$horas->fetchAll(PDO::FETCH_ASSOC);
                    



                    ?>
                    <select name="hora_fin" class="select-horas">
                        <?php
                        foreach ($horas as $horas) {
                        ?>
                        <option value="<?php echo $horas['hora_hor']; ?>"><?php echo $horas['hora_hor']; ?></option>
                        <?php
                        }
                        if($num<1){
                        ?>
                        <option value="00:00:00">00:00:00</option>
                        <?php
                        }
                        
                        ?>
                    </select>
                    <input type="submit" value="Reservar" class="btn">
                </form>
            </div>
        </div>


        <div class="cerrarReserva" id="cerrarReserva">
            <div class="popup" id="popup2">
                <a href="#" id="btn-cerrar-popup" class="btn-cerrarPop"><i class="fas fa-times"></i></a>
                <h3>Cancelar/Finalizar reserva</h3>
                <form METHOD='POST'  class="editarReserva" action="../services/acabar-reserva.php">
                    <input type="hidden" id="idMesa" class="idMesa" name="idMesa">
                    <input type="hidden" id="fecha" class="fecha" name="fecha" value="<?php echo $fecha_entera; ?>">
                    <input type="hidden" name="accion" value="finalizar">
                    <input type="submit" value="Finalizar" class="btn">
                </form>
            </div>
        </div>
    </div>
    <?php
    }else{
        header("Location:../view/menu.php");
    }
    }else
    {
        header("Location:../view/login.php");
    }
    ?>
</body>
</html>