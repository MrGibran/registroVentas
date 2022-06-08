<?php 
session_start();
include 'funciones.php';
include 'conn.php';

$datos = editarMesa($conn,$_GET["id"]);
$idProducto = $_GET["id"];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Editar</title>
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
                <a class="nav-link active" aria-current="page" href="../">Regresar</a>
                </li>
            </ul>
            </div>
        </div>
    </nav>
    <style>
            .puntero{
                cursor: pointer;
            }
            .ocultar{
                display: none;
            }
    </style>
<div class="container card mt-4">
    <div class="container mt-4">
        <h1>
        Folio <?php echo $datos[0];?>
        <small class="text-muted">Mesa: <?php echo $datos[3];?></small>
        </h1>
        <h2>
            Total: $<?php echo $datos[5];?>
        </h2>

    </div>

    <div class="container mt-4">
        <h4>Borrar productos de la Mesa</h4>
        <table class="table">
            <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Precio</th>
                        <th>Total</th>
                        <th></th>
                    </tr>
            </thead>
            <tbody>
                <?php
                foreach(detalleTicket($conn,$idProducto) as $array){
                    echo "<tr>";
                    echo "<td>" . $array[1] . "</td>";
                    echo "<td>" . $array[2] . "</td>";
                    echo "<td>$" . $array[3] . "</td>";
                    echo "<td>$" . $array[4] . "</td>";
                    echo "<td><a href='borrar.php?idProducto=$array[0]&id=$idProducto' class='btn btn-danger'>Borrar</a></td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
    
    <div class="container mt-4">
    <h4>Agregar productos a la Mesa</h4>
    <form action="productoTicket.php?id=<?php echo $_GET["id"]?>" method="POST">
        <table class="table">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                </tr>
            </thead>
            <tbody id="contenedor">
                <tr class="producto1">
                    <td>
                        <select name="producto[1]" id="producto1" class="form-select">
                            <option></option>
                        </select>
                    </td>
                    <td>
                        <input type="number" min="1" name="cantidad[1]"  class="form-control" required>
                    </td>
                    <td>
                        <span class="btn btn-danger ocultar puntero" id="evento1">Eliminar</span>
                    </td>
                </tr>
            </tbody>
        </table>
        <button type="button" id="agregar" class="btn btn-primary">+ productos</button>
        <input type="submit" value="Insertar Productos" class="btn btn-primary">
    </form>
    </div>
<div class="container mt-4 mb-4">
    <div class="d-grid gap-2">
        <a href="cobrar.php?id=<?php echo $idProducto?>" class="btn btn-success">Cobrar</a>
    </div>
</div>
</div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        //Vine una conjuncion de php y javascript
        var infoProducto = <?php echo json_encode(infoProducto($conn)) ?>;

        console.log(infoProducto);

        for (indice of infoProducto) {
                document.getElementById('producto1').innerHTML += `
                    <option value=${indice[0]} >${indice[1]}</option>
                `;
                }
            ;

        let agregar = document.getElementById('agregar');
        let contenido = document.getElementById('contenedor');
        var count = 1;

        agregar.addEventListener('click', e =>{
            e.preventDefault();
            count ++;
            //checha que la sumatoria se este haciendo correctamente
            console.log(count);
            let clonado = document.querySelector('.producto1');
            let clon = clonado.cloneNode(true);

            //remueve el de clonar y agrega el numero de copia
            contenido.appendChild(clon).classList.remove('producto1');
            contenido.appendChild(clon).classList.add(`producto${count}`);


            ///---------------------------------------------
            //Editar el precio1 y agregarle un contador precioN
            //contenido.lastChild.childNodes[3].classList.add(`${count}`);

            // se encarga de renombar el id del precio para cada nodo agregado
            contenido.lastChild.childNodes[5].childNodes[1].removeAttribute('id');
            contenido.lastChild.childNodes[5].childNodes[1].setAttribute('id',`evento${count}`);

            contenido.lastChild.childNodes[1].childNodes[1].removeAttribute('id');
            contenido.lastChild.childNodes[1].childNodes[1].setAttribute('id',`producto${count}`);

            contenido.lastChild.childNodes[1].childNodes[1].removeAttribute('name');
            contenido.lastChild.childNodes[1].childNodes[1].setAttribute('name',`producto[${count}]`);

            contenido.lastChild.childNodes[3].childNodes[1].removeAttribute('name');
            contenido.lastChild.childNodes[3].childNodes[1].setAttribute('name',`cantidad[${count}]`);
            //habilita la opcion de eliminar el nodo agregado
            let remover_ocultar = contenido.lastChild.childNodes[5].querySelectorAll('span');

            remover_ocultar[0].classList.remove('ocultar');

            borrar(count);
        });

        function borrar(n) {
            console.log(document.getElementById(`evento${n}`));

            document.getElementById(`evento${n}`).addEventListener('click',e =>{
                e.preventDefault();
                if(e.target.classList.contains('puntero')){
                let contenedor  = e.target.parentNode.parentNode;
                contenedor.parentNode.removeChild(contenedor);
                count --;
            }

            });

        }




    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>
</html>