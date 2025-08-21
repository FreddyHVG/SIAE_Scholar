<?php
// app/controllers/niveles/listado_de_niveles.php

// $pdo ya viene desde app/config.php incluido en el index
$sql = "
    SELECT
        n.id_nivel,
        g.gestion,
        n.nivel      AS programa,   -- alias para que coincida con la vista
        n.turno      AS modalidad,  -- alias para que coincida con la vista
        n.estado
    FROM niveles n
    INNER JOIN gestiones g ON g.id_gestion = n.gestion_id
    ORDER BY n.id_nivel ASC
";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$niveles = $stmt->fetchAll(PDO::FETCH_ASSOC);
