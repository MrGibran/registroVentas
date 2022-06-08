<?php 
session_start();
include 'conn.php';
include 'funciones.php';

if ($_SESSION['rol'] !== 'Administrador'){
    die();
    session_destroy();
}

$categoria = $_POST['categoria'];

insertarCategorias($conn,$categoria);


?>

<script>
   setTimeout(function () {
   // Redirigir con JavaScript
   window.location.href= '../productos.php';
    }, 300);
</script>