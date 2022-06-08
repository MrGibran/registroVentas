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
    <title>Administrador - Productos</title>
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
            <a class="nav-link" href="productos.php">Productos</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="#">Categorias</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="salir.php">Salir</a>
            </li>
        </ul>
        </div>
    </div>
    </nav>
<nav>

<div class="container mt-4">
<h1>Categorias Creadas</h1>
<table class="table">
        <thead>
            <tr>
                <th>Nombre de la categoria</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach(verCategorias($conn) as $array){
                echo "<form action='db/editarCategoria.php?id=$array[0]' method='POST'>";
                echo "<tr>";
                echo "<td> <input type='text' name='categoria' placeholder='$array[1]' class='form-control' required> </td>";
                echo "<td> <input type='submit' value='Actualizar' class='btn btn-dark'> </td>";
                echo "</tr>";
                echo "</form>";
            }
            ?>
        </tbody>
</table>
<h1>
    Crear Nueva categoria
</h1>
    <form action="db/insertarCategoria.php" method="POST" class="card p-2">
        <div class="mb-3">
            <label for="categoria" class="form-label">Nombre Categoria:</label>
            <input type="text" id="nProducto" name="categoria" class="form-control" required>
        </div>
            <input type="submit" value="Agregar" class='btn btn-success'>
    </form>


</div>

<script>
        var infoCategoria = <?php echo json_encode(infoCategoria($conn)) ?>;

        console.log(infoCategoria);

        for (indice of infoCategoria) {
                document.getElementById('categoria').innerHTML += `
                    <option value=${indice[0]} >${indice[1]}</option>
                `;
                }
            ;

</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>

</body>
</html>