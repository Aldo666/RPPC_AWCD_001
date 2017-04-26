<?php
session_start();
include ('class/class.php');
if ($_POST){
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $password = $_POST['password'];
    $privilegios = $_POST['privilegios'];
    
    $update = new Usuarios();
    $update-> actualizar($id, $nombre, $password, $privilegios);
    
}
?>