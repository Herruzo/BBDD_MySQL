<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Practica 3 :: PHP :: Alta y Modificacion de Datos</title>
    <link rel="stylesheet" href="estilos.css">
    <?php
    //Según el valor de accion muestra un título o otro.
    if ($_GET["accion"] == "alta") {
        echo "<title>" . "Alta de registro" . "</title>";
    }
    if ($_GET["accion"] == "baja") {
        echo "<title>" . "Alta de registro" . "</title>";
    }
    if ($_GET["accion"] == "modoficacion") {
        echo "<title>" . "Modificación en agenda" . "</title>";
    }
    ?>

</head>

<body background="fondos/bokeh.jpg">

    <div class="caja0">
        <span id="logo"><img src="logo.png" alt="logo"></span>
    </div>
    <div class="caja1">
        <?php
        //En el contenedor caja1 mostramos los input y botón según el valor de acción
        if ($_GET["accion"] == "alta") {

            echo "<h1>Agregar un registro</h1><br/>";
            echo "<form action='abm.php' method='GET'>";
            echo "Nombre: " . "<input class='textbod' type='text' name='txtname'>" . "<br/>";
            echo "<br/>";
            echo "<input class='boton gris' type='submit' name='OK'>";
            echo "<input type='hidden' name='accion' value='realizar_alta'>";
            echo "</form>";
            echo "<br>" . "<a href=\"index.php\"><< Volver a la agenda</a>";
            exit();
        }
        ?>
        <?php
        //Si se consigue el parámetro accion con valor realizar_alta que se incluya el código de la página sql.php
        if ($_GET["accion"] == "realizar_alta") {
            include("sql.php");
            //Conseguimos el texto introducido en el input Nombre y llamamos a la función alta(), pasandole como parámetro el valor de $nombre.
            $nombre = $_GET["txtname"];
            alta($nombre);
            echo "<br/>" . "<a href='index.php'><< Volver a la agenda</a>";
        }
        ?>
        <?php
        //Se solicita el ID para modificar el registro.
        if ($_GET["accion"] == "modificacion") {
            echo "<h1>Modificar un registro</h1>";
            echo "<br>";
            echo "<form action='abm.php' method='GET'>";
            echo "<h3>Introduce la ID y pulsa Enter</h3>";
            echo "ID: " . "<input class='textbox' type='text'name='txtId'>" . "<BR>";
            echo "<input type='hidden' name='accion' value='datos_modificacion'>";
            echo "</form>";
            echo "<br>" . "<a href='index.php'><< Volver a la agenda</a>";
            exit();
        }
        ?>
        <?php

        if ($_GET["accion"] == "datos_modificacion") {
            include("sql.php");
            // Conectamos con la base de datos y SELECCIONAMOS el registro cuyo ID hemos obtenido.
            $conexion = Conectarse();
            if (!$conexion) {
                echo "<p style='color:red;'>Error al intentar conectar a BD</p>";
                echo "<br>" . "<a href='index.php'><< Volver a la agenda</a>";
                exit();
            }
            //Según el id recibido se solicita los datos para modificar.
            $id = $_GET["txtId"];
            $consulta = "SELECT * FROM nombres WHERE id = $id";
            echo "<h1>Modificar un registro</h1>";
            echo "<h2>Sentencia SQL:</h2>";
            echo $consulta . "<br>";
            $resultado = mysqli_query($conexion, $consulta);
            $fila = mysqli_fetch_array($resultado);
            if (!$fila) {
                echo "<p style='color:red;'>Registro inexistente</p>";
                echo "<br>" . "<a href='index.php'><< Volver a la agenda</a>";
                exit();
            }
            // Cargamos los datos del registro en la variables $nombre
            $nombre = $fila["nombre"];
            // Liberamos memoria que ocupa la consulta...
            mysqli_free_result($resultado);

            // Cerramos la conexión
            mysqli_close($conexion);


            //Ahora que teóricamente tenemos los datos del registro que queremos modificar, mostramos el formulario de carga.


            echo "<br>";
            echo "<form action='abm.php' method='GET'>";
            echo "Nombre: " . "<INPUT class='textbox' type='text'name='txtname' value='$nombre'>" . "<BR>";
            echo "<BR>";
            echo "<input class='boton gris' type='submit'name='submit'>";
            echo "<input type='hidden' name='accion' value='realizar_modificacion'>";
            echo "<input type='hidden' name='id' value='$id'>";
            echo "</form>";
            echo "<br>" . "<a href='index.php'><< Volver a la agenda</a>";
        }
        ?>
        <?php
        // En base al ID recibido, hacemos la modificación.
        if ($_GET["accion"] == "realizar_modificacion") {
            include("sql.php");
            $id = $_GET["id"];
            $nombre = $_GET["txtname"];
            //Llamamos a la función modificar() y le pasamos los parámetros del id y del nombre, que dicha función se encuentra en sql.php
            modificacion($id, $nombre);
            echo "<br>" . "<a href='index.php'><< Volver a la agenda</a>";
        }
        ?>
        <?php
        // Mostramos la pantalla de carga de BAJAS.
        if ($_GET["accion"] == "baja") {
            echo "<h1>Dar de baja un registro</h1>";
            echo "<form action='abm.php' method='GET'>";
            echo "<h3>Introduce el nombre y pulsa Enter</h3>";
            echo "<br>";
            echo "ID: " . "<input class='textbox' type='text'name='txtId'>" . "<BR>";
            echo "<input type='hidden' name='accion' value='realizar_baja'>";
            echo "</form>";
            echo "<br>" . "<a href='index.php'><< Volver a la agenda</a>";
            exit();
        }
        ?>
        <?php
        // En base al ID recibido, hacemos la baja.
        if ($_GET["accion"] == "realizar_baja") {
            include("sql.php");
            $id = $_GET["txtId"];
            //Llamamos a la función baja() y le pasamos el parámetro del id. de sql.php
            baja($id);
            echo "<br/>" . "<a href='index.php'><< Volver a la agenda</a>";
        }



        ?>

    </div>

</body>

</html>