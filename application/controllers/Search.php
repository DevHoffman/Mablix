<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Search extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('Search_model', 'search');
	}

	public function index() {
//		echo '/home/search/Tituloteste';
		$dados_form = $this->input->post();

		// Regras de Validação
		$this->form_validation->set_rules('search', 'search', 'trim|required');

		if ( !empty($dados_form['search']) ) {
			$dados_form = $this->search->search($dados_form['search']);

			$this->output->set_content_type('application/json')->set_output(json_encode($dados_form));
		}

	}

}
