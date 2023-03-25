<?php if (isset($product)): ?>
    <h1><?php echo $product->nombre; ?></h1>

    <!-- product -->
    <div id="detail-product">
        <div class="image">
            <?php if ($product->imagen != null): ?>
                <img 
                    src="uploads/images/<?php echo $product->imagen; ?>" 
                    alt="<?php echo $product->imagen; ?>" 
                />
            <?php else: ?>
                <img src="assets/img/camiseta.png" alt="camiseta.png" />
            <?php endif; ?>
        </div>
        <div class="data">
            <h2><?php echo $product->nombre; ?></h2>
            <p class="description"><?php echo $product->descripcion; ?></p>
            <p class="price"><?php echo $product->precio; ?>€</p>
            <a href="Cart/add&id=<?php echo $product->id; ?>" class="button">Comprar</a>
        </div>
    </div>
    
<?php else: ?>
    <h1>El producto que buscas no existe</h1>
<?php endif; ?>

