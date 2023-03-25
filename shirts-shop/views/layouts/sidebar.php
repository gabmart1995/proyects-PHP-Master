<!--  barra lateral -->
<aside id="lateral">
    <?php $stats = Utils::statsCart(); ?>
    <div id="carrito">
        <h3>Mi Carrito</h3>
        <ul>
            <li>
                Productos (<?php echo $stats['count']; ?>)
            </li>
            <li>
                Total <?php echo $stats['total']; ?>€
            </li>
            <li>
                <a href="Cart/index">Ver el carrito</a>
            </li>
        </ul>
    </div>

    <div id="login" class="block_aside">
        <?php if (!isset($_SESSION['identity'])): ?>
            
            <h3>Entrar a la web</h3>
            
            <?php if (isset($_SESSION['errors_login']['login'])): ?>
                <strong class="alert_red" style="margin-top: 20px;">
                    <?php echo $_SESSION['errors_login']['login']; ?>
                </strong>
            <?php endif; ?>

            <form action="Usuario/login" method="POST">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" />
                <?php if ( isset($_SESSION['errors_login']['email']) ): ?>
                    <small style="color: red;"><?php echo $_SESSION['errors_login']['email']; ?></small>
                <?php endif; ?>
    
                <label for="password">password</label>
                <input type="password" name="password" id="password" />
                <?php if ( isset($_SESSION['errors_login']['password']) ): ?>
                    <small style="color: red;"><?php echo $_SESSION['errors_login']['password']; ?></small>
                <?php endif; ?>
    
                <button type="submit">Enviar</button>
            </form>
            
            <p class="mt-2">¿No posee cuenta? <a href="Usuario/register">Registrese</a></p>

            <?php Utils::deleteSession('errors_login');  ?>
        
        <?php else: ?>
            <h3>
                <?php echo $_SESSION['identity']->nombre; ?> 
                <?php echo $_SESSION['identity']->apellidos; ?>
            </h3>
        <?php endif; ?>

        <ul>
            <?php if (isset($_SESSION['identity'])): ?>
                <li><a href="Pedido/my_orders">Mis pedidos</a></li>
            <?php endif; ?>
            <?php if (isset($_SESSION['admin'])): ?>
                <li><a href="Categoria/index">Gestionar categorias</a></li>
                <li><a href="Producto/gestion">Gestionar productos</a></li>
                <li><a href="Pedido/orders">Gestionar pedidos</a></li>
            <?php endif; ?> 
            <?php if (isset($_SESSION['identity'])): ?>
                <li><a href="Usuario/logout">Cerrar sesion</a></li>
            <?php endif; ?>
        </ul>
    </div>
</aside>

<!-- contenido central -->
<div id="central">