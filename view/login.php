<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SARA-CONNOR21</title>
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

<body class="login">
    <div class="region-login">
  
            <div class="login flex-cv">
                <form action="../services/login.php" method="POST"class="login-form shadow1">
                    <label for="username">Introduce el correo</label>
                    <input type="email" placeholder="blumal@gmail.com" id="login_username" class="login-input_username" name="username">
                    <label for="password">Introduce la contraseña</label>
                    <input type="password" placeholder="1234" id="login_password" class="login-input_password" name="password">
                    <span><input type="checkbox" name="showpass" onclick="showPass()"><label for="showpass" id="showpass-label">Mostrar contraseña</label></span>
                    <input type="submit" name="enviar" value="Iniciar sesión" id="login_btn_enviar" class="login-btn_enviar">
                </form>
                
            </div>
      
    </div>
</body>
</html>