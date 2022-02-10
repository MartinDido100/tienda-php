<h1><?= $textoH1 ?></h1>

<?= Utils::summError(null,'confirmarError') ?>

<table>

    <tr>
        <th>Nro. Pedido</th>
        <th>Costo</th>
        <th>Fecha</th>
        <th>Estado</th>
        <?php if(isset($_SESSION['isAdmin']) && isset($gestion)) : ?>
                
            <th>Confirmar pedido</th>

        <?php endif; ?>
    </tr>

    <?php 
        while($pedido = $pedidos->fetch_object()) :
    ?>

        <tr>
            <td><?= $pedido->id ?></td>
            <td><?= $pedido->coste ?></td>
            <td><?= $pedido->fecha ?></td>
            <td><?= $pedido->estado ?></td>
            <?php if(isset($_SESSION['isAdmin']) && isset($gestion)) : ?>
                
                <td>
                    <?php if($pedido->estado === 'Pendiente') : ?>
                        <a href="<?= base_url ?>pedido/confirmar&id=<?= $pedido->id ?>" style="text-decoration: none;">✅</a>
                    <?php else : ?>
                        ---
                    <?php endif ?>
                </td>

            <?php endif; ?>
        </tr>

    <?php endwhile; ?>

</table>