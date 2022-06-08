<?php 
session_start();
include 'conn.php';
include 'funciones.php';

if ($_SESSION['rol'] !== 'Administrador'){
    die();
    session_destroy();
}

$id = $_GET['id'];
$categoria = $_POST['categoria'];

actualizarCategorias($conn,$id,$categoria);
?>

<script>
   setTimeout(function () {
   // Redirigir con JavaScript
   window.location.href= '../categorias.php';
    }, 300);
</script>