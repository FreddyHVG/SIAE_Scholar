<?php
// DEBUG MARCADOR INICIO
file_put_contents(__DIR__.'/_parte1_tocado.txt', date('c')." - HIT\n", FILE_APPEND);
echo "<pre>PARTE1 HIT: ".__FILE__."</pre>";
// exit; // <- descomenta esto si quieres detener la ejecución aquí para confirmar
