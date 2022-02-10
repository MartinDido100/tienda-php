<h1>Registrarse</h1>

<?php if(isset($_SESSION['register']) && $_SESSION['register']) : ?>

    <strong class="exito">Registro completado correctamente</strong>

<?php elseif(isset($_SESSION['register']) && !$_SESSION['register']): ?>

    <strong class="fallo">Registro fallido</strong>

<?php endif ?>
<?php Utils::deleteSession('register') ?>
<form action="<?= base_url ?>/usuario/save" method="POST">

    <label for="nombre">Nombre</label>
    <input type="text" name="nombre">
    <?= Utils::summError($errores,'nombre') ?>

    <label for="apellido">Apellido</label>
    <input type="text" name="apellido">
    <?= Utils::summError($errores,'apellidos') ?>

    <label for="email">Email</label>
    <input type="email" name="email">
    <?= Utils::summError($errores,'email') ?>

    <label for="pass">Password</label>
    <input type="password" name="pass">
    <?= Utils::summError($errores,'pass') ?>

    <input type="submit" value="Registrarse">

</form>
<?php Utils::deleteSession('errores') ?>