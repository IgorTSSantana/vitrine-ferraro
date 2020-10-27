
                   <!----------- Footer ------------>
                    <footer class="footer-bs">
                    <div class="row">
                        <div class="col-md-4 footer-brand animated fadeInLeft">
                            <img class="foto-logo" style="width:250px;height:250px;"
                src="<?php echo get_template_directory_uri() . '/public/img/Logomarca.png' ?>">
                            <p>© 2020 TP79 FI Tapeça, TODOS os direitos reservados</p>
                        </div>
                        <div class="col-md-4 footer-nav animated fadeInUp">
                            <h4>Menu</h4>
                            <div class="col-md-6">
                                <ul class="pages">
                                    <li><a href="<?php echo get_site_url() . '/' ?>">Home</a></li>
                                    <li><a href="#">Produtos</a></li>
                                    <li><a href="<?php echo get_template_directory_uri() . '/sobre' ?>">Sobre a Empresa</a></li>
                                    <li><a href="<?php echo get_template_directory_uri() . '/contato' ?>">Contato</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-4 footer-social animated fadeInDown">
                            <h4>Rede Sociais</h4>
                            <ul>
                                <li><a href="https://www.facebook.com/profile.php?id=100007223254486" target="_blank">Facebook</a></li>
                                <li><a href="https://www.instagram.com/ferraro_optica/?hl=pt-br" target="_blank">Instagram</a></li>
                            </ul>
                        </div>
                    </div>
                </footer>
                <section class="rodape-desenvolvedores">
                    <p class="rodape-paragrafo">Desenvolvido por <a href="https://github.com/IgorTeixas" target="_blank">Igor Santana</a> e <a
                            href="https://github.com/Felipercb" target="_blank">Felipe Borges</a></p>
                </section>

</body>
</html>

<script>
    $('#todos-produtos').on('click', function () {
        window.location.href = window.location.origin + window.location.pathname + '/produtos';
    })
</script>