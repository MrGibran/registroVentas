<?php 
session_start();
include 'funciones.php';
include 'conn.php';

$idFolio = $_GET['id'];
$fecha = date("Y-n-d H:i:s");

cobrar($conn,$idFolio,$fecha);

?>

<script>
   setTimeout(function () {
   // Redirigir con JavaScript
   window.location.href= `../`;
    }, 30);
</script>