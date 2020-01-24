<!DOCTYPE html>
<html>

    <?php echo $header ?>

    <body id="top">

        <?php echo $navbar ?>


        <!-- contact
        ================================================== -->
        <section id="contact" class="s-contact">

            <div class="overlay"></div>
            <div class="contact__line"></div>

            <div class="row section-header aos-init aos-animate" data-aos="fade-up">
                <div class="col-full">
                    <h3 class="subhead"><?php echo $h3 ?></h3>
                    <h1 class="display-2 display-2--light"><?php echo $h1 ?></h1>
                </div>
            </div>

            <div class="row contact-content aos-init aos-animate" data-aos="fade-up">
                
                <div class="contact-primary">

                    <h3 class="h6">Formulário</h3>

                    <?php echo form_open('', $atributos_form); ?>

                        <fieldset>
        
                            <div class="form-field">
                                <?php echo form_input('contactName', set_value('contactName'), $atributos_name) ?>
                            </div>
                            <div class="form-field">
                                <?php echo form_input('contactEmail', set_value('contactEmail'), $atributos_email) ?>
                            </div>
                            <div class="form-field">
                                <?php echo form_input('contactSubject', set_value('contactSubject'), $atributos_assunto) ?>
                            </div>
                            <div class="form-field">
                                <?php echo form_textarea('contactMessage', set_value('contactMessage'), $atributos_mensagem ) ?>
                            </div>
                            <div class="form-field">
                                <?php echo form_submit('enviar', 'Encaminhar', array('class' => 'full-width btn--primary')) ?>
                                <div class="submit-loader">
                                    <div class="text-loader">Enviando...</div>
                                    <div class="s-loader">
                                        <div class="bounce1"></div>
                                        <div class="bounce2"></div>
                                        <div class="bounce3"></div>
                                    </div>
                                </div>
                            </div>
        
                        </fieldset>

                    <?php echo form_close(); ?>

                    <div class="message-warning">

                    </div> 
                    <div class="message-success">
                         
                    </div> 

                </div> <!-- end contact-primary -->

                <div class="contact-secondary">
                    <div class="contact-info">

                        <h3 class="h6 hide-on-fullwidth">Informações</h3>

                        <div class="cinfo">
                            <h5>Endereço</h5>
                            <p>
                                1600 Amphitheatre Parkway<br>
                                Mountain View, CA<br>
                                94043 US
                            </p>
                        </div>

                        <div class="cinfo">
                            <h5>Emails</h5>
                            <p>
                                contact@glintsite.com<br>
                                info@glintsite.com
                            </p>
                        </div>

                        <div class="cinfo">
                            <h5>Nos Ligue</h5>
                            <p>
                                Phone: (+63) 555 1212<br>
                                Mobile: (+63) 555 0100<br>
                                Fax: (+63) 555 0101
                            </p>
                        </div>

                        <ul class="contact-social">
                            <li>
                                <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-behance" aria-hidden="true"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-dribbble" aria-hidden="true"></i></a>
                            </li>
                        </ul> <!-- end contact-social -->

                    </div> <!-- end contact-info -->
                </div> <!-- end contact-secondary -->

            </div> <!-- end contact-content -->

        </section> <!-- end s-contact -->

        <?php echo $footer ?>


		<?php echo $scripts ?>

		<script type="text/javascript">

			/* Validação de Email - Home */
			$('#formulario').validate({

				/* submit via ajax */
				submitHandler: function(form) {

					var sLoader = $('#formulario .submit-loader');

					$.ajax({

						type: "POST",
						url: "/contato/envia",
						data: $(form).serialize(),
						beforeSend: function() {

							sLoader.slideDown("slow");

						},
						success: function(msg) {

							// Message was sent
							sLoader.slideUp("slow");
							$('.contact-content .message-success').html("Email enviado com sucesso!");
							$('.contact-content .message-success').fadeIn();
							$('#formulario').fadeOut();
							setTimeout(function() {
								$("#formulario #contactName").val("");
								$("#formulario #contactEmail").val("");
								$("#formulario #contactSubject").val("");
								$("#formulario #contactMessage").val("");
								$('.contact-content .message-success').fadeOut();
								$('#formulario').fadeIn();
							}, 5000);
						},
						error: function() {

							sLoader.slideUp("slow");
							$('.contact-content .message-warning').html("Algo deu errado, tente Novamente.");
							$('.contact-content .message-warning').slideDown("slow");
						}

					});
				}

			});

		</script>

    </body>

</html>
