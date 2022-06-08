<?php 
function CrearMesa($conn,$mesa,$fecha,$usuario){
    $sql="INSERT INTO ticket VALUES (NULL, '$usuario', '$fecha', '$mesa', '0', '0', 'pendiente',NULL)";
    if (mysqli_query($conn, $sql)) {
        echo "New record created successfully";
    }
}
function MesasPendientes($conn,$usuario){
    $sql="SELECT * FROM ticket WHERE usuario = '$usuario' && estado = 'pendiente'";
    $result = mysqli_query($conn, $sql);
    $data = mysqli_fetch_all ($result, MYSQLI_NUM);
    return $data;

}
function MesasCobradas($conn,$usuario){
    $sql="SELECT * FROM ticket WHERE usuario = '$usuario' && estado = 'cobrado'";
    $result = mysqli_query($conn, $sql);
    $data = mysqli_fetch_all ($result, MYSQLI_NUM);
    return $data;

}

function mesActualEsp(){
    $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
    echo $meses[date('n')-1];
}

function editarMesa($conn,$folio){
    $sql="SELECT * FROM ticket WHERE folio = '$folio'";
    $result = mysqli_query($conn, $sql);
    $data = mysqli_fetch_array($result, MYSQLI_NUM);
    return $data;

}

function infoProducto($conn){
    $sql="SELECT id_producto,nombre FROM producto";
    $result = mysqli_query($conn, $sql);
    $data = mysqli_fetch_all ($result, MYSQLI_NUM);
    return $data;

}

function detalleTicket($conn,$id){
    $sql = "SELECT detalle_ticket.id_detalle_ticket AS'ID', producto.nombre AS 'Producto', detalle_ticket.cantidad,producto.Precio_de_Venta AS 'Precio',detalle_ticket.precio AS 'Total' FROM producto JOIN detalle_ticket ON producto.id_producto = detalle_ticket.id_producto WHERE detalle_ticket.folio = '$id' ORDER BY detalle_ticket.id_detalle_ticket";
    $result = mysqli_query($conn, $sql);
    $data = mysqli_fetch_all($result, MYSQLI_NUM);
    return $data;
}

function InsertardetalleTicket($conn,$nDatos,$Productos,$Cantidad,$id){
    $values = [];
    for ($i=1; $i <= $nDatos; $i++) {

        $consulta = "SELECT Precio_de_Venta FROM producto WHERE id_producto = '$Productos[$i]'";
        $result = mysqli_query($conn, $consulta);
        $precio = mysqli_fetch_array($result, MYSQLI_NUM);
        $precioFinal = $precio[0] * $Cantidad[$i];
        $values [] = "(NULL, '$Productos[$i]', '$id', '$Cantidad[$i]', '$precioFinal')";
    }

    $sql="INSERT INTO detalle_ticket VALUES \n" .implode(",\n", $values);

    if (mysqli_query($conn, $sql)) {
        echo "New record created successfully";
        $consulta2 = "SELECT SUM(precio) FROM detalle_ticket WHERE folio = '$id'";
        $result = mysqli_query($conn, $consulta2);
        $Total = mysqli_fetch_array($result, MYSQLI_NUM);

        $sql2 = "UPDATE ticket SET total = '$Total[0]' WHERE folio = '$id'";
        if (mysqli_query($conn, $sql2)){
            echo "Total actualizado";
        }
    }
}

function borrarDetalleTicket ($conn,$idDetalleTicket,$idFolio){
    $sql = "DELETE FROM detalle_ticket WHERE id_detalle_ticket = '$idDetalleTicket' AND folio = '$idFolio'";
    if(mysqli_query($conn, $sql)){
        echo "eliminado";
        $consulta2 = "SELECT SUM(precio) FROM detalle_ticket WHERE folio = '$idFolio'";
        $result = mysqli_query($conn, $consulta2);
        $Total = mysqli_fetch_array($result, MYSQLI_NUM);

        $sql2 = "UPDATE ticket SET total = '$Total[0]' WHERE folio = '$idFolio'";
        if (mysqli_query($conn, $sql2)){
            echo "Total actualizado";
        }
    }
    
}


function cobrar($conn,$folio,$fecha){
    $sql = "UPDATE ticket SET estado = 'cobrado', fecha_salida = '$fecha' WHERE folio = '$folio'";
    if(mysqli_query($conn, $sql)){
        echo "Cobrado, no olvides pedir la propina";
    }
}
?>

