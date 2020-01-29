<!DOCTYPE html>
<html>

	<?php echo $header ?>

	<body id="top">

		<?php echo $navbar ?>

        <!-- Animes
        ================================================== -->
        <section id="home" class="s-home target-section" data-parallax="scroll" data-image-src="<?php echo base_url("assets/animes/{$anime}/banner/" . $Imagem_Destacada) ?>" data-natural-width=3000 data-natural-height=2000 data-position-y=center>

            <div class="overlay"></div>
            <div class="shadow-overlay"></div>

            <div class="home-content">

                <div class="row home-content__main">

                    <h3><?php echo $h3 ?></h3>

                    <h1><?php echo $h1 ?></h1>

                </div>

                <div class="home-content__scroll">
                    <a href="#lista_animes" class="scroll-link smoothscroll">
                        <span>Ver os Episódios</span>
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

        <section id="lista_animes" class="s-home">

			<div class="intro-wrap">
				<div class="row section-header has-bottom-sep light-sep" data-aos="fade-up">
					<h2 class="display-2">Episódios</h2>
				</div> <!-- end section-header -->

			</div> <!-- end intro-wrap -->

            <div class="row" id="load_data"></div>
            <div id="load_data_message"></div>

        </section>

        <?php echo $footer ?>

	</body>
	
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
			        url: "/animes/get_episodios",
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

</html>
