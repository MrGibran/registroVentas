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
        <ul><a href="#">Productos</a></ul>
        <ul><a href="categorias.php">Categorias</a></ul>
        <ul><a href="salir.php">Salir</a></ul>
    </nav>
        <thead>
            <tr>
                <th>Categoria</th>
                <th>Producto</th>
                <th>Precio</th>
                <th>Mesa</th>
                <th>Descripcion</th>
                <th></th>
            </tr>
        </thead>
            <tbody>
            <?php
            foreach(verProductos($conn) as $array){
                echo "<tr>";
                echo "<td>" . $array[1] . "</td>";
                echo "<td>" . $array[2] . "</td>";
                echo "<td>$" . $array[3] . "</td>";
                echo "<td>" . $array[4] . "</td>";
                echo "<td> <a href='db/editarProducto.php?id=$array[0]'> Editar</a>  </td>";
                echo "</tr>";
            }
            ?>
            </tbody>
    </table>

    <form action="db/insertarProducto.php" method="POST">
            <label for="nCategoria">Categoria:</label>
            <select name="nCategoria" id="categoria">
                <option></option>
            </select>

            <label for="nProducto">Nombre Producto:</label>
            <input type="text" id="nProducto" name="nProducto" required>

            <label for="nPrecio">Precio:</label>
            <input type="number" id="nPrecio" name="nPrecio" required>

            <label for="nTexto">Descripcion:</label>
            <input type="text" id="nPrecio" name="nTexto" required>

            <input type="submit" value="Agregar Productos">
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