<?php
session_start();
include ('class/class.php');
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
        <link href="../css/estilos.css" rel="stylesheet" type="text/css">
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
                    <li><a href="../menu.php">Men&uacute;</a>
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
                <section id="bienvenida">
                    <article>
                        <h1>Documentos</h1>
                        <div id="contenido">
                            <div class="contenido_tabla"><a href="agregar_doc.php">Agregar Nuevo Documento</a></div>
                            <br>
                            <div class="contenido_tabla"><a href="consultas.php">Consulta de Documentos</a></div>
                        </div>
                    </article>
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