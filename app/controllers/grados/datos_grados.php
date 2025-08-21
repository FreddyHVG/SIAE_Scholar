<?php
/**
 * Created by Visual Studio Code.
 * User: SAIRV
 * Date: 11/10/2024
 * Time: 17:07
 */

$sql_grados = "SELECT * FROM grados as gra INNER JOIN niveles as niv ON gra.nivel_id = niv.id_nivel 
where gra.estado = '1' and id_grado = '$id_grado'  ";
$query_grados = $pdo->prepare($sql_grados);
$query_grados->execute();
$grados = $query_grados->fetchAll(PDO::FETCH_ASSOC);

foreach ($grados as $grado){
    $id_grado = $grado['id_grado'];
    $nivel_id = $grado['nivel_id'];
    $curso = $grado['curso'];
    $paralelo = $grado['paralelo'];
    $programa = $grado['programa'];
    $modalidad = $grado['modalidad'];
    $fyh_creacion = $grado['fyh_creacion'];
    $estado = $grado['estado'];
}