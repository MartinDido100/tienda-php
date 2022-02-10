<h1>Crear nueva categoria</h1>

<form action="<?= base_url ?>categoria/save" method="POST">

    <?= Utils::summError($errores,'exists') ?>
    <label for="name">Nombre:</label>
    <input type="text" name="nombre" required>

    <input type="submit" value="Guardar">

</form>