<?php if(isset($cat)) : ?>
<h1> <?= $cat->nombre ?> </h1>
<?php else : ?>
<h1>La categoria no existe</h1>
<?php endif; ?>

<?php while ($prod = $productos->fetch_object()) : ?>

<div class="product">
    <a href="<?= base_url ?>producto/ver&id=<?= $prod->id ?>">
        <img src="<?= !empty($prod->imagen) ? base_url . 'uploads/images/' . $prod->imagen : 'assets/img/camiseta.png' ?>">
        <h2><?= $prod->nombre ?></h2>
    </a>
    <p>$<?= $prod->precio ?></p>
    <a href="<?= base_url ?>carrito/add&id=<?= $prod->id ?>" class="button">Comprar</a>
</div>

<?php endwhile; ?>

</div>