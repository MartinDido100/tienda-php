<?php if(isset($editar) && isset($prodObject) && is_object($prodObject)) : ?>
    <h1>Editar producto <?= $prodObject->nombre ?> </h1>
    <?php $url_action = base_url . "producto/saveEdit&id={$prodObject->id}"; ?>
<?php else : ?>
    <h1>Crear producto</h1>
    <?php $url_action = base_url . "producto/save"; ?>
<?php endif; ?>

<?= Utils::summError($errores,'general') ?>
<?= Utils::summError($errores,'query') ?>

<form action="<?= $url_action ?>" method="POST" enctype="multipart/form-data" autocomplete="off">

    <?= Utils::summError($errores,'nombre') ?>
    <label for="nombre">Nombre:</label>
    <input type="text" name="nombre" value="<?= isset($prodObject) && is_object($prodObject) ? $prodObject->nombre : '' ?>" >

    <?= Utils::summError($errores,'descripcion') ?>
    <label for="descripcion">Descripcion:</label>
    <textarea name="descripcion"cols="30" rows="10"><?= isset($prodObject) && is_object($prodObject) ? $prodObject->descripcion : '' ?></textarea>

    <?= Utils::summError($errores,'precio') ?>
    <label for="precio">Precio:</label>
    <input type="text" name="precio" value="<?= isset($prodObject) && is_object($prodObject) ? $prodObject->precio : '' ?>">

    <?= Utils::summError($errores,'stock') ?>
    <label for="stock">Stock:</label>
    <input type="number" name="stock" value="<?= isset($prodObject) && is_object($prodObject) ? $prodObject->stock : '' ?>">

    <?= Utils::summError($errores,'catId') ?>
    <label for="categoria">Categoria:</label>
    <?php $categorias = Utils::showCategorias(); ?>
    <select name="categoria">
        <option value=""> -- Seleccione una categoria -- </option>
        <?php while($cat = $categorias->fetch_object()) : ?>
            <option value="<?= $cat->id ?>" <?= isset($prodObject) && is_object($prodObject) && $prodObject->categoria_id == $cat->id ? 'selected' : '' ?> >
                <?= $cat->nombre ?>
            </option>
        <?php endwhile; ?>
    </select>

    <label for="imagen">Imagen:</label>
    <?php if(isset($prodObject) && is_object($prodObject) && !empty($prodObject->imagen)) : ?>
        <img src="<?= base_url . 'uploads/images/' . $prodObject->imagen ?>" class="img_carrito">
    <?php endif; ?>
    <input type="file" name="imagen">

    <input type="submit" value="<?= isset($prodObject) && is_object($prodObject) ? 'Editar' : 'Agregar' ?>">

</form>