<!DOCTYPE html>
<!--[if lt IE 9 ]><html class="no-js oldie" lang="en"> <![endif]-->
<!--[if IE 9 ]><html class="no-js oldie ie9" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html class="no-js" lang="en">
<!--<![endif]-->

    <?php echo $header ?>

    <body id="top">

        <!-- header
        ================================================== -->
        <?php echo $navbar ?>

        <!-- home
        ================================================== -->
        <section id="home" class="s-home target-section" data-parallax="scroll" data-image-src="<?php echo base_url('assets/images/hero-bg.jpg') ?>" data-natural-width=3000 data-natural-height=2000 data-position-y=center>

            <div class="overlay"></div>
            <div class="shadow-overlay"></div>

            <div class="home-content">

                <div class="row home-content__main">

                    <h3>Bem Vindo ao Mablix</h3>

                    <h1>
                        Nós somos um grupo criativo <br>
                        de pessoas assim como você, <br>
                        com algo em comum: <br>
                        ANIMES!
                    </h1>

                    <div class="home-content__buttons">
                        <a class="btn-search btn btn--stroke">
                            Pesquisar
                        </a>
                        <a href="<?php echo base_url('sobre') ?>" class="btn btn--stroke">
                            Nossa História
                        </a>
                    </div>

                </div>

                <div class="home-content__scroll">
                    <a href="#lancamentos" class="scroll-link smoothscroll">
                        <span>Conferir Lançamentos</span>
                    </a>
                </div>

                <div class="home-content__line"></div>

            </div> <!-- end home-content -->


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

        </section> <!-- end s-home -->

        <!-- works
        ================================================== -->
        <section id='lancamentos' class="s-works pad-bottom">

            <div class="intro-wrap">
                    
                <div class="row section-header has-bottom-sep light-sep" data-aos="fade-up">
                    <div class="col-full">
                        <h3 class="subhead">Últimos Lançamentos</h3>
                        <h2 class="display-2 display-2--light">Confira todos os lançamentos!</h2>
                    </div>
                </div> <!-- end section-header -->

            </div> <!-- end intro-wrap -->

            <div class="row works-content">
                <div class="col-full masonry-wrap">
                    <div class="masonry">
        				<?php foreach ( $rows_lancamentos as $value ) { ?>

								<div class="masonry__brick" data-aos="fade-up">
									<div class="item-folio">
										<a href="<?php echo base_url('animes/anime/' . $value['CodiAnime']) ?>" class="thumb-link" title="<?php echo $value['Anime'] ?>" data-size="1050x700">
											<div class="item-folio__thumb" style="background-image: url('<?php echo base_url("assets/animes/{$value['Anime']}/banner/" . $value['Imagem_Destacada']) ?>')"></div>
											<div class="item-folio__text">
												<h3 class="item-folio__title">
													<?php echo $value['Anime'] ?>
												</h3>
												<p class="item-folio__cat">
													<?php echo $value['Categoria'] ?>
												</p>
											</div>
											<div class="item-folio__project-link">
												<i class="icon-link"></i>
											</div>
										</a>
									</div>
								</div> <!-- end masonry__brick -->

						<?php } ?>
                    </div> <!-- end masonry -->
                </div> <!-- end col-full -->
            </div> <!-- end works-content -->

        </section> <!-- end s-works -->

        <!-- Carrousel
        ================================================== -->
        <section id='clients' class="s-works">

            <div class="intro-wrap">

                <div class="row section-header has-bottom-sep light-sep" data-aos="fade-up">
                    <div class="col-full">
                        <a href="<?php echo base_url() ?>"><h3 class="subhead">Destaques</h3></a>
                        <a href="<?php echo base_url() ?>"><h2 class="display-2 display-2--light">Separamos algo pra você, espero que goste!</h2></a>
                    </div>
                </div> <!-- end section-header -->

            </div> <!-- end intro-wrap -->

            <div class="center slider" data-aos="fade-up">
                <?php foreach ($rows_destaques as $value) { ?>

					<div class="masonry__brick">
						<div class="item-folio">

							<a href="<?php echo base_url('animes/anime/' . $value['CodiAnime']) ?>" class="thumb-link" title="<?php echo $value['Anime'] ?>" data-size="1050x700">
								<div class="item-folio__thumb" style="background-image: url('<?php echo base_url("assets/animes/{$value['Anime']}/banner/" . $value['Imagem_Destacada']) ?>')"></div>
								<div class="item-folio__text">
									<h3 class="item-folio__title">
										<?php echo $value['Anime'] ?>
									</h3>
									<p class="item-folio__cat">
										<?php echo $value['Categoria'] ?>
									</p>
								</div>
								<div class="item-folio__project-link">
									<i class="icon-link"></i>
								</div>
							</a>

						</div>
					</div> <!-- end masonry__brick -->

                <?php } ?>
            </div>

        </section> <!-- end s-works -->

        <section id="lista_animes">

			<div class="intro-wrap">
				<div class="row section-header has-bottom-sep light-sep" data-aos="fade-up">
					<div class="col-full">
						<a href="<?php echo base_url('animes') ?>"><h3 class="subhead">Lista de Animes</h3></a>
						<a href="<?php echo base_url('animes') ?>"><h2 class="display-2">Confira nossos animes!</h2></a>
					</div>
				</div> <!-- end section-header -->

			</div> <!-- end intro-wrap -->

            <div class="row col-full no-padding" id="load_data"></div>
            <div id="load_data_message"></div>

        </section>


        <!-- footer
        ================================================== -->
        <?php echo $footer ?>
        <!-- end footer -->

        <!-- preloader
        ================================================== -->
        <div id="preloader">
            <div id="loader">
                <div class="line-scale-pulse-out">
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                </div>
            </div>
        </div>

        <!-- Java Script
        ================================================== -->
        <?php echo $scripts ?>

    <script>
        $(document).ready(function(){

            var limit = 7;
            var start = 0;
            var action = 'inactive';

            function lazzy_loader(limit){
                var output = '';
                for(var count=0; count<limit; count++) {
                    output += '<div class="masonry__brick col-3" data-aos="fade-up">';
                    output += '<h3><span class="content-placeholder" style="width:100%; height: 30px;">&nbsp;</span></h3>';
                    output += '<p><span class="content-placeholder" style="width:100%; height: 100px;">&nbsp;</span></p>';
                    output += '</div>';
                }
                $('#load_data_message').html(output);
            }

            lazzy_loader(limit);

            function load_data(limit, start) {
                $.ajax({
                    url:"home/get_animes",
                    method:"POST",
                    data:{limit:limit, start:start},
                    cache: false,
                    success:function(data) {
                        if(data == '') {
                            $('#load_data_message').html(data);
                            action = 'active';
                        }
                        else {
                            $('#load_data').append(data);
                            $('#load_data_message').html("");
                            action = 'inactive';
                        }
                    }
                })
            }

            if(action == 'inactive') {
                action = 'active';
                load_data(limit, start);
            }

            $(window).scroll(function(){
                if($(window).scrollTop() + $(window).height() > $("#load_data").height() && action == 'inactive') {
                    lazzy_loader(limit);
                    action = 'active';
                    start = start + limit;
                    setTimeout(function(){
                        load_data(limit, start);
                    }, 1000);
                }
            });

        });
    </script>

	<script src="<?php echo base_url('assets/js/jquery.2.2.3.min.js') ?>"></script>
	<script src="<?php echo base_url('assets/js/slick/slick.min.js') ?>" type="text/javascript" charset="utf-8"></script>
	<script type="text/javascript">
		$(document).on('ready', function() {
			$(".center").slick({
				// dots: true,
				infinite: true,
				// centerMode: true,
				slidesToShow: 5,
                prevArrow: '<button class="slick-prev" aria-label="Previous" type="button"><i class="fa fa-chevron-left"></i></button>',
                nextArrow: '<button class="slick-next" aria-label="Next" type="button"><i class="fa fa-chevron-right"></i></button>',
				slidesToScroll: 1
			});
		});
	</script>

    </body>

</html>
