<?php
include 'conn.php';
include 'funciones.php';
session_start();
$id =$_GET["id"];

//=var_dump($_SESSION);
//var_dump($_POST['producto']);

//saber la cantidad de registros que entraran
$nDatos = count($_POST['producto']);
//crea los array donde se almacenaran los datos de producto y cantidad
$Productos = $_POST['producto'];
$Cantidad = $_POST['cantidad'];

InsertardetalleTicket($conn,$nDatos,$Productos,$Cantidad,$id);

?>

<script>
    var id = <?php echo $id ?>;
   setTimeout(function () {
   // Redirigir con JavaScript
   window.location.href= `editar.php?id=${id}`;
    }, 10);
</script>