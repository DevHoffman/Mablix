<!DOCTYPE html>
<html>

	<?php echo $header ?>

	<body id="top">

		<?php echo $navbar ?>

		<!-- Usuarios
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
								<input type="hidden" name="codiusuario" value="<?php echo $dados[0]['CodiUsuario'] ?>" />
								<input type="text" name="name" value="<?php echo $dados[0]['Usuario'] ?>" placeholder="Nome" minlength="3" class="full-width" autofocus area-required="true" />
							</div>
							<div class="form-field">
								<input type="email" name="email" value="<?php echo $dados[0]['Email'] ?>" placeholder="Email" minlength="3" class="full-width" area-required="true" />
							</div>
							<div class="form-field">
								<input type="text" name="login" value="<?php echo $dados[0]['Login'] ?>" placeholder="Login" minlength="3" class="full-width" area-required="true" />
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
						<label class="header-nav_perfil" id="FotoTMP" for="Foto" style="background-image: url('<?php echo base_url( "assets/images/avatars/" . $dados[0]['Foto']) ?>');">
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

		<section id="usuarios" class="s-contact s-usuarios">

			<div class="row">
				<table class="table table-dark table-hover table-striped datatable-buttons" data-url="<?php echo $datatables ?>" data-update="<?php echo $url_update ?>" data-insert="<?php echo $url_insert ?>" data-detalhes="<?php echo $url_detalhes ?>" data-delete="<?php echo $url_delete ?>">
				  	<thead>
				    	<tr>
					      	<th scope="col">Nome</th>
					      	<th scope="col">Login</th>
					      	<th scope="col">Email</th>
					      	<th scope="col">Nível de Acesso</th>
				    		<th></th>
				    	</tr>
				  	</thead>
				</table>
			</div>

		</section>

		<?php echo $footer ?>

	</body>

	<?php echo $scripts ?>

	<script  type="text/javascript">
		// Datatables
		var url_delete = $('.table').data('delete');
		var url_update = $('.table').data('update');
		var url_insert = $('.table').data('insert');
		var url_detalhes = $('.table').data('detalhes');

		$(document).ready(function() {
			var handleDataTableButtons = function() {
				if ($(".table").length) {
					var table = $(".table").DataTable({
						processing: true,
						serverSide: true,
						lengthChange: false,
						responsive: true,
        				dom: 'Bfrtip',
						pageLength: 10,
						ajax: {
							url: $('.table').data('url'),
							type: 'POST',
							dataType: 'json'
						},
						columns: [
							{ data: 'Usuario', name: 'Usuario' },
							{ data: 'Login', name: 'Login' },
							{ data: 'Email', name: 'Email' },
							{ data: 'NivelAcesso', name: 'NivelAcesso' },
							{ data: 'CodiUsuario', name: 'CodiUsuario' },
						],
						order: [[ 0, 'asc' ]],
						rowCallback: function(row, data) {
							$(row).css('cursor', 'pointer');
							var btnDelete = $(`<span href="${url_delete}${data.CodiUsuario}" class="text-danger"><i class="fa fa-trash"></i></span>`);

							$('td:eq(0)', row).each(function() {
								$(this).on('click', function() {
									window.location.href = url_detalhes + data.CodiUsuario;
								});
							});

							$('td:eq(1)', row).each(function() {
								$(this).on('click', function() {
									window.location.href = url_detalhes + data.CodiUsuario;
								});
							});

							$('td:eq(2)', row).each(function() {
								$(this).on('click', function() {
									window.location.href = url_detalhes + data.CodiUsuario;
								});
							});

							$('td:eq(3)', row).each(function() {
								$(this).on('click', function() {
									window.location.href = url_detalhes + data.CodiUsuario;
								});
							});

							$('td:eq(-1)', row).each(function() {
								$(this, row).html(btnDelete);
								$(this, row).css('text-align', 'center');
								$(this).on('click', function() {
									$.confirm({
									    title: `Deseja excluir ${data.Usuario} ?`,
									    autoClose: 'Cancelar|8000',
									    buttons: {
									        deleteUser: {
									            text: 'Excluir',
									            action: function () {
													$.ajax({
														type: 'post',
														url: btnDelete.attr('href'),
														dataType: 'json',
														error: function() {
															$.alert(`Erro ao excluir a usuario ${data.Usuario}!`);
														},
														success: function(msg) {
															if ( msg == 1 ){
																$.alert(`Usuário ${data.Usuario} excluído com sucesso!`);
																table.ajax.reload();
															}
															else {
																$.alert(msg);
															}
														}
													});
									            }
									        },
									        Cancelar: function () {
									        	return true;
									        }
									    }
									});
								});
							});

						},
						drawCallback: function() {

							$('[data-toggle="tooltip"]').tooltip();
						},

						"language": {
							"sProcessing":    "Procesando...",
							"sLengthMenu":    "Mostrar _MENU_ registros",
							"sZeroRecords":   "Nenhum registro encontrado",
							"sEmptyTable":    "Nenhum registro encontrado",
							"sInfo":          "Mostrando registros de _START_ à _END_ de um total de _TOTAL_ registros",
							"sInfoEmpty":     "Mostrando registros de 0 à 0 de um total de 0 registros",
							"sInfoFiltered":  "(filtrado de um total de _MAX_ registros)",
							"sInfoPostFix":   "",
							"sSearch":        "Buscar:",
							"sUrl":           "",
							"sInfoThousands":  ",",
							"sLoadingRecords": "Cargando...",
							"oPaginate": {
								"sFirst":    "Primero",
								"sLast":    "Último",
								"sNext":    "Próximo",
								"sPrevious": "Anterior"
							},
							"oAria": {
								"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
								"sSortDescending": ": Activar para ordenar la columna de manera descendente"
							}
						},

					    buttons: {
					        buttons: [
							    {
							        extend: 'collection',
							        text: 'Exportar',
							        buttons: [
							            { extend: 'copy', text: 'Copiar Linhas' },
							            { extend: 'excel', text: 'Savar em Excel' },
							            { extend: 'csv', text: 'Savar em CSV' },
							            { extend: 'pdf', text: 'Savar em PDF' },
							            { extend: 'print', text: 'Imprimir' },
							        ]
							    },
							    {
					                text: 'Cadastrar',
						            attr: {
						                id: 'CadastroBtn'             
						            },
					                action: function ( e, dt, button, config ) {
								        table.ajax.reload();
								    },
							    }
					        ]
					    },
					});

					$('.dt-buttons #CadastroBtn').click(function() {
						$.confirm({
						    title: 'Cadastro de Usuário',
						    content: 
						    '<form id="formcadastro" novalidate="novalidate" class="formName">' +
							    '<div class="form-group">' +
							    	'<input type="text" name="name" placeholder="Nome" autofocus class="full-width name" required area-required="true" minlength="3" />' +
							    '</div>' +
							    '<div class="form-group">' +
							    	'<input type="email" name="email" placeholder="Email" class="full-width email" required area-required="true" minlength="8" />' +
							    '</div>' +
							    '<div class="form-group">' +
							    	'<input type="text" name="login" placeholder="Login" class="full-width login" required area-required="true" minlength="3" />' +
							    '</div>' +
							    '<div class="form-group">' +
							    	'<input type="password" name="senha" placeholder="Senha" class="full-width senha" required area-required="true" minlength="8" />' +
							    '</div>' +
							    '<div class="form-group">' +
							    	'<input type="password" name="senha2" placeholder="Confirmar Senha" class="full-width senha2" required area-required="true" minlength="8" />' +
							    '</div>' +
						    '</form>',
						    buttons: {
						        formSubmit: {
						            text: 'Cadastrar',
						            btnClass: 'btn--primary',
						            action: function () {
						                var name = this.$content.find('.name').val();
						                if( name.length <= 3 ){
						                    $.alert('Nome inválido, deve conter no mínimo 3 caracteres.');
						                    return false;
						                }
						                var email = this.$content.find('.email').val();
						                if( email.length <= 7 ){
						                    $.alert('Email inválido, deve conter no mínimo 8 caracteres');
						                    return false;
						                }
						                var login = this.$content.find('.login').val();
						                if( login.length <= 3 ){
						                    $.alert('Login inválido, deve conter no mínimo 3 caracteres.');
						                    return false;
						                }
						                var senha = this.$content.find('.senha').val();
						                if( senha.length <= 7 ){
						                    $.alert('Senha Inválida, deve conter no mínimo 8 caracteres.');
						                    return false;
						                }
						                var senha2 = this.$content.find('.senha2').val();
						                if( senha2.length <= 7 ){
						                    $.alert('Confirme sua senha, deve conter no mínimo 8 caracteres.');
						                    return false;
						                }
						                if ( senha != senha2 ){
						                	$.alert('As senhas devem ser iguais');
						                	return false;
						                }

										$.ajax({

											type: "POST",
											url: `${url_insert}`,
											data: $('#formcadastro').serialize(),
											beforeSend: function() {

											},
											success: function(msg) {
												if ( msg == 1 ) {
				                					$.alert('Usuário <b>' + name + '</b> cadastrado com sucesso!');
													table.ajax.reload();
												}
												else{
				                					$.alert(msg);
												}
											},
											error: function(msg) {
				                				$.alert('Algo deu errado, tente novamente.');
											}
										});
						            }
						        },
						        cancelar: function () {
						            return true;
						        },
						    },
						    onContentReady: function () {
						        // bind to events
						        var jc = this;
						        this.$content.find('form').on('submit', function (e) {
						            // if the user submits the form by pressing enter in the field.
						            e.preventDefault();
						            jc.$$formSubmit.trigger('click'); // reference the button and click it
						        });
						    }
						});
					});
				}
			};

			TableManageButtons = function() {
				"use strict";
				return {
					init: function() {
						handleDataTableButtons();
					}
				};
			}();

			TableManageButtons.init();

		});
		// Datatables
	</script>

	<script type="text/javascript">


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
					url: url_update,
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

		jconfirm.defaults = {
		    // title: 'Defina um Título',
		    // titleClass: '',
		    // type: 'default',
		    // typeAnimated: true,
		    // draggable: true,
		    // dragWindowGap: 15,
		    // dragWindowBorder: true,
		    // animateFromElement: true,
		    // smoothContent: true,
		    // content: 'Defina um texto',
		    // buttons: {},
		    // defaultButtons: {
		    //     ok: {
		    //         action: function () {
		    //         }
		    //     },
		    //     close: {
		    //         action: function () {
		    //         }
		    //     },
		    // },
		    // contentLoaded: function(data, status, xhr){
		    // },
		    // icon: '',
		    // lazyOpen: false,
		    // bgOpacity: null,
		    // theme: 'light',
		    // animation: 'scale',
		    // closeAnimation: 'scale',
		    // animationSpeed: 400,
		    // animationBounce: 1,
		    // rtl: false,
		    // container: 'body',
		    // containerFluid: false,
		    // backgroundDismiss: false,
		    // backgroundDismissAnimation: 'shake',
		    // autoClose: false,
		    // closeIcon: null,
		    // closeIconClass: false,
		    // watchInterval: 100,
		    // scrollToPreviousElement: true,
		    // scrollToPreviousElementAnimate: true,
		    // useBootstrap: true,
		    // offsetTop: 40,
		    // offsetBottom: 40,
		    // bootstrapClasses: {
		    //     container: 'container',
		    //     containerFluid: 'container-fluid',
		    //     row: 'row',
		    // },
		    columnClass: 'col-12',
		    boxWidth: '50%',
			theme: 'supervan', // 'material', 'bootstrap', 'light', 'dark', 'modern'
		    // onContentReady: function () {},
		    // onOpenBefore: function () {},
		    // onOpen: function () {},
		    // onClose: function () {},
		    // onDestroy: function () {},
		    // onAction: function () {}
		};
	</script>

</html>
