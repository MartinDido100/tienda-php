

        <!-- Aside -->

        <aside id="lateral">
            
            <div class="block_aside">
                <h3>Mi carrito</h3>
                <ul>
                    <li><a href="<?= base_url ?>carrito/inicio">Productos (<?= Utils::totalProductos() ?>)</a></li>
                    <li><a href="<?= base_url ?>carrito/inicio">Total: $ <?= Utils::totalPrecio() ?></a></li>
                    <li><a href="<?= base_url ?>carrito/inicio">Ver el carrito</a></li>
                </ul>
            </div>

            <div id="login" class="block_aside">
                <?php if(!isset($_SESSION['usuario'])) : ?>
                <h3 class="h3">Entrar en la web</h3>
                
                <form action="<?= base_url ?>usuario/login" method="POST" autocomplete="off">

                    <?php if(isset($_SESSION['loginError'])) : ?>
                        <h3 class="form-error" style="background: red; color:antiquewhite; border:none"> <?= $_SESSION['loginError'] ?> </h3>
                    <?php endif ?>
                    <label for="email">Email</label>
                    <input type="email" name="email" value="martindidolich12@gmail.com">

                    <label for="pass">Contraseña</label>
                    <input type="password" name="pass" value="123456">

                    <input type="submit" value="Iniciar sesion">

                </form>
                <br>
                <h4>Ya tienes cuenta? <a href="<?= base_url ?>usuario/registro">Registrarse</a></h4>

                <?php else : ?>
                    <h3> <?= $_SESSION['usuario']->nombre . ' ' . $_SESSION['usuario']->apellidos ?> </h3>
                    <h3> <?= $_SESSION['usuario']->email ?> </h3>
                <?php endif; Utils::deleteSession('loginError') ?>
                <ul>
                    <?php if(isset($_SESSION['isAdmin'])) : ?>
                        <li><a href="<?= base_url ?>producto/gestion">Gestionar productos</a></li>
                        <li><a href="<?= base_url ?>categoria/inicio">Gestionar categorias</a></li>
                        <li><a href="<?= base_url ?>pedido/gestion">Gestionar pedidos</a></li>
                        <?php endif; ?>
                        <?php if(isset($_SESSION['usuario'])) : ?>
                            <li><a href="<?= base_url ?>pedido/mis_pedidos">Mis pedidos</a></li>
                            <li><a href="<?= base_url ?>usuario/logout">Cerar sesion</a></li>
                    <?php endif; ?>
                </ul>

            </div>

        </aside>
        <!-- Main -->

        <div id="central">