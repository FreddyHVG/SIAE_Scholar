<?php

// Colocar session_start() al inicio, antes de cualquier salida
session_start();
include ('../app/config.php');
?>

<?php
header('Content-Type: text/html; charset=utf-8');
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?=APP_NAME;?></title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?=APP_URL;?>/public/plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="<?=APP_URL;?>/public/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?=APP_URL;?>/public/dist/css/adminlte.min.css">
    <!-- Sweetalert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        /* Estilo para el fondo de la pantalla */
        body {
            background-image: url('<?=APP_URL;?>/public/images/fondo.jpg');
            background-size: cover;
            background-position: center;
        }

        .logo-box {
            background-color: #274A6E;
            padding: 20px;
            border-radius: 10px;
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
        }

        .logo-box img {
            width: 150px;
        }

        .card {
            width: 100%;
            max-width: 400px;
            margin: 0 auto;
        }

        .btn-login {
            background-color: #194E83;
            border: none;
            color: #D7D58A;
        }

        .btn-login:hover {
            background-color: #143d66;
        }

        .social-footer {
            text-align: center;
            margin-top: 20px;
        }

        .social-footer a {
            color: #194E83;
            font-size: 24px;
            margin: 0 10px;
            text-decoration: none;
        }

        .social-footer a:hover {
            color: #D7D58A;
        }
    </style>
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="card">
        <div class="card-body login-card-body">
            <center>
                <div class="logo-box">
                    <img src="<?=APP_URL;?>/public/images/LOGO_SAIRV.png" alt="Logo"><br><br>
                </div>
            </center>
            <div class="login-logo">
                <h3><b><?=APP_NAME;?></b></h3>
            </div>
            <p class="login-box-msg">Inicio de sesión</p>
            <hr>

            <form action="controller_login.php" method="post">
                <div class="input-group mb-3">
                    <input type="email" name="email" class="form-control" placeholder="Email">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" name="password" class="form-control" placeholder="Password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>

                <div class="input-group mb-3">
                    <select name="role" class="form-control">
                        <option value="admin">Administrador</option>
                        <option value="teacher">Docente</option>
                        <option value="student">Estudiante</option>
                    </select>
                </div>

                <hr>
                <div class="input-group mb-3">
                    <button class="btn btn-login btn-block" type="submit">Ingresar</button>
                </div>
            </form>

            <?php
            if(isset($_SESSION['mensaje'])){
                $mensaje = $_SESSION['mensaje'];
                ?>
                <script>
                    Swal.fire({
                                title: "Oops...!",
                                text: "Usuario y/o contrase\u00F1a incorrectos.",
                                imageUrl: "https://indeex.sairv.com.mx/public/images/error_login.png", 
                                imageWidth: 200,
                                imageHeight: 200,
                                imageAlt: "Error",
                                confirmButtonText: 'Reintentar',  // Cambiar el texto del bot車n
                                confirmButtonColor: '#274a6e',  // Cambiar el color del bot車n
                                backdrop: `
                                    rgba(0,0,0,0.4)
                                `,
                                customClass: {
                                    popup: 'swal-custom-popup',
                                    confirmButton: 'swal-custom-button',
                                    title: 'swal-custom-title',
                                    text: 'swal-custom-text'
                                }
                            });
                </script>

                <style>
                    /* Estilos personalizados para SweetAlert */
                    .swal-custom-popup {
                        background-color: #fff; /* Fondo blanco para el cuadro de di芍logo */
                    }
            
                    .swal-custom-button {
                        background-color: #274a6e !important;  /* Fondo del bot車n de confirmaci車n */
                        color: #fff !important; /* Texto blanco para el bot車n */
                    }
            
                    .swal-custom-title {
                        color: #274a6e !important;  /* Color del t赤tulo */
                    }
            
                    .swal-custom-text {
                        color: #274a6e !important;  /* Color del texto */
                    }
                        /* Animaci車n de burbujas */
                        .swal-custom-popup::before {
                        content: '';
                        position: absolute;
                        width: 100%;
                        height: 100%;
                        top: 50%;
                        left: 50%;
                        transform: translate(-50%, -50%);
                        background-image: radial-gradient(circle, rgba(215, 213, 138, 0.5) 15%, transparent 15%);
                        background-size: 10px 10px;
                        opacity: 0.6;
                        animation: moveBubbles 10s infinite;
                    }
            
                    @keyframes moveBubbles {
                        0% {
                            transform: translate(-50%, -50%) scale(1);
                        }
                        50% {
                            transform: translate(-50%, -50%) scale(1.5);
                        }
                        100% {
                            transform: translate(-50%, -50%) scale(1);
                        }
                    }
                </style>
                
            <?php
                session_destroy();
            }
            ?>
        </div>

        <div class="social-footer">
            <a href="https://wa.me/523330332478" target="_blank" title="Soporte por WhatsApp">
                <i class="fab fa-whatsapp"></i>
            </a>
            <a href="https://facebook.com/SAIRVUniversity" target="_blank" title="Soporte por Facebook">
                <i class="fab fa-facebook"></i>
            </a>
            <a href="mailto:sistemas.soporte@sairv.com.mx" title="Soporte por Correo">
                <i class="fas fa-envelope"></i>
            </a>
            <a href="tel:+523330332478" title="Llamar al soporte">
                <i class="fas fa-phone"></i>
            </a>
        </div>
    </div>
</div>

<!-- jQuery -->
<script src="<?=APP_URL;?>/public/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?=APP_URL;?>/public/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?=APP_URL;?>/public/dist/js/adminlte.min.js"></script>
</body>
</html>
