<!DOCTYPE html>
<html>

	<?php echo $header ?>

	<body id="top">

		<?php echo $navbar ?>

		<!-- Usuarios
		================================================== -->
		<section id="usuarios" class="s-contact s-usuarios">

			<div class="overlay"></div>
			<div class="contact__line"></div>

			<div class="row section-header aos-init aos-animate" data-aos="fade-up">
				<h1 class="display-2 display-2--light"><?php echo $h1 ?></h1>
				<hr />
			</div>

			<div class="row">
				<table class="table table-dark table-hover table-striped datatable-buttons" data-url="<?php echo $datatables ?>" data-update="<?php echo $url_update ?>" data-insert="<?php echo $url_insert ?>" data-delete="<?php echo $url_delete ?>">
				  	<thead>
				    	<tr>
					      	<th scope="col">Nome</th>
					      	<th scope="col">Login</th>
					      	<th scope="col">Email</th>
					      	<th scope="col">Nível de Acesso</th>
				    		<th></th>
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
							{ data: 'CodiUsuario', name: 'CodiUsuario' },
						],
						order: [[ 0, 'asc' ]],
						rowCallback: function(row, data) {
							$(row).css('cursor', 'pointer');
							var btnDelete = $(`<span href="${url_delete}${data.CodiUsuario}" class="text-danger"><i class="fa fa-trash"></i></span>`);
							$('td:eq(5)', row).html(btnDelete);
							$('td:eq(5)', row).css('text-align', 'center');

							$(btnDelete).click(function() {
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

							var btnUpdate = $(`<span href="${url_update}${data.CodiUsuario}" class="text-danger"><i class="fa fa-edit"></i></span>`);
							$('td:eq(4)', row).html(btnUpdate);
							$('td:eq(4)', row).css('text-align', 'center');
							$(btnUpdate).click(function() {
								$.confirm({
								    title: 'Alterar Usuário',
								    content: 
								    '<form id="formcadastro" novalidate="novalidate" class="formName">' +
									    '<div class="form-group">' +
									    	'<input type="hidden" name="CodiUsuario" value="' + data.CodiUsuario + '" />' +
									    	'<input type="text" name="name" placeholder="Nome" autofocus class="full-width name" required area-required="true" minlength="3" value="' + data.Usuario + '" />' +
									    '</div>' +
									    '<div class="form-group">' +
									    	'<input type="email" name="email" placeholder="Email" class="full-width email" required area-required="true" minlength="8" value="' + data.Email + '" />' +
									    '</div>' +
									    '<div class="form-group">' +
									    	'<input type="text" name="login" placeholder="Login" class="full-width login" required area-required="true" minlength="3" value="' + data.Login + '" />' +
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
								            text: 'Alterar',
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
								                var senha2 = this.$content.find('.senha2').val();
								                if ( senha != senha2 ){
								                	$.alert('As senhas devem ser iguais');
								                	return false;
								                }

												$.ajax({

													type: "POST",
													url: `${url_update}`,
													data: $('#formcadastro').serialize(),
													beforeSend: function() {

													},
													success: function(msg) {
														if ( msg == 1 ) {
						                					$.alert('Usuário <b>' + name + '</b> alterado com sucesso!');
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
