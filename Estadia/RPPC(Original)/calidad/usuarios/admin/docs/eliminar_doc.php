<?php
session_start();
include ('class/class.php');
if ($_POST){
    
    extract($_POST);
    
    $update = new Documentos ();
    $update -> eliminar_doc($id);
}
    ?>