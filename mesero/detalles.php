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
                        <select name="productos1" id="producto1">
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
                        <span class="ocultar puntero" id="evento">Eliminar</span>
                    </td>
                </tr>
            </tbody>
        </table>
        <button type="button" id="agregar">+ productos</button>
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
    
    calcular(count);
    

   // select.addEventListener('change',
     //   function(){
      //      var selectedOption = this.options[select.selectedIndex];
        //    //Valida si si esta escuchando la seleccion
          //  //console.log(selectedOption.value +': ' + selectedOption.text);
            //if(selectedOption.value){
              //  console.log(selectedOption.value +': ' + selectedOption.text);
                //document.getElementById('precio1').innerHTML = infoProducto[selectedOption.value-1][2];
            //}
       // });


        //Codigo Funcional
        let agregar = document.getElementById('agregar');
        let contenido = document.getElementById('contenedor');

        agregar.addEventListener('click', e =>{
            e.preventDefault();
            count ++;
            //checha que la sumatoria se este haciendo correctamente
            console.log(count);
            let clonado = document.querySelector('.clonar');
            let clon = clonado.cloneNode(true);

            //remueve el de clonar y agrega el numero de copia
            contenido.appendChild(clon).classList.remove('clonar');
            contenido.appendChild(clon).classList.add(`clonado${count}`);


            ///---------------------------------------------
            //Editar el precio1 y agregarle un contador precioN
            contenido.lastChild.childNodes[3].classList.add(`${count}`);
            // se encarga de renombar el id del precio para cada nodo agregado
            contenido.lastChild.childNodes[3].childNodes[1].removeAttribute('id');
            contenido.lastChild.childNodes[3].childNodes[1].setAttribute('id',`precio${count}`);

            contenido.lastChild.childNodes[1].childNodes[1].removeAttribute('id');
            contenido.lastChild.childNodes[1].childNodes[1].setAttribute('id',`producto${count}`);

            contenido.lastChild.childNodes[1].childNodes[1].removeAttribute('name');
            contenido.lastChild.childNodes[1].childNodes[1].setAttribute('name',`productos${count}`);

            //habilita la opcion de eliminar el nodo agregado
            let remover_ocultar = contenido.lastChild.childNodes[7].querySelectorAll('span');

            //comprueba que este leyendo la etiqueta correcta
            //console.log(contenido.lastChild.childNodes[7])

            remover_ocultar[0].classList.remove('ocultar');

            //usar la funcion
            calcular(count);
        });

        //contenido hay que corregirla
        console.log(document.getElementById('evento'));

        document.getElementById('evento').addEventListener('click', e =>{
            e.preventDefault();
            //checha que la sumatoria se este haciendo correctamente
            count --;
            if(e.target.classList.contains('puntero')){
                let contenedor  = e.target.parentNode.parentNode;
            
                contenedor.parentNode.removeChild(contenedor);
            }
        });

        //flata reacomodar la funcion calcular
        function calcular(n){
        var numero = n;
        document.getElementById(`producto${numero}`).addEventListener('change',
            function(){
                console.log(numero);
                var selectedOption = this.options[select.selectedIndex];
                //Valida si si esta escuchando la seleccion
                //console.log(selectedOption.value +': ' + selectedOption.text);
                if(selectedOption.value){
                    console.log(selectedOption.value +': ' + selectedOption.text);
                    document.getElementById(`precio${numero}`).innerHTML = infoProducto[selectedOption.value-1][2];
                }
            });
        };

    </script>
    <script src="js/registrar.js"></script>
</body>
</html>