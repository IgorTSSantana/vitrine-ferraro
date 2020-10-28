<?php

get_header();

$post_destaques = [
    'post_type' => 'post',
    'posts_per_page' => 3,
    'category_name' => 'carrossel'
];?>
<section class="container">
    <?php if (have_posts()):?>
    <?php $query = new WP_Query($post_destaques); ?>
    <?php if ($query->have_posts()) : ?>
    <?php $post = $posts[0]; ?>
    <?php $contador_carrossel = 0; ?>
    <?php $contador_indicador = 0; ?>
    <div id="carouselExampleCaptions" class="carousel slide carrossel" data-ride="carousel">
        <ol class="carousel-indicators">
            <?php while ($contador_indicador < 3) : ?>
            <li data-target="#carousel-slide" data-slide-to="<?php echo $contador_indicador++; ?>"
                class="<?php if ($contador_indicador === 1) echo 'active'; ?>"></li>
            <?php endwhile; ?>
        </ol>
        <div class="carousel-inner">
            <?php while ($query->have_posts()) : ?>
            <?php $query->the_post(); ?>
            <div
                class="carousel-item<?php $contador_carrossel++ ?> <?php if ($contador_carrossel === 1) echo ' active'; ?>">
                <?php the_post_thumbnail('post_thumbnail', ['id' => 'carousel-img', 'class' => 'carousel-img', 'alt' => 'First Slide']); ?>
                <div class="carousel-caption">
                    <a class="link-carrossel" href="<?php echo get_permalink(); ?>">
                        <div class="noticia_carrosel">
                            <h3><?php the_title(); ?></h3>
                            <span class="d-none d-md-block"><?php the_excerpt(); ?></span>
                        </div>
                    </a>
                </div>
            </div>
            <?php wp_reset_query(); ?>
            <?php endwhile; ?>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
        <?php endif; ?>
    </div>
    <?php endif; ?>
</section>
<section class="row oculos-destaques">

    <article class="col-sm-6">
                <span class="texto-destaques">Destaques Masculinos</span>
        <div class="container destaques-masculinos">
            <div class="row">
                <div class="col-sm-4">
                    <div class="card" style="width: 11rem;">
                        <img class="card-img-top imagem-produto"
                            src="<?php echo get_template_directory_uri() . '/public/img/teste.jpg' ?>" alt="destq masc">
                        <div class="card-body">
                            <span class="codigo-produto">
                                SKU-1576

                            </span> <br>
                            <span class="titulo-produto">
                                Ferraro
                            </span><br>
                            <span class="preco">
                                R$200.00
                            </span><br>
                            <a href="#" class="btn btn-primary">Veja mais...</a>
                        </div>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="card" style="width: 11rem;">
                        <img class="card-img-top imagem-produto"
                            src="<?php echo get_template_directory_uri() . '/public/img/teste.jpg' ?>" alt="destq masc">
                        <div class="card-body">
                            <span class="codigo-produto">
                                SKU-1576

                            </span> <br>
                            <span class="titulo-produto">
                                Ferraro
                            </span><br>
                            <span class="preco">
                                R$200.00
                            </span><br>
                            <a href="#" class="btn btn-primary">Veja mais...</a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="card" style="width: 11rem;">
                        <img class="card-img-top imagem-produto"
                            src="<?php echo get_template_directory_uri() . '/public/img/teste.jpg' ?>" alt="destq masc">
                        <div class="card-body">
                            <span class="codigo-produto">
                                SKU-1576

                            </span> <br>
                            <span class="titulo-produto">
                                Ferraro
                            </span><br>
                            <span class="preco">
                                R$200.00
                            </span><br>
                            <a href="#" class="btn btn-primary">Veja mais...</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </article>


    <article class="col-sm-6">
    <span class="texto-destaques">Destaques Femininos</span>
        <div class="container destaques-femininos">
            <div class="row">
                <div class="col-sm-4">
                    <div class="card" style="width: 11rem;">
                        <img class="card-img-top imagem-produto"
                            src="<?php echo get_template_directory_uri() . '/public/img/teste.jpg' ?>" alt="destq masc">
                        <div class="card-body">
                            <span class="codigo-produto">
                                SKU-1576

                            </span> <br>
                            <span class="titulo-produto">
                                Ferraro
                            </span><br>
                            <span class="preco">
                                R$200.00
                            </span><br>
                            <a href="#" class="btn btn-primary">Veja mais...</a>
                        </div>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="card" style="width: 11rem;">
                        <img class="card-img-top imagem-produto"
                            src="<?php echo get_template_directory_uri() . '/public/img/teste.jpg' ?>" alt="destq masc">
                        <div class="card-body">
                            <span class="codigo-produto">
                                SKU-1576

                            </span> <br>
                            <span class="titulo-produto">
                                Ferraro
                            </span><br>
                            <span class="preco">
                                R$200.00
                            </span><br>
                            <a href="#" class="btn btn-primary">Veja mais...</a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="card" style="width: 11rem;">
                        <img class="card-img-top imagem-produto"
                            src="<?php echo get_template_directory_uri() . '/public/img/teste.jpg' ?>" alt="destq masc">
                        <div class="card-body">
                            <span class="codigo-produto">
                                SKU-1576

                            </span> <br>
                            <span class="titulo-produto">
                                Ferraro
                            </span><br>
                            <span class="preco">
                                R$200.00
                            </span><br>
                            <a href="#" class="btn btn-primary">Veja mais...</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </article>
</section>

<div class="clear"></div>


<?php

get_footer();