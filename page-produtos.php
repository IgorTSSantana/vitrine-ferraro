<?php

/**
 * template name: page
 */

get_header();

$pagina_atual = ($_GET['pag']) ? $_GET['pag'] : 1;
$filtro_categoria = $_GET['categoria'];
$filtro_atributo = $_GET['atributo'];
$qty_pag = 12;

// Consulta de todos os produtos
$consulta = [
    'post_type' => 'product',
    'posts_per_page' => 10000000,
    'product_cat' => $filtro_categoria,
    'orderby' => '_sku',
    'order' => 'asc',
];

if (!is_null($filtro_atributo) && $filtro_atributo != 'todos') {
    $consulta['taxonomy'] = 'pa_sexo';
    $consulta['term'] = $filtro_atributo;
}

// Consulta da paginação
$posts = new WP_Query($consulta);
$total_produtos = (int) count($posts->get_posts());
$resultado = ceil($total_produtos / $qty_pag);
wp_reset_query();

$consulta_pag = [
    'post_type' => 'product',
    'posts_per_page' => $qty_pag,
    'product_cat' => $filtro_categoria,
    'orderby' => '_sku',
    'order' => 'asc',
    'paged' => $pagina_atual
];

if (!is_null($filtro_atributo) && $filtro_atributo != 'todos') {
    $consulta_pag['taxonomy'] = 'pa_sexo';
    $consulta_pag['term'] = $filtro_atributo;
}
$total_produtos = (int) count($posts->get_posts());
$retorno_produtos = new WP_Query($consulta_pag);
?>

<div class="container container-top">
    <div class="row titulo-site">
        <h1>
            <span class="titulo-pagina"><?php the_title(); ?></span>
        </h1>
    </div>
    <section class="row contato-conteudo">
        <div class="col-md-2">
            <p class="texto-genero"><?php echo $total_produtos ?> produto(s).</p>
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
            <button class="btn btn-danger btn-block" type="button" id="botao-filtrar">
                Aplicar
            </button>
        </div>
        <div class="col-md-10">
            <?php if ($retorno_produtos->have_posts()) : ?>
                <?php while ($retorno_produtos->have_posts()) : $retorno_produtos->the_post(); ?>
                    <?php $preco = str_replace(".", ",", get_post_meta(get_the_ID(), '_regular_price', true)) ?>
                    <?php $produto_atual = new WC_product(get_the_ID()); ?>
                    <?php $img_ids = $produto_atual->get_gallery_image_ids(); ?>
                    <div id="cards" class="card card-produto item">
                        <div id="carrossel_<?= $produto_atual->id ?>" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <?php the_post_thumbnail('thumbnail', array('class' => 'imagem-produto')); ?>
                                </div>
                                <?php foreach ($img_ids as $imd_id) : ?>
                                    <div class="carousel-item">
                                        <?php echo wp_get_attachment_image($imd_id, 'thumbnail', "", ["class" => "imagem-produto"]); ?>
                                    </div>
                                <?php endforeach ?>
                            </div>
                            <a class="carousel-control-prev" href="#carrossel_<?= $produto_atual->id ?>" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carrossel_<?= $produto_atual->id ?>" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                        <?php if ($produto_atual->get_attribute('pa_instagram') == "Sim") : ?>
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
                                <?php $term = get_term_by('id', $produto_atual->category_ids[0], 'product_cat'); ?>
                                <?= $term->name ?>
                            </span> <br>
                            <span class="preco">
                                R$<?= $preco ?>
                            </span>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else : ?>
                <div class="artigo">
                    <h2>Não foi encontrado resultados para essa pesquisa.</h2>
                </div>
            <?php endif; ?>
        </div>
    </section>
    <div class="pagination d-flex justify-content-center" style="margin-top: 100px"></div>
    <?php wp_reset_query(); ?>
    <div class="clear"></div>
    <?php comments_template(); ?>
</div>
<script>
    $(document).ready(function() {
        let pagina = 1,
            url = window.location.origin + window.location.pathname,
            postQtd = <?php echo $resultado ?>;

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

                if (element[0] == 'pag') {
                    pagina = element[1];
                } else {
                    console.log(index)
                    if (index == 0) {
                        url += `?${element[0]}=${element[1]}`;
                    } else {
                        url += `&${element[0]}=${element[1]}`;
                    }
                }
            });

            $('input[name="atributo"]').map(function(index, element) {

                if (element.value == atributoValor[1]) {
                    $(element).click();
                }
            });
        }

        if (postQtd > 1) {
            let regex = new RegExp("/?pag=[0-9]");
            let pagination = `
            <nav aria-label="Page navigation example">
            <ul class="pagination">`;

            if (pagina > 1) {
                let paginaAnterior = pagina - 1;
                if (!regex.test(window.location.search && window.location.search)) {
                     pagination += `<li class="page-item"><a class="page-link" href="${url}&pag=${paginaAnterior}">&laquo;</a></li>`;
                } else {
                    pagination += `<li class="page-item"><a class="page-link" href="${url}?pag=${paginaAnterior}">&laquo;</a></li>`;
                }
            }

            for (let i = 1; i <= postQtd; i++) {
                if (!regex.test(window.location.search) && window.location.search) {
                    pagination += `<li class="page-item"><a class="page-link" href="${url}&pag=${i}">${i}</a></li>`;
                } else {
                    pagination += `<li class="page-item"><a class="page-link" href="${url}?pag=${i}">${i}</a></li>`;
                }
            }

            if (pagina < postQtd) {
                let paginaPosterior = parseInt(pagina) + 1;

                if (!regex.test(window.location.search) && window.location.search) {
                    pagination += `<li class="page-item"><a class="page-link" href="${url}&pag=${paginaPosterior}">&raquo;</a></li>`;
                } else {
                    pagination += `<li class="page-item"><a class="page-link" href="${url}?pag=${paginaPosterior}">&raquo;</a></li>`;
                }
            }

            pagination += `</ul></nav>`;

            $('div.pagination').append(pagination)
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