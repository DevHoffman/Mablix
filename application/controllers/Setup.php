<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Setup extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model("option_model", "option");
		$this->load->model('Login_model', 'login');
    }

	public function index() {
		if ( $this->option->get_option('setup_executado') == 1 ) { // Setup OK
			redirect('setup/alterar', 'refresh');
		}
		else { // Não instalado
			redirect('setup/instalar', 'refresh');
		}
	}

	public function instalar() {
		if ( $this->option->get_option('setup_executado') == 1 ) { // Setup OK
			redirect('setup/alterar', 'refresh');
		}

        $page_title = "Glint - Setup do Sistema";
        $data['header'] = $this->template->header([ 'title' => $page_title ]);
        $data['navbar']  = $this->template->navbar();
        $data['scripts'] = $this->template->scripts();
        $data['footer'] = $this->template->footer();

        $data['atributos_form'] = array(
            'id'            =>      'contactForm',
            'novalidate'    =>      'novalidate',
        );

		$data['atributos_name'] = array(
            'type'          =>      'text',
            'name'          =>      'name',
            'placeholder'   =>      'Seu Nome',
            'minlength'     =>      '3',
            // 'required'      =>      '',
            // 'aria-required' =>      'true',
            'class'         =>      'full-width',
            'autofocus' => 'autofocus'
		);

		$data['atributos_login'] = array(
            'type'          =>      'text',
            'name'          =>      'login',
            'minlength'     =>      '3',
            'required'      =>      '',
            'placeholder'   =>      'Seu Login',
            'aria-required' =>      'true',
            'class'         =>      'full-width',
            'autofocus' => 'autofocus'
		);

		$data['atributos_email'] = array(
            'type'          =>      'email',
            'name'          =>      'login',
            'placeholder'   =>      'Seu Email',
            'minlength'     =>      '3',
            // 'required'      =>      '',
            // 'aria-required' =>      'true',
            'class'         =>      'full-width',
		);

		$data['atributos_senha'] = array(
            'name'          =>      'senha',
            'minlength'     =>      '8',
            'required'      =>      '',
            'placeholder'   =>      'Sua Senha',
            'aria-required' =>      'true',
            'class'         =>      'full-width'
		);

		$data['atributos_senha2'] = array(
            'name'          =>      'senha2',
            'minlength'     =>      '8',
            'required'      =>      '',
            'placeholder'   =>      'Confirme sua Senha',
            'aria-required' =>      'true',
            'class'         =>      'full-width'
		);

		$data['h3'] = 'Crie uma conta aqui';
		$data['h1'] = 'Precisamos do seu Cadastro para Continuarmos!';

		//Carrega View
		$this->load->view('painel/setup', $data);
	}

}
