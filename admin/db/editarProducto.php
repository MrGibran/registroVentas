<?php 
session_start();
include 'conn.php';
include 'funciones.php';

if ($_SESSION['rol'] !== 'Administrador'){
    die();
    session_destroy();
}

$idProducto = $_GET['id'];

$array = verProductosId($conn,$idProducto);
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

    <form action="actualizarProducto.php?id=<?php echo $idProducto ?>" method="POST">
            <label for="nCategoria">Categoria:</label>
            <select name="nCategoria" id="categoria">
                <option></option>
            </select>

            <label for="nProducto">Nombre Producto:</label>
            <input type="text" id="nProducto" name="nProducto" value="<?php echo $array[2] ?>" required>

            <label for="nPrecio">Precio:</label>
            <input type="number" id="nPrecio" name="nPrecio" value="<?php echo $array[3] ?>" required>

            <label for="nTexto">Descripcion:</label>
            <input type="text" id="nPrecio" name="nTexto"  value="<?php echo $array[4] ?>"  required>

            <input type="submit" value="Actualizar">
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
        document.getElementById('categoria').value = '<?php echo $array[1] ?>'

    </script>
</body>
</html>