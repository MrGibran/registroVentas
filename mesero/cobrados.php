<?php
session_start();
include 'db/conn.php';
include 'db/funciones.php';
//error_reporting(0); /// quitar lo errores

//falta corregir este if
if ($_SESSION['rol'] !== 'Mesero'){
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
        <ul><a href="index.php">Inicio</a></ul>
        <ul><a href="#">Cuentas Cobradas</a></ul>
        <ul><a href="salir.php">Salir</a></ul>
    </nav>
    <div>
        <table>
            <thead>
            <tr>
                <th>Mesa</th>
                <th>Total</th>
                <th>Estado</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
                <?php
                foreach(MesasCobradas($conn,$_SESSION['id']) as $array){
                    echo "<tr>";
                    echo "<td>" . $array[3] . "</td>";
                    echo "<td>$" . $array[5] . "</td>";
                    echo "<td>" . $array[6] . "</td>";
                    echo "<td> <a href='db/editar.php?id=$array[0]'> Detalles</a>  </td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
            
        </table>
    </div>
</body>
</html>