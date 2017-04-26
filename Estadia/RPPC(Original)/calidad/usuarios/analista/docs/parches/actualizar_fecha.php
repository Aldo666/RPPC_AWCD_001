<?php

include ('class/class.php');

$q_c = "SELECT COUNT(id) FROM x";
        $result_c = mysql_query($q_c, Conexion::conectar());
        
        while ($rowc = mysql_fetch_row($result_c)){
            $conteo = $rowc[0];
        }
        
        echo $conteo."<br>";
        
        $i=251;
        while ($i<=$conteo){
            echo $i." ";
            
            $q_c = "SELECT * FROM x WHERE id = '$i'";
        $result_c = mysql_query($q_c, Conexion::conectar());
        
        while ($rowc = mysql_fetch_row($result_c)){
            $fecha_reg = $rowc[1];
        } 
         echo $fecha_reg." - ";
         
         if($fecha_reg == ""){
             $fecha_n = "0000-00-00";
         }else{
         
         $dia = substr($fecha_reg,0,2);
         $mes = substr($fecha_reg,3,2);
         $an = substr($fecha_reg,6,4);
         
         $fecha_n = $an."-".$mes."-".$dia;
         }
         
         echo $fecha_n."<br>";
         
         $sql = "UPDATE x SET fecha_reg = '$fecha_n' WHERE id = '$i'";
        $result =mysql_query($sql, Conexion::conectar());
            
            $i++;
        }

/*        
$sql = "UPDATE x SET fecha_reg = REPLACE(fecha_reg, "/", '-')";
        $result =mysql_query($sql, Conexion::conectar());
*/
    ?>