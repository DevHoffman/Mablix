<!DOCTYPE html>
<html>

	<?php echo $header ?>

	<body id="top">

		<?php echo $navbar ?>

		<!-- Animes
		================================================== -->

        <section id="animes" class="s-home">

            <div class="overlay"></div>
            <div class="shadow-overlay"></div>

			<div class="intro-wrap">
				<div class="row section-header has-bottom-sep light-sep" data-aos="fade-up">
					<h2 class="display-2 display-2--light">Todos os Animes</h2>
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
			        url: "animes/get_animes",
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
