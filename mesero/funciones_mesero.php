<?php

function infoProducto($conn){
    $sql="SELECT id_producto,nombre, Precio_de_Venta  FROM producto";
    $result = mysqli_query($conn, $sql);
        $data = mysqli_fetch_all ($result, MYSQLI_NUM);
        return $data;

}

?>