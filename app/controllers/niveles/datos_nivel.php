<?php
// app/controllers/niveles/datos_nivel.php

// id por GET, validado
$id_nivel = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($id_nivel <= 0) {
    header('Location: ' . APP_URL . '/admin/niveles/index.php');
    exit;
}

$sql = "
    SELECT
        n.id_nivel,
        n.gestion_id,
        g.gestion,
        n.nivel     AS programa,   -- alias para la vista
        n.turno     AS modalidad,  -- alias para la vista
        n.estado
    FROM niveles n
    INNER JOIN gestiones g ON g.id_gestion = n.gestion_id
    WHERE n.id_nivel = :id
    LIMIT 1
";
$stmt = $pdo->prepare($sql);
$stmt->execute([':id' => $id_nivel]);
$nivel = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$nivel) {
    // no existe el registro
    header('Location: ' . APP_URL . '/admin/niveles/index.php');
    exit;
}

/* Variables que usualmente usa la vista */
$gestion_id = (int)$nivel['gestion_id'];
$gestion    = $nivel['gestion'] ?? '';

/* Compatibilidad doble: la vista puede pedir programa/modalidad
   o nivel/turno según el archivo. Creamos ambas variables. */
$programa   = $nivel['programa']   ?? '';
$modalidad  = $nivel['modalidad']  ?? '';

$nivel_txt  = $nivel['programa']   ?? ''; // alias "nivel"
$turno_txt  = $nivel['modalidad']  ?? ''; // alias "turno"

$estado     = $nivel['estado']     ?? '1';
