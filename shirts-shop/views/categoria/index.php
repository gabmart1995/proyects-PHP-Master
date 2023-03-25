<h1>Gestionar categorías</h1>

<a href="Categoria/create" class="button button-small">Crear categoria</a>

<table>
    <thead>
        <tr>
            <th>Id:</th>
            <th>Nombre:</th>    
        </tr>
    </thead>
    <tbody>
        <?php while( $category = $categories->fetch_object() ): ?>
            <tr>
                <td><?php echo $category->id; ?></td>
                <td><?php echo $category->nombre; ?></td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>