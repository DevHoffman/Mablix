<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Animes extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->route = base_url('admin/animes');
		$this->load->model('Selects_model', 'select');
		$this->load->model('Removes_model', 'remove');
	}

	public function index() {

		$usuarioSessao = $this->select->session_start();

		$page_title = "Mablix - Animes";
		$data['header'] = $this->TemplatePainel->header([ 
			'title' => $page_title,
			'styles' 	=> [
				base_url(THIRD_PARTY . "datatables/datatables.min.css"),
				base_url(THIRD_PARTY . "jquery-confirm/jquery-confirm.min.css")
			] 
		]);
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
		$data['scripts'] = $this->TemplatePainel->scripts([
			'scripts'	=> 	[
				base_url(THIRD_PARTY . "datatables/pdfmake.min.js"),
				base_url(THIRD_PARTY . "datatables/vfs_fonts.js"),
				base_url(THIRD_PARTY . "datatables/datatables.min.js"),
				base_url(THIRD_PARTY . "jquery-confirm/jquery-confirm.min.js")
			]
		]);

		$data['h1'] = 'Lista de Animes';
		$data['datatables'] = "{$this->route}/datatables";
		$data['url_delete'] = "{$this->route}/remove/";
		$data['url_insert'] = "{$this->route}/insert/";

		$this->load->view('admin/animes', $data);

	}

	public function datatables() {

		$datatables = $this->datatable->exec(
			$this->input->post(),
			'tbl_animes A',
			[
				['db' => 'A.CodiAnime', 'dt' => 'CodiAnime'],
				['db' => 'A.Anime', 'dt' => 'Anime'],
				['db' => 'A.CodiCategoria', 'dt' => 'CodiCategoria'],
				['db' => 'C.Categoria', 'dt' => 'Categoria'],
				[
					'db' => 'A.DataLancamento', 'dt' => 'DataLancamento',
		        	'formatter' => function( $value, $row ) {
			            return date( 'd/m/Y H:i', strtotime($value));
			        }
			    ],
			],
			[
				['tbl_categorias C', "C.CodiCategoria = A.CodiCategoria"]
			]
		);

		$this->output->set_content_type('application/json')->set_output(json_encode($datatables));
	}

	public function remove($codianime){

		$dados_form = $this->remove->remove_anime($codianime);

		$this->output->set_content_type('application/json')->set_output(json_encode($dados_form));
	}

    public function insert(){

        $dados_form = $this->input->post();

        var_dump($dados_form); exit(); 

        // Regras de Validação
        $this->form_validation->set_rules('anime', 'anime', 'trim|required|min_length[3]');
        $this->form_validation->set_rules('categoria', 'categoria', 'trim|required|min_length[3]');

        if ( !empty($dados_form['anime']) && !empty($dados_form['categoria']) ){

            $this->output->set_content_type('application/json')->set_output(json_encode($dados_form));
        }
    }
}
