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
    <title>Cobrados</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

</head>
<body>
    <nav class="navbar navbar-expand-lg bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
            <img src="../img/logo1.png" alt="" width="" height="65" class="d-inline-block align-text-center">
            Hola <?php echo $_SESSION['usuario'];?>!
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="index.php">Inicio</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="#">Cobrados</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="salir.php">Salir</a>
                </li>
            </ul>
            </div>
        </div>
    </nav>
    <div class="container mt-4">
        <h1>
        Tickets que se han cobrado
        <small class="text-muted"></small>
        </h1>
        <table class="table">
            <thead>
            <tr>
                <th>Folio</th>
                <th>Fecha y Hora de cobro</th>
                <th>Total</th>
            </tr>
            </thead>
            <tbody>
                <?php
                foreach(MesasCobradas($conn,$_SESSION['id']) as $array){
                    echo "<tr>";
                    echo "<td>" . $array[0] . "</td>";
                    echo "<td>" . $array[7] . "</td>";
                    echo "<td>$" . $array[5] . "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
            
        </table>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>
</html>