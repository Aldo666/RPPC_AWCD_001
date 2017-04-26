<?php
Class Conexion {

    public static function conectar() {
        
        $user="root";
        $pass="";
        $server="localhost";
        $db="di_calidad";
        
        $con = mysql_connect('localhost', 'root', '') or die("Error de Conexi&oacute;n al Servidor");
        mysql_query("SET NAMES 'utf8'");
        mysql_select_db("di_calidad") or die("La base de datos no existe");
        return $con;
    }

}

Class Documentos {
    
    public function agregar_doc($p_p, $codigo, $tipox, $numx, $nombre, $p_resp, $area_api, $formato, $rev_a, $rev_v, $fecha_reg, $estado, $observacion){
        $a_a = implode(" - ",$area_api);
        $sql = "INSERT INTO documentos(id, p_p, tipo, num, nombre, p_resp, area_api, formato, rev_a, rev_v, fecha_reg, estado, observacion, codigo)"
                . " VALUES ('" . NULL . "','" . $p_p . "', '" . $tipox . "', '" . $numx . "', '" . $nombre . "', '" . $p_resp . "', '" . $a_a . "', '" . $formato . "', '" . $rev_a . "', '" . $rev_v . "', '" . $fecha_reg . "', '" . $estado . "', '" . $observacion . "', '".$codigo."')";
        $result = mysql_query($sql, Conexion::conectar());
        echo '<script type="text/javascript">
                  alert ("°Documento Registrado Exitosamente!");
                  window.location.href="agregar_doc.php";
                 </script>';
         
    }
    
    public function eliminar_doc($id) {
        $sql = "DELETE FROM documentos WHERE id = $id";
        $result = mysql_query($sql, Conexion::conectar());
        echo '<script type="text/javascript">
                  window.location.href="consultas.php";      
                 </script>';
    }
    
    public function actualizar($id, $area_api_a, $nombre, $p_resp, $area_api, $formato, $rev_a, $rev_v, $fecha_reg, $estado, $observacion){
        
        $a_a = "";
        
        if($area_api != ""){
            $a_a = implode(" - ",$area_api);
        }
        
        if($a_a == ""){
            $a_a = $area_api_a;
        }
        
        $sql = "UPDATE documentos SET nombre = '$nombre', p_resp = '$p_resp', area_api = '$a_a', formato ='$formato', rev_a = '$rev_a', rev_v = '$rev_v', fecha_reg = '$fecha_reg', estado = '$estado', observacion = '$observacion' WHERE id = $id ";
        $result =mysql_query($sql, Conexion::conectar());
         echo '<script type="text/javascript">
                  alert("°Documento Actualizado con Exito!");
                  window.location.href="consultas.php";
                 </script>';
    }
}

Class Sesion {
            
    public function ingresar($usuario, $password) {
        $sql = "SELECT * FROM usuarios WHERE usuario = '$usuario' AND password = '$password' ";
        $result = mysql_query($sql, Conexion::conectar());
        
        $num_filas = mysql_num_rows($result);
        
        if($num_filas == 1){
            
        if ($fila = mysql_fetch_array($result)) {
            $_SESSION['nombre_s'] = $fila[1];
            $_SESSION['privilegios_s'] = $fila[4];
            
            echo '<script type="text/javascript">
                  window.location.href="menu.php";      
                 </script>';
        }
        }else{
          echo '<script type="text/javascript">
                  alert("Usuario o Contrase√±a Incorrecta");
                 </script>';  
        }
       
   
    }

}




?>
