<?php
/**
 * Created by PhpStorm.
 * User: SAIRV
 * Date: 09/10/2024
 * Time: 15:28
 */


if (isset($_SESSION['mensaje'])) {
    $mensaje = $_SESSION['mensaje'];
    ?>
    <script>
        Swal.fire({
            position: "top-end",
            title: "<?= $mensaje; ?>",  // Mensaje dinámico
            text: "Indeex SAIRV - Sistema de Universidad Virtual",
            imageUrl: "https://indeex.sairv.com.mx/public/images/LOGO_SAIRV.png",  // Logo personalizado
            imageWidth: 150,
            imageHeight: 110,
            imageAlt: "Éxito",
            showConfirmButton: false,
            timer: 2000,
            width: '300px',
            padding: '1rem',
            customClass: {
                popup: 'swal-custom-popup',
                image: 'swal-custom-image'
            }
        });
    </script>
    <?php
    unset($_SESSION['mensaje']);  // Limpiar el mensaje de la sesión para evitar que se repita
}
?>

