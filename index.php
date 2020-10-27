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
    <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
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
<section class="row contato-conteudo">
    <article class="col-lg-6">
        <h1>Um pouco da História</h1>
        <p class="p-esquerda">
            A Óptica Ferraro é uma pequena óptica fundada em 2014 pelo casal Leonardo e Elisabete com o objetivo de
            ajudar as pessoas que necessitam de óculos de grau ou mesmo as que so querem um ...
            <a href="">leia mais</a>
        </p>
    </article>

    <article class="col-lg-6">
        <h1>Spark AR</h1>
        <p class="p-direita">
        Para a criação do filtro dos óculos será utilizado o software Spark AR que
        através da inteligência artificial adequa a imagem (no caso o óculos) ao rosto do
        usuário. No site haverá um link direto para o Instagram da ótica, onde terá disponível
        os filtros para o cliente experimentar.
            <a href="">leia mais...</a>
        </p>
    </article>
</section>

<div class="clear"></div>


<?php

get_footer();