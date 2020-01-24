<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Perfil extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('Selects_model', 'select');
		$this->load->model('Updates_model', 'update');
	}

	public function index() {

		$usuarioSessao = $this->select->session_start();

		$page_title = "Mablix - Meu Perfil";
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

		$data['h1'] = 'Meu Perfil';

		$this->load->view('admin/perfil', $data);

	}

	public function atualiza_perfil() {
		$dados_form = $this->input->post();

		if ( !empty($_FILES['arquivo']) ){
			$dados_form['Foto'] = $_FILES['arquivo'];
		}
		else {
			$dados_form['Foto'] = null;
		}


		$dados_form = $this->update->update_perfil($this->session->userdata['CodiUsuario'], $dados_form['name'], $dados_form['email'], $dados_form['login'], $dados_form['senha'], $dados_form['senha2'], $dados_form['Foto']);
		$this->output->set_content_type('application/json')->set_output(json_encode($dados_form));
	}
}
