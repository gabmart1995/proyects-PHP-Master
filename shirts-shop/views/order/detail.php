<h1>Detalle del pedido</h1>

<?php if (isset($order) && isset($orderProducts)): ?>

    <!-- gestion del estado del pedido -->
    <?php if (isset($_SESSION['admin'])): ?>
        <h3 style="margin-top: 20px; margin-bottom: 20px;">Cambiar el estado del pedido</h3>

        <form action="Pedido/state" method="POST">
            <input type="hidden" name="pedido_id" value="<?php echo $order->id; ?>" />
            <select name="estado">
                <option 
                    value="confirm"
                    <?php echo ($order->estado == 'confirm') ? 'selected' : ''; ?>
                >
                    Pendiente
                </option>
                <option 
                    value="preparation"
                    <?php echo ($order->estado == 'preparation') ? 'selected' : ''; ?>
                >
                    En preparación
                </option>
                <option 
                    value="ready"
                    <?php echo ($order->estado == 'ready') ? 'selected' : ''; ?>
                >
                    Preparado para enviar
                </option>
                <option 
                    value="sended"
                    <?php echo ($order->estado == 'sended') ? 'selected' : ''; ?>
                >
                    Enviado
                </option>
            </select>

            <button type="submit">Cambiar estado</button>
        </form>
    <?php endif; ?>

    <h3 style="margin-top: 20px; margin-bottom: 20px;">Dirección de Envio</h3>
    <p>
        Provincia: <?php echo $order->provincia; ?> <br />
        Localidad: <?php echo $order->localidad; ?> <br />
        Dirección: <?php echo $order->direccion; ?>
    </p>


    <h3 style="margin-top: 20px; margin-bottom: 20px;">Datos del pedido</h3>
    <p>
        Estado: <b><?php echo Utils::showStatus($order->estado); ?></b> <br />
        Numero de pedido: <?php echo $order->id; ?> <br />
        Total a pagar: <?php echo $order->coste; ?> <br /><br />
        Productos:

        <table style="margin-top: 20px;">
            <thead>
                <tr>
                    <th>Imagen</th>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Unidades</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($product = $orderProducts->fetch_object()): ?>
                    <tr>
                        <td>
                            <?php if ($product->imagen != null): ?>
                                <img 
                                    src="uploads/images/<?php echo $product->imagen; ?>" 
                                    alt="<?php echo $product->imagen; ?>" 
                                    class="img_carrito"
                                />
                            <?php else: ?>
                                <img class="img_carrito" src="assets/img/camiseta.png" alt="camiseta.png" />
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="Producto/watch&id=<?php echo $product->id; ?>">
                                <?php echo $product->nombre; ?>
                            </a>
                        </td>
                        <td><?php echo $product->precio; ?></td>
                        <td><?php echo $product->unidades; ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </p>
    
<?php endif; ?>