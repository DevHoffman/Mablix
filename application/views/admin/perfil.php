<!DOCTYPE html>
<html>

	<?php echo $header ?>

	<body id="top">

		<?php echo $navbar ?>

		<!-- Usuários
		================================================== -->
		<section id="perfil" class="s-contact s-usuarios">

			<div class="overlay"></div>
			<div class="contact__line"></div>

			<div class="row section-header aos-init aos-animate" data-aos="fade-up">
				<div class="col-full">
					<h1 class="display-2 display-2--light"><?php echo $h1 ?></h1>
					<hr />
				</div>
			</div>

			<div class="row aos-init aos-animate" data-aos="fade-up">
				<form id="formperfil" action="<?php echo base_url('admin/perfil/atualiza_perfil') ?>" novalidate="novalidate" method="POST" enctype="multipart/form-data">
					<div class="col-8">
						<fieldset>
							<div class="form-field">
								<input type="text" name="name" value="<?php echo $usuarioNome ?>" placeholder="Nome" minlength="3" class="full-width" autofocus area-required="true" />
							</div>
							<div class="form-field">
								<input type="email" name="email" value="<?php echo $usuarioEmail ?>" placeholder="Email" minlength="3" class="full-width" area-required="true" />
							</div>
							<div class="form-field">
								<input type="text" name="login" value="<?php echo $usuarioLogin ?>" placeholder="Login" minlength="3" class="full-width" area-required="true" />
							</div>
							<div class="form-field">
								<input type="password" name="senha" placeholder="Alterar Senha" minlength="8" class="full-width" area-required="true" />
							</div>
							<div class="form-field">
								<input type="password" name="senha2" placeholder="Confirmar alteração de Senha" minlength="8" class="full-width" area-required="true" />
							</div>
							<div class="form-field">
								<?php echo form_submit('enviar', 'Atualizar', array('class' => 'full-width btn--primary') ) ?>
								<div class="submit-loader">
                                    <div class="text-loader">Atualizando
	                                    <div class="s-loader">
	                                        <div class="bounce1"></div>
	                                        <div class="bounce2"></div>
	                                        <div class="bounce3"></div>
	                                    </div>
                                    </div>
								</div>
							</div>
						</fieldset>
					</div>
					<div class="col-4">
						<label class="header-nav_perfil" id="FotoTMP" for="Foto" style="background-image: url('<?php echo base_url($usuarioFoto) ?>');">
							<h2>Editar</h2>
							<input type="file" id="Foto" name="arquivo" />
						</label>
					</div>
				</form>
				<div class="col-8">
					<div class="message-warning">

					</div>
					<div class="message-success">

					</div>
				</div>
			</div>

		</section>

		<?php echo $footer ?>
	</body>

	<?php echo $scripts ?>

	<script>

		/* Validação de Cadastro */
		$('#formperfil').validate({

			/* submit via ajax */
			submitHandler: function(form) {

				var sLoader = $('.submit-loader');
		        var fd = new FormData(form);
		        var files = $('#Foto')[0].files[0];
		        fd.append('arquivo',files);

				$.ajax({

					type: "POST",
					url: "perfil/atualiza_perfil",
					data: fd,
					contentType: false,
					processData: false,
					// data: $(form).serialize(),
					beforeSend: function() {

						sLoader.slideDown("slow");


					},
					success: function(msg) {
						if ( msg == 1 ) {
							// Message was sent
							sLoader.slideUp("slow");
							$('.message-warning').fadeOut();
							$('.message-success').html("Usuario Alterado com Sucesso");
							$('.message-success').fadeIn();
							setTimeout(function() {
								$('.message-success').fadeOut();
							}, 5000);
						}
						else{
							// Message was sent
							sLoader.slideUp("slow");
							$('.message-success').fadeOut();
							$('.message-warning').html(msg);
							$('.message-warning').fadeIn();
							setTimeout(function() {
								$('.message-warning').fadeOut();
							}, 5000);
						}
					},
					error: function(msg) {

						sLoader.slideUp("slow");
						$('.message-warning').fadeOut();
						$('.message-warning').html("Algo deu errado, tente Novamente.");
						$('.message-warning').slideDown("slow");
						setTimeout(function() {
							$('.message-warning').fadeOut();
						}, 5000);
					}
				});
			}
		});


		document.getElementById('Foto').onchange = function (evt) {
		    var tgt = evt.target || window.event.srcElement,
		        files = tgt.files;

		    // FileReader support
		    if (FileReader && files && files.length) {
		        var fr = new FileReader();
		        fr.onload = function () {
		            document.getElementById('FotoTMP').style.backgroundImage = "url(" + fr.result + ")";
		        }
		        fr.readAsDataURL(files[0]);
		    }

		    // Not supported
		    else {
		        // fallback -- perhaps submit the input to an iframe and temporarily store
		        // them on the server until the user's session ends.
		    }
		}

	</script>

</html>
