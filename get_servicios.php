<?php
$servername = "bvymmdarmwlsvlav1sgn-mysql.services.clever-cloud.com";
$username = "uztpsvlbvj2bfj1l";
$password = "9ZBnIKF5M3lgX7MnWXjU";
$dbname = "bvymmdarmwlsvlav1sgn";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
 
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
} else {
    echo "Conexión exitosa a la base de datos.<br>";
}
// Obtener el id_categoria del parámetro GET
$id_categoria = intval($_GET['id_categoria']);

// Consultar los análisis para la categoría seleccionada
$sql = "SELECT nombre_analisis, costo, descripcion, indicaciones FROM analisis WHERE id_categoria = ?";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Error en la preparación de la consulta: " . $conn->error);
}

$stmt->bind_param("i", $id_categoria);
$stmt->execute();
$result = $stmt->get_result();

// Imprimir tabla HTML con los resultados
if ($result === false) {
    die("Error al ejecutar la consulta: " . $stmt->error);
}

echo '<tr><th>Nombre del Análisis</th><th>Costo</th><th>Descripción</th><th>Indicaciones</th></tr>';

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . htmlspecialchars($row['nombre_analisis']) . '</td>';
        echo '<td>' . htmlspecialchars($row['costo']) . '</td>';
        echo '<td>' . htmlspecialchars($row['descripcion']) . '</td>';
        echo '<td>' . htmlspecialchars($row['indicaciones']) . '</td>';
        echo '</tr>';
    }
} else {
    echo '<tr><td colspan="4">No se encontraron análisis para esta categoría.</td></tr>';
}

$stmt->close();
$conn->close();
?>
