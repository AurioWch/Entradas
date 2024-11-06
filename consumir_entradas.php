<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="entradas.css"> <!-- Enlazar el CSS -->
    <title>Consumir Entradas</title>
</head>
<body>
    <?php include 'menu.php'; ?> <!-- Incluir el menú -->

    <div class="content"> <!-- Contenido principal -->
        <h1>Consumir Entradas de la Discoteca</h1>
        <form method="post" action="">
            Fecha: <input type="date" name="fecha" required>
            Cantidad de Entradas a Consumir: <input type="number" name="cantidad" required>
            <input type="submit" value="Consumir Entradas">
        </form>

        <?php
        include 'conexion.php';

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $fecha = $_POST['fecha'];
            $cantidad = $_POST['cantidad'];

            $cnx = connection(); // Usar la función de conexión

            // Verificar entradas disponibles para la fecha
            $sql = "SELECT entradas_disponibles FROM entradas WHERE fecha = :fecha";
            $stmt = $cnx->prepare($sql);
            $stmt->bindParam(':fecha', $fecha);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($row) {
                $entradas_disponibles = $row['entradas_disponibles'];

                // Verificar si hay suficientes entradas disponibles
                if ($cantidad <= $entradas_disponibles) {
                    $nuevas_entradas_disponibles = $entradas_disponibles - $cantidad;

                    // Actualizar entradas disponibles
                    $sql_update = "UPDATE entradas SET entradas_disponibles = :nuevas_entradas WHERE fecha = :fecha";
                    $stmt_update = $cnx->prepare($sql_update);
                    $stmt_update->bindParam(':nuevas_entradas', $nuevas_entradas_disponibles);
                    $stmt_update->bindParam(':fecha', $fecha);

                    if ($stmt_update->execute()) {
                        echo "<p>Entradas consumidas exitosamente. Total entradas disponibles ahora: $nuevas_entradas_disponibles</p>";
                    } else {
                        echo "<p>Error al consumir las entradas.</p>";
                    }
                } else {
                    echo "<p>No hay suficientes entradas disponibles para consumir.</p>";
                }
            } else {
                echo "<p>No se encontraron entradas para la fecha seleccionada.</p>";
            }

            $cnx = null; // Cerrar la conexión
        }
        ?>
    </div>
</body>
</html>