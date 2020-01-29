
<header class="s-header">

    <div class="header-logo">
        <a class="site-logo" href="<?php echo base_url('admin/dashboard') ?>">
            <img src="<?php echo base_url('assets/images/logo.png') ?>" alt="Logo Mablix" />
        </a>
    </div>

    <nav class="header-nav">

        <a href="#0" class="header-nav__close" title="Fechar"><span>Fechar</span></a>

		<a href="<?php echo base_url('admin/perfil') ?>" title="Ir para Perfil">
			<div class="header-nav_perfil" style="background-image: url('<?php echo base_url($usuarioFoto) ?>');">
				<h2>Meu Perfil</h2>
			</div>
		</a>
        <div class="header-nav__content">

            <ul class="header-nav__list">
                <li><a href="<?php echo base_url('admin/animes') ?>" title="Animes">Animes</a></li>
                <li><a href="<?php echo base_url('admin/episodios') ?>" title="Episódios">Episódios</a></li>
                <li><a href="<?php echo base_url('admin/usuarios') ?>" title="Usuários">Usuários</a></li>
				<li><a href="<?php echo base_url('admin/perfil') ?>" title="Perfil">Perfil</a></li>
                <li><a href="<?php echo base_url('admin/sair') ?>" title="Sair do Sistema">Logout</a></li>
            </ul>

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
		<li>
			<a href="#0" class="header-menu-toggle">
				<span class="header-menu-text"><?php echo $usuarioFistName ?></span>
				<span class="header-menu-image">
					<img width="50px" src="<?php echo base_url($usuarioFoto) ?>" />
					<b class="header-menu-fist-letter"><?php echo $usuarioFistLetra ?></b>
				</span>
			</a>
		</li>
	</ul>

</header> 

<!-- search form
================================================== -->
<div class="col-full bloco-search">

    <div class="header-nav__close" title="Fechar"><span>Fechar</span></div>

    <div class="row contact-content">

		<div class="form-field">
			<input type="text" name="search" minlength="2" required placeholder="Pesquise..." aria-required="true" class="full-width"  />
		</div>

    </div>

	<div class="row">
		<div id="hemily-conteudo">

		</div>
	</div>
</div>
