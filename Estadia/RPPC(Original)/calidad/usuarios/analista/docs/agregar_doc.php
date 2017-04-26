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
        if ($_SESSION['privilegios_s'] != 'Analista') {
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
                    <li><a href="home.php">Regresar</a>
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
                <section id="slideindex">
                    <h1>Agregar Nuevo Documento</h1>
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
                                            echo "</select>";
                                            ?>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3" style="text-align: center">
                                        <input class="button" type="submit" value="Generar Codigo" required="required">
                                    </td>
                                </tr>
                            </table>
                        </fieldset>
                    </form>
                    <?php
                    if ($vl == "") {
                        if ($_POST) {
                            extract($_POST);

                            $q_c = "SELECT * FROM documentos WHERE tipo = '$tipo' ORDER BY id DESC LIMIT 1";
                            $result_c = mysql_query($q_c, Conexion::conectar());

                            while ($rowc = mysql_fetch_row($result_c)) {
                                $p_p = $rowc[1];
                                $tipox = $rowc[2];
                                $num = $rowc[3];
                            }

                            $numx = $num + 1;
                            if ($numx <= 9) {
                                $numx = "0" . $numx;
                            }

                            $coddoc = $p_p . $tipox . $numx;
                        }
                    }
                    ?>
                    <form  id="formRegistro" action = "" method="post" enctype="multipart/form-data">
                        <input name="numx" type="hidden" value="<?php echo $numx; ?>"/>
                        <input name="p_p" type="hidden" value="<?php echo $p_p; ?>"/>
                        <input name="vl" type="hidden" value="1"/>
                        <fieldset>
                            <table id="docs">
                                <tr>
                                    <th>CODIGO: </th>
                                    <td>
                                        <div id="campo">
                                            <input name="codigo" type="text" readonly value="<?php echo $coddoc; ?>"/>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th>TIPO DE DOCUMENTO: </th>
                                    <td>
                                        <div id="campo">
                                            <input name ="tipox" type="text" readonly value="<?php echo $tipox; ?>"/>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th>NOMBRE: </th>
                                    <td colspan="3">
                                        <textarea name="nombre" rows="2" cols="70" required="required"></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <th>PROCESO RESPONSABLE:</th>
                                    <td>
                                        <div id="campo">
                                            <select name="p_resp">
                                                <option></option>
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
                                    <th>&Aacute;REA DE APLICACI&Oacute;N:</th>
                                    <td>
                                        <input name="area_api[]" type="checkbox" value="AGN"/>AGN<br>
                                        <input name="area_api[]" type="checkbox" value="Avisos"/>Avisos<br>
                                        <input name="area_api[]" type="checkbox" value="Certificados"/>Certificados<br>
                                        <input name="area_api[]" type="checkbox" value="Comercio"/>Comercio<br>
                                        <input name="area_api[]" type="checkbox" value="Compras"/>Compras<br>
                                        <input name="area_api[]" type="checkbox" value="Consulta Electr&oacute;nica"/>Consulta Electr&oacute;nica<br>
                                        <input name="area_api[]" type="checkbox" value="Desarrollo Institucional"/>Desarrollo Institucional<br>
                                        <input name="area_api[]" type="checkbox" value="Digitalizaci&oacute;n Correcciones"/>Digitalizaci&oacute;n Correcciones<br>
                                        <input name="area_api[]" type="checkbox" value="Digitalizaci&oacute;n D&iacute;a a D&iacute;a"/>Digitalizaci&oacute;n D&iacute;a a D&iacute;a<br>
                                        <input name="area_api[]" type="checkbox" value="Digitalizaci&oacute;n Hist&oacute;rica"/>Digitalizaci&oacute;n Hist&oacute;rica<br>
                                        <input name="area_api[]" type="checkbox" value="Direcci&oacute;n"/>Direcci&oacute;n<br>
                                        <input name="area_api[]" type="checkbox" value="Documentos de Apoyo"/>Documentos de Apoyo<br>
                                        <input name="area_api[]" type="checkbox" value="Encuadernaci&oacute;n"/>Encuadernaci&oacute;n<br>
                                        <input name="area_api[]" type="checkbox" value="Fraccionamientos y Condominios"/>Fraccionamientos y Condominios<br>
                                        <input name="area_api[]" type="checkbox" value="Impresi&oacute;n y Sellado"/>Impresi&oacute;n y Sellado<br>
                                        <input name="area_api[]" type="checkbox" value="Inmobiliario"/>Inmobiliario<br>
                                    </td>
                                    <td>
                                        <input name="area_api[]" type="checkbox" value="Inscripci&oacute;n y Certificaci&oacute;n"/>Inscripci&oacute;n y Certificaci&oacute;n<br>
                                        <input name="area_api[]" type="checkbox" value="Incidentes"/>Incidentes<br>
                                        <input name="area_api[]" type="checkbox" value="Integraci&oacute;n de Folios"/>Integraci&oacute;n de Folios<br>
                                        <input name="area_api[]" type="checkbox" value="Integraci&oacute;n Hist&oacute;rica"/>Integraci&oacute;n Hist&oacute;rica<br>
                                        <input name="area_api[]" type="checkbox" value="Jur&iacute;dico"/>Jur&iacute;dico<br>
                                        <input name="area_api[]" type="checkbox" value="Jur&iacute;dico de Certificados"/>Jur&iacute;dico de Certificados<br>
                                        <input name="area_api[]" type="checkbox" value="Jur&iacute;dico SJR"/>Jur&iacute;dico SJR<br>
                                        <input name="area_api[]" type="checkbox" value="Modulo de Atenci&oacute;n y Servicio a Usuarios"/>Modulo de Atenci&oacute;n y Servicio a Usuarios<br>
                                        <input name="area_api[]" type="checkbox" value="PEM"/>PEM<br>
                                        <input name="area_api[]" type="checkbox" value="Recepci&oacute;n de Direcci&oacute;n"/>Recepci&oacute;n de Direcci&oacute;n<br>
                                        <input name="area_api[]" type="checkbox" value="Registral For&aacute;neo"/>Registral For&aacute;neo<br>
                                        <input name="area_api[]" type="checkbox" value="Registro Inmobiliario"/>Registro Inmobiliario<br>
                                        <input name="area_api[]" type="checkbox" value="Subdirecciones For&aacute;neas"/>Subdirecciones For&aacute;neas<br>
                                        <input name="area_api[]" type="checkbox" value="Tecnolog&iacute;as de la Informaci&oacute;n y Comunicaciones"/>Tecnolog&iacute;as de la Informaci&oacute;n y Comunicaciones<br>
                                        <input name="area_api[]" type="checkbox" value="Todo el RPPC"/>Todo el RPPC<br>
                                        <input name="area_api[]" type="checkbox" value="Unidad de Apoyo Administrativo"/>Unidad de Apoyo Administrativo<br>
                                    </td>
                                </tr>
                                <tr>
                                    <th>FORMATO:</th>
                                    <td>
                                        <div>
                                            <select name="formato" >
                                                <option></option>
                                                <option value="DOC">DOC</option>
                                                <option value="PDF">PDF</option>
                                                <option value="XLS">XLS</option>
                                            </select>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th>REVISI&Oacute;N ANTERIOR:</th>
                                    <td>
                                        <input name="rev_a" value="00" redonly />
                                        <!--<select name="rev_a" >
                                            <?php/*
                                            $i = 0;
                                            while ($i <= 20) {
                                                if ($i <= 9) {
                                                    $i = "0" . $i;
                                                }
                                                echo "<option ";
                                                if ($i == "00") {
                                                    echo "selected = 'selected'";
                                                }
                                                echo " value='" . $i . "'>" . $i . "</option>";
                                                $i++;
                                            }*/
                                            ?>
                                        <!--</select>-->
                                    </td>
                                </tr>
                                <tr>
                                    <th>REVISI&Oacute;N VIGENTE:</th>
                                    <td>
                                        <input name="rev_v" value="01" redonly />
                                        <!--<select name="rev_v" >
                                            <?php/*
                                            $i = 0;
                                            while ($i <= 20) {
                                                if ($i <= 9) {
                                                    $i = "0" . $i;
                                                }
                                                echo "<option ";
                                                if ($i == "01") {
                                                    echo "selected = 'selected'";
                                                }
                                                echo " value='" . $i . "'>" . $i . "</option>";
                                                $i++;
                                            }*/
                                            ?>
                                        </select>-->
                                    </td>
                                </tr>
                                <tr>
                                    <th>FECHA DE REGISTRO:</th>
                                    <td>
                                        <strong><input name="fecha_reg" type="date" required="required"/></strong>
                                    </td>
                                </tr>
                                <tr>
                                    <th>ESTADO:</th>
                                    <td><div>
                                            <select name="estado" >
                                                <option value="ACTIVO">ACTIVO</option>
                                                <option value="LIBRE">LIBRE</option>
                                            </select>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th>OBSERVACIONES</th>
                                    <td colspan="3">
                                        <textarea name="observacion" rows="5" cols="70"></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3" style="text-align: center">
                                        <input class="button" type="submit" value="Agregar Documento" required="required">
                                    </td>
                                </tr>
                            </table>
                        </fieldset>
                    </form>
                    <?php
                    if ($_POST) {
                        if ($vl == 1) {
                            extract($_POST);

                            $add = new Documentos();
                            $add->agregar_doc($p_p, $codigo, $tipox, $numx, $nombre, $p_resp, $area_api, $formato, $rev_a, $rev_v, $fecha_reg, $estado, $observacion);
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