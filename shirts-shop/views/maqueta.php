<!DOCTYPE html>
<html lang="es-VE">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda de camisetas</title>
    <link rel="stylesheet" href="assets/css/styles.css" />
</head>
<body>
    <!-- cabecera -->
    <header id="header">
        <div id="logo">
            <img src="assets/img/camiseta.png" alt="camiseta-logo" />
            <a href="index.php">
                <h1>Tienda de camisetas</h1>
            </a>
        </div>
    </header>

    <!-- menu -->
    <nav id="menu">
        <ul>
            <li><a href="">Incio</a></li>
            <li><a href="">Categoria 1</a></li>
            <li><a href="">Categoria 2</a></li>
            <li><a href="">Categoria 3</a></li>
        </ul>
    </nav>
    
    <!-- contenido -->
    <div id="content">
        
        <!--  barra lateral -->
        <aside id="lateral">
            <div id="login" class="block_aside">
                <form action="#" method="POST">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" />

                    <label for="password">password</label>
                    <input type="password" name="password" id="password" />

                    <button type="submit">Enviar</button>
                </form>

                <a href="#">Mis pedidos</a>
                <a href="#">Gestionar pedidos</a>
                <a href="#">Gestionar categorias</a>
            </div>
        </aside>
        
        <!-- contenido central -->
        <div id="central">
            <div class="product">
                <img src="assets/img/camiseta.png" alt="camiseta-logo" />
                <h2>Camiseta azul holgada</h2>
                <p>30€</p>
                <a href="#">Comprar</a>
            </div>

            <div class="product">
                <img src="assets/img/camiseta.png" alt="camiseta-logo" />
                <h2>Camiseta azul holgada</h2>
                <p>30€</p>
                <a href="#">Comprar</a>
            </div>
        </div>
    </div>


    <!-- pie de pagina -->
    <footer id="footer">
        <p>Desarrollado por: Gabriel Martinez &copy;<?php echo date('Y'); ?></p>
    </footer>
</body>
</html>