<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Episodios extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->route = base_url('admin/episodios');
		$this->load->model('Selects_model', 'select');
		$this->load->model('Query_posts_model', 'query');
		$this->load->model('admin/Episodios_model', 'episodios');
	}

	public function index() {

		$usuarioSessao = $this->select->session_start();

		$page_title = "Mablix - Episódios";
		$data['header'] = $this->TemplatePainel->header([ 
			'title' => $page_title,
			'styles' 	=> [
				base_url(THIRD_PARTY . "datatables/datatables.min.css"),
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
			]
		]);

		$data['categorias'] = $this->select->find('*', 'tbl_categorias');

		$data['h1'] = 'Selecione o Anime';
		$data['datatables'] = "{$this->route}/datatables";
		$data['url_delete'] = "{$this->route}/remove/";
		$data['url_update'] = "{$this->route}/lista/";

		$this->load->view("admin/episodios/selecione_anime", $data);
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

	public function lista($codianime) {

		$usuarioSessao = $this->select->session_start();

		$page_title = "Mablix - Lista Episódios";
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

		$data['anime'] = $this->query->findAnimeById($codianime);

		$data['h1'] = "Cadastrar Episódio <br /> {$data['anime'][0]['Anime']}";
		$data['datatables'] = "{$this->route}/datatables_episodios/{$data['anime'][0]['CodiAnime']}";

		$data['url_delete'] = "{$this->route}/remove/";
		$data['url_update'] = "{$this->route}/detalhes/";

		$this->load->view("admin/episodios/episodios", $data);
	}

	public function detalhes($codiepisodio) {

		$usuarioSessao = $this->select->session_start();

		$page_title = "Mablix - Alterar Episódios";
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

		// var_dump($_SERVER); exit();

		$data['episodio'] = $this->query->findByIdEpisodio($codiepisodio);

		$data['h1'] = "Alterar Episódio <br /> {$data['episodio'][0]['Titulo']}";
		$data['datatables'] = "{$this->route}/datatables_episodios/{$data['episodio'][0]['CodiAnime']}";
		$data['url_delete'] = "{$this->route}/remove/";
		$data['url_update'] = "{$this->route}/detalhes/";

		$this->load->view("admin/episodios/detalhes", $data);
	}

	public function datatables_episodios($codianime) {

		$datatables = $this->datatable->exec(
			$this->input->post(),
			'tbl_episodios E',
			[
				['db' => 'E.CodiEpisodio', 'dt' => 'CodiEpisodio'],
				['db' => 'E.Titulo', 'dt' => 'Titulo'],
				['db' => 'A.Anime', 'dt' => 'Anime'],
				[
					'db' => 'E.DataPublicacao', 'dt' => 'DataPublicacao',
		        	'formatter' => function( $value, $row ) {
			            return date( 'd/m/Y H:i', strtotime($value));
			        }
			    ],
			],
			[
				['tbl_animes A', "A.CodiAnime = E.CodiAnime"]
			],
			"A.CodiAnime = {$codianime}"
		);

		$this->output->set_content_type('application/json')->set_output(json_encode($datatables));
	}

	public function remove($codiepisodio){

		$dados_form = $this->episodios->remove_episodios($codiepisodio);

		$this->output->set_content_type('application/json')->set_output(json_encode($dados_form));
	}

    public function insert(){

        $dados_form = $this->input->post();

        // Regras de Validação
        $this->form_validation->set_rules('episodio', 'episodio', 'trim|required|min_length[5]');
        $this->form_validation->set_rules('codianime', 'codianime', 'trim|required|min_length[1]');
        $this->form_validation->set_rules('anime', 'anime', 'trim|required|min_length[1]');
        $this->form_validation->set_rules('video','video','trim|required|min_length[12]');
        $this->form_validation->set_rules('imagem_destacada','imagem_destacada','trim');

        $dados_form['foto'] = $_FILES['imagem_destacada'];

        $dados_form = $this->episodios->create_episodios($dados_form['episodio'], $dados_form['codianime'], $dados_form['anime'], $dados_form['video'], $dados_form['foto']);
    	$this->output->set_content_type('application/json')->set_output(json_encode($dados_form));
    }

    public function update(){

        $dados_form = $this->input->post();

        // Regras de Validação
        $this->form_validation->set_rules('codiepisodio', 'codiepisodio', 'trim|required|min_length[1]');
        $this->form_validation->set_rules('episodio', 'episodio', 'trim|required|min_length[5]');
        $this->form_validation->set_rules('codianime', 'codianime', 'trim|required|min_length[1]');
        $this->form_validation->set_rules('anime', 'codianime', 'trim|required|min_length[1]');
        $this->form_validation->set_rules('video','video','trim|required|min_length[12]');
        $this->form_validation->set_rules('imagem_destacada','imagem_destacada','trim');

        $dados_form['foto'] = $_FILES['imagem_destacada'];

        $dados_form = $this->episodios->update_episodios($dados_form['codiepisodio'], $dados_form['episodio'], $dados_form['codianime'], $dados_form['anime'], $dados_form['video'], $dados_form['foto']);
    	$this->output->set_content_type('application/json')->set_output(json_encode($dados_form));
    }

}
