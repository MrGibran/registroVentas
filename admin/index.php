<?php 
session_start();
include 'db/conn.php';
include 'db/funciones.php';

if ($_SESSION['rol'] !== 'Administrador'){
    die();
    session_destroy();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <nav>
        <p>Hola <?php echo $_SESSION['usuario'];?></p>
        <ul><a href="#">Inicio</a></ul>
        <ul><a href="productos.php">Productos</a></ul>
        <ul><a href="categorias.php">Categorias</a></ul>
        <ul><a href="salir.php">Salir</a></ul>
    </nav>

    <h1>Pendientes</h1>
    <table>
        <thead>
            <tr>
                <th>Folio</th>
                <th>Mesero</th>
                <th>Fecha/Hora de Apertura</th>
                <th>Mesa</th>
                <th>Total</th>
                <th></th>
            </tr>
        </thead>
            <tbody>
            <?php
            foreach(MesasPendientesAdmin($conn) as $array){
                echo "<tr>";
                echo "<td>" . $array[0] . "</td>";
                echo "<td>" . $array[1] . "</td>";
                echo "<td>" . $array[2] . "</td>";
                echo "<td>" . $array[3] . "</td>";
                echo "<td>$" . $array[5] . "</td>";
                echo "<td> <a href='db/editar.php?id=$array[0]'> Detalles</a>  </td>";
                echo "</tr>";
            }
            ?>
            </tbody>
    </table>
    <h1>Cobrados</h1>
    <table>
        <thead>
            <tr>
                <th>Folio</th>
                <th>Mesero</th>
                <th>Fecha/Hora de Apertura</th>
                <th>Mesa</th>
                <th>Total</th>
                <th>Fecha/Hora de Salida</th>
            </tr>
        </thead>
            <tbody>
            <?php
            foreach(MesasCobradasAdmin($conn) as $array){
                echo "<tr>";
                echo "<td>" . $array[0] . "</td>";
                echo "<td>" . $array[1] . "</td>";
                echo "<td>" . $array[2] . "</td>";
                echo "<td>" . $array[3] . "</td>";
                echo "<td>$" . $array[5] . "</td>";
                echo "<td>$" . $array[7] . "</td>";
                echo "<td> <a href='db/editar.php?id=$array[0]'> Detalles</a>  </td>";
                echo "</tr>";
            }
            ?>
            </tbody>
    </table>


</body>
</html>