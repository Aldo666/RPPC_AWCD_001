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
                    <li><a href="home.php">Regresar</a>
                        <?php
                        if ($_SESSION['nombre_s']) {
                            echo '<li><a href="../logout.php">Cerar Sesion</a></li>';
                        } else {
                            ?>
                            <?php
                        }
                        ?>
                </ul>
            </nav>
            <section id="contenedor">
                <section id="slideindex">
                    <h1>Agregar Usuario</h1>
                    <fieldset>
                        <form id="formRegistro" action = "" method="post" enctype="multipart/form-data">
                            <div id="campo">
                                <label >Nombre: </label>
                                <input name="nombre" type="text" required="required">
                            </div>
                            <div id="campo">
                                <label >Usuario: </label>
                                <input name="usuario" type="text" required="required">
                            </div>
                            <div id="campo">
                                <label >Password: </label>
                                <input name="password" type="password" required="required">
                            </div>
                            <div id="campo" required="required">
                                <label>Privilegios:</label>
                                <label>Administrador</label><br>
                                <input name="privilegios" type="radio" value="Administrador" />
                                <label>Analista</label><br>
                                <input name="privilegios" type="radio" value="Analista" />
                                <label>Usuario</label><br>
                                <input name="privilegios" type="radio" checked="" value="User" />
                            </div>
                            <br>
                            <div id="campo">
                                <input class="button" type="submit" value="Agregar Usuario" required="required">
                            </div>
                        </form>
                        <?php
                        if ($_POST) {
                            $nombre = $_POST ['nombre'];
                            $usuario = $_POST ['usuario'];
                            $password = $_POST['password'];
                            $privilegios = $_POST['privilegios'];

                            $add = new Usuarios();
                            $add->agregar_usuarios($nombre, $usuario, $password, $privilegios);
                        }
                        ?>
                    </fieldset>
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