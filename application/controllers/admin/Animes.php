<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Animes extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->route = base_url('admin/animes');
		$this->load->model('Selects_model', 'select');
		$this->load->model('Query_posts_model', 'query');
		$this->load->model('admin/Animes_model', 'animes');
	}

	public function index() {

		$usuarioSessao = $this->select->session_start();

		$page_title = "Mablix - Animes";
		$data['header'] = $this->TemplatePainel->header([ 
			'title' => $page_title,
			'styles' 	=> [
				base_url(THIRD_PARTY . "select2/dist/css/select2.min.css"),
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
				base_url(THIRD_PARTY . "select2/dist/js/select2.min.js"),
				base_url(THIRD_PARTY . "datatables/pdfmake.min.js"),
				base_url(THIRD_PARTY . "datatables/vfs_fonts.js"),
				base_url(THIRD_PARTY . "datatables/datatables.min.js"),
				base_url(THIRD_PARTY . "jquery-confirm/jquery-confirm.min.js")
			]
		]);
		
		$data['categorias'] = $this->select->find('*', 'tbl_categorias');

		$data['h1'] = 'Cadastrar Animes';
		$data['datatables'] = "{$this->route}/datatables";
		$data['url_delete'] = "{$this->route}/remove/";
		$data['url_update'] = "{$this->route}/detalhes/";

		$this->load->view("admin/animes/animes", $data);
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

		$dados_form = $this->animes->remove_animes($codianime);

		$this->output->set_content_type('application/json')->set_output(json_encode($dados_form));
	}

    public function insert(){

        $dados_form = $this->input->post();
        $dados_form['foto'] = $_FILES['imagem_destacada'];
        $dados_form['trailer'] = $_FILES['trailer'];

        // Regras de Validação
        $this->form_validation->set_rules('anime', 'anime', 'trim|required|min_length[5]');
        $this->form_validation->set_rules('codicategoria', 'codicategoria', 'trim|required|min_length[1]');
        $this->form_validation->set_rules('descricao','descricao','trim|required|min_length[10]');
        $this->form_validation->set_rules('texto','texto','trim|min_length[20]');
        $this->form_validation->set_rules('imagem_destacada','imagem_destacada','trim');
        $this->form_validation->set_rules('trailer','trailer','trim');

        $dados_form = $this->animes->create_animes($dados_form['anime'], $dados_form['codicategoria'], $dados_form['descricao'], $dados_form['texto'], $dados_form['foto'], $dados_form['trailer']['name']);
    	$this->output->set_content_type('application/json')->set_output(json_encode($dados_form));
    }

    public function update(){

        $dados_form = $this->input->post();
        $dados_form['foto'] = $_FILES['imagem_destacada'];
        $dados_form['trailer'] = $_FILES['trailer'];
        // var_dump($dados_form); exit();

        // Regras de Validação
        $this->form_validation->set_rules('CodiAnime', 'CodiAnime', 'trim|required');
        $this->form_validation->set_rules('anime', 'anime', 'trim|required|min_length[5]');
        $this->form_validation->set_rules('codicategoria', 'codicategoria', 'trim|required|min_length[1]');
        $this->form_validation->set_rules('descricao','descricao','trim|required|min_length[10]');
        $this->form_validation->set_rules('texto','texto','trim|min_length[20]');
        $this->form_validation->set_rules('imagem_destacada','imagem_destacada','trim');
        $this->form_validation->set_rules('trailer','trailer','trim');

        $dados_form = $this->animes->update_animes($dados_form['CodiAnime'], $dados_form['anime'], $dados_form['codicategoria'], $dados_form['descricao'], $dados_form['texto'], $dados_form['foto'], $dados_form['trailer']['name']);
    	$this->output->set_content_type('application/json')->set_output(json_encode($dados_form));
    }

	public function detalhes($codianime) {

		$usuarioSessao = $this->select->session_start();

		$page_title = "Mablix - Detalhes";
		$data['header'] = $this->TemplatePainel->header([ 
			'title' => $page_title,
			'styles' 	=> [
				base_url(THIRD_PARTY . "select2/dist/css/select2.min.css"),
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
				base_url(THIRD_PARTY . "select2/dist/js/select2.min.js"),
				base_url(THIRD_PARTY . "datatables/pdfmake.min.js"),
				base_url(THIRD_PARTY . "datatables/vfs_fonts.js"),
				base_url(THIRD_PARTY . "datatables/datatables.min.js"),
				base_url(THIRD_PARTY . "jquery-confirm/jquery-confirm.min.js")
			]
		]);

		$data['anime'] = $this->query->findAnimeById($codianime);
		$data['categorias'] = $this->select->find('*', 'tbl_categorias');

		$data['h1'] = "Editar {$data['anime'][0]['Anime']}";
		$data['datatables'] = "{$this->route}/datatables";
		$data['url_delete'] = "{$this->route}/remove/";
		$data['url_update'] = "{$this->route}/detalhes/";


		$this->load->view("admin/animes/detalhes", $data);
	}
}
