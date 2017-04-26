<?php
session_start();
include('class/class.php');
   if($_POST){
   $id = $_POST['id']; 
   $delete = new Usuarios();
   $delete->eliminar_usuarios($id);
   } 
   ?>