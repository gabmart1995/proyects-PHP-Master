<h1>Carrito de Compra</h1>

<?php if (isset($cart) && count($cart) > 0 ): ?>
    <table>
        <thead>
            <tr>
                <th>Imagen</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Unidades</th>
                <th>Acciones:</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                foreach ($cart as $index => $item): 
                    $product = $item['producto'];
            ?>
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
                    <td>
                        <?php echo $item['unidades']; ?>
                        <div class="updown-unidades">
                            <a href="Cart/addQuantity&index=<?php echo $index; ?>" class="button">+</a>
                            <a href="Cart/removeQuantity&index=<?php echo $index; ?>" class="button">-</a>
                        </div>
                    </td>
                    <td>
                        <a 
                            href="Cart/remove&index=<?php echo $index; ?>" 
                            class="button button-carrito button-red"
                        >
                            Quitar producto
                        </a>   
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    
    <br />
    <div class="delete-carrito">
        <a href="Cart/deleteAll" class="button button-red button-delete">
            Vaciar carrito
        </a>
    </div>
    <div class="total-carrito">
        <h3>Precio total: <?php echo (Utils::statsCart())['total']; ?>€</h3>
        <a href="Pedido/create" class="button button-pedido">Hacer pedido</a>
    </div>
<?php else: ?>
    <p>El carrito está vacio. Añade algún producto</p>
<?php endif; ?>


