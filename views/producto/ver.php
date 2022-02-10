<?php if(isset($prod)) : ?>
    <h1> <?= $prod->nombre ?> </h1>

    <div id="detail-product">
        <div class="image">
            <img src="<?= !empty($prod->imagen) ? base_url . 'uploads/images/' . $prod->imagen : 'assets/img/camiseta.png' ?>">
        </div>
        <div class="data">
            <h2 class="description"><?= $prod->descripcion ?></h2>
            <p class="price">$<?= $prod->precio ?></p>
            <a href="<?= base_url ?>carrito/add&id=<?= $prod->id ?>" class="button">Comprar</a>
        </div>
    </div>


<?php else : ?>
<h1>El producto no existe</h1>
<?php endif; ?>

</div>