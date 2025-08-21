<?php
/**
 * Created by Visual Studio Code.
 * User: SAIRV
 * Date: 16/10/2024
 * Time: 16:28
 */
 
include ('../app/config.php');
?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>No autorizado</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        body {
            background-color: #274a6e;
            color: #274a6e;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
        }

        .container {
            background-color: white;
            border-radius: 15px;
            padding: 30px;
            text-align: center;
            position: relative;
            width: 90%;
            max-width: 600px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
            z-index: 1;
        }

        .image-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .image-row img {
            max-width: 100%;
        }

        .logo {
            width: 200px;
        }

        .no-autorizado {
            width: 300px;
        }

        .bubble {
            position: absolute;
            border-radius: 50%;
            background-color: rgba(255, 255, 255, 0.2);
            animation: bubble-animation 6s infinite ease-in-out;
            z-index: 0;
        }

        /* Animación para las burbujas */
        @keyframes bubble-animation {
            0% {
                transform: scale(0.8) translateY(0);
            }
            50% {
                transform: scale(1) translateY(-50px);
            }
            100% {
                transform: scale(0.8) translateY(0);
            }
        }

        .bubble:nth-child(1) {
            width: 80px;
            height: 80px;
            bottom: -50px;
            left: 10%;
            animation-delay: 0s;
        }

        .bubble:nth-child(2) {
            width: 50px;
            height: 50px;
            bottom: -30px;
            left: 30%;
            animation-delay: 1.5s;
        }

        .bubble:nth-child(3) {
            width: 120px;
            height: 120px;
            bottom: -60px;
            right: 20%;
            animation-delay: 3s;
        }

        .bubble:nth-child(4) {
            width: 90px;
            height: 90px;
            bottom: -40px;
            right: 5%;
            animation-delay: 4.5s;
        }

        .footer-text {
            margin-top: 20px;
            font-size: 16px;
            color: #333;
        }
    </style>
</head>
<body>

    <div class="bubble"></div>
    <div class="bubble"></div>
    <div class="bubble"></div>
    <div class="bubble"></div>

    <div class="container">
        <!-- Fila con imágenes del logo y de no autorizado -->
        <div class="image-row">
            <img src="<?=APP_URL;?>/public/images/LOGO_SAIRV.png" alt="Logo SAIRV" class="logo">
            <img src="<?=APP_URL;?>/public/images/no_autorizado.png" alt="No Autorizado" class="no-autorizado">
        </div>

        <!-- Mensaje de error -->
        <h2>Esta acción no está autorizada para este usuario</h2>
        <p>Por favor, si se trata de un error, comuníquese con el área de Sistemas de la Universidad de SAIRV Incorporada.</p>
        <p class="footer-text">
            Contacto: <a href="mailto:sistemas.soporte@sairv.com.mx">sistemas.soporte@sairv.com.mx</a><br>
            WhatsApp: +523330332478
        </p>
    </div>

</body>
</html>
