<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Animes extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('Query_posts_model', 'query');
	}

	public function index() {

		$page_title = "Mablix - Todos os Animes";
	    $data['header'] = $this->template->header([ 
	      'title' => $page_title
	    ]);
	    $data['navbar']  = $this->template->navbar();
	    $data['footer'] = $this->template->footer();
	    $data['scripts'] = $this->template->scripts();

		$data['h3'] = "Lista de Animes";
		$data['h2'] = "Confira todos os animes";

		$this->load->view('page_todos_animes', $data);
	}

	public function episodio($id_episodio) {

		$page_title = "Mablix - Página do Episódio";
		$data['header'] = $this->template->header([ 
			'title' => $page_title
		]);
		$data['navbar']  = $this->template->navbar();
		$data['footer'] = $this->template->footer();
		$data['scripts'] = $this->template->scripts([
			'scripts' => [ 
				'//cdn.jsdelivr.net/npm/afterglowplayer@1.x'
			]
		]);

		$data['rows_post'] = $this->query->findByIdEpisodio($id_episodio);

		if ($data['rows_post'] == null ) { exit(); }

		$data['h3'] = $data['rows_post'][0]['Anime'];
		$data['h2'] = $data['rows_post'][0]['Titulo'];
		$data['Imagem_Destacada'] = $data['rows_post'][0]['Imagem_Destacada'];
		$data['Video'] = $data['rows_post'][0]['Video'];

		$this->load->view('page_episodio', $data);
	}

	public function anime($id_anime) {

		$page_title = "Mablix - Página do Anime";
	    $data['header'] = $this->template->header([ 
	      	'title' => $page_title
	    ]);
	    $data['navbar']  = $this->template->navbar();
	    $data['footer'] = $this->template->footer();
	    $data['scripts'] = $this->template->scripts();

		$data['rows_post'] = $this->query->findAnimeById($id_anime);

		if ($data['rows_post'] == null ) { exit(); }

		$data['h3'] = $data['rows_post'][0]['Categoria'];
		$data['h1'] = $data['rows_post'][0]['Anime'];
		$data['Imagem_Destacada'] = $data['rows_post'][0]['Imagem_Destacada'];

		$this->load->view('page_episodios', $data);
	}

	// public function categoria($id_categoria) {

	// 	$page_title = "Mablix - Página da Categoria";
	// 	$data['header'] = $this->template->header(
	// 		[ 'title' => $page_title ]
	// 	);
	// 	$data['navbar']  = $this->template->navbar();
	// 	$data['footer'] = $this->template->footer();
	// 	$data['scripts'] = $this->template->scripts();

	// 	$data['rows_post'] = $this->query->findByIdCategoria($id_anime);

	// 	if ($data['rows_post'] == null ) { exit(); }

	// 	$data['h3'] = $data['rows_post'][0]['Categoria'];
	// 	$data['h2'] = $data['rows_post'][0]['Anime'];

	// 	$this->load->view('page_animes', $data);
	// }

	public function get_animes() {
		$output = '';
		$rows_post = $this->query->load_more_animes($this->input->post('limit'), $this->input->post('start'));

		foreach($rows_post as $value) {
		  	$output .= '
			  	<div class="masonry__brick col-3" data-aos="fade-up">
		            <div class="item-folio">
		              	<a href="' . base_url("animes/anime/" . $value['CodiAnime']) . '" class="thumb-link" title="' . $value['Anime'] . '" data-size="1050x700">
			                <div class="item-folio__thumb" style="background-image: url(' . base_url($value["Imagem_Destacada"]) . ')"></div>
			                <div class="item-folio__text">
			                  	<h3 class="item-folio__title">' . $value["Anime"] . '</h3>
			                  	<p class="item-folio__cat">' . $value["Categoria"] . '</p>
			                </div>
			                <div class="item-folio__project-link">
			                  	<i class="icon-link"></i>
			                </div>
		              	</a>
		            </div>
	          	</div> <!-- end masonry__brick -->
		  	';
		}
		echo $output;
	}

	public function get_episodios() {
		$output = '';
		$rows_post = $this->query->load_more_episodios($this->input->post('limit'), $this->input->post('start'));

		foreach($rows_post as $value) {
		  	$output .= '
			  	<div class="masonry__brick col-3" data-aos="fade-up">
		            <div class="item-folio">
		              	<a href="' . base_url("animes/episodio/" . $value['CodiEpisodio']) . '" class="thumb-link" title="' . $value['Titulo'] . '" data-size="1050x700">
			                <div class="item-folio__thumb" style="background-image: url(' . base_url($value["Imagem_Destacada"]) . ')"></div>
			                <div class="item-folio__text">
			                  	<h3 class="item-folio__title">' . $value["Titulo"] . '</h3>
			                  	<p class="item-folio__cat">' . $value["Categoria"] . '</p>
			                </div>
			                <div class="item-folio__project-link">
			                  	<i class="icon-link"></i>
			                </div>
		              	</a>
		            </div>
	          	</div> <!-- end masonry__brick -->
		  	';
		}
		echo $output;
	}

}
