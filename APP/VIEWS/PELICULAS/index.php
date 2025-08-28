<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PELICULAS</title>
</head>
<body>
    <table width="60%" align="center">
        <tr>
            <td><h1>Películas</h1></td>
            <td width="50%"></td>
            <td align="right"><a href="index.php?url=PELICULAS/NUEVO">➕ Nueva Película</a></td>
        </tr>
    </table>
    <br>
    <table width="60%" align="center" border="1">
        <tr>
            <td align="center">ID</td>
            <td align="center">NOMBRE</td>
            <td align="center">F.PUBLICACION</td>
            <td align="center">ESTADO</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <?php foreach (($lista??[]) as $l) { ?>
        <tr>
            <td align="center"><?= ($l->id ?? '')?></td>
            <td align="center"><?= ($l->titulo ?? '')?></td>
            <td align="center"><?= ($l->fechaEstreno ?? '')?></td>
            <td align="center"><?= ($l->estado ?? '')?></td>
            <td align="center"><a href="index.php?url=PELICULAS/VER&id=<?= ($l->id??0) ?>" title="EDITAR">✏️</a></td>
            <td align="center"><a href="index.php?url=PELICULAS/TURNO&id=<?= ($l->id??0) ?>" title="TURNO">🕞</a></td>
            <td align="center"><a href="index.php?url=PELICULAS/ESTADO&id=<?= ($l->id??0) ?>" title="ESTADO">
                <?= ($l->estado ?? '')=='activo'?'🔒':'🔓'; ?></a>
            </td>
            <td align="center"><a href="index.php?url=PELICULAS/ELIMINAR&id=<?= ($l->id??0) ?>" title="ELIMINAR">🗑️</a></td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>