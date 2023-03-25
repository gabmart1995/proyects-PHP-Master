<!-- title and url -->
<?php if (isset($edit) && isset($productDB) && is_object($productDB)): ?>
    <h1>Editar producto <?php echo $productDB->nombre; ?></h1>
    <?php $url = 'update&id='.$productDB->id; ?>
<?php else: ?>
    <h1>Crear nuevo producto</h1>
    <?php $url = 'save'; ?>
<?php endif; ?>

<!-- register failed -->
<?php if ( isset($_SESSION['register-product']) && $_SESSION['register-product'] == 'failed' ): ?>
    <strong class="alert_red">Registro fallido</strong>
<?php endif; ?>
<?php Utils::deleteSession('register-product'); ?>

<div class="form-container">
    <form action="Producto/<?php echo $url; ?>" method="post" enctype="multipart/form-data">
        <label for="name">Nombre</label>
        <input 
            type="text" 
            name="name" 
            value="<?php echo (isset($productDB) && is_object($productDB)) ? $productDB->nombre : ''; ?>" 
        />
        <?php if ( isset($_SESSION['errors_product']['name']) ): ?>
            <small style="color: red;"><?php echo $_SESSION['errors_product']['name']; ?></small>
        <?php endif; ?>
    
        <label for="description">Descripcion</label>
        <textarea name="description"><?php echo (isset($productDB) && is_object($productDB)) ? $productDB->descripcion : ''; ?></textarea>
        <?php if ( isset($_SESSION['errors_product']['description']) ): ?>
            <small style="color: red;"><?php echo $_SESSION['errors_product']['description']; ?></small>
        <?php endif; ?>

        <label for="price">Precio</label>
        <input 
            type="number" 
            step="0.01" min="1" 
            max="9999999" 
            name="price"
            value="<?php echo (isset($productDB) && is_object($productDB)) ? $productDB->precio : ''; ?>" 
        />
        <?php if ( isset($_SESSION['errors_product']['price']) ): ?>
            <small style="color: red;"><?php echo $_SESSION['errors_product']['price']; ?></small>
        <?php endif; ?>
    
        <label for="stock">Stock</label>
        <input 
            type="number" 
            name="stock" 
            min="1"
            max="99999999"
            value="<?php echo (isset($productDB) && is_object($productDB)) ? $productDB->stock : ''; ?>"    
        />
        <?php if ( isset($_SESSION['errors_product']['stock']) ): ?>
            <small style="color: red;"><?php echo $_SESSION['errors_product']['stock']; ?></small>
        <?php endif; ?>
    
        <label for="categoria">Categoria</label>
        <select name="category_id">
            <option value="">Seleccione</option>
            <?php
                $categories = Utils::getCategories();
                while ( $category = $categories->fetch_object() ): 
            ?>
                <option 
                    value="<?php echo $category->id; ?>"
                    <?php 
                        echo (
                                isset($productDB) && 
                                is_object($productDB) && 
                                ($category->id == $productDB->categoria_id) 
                            ) ? 
                                'selected' : ''; 
                    ?>
                >
                    <?php echo $category->nombre; ?>
                </option>
            <?php endwhile; ?>
        </select>
        <?php if ( isset($_SESSION['errors_product']['category_id']) ): ?>
            <small style="color: red;"><?php echo $_SESSION['errors_product']['category_id']; ?></small>
        <?php endif; ?>
    
        <label for="image">Imagen</label>
        
        <!-- muestra la imagen -->
        <?php if (isset($productDB) && is_object($productDB) && !empty($productDB->imagen)): ?>
            <img 
                src="uploads/images/<?php echo $productDB->imagen ?>" 
                alt="<?php echo $productDB->imagen ?>" 
                class="thumb"
            />
        <?php endif; ?>

        <input type="file" name="image" accept="image/*" />

        <button type="submit">Guardar</button>
    </form>
    <?php Utils::deleteSession('errors_product'); ?>
</div>