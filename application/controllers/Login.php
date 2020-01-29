<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    function __construct()
    {
        parent::__construct();
		$this->load->model('admin/Usuarios_model', 'usuarios');
    }

	public function index() {

        $page_title = "Mablix - Login";
        $data['header'] = $this->template->header([ 'title' => $page_title ]);
        $data['navbar']  = $this->template->navbar();
        $data['scripts'] = $this->template->scripts();
        $data['footer'] = $this->template->footer();

        // Formulário de Acesso
        $data['atributos_form_login'] = array(
            'id'            =>      'formlogin',
            'novalidate'    =>      'novalidate'
        );

		$data['atributos_login'] = array(
            'type'          =>      'text',
            'name'          =>      'login',
            'minlength'     =>      '3',
            'required'      =>      '',
            'placeholder'   =>      'Login',
            'aria-required' =>      'true',
            'class'         =>      'full-width',
            'autofocus' => 'autofocus'
		);

		$data['atributos_senha'] = array(
            'name'          =>      'senha',
            'minlength'     =>      '8',
            'required'      =>      '',
            'placeholder'   =>      'Senha',
            'aria-required' =>      'true',
            'class'         =>      'full-width'
		);

		$data['h3'] = 'Acesse o Painel';
		$data['h1'] = 'Use suas Credenciais';

		//Carrega View
		$this->load->view('login', $data);
	}

    public function autenticate() {

        $dados_form = $this->input->post();

        // Regras de Validação
        $this->form_validation->set_rules('login', 'login', 'trim|required|min_length[3]');
        $this->form_validation->set_rules('senha','senha','trim|required|min_length[8]');
        $this->form_validation->set_rules('senha2','senha','trim|required|min_length[8]');

        if ( !empty($dados_form['login']) && !empty($dados_form['senha']) ) {

            $dados_form = $this->usuarios->autenticate($dados_form['login'], $dados_form['senha']);

            $this->output->set_content_type('application/json')->set_output(json_encode($dados_form));
        }
    }
    
}
