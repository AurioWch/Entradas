<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="entradas.css"> <!-- Enlazar el CSS -->
    <title>Registrar Entradas</title>
</head>
<body>
    <?php include 'menu.php'; ?> <!-- Incluir el menú -->

    <div class="content"> <!-- Contenido principal -->
        <h1>Registrar Entradas de la Discoteca</h1>
        <form method="post" action="">
            Fecha: <input type="date" name="fecha" required>
            Cantidad de Entradas: <input type="number" name="cantidad" required>
            <input type="submit" value="Registrar Entradas">
        </form>

        <?php
        include 'conexion.php';

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $fecha = $_POST['fecha'];
            $cantidad = $_POST['cantidad'];

            $cnx = connection(); // Usar la función de conexión

            // Verificar si ya existe una entrada para esa fecha
            $sql = "SELECT entradas_disponibles FROM entradas WHERE fecha = :fecha";
            $stmt = $cnx->prepare($sql);
            $stmt->bindParam(':fecha', $fecha);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($row) {
                // Si existe, actualizar las entradas disponibles
                $entradas_disponibles = $row['entradas_disponibles'] + $cantidad;
                $sql_update = "UPDATE entradas SET entradas_disponibles = :entradas_disponibles WHERE fecha = :fecha";
                $stmt_update = $cnx->prepare($sql_update);
                $stmt_update->bindParam(':entradas_disponibles', $entradas_disponibles);
                $stmt_update->bindParam(':fecha', $fecha);

                if ($stmt_update->execute()) {
                    echo "<p>Entradas registradas exitosamente. Total entradas disponibles: $entradas_disponibles</p>";
                } else {
                    echo "<p>Error al registrar las entradas.</p>";
                }
            } else {
                // Si no existe, insertar una nueva entrada
                $sql_insert = "INSERT INTO entradas (fecha, total_entradas, entradas_disponibles) VALUES (:fecha, :cantidad, :cantidad)";
                $stmt_insert = $cnx->prepare($sql_insert);
                $stmt_insert->bindParam(':fecha', $fecha);
                $stmt_insert->bindParam(':cantidad', $cantidad);

                if ($stmt_insert->execute()) {
                    echo "<p>Entradas registradas exitosamente. Total entradas disponibles: $cantidad</p>";
                } else {
                    echo "<p>Error al registrar las entradas.</p>";
                }
            }

            $cnx = null; // Cerrar la conexión
        }
        ?>
    </div>
</body>
</html>