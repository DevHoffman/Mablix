	<script src="<?php echo base_url('assets/js/jquery-3.2.1.min.js') ?>"></script>
<script src="<?php echo base_url('assets/js/plugins.js') ?>"></script>
<script language="javascript" src="<?php echo base_url('assets/js/main.js') ?>"></script>

<!-- script
================================================== -->
<script src="<?php echo base_url('assets/js/modernizr.js') ?>"></script>

<?php

if (isset($scripts)) {
    foreach ($scripts as $script) {
        echo "<script src='{$script}'></script>";
    }
}

?>

<!-- Bloco Pesquisa -->
<script type="text/javascript">

	//Busca por tecla pressionada
	$(document).ready(function(){
		$(".bloco-search input").keydown(function(){
			/* Bloco Search */

			if ( event.which != 17 ) {
				$.ajax({
					type: "POST",
					enctype: 'multipart/form-data',
					url: "/search",
					data: $(this).serialize(),
					beforeSend: function() {
					},
					success: function(msg) {
						if ( msg == 0 ){
							document.getElementById("hemily-conteudo").innerHTML = '<h2>Não foram encontrados registros...</h2>';
						}
						else {

							var out = '';
							for (var i in msg) {
								out += `<div class="masonry__brick col-3">`;
								out += ` <div class="item-folio">`;
								out += `  <a href="animes/anime/` + msg[i]['CodiAnime'] + `" class="thumb-link" title="Teste" data-size="1050x700">`;
								out += `   <div class="item-folio__thumb" style="background-image: url('/assets/animes/` + msg[i]['Imagem_Destacada'] + `')"></div>`;
								out += `   <div class="item-folio__text">`;
								out += `    <h3 class="item-folio__title">` + msg[i]['Anime'] + `</h3>`;
								out += `    <p class="item-folio__cat">` + msg[i]['Categoria'] + ` </p>`;
								out += `   </div>`;
								out += `   <div class="item-folio__project-link"><i class="icon-link"></i></div>`;
								out += `  </a>`;
								out += ` </div>`;
								out += `</div>`;
							}

							document.getElementById("hemily-conteudo").innerHTML = out;
						}
					},
					error: function(msg) {
						document.getElementById("hemily-conteudo").innerHTML = 'Algo deu errado, tente novamente.';
					}
				});
			}
		});
	});

	$('.btn-search').click(function (){
		$( '.bloco-search' ).fadeIn();
		$( ".bloco-search input" ).focus();
		$( '.bloco-search' ).css('top', '0');
	});

	$( '.bloco-search .header-nav__close' ).click(function (){
		$( '.bloco-search' ).css('top', '-100%');
		$( '.bloco-search' ).fadeOut();
	});

    $(window).scroll(function() {
        if( $(this).scrollTop() > 0 ) {
        	$( '.s-header' ).last().addClass('opaqueHeader');
        } else {
        	$( '.s-header' ).last().removeClass('opaqueHeader');
        }

        if( $(this).scrollTop() > 150 ){
        	$( '.header-menu-toggle' ).last().removeClass('opaque');
        	$( '.header-nav__close' ).css('background-color', 'transparent');
        }
    });
</script>

<!-- Formulários de Contato -->
<script type="text/javascript">

    /* Validação de Email - Home */
    $('#subscribe').validate({

        /* submit via ajax */
        submitHandler: function(form) {

            var sLoader = $('#subscribe .submit-loader');

            $.ajax({

                type: "POST",
				enctype: 'multipart/form-data',
                url: "/contato/subscribe",
                data: $(form).serialize(),
                beforeSend: function() {

                    sLoader.slideDown("slow");

                },
                success: function(msg) {

					if ( msg == 'Email cadastrado com sucesso' ) {
						// Message was sent
						sLoader.slideUp("slow");
						$('#subscribe').fadeOut();
						$('.subscribe-form .message-success').fadeIn();
						$('.subscribe-form .message-success').html(msg);
						$('.subscribe-form .message-warning').fadeOut();
						setTimeout(function() {
							$("#subscribe #email").val("");
							$('.subscribe-form .message-success').fadeOut();
							$('#subscribe').fadeIn();
						}, 5000);
					}
					else {

						// Message was sent
						sLoader.slideUp("slow");
						$('#subscribe').fadeOut();
						$('.subscribe-form .message-warning').fadeIn();
						$('.subscribe-form .message-warning').html(msg);
						$('.subscribe-form .message-success').fadeOut();
						setTimeout(function() {
							$("#subscribe #email").val("");
							$('.subscribe-form .message-warning').fadeOut();
							$('#subscribe').fadeIn();
						}, 5000);
					}
                },
                error: function(msg) {
                    sLoader.slideUp("slow");
					$('.subscribe-form .message-warning').fadeOut();
                    $('.subscribe-form .message-warning').html("Algo deu errado, tente novamente");
                    $('.subscribe-form .message-warning').slideDown("slow");
					setTimeout(function() {
						$('.subscribe-form .message-warning').fadeOut();
					}, 5000);
                }

            });
        }

    });

</script>
