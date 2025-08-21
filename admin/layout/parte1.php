<?php
session_start();

if (!isset($_SESSION['sesion_email'])) {
    header('Location: ' . APP_URL . '/login'); exit;
}

$email_sesion = $_SESSION['sesion_email'];

/*  Usuario + rol (LEFT JOIN para no romper si falta ficha en personas)  */
$query_sesion = $pdo->prepare("
    SELECT
        usu.id_usuario, usu.email, usu.rol_id, usu.estado,
        rol.nombre_rol,
        per.nombres, per.apellidos, per.ci
    FROM usuarios AS usu
    INNER JOIN roles    AS rol ON rol.id_rol = usu.rol_id
    LEFT  JOIN personas AS per ON per.usuario_id = usu.id_usuario
    WHERE usu.email = :email AND usu.estado = '1'
    LIMIT 1
");
$query_sesion->execute([':email' => $email_sesion]);
$u = $query_sesion->fetch(PDO::FETCH_ASSOC);

if (!$u) { header('Location: ' . APP_URL . '/login'); exit; }

$nombre_sesion_usuario     = $u['email'];
$id_rol_sesion_usuario     = (int)$u['rol_id'];
$rol_sesion_usuario        = $u['nombre_rol'] ?? '';
$nombres_sesion_usuario    = $u['nombres'] ?? '';
$apellidos_sesion_usuario  = $u['apellidos'] ?? '';
$ci_sesion_usuario         = $u['ci'] ?? '';

/*  Construir la ruta EXACTA como está en la BD (con "/" inicial y con ".php")  */
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);   // ej: /siaescholar/admin/materias/editar.php
$base = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\') . '/';// ej: /siaescholar/
$rel  = substr($path, strlen($base));                        // ej: admin/materias/editar.php
$rel  = ltrim($rel, '/');                                    // ej: admin/materias/editar.php

// Si quedó vacío, apunta al dashboard:
if ($rel === '') {
    $rel = 'admin/index.php';
}
// Si termina en "/", asumimos index.php
if (substr($rel, -1) === '/') {
    $rel .= 'index.php';
}

// Ruta principal a comparar contra permisos.url (tal cual guardas en BD):
$restPrincipal = '/' . $rel;                                 // ej: /admin/materias/editar.php

// Alternativa: si el usuario entró sin extensión (p. ej. /admin/materias) probamos /admin/materias/index.php
$alt = null;
if (strpos($rel, '.php') === false) {
    $alt = '/' . rtrim($rel, '/') . '/index.php';
}

/*  SUPERADMIN: autoriza todo si el rol es ADMINISTRADOR (id_rol = 1)  */
$autorizado = false;
if ($id_rol_sesion_usuario === 1 || $rol_sesion_usuario === 'ADMINISTRADOR') {
    $autorizado = true;
} else {
    // Caso normal: verificar permisos exactos del rol
    $perm_sql = $pdo->prepare("
        SELECT per.url
        FROM roles_permisos AS rp
        INNER JOIN permisos AS per ON per.id_permiso = rp.permiso_id
        WHERE rp.estado = '1' AND rp.rol_id = :rol
    ");
    $perm_sql->execute([':rol' => $id_rol_sesion_usuario]);
    $permisos = $perm_sql->fetchAll(PDO::FETCH_COLUMN, 0);

    foreach ($permisos as $perm) {
        // En tu BD están con "/" inicial y con ".php" (p. ej. /admin/materias/index.php)
        if ($perm === $restPrincipal || ($alt !== null && $perm === $alt)) {
            $autorizado = true;
            break;
        }
    }
}

/*  Redirigir si no está autorizado  */
if (!$autorizado) {
    header('Location: ' . APP_URL . '/admin/no-autorizado.php'); exit;
}
?>

<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->


<html lang="es">
    
 
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?=APP_NAME;?></title>


    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="<?=APP_URL;?>/public/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?=APP_URL;?>/public/dist/css/adminlte.min.css">

    <!-- jQuery -->
    <script src="<?=APP_URL;?>/public/plugins/jquery/jquery.min.js"></script>

    <!-- Sweetaler2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Iconos de bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Datatables -->
    <link rel="stylesheet" href="<?=APP_URL;?>/public/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?=APP_URL;?>/public/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="<?=APP_URL;?>/public/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

    <!-- CHART -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="<?=APP_URL;?>/public/css/custom.css">
</head>



<body class="hold-transition sidebar-mini">
<div class="wrapper">
    
        <header class="custom-header">
            <div class="container header-content">
                <!-- Sección de logo y título -->
                <div class="header-left">
                    <img src="<?=APP_URL;?>/public/images/LOGO_SAIRV.png" alt="Logo Universidad de Sairv" class="logo">
                    <div class="header-text">
                        <h1>UNIVERSIDAD DE SAIRV INCORPORADA</h1>
                        <p>Sistema de Universidad Virtual</p>
                    </div>
                </div>
        
                <!-- Sección de información de contacto -->
                <div class="header-right">
                    <div class="contact-info">
                        <p><i class="bi bi-geo-alt"></i> Av. de la Paz, 5720, Guadalajara, Jalisco, México</p>
                        <p><i class="bi bi-telephone"></i> Teléfono: 33312123</p>
                        <p><i class="bi bi-envelope"></i> Email: <a href="mailto:cras@sairv.com.mx">cras@sairv.com.mx</a></p>
                    </div>
        
                    
                </div>
            </div>
        </header>
        <!-- Menú de hamburguesa -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>
        <!-- Íconos de redes sociales -->
                    <div class="social-icons">
                        <a href="#"><i class="bi bi-facebook"></i></a>
                        <a href="#"><i class="bi bi-google"></i></a>
                        <a href="#"><i class="bi bi-twitter"></i></a>
                        <a href="#"><i class="bi bi-linkedin"></i></a>
                        <a href="#"><i class="bi bi-behance"></i></a>
                    </div>
        </nav>
        
        


    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="<?=APP_URL;?>/admin" class="brand-link">
            <img src="<?=APP_URL;?>/public/images/LOGO_SAIRV.png" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">INDEEX SAIRV</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="https://w7.pngwing.com/pngs/81/570/png-transparent-profile-logo-computer-icons-user-user-blue-heroes-logo-thumbnail.png" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a href="#" class="d-block"><?=$nombre_sesion_usuario;?></a>
                </div>
            </div>


            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->
                         
                    <?php
                    if( ($rol_sesion_usuario=="ADMINISTRADOR") || ($rol_sesion_usuario=="DIRECTOR ACADÉMICO") || ($rol_sesion_usuario=="DIRECTOR ADMINISTRATIVO")){ ?>
                        <li class="nav-item">
                            <a href="#" class="nav-link active">
                                <i class="nav-icon fas"><i class="bi bi-gear"></i></i>
                                <p>
                                    Configuraciones
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?=APP_URL;?>/admin/configuraciones" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Configurar sistema</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    <?php
                    }
                    ?>


                    <?php
                    if( ($rol_sesion_usuario=="ADMINISTRADOR") || ($rol_sesion_usuario=="DIRECTOR ACADÉMICO") ){ ?>
                        <li class="nav-item">
                            <a href="#" class="nav-link active">
                                <i class="nav-icon fas"><i class="bi bi-bookshelf"></i></i>
                                <p>
                                    Programas
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?=APP_URL;?>/admin/niveles" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Pogramas académicos</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link active">
                                <i class="nav-icon fas"><i class="bi bi-bar-chart-steps"></i></i>
                                <p>
                                    Cuatrimestres
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?=APP_URL;?>/admin/grados" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Listado de cuatrimestres</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link active">
                                <i class="nav-icon fas"><i class="bi bi-book-half"></i></i>
                                <p>
                                    Materias
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?=APP_URL;?>/admin/materias" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Listado de materias</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <?php
                    }
                    ?>




                    <?php
                    if( ($rol_sesion_usuario=="ADMINISTRADOR") ){ ?>
                        <li class="nav-item">
                            <a href="#" class="nav-link active">
                                <i class="nav-icon fas"><i class="bi bi-bookmarks"></i></i>
                                <p>
                                    Roles
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?=APP_URL;?>/admin/roles" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Listado de roles</p>
                                    </a>
                                </li>
                            </ul>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?=APP_URL;?>/admin/roles/permisos.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Listado de Permisos</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link active">
                                <i class="nav-icon fas"><i class="bi bi-people-fill"></i></i>
                                <p>
                                    Usuarios
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?=APP_URL;?>/admin/usuarios" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Listado de usuarios</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <?php
                    }
                    ?>





                    <?php
                    if( ($rol_sesion_usuario=="ADMINISTRADOR") || ($rol_sesion_usuario=="DIRECTOR ACADÉMICO") || ($rol_sesion_usuario=="DIRECTOR ADMINISTRATIVO") || ($rol_sesion_usuario=="SECRETARIA")){ ?>
                        <li class="nav-item">
                            <a href="#" class="nav-link active">
                                <i class="nav-icon fas"><i class="bi bi-person-lines-fill"></i></i>
                                <p>
                                    Administrativos
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?=APP_URL;?>/admin/administrativos" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Listado de administrativos</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <?php
                    }
                    ?>



                    <?php
                    if( ($rol_sesion_usuario=="ADMINISTRADOR") || ($rol_sesion_usuario=="DIRECTOR ACADÉMICO") || ($rol_sesion_usuario=="SECRETARIA")){ ?>
                        <li class="nav-item">
                            <a href="#" class="nav-link active">
                                <i class="nav-icon fas"><i class="bi bi-person-video3"></i></i>
                                <p>
                                    Docentes
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?=APP_URL;?>/admin/docentes" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Listado de docentes</p>
                                    </a>
                                </li>
                            </ul>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?=APP_URL;?>/admin/docentes/asignacion.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Asignación de materias</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <?php
                    }
                    ?>




                    <?php
                    if( ($rol_sesion_usuario=="ADMINISTRADOR") || ($rol_sesion_usuario=="DOCENTE") ){ ?>
                        <li class="nav-item">
                            <a href="<?=APP_URL;?>/admin/kardex" class="nav-link active">
                                <i class="nav-icon fas"><i class="bi bi-clipboard-check"></i></i>
                                <p>
                                    Kardex
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?=APP_URL;?>/admin/calificaciones" class="nav-link active">
                                <i class="nav-icon fas"><i class="bi bi-check2-square"></i></i>
                                <p>
                                    Calificaciones
                                </p>
                            </a>
                        </li>
                        <?php
                    }
                    ?>





                    <?php
                    if( ($rol_sesion_usuario=="ADMINISTRADOR") || ($rol_sesion_usuario=="DIRECTOR ACADÉMICO") || ($rol_sesion_usuario=="DIRECTOR ADMINISTRATIVO") || ($rol_sesion_usuario=="SECRETARIA")|| ($rol_sesion_usuario=="CONTADOR")){ ?>
                        <li class="nav-item">
                            <a href="#" class="nav-link active">
                                <i class="nav-icon fas"><i class="bi bi-person-video"></i></i>
                                <p>
                                    Estudiantes
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?=APP_URL;?>/admin/inscripciones" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Inscripción</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?=APP_URL;?>/admin/estudiantes" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Listado de estudiantes</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <?php
                    }
                    ?>



                    <?php
                    if( ($rol_sesion_usuario=="ADMINISTRADOR") || ($rol_sesion_usuario=="DIRECTOR ADMINISTRATIVO") || ($rol_sesion_usuario=="CONTADOR")){ ?>
                        <li class="nav-item">
                            <a href="#" class="nav-link active">
                                <i class="nav-icon fas"><i class="bi bi-cash-coin"></i></i>
                                <p>
                                    Pagos
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?=APP_URL;?>/admin/pagos" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Realizar pago</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <?php
                    }
                    ?>



                    <li class="nav-item">
                        <a href="<?=APP_URL;?>/login/logout.php" class="nav-link" style="background-color: #d7d58a;color: black">
                            <i class="nav-icon fas"><i class="bi bi-door-open"></i></i>
                            <p>
                                Cerrar sesión
                            </p>
                        </a>
                    </li>


                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>