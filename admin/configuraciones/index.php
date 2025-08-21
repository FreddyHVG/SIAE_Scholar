<?php
include ('../../app/config.php');
include ('../../admin/layout/parte1.php');
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configuraciones del sistema</title>

    <!-- Enlace al archivo CSS adicional -->
    <link rel="stylesheet" href="/public/css/custom.css">
</head>
<body>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <br>
    <div class="content">
        <div class="container">
            <div class="row">
                <h1>Configuraciones del sistema</h1>
            </div>
            <br>
            <div class="row">

                <div class="col-md-4 col-sm-6 col-12">
                    <div class="info-box">
                        <span class="info-box-icon" style="background-color: #274a6e; color: #ffffff;" >
                            <i class="bi bi-hospital"></i>
                        </span>
                        <div class="info-box-content">
                            <span class="info-box-text"><b>Datos de la instituci&oacute;n</b></span>
                            <a href="institucion" class="btn btn-info btn-sm" >Configurar</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 col-sm-6 col-12">
                    <div class="info-box">
                        <span class="info-box-icon" style="background-color: #d7d58a; color: #000000;">
                            <i class="bi bi-calendar-range"></i>
                        </span>
                        <div class="info-box-content">
                            <span class="info-box-text"><b>Gesti&oacute;n educativa</b></span>
                            <a href="gestion" class="btn btn-info2 btn-sm">Configurar</a> 
                        </div>
                    </div>
                </div>

            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php
include ('../../admin/layout/parte2.php');
include ('../../layout/mensajes.php');
?>

</body>
</html>
