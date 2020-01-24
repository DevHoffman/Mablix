<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('Selects_model', 'select');
	}

	public function index() {

		$usuarioSessao = $this->select->session_start();

		$page_title = "Mablix - Dashboard";
		$data['header'] = $this->TemplatePainel->header([ 'title' => $page_title ]);
		$data['navbar']  = $this->TemplatePainel->navbar(
			[
				'usuarioFistName' => $usuarioSessao['FistName'],
				'usuarioNome' => $usuarioSessao['Name'],
				'usuarioFoto' => $usuarioSessao['Foto'],
				'usuarioLogin' => $usuarioSessao['Login'],
				'usuarioEmail' => $usuarioSessao['Email'],
				'usuarioFistLetra' => $usuarioSessao['FistLetra']
			]
		);
		$data['footer'] = $this->TemplatePainel->footer();
		$data['scripts'] = $this->TemplatePainel->scripts();

		$this->load->view('admin/dashboard', $data);

	}
}
