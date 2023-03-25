<h1>Registrarse</h1>

<?php if ( isset($_SESSION['register']) && $_SESSION['register'] == 'completed' ):  ?>
    <strong class="alert_green">Registro completado correctamente</strong>
<?php endif; ?>

<?php if ( isset($_SESSION['register']) && $_SESSION['register'] == 'failed' ): ?>
    <strong class="alert_red">Registro fallido</strong>
<?php endif; ?>

<?php Utils::deleteSession('register'); ?>

<form action="Usuario/save" method="POST">
    <label for="name">Nombre</label>
    <input type="text" name="name" required />
    <?php if ( isset($_SESSION['errors_register']['name']) ): ?>
        <small style="color: red;"><?php echo $_SESSION['errors_register']['name']; ?></small>
    <?php endif; ?>

    <label for="surname">Apellido</label>
    <input type="text" name="surname" required />
    <?php if ( isset($_SESSION['errors_register']['surname']) ): ?>
        <small style="color: red;"><?php echo $_SESSION['errors_register']['surname']; ?></small>
    <?php endif; ?>

    <label for="email">Correo</label>
    <input type="email" name="email" required />
    <?php if ( isset($_SESSION['errors_register']['email']) ): ?>
        <small style="color: red;"><?php echo $_SESSION['errors_register']['email']; ?></small>
    <?php endif; ?>

    <label for="password">Contraseña</label>
    <input type="password" name="password" required />
    <?php if ( isset($_SESSION['errors_register']['password']) ): ?>
        <small style="color: red;"><?php echo $_SESSION['errors_register']['password']; ?></small>
    <?php endif; ?>

    <button type="submit">Registrarse</button>
</form>

<?php Utils::deleteSession('errors_register'); ?>