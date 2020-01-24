<!DOCTYPE html>
<html>
	
	<?php echo $header ?>
	
	<body id="top">

		<?php echo $navbar ?>

        <!-- about
        ================================================== -->
        <section class="s-about">

            <div class="row section-header has-bottom-sep" data-aos="fade-up">
                <div class="col-full">
                    <h3 class="subhead subhead--dark">Olá Pessoal!</h3>
                    <h1 class="display-1 display-1--light">Conheça um pouco da Nossa História!</h1>
                </div>
            </div> <!-- end section-header -->

            <div class="row about-desc" data-aos="fade-up">
                <div class="col-full">
                    <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt. 
                    </p>
                </div>
            </div> <!-- end about-desc -->

            <ul class="home-social">
                <li>
                    <a href="#0"><i class="fa fa-facebook" aria-hidden="true"></i><span>Facebook</span></a>
                </li>
                <li>
                    <a href="#0"><i class="fa fa-twitter" aria-hidden="true"></i><span>Twiiter</span></a>
                </li>
                <li>
                    <a href="#0"><i class="fa fa-instagram" aria-hidden="true"></i><span>Instagram</span></a>
                </li>
                <li>
                    <a href="#0"><i class="fa fa-behance" aria-hidden="true"></i><span>Behance</span></a>
                </li>
                <li>
                    <a href="#0"><i class="fa fa-dribbble" aria-hidden="true"></i><span>Dribbble</span></a>
                </li>
            </ul> 
            <!-- end home-social -->

            <div class="row about-stats stats block-1-4 block-m-1-2 block-mob-full" data-aos="fade-up">
                    
                <div class="col-block stats__col ">
                    <div class="stats__count"><?php echo $total_usuarios[0]['num_usuarios'] ?></div>
                    <h5>Usuários Registrados</h5>
                </div>
                <div class="col-block stats__col">
                    <div class="stats__count">1505</div>
                    <h5>Usuários Ativos</h5>
                </div>
                <div class="col-block stats__col">
                    <div class="stats__count"><?php echo $total_animes[0]['num_animes'] ?></div>
                    <h5>Animes Disponíveis</h5>
                </div>
                <div class="col-block stats__col">
                    <div class="stats__count">102</div>
                    <h5>Clientes Satisfeitos</h5> 
                </div>

            </div> <!-- end about-stats -->

            <div class="about__line"></div>

        </section> <!-- end s-about -->

        <?php echo $footer ?>

	</body>
	
	<?php echo $scripts ?>

</html>
