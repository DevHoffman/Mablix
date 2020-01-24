<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Contato extends CI_Controller {

	function __construct() {
                parent::__construct();
                $this->load->model('SendMail_model', 'sendMail');
	}

	public function index() {

                $page_title = "Mablix - Contato";
                $data['header'] = $this->template->header(
                	[ 'title' => $page_title ]
				);
                $data['navbar']  = $this->template->navbar();
                $data['footer'] = $this->template->footer();
                $data['scripts'] = $this->template->scripts();

                $data['h3'] = 'Alguma Sugestão?';
                $data['h1'] = 'Sua Sugestão Pode Fazer Mais Diferença Do Que Você Imagina!';

                $data['atributos_form'] = array(
                        'id'            =>      'formulario',
                        'novalidate'    =>      'novalidate'
                );

                $data['atributos_name'] = array(
                        'type'          =>      'text',
                        'id'            =>      'contactName',
                        'name'          =>      'contactName',
                        'minlength'     =>      '3',
                        'required'      =>      '',
                        'placeholder'   =>      'Seu Nome',
                        'aria-required' =>      'true',
                        'class'         =>      'full-width'
                );

                $data['atributos_email'] = array(
                        'type'          =>      'email',
                        'id'            =>      'contactEmail',
                        'name'          =>      'contactEmail',
                        'minlength'     =>      '3',
                        'required'      =>      '',
                        'placeholder'   =>      'Seu Email',
                        'aria-required' =>      'true',
                        'class'         =>      'full-width'
                );

                $data['atributos_assunto'] = array(
                        'type'          =>      'text',
                        'id'            =>      'contactSubject',
                        'name'          =>      'contactSubject',
                        'minlength'     =>      '3',
                        'required'      =>      '',
                        'placeholder'   =>      'Assunto',
                        'aria-required' =>      'true',
                        'class'         =>      'full-width'
                );

                $data['atributos_mensagem'] = array(
                        'id'            =>      'contactMessage',
                        'name'          =>      'contactMessage',
                        'minlength'     =>      '15',
                        'required'      =>      '',
                        'rows'          =>      '10',
                        'cols'          =>      '50',
                        'placeholder'   =>      'Sua Mensagem',
                        'aria-required' =>      'true',
                        'style'         =>      'resize:none',
                        'class'         =>      'full-width'
                );
                
                $this->load->view('contato', $data);
                
	}

	public function envia() {

                $dados_form = $this->input->post();

                // Regras de Validação
                $this->form_validation->set_rules('contactName', 'Nome', 'trim|min_length[3]');
                $this->form_validation->set_rules('contactEmail', 'Email', 'trim|min_length[3]|valid_email');
                $this->form_validation->set_rules('contactSubject', 'Assunto', 'trim|required|min_length[3]');
                $this->form_validation->set_rules('contactMessage','Mensagem','trim|required|min_length[15]');

                if ( !empty($dados_form['contactName']) && !empty($dados_form['contactEmail']) && !empty($dados_form['contactSubject']) && !empty($dados_form['contactMessage']) ) {

                        $name = trim(stripslashes($dados_form['contactName']));
                        $email = trim(stripslashes($dados_form['contactEmail']));
                        $subject = trim(stripslashes($dados_form['contactSubject']));
                        $contact_message = trim(stripslashes($dados_form['contactMessage']));

                        $this->sendMail->sendMail($name, $email, $subject, $contact_message);

                }
        }

	public function subscribe() {

		$dados_form = $this->input->post();

		// Regras de Validação
		$this->form_validation->set_rules('email', 'email', 'trim|min_length[8]|valid_email');
		if ( !empty($dados_form['email']) ) {
			$dados_form = $this->sendMail->subscribe($dados_form['email']);
			$this->output->set_content_type('application/json')->set_output(json_encode($dados_form));
		}
	}

}
