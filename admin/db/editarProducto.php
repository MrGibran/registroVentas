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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

</head>
<body>
<nav class="navbar navbar-expand-lg bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
            <img src="../../img/logo1.png" alt="" width="" height="65" class="d-inline-block align-text-center">
            Hola <?php echo $_SESSION['usuario'];?>!
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="../productos.php">Regresar</a>
                </li>
            </ul>
            </div>
        </div>
</nav>
<div class="container mt-4">
    <h1>Editar</h1>
    <form action="actualizarProducto.php?id=<?php echo $idProducto ?>" method="POST">
            <div class="mb-3">
                <label for="nCategoria" class="form-label">Categoria:</label>
                <select name="nCategoria" id="categoria" class="form-select">
                    <option></option>
                </select>
            </div>
            
            <div class="mb-3">
                <label for="nProducto" class="form-label">Nombre Producto:</label>
                <input class="form-control" type="text" id="nProducto" name="nProducto" value="<?php echo $array[2] ?>" required>
            </div>
            <div class="mb-3">
                <label for="nPrecio" class="form-label">Precio:</label>
                <input class="form-control" type="number" id="nPrecio" name="nPrecio" value="<?php echo $array[3] ?>" required>
            </div>
            <div class="mb-3">
                <label for="nTexto" class="form-label">Descripcion:</label>
                <input class="form-control" type="text" id="nPrecio" name="nTexto"  value="<?php echo $array[4] ?>"  required>
            </div>
            <input type="submit" value="Actualizar" class="btn btn-success">
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
        document.getElementById('categoria').value = '<?php echo $array[1] ?>'

    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>

</body>
</html>