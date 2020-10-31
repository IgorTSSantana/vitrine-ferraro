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
    'posts_per_page' => 8,
    'product_cat' => $filtro_categoria,
    'paged' => $paged,
];

if (!is_null($filtro_atributo) && $filtro_atributo != 'todos') {
    $args['taxonomy'] = 'pa_sexo';
    $args['term'] = $filtro_atributo;
}
?>

<div class="container container-top">
    <div class="row titulo-site">
        <h1>
            <span class="titulo-pagina"><?php the_title(); ?></span>
        </h1>
    </div>
    <?php $loop = new WP_Query($args); ?>
    <?php if ($loop->have_posts()) : ?>
        <section class="row contato-conteudo">
            <div class="col-md-2">
                <p class="texto-genero">Escolha o gênero de armação desejado:</p>
                <div>
                    <input type="radio" id="sexo_masculino" name="atributo" value="masculino">
                    <label for="sexo_masculino">Masculino</label>
                </div>
                <div>
                    <input type="radio" id="sexo_feminino" name="atributo" value="feminino">
                    <label for="sexo_feminino">Feminino</label>
                </div>
                <div>
                    <input type="radio" id="sexo_todos" name="atributo" value="todos" checked>
                    <label for="sexo_todos">Todos</label>
                </div>
                <button class="btn btn-primary" type="button" id="botao-filtrar">
                    Aplicar
                </button>
            </div>
            <div class="col-md-10">
                <?php while ($loop->have_posts()) : $loop->the_post(); ?>
                    <?php $preco = str_replace(".", ",", get_post_meta(get_the_ID(), '_regular_price', true)) ?>
                    <?php $product = new WC_product(get_the_ID()); ?>
                    <?php $attachment_ids = $product->get_gallery_image_ids(); ?>
                    <div class="card card-produto">
                        <div id="carrossel_<?= $product->id?>" class="carousel slide" data-ride="carousel">
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
                            <a class="carousel-control-prev" href="#carrossel_<?= $product->id?>" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carrossel_<?= $product->id?>" role="button" data-slide="next">
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
                <?php endwhile; ?>
            </div>
        </section>
            <nav class="d-flex justify-content-center" aria-label="Page navigation example" style="margin-top: 75px;">
                <ul class="pagination">
                    <li class="page-item">
                    <a class="page-link" href="#" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                        <span class="sr-only">Previous</span>
                    </a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                    <a class="page-link" href="#" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                        <span class="sr-only">Next</span>
                    </a>
                    </li>
                </ul>
            </nav>
        <?php wp_reset_query(); ?>
        <div class="clear"></div>
        <?php comments_template(); ?>

        <?php comments_popup_link('Sem Comentários', '1 Comentário', '% Comentários', 'comments-link', ''); ?>
    <?php else : ?>
        <div class="artigo">
            <h2>Nenhum produto cadastrado.</h2>
        </div>
    <?php endif; ?>
</div>
<script>
    $(document).ready(function() {
        if (window.location.search) {
            let paramsUrl = [],
                params = window.location.search.replace('?', '').split('&'),
                atributoValor = '';

            params.map(function(index, element) {
                paramsUrl.push(index.split('='));
            });

            paramsUrl.map(function(element, index) {
                if (element[0] == 'atributo') {
                    atributoValor = element;
                }
            });

            $('input[name="atributo"]').map(function(index, element) {
                if (element.value == atributoValor[1]) {
                    $(element).click();
                }
            });
        }
    });

    $('body').on('click', '#botao-filtrar', function() {
        let filtro = $('input[name="atributo"]:checked');

        if (window.location.search) {
            let paramsUrl = [],
                params = window.location.search.replace('?', '').split('&'),
                atributoValor = '',
                atributoDaUrl = window.location.search.replace('?', '').split('=')[0];

            params.map(function(index, element) {
                paramsUrl.push(index.split('='));
            });

            paramsUrl.map(function(element, index) {
                if (element[0] == 'categoria') {
                    atributoValor = element;
                }
            });

            if (atributoValor[0] == 'categoria') {
                window.location.href = window.location.origin +
                    window.location.pathname +
                    '?' + atributoValor[0] + '=' + atributoValor[1] +
                    '&atributo=' + filtro.val();
            } else {
                window.location.href = window.location.origin +
                    window.location.pathname + '?atributo=' + filtro.val();
            }
        } else {
            window.location.href = window.location.origin +
                window.location.pathname + '?atributo=' + filtro.val();
        }
    });
</script>

<?php get_footer(); ?>