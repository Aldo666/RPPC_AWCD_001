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
        if (isset($_SESSION['privilegios_s'])) {
            echo '<script type="text/javascript">
                alert("Sesi&oacute;n Iniciada");
                </script>';
            session_destroy();
            echo '<script type="text/javascript">
                    alert("¡Sesi&oacute;n Finalizada!");
                    window.location.href="index.php";      
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
                    <h1>B I E N V E N I D O.</h1>
                </ul>
            </nav>
            <section id="contenedor">
                <section id="slideindex">
                    <fieldset>
                        <form action="" method="post">
                            <div id="campo">
                                <label>Usuario:</label>
                                <input name="usuario" type="text" required/>
                            </div>
                            <div id="campo">
                                <label>Contrase&ntildea:</label>
                                <input name="password" type="password" required/>
                            </div><br>
                            <div id="campo">
                                <input class="button" type="submit" value="Ingresar"/>
                            </div>
                        </form>
                    </fieldset>
                </section>
            </section>
            <?php
            if ($_POST) {
                $usuario = $_POST['usuario'];
                $password = $_POST['password'];

                $sesion = new Sesion();
                $sesion->ingresar($usuario, $password);
            }
            ?>
            <footer> 
                <div id="txtfooter">
                    <p>2015 &Aacute;rea de Desarrollo Institucional.</p>
                    <p>TODOS LOS DERECHOS RESERVADOS.</p>
                </div>
            </footer>
        </div>
    </body>
</html>