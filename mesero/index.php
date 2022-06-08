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
        <ul><a href="salir.php">Salir</a></ul>
    </nav>

    <div id="formulario">
        <form action="db/registrarMesa.php" method="POST">
        <label for="mesa">Mesa:</label><br>
            <select name="mesa">
                <option value="1" >1</option>
                <option value="2" >2</option>
                <option value="3" >3</option>
                <option value="4" >4</option>
            </select><br>
        <input type="submit" value="Enviar">
      </form> 
    </div>
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
            foreach(MesasPendientes($conn,$_SESSION['id']) as $array){
                echo "<tr>";
                echo "<td>" . $array[3] . "</td>";
                echo "<td>" . $array[5] . "</td>";
                echo "<td>" . $array[6] . "</td>";
                echo "<td> <a href='db/editar.php?id=$array[0]'> Detalles</a>  </td>";
                echo "</tr>";
            }
            ?>
        </tbody>
        </table>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>
</html>