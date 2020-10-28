<?php

/**
 * template name: page
 */

get_header();

$paged = (get_query_var('page')) ? get_query_var('page') : 1;
$filtro_categoria = $_GET['categoria'];
$filtro_atributo = $_GET['atributo'];
$args = [
    'post_type' => 'product',
    'posts_per_page' => 10,
    // 'product_cat' => $filtro_categoria,
    'paged' => $paged
];
if(isset($filtro_atributo)) {
     $args['meta_query']=$filtro_atributo;
}
?>

<div class="container container-top">


    <div class="row titulo-site">
        <h1>
            <span class="titulo-pagina"><?php the_title(); ?></span>
        </h1>
    </div>



    <section class="row contato-conteudo">

        <div class="col-md-2">
            <p class="texto-genero">Escolha o gênero de armação desejado:</p>
            <div>
                <input type="radio" id="sexo" name="atributo" value="masculino">
                <label for="sexo">Masculino</label>
            </div>

            <div>
                <input type="radio" id="sexo" name="atributo" value="feminino">
                <label for="sexo">Feminino</label>
            </div>
            <div>
                <input type="radio" id="sexo" name="atributo" value="todos" checked>
                <label for="sexo">Todos</label>
            </div>
            <button class="btn btn-primary" type="button" id="botao-filtrar">
                Aplicar
            </button>
        </div>

        <div class="col-md-10">

            <?php $loop = new WP_Query($args); ?>
            <?php if ($loop->have_posts()) : ?>
            <?php while ($loop->have_posts()) : $loop->the_post(); ?>

            <?php $preco=str_replace(".",",", get_post_meta(get_the_ID(),'_regular_price',true)) ?>

            <?php $product = new WC_product(get_the_ID());
            $attachment_ids = $product->get_gallery_image_ids();
            ?>
            <div class="card card-produto">
                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <?php the_post_thumbnail('thumbnail', array('class' => 'imagem-produto')); ?>

                        </div>

                        <?php foreach( $attachment_ids as $attachment_id ) : ?>
                        <div class="carousel-item">
                        <?php echo wp_get_attachment_image($attachment_id, 'thumbnail', "", ["class" => "imagem-produto"] ); ?>

                        </div>
                        <?php endforeach ?>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
                <div class="card-body">
                    <span class="codigo-produto">

                        <?php echo get_post_meta(get_the_ID(),'_sku',true) ?>

                    </span> <br>
                    <span class="titulo-produto">
                        <?= get_the_title() ?> <br>
                    </span>
                    <span class="sexo">

                        <?php echo array_shift( wc_get_product_terms( get_the_ID(), 'pa_sexo', array( 'fields' => 'names' ) ) ); ?>

                    </span> <br>
                    <span class="preco">
                        R$<?=$preco?>
                    </span>
                </div>
            </div>





            <?php endwhile; ?>
            <?php wp_reset_query(); ?>
            <nav>
                <ul>
                    <li><?php previous_posts_link('&laquo; PREV', $loop->max_num_pages) ?></li>
                    <li><?php next_posts_link('NEXT &raquo;', $loop->max_num_pages) ?></li>
                </ul>
            </nav>
        </div>
    </section>
    <div class="clear"></div>
    <?php comments_template(); ?>

    <?php comments_popup_link('Sem Comentários', '1 Comentário', '% Comentários', 'comments-link', ''); ?>
    <?php else : ?>
    <div class="artigo">
        <h2>Nada Encontrado</h2>
        <p>Erro 404</p>
        <p>Lamentamos mas não foram encontrados artigos.</p>
    </div>
    <?php endif; ?>

</div>

<script>
    $('body').on('click','#botao-filtrar',function(){
        let filtro=$('input[name="atributo"]:checked')
        window.location.href=window.location.origin + '/wordpress/produtos?atributo=' + filtro.val()
    })
</script>

<?php get_footer(); ?>