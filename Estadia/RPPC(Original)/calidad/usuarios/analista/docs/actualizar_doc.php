<?php

session_start();
include ('class/class.php');
if ($_POST) {

    $area_api = "";

    extract($_POST);

    if ($observacion == "Sin Observaciones...") {
        $observacion = "";
    }

    $c_aa = count($area_api);

    if ($c_aa == 0) {
        $area_api = "";
    }

    $update = new Documentos ();
    $update->actualizar($id, $area_api_a, $nombre, $p_resp, $area_api, $formato, $rev_a, $rev_v, $fecha_reg, $estado, $observacion);
}
?>