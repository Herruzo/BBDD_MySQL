<?php
//Ralizamos la conexión con la base de datos
function Conectarse()
{
    $link = mysqli_connect("localhost", "root", "", "practica2");

    if (!$link) {
        return "0";
    }
    return $link;
}

//Función que es llamada desde abm.php
function alta($nombre)
{
    $conexion = Conectarse();
    if (!$conexion) {
        echo "<h1>No se puede dar de alta. Error al conectar.</h1>";
        exit();
    }
    //Se realiza la consulta de insertar el nombre
    $consulta = "INSERT INTO nombres (nombre) VALUES ('$nombre')";
    echo "<h2>Sentencia SQL:</h2>";
    echo "<h3>" . $consulta . "</h3>";
    if (mysqli_query($conexion, $consulta)) {
        echo "<p style='color:green;'>Actualización correcta.</p><br> ";
    }else{
        echo "<p style='color:red'>Error de actualización.</p><br/>";
    }
    //mysqli_free_result($conexion);
    mysqli_close($conexion);
}

//Función que es llamada desde abm.php
function modificacion($id, $nombre)
{
    $conexion = Conectarse();
    if (!$conexion) {
        echo "<h1>No se puede modificar. Error al conectar.</h1>";
        exit();
    }
    $consulta = "UPDATE nombres SET nombre = '$nombre' WHERE id = $id";
    echo "<h2>Sentencia SQL:</h2>";
    echo "<h3>" . $consulta . "</h3><br>";
    if (mysqli_query($conexion, $consulta)) {
        echo "<p style='color:green;'>Actualización correcta.</p><br> ";
    } else {
        echo "<p style='color:red;'>Error de actualización.</p><br> ";
    }
    // Cerramos la conexión con la base de datos
    mysqli_close($conexion);
}

//Función que es llamada desde abm.php
function baja($id)
{
    $conexion = Conectarse();
    if (!$conexion) {
        echo "<h1>No se puede dar de baja. Error al conectar.</h1>";
        exit();
    }
    $consulta = "DELETE FROM nombres WHERE id = $id";
    echo "<h2>Sentencia SQL:</h2>";
    echo "<h3>" . $consulta . "</h3><br>";
    if (mysqli_query($conexion, $consulta)) {
        echo "<p style='color:green;'>Actualización correcta.</p><br> ";
    } else {
        echo "<p style='color:red;'>Error de actualización.</p><br> ";
    }
    mysqli_close($conexion);
}
?>
