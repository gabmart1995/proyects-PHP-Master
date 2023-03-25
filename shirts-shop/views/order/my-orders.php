<?php if (isset($gestion)): ?>
    <h1>Gestionar pedidos</h1>
<?php else: ?>
    <h1>Mis pedidos</h1>
<?php endif; ?>

<table>
    <thead>
        <tr>
            <th>Número de pedido</th>
            <th>Coste</th>
            <th>Fecha</th>
            <th>Estado</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($order = $orders->fetch_object()): ?>
            <tr>
                <td>
                    <a href="Pedido/detail&id=<?php echo $order->id; ?>">
                        <?php echo $order->id; ?>
                    </a>    
                </td>
                <td><?php echo $order->coste; ?>€</td>
                <td><?php echo $order->fecha; ?></td>
                <td><?php echo Utils::showStatus($order->estado); ?></td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>