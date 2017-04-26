<?php

include ('class/class.php');


         $sql = "UPDATE documentos SET codigo = CONCAT(p_p,tipo,num) WHERE codigo =''";
        $result =mysql_query($sql, Conexion::conectar());
            
          
    ?>