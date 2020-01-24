<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Sair extends CI_Controller {

	function __construct() {
		parent::__construct();
	}

	public function index() {
		$array = array('CodiUsuario', 'Ip', 'Logged_in');
		$this->session->unset_userdata($array); // Pega dados para Sessão
		redirect('login', 'redirect');
	}

}
