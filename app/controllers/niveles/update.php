<?php
/**
 * Created by Visual Studio Code.
 * User: SAIRV
 * Date: 9/10/2024
 * Time: 16:38
 */

include ('../../../app/config.php');

$id_nivel = $_POST['id_nivel'];
$gestion_id = $_POST['gestion_id'];
$programa = $_POST['programa'];
$modalidad = $_POST['modalidad'];

$sentencia = $pdo->prepare('UPDATE niveles
 SET gestion_id=:gestion_id,
     programa=:programa,
     modalidad=:modalidad,
     fyh_actualizacion=:fyh_actualizacion
WHERE id_nivel=:id_nivel ');

$sentencia->bindParam(':gestion_id',$gestion_id);
$sentencia->bindParam(':programa',$programa);
$sentencia->bindParam(':modalidad',$modalidad);
$sentencia->bindParam('fyh_actualizacion',$fechaHora);
$sentencia->bindParam('id_nivel',$id_nivel);

if($sentencia->execute()){
    echo 'success';
    session_start();
    $_SESSION['mensaje'] = "Se actualiz&oacute el programa correctamente";
    $_SESSION['icono'] = "success";
    header('Location:'.APP_URL."/admin/niveles");
//header('Location:' .$URL.'/');
}else{
    echo 'error al actualizar en la base de datos';
    session_start();
    $_SESSION['mensaje'] = "Error, no se pudo actualizar en la base datos, comuniquese con el administrador";
    $_SESSION['icono'] = "error";
    ?><script>window.history.back();</script><?php
}