<?php if (isset($_SESSION['identity'])): ?>
    <h1>Hacer pedido</h1>
    <p style="margin-bottom: 20px;">
        <a href="Cart/index">Ver los productos y el precio del pedido</a>
    </p>

    <h3>Domicilio o dirección para el envio</h3>
    <form action="Pedido/save" method="post">
        <label for="province">Provincia</label>
        <input type="text" name="province" />
        <?php if (isset($_SESSION['errors-order']['province'])): ?>
            <small style="color: red;"><?php echo $_SESSION['errors-order']['province']; ?></small>
        <?php endif; ?>

        <label for="city">Ciudad</label>
        <input type="text" name="city" />
        <?php if (isset($_SESSION['errors-order']['city'])): ?>
            <small style="color: red;"><?php echo $_SESSION['errors-order']['city']; ?></small>
        <?php endif; ?>

        <label for="address">Dirección</label>
        <input type="text" name="address" />
        <?php if (isset($_SESSION['errors-order']['address'])): ?>
            <small style="color: red;"><?php echo $_SESSION['errors-order']['address']; ?></small>
        <?php endif; ?>

        <button type="submit">Confirmar pedido</button>
    </form>
    <?php Utils::deleteSession('errors-order'); ?>

<?php else: ?>
    <p>Necesitas estar registrado en el sistema para poder realizar pedidos</p>
<?php endif; ?>