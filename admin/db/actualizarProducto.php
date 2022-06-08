<?php
session_start();
include 'conn.php';
include 'funciones.php';

if ($_SESSION['rol'] !== 'Administrador'){
    die();
    session_destroy();
}
$categoria = $_POST['nCategoria'];
$nombre = $_POST['nProducto'];
$precio = $_POST['nPrecio'];
$desc = $_POST['nTexto'];
$id = $_GET['id'];
actualizarProducto($conn,$categoria,$nombre,$precio,$desc,$id);
?>

<script>
   setTimeout(function () {
   // Redirigir con JavaScript
   window.location.href= '../productos.php';
    }, 300);
</script>