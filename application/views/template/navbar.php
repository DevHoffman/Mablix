
<header class="s-header">

    <div class="header-logo">
        <a class="site-logo" href="<?php echo base_url() ?>">
            <img src="<?php echo base_url('assets/images/logo.png') ?>" alt="Logo" />
        </a>
    </div>

    <nav class="header-nav">

        <a href="#0" class="header-nav__close" title="Fechar"><span>Fechar</span></a>

		<div class="header-nav_perfil">
			<img src="<?php echo base_url('assets/images/logo.png') ?>" width="65%" alt="Logo" />
		</div>

        <div class="header-nav__content">

            <h3>Navegação</h3>
            
            <ul class="header-nav__list">
                <li><a href="<?php echo base_url() ?>" title="home">Home</a></li>
                <li><a href="<?php echo base_url('sobre') ?>" title="Sobre">Sobre</a></li>
                <li><a href="<?php echo base_url('animes') ?>" title="Todos os Animes">Lista de Animes</a></li>
                <li><a href="<?php echo base_url('contato') ?>" title="Contato">Contato</a></li>
                <li><a href="<?php echo base_url('login') ?>" title="Login">Login</a></li>
            </ul>

            <p>Perspiciatis hic praesentium nesciunt. Et neque a dolorum <a href='#0'>voluptatem</a> porro iusto sequi veritatis libero enim. Iusto id suscipit veritatis neque reprehenderit.</p>

            <ul class="header-nav__social">
                <li>
                    <a href="#"><i class="fa fa-facebook"></i></a>
                </li>
                <li>
                    <a href="#"><i class="fa fa-twitter"></i></a>
                </li>
                <li>
                    <a href="#"><i class="fa fa-instagram"></i></a>
                </li>
                <li>
                    <a href="#"><i class="fa fa-behance"></i></a>
                </li>
                <li>
                    <a href="#"><i class="fa fa-dribbble"></i></a>
                </li>
            </ul>

        </div> <!-- end header-nav__content -->

    </nav>  <!-- end header-nav -->

	<ul class="header-menu">
		<li><a href="#" class="btn-search"><i class="fa fa-search"></i></a></li>
		<li>
			<a href="#0" class="header-menu-toggle">
				<span class="header-menu-text">Menu</span>
				<span class="header-menu-icon"></span>
			</a>
		</li>
	</ul>

</header> 

<!-- search form
================================================== -->
<div class="bloco-search">

    <div class="header-nav__close" title="Fechar"><span>Fechar</span></div>

    <div class="row contact-content">

		<div class="form-field">
			<input type="text" name="search" minlength="2" required placeholder="Pesquise..." aria-required="true" class="full-width"  />
		</div>

    </div>

	<div id="hemily-conteudo">

	</div>
</div>
