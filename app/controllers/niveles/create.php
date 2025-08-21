<?php
/**
 * Created by Visual Studio Code.
 * User: SAIRV
 * Date: 19/10/2024
 * Time: 16:38
 */

include ('../../../app/config.php');

$gestion_id = $_POST['gestion_id'];
$programa = $_POST['programa'];
$modalidad = $_POST['modalidad'];

$sentencia = $pdo->prepare('INSERT INTO niveles
(gestion_id,programa,modalidad, fyh_creacion, estado)
VALUES ( :gestion_id,:programa,:modalidad,:fyh_creacion,:estado)');

$sentencia->bindParam(':gestion_id',$gestion_id);
$sentencia->bindParam(':programa',$programa);
$sentencia->bindParam(':modalidad',$modalidad);
$sentencia->bindParam('fyh_creacion',$fechaHora);
$sentencia->bindParam('estado',$estado_de_registro);

if($sentencia->execute()){
    echo 'success';
    session_start();
    $_SESSION['mensaje'] = "Programa acad&eacutemico registrado correctamente";
    $_SESSION['icono'] = "success";
    header('Location:'.APP_URL."/admin/niveles");
//header('Location:' .$URL.'/');
}else{
    echo 'error al registrar a la base de datos';
    session_start();
    $_SESSION['mensaje'] = "Error, no se pudo registrar el programa acad&eacutemico, comuniquese con el administrador";
    $_SESSION['icono'] = "error";
    ?><script>window.history.back();</script><?php
}