<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Película</title>
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
    <h1>Editar Película</h1>
    <form action="index.php?url=PELICULAS/EDITAR" method="POST">
        <input type="hidden" name="id" value="<?= ($vDatos->id??'')?>" required>

        <label>Título:</label><br>
        <input type="text" name="titulo" value="<?= ($vDatos->titulo??'')?>" disabled><br><br>

        <label>Sinopsis:</label><br>
        <textarea name="sinopsis"><?= ($vDatos->sinopsis??'')?></textarea><br><br>

        <label>Duración (min):</label><br>
        <input type="number" name="duracionMin" value="<?= ($vDatos->duracionMin??'')?>" required><br><br>

        <label>Clasificación:</label><br>
        <input type="text" name="clasificacion" value="<?= ($vDatos->clasificacion??'')?>"><br><br>

        <label>Género:</label><br>
        <input type="text" name="genero" value="<?= ($vDatos->genero??'')?>" placeholder="Ej: comedia"><br><br>

        <label>Estado:</label><br>
        <select name="estado">
            <option value="">SELECT</option>
            <option value="activo" <?= ($vDatos->estado??'')=="activo"?"selected":""; ?>>Activo</option>
            <option value="inactivo" <?= ($vDatos->estado??'')=="inactivo"?"selected":""; ?>>Inactivo</option>
        </select><br><br>

        <label>Fecha de Estreno:</label><br>
        <input type="date" name="fechaEstreno" value="<?= ($vDatos->fechaEstreno??'')?>"><br><br>

        <button type="submit">Editar</button>
        <a href="index.php?url=PELICULAS">Cancelar</a>
    </form>
</body>
</html>
