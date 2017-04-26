<?php

include ('class/class.php');


         $sql = "UPDATE documentos, x SET documentos.fecha_reg = x.fecha_reg WHERE documentos.id = x.id";
         echo $sql;
        $result =mysql_query($sql, Conexion::conectar());
            
          
    ?>