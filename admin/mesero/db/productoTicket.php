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
   setTimeout(function () {
   // Redirigir con JavaScript
   window.location.href= '../index.php';
    }, 1000);
</script>