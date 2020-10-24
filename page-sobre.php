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
        <article class="col-lg-7 margem" >
            <img style="width:485px;height:522px;"
            src="<?php echo get_template_directory_uri() . '/public/img/frente-loja.jpg' ?>">
        </article>

        <article class="col-lg-5 margem">
        <h3>História</h3>
        A Óptica Ferraro é uma pequena óptica fundada em 2014 pelo casal Leonardo e Elisabete com o objetivo
        de ajudar as pessoas que necessitam de óculos de grau ou mesmo as que so querem um óculos de sol. Vendendo armações, lentes de grau e óculos de sol de ótima qualidade.
        Com seus produtos de otima qualidade ao longo do tempo conseguiram conquistar uma crientela ...
        <h3 class="margem-top">Missão</h3>
        Vender óculos em geral de ótima qualidade e com um preço bom para todos os níveis sociais.</br>
        <h3 class="margem-top">Visão</h3>
        Ser uma óptica em destaque nacional e ter seus produtos reconhecidos pela sua excelente qualidade.</br>
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