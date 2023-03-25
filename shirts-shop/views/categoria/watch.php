<?php if (isset($category)): ?>
    <h1><?php echo $category->nombre; ?></h1>
<?php else: ?>
    <h1>La categoria que buscas no existe</h1>
<?php endif; ?>

<?php if (isset($products) && ($products->num_rows > 0)): ?>
    <?php while ($product = $products->fetch_object()): ?>
        <div class="product">
            <a href="Producto/watch&id=<?php echo $product->id; ?>">
                <?php if ($product->imagen != null): ?>
                    <img 
                        src="uploads/images/<?php echo $product->imagen; ?>" 
                        alt="<?php echo $product->imagen; ?>" 
                    />
                <?php else: ?>
                    <img src="assets/img/camiseta.png" alt="camiseta.png" />
                <?php endif; ?>
                <h2><?php echo $product->nombre; ?></h2>
            </a>
            <p><?php echo $product->precio ?>€</p>
            <a href="Cart/add&id=<?php echo $product->id; ?>" class="button">Comprar</a>
        </div>
    <?php endwhile; ?>
<?php else: ?>
    <p>No hay productos para mostrar</p>
<?php endif; ?>


