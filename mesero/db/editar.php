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
</head>
<body>
    <nav>
        <a href="../"> Regresar</a>
    </nav>
    <style>
            .puntero{
                cursor: pointer;
            }
            .ocultar{
                display: none;
            }
    </style>
    <table>
        <thead>
                <tr>
                    <th>Folio</th>
                    <th>Mesa</th>
                    <th>Total</th>
                </tr>
        </thead>
        <tbody>
                <tr>
                    <td><?php echo $datos[0];?></td>
                    <td><?php echo $datos[3];?></td>
                    <td>$<?php echo $datos[5];?></td>
                </tr>
        </tbody>
    </table>
    <table>
        <thead>
                <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                    <th>Total</th>
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
                echo "<td><a href='borrar.php?idProducto=$array[0]&id=$idProducto'>Borrar</a></td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
    <form action="productoTicket.php?id=<?php echo $_GET["id"]?>" method="POST">
        <table>
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                </tr>
            </thead>
            <tbody id="contenedor">
                <tr class="producto1">
                    <td>
                        <select name="producto[1]" id="producto1">
                            <option></option>
                        </select>
                    </td>
                    <td>
                        <input type="number" min="1" name="cantidad[1]" required>
                    </td>
                    <td>
                        <span class="ocultar puntero" id="evento1">Eliminar</span>
                    </td>
                </tr>
            </tbody>
        </table>
        <button type="button" id="agregar">+ productos</button>
        <input type="submit" value="Agregar Productos">
    </form>
    <a href="cobrar.php?id=<?php echo $idProducto?>">Cobrar</a>
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
</body>
</html>