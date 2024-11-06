<!-- menu.php -->
<style>
    /* Estilos para el menú lateral */
    .sidebar {
        width: 200px; /* Ancho del menú */
        background-color: #0f3460; /* Fondo del menú */
        position: fixed; /* Fijo a la izquierda */
        height: 100%; /* Altura completa */
        padding: 20px;
        box-shadow: 2px 0 5px rgba(0, 0, 0, 0.5);
    }

    .sidebar ul {
        list-style-type: none; /* Sin viñetas */
        padding: 0;
    }

    .sidebar ul li {
        margin: 10px 0; /* Espaciado entre elementos */
    }

    .sidebar ul li a {
        color: #00adb5; /* Color de los enlaces */
        text-decoration: none; /* Sin subrayado */
        display: block; /* Hacer que el enlace ocupe todo el ancho */
        padding: 10px; /* Espaciado interno */
        border-radius: 5px; /* Bordes redondeados */
    }

    .sidebar ul li a:hover {
        background-color: #00adb5; /* Fondo al pasar el mouse */
        color: #1a1a2e; /* Color de texto al pasar el mouse */
    }

    /* Estilo para el contenido principal */
    .content {
        margin-left: 220px; /* Espacio para el menú */
        padding: 20px; /* Espaciado interno */
    }
</style>

<div class="sidebar">
    <h2>Menú</h2>
    <ul>
        <li><a href="mostrar_entradas.php">Mostrar Entradas</a></li>
        <li><a href="registrar_entradas.php">Registrar Entradas</a></li>
        <li><a href="consumir_entradas.php">Consumir Entradas</a></li>
    </ul>
</div>