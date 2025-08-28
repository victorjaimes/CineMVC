<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Nueva Película</title>
    <style>
        .alerta {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 4px;
            color: #fff;
        }
        .alerta.exito { background-color: #4CAF50; }
        .alerta.error { background-color: #f44336; }
    </style>
</head>
<body>
    <?php if (isset($_GET['msg'])) { ?>
        <div class="alerta">
            <?php echo htmlspecialchars($_GET['msg']); ?>
        </div>
    <?php } ?>
    <h1>Registrar Nueva Película</h1>
    <form action="index.php?url=PELICULAS/GUARDAR" method="POST">
        <label>Título:</label><br>
        <input type="text" name="titulo" required><br><br>

        <label>Sinopsis:</label><br>
        <textarea name="sinopsis"></textarea><br><br>

        <label>Duración (min):</label><br>
        <input type="number" name="duracionMin" required><br><br>

        <label>Clasificación:</label><br>
        <input type="text" name="clasificacion"><br><br>

        <label>Género:</label><br>
        <input type="text" name="genero" placeholder="Ej: comedia"><br><br>

        <label>Estado:</label><br>
        <select name="estado">
            <option value="activo">Activo</option>
            <option value="inactivo">Inactivo</option>
        </select><br><br>

        <label>Fecha de Estreno:</label><br>
        <input type="date" name="fechaEstreno"><br><br>

        <button type="submit">Guardar</button>
        <a href="index.php?url=PELICULAS">Cancelar</a>
    </form>
</body>
</html>
