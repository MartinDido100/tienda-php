<h1>Gestion de productos</h1>

<a href="<?= base_url ?>producto/crear" class="button button-small">Crear producto</a>

<?php if(isset($_SESSION['correctProd'])) : ?>

    <h3 class="alert_green"> <?= $_SESSION['correctProd'] ?> </h3>
    <br>

<?php elseif(isset($_SESSION['errorProd'])) : ?>

    <h3 class="alert_red"> <?= $_SESSION['errorProd'] ?> </h3>
    <br>

<?php endif; Utils::deleteSession('correctProd'); Utils::deleteSession('errorProd') ?>

<table>
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Precio</th>
        <th>Stock</th>
        <th>Acciones</th>
    </tr>
    <?php while($prod = $productos->fetch_object()) : ?>
        <tr>
            <td>
                <?= $prod->id ?>
            </td>
            <td>
                <?= $prod->nombre ?>
            </td>
            <td>
                <?= $prod->precio ?>
            </td>
            <td>
                <?= $prod->stock ?>
            </td>
            <td>
                <a href="<?= base_url ?>producto/editar&id=<?= $prod->id ?>" class="button button-gestion">Editar</a>
                <a href="<?= base_url ?>producto/eliminar&id=<?= $prod->id ?>" class="button button-red">Eliminar</a>
            </td>
        </tr>
    <?php endwhile; ?>
</table>
