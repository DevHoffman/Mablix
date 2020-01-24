<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Selects_model extends CI_Model {

	function __construct() {
		parent::__construct();
	}

	public function find($select, $from, $order_by = NULL, $limit = NULL) {
		$query = $this->db->select($select)
			->order_by($order_by)
			->get($from, $limit);
		if ( $query->num_rows() == 0 ) {
			return NULL;
		}
		else {
			return $query->result_array();
		}
	}

	public function findById($select, $from, $where, $order_by = NULL, $limit = NULL) {
		$query = $this->db->select($select)
			->where($where)
			->order_by($order_by)
			->get($from, $limit);
		if ( $query->num_rows() == 0 ) {
			return NULL;
		}
		else {
			return $query->result_array();
		}
	}

	public function session_start() {

		if ( empty($this->session->userdata['CodiUsuario']) ) { 
			redirect('login', 'refresh'); 
		}

		$usuarioSessao = $this->db->select("CodiUsuario, Usuario, Login, Email, Foto")->get_where('tbl_usuarios', array("CodiUsuario" => $this->session->userdata['CodiUsuario']), 1, 0);

		if ( empty($usuarioSessao->result_array()[0]['Usuario']) ){
			$usuarioNome = $usuarioSessao->result_array()[0]['Login'];
		}
		else{
			$usuarioNome = $usuarioSessao->result_array()[0]['Usuario'];
		}

		$usuarioFistName = explode(" ", $usuarioNome);
		$usuarioFistLetra = strtoupper($usuarioFistName[0][0]);
		$usuarioFistName = "Olá, {$usuarioFistName[0]}";

		$usuarioSessao = array(
			'FistName' => $usuarioFistName,
			'FistLetra' => $usuarioFistLetra,
			'Name' => $usuarioNome,
			'Login' => $usuarioSessao->result_array()[0]['Login'],
			'Email' => $usuarioSessao->result_array()[0]['Email'],
			'Foto' => "assets/images/avatars/" . $usuarioSessao->result_array()[0]['Foto'],
		);

		return $usuarioSessao;	
	}
}
