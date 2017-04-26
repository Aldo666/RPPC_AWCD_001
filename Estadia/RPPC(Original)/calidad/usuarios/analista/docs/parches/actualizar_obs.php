<?php

include ('class/class.php');

$q_c = "SELECT COUNT(id) FROM x";
        $result_c = mysql_query($q_c, Conexion::conectar());
        
        while ($rowc = mysql_fetch_row($result_c)){
            $conteo = $rowc[0];
        }
        
        echo $conteo."<br>";
        
        $i=1;
        while ($i<=$conteo){
            echo $i." ";
            
            $q_c = "SELECT * FROM x WHERE id = '$i'";
        $result_c = mysql_query($q_c, Conexion::conectar());
        
        while ($rowc = mysql_fetch_row($result_c)){
            $obs = $rowc[3];
        } 
         echo $obs." - ";
         
         if($obs == ""){
             $obs_n = "Sin observaciones";
              
         }else{
         $obs_n = $obs;
         }
         
         echo $obs_n."<br>";
         
        
            
            $i++;
        }

/*        
$sql = "UPDATE x SET fecha_reg = REPLACE(fecha_reg, "/", '-')";
        $result =mysql_query($sql, Conexion::conectar());
*/
    ?>