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

	        <div class="row section-header ">
				<form id="formcadastro" novalidate="novalidate">
				
					<div class="form-group col-12">
	            		<input type="text" name="anime" class="Anime" area-required="true" minlength="5" required placeholder="Título do Anime" />
	        		</div>
					<div class="form-group col-6">
	                    <select class="select2_Categoria form-control" name="codicategoria">
	                    	<option></option>
	                    	<?php foreach ( $categorias as $value ) { ?>
	                    	<option value="<?php echo $value['CodiCategoria'] ?>"> <?php echo $value['Categoria'] ?> </option>
	                    	<?php } ?>
	                    </select>
					</div>

					<div class="form-group col-6">
						<textarea type="text" name="descricao" class="descricao" rows="5" area-required="true" minlength="10" required placeholder="Breve descrição"></textarea>
					</div>

					<div class="form-group col-12">
						<textarea type="text" name="texto" class="texto" rows="10" area-required="true" minlength="20" placeholder="Sinopse"></textarea>
					</div>

					<div class="form-group col-12">
						<label class="header-nav_perfil" title="Selecione a Imagem" id="FotoTMP" for="Foto" style="background-image: url('<?php echo base_url("assets/images/hero-bg.jpg") ?>');">
							<h2 id="h2-Foto"> Insira a imagem destacada </h2>
							<input type="file" id="Foto" name="imagem_destacada" />
						</label>
					</div>

					<div class="form-group col-12">
			            <!-- <video class="afterglow" data-autoresize="none" id="myvideo" width="1920" height="1080"> -->
			              <!-- <source type="video/mp4" id="trailer-source" src="https://vjs.zencdn.net/v/oceans.mp4" /> -->
			            <!-- </video> -->
						<label class="trailer" for="Trailer" title="Selecione o Trailer">
							Insira o Trailer
							<input type="file" id="Trailer" name="trailer" />
						</label>
					</div> 
					
					<div class="form-group col-12">
						<hr />
						<button type="reset" class="bnt btn-primary"> Limpar </button>
						<button type="submit" class="bnt CadastroBtn"> Cadastrar </button>
						<div class="submit-loader">
                            <div class="text-loader">Cadastrando
                                <div class="s-loader">
                                    <div class="bounce1"></div>
                                    <div class="bounce2"></div>
                                    <div class="bounce3"></div>
                                </div>
                            </div>
						</div>
					</div>
				</form>	 
	        </div>

	        <div class="row">
	            <div class="message-warning">

	            </div> 
	            <div class="message-success">

	            </div> 
            </div> 

		</section>

		<section>
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
							{ data: 'CodiAnime', name: 'CodiAnime' },
						],
						order: [[ 0, 'asc' ]],
						rowCallback: function(row, data) {
							$(row).css('cursor', 'pointer');
							
							var btnDelete = $(`<span href="${url_delete}${data.CodiAnime}" class="text-danger"><i class="fa fa-trash"></i></span>`);
							$('td:eq(3)', row).html(btnDelete);
							$('td:eq(3)', row).css('text-align', 'center');

							$('td:eq(3)', row).each(function() {
								$(this).on('click', function() {
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
							});

							$('td:eq(-3)', row).each(function() {
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

			document.getElementById('Foto').onchange = function (evt) {
			    var tgt = evt.target || window.event.srcElement, files = tgt.files;

			    // FileReader support
			    if (FileReader && files && files.length) {
			        var fr = new FileReader();
			        fr.onload = function () {
			            document.getElementById('FotoTMP').style.backgroundImage = "url(" + fr.result + ")";
			            document.getElementById('h2-Foto').style.display = "none";
			        }
			        fr.readAsDataURL(files[0]);
			    }
			    else { // Not supported
			        // fallback -- perhaps submit the input to an iframe and temporarily store
			        // them on the server until the user's session ends.
		            document.getElementById('h2-Foto').innerHTML = "Imagem não suportada";
			    }
			}

			// document.getElementById('trailer').onchange = function (evt) {
			//     var tgt = evt.target || window.event.srcElement, files = tgt.files;

		 //    	if ( files[0]['type'] == 'video/mp4' ){
			// 	    // FileReader support
			// 	    if (FileReader && files && files.length) {
			// 	        var fr = new FileReader();
			// 	        fr.onload = function () {

			// 	            document.getElementById('trailer-source').src = fr.result;

			// 	            document.getElementById('myvideo').style.display = "block";
		 //            		document.getElementById('h2-trailer').innerHTML = "Tentar novamente";
			// 	        }
			// 	        fr.readAsDataURL(files[0]);
			// 	    }
			// 	    else { // Not supported
			// 	        // fallback -- perhaps submit the input to an iframe and temporarily store
			// 	        // them on the server until the user's session ends.
			//             document.getElementById('h2-trailer').innerHTML = "Vídeo não suportado";
			// 	    }
		 //    	}
		 //    	else {
		 //            document.getElementById('myvideo').style.display = "none";
		 //            document.getElementById('h2-trailer').innerHTML = "É permitido apenas vídeos";
		 //    	}
			// }

		});
		// Datatables
	</script>

	<script type="text/javascript">

		/* Validação de Cadastro */
		$('#formcadastro').validate({

			/* submit via ajax */
			submitHandler: function(form) {

				var sLoader = $('.submit-loader');
                var formcadastro = $('#formcadastro')[0];
                var data = new FormData(formcadastro);

				$.ajax({
					type: "POST",
                    enctype: 'multipart/form-data',
					url: "/admin/animes/insert",
					data: data,
					contentType: false,
					processData: false,
					beforeSend: function() {

						sLoader.slideDown("slow");

					},
					success: function(msg) {
						if ( msg == 1 ) {
							// Message was sent
							sLoader.slideUp("slow");
							$('.message-warning').fadeOut();
							$('.message-success').html("Anime cadastrado com Sucesso");
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
	</script>

</html>
