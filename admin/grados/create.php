<?php
include ('../../app/config.php');
include ('../../admin/layout/parte1.php');
include ('../../app/controllers/niveles/listado_de_niveles.php');
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de nuevo ciclo académico</title>

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
                <h1>Registro de nuevo ciclo académico</h1>
            </div>
            <br>
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-outline card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Complete los campos</h3>
                        </div>
                        <div class="card-body">
                            <form action="<?=APP_URL;?>/app/controllers/grados/create.php" method="post">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="nivel_id">Programa académico</label>
                                            <select name="nivel_id" id="nivel_id" class="form-control">
                                                <option value="">Seleccione un programa</option> <!-- Opción vacía inicial -->
                                                <?php
                                                foreach ($niveles as $nivele){
                                                    if($nivele['estado'] == 1) { // Solo mostrar niveles activos
                                                ?>
                                                    <option value="<?=$nivele['id_nivel'];?>"><?=$nivele['programa']." - ".$nivele['modalidad']." (".$nivele['gestion'].")";?></option>
                                                <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="curso">Ciclo académico</label>
                                            <select name="curso" id="curso" class="form-control">
                                                <!-- Las opciones aparecerán dinámicamente según el programa -->
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="paralelo">Paralelo</label>
                                            <select name="paralelo" id="paralelo" class="form-control">
                                                <option value="A">A</option>
                                                <option value="B">B</option>
                                                <option value="C">C</option>
                                                <option value="D">D</option>
                                                <option value="E">E</option>
                                                <option value="F">F</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-info">Registrar</button>
                                            <a href="<?=APP_URL;?>/admin/grados" class="btn btn-info2">Cancelar</a>
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

<!-- JavaScript para actualizar ciclos según el programa seleccionado -->
<script>
    document.getElementById('nivel_id').addEventListener('change', function() {
        // Obtener el programa seleccionado
        var programaSeleccionado = this.value;
        var cursoSelect = document.getElementById('curso');
        
        // Limpiar las opciones del ciclo académico
        cursoSelect.innerHTML = "";

        // Opciones de ciclos según el programa
        var opciones = [];

        if (programaSeleccionado.includes(1)) {
            opciones = [
                "DIPLOMADO - 1 CUATRIMESTRE",
                "DIPLOMADO - 2 CUATRIMESTRE",
                "DIPLOMADO - 3 CUATRIMESTRE"
            ];
        } else if (programaSeleccionado.includes('LICENCIATURA')) {
            opciones = [
                "LICENCIATURA - 1 CUATRIMESTRE",
                "LICENCIATURA - 2 CUATRIMESTRE",
                "LICENCIATURA - 3 CUATRIMESTRE",
                "LICENCIATURA - 4 CUATRIMESTRE",
                "LICENCIATURA - 5 CUATRIMESTRE",
                "LICENCIATURA - 6 CUATRIMESTRE"
            ];
        } else if (programaSeleccionado.includes('MAESTR&IacuteA')) {
            opciones = [
                "MAESTRÍA - 1 CUATRIMESTRE",
                "MAESTRÍA - 2 CUATRIMESTRE",
                "MAESTRÍA - 3 CUATRIMESTRE"
            ];
        } else if (programaSeleccionado.includes('DOCTORADO')) {
            opciones = [
                "DOCTORADO - 1 CUATRIMESTRE",
                "DOCTORADO - 2 CUATRIMESTRE",
                "DOCTORADO - 3 CUATRIMESTRE"
            ];
        }

        // Añadir las nuevas opciones de ciclo académico
        opciones.forEach(function(opcion) {
            var newOption = document.createElement('option');
            newOption.value = opcion;
            newOption.text = opcion;
            cursoSelect.appendChild(newOption);
        });
    });
</script>

</body>
</html>


