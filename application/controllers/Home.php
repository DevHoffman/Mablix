<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('Query_posts_model', 'query');
		$this->load->model('Search_model', 'search');
	}

	public function index() {

			$page_title = "Mablix";
		    $data['header'] = $this->template->header([ 
		      	'title' => $page_title,
		      	'header'  => [
		          	base_url('assets/css/slick/slick.css'),
		          	base_url('assets/css/slick/slick-theme.css')
		      	]
		    ]);
		    $data['navbar']  = $this->template->navbar();
		    $data['footer'] = $this->template->footer();
		    $data['scripts'] = $this->template->scripts();

			$data['rows_lancamentos'] = $this->query->get_lancamentos(10);
			$data['rows_destaques'] = $this->query->get_destaques(10);

			$this->load->view('home', $data);
	}

	public function get_animes() {
		$output = '';
		$rows_post = $this->query->load_more_animes($this->input->post('limit'), $this->input->post('start'));

		foreach($rows_post as $value) {
		  	$output .= '
			  	<div class="masonry__brick col-3" data-aos="fade-up">
		            <div class="item-folio">
		              	<a href="' . base_url("animes/anime/" . $value['CodiAnime']) . '" class="thumb-link" title="' . $value['Anime'] . '" data-size="1050x700">
			                <div class="item-folio__thumb" style="background-image: url(' . "'" . base_url("assets/animes/{$value['Anime']}/banner/" . $value["Imagem_Destacada"]) . "'" . ')"></div>
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

}
