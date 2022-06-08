<?php
include 'conn.php';
session_start();
$id =$_GET["id"];

//=var_dump($_SESSION);
//var_dump($_POST['producto']);

//saber la cantidad de registros que entraran
$nDatos = count($_POST['producto']);
//crea los array donde se almacenaran los datos de producto y cantidad
$Productos = $_POST['producto'];
$Cantidad = $_POST['cantidad'];

detalleTicket($conn,$nDatos,$Productos,$Cantidad,$id);


function detalleTicket($conn,$nDatos,$Productos,$Cantidad,$id){
    $values = [];
    for ($i=1; $i <= $nDatos; $i++) {

        $consulta = "SELECT Precio_de_Venta FROM producto WHERE id_producto = '$Productos[$i]'";
        $result = mysqli_query($conn, $consulta);
        $precio = mysqli_fetch_array($result, MYSQLI_NUM);
        $precioFinal = $precio[0] * $Cantidad[$i];
        $values [] = "(NULL, '$Productos[$i]', '$id', '$Cantidad[$i]', '$precioFinal')";
    }

    $sql="INSERT INTO detalle_ticket VALUES \n" .implode(",\n", $values);

    if (mysqli_query($conn, $sql)) {
        echo "New record created successfully";
        $consulta2 = "SELECT SUM(precio) FROM detalle_ticket WHERE folio = '$id'";
        $result = mysqli_query($conn, $consulta2);
        $Total = mysqli_fetch_array($result, MYSQLI_NUM);

        $sql2 = "UPDATE ticket SET total = '$Total[0]' WHERE folio = '$id'";
        if (mysqli_query($conn, $sql2)){
            echo "Total actualizado";
        }
    }
}

?>

<script>
   setTimeout(function () {
   // Redirigir con JavaScript
   window.location.href= '../index.php';
    }, 1000);
</script>