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
				<table class="table table-dark table-hover table-striped datatable-buttons" data-url="<?php echo $datatables ?>" data-insert="<?php echo $url_insert ?>" data-delete="<?php echo $url_delete ?>">
				  	<thead>
				    	<tr>
					      	<th scope="col">Anime</th>
					      	<th scope="col">Categoria</th>
					      	<th scope="col">DataLancamento</th>
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
							{ data: 'Anime', name: 'Anime' },
							{ data: 'Categoria', name: 'Categoria' },
							{ data: 'DataLancamento', name: 'DataLancamento' },
							{ data: 'CodiAnime', name: 'CodiAnime' },
						],
						order: [[ 0, 'asc' ]],
						rowCallback: function(row, data) {
							$(row).css('cursor', 'pointer');
							
							var btnDelete = $(`<span href="${url_delete}${data.CodiAnime}" class="text-danger"><i class="fa fa-trash"></i></span>`);
							$('td:eq(3)', row).html(btnDelete);
							$('td:eq(3)', row).css('text-align', 'center');

							$(btnDelete).click(function() {
								$.confirm({
								    title: `Deseja excluir ${data.Anime} ?`,
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
														$.alert(`Erro ao excluir a usuario ${data.Anime}!`);
													},
													success: function(msg) {
														if ( msg == 1 ){
															$.alert(`Usuário ${data.Anime} excluído com sucesso!`);
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
						    title: 'Cadastro de Anime',
						    content: 
						    '<form id="formcadastro" novalidate="novalidate" class="formName">' +
							    '<div class="form-group">' +
							    	'<input type="text" name="anime" placeholder="Anime" autofocus class="full-width anime" required area-required="true" minlength="3" />' +
							    '</div>' +
						    '</form>',
						    buttons: {
						        formSubmit: {
						            text: 'Cadastrar',
						            btnClass: 'btn--primary',
						            action: function () {
						                var name = this.$content.find('.anime').val();
						                if( name.length <= 3 ){
						                    $.alert('Anime inválido, deve conter no mínimo 3 caracteres.');
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
				                					$.alert('Anime <b>' + name + '</b> cadastrado com sucesso!');
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
		    columnClass: 'col-12',
		    boxWidth: '50%',
			theme: 'supervan', // 'material', 'bootstrap', 'light', 'dark', 'modern'
		};
	</script>
</html>
