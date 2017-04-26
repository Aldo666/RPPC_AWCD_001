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
        if ($_SESSION['privilegios_s'] != 'User') {
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
                    <h1>Consulta Especifica</h1>
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
                                    <th>CODIGO: </th>
                                    <td colspan="1">
                                        <div id="campo">
                                            <input name="codigo" type="text" value=""/>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th>PROCESO RESPONSABLE: </th>
                                    <td>
                                        <div id="campo">                            
                                            <select name="p_resp">
                                                <option>Selecciona el Proceso Responsable</option>
                                                <option value="AGN">AGN</option>
                                                <option value="&Aacute;REAS DE APOYO">&Aacute;REAS DE APOYO</option>
                                                <option value="ATENCI&Oacute;N Y SERVICIO A USUARIOS">ATENCI&Oacute;N Y SERVICIO A USUARIOS</option>
                                                <option value="CERTIFICACI&Oacute;N">CERTIFICACI&Oacute;N</option>
                                                <option value="DIRECCI&Oacute;N">DIRECCI&Oacute;N</option>
                                                <option value="DOCUMENTOS DE APOYO">DOCUMENTOS DE APOYO</option>
                                                <option value="GESTI&Oacute;N">GESTI&Oacute;N</option>
                                                <option value="INSCRIPCI&Oacute;N">INSCRIPCI&Oacute;N</option>
                                                <option value="REGISTRAL FOR&Aacute;NEO">REGISTRAL FOR&Aacute;NEO</option>
                                                <option value="SGC">SGC</option>
                                                <option value="SGSI">SGSI</option>
                                            </select>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th>ESTADO:</th>
                                    <td><div>
                                            <select name="estado" >
                                                <option>Selecciona el Estado</option>
                                                <option value="ACTIVO">ACTIVO</option>
                                                <option value="LIBRE">LIBRE</option>
                                            </select>
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

                    if ($_POST) {

                        if ($tipo == "Selecciona tipo de documento") {
                            $tipo = "";
                        }
                        if ($p_resp == "Selecciona el Proceso Responsable") {
                            $p_resp = "";
                        }
                        if ($estado == "Selecciona el Estado") {
                            $estado = "";
                        }

                        //Todas las Opciones
                        if ($tipo != "" && $codigo != "" && $p_resp != "" && $estado != "") {

                            $sql = "SELECT * FROM documentos WHERE tipo = '$tipo' AND codigo = '$codigo' AND p_resp = '$p_resp' AND estado ='$estado'";
                            $c_conteo = "SELECT COUNT(tipo) FROM documentos WHERE tipo = '$tipo' AND codigo = '$codigo' AND p_resp = '$p_resp' AND estado ='$estado'";


                            if ($tipo == "T") {
                                $sql = "SELECT * FROM documentos WHERE codigo = '$codigo' AND p_resp = '$p_resp' AND estado ='$estado' ORDER BY tipo ASC";
                                $c_conteo = "SELECT COUNT(tipo) FROM documentos WHERE codigo = '$codigo' AND p_resp = '$p_resp' AND estado ='$estado'";
                            }
                            $nc = 1;
                        }

                        // 1 con Dato = Tipo
                        if ($tipo != "" && $codigo == "" && $p_resp == "" && $estado == "") {

                            $sql = "SELECT * FROM documentos WHERE tipo = '$tipo'";
                            $c_conteo = "SELECT COUNT(tipo) FROM documentos WHERE tipo = '$tipo'";

                            if ($tipo == "T") {
                                $sql = "SELECT * FROM documentos ";
                                $c_conteo = "SELECT COUNT(tipo) FROM documentos";
                            }
                        }

                        // 1 con Dato = Codigo
                        if ($tipo == "" && $codigo != "" && $p_resp == "" && $estado == "") {

                            $sql = "SELECT * FROM documentos WHERE codigo = '$codigo'";
                            $c_conteo = "SELECT COUNT(tipo) FROM documentos WHERE codigo = '$codigo'";
                        }

                        // 1 con Dato = p_resp
                        if ($tipo == "" && $codigo == "" && $p_resp != "" && $estado == "") {

                            $sql = "SELECT * FROM documentos WHERE p_resp = '$p_resp'";
                            $c_conteo = "SELECT COUNT(tipo) FROM documentos WHERE p_resp = '$p_resp'";
                        }

                        // 1 con Dato = estado
                        if ($tipo == "" && $codigo == "" && $p_resp == "" && $estado != "") {

                            $sql = "SELECT * FROM documentos WHERE estado = '$estado'";
                            $c_conteo = "SELECT COUNT(tipo) FROM documentos WHERE estado = '$estado'";
                        }

                        //2 con Dato = tipo + codigo
                        if ($tipo != "" && $codigo != "" && $p_resp == "" && $estado == "") {

                            $sql = "SELECT * FROM documentos WHERE tipo = '$tipo' AND codigo = '$codigo'";
                            $c_conteo = "SELECT COUNT(tipo) FROM documentos WHERE tipo = '$tipo' AND codigo = '$codigo'";

                            if ($tipo == "T") {
                                $sql = "SELECT * FROM documentos WHERE codigo = '$codigo' ORDER BY tipo ASC";
                                $c_conteo = "SELECT COUNT(tipo) FROM documentos WHERE codigo = '$codigo'";
                            }
                            $nc = 1;
                        }

                        //2 con Dato = tipo + p_resp
                        if ($tipo != "" && $codigo == "" && $p_resp != "" && $estado == "") {

                            $sql = "SELECT * FROM documentos WHERE tipo = '$tipo' AND p_resp = '$p_resp'";
                            $c_conteo = "SELECT COUNT(tipo) FROM documentos WHERE tipo = '$tipo' AND p_resp = '$p_resp'";

                            if ($tipo == "T") {
                                $sql = "SELECT * FROM documentos WHERE p_resp = '$p_resp' ORDER BY tipo ASC";
                                $c_conteo = "SELECT COUNT(tipo) FROM documentos WHERE p_resp = '$p_resp'";
                            }
                            $nc = 1;
                        }

                        //2 con Dato = tipo + estado
                        if ($tipo != "" && $codigo == "" && $p_resp == "" && $estado != "") {

                            $sql = "SELECT * FROM documentos WHERE tipo = '$tipo' AND estado = '$estado'";
                            $c_conteo = "SELECT COUNT(tipo) FROM documentos WHERE tipo = '$tipo' AND estado = '$estado'";

                            if ($tipo == "T") {
                                $sql = "SELECT * FROM documentos WHERE estado = '$estado' ORDER BY tipo ASC";
                                $c_conteo = "SELECT COUNT(tipo) FROM documentos WHERE estado = '$estado'";
                            }
                            $nc = 1;
                        }

                        //3 con Dato = tipo + codigo + p_resp
                        if ($tipo != "" && $codigo != "" && $p_resp != "" && $estado == "") {

                            $sql = "SELECT * FROM documentos WHERE tipo = '$tipo' AND codigo = '$codigo' AND p_resp = '$p_resp'";
                            $c_conteo = "SELECT COUNT(tipo) FROM documentos WHERE tipo = '$tipo' AND codigo = '$codigo' AND p_resp = '$p_resp'";

                            if ($tipo == "T") {
                                $sql = "SELECT * FROM documentos WHERE codigo = '$codigo' AND p_resp = '$p_resp' ORDER BY tipo ASC";
                                $c_conteo = "SELECT COUNT(tipo) FROM documentos WHERE codigo = '$codigo' AND p_resp = '$p_resp'";
                            }
                            $nc = 1;
                        }

                        //3 con Dato = tipo + codigo + estado
                        if ($tipo != "" && $codigo != "" && $p_resp == "" && $estado != "") {

                            $sql = "SELECT * FROM documentos WHERE tipo = '$tipo' AND codigo = '$codigo' AND estado = '$estado'";
                            $c_conteo = "SELECT COUNT(tipo) FROM documentos WHERE tipo = '$tipo' AND codigo = '$codigo' AND estado = '$estado'";

                            if ($tipo == "T") {
                                $sql = "SELECT * FROM documentos WHERE codigo = '$codigo' AND estado = '$estado' ORDER BY tipo ASC";
                                $c_conteo = "SELECT COUNT(tipo) FROM documentos WHERE codigo = '$codigo' AND estado = '$estado'";
                            }
                            $nc = 1;
                        }

                        //3 con Dato = tipo + p_resp + estado
                        if ($tipo != "" && $codigo == "" && $p_resp != "" && $estado != "") {

                            $sql = "SELECT * FROM documentos WHERE tipo = '$tipo' AND p_resp = '$p_resp' AND estado = '$estado'";
                            $c_conteo = "SELECT COUNT(tipo) FROM documentos WHERE tipo = '$tipo' AND p_resp = '$p_resp' AND estado = '$estado'";

                            if ($tipo == "T") {
                                $sql = "SELECT * FROM documentos WHERE p_resp = '$p_resp' AND estado = '$estado' ORDER BY tipo ASC";
                                $c_conteo = "SELECT COUNT(tipo) FROM documentos WHERE p_resp = '$p_resp' AND estado = '$estado'";
                            }
                            $nc = 1;
                        }

                        //3 con Dato = codigo + p_resp + estado
                        if ($tipo == "" && $codigo != "" && $p_resp != "" && $estado != "") {

                            $sql = "SELECT * FROM documentos WHERE codigo = '$codigo' AND p_resp = '$p_resp' AND estado = '$estado'";
                            $c_conteo = "SELECT COUNT(tipo) FROM documentos WHERE codigo = '$codigo' AND p_resp = '$p_resp' AND estado = '$estado'";

                            $nc = 1;
                        }

                        //2 con Dato = codigo + p_resp
                        if ($tipo == "" && $codigo != "" && $p_resp != "" && $estado == "") {

                            $sql = "SELECT * FROM documentos WHERE codigo = '$codigo' AND p_resp = '$p_resp' ";
                            $c_conteo = "SELECT COUNT(tipo) FROM documentos WHERE codigo = '$codigo' AND p_resp = '$p_resp'";

                            $nc = 1;
                        }

                        //2 con Dato = codigo + estado
                        if ($tipo == "" && $codigo != "" && $p_resp == "" && $estado != "") {

                            $sql = "SELECT * FROM documentos WHERE codigo = '$codigo' AND estado = '$estado'";
                            $c_conteo = "SELECT COUNT(tipo) FROM documentos WHERE codigo = '$codigo' AND estado = '$estado'";

                            $nc = 1;
                        }

                        //2 con Dato = p_resp + estado
                        if ($tipo == "" && $codigo == "" && $p_resp != "" && $estado != "") {

                            $sql = "SELECT * FROM documentos WHERE p_resp = '$p_resp' AND estado = '$estado'";
                            $c_conteo = "SELECT COUNT(tipo) FROM documentos WHERE p_resp = '$p_resp' AND estado = '$estado'";

                            $nc = 1;
                        }

                        //Todos sin Datos 
                        if ($tipo == "" && $codigo == "" && $p_resp == "" && $estado == "") {
                            $c_conteo = "";
                            $conteo = 0;
                            $nc = "";
                            $sql = "";
                            $nc = 1;
                        }

                        if ($c_conteo != "") {
                            $result = mysql_query($c_conteo, Conexion::conectar());
                            while ($row = mysql_fetch_array($result)) {
                                $conteo = $row[0];
                            }
                        }

                        if ($conteo == 0) {
                            if ($nc == 1) {
                                echo "<p style='text-align: center'>Los valores de la busqueda no coinciden</p>";
                            } else {
                                echo "<p style='text-align: center'>Se han encontrado " . $conteo . " documentos. </p>";
                            }
                        } else {

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
                    </tr>";
                        }
                        if ($sql != "") {
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
                                </tr>
                                <?php
                            }
                            echo "</table>";
                        }
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