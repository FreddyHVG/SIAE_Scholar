<?php
/**
 * Created by Visual Studio Code.
 * User: SAIRV
 * Date: 10/10/2024
 * Time: 17:07
 */
include ('../../../app/config.php');

$id_nivel = $_POST['id_nivel'];


$sentencia = $pdo->prepare("DELETE FROM niveles where id_nivel=:id_nivel ");

$sentencia->bindParam('id_nivel',$id_nivel);

try{
    if($sentencia->execute()){
        session_start();
        $_SESSION['mensaje'] = "Programa acad&eacutemico eliminado correctamente";
        $_SESSION['icono'] = "success";
        header('Location:'.APP_URL."/admin/niveles");
    }else{
        session_start();
        $_SESSION['mensaje'] = "Error, no se pudo eliminar el programa acad&eacutemico, comuniquese con el administrador";
        $_SESSION['icono'] = "error";
        ?><script>window.history.back();</script><?php
    }
}catch (Exception $exception){
    session_start();
    $_SESSION['mensaje'] = "Error, no se pudo eliminar el programa acad&eacutemico porque se esta usando en otras tablas";
    $_SESSION['icono'] = "error";
    ?><script>window.history.back();</script><?php
}



