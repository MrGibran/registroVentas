<?php
session_start();
include 'conn.php';
include 'funciones.php';
//datos que se ocupan son:
// usuario que creo el registro
// mesa 

$mesa = $_POST['mesa'];
$usuario = $_SESSION['id'];
$fecha = date("Y-n-d H:i:s");

echo $fecha;
CrearMesa($conn,$mesa,$fecha,$usuario);  

?>
<script>
   setTimeout(function () {
   // Redirigir con JavaScript
   window.location.href= '../index.php';
    }, 30);
</script>
