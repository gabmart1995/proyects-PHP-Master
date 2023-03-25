<?php if (isset($_SESSION['register-order']) && $_SESSION['register-order'] == 'completed'): ?>
    <h1>Tu pedido se ha confirmado</h1>
    
    <p>
        Tu pedido ha sido guardado con exito, una vez que realices
        la transferencia bancaria a la cuenta: xxxx-xxxx-xxxx-xxxx-xxxx con el coste, 
        será procesado y enviado.
    </p>

    <?php if (isset($order) && isset($orderProducts)): ?>
        
        <h3 style="margin-top: 20px; margin-bottom: 20px;">Datos del pedido</h3>
        <p>
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

<?php endif; ?>

<?php if (isset($_SESSION['register-order']) && $_SESSION['register-order'] == 'failed'): ?>
    <h1>Tu pedido no ha podido procesarse</h1>
<?php endif; ?>
