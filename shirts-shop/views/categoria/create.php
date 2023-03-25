<h1>Crear nueva categoria</h1>

<?php if ( isset($_SESSION['register-category']) && $_SESSION['register-category'] == 'completed' ):  ?>
    <strong class="alert_green">Registro completado correctamente</strong>
<?php endif; ?>

<?php if ( isset($_SESSION['register-category']) && $_SESSION['register-category'] == 'failed' ): ?>
    <strong class="alert_red">Registro fallido</strong>
<?php endif; ?>
<?php Utils::deleteSession('register-category'); ?>

<form action="Categoria/save" method="post">
    <label for="name">Nombre</label>
    <input type="text" name="name" />
    <?php if ( isset($_SESSION['errors_category']['name']) ): ?>
        <small style="color: red;"><?php echo $_SESSION['errors_category']['name']; ?></small>
    <?php endif; ?>

    <button type="submit">Guardar</button>
</form>

<?php Utils::deleteSession('errors_category'); ?>