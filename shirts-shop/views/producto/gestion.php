<h1>Gestion de productos</h1>
<?php if ( isset($_SESSION['register-product']) && $_SESSION['register-product'] == 'completed' ): ?>
    <div class="alert_green" style="margin-bottom: 20px;">
        <b>Registro de producto completado</b>
    </div>
<?php endif; ?>

<?php if ( isset($_SESSION['delete-product']) && $_SESSION['delete-product'] == 'completed' ): ?>
    <div class="alert_green" style="margin-bottom: 20px;">
        <b>Producto eliminado correctamente</b>
    </div>
<?php endif; ?>

<?php 
    Utils::deleteSession('register-product'); 
    Utils::deleteSession('delete-product');
?>

<a href="Producto/create" class="button button-small">Crear producto</a>

<table>
    <thead>
        <tr>
            <th>Id:</th>
            <th>Nombre:</th>    
            <th>Precio:</th>
            <th>Stock:</th>
            <th>Acciones:</th>    
        </tr>
    </thead>
    <tbody>
        <?php while( $product = $products->fetch_object() ): ?>
            <tr>
                <td><?php echo $product->id; ?></td>
                <td><?php echo $product->nombre; ?></td>
                <td><?php echo $product->precio; ?></td>
                <td><?php echo $product->stock; ?></td>
                <td>
                    <a 
                        href="Producto/edit&id=<?php echo $product->id; ?>" 
                        class="button button-gestion"
                    >
                        Editar
                    </a>
                    <a 
                        href="Producto/delete&id=<?php echo $product->id; ?>" 
                        class="button button-gestion button-red"
                    >
                        Eliminar
                    </a>
                </td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>