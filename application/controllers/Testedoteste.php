<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Testedoteste extends CI_Controller {

	function __construct() {
		parent::__construct();
	}

	public function index() {

		$page_title = "TestedoTeste";
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

		$this->load->view('teste', $data);
	}

}
