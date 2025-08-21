<?php
$id_nivel = $_GET['id'];
include ('../../app/config.php');
include ('../../admin/layout/parte1.php');

include ('../../app/controllers/niveles/datos_nivel.php');
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
                <h2>Modificar el programa acad&eacutemico: <?=$programa;?></h2>
            </div>
            <br>
            <div class="row">

                <div class="col-md-6">
                    <div class="card card-outline card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Complete los campos</h3>
                        </div>
                        <div class="card-body">
                            <form action="<?=APP_URL;?>/app/controllers/niveles/update.php" method="post">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Gestión educativa</label>
                                            <input type="text" name="id_nivel" value="<?=$id_nivel;?>" hidden>
                                            <select name="gestion_id" id="" class="form-control">
                                                <?php
                                                foreach ($gestiones as $gestione){
                                                    if($gestione['estado']=="1"){ ?>
                                                        <option value="<?=$gestione['id_gestion'];?>"
                                                            <?php if($gestion_id==$gestione['id_gestion']){ ?> selected="selected" <?php } ?> >
                                                            <?=$gestione['gestion'];?>
                                                        </option>
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
                                            <label for="">Programas acad&eacutemicos</label>
                                            <select name="programa" id="" class="form-control">
                                                <option value="DIPLOMADO"<?php if($programa=='DIPLOMADO'){ ?> selected="selected" <?php } ?>>DIPLOMADO</option>
                                                <option value="LICENCIATURA"<?php if($programa=='LICENCIATURA'){ ?> selected="selected" <?php } ?>>LICENCIATURA</option>
                                                <option value="MAESTR&IacuteA"<?php if($programa=='MAESTR&IacuteA'){ ?> selected="selected" <?php } ?>>MAESTR&IacuteA</option>
                                      <option value="DOCTORADO"<?php if($programal=='DOCTORADO'){ ?> selected="selected" <?php } ?>>DOCTORADO</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Modalidad</label>
                                            <select name="modalidad" id="" class="form-control">
                                                <option value="PRESENCIAL"<?php if($modalidad=='PRESENCIAL'){ ?> selected="selected" <?php } ?>>PRESENCIAL</option>
                                                <option value="H&IacuteBRIDO"<?php if($modalidad=='H&IacuteBRIDO'){ ?> selected="selected" <?php } ?>>H&IacuteBRIDO</option>
                                                <option value="EN L&IacuteNEA"<?php if($modalidad=='EN L&IacuteNEA'){ ?> selected="selected" <?php } ?>>EN L&IacuteNEA</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-info">Actualizar</button>
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