<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="entradas.css"> <!-- Enlazar el CSS -->
    <title>Mostrar Entradas</title>
</head>
<body>
    <?php include 'menu.php'; ?> <!-- Incluir el menú -->

    <div class="content"> <!-- Contenido principal -->
        <h1>Entradas Disponibles</h1>
        <?php
        include 'conexion.php';

        $cnx = connection(); // Usar la función de conexión

        $sql = "SELECT * FROM entradas";
        $result = $cnx->query($sql);

        if ($result->rowCount() > 0) {
            echo "<table><tr><th>ID</th><th>Fecha</th><th>Total Entradas</th><th>Entradas Disponibles</th></tr>";
            while($row = $result->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr><td>" . $row["id"]. "</td><td>" . $row["fecha"]. "</td><td>" . $row["total_entradas"]. "</td><td>" . $row["entradas_disponibles"]. "</td></tr>";
            }
            echo "</table>";
        } else {
            echo "0 resultados";
        }
        $cnx = null; // Cerrar la conexión
        ?>
    </div>
</body>
</html>