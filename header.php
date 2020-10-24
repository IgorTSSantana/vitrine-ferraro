<!DOCTYPE html>

<head>

    <title>Vitrine Ferraro</title>

    <meta charset="utf-8">

    <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri() . '/public/css/reset.css'?>">
    <link rel="stylesheet" type="text/css"
        href="<?php echo get_template_directory_uri() . '/public/bootstrap/css/bootstrap.min.css'?>">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri() . '/style.css'?>">
    <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri() . '/public/css/index.css'?>">
    <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri() . '/public/css/contato.css'?>">
    <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri() . '/public/css/header.css'?>">
    <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri() . '/public/css/footer.css'?>">
    <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri() . '/public/css/sobre.css'?>">
    <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri() . '/public/css/produtos.css'?>">

    <script src="<?php echo get_template_directory_uri() . '/public/js/jquery.min.js'?>"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="<?php echo get_template_directory_uri() . '/public/bootstrap/js/bootstrap.min.js'?>"></script>


    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script&display=swap" rel="stylesheet">

</head>
<?php
    $cat_args = [
        // 'orderby'    => 'name',
        // 'order'      => 'desc',
        'hide_empty' => false,
    ];

    $product_categories = get_terms('product_cat', $cat_args);
    ?>

<body>
    <header>

        <div id="area-logo">
            <img style="width:539px;height:193px;"
                src="<?php echo get_template_directory_uri() . '/public/img/logo2.png' ?>">
        </div>

        <div id="area-menu">
            <a class="menu-link" href="<?php echo get_site_url() . '/' ?>">HOME</a>
            <?php if (!empty($product_categories)) : ?>
            <div class="btn-group menu-link">
                <button id="todos-produtos" type="button" class="menu-link">PRODUTOS</button>
                <button type="button" class="menu-link dropdown-toggle dropdown-toggle-split" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <span class="sr-only menu-link">Toggle Dropdown</span>
                </button>
                <div class="dropdown-menu menu-link dropdown-link">

                    <?php foreach ($product_categories as $key => $category) : ?>
                    <?php if($category->slug !='sem-categoria') :?>
                    <a class="dropdown-item menu-link dropdown-link" href="<?= get_term_link($category) ?>">
                        <?= $category->name ?>
                    </a>
                    <?php endif; ?>
                    <?php endforeach; ?>


                </div>
                <?php endif; ?>
            </div>
            <a class="menu-link" href="<?php echo get_template_directory_uri() . '/sobre' ?>">SOBRE A EMPRESA</a>
            <a class="menu-link" href="<?php echo get_template_directory_uri() . '/contato' ?>">CONTATO</a>



        </div>

    </header>