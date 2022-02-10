<?php if(isset($_SESSION['usuario'])) : ?>
    <h1>Hacer pedido</h1>
    <a href="<?= base_url ?>carrito/inicio">Ver los productos y el precio</a>
    <br><br>
    <h3>Direccion para el envio</h3>
    <?php if(isset($_SESSION['pedido']) && !$_SESSION['pedido']) : ?>
        <h3 style="color: red;">Error al hacer el pedido</h3>
    <?php endif; ?>
    <form action="<?= base_url ?>pedido/add" method="POST">

        <label for="provincia">Provincia</label>
        <input type="text" name="provincia">
        <?= Utils::summError($errores,'provincia') ?>

        <label for="localidad">Localidad</label>
        <input type="text" name="localidad">
        <?= Utils::summError($errores,'localidad') ?>

        <label for="direccion">Direccion</label>
        <input type="text" name="direccion">
        <?= Utils::summError($errores,'direccion') ?>

        <input type="submit" value="Confirmar pedido">

    </form>

<?php else : ?>
    <h1>Necesitas estar identificado</h1>
    <p>Necesitas estar logeado en la web para hacer el pedido</p>
<?php endif; ?>