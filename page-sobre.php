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
    <section class="row contato-conteudo">
        <article class="col-lg-7">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3660.063408109535!2d-46.51038488507241!3d-23.458177184734154!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94ce8aafb8b62b4f%3A0x31df8559099cc17b!2sAv.%20Santa%20B%C3%A1rbara%2C%20202%20-%20Vila%20Fatima%2C%20Guarulhos%20-%20SP%2C%2007191-310!5e0!3m2!1spt-BR!2sbr!4v1602884638405!5m2!1spt-BR!2sbr"
                width="500" height="500" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false"
                tabindex="0"></iframe>
        </article>

        <article class="col-lg-5 contato-contato">
            <h3 class="tipos-contatos"><i class="fas fa-envelope"></i>&nbspE-mail: loremipsum@hotmail.com</h3>
            <h3 class="tipos-contatos"><i class="fas fa-phone-alt"></i>&nbspTelefone: (11)92498-2354</h3>
            <h3 class="tipos-contatos"><i class="fab fa-facebook"></i>&nbspFacebook</h3>
            <h3 class="tipos-contatos"><i class="fab fa-instagram"></i>&nbspInstagram</h3>
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