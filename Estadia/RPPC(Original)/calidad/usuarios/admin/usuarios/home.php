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
                        <h1>Usuarios</h1>
                        <form action="agregar_usuarios.php" method="post" id="form_del">
                            <input type="submit" value="Agregar Nuevo Usuario">
                        </form>
                        <br>
                        <table id="user" border="1">
                            <tr style="background-color:darkred; color: white; ">
                                <td> Nombre</td>
                                <td> Usuario </td>
                                <td> Password </td>
                                <td> Privilegios </td>
                                <td> Editar </td>
                                <td> Eliminar </td>
                            </tr>
                            <?php
                            $sql = "SELECT * FROM usuarios WHERE id>1";
                            $result = mysql_query($sql, Conexion::conectar());
                            while ($row = mysql_fetch_array($result)) {
                                ?>
                                <tr>
                                    <td> <?php echo $row[1] ?> </td>
                                    <td> <?php echo $row[2] ?> </td>
                                    <td> <?php echo $row[3] ?> </td>
                                    <td> <?php echo $row[4] ?></td>
                                    <td> 
                                        <form action="editar_usuarios.php" method="post">
                                            <input type="hidden" name="id" value="<?php echo $row[0]; ?>">
                                            <input type="hidden" name="nombre" value="<?php echo $row[1]; ?>">
                                            <input type="hidden" name="usuario" value="<?php echo $row[2]; ?>">
                                            <input type="hidden" name="password" value="<?php echo $row[3]; ?>">
                                            <input type="hidden" name="privilegios" value="<?php echo $row[4]; ?>">
                                            <input type="submit" value="Editar">
                                        </form>
                                    </td>
                                    <td> 
                                        <form action="eliminar_usuarios.php" method="post" id="form_delete" onsubmit="return confirm('¿Seguro que Desea Eliminar a este Usuario...?');">
                                            <input type="hidden" name="id" value="<?php echo $row[0] ?>">
                                            <input type="submit" value="Eliminar" >
                                        </form>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                        </table>
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