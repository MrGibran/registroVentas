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
            
            <tbody id="tbody">
                <tr>
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
                </tr>
            </tbody>
        </table>
        <button type="button" onclick="myFunction()">+ productos</button>
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
   
    function myFunction() {
    count++
    document.getElementById("tbody").innerHTML += `
        <tr>
            <td>
                <select name="producto" id="producto${count}">
                    <option></option>
                </select>
            </td>
            <td>
                <p id="precio${count}"></p>
            </td>
            <td>
                 <input type="number" id="nombre" name="nombre" value="">
            </td>
        </tr>
        `;
    ;

    console.log(count)
    }

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


    </script>
    <script src="js/registrar.js"></script>
</body>
</html>