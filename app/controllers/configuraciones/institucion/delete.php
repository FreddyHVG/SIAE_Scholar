<?php
/**
 * Created by Visual Studio Code.
 * User: SAIRV
 * Date: 8/1/2024
 * Time: 20:35
 */

session_start();  // Asegúrate de iniciar la sesión si no está iniciada
include ('../../../../app/config.php');

// Verificar que el ID de la institución está presente
if (!isset($_POST['id_config_institucion']) || empty($_POST['id_config_institucion'])) {
    $_SESSION['mensaje'] = "ID de la institución no proporcionado o vacío.";
    $_SESSION['icono'] = "error";
    header('Location: ' . APP_URL . "/admin/configuraciones/institucion");
    exit();
}

$id_config_institucion = $_POST['id_config_institucion'];

try {
    // Preparar la sentencia SQL para eliminar el registro
    $sentencia = $pdo->prepare("DELETE FROM configuracion_instituciones WHERE id_config_institucion = :id_config_institucion");

    // Enlazar el parámetro
    $sentencia->bindParam(':id_config_institucion', $id_config_institucion, PDO::PARAM_INT);

    // Ejecutar la consulta
    if ($sentencia->execute()) {
        $_SESSION['mensaje'] = "Se eliminó correctamente la institución.";
        $_SESSION['icono'] = "success";
        header('Location: ' . APP_URL . "/admin/configuraciones/institucion");
    } else {
        $_SESSION['mensaje'] = "No se pudo eliminar la institución. Comuníquese con el administrador.";
        $_SESSION['icono'] = "error";
        ?><script>window.history.back();</script><?php
    }

} catch (PDOException $exception) {
    // Capturar errores específicos de la base de datos y mostrarlos en la sesión para depurar
    $_SESSION['mensaje'] = "Error: " . $exception->getMessage();
    $_SESSION['icono'] = "error";
    ?><script>window.history.back();</script><?php
}
?>
