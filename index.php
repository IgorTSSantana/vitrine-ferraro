<?php

get_header();

$post_destaques = [
    'post_type' => 'post',
    'posts_per_page' => 3,
    'category_name' => 'carrossel'
];

$args_masc_destaques = [
    'post_type' => 'product',
    'posts_per_page' => 1000,
    'taxonomy' => 'pa_destaque',
    'term' => 'sim'
];

$args_fem_destaques = [
    'post_type' => 'product',
    'posts_per_page' => 1000,
    'taxonomy' => 'pa_destaque',
    'term' => 'sim'
];

?>
<section class="container">
    <?php if (have_posts()) : ?>
        <?php $query = new WP_Query($post_destaques); ?>
        <?php if ($query->have_posts()) : ?>
            <?php $post = $posts[0]; ?>
            <?php $contador_carrossel = 0; ?>
            <?php $contador_indicador = 0; ?>
            <div id="carouselExampleCaptions" class="carousel slide carrossel" data-ride="carousel">
                <ol class="carousel-indicators">
                    <?php while ($contador_indicador < 3) : ?>
                        <li data-target="#carousel-slide" data-slide-to="<?php echo $contador_indicador++; ?>" class="<?php if ($contador_indicador === 1) echo 'active'; ?>"></li>
                    <?php endwhile; ?>
                </ol>
                <div class="carousel-inner">
                    <?php while ($query->have_posts()) : ?>
                        <?php $query->the_post(); ?>
                        <div class="carousel-item<?php $contador_carrossel++ ?> <?php if ($contador_carrossel === 1) echo ' active'; ?>">
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

<section class="container oculos-masculino-destaques">
    <span class="texto-destaques">Destaques Masculino</span>
    <div class="row">
        <?php $loop = new WP_Query($args_masc_destaques); ?>
        <?php if ($loop->have_posts()) : ?>
            <div class="col-md-12 cartoes-masculinos">
                <?php while ($loop->have_posts()) : $loop->the_post(); ?>
                    <?php $preco = str_replace(".", ",", get_post_meta(get_the_ID(), '_regular_price', true)) ?>
                    <?php $product = new WC_product(get_the_ID()); ?>
                    <?php $attachment_ids = $product->get_gallery_image_ids(); ?>

                    <?php if ($product->get_attribute( 'pa_sexo' ) == "Masculino") : ?>
                        <div class="card card-produto">
                            <div id="carrossel_<?= $product->id ?>" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <?php the_post_thumbnail('thumbnail', array('class' => 'imagem-produto')); ?>
                                    </div>
                                    <?php foreach ($attachment_ids as $attachment_id) : ?>
                                        <div class="carousel-item">
                                            <?php echo wp_get_attachment_image($attachment_id, 'thumbnail', "", ["class" => "imagem-produto"]); ?>
                                        </div>
                                    <?php endforeach ?>
                                </div>
                                <a class="carousel-control-prev" href="#carrossel_<?= $product->id ?>" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#carrossel_<?= $product->id ?>" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>
                            <?php if ($product->get_attribute('pa_instagram') == "Sim") : ?>
                            <div class="insta-img">
                            <img src="<?php echo get_template_directory_uri() . '/public/img/instagram.svg' ?>" style="width: 30px; height: 30px;">
                            </div>
                        <?php endif; ?>
                            <div class="card-body">
                                <span class="codigo-produto">
                                    <?php echo get_post_meta(get_the_ID(), '_sku', true) ?>
                                </span> <br>
                                <span class="titulo-produto">
                                    <?= get_the_title() ?> <br>
                                </span>
                                <span class="sexo">
                                    <?php echo array_shift(wc_get_product_terms(get_the_ID(), 'pa_sexo', array('fields' => 'names'))); ?>
                                </span> <br>
                                <span class="categoria">
                                    <?php $term = get_term_by('id', $product->category_ids[0], 'product_cat'); ?>
                                    <?= $term->name ?>
                                </span> <br>
                                <span class="preco">
                                    R$<?= $preco ?>
                                </span>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endwhile; ?>
            </div>
            <?php wp_reset_query(); ?>
        <?php else : ?>
            <div class="artigo">
                <h5>Nenhum produto Masculino em destaque.</h5>
            </div>
        <?php endif; ?>
    </div>
</section>

<section class="container oculos-feminino-destaques">
    <span class="texto-destaques">Destaques Femininos</span>
    <div class="row">
        <?php $loop = new WP_Query($args_fem_destaques); ?>
        <?php if ($loop->have_posts()) : ?>
            <div class="col-md-12 cartoes-femininos">
                <?php while ($loop->have_posts()) : $loop->the_post(); ?>
                    <?php $preco = str_replace(".", ",", get_post_meta(get_the_ID(), '_regular_price', true)) ?>
                    <?php $product = new WC_product(get_the_ID()); ?>
                    <?php $attachment_ids = $product->get_gallery_image_ids(); ?>
                    <?php if ($product->get_attribute( 'pa_sexo' ) == "Feminino") : ?>
                        <div class="card card-produto">
                            <div id="carrossel_<?= $product->id ?>" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <?php the_post_thumbnail('thumbnail', array('class' => 'imagem-produto')); ?>
                                    </div>
                                    <?php foreach ($attachment_ids as $attachment_id) : ?>
                                        <div class="carousel-item">
                                            <?php echo wp_get_attachment_image($attachment_id, 'thumbnail', "", ["class" => "imagem-produto"]); ?>
                                        </div>
                                    <?php endforeach ?>
                                </div>
                                <a class="carousel-control-prev" href="#carrossel_<?= $product->id ?>" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#carrossel_<?= $product->id ?>" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>
                            <?php if ($product->get_attribute('pa_instagram') == "Sim") : ?>
                            <div class="insta-img">
                            <img src="<?php echo get_template_directory_uri() . '/public/img/instagram.svg' ?>" style="width: 30px; height: 30px;">
                            </div>
                        <?php endif; ?>
                            <div class="card-body">
                                <span class="codigo-produto">
                                    <?php echo get_post_meta(get_the_ID(), '_sku', true) ?>
                                </span> <br>
                                <span class="titulo-produto">
                                    <?= get_the_title() ?> <br>
                                </span>
                                <span class="sexo">
                                    <?php echo array_shift(wc_get_product_terms(get_the_ID(), 'pa_sexo', array('fields' => 'names'))); ?>
                                </span> <br>
                                <span class="categoria">
                                    <?php $term = get_term_by('id', $product->category_ids[0], 'product_cat'); ?>
                                    <?= $term->name ?>
                                </span> <br>
                                <span class="preco">
                                    R$<?= $preco ?>
                                </span>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endwhile; ?>
            </div>
            <?php wp_reset_query(); ?>
        <?php else : ?>
            <div class="artigo">
                <h5>Nenhum produto Feminino em destaque.</h5>
            </div>
        <?php endif; ?>
    </div>
</section>

<div class="clear"></div>

<script type="text/javascript">
    $('.cartoes-masculinos').slick({
        infinite: false,
        slidesToShow: 5.5,
        slidesToScroll: 5
    });
    $('.cartoes-femininos').slick({
        infinite: false,
        slidesToShow: 5.5,
        slidesToScroll: 5
    });
</script>

<?php

get_footer();
