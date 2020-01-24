<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Sobre extends CI_Controller {

	function __construct() {
		parent::__construct();
        $this->load->model('Selects_model', 'select');
	}

	public function index() {

		$page_title = "Mablix - Sobre";
		$data['header'] = $this->template->header([ 'title' => $page_title ]);
		$data['navbar']  = $this->template->navbar();
		$data['footer'] = $this->template->footer();
		$data['scripts'] = $this->template->scripts();

		$data['total_usuarios'] = $this->select->find('COUNT(*) num_usuarios', 'tbl_usuarios');
		$data['total_animes'] = $this->select->find('COUNT(*) num_animes', 'tbl_animes');

		$this->load->view('sobre', $data);

	}
}
