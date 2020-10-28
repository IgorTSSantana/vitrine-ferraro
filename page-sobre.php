<?php

/**
 * template name: page
 */

get_header();
?>

<div class="container container-top">

    <?php if (have_posts()) : ?>
    <div class="row titulo-site">
        <h1>
            <span class="titulo-pagina"><?php the_title(); ?></span>
        </h1>
    </div>
    <section class="row">
        <article class="col-lg-12" >
            <div id="imagem-loja"></div>
        </article>

        <article class="col-lg-6 margem">
        <h3 class="margem-top">História</h3>
        <p>A Óptica Ferraro é uma pequena óptica fundada em 2014 pelo casal Leonardo e Elisabete com o objetivo
        de ajudar as pessoas que necessitam de óculos de grau ou mesmo as que precisam de um óculos de sol.
        Com seus produtos de ótima qualidade, ao longo do tempo conseguiram conquistar uma boa clientela na região
        vendendo armações, lentes de grau e óculos de sol de ótima qualidade.
        </p>
        <h3 class="margem-top">Missão</h3>
        <ul class="lista">
            <li>Vender óculos em geral de ótima qualidade e com um preço bom para todos os níveis sociais.</li></br>
        </ul>
    </article>
    <article class="col-lg-6 margem">
        <h3 class="margem-top">Visão</h3>
        <p>Ser uma óptica em destaque nacional e ter seus produtos reconhecidos pela sua excelente qualidade.</br>
        </p>
        <h3 class="margem-top">Valores</h3>
        <ul class="lista">
            <li>Honestidade</li>
            <li>Qualidade</li>
            <li>Comprometimento</li>
            <li>Respeito</li>
            <li>Lealdade</li>
            <li>Higiene</li>
        </ul>

        </article>

    </section> <div class="clear"></div>
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

<?php get_footer(); ?>