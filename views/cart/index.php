<h1>Carrito de compras</h1>

<?php if(isset($_SESSION['carrito']) && count($_SESSION['carrito']) > 0) : ?>

<?php if(isset($_SESSION['pedido']) && $_SESSION['pedido']) : ?>
        <h3 style="color: green;">Pedido enviado correctamente</h3>
        <br>
<?php endif; ?>

<table>

    <tr>
        <th>Imagen</th>
        <th>Nombre</th>
        <th>Precio</th>
        <th>Unidades</th>
        <th>Acciones</th>
    </tr>

    <?php 
        foreach($carrito as $indice => $elemento) : 
            $producto = $elemento['producto'];
    ?>

        <tr>
            <td><img src="<?= !empty($producto->imagen) ? base_url . 'uploads/images/' . $producto->imagen : 'assets/img/camiseta.png' ?>" class="img_carrito"></td>
            <td><a href="<?= base_url ?>producto/ver&id=<?= $producto->id ?>"><?= $producto->nombre ?></a></td>
            <td><?= $producto->precio ?></td>
            <td><?= $elemento['unidades'] ?></td>
            <td style="cursor: pointer; user-select:none;">
                <a href="<?= base_url ?>carrito/add&id=<?= $producto->id ?>" style="text-decoration: none;">➕</a>
                <a href="<?= base_url ?>carrito/remove&indice=<?= $indice ?>" style="text-decoration: none;">➖</a>
                <a href="<?= base_url ?>carrito/delete&indice=<?= $indice ?>" style="text-decoration: none;">✖️</a>
            </td>
        </tr>

    <?php endforeach; ?>

</table>

<div class="total-carrito" style="margin-top: 20px; width: 100%; display:flex; gap: 20px; justify-content: flex-end;">
        
    <h3>Precio total: $ <?= Utils::totalPrecio() ?></h3>
    <a href="<?= base_url ?>pedido/hacer" class="button button-pedido">Hacer pedido</a>
    <a href="<?= base_url ?>carrito/clear" class="button button-red">Vaciar carrito</a>

</div>

<?php else : ?>

    <p>El carrito esta vacio, añade productos para continuar.</p>

<?php endif; ?>