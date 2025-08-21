<?php


include ('../app/config.php');

$email = $_POST['email'];
$password = $_POST['password'];
$selected_role = $_POST['role']; // Rol seleccionado en el formulario

// Consulta para obtener al usuario junto con su rol
$sql = "SELECT * FROM usuarios as usu
        WHERE usu.email = :email AND usu.estado = '1'";
$query = $pdo->prepare($sql);
$query->bindParam(':email', $email, PDO::PARAM_STR);
$query->execute();

$usuario = $query->fetch(PDO::FETCH_ASSOC);

if ($usuario) {
    $password_tabla = $usuario['password'];
    $rol_asignado = $usuario['rol_id']; // ID del rol asignado en la base de datos

    // Mapeo de roles seleccionados a sus respectivos ID
    $roles = [
        'admin' => [1, 2, 3, 4, 5], // Administrador y otros roles administrativos
        'teacher' => 6, // Docente
        'student' => 7  // Estudiante
    ];

    // Verificar contraseña y rol
    if (password_verify($password, $password_tabla)) {
        if ($selected_role == 'admin' && in_array($rol_asignado, $roles['admin'])) {
            // El usuario es un administrador válido
            session_start();
            $_SESSION['mensaje'] = "Bienvenido al sistema";
            $_SESSION['icono'] = "success";
            $_SESSION['sesion_email'] = $email;
            header('Location:' . APP_URL . "/admin");
        } elseif ($selected_role == 'teacher' && $rol_asignado == $roles['teacher']) {
            // El usuario es un docente válido
            session_start();
            $_SESSION['mensaje'] = "Bienvenido al sistema";
            $_SESSION['icono'] = "success";
            $_SESSION['sesion_email'] = $email;
            header('Location:' . APP_URL . "/admin");
        } elseif ($selected_role == 'student' && $rol_asignado == $roles['student']) {
            // El usuario es un estudiante válido
            session_start();
            $_SESSION['mensaje'] = "Bienvenido al sistema";
            $_SESSION['icono'] = "success";
            $_SESSION['sesion_email'] = $email;
            header('Location:' . APP_URL . "/admin");
        } else {
            // El rol seleccionado no coincide con el asignado
            session_start();
            $_SESSION['mensaje'] = "Usuario, contraseña o rol incorrectos, vuelva a intentarlo";
            header('Location:' . APP_URL . "/login");
        }
    } else {
        // Contraseña incorrecta
        session_start();
        $_SESSION['mensaje'] = "Usuario, contraseña o rol incorrectos, vuelva a intentarlo";
        header('Location:' . APP_URL . "/login");
    }
} else {
    // Usuario no encontrado o inactivo
    session_start();
    $_SESSION['mensaje'] = "Usuario no encontrado o inactivo";
    header('Location:' . APP_URL . "/login");
}

?>