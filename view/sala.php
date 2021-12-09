<?php //mirar si esta la sesion iniciada
    include_once '../services/mesa.php';
    include_once '../services/connection.php';
        session_start();
    if (isset($_SESSION['email']))
    {
        if(isset($_COOKIE["sala"])){
            $idsala = $_COOKIE["idsala"];
            $salas = $_COOKIE["sala"];
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
        <div class="atras"><a href="menu.php"><i class="far fa-arrow-alt-square-left"></i></a></div>
        <div class="logout"><a href="../services/kill-login.php"><i class="fas fa-user"></i></a></div>
    <div class="region-mesas flex-cv <?php echo $salas;?>">
            
            <div class="grid-mesas">
                <?php
                
                
                $mesa=$pdo->prepare("SELECT * from tbl_mesa WHERE id_sal_fk= $idsala");
                $mesa->execute();
                $mesa=$mesa->fetchAll(PDO::FETCH_ASSOC);

                foreach ($mesa as $mesa) {
                ?>
               <div class="mesa btn-abrirPop mesasvg" data-id="<?php echo $mesa['id_mes']; ?>" data-status="<?php echo $mesa['status_mes']; ?>" >
                   
                    <?php
                    if($mesa['capacidad_mes'] ==2)
                    {
                        ?>
                        <div><img  data-status="<?php echo $mesa['status_mes']; ?>" src="../media/mesa2.svg" alt="mesa 2 personas" class="mesa-2"></div>
                        
                        <?php
                    }
                    elseif($mesa['capacidad_mes'] ==4)
                    {
                        ?>
                        <div><img data-id="<?php echo $mesa['id_mes']; ?>" data-status="<?php echo $mesa['status_mes']; ?>" class="mesa-4" src="../media/mesa4.svg" alt="mesa 4 personas"></div>
                        <?php    
                    }
                    elseif($mesa['capacidad_mes'] ==6)
                    {
                        ?>
                        <div><img data-id="<?php echo $mesa['id_mes']; ?>" data-status="<?php echo $mesa['status_mes']; ?>" class="mesa-6" src="../media/mesa6.svg" alt="mesa 6 personas"></div>
                        <?php
                    }
                    elseif($mesa['capacidad_mes'] ==10)
                    {
                        ?>
                        <div><img data-id="<?php echo $mesa['id_mes']; ?>" data-status="<?php echo $mesa['status_mes']; ?>" class="mesa-10" src="../media/mesa10.svg" alt="mesa 10 personas"></div>
                        <?php
                    }
                    else
                    {
                        ?>
                        <div><img data-id="<?php echo $mesa['id_mes']; ?>" data-status="<?php echo $mesa['status_mes']; ?>" class="mesa-4" src="../media/mesa4.svg" alt="mesa 4 personas"></div>
                        <?php
                    }
                    ?>
                    <div><p>Mesa nº <?php echo $mesa['id_mes']; ?></p></div>
                    <div><p>Mesa de <?php echo $mesa['capacidad_mes']; ?></p></div>
                    <div><p>Estado:  <?php echo $mesa['status_mes']; ?></p></div>


                       
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
                    <label for="nombre">Nombre de la reserva</label>
                    <input type="text" id="nombre" name="nombre">

                    <input type="submit" value="Reservar" class="btn">
                </form>
            </div>
        </div>


        <div class="cerrarReserva" id="cerrarReserva">
            <div class="popup" id="popup2">
                <a href="#" id="btn-cerrar-popup" class="btn-cerrarPop"><i class="fas fa-times"></i></a>
                <h3>Modificar reserva</h3>
                <form METHOD='POST'  class="editarReserva" action="../services/acabar-reserva.php">
                    <input type="hidden" id="idMesa" class="idMesa" name="idMesa">
                    <select name="accion">
                        <option value="finalizar">Finalizar</option>
                        <option value="cancelar">Cancelar</option>
                    </select>
                    <input type="submit" value="Guardar" class="btn">
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