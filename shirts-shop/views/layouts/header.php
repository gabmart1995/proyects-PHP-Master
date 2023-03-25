<!DOCTYPE html>
<html lang="es-VE">
<head>
    <base href="<?php echo base_url; ?>" />
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda de camisetas</title>
    <link rel="stylesheet" href="assets/css/styles.css" type="text/css" />
</head>
<body>
    <!-- cabecera -->
    <header id="header">
        <div id="logo">
            <img src="assets/img/camiseta.png" alt="camiseta-logo" />
            <a href="/">
                <h1>Tienda de camisetas</h1>
            </a>
        </div>
    </header>

    <!-- menu -->
    <nav id="menu">
        <ul>
            <li><a href="/">Inicio</a></li>
            <?php 
                $categories = Utils::getCategories(); 
                while ($category = $categories->fetch_object()):
            ?>
                <li>
                    <a href="Categoria/watch&id=<?php echo $category->id; ?>">
                        <?php echo $category->nombre; ?>
                    </a>
                </li>
            <?php endwhile;  ?>
        </ul>
    </nav>
    
    <!-- contenido -->
    <div id="content">