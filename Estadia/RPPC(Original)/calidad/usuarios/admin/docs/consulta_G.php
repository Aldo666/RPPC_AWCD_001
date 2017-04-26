<?php   
session_start();
include ('class/class.php');

$coddoc = "";
$tipox = "";
$numx = "";
$vl = "";
$p_p = "";
$tipo = "";
$num = "";
?>
<!DOCTYPE HTML>
<html>
    <head> <!--CONTIENE INFORMACION UTIL PARA EL NAVEGADOR-->
        <title>Calidad</title>
        <meta charset="utf-8">
        <meta name="description" content="Consulta de Documentos">
        <meta name="keyword" content="RPPC">
        <meta name="viewport" content="width=device-width,initial-scale=1"/>
        <link rel="shortcut icon" type="image/x-icon" href="favicon.ico"/>    
        <link href="css/estilos.css" rel="stylesheet" type="text/css">
        <link href="css/formularios.css" rel="stylesheet" type="text/css">

    </head>
    <body>
        <?php
        if ($_SESSION['privilegios_s'] != 'Administrador') {
            session_destroy();
            echo '<script type="text/javascript">
                alert("Para acceder primero necesita Iniciar Sesion  o Contar con los permisos nesesarios");
                window.location.href="../../../index.php";      
                </script>';
        }
        ?>
        <div id="wrapper">
            <header>
                <figure>
                    <img src="img/logo.png"/>
                </figure>
            </header>
            <nav>
                <ul>
                    <li><a href="consultas.php">Regresar</a>
                        <?php
                        if ($_SESSION['nombre_s']) {
                            echo '<li><a href="../logout.php">Cerrar Sesi&oacute;n</a></li>';
                        } else {
                            ?>
                            <?php
                        }
                        ?>
                </ul>
            </nav>
            <section id="contenedor">
                <section id="slideindex_cong">
                    <h1>Consulta General</h1>
                    <form id="tipo" action = "" method="post" enctype="multipart/form-data">
                        <fieldset>
                            <table id="docs">
                                <tr>
                                    <th>TIPO DE DOCUMENTO:</th>
                                    <td colspan="2">
                                        <div id="campo">
                                            <?php
                                            $consulta_mysql = 'SELECT * FROM tipodoc';
                                            $resultado_consulta_mysql = mysql_query($consulta_mysql, Conexion::conectar());

                                            echo "<select name='tipo'>";
                                            echo "<option>Selecciona tipo de documento</option>";


                                            while ($fila = mysql_fetch_array($resultado_consulta_mysql)) {
                                                echo "<option value='" . $fila['tipo'] . "'>" . $fila['descripcion'] . "</option>";
                                            }
                                            echo "<option  value='T'>TODOS LOS DOCUMENTOS</option>";
                                            echo "</select>";
                                            ?>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3" style="text-align: center">
                                        <input class="button" type="submit" value="Generar Busqueda" required="required">
                                    </td>
                                </tr>
                            </table>
                        </fieldset>
                    </form>
                    <?php
                    extract($_POST);

                    $pal = $tipo;

                    if ($pal != "") {
                        $sql = "SELECT * FROM documentos WHERE tipo = '$pal' ";

                        $c_conteo = "SELECT COUNT(tipo) FROM documentos WHERE tipo = '$pal'";

                        if ($pal == "T") {
                            $sql = "SELECT * FROM documentos ORDER BY tipo ASC";

                            $c_conteo = "SELECT COUNT(tipo) FROM documentos";
                        }

                        $result = mysql_query($c_conteo, Conexion::conectar());
                        while ($row = mysql_fetch_array($result)) {
                            $conteo = $row[0];
                        }

                        echo "<p style='text-align: center'>Se han encontrado " . $conteo . " documentos. </p>
                            <table id='docs' border='1'>
                    <tr style='background-color:darkred; color: white; '>
                    <th>CODIGO</th>
                        <th>NOMBRE</th>
                        <th>PROCESO RESPONSABLE</th>
                        <th>&Aacute;REA DE APLICACI&Oacute;N</th>
                        <th>FORMATO</th>
                        <th>REVISI&Oacute;N ANTERIOR</th>
                        <th>REVISI&Oacute;N VIGENTE</th>
                        <th>FECHA DE REGISTRO</th>
                        <th>ESTADO</th>
                        <th>OBSERVACIONES</th>
                        <th>EDITAR</th>
                        <th>ELIMINAR</th>
                    </tr>";

                        $result = mysql_query($sql, Conexion::conectar());
                        while ($row = mysql_fetch_array($result)) {
                            ?>

                            <tr>
                                <td> <?php echo $row[13] ?></td>
                                <td> <?php echo $row[4] ?></td>
                                <td> <?php echo $row[5] ?></td>
                                <td> <?php echo $row[6] ?></td>
                                <td> <?php echo $row[7] ?></td>
                                <td> <?php echo $row[8] ?></td>
                                <td> <?php echo $row[9] ?></td>
                                <td> <?php echo $row[10] ?></td>
                                <td> <?php echo $row[11] ?></td>
                                <td> <?php echo $row[12] ?></td>
                                <td>
                                    <form action="editar_doc.php" method="post">
                                        <input type="hidden" name="id" value="<?php echo $row[0]; ?>">
                                        <input type="submit" value="Editar">
                                    </form>
                                </td>
                                <td> 
                                    <form action="eliminar_doc.php" method="post" id="form_delete" onsubmit="return confirm('¿Seguro que desea Eliminar este Documento...?');">
                                        <input type="hidden" name="id" value="<?php echo $row[0] ?>">
                                        <input type="submit" value="Eliminar" >
                                    </form>
                                </td>
                            </tr>
                            <?php
                        }
                        echo "</table>";
                    }
                    ?>
                </section>
            </section>	
            <footer> 
                <div id="txtfooter">
                    <p>2015 &Aacute;rea de Desarrollo Institucional.</p>
                    <p>TODOS LOS DERECHOS RESERVADOS.</p>
                </div>
            </footer>
        </div>
    </body>
</html>