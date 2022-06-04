<?php
session_start();
include 'funciones_mesero.php';
include 'db/conn.php';
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

<style>
        .puntero{
            cursor: pointer;
        }
        .ocultar{
            display: none;
        }
</style>

    <nav>
        <p>Hola <?php echo $_SESSION['usuario'];?></p>
        <ul><a href="salir.php">Salir</a></ul>
    </nav>
    <div id="formulario">
    <form action="" method="POST">
        <table>
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                </tr>
            </thead>
            
            <tbody id="contenedor">
                <tr class="clonar">
                    <td>
                        <select name="productos" id="producto1">
                            <option></option>
                        </select>
                    </td>
                    <td>
                        <p id="precio1"></p>
                    </td>
                    <td>
                        <input type="number" id="nombre" name="nombre" value="">
                    </td>
                    <td>
                        <span class="ocultar puntero" >Eliminar</span>
                    </td>
                </tr>
            </tbody>
        </table>
        <button type="button" onclick="/*myFunction()*/" id="agregar">+ productos</button>
        <input type="submit" value="Submit">
    </form>
    
    </div>

    <p id="demo"></p>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    var string = '<?php echo $_SESSION['usuario'];?>';
    var infoProducto = <?php echo json_encode(infoProducto($conn)) ?>;
    var select = document.getElementById('producto1');
    var count = 1;

    console.log(infoProducto);
    // este for se encarga sacar la lista de opciones en base a la consulta de php


    for (indice of infoProducto) {
        document.getElementById('producto1').innerHTML += `
            <option value=${indice[0]} >${indice[1]}</option>
        `;
        }
    ;
    
    
    select.addEventListener('change',
        function(){
            var selectedOption = this.options[select.selectedIndex];
            //Valida si si esta escuchando la seleccion
            //console.log(selectedOption.value +': ' + selectedOption.text);
            if(selectedOption.value){
                console.log(selectedOption.value +': ' + selectedOption.text);
                document.getElementById('precio1').innerHTML = infoProducto[selectedOption.value-1][2];
            }
        });


        //Codigo Funcional
        let agregar = document.getElementById('agregar');
        let contenido = document.getElementById('contenedor');

        agregar.addEventListener('click', e =>{
            e.preventDefault();
            let clonado = document.querySelector('.clonar');
            let clon = clonado.cloneNode(true);

            contenido.appendChild(clon).classList.remove('clonar');

            let remover_ocultar = contenido.lastChild.childNodes[7].querySelectorAll('span');

            //comprueba que este leyendo la etiqueta correcta
            console.log(contenido.lastChild.childNodes[7])
            
            remover_ocultar[0].classList.remove('ocultar');
        });

        contenido.addEventListener('click', e =>{
            e.preventDefault();
            if(e.target.classList.contains('puntero')){
                let contenedor  = e.target.parentNode.parentNode;
            
                contenedor.parentNode.removeChild(contenedor);
            }
        });

    </script>
    <script src="js/registrar.js"></script>
</body>
</html>