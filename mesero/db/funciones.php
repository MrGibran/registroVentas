<?php 
function CrearMesa($conn,$mesa,$fecha,$usuario){
    $sql="INSERT INTO ticket VALUES (NULL, '$usuario', '$fecha', '$mesa', '0', '0', 'pendiente')";
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

?>

