<?php

include ('class/class.php');


         $sql = "UPDATE documentos SET rev_v = CONCAT('0',rev_v) WHERE rev_v = < 10";
        $result =mysql_query($sql, Conexion::conectar());
            
          
    ?>