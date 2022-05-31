<?php
session_start();
echo $_SESSION['usuario'];

if($_SESSION['usuario'] == null || $_SESSION['usuario'] == ''){

    echo 'usted no tiene autorizcion';
    die();
}

//session_destroy()
//header()// a donde redirigir
?>