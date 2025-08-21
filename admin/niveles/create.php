<?php
include ('../../app/config.php');
include ('../../admin/layout/parte1.php');

include ('../../app/controllers/configuraciones/gestion/listado_de_gestiones.php');

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
                <h1>Registro de nuevo programa acad&eacutemico</h1>
            </div>
            <br>
            <div class="row">

                <div class="col-md-6">
                    <div class="card card-outline card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Complete los campos</h3>
                        </div>
                        <div class="card-body">
                            <form action="<?=APP_URL;?>/app/controllers/niveles/create.php" method="post">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Gesti&oacuten educativa</label>
                                            <select name="gestion_id" id="" class="form-control">
                                                <?php
                                                foreach ($gestiones as $gestione){
                                                   if($gestione['estado']=="1"){ ?>
                                                       <option value="<?=$gestione['id_gestion'];?>"><?=$gestione['gestion'];?></option>
                                                       <?php
                                                   } ?>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Programa acad&eacutemico</label>
                                            <select name="programa" id="" class="form-control">
                                               <option value="DIPLOMADO">DIPLOMADO </option>
                                                <option value="LICENCIATURA">LICENCIATURA</option>
                                                <option value="MAESTR&IacuteA">MAESTR&IacuteA</option>
                                                <option value="DOCTORADO">DOCTORADO</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Modalidad</label>
                                            <select name="modalidad" id="" class="form-control">
                                                <option value="EN L&IacuteNEA">EN L&IacuteNEA</option>
                                                <option value="H&IacuteBRIDO">H&IacuteBRIDO</option>
                                                <option value="PRESENCIAL">PRESENCIAL</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-info">Registrar</button>
                                            <a href="<?=APP_URL;?>/admin/niveles" class="btn btn-info2">Cancelar</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
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