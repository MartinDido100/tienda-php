<h1>Algunos de nuestros productos</h1>

<?php while ($prod = $productos->fetch_object()) : ?>

    <div class="product">
        <a href="<?= base_url ?>producto/ver&id=<?= $prod->id ?>">
            <img src="<?= !empty($prod->imagen) ? 'uploads/images/' . $prod->imagen : 'assets/img/camiseta.png' ?>">
            <h2><?= $prod->nombre ?></h2>
        </a>
        <p>$<?= $prod->precio ?></p>
        <a href="<?= base_url ?>carrito/add&id=<?= $prod->id ?>" class="button">Comprar</a>
    </div>

<?php endwhile; ?>

</div>