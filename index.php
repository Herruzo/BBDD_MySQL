<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Practica 3 :: PHP :: Alta y modificación de datos</title>
    <link rel="stylesheet" href="estilos.css">

</head>

<body background="fondos/bokeh.jpg">
    <div class="caja0">
        <span id="logo"><img src="logo.png" alt="logo"></span>
    </div>
    <div class="caja1">
        <h1>Ejemplo de uso de bases de datos con PHP y MySQL</h1>

        <?php
        include("sql.php");
        //Incluimos el código de la página sql.php, donde realiza la conexión con la base de datos
        $conexion = Conectarse();

        if ($conexion == "0") {
            echo "<h1>Error en apertura de bases de datos.</h1>";
            exit();
        }
        //Realizamos una consulta para que muestre la base de datos completa
        $result = mysqli_query($conexion, "SELECT * FROM nombres");

        ?>

        <table border="0" cellspacing=2 cellpadding=1>
            <tr>
                <!-- Nombre de los campos de la cabecera de la table -->
                <td><b>&nbsp; ID &nbsp;</b></td><!-- &nbsp; es un entidad para dar un espacio en blanco. -->
                <td><b>&nbsp; Nombre &nbsp;</b></td>
            </tr>
            <?php
            //Recorremos mediantes un while
            while ($fila = mysqli_fetch_array($result)) {
                echo "<tr>";
                echo "<td>&nbsp;" . $fila["id"] . "</td>";
                echo "<td>&nbsp;" . $fila["nombre"] . "</td>";
                echo "</tr>";
            }
            //Liberamos la memoria que ocupa la consulta
            mysqli_free_result($result);

            //Cerramos la conexión
            mysqli_close($conexion);



            ?>


        </table>
        <!-- Enlaza con la página abm.php y envia el parámetro acción con su valor, alta, modificacion y baja -->
        <a href="abm.php? accion=alta">[Agregar]</a>&nbsp;
        <a href="abm.php? accion=modificacion">[Modificar]</a>&nbsp;
        <a href="abm.php? accion=baja">[Borrar]</a><br />

    </div>

</body>

</html>