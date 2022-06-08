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
</head>
<body>
<table>
    <nav>
        <p>Hola <?php echo $_SESSION['usuario'];?></p>
        <ul><a href="index.php">Inicio</a></ul>
        <ul><a href="productos.php">Productos</a></ul>
        <ul><a href="#">Categorias</a></ul>
        <ul><a href="salir.php">Salir</a></ul>
    </nav>
        <thead>
            <tr>
                <th>Categoria</th>
            </tr>
        </thead>
            <tbody>
            <?php
            foreach(verCategorias($conn) as $array){
                echo "<form action='db/editarCategoria.php?id=$array[0]' method='POST'>";
                echo "<tr>";
                echo "<td> <input type='text' name='categoria' placeholder='$array[1]' required> </td>";
                echo "<td> <input type='submit' value='Actualizar'> </td>";
                echo "</tr>";
                echo "</form>";
            }
            ?>
            </tbody>
    </table>

    <form action="db/insertarCategoria.php" method="POST">
            <label for="categoria">Nombre Categoria:</label>
            <input type="text" id="nProducto" name="categoria" required>

            <input type="submit" value="Agregar">
    </form>

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
</body>
</html>