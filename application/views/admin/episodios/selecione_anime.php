<!DOCTYPE html>
<html>

	<?php echo $header ?>

	<body id="top">

		<?php echo $navbar ?>

		<!-- Animes
		================================================== -->
		<section id="cadastrar" class="s-contact s-usuarios">
            	
        	<button type="button" id="VoltarBtn" onclick="javascript:history.back();">Voltar</button>

			<div class="overlay"></div>
			<div class="contact__line"></div>

			<div class="row section-header aos-init aos-animate" data-aos="fade-up">
				<h1 class="display-2 display-2--light"><?php echo $h1 ?></h1>
				<hr />
	        </div>

			<div class="row" id="animes">
				<table class="table table-dark table-hover table-striped datatable-buttons" data-url="<?php echo $datatables ?>" data-delete="<?php echo $url_delete ?>" data-update="<?php echo $url_update ?>">
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

	<script type="text/javascript">
		$(document).ready(function() {
	        $(".select2_Categoria").select2({
	            placeholder: "Selecione a Categoria",
	            allowClear: true
	        });

			$('#VoltarBtn').click(function() {
				window.location = "javascript:history.back();";
			});

			// jquery-Confirm
			jconfirm.defaults = {
			    columnClass: 'col-12',
			    boxWidth: '50%',
				theme: 'supervan', // 'material', 'bootstrap', 'light', 'dark', 'modern'
				content: '',
			};
	    });
	</script>

	<script type="text/javascript">

		// Datatables
		var url_delete = $('.table').data('delete');
		var url_update = $('.table').data('update');

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
							{ data: 'CodiAnime', name: 'CodiAnime', visible: false },
						],
						order: [[ 0, 'asc' ]],
						rowCallback: function(row, data) {
							$(row).css('cursor', 'pointer');

							$('td', row).each(function() {
								$(this).on('click', function() {
									window.location.href = url_update + data.CodiAnime;
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
					                text: 'Atualizar',
						            attr: {
						                id: 'AtualizaBtn'             
						            },
					                action: function ( e, dt, button, config ) {
								        table.ajax.reload();
								    },
							    }
					        ]
					    },
					});

					$('.dt-buttons #AtualizaBtn').click(function() {
						table.ajax.reload();
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

</html>
