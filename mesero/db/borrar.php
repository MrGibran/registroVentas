<?php
session_start();
include 'funciones.php';
include 'conn.php';

$idDetalleTicket = $_GET['idProducto'];
$idFolio = $_GET['id'];

borrarDetalleTicket($conn,$idDetalleTicket,$idFolio);
?>

<script>
    var id = <?php echo $idFolio ?>;
   setTimeout(function () {
   // Redirigir con JavaScript
   window.location.href= `editar.php?id=${id}`;
    }, 30);
</script>