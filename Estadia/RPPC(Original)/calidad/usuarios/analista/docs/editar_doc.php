<?php
session_start();
include ('class/class.php');

mysql_query("SET NAMES 'utf-8'");
mysql_set_charset('utf8');

$coddoc = "";
$tipox = "";
$numx = "";
$vl = "";
$p_p = "";
$tipo = "";
$num = "";

if ($_POST) {
    extract($_POST);

    $q_c = "SELECT * FROM documentos WHERE id = '$id' ";
    $result_c = mysql_query($q_c, Conexion::conectar());

    while ($rowc = mysql_fetch_row($result_c)) {
        $p_p = $rowc[1];
        $tipo = $rowc[2];
        $num = $rowc[3];
        $nombre = $rowc[4];
        $p_resp = $rowc[5];
        $area_api_a = $rowc[6];
        $formato = $rowc[7];
        $rev_a = $rowc[8];
        $rev_v = $rowc[9];
        $fecha_reg = $rowc[10];
        $estado = $rowc[11];
        $observacion = $rowc[12];
    }

    $coddoc = $p_p . $tipo . $num;
    $nombre = $nombre;
}
?>
<!DOCTYPE HTML>
<html>
    <head> <!--CONTIENE INFORMACION UTIL PARA EL NAVEGADOR-->
        <title>Calidad</title>
        <meta http-equiv="Content-Type" content="text/html" charset="utf-8"/>
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
                <section id="slideindex">
                    <h1>Editar Documento</h1>

                    <form  id="formRegistro" action = "actualizar_doc.php" method="post" enctype="multipart/form-data">

                        <fieldset>
                            <table id="docs">
                                <tr>
                                <input type="hidden" name="id" value="<?php echo $id; ?>" >
                                <input type="hidden" name="area_api_a" value="<?php echo $area_api_a; ?>" >

                                </tr>
                                <tr>
                                    <th>CODIGO: </th>
                                    <td>
                                        <div id="campo">
                                            <input type="text" readonly value="<?php echo $coddoc; ?>">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th>NOMBRE: </th>
                                    <td colspan="3">
                                        <textarea name="nombre" type="text" value="<?php echo $nombre; ?>" rows="2" cols="70"><?php echo $nombre; ?></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <th>PROCESO RESPONSABLE: </th>
                                    <td>
                                        <div id="campo">                            
                                            <select name="p_resp">
                                                <?php
                                                $n_c = strlen($p_resp);
                                                if ($n_c <= 4) {
                                                    $p_resp = $p_resp;
                                                } else {
                                                    $p_resp = substr($p_resp, 2, 3);
                                                }
                                                ?>
                                                <option value="AGN" <?php if ($p_resp == "AGN") {echo "selected = 'selected'";} ?> >AGN</option>
                                                <option value="&Aacute;REAS DE APOYO" <?php if ($p_resp == "REA") {echo "selected = 'selected'";} ?> >&Aacute;REAS DE APOYO</option>
                                                <option value="ATENCI&Oacute;N Y SERVICIO A USUARIOS" <?php if ($p_resp == "ENC") {echo "selected = 'selected'";} ?> >ATENCI&Oacute;N Y SERVICIO A USUARIOS</option>
                                                <option value="CERTIFICACI&Oacute;N" <?php if ($p_resp == "RTI") {echo "selected = 'selected'";} ?> >CERTIFICACI&Oacute;N</option>
                                                <option value="DIRECCI&Oacute;N" <?php if ($p_resp == "REC") {echo "selected = 'selected'";} ?> >DIRECCI&Oacute;N</option>
                                                <option value="DOCUMENTOS DE APOYO" <?php if ($p_resp == "CUM") {echo "selected = 'selected'";} ?> >DOCUMENTOS DE APOYO</option>
                                                <option value="GESTI&Oacute;N" <?php if ($p_resp == "STI") {echo "selected = 'selected'";} ?> >GESTI&Oacute;N</option>
                                                <option value="INSCRIPCI&Oacute;N" <?php if ($p_resp == "SCR") {echo "selected = 'selected'";} ?> >INSCRIPCI&Oacute;N</option>
                                                <option value="REGISTRAL FOR&Aacute;NEO" <?php if ($p_resp == "GIS") {echo "selected = 'selected'";} ?> >REGISTRAL FOR&Aacute;NEO</option>
                                                <option value="SGC" <?php if ($p_resp == "SGC") {echo "selected = 'selected'";} ?> >SGC</option>
                                                <option value="SGSI" <?php if ($p_resp == "SGSI") {echo "selected = 'selected'";} ?> >SGSI</option>
                                            </select>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th></th>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th></th>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th></th>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th></th>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>&Aacute;REA DE APLICACI&Oacute;N ACTUAL:</th>
                                    <td>
                                        <?php echo $area_api_a; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th></th>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th></th>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th></th>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th></th>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th></th>
                                    <td colspan="2">Selecciona una nueva &aacute;rea de aplicaci&oacute;n solamente si modificar&aacute;s, de lo contrario no sera necesario seleccionar.</td>
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
                                    <td><div>
                                            <select name="formato" >
                                                <option <?php if ($formato == "DOC") { echo "selected = 'selected'";} ?> value="DOC">DOC</option>
                                                <option <?php if ($formato == "PDF") { echo "selected = 'selected'";} ?> value="PDF">PDF</option>
                                                <option <?php if ($formato == "XLS") { echo "selected = 'selected'";} ?> value="XLS">XLS</option>
                                            </select>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th>REVISI&Oacute;N ANTERIOR:</th>
                                    <td>
                                        <select name="rev_a" >
                                            <?php
                                            $i = 0;
                                            while ($i <= 20) {
                                                if ($i <= 9) {
                                                    $i = "0" . $i;
                                                }
                                                echo "<option ";
                                                if ($i == $rev_a) {
                                                    echo "selected = 'selected'";
                                                }
                                                echo " value='" . $i . "'>" . $i . "</option>";
                                                $i++;
                                            }
                                            ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <th>REVISI&Oacute;N VIGENTE:</th>
                                    <td>
                                        <select name="rev_v" >
                                            <?php
                                            $rev_v = $rev_a + 1;
                                            $i = 0;
                                            while ($i <= 20) {
                                                if ($i <= 9) {
                                                    $i = "0" . $i;
                                                }
                                                echo "<option ";
                                                if ($i == $rev_v) {
                                                    echo "selected = 'selected'";
                                                }
                                                echo " value='" . $i . "'>" . $i . "</option>";
                                                $i++;
                                            }
                                            ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <th>FECHA DE REGISTRO:</th>
                                    <td><strong>
                                            <input name="fecha_reg" type="date" value="<?php echo $fecha_reg; ?>" required="required"/>
                                        </strong></td>                            
                                </tr>
                                <tr>
                                    <th>ESTADO:</th>
                                    <td><div>
                                            <select name="estado" >
                                                <option <?php if ($estado == "ACTIVO") { echo "selected = 'selected'"; } ?> value="ACTIVO">ACTIVO</option>
                                                <option <?php if ($estado == "LIBRE") { echo "selected = 'selected'"; } ?> value="LIBRE">LIBRE</option>
                                            </select>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th>OBSERVACIONES</th>
                                    <td colspan="3">
                                        <textarea name="observacion" type="text" value="<?php echo $observacion; ?>" rows="5" cols="70"><?php
                                            if ($observacion == "") {
                                                echo "Sin Observaciones...";
                                            } else {
                                                echo $observacion;
                                            }
                                            ?>
                                        </textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3" style="text-align: center">
                                        <input class="button" type="submit" value="Actualizar Documento" required="required">
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
        $add->agregar_doc($p_p, $tipox, $numx, $nombre, $p_resp, $area_api, $formato, $rev_a, $rev_v, $fecha_reg, $estado, $observacion);
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