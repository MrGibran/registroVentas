<?php
include 'db/conn.php';

$nickname = $_POST['nombre'];
$password = $_POST['password'];

validarUsuario($conn,$nickname,$password); 

function validarUsuario($conn,$nickname,$password){
    $sql = "SELECT * FROM `usuario` WHERE nickname = '$nickname' && contrasena = '$password'";
    $result = mysqli_query($conn,$sql);
    $data = mysqli_fetch_row ($result);
    echo $data[3];
    if ($data == null) {
        echo 'Hay algo mal';
    } else {
        if ($nickname == 'ADMIN') {
            session_start();
            $_SESSION['id'] = $data[0];
            $_SESSION['rol'] = $data[2];
            $_SESSION['usuario'] = $data[3];
            header("Location:admin/index.php");
        }else{
            session_start();
            $_SESSION['id'] = $data[0];
            $_SESSION['rol'] = $data[2];
            $_SESSION['usuario'] = $data[3];
            header("Location:mesero/index.php");
        }
    }
}


//session_start();
//$_SESSION['usuario'] = '';
//header("Location:panel.php");

?>