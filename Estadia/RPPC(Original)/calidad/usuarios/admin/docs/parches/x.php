<?php

include ('class/class.php');

$q_c = "SELECT COUNT(id) FROM documentos";
        $result_c = mysql_query($q_c, Conexion::conectar());
        
        while ($rowc = mysql_fetch_row($result_c)){
            $conteo = $rowc[0];
        }
        
        echo $conteo."<br>";
        
        $i=1;
        while ($i<=$conteo){
            echo $i." ";
            
            $q_c = "SELECT * FROM documentos WHERE id = '$i'";
        $result_c = mysql_query($q_c, Conexion::conectar());
        
        while ($rowc = mysql_fetch_row($result_c)){
            $fecha_reg = $rowc[10];
        } 
         echo $fecha_reg." - ";
         
         $dia = substr($fecha_reg,0,2);
         $mes = substr($fecha_reg,3,2);
         $an = substr($fecha_reg,6,4);
         
         $fecha_n = $an."-".$mes."-".$dia;
         
         echo $fecha_n."<br>";
         
         $sql = "UPDATE documentos SET fecha_reg = '$fecha_n' WHERE id = '$i'";
        $result =mysql_query($sql, Conexion::conectar());
            
            $i++;
        }

/*        
$sql = "UPDATE x SET fecha_reg = REPLACE(fecha_reg, "/", '-')";
        $result =mysql_query($sql, Conexion::conectar());
*/
    ?>