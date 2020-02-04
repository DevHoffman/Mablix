<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Search_model extends CI_Model {

	function __construct() {
		parent::__construct();
	}

	public function search($seach) {
		$query = $this->db->join('tbl_categorias C', "C.CodiCategoria = A.CodiCategoria")
			->like('A.Anime', $seach)
			->or_like('A.Texto', $seach)
			->or_like('A.DataLancamento', $seach)
			->or_like('C.Categoria', $seach)
		->get('tbl_animes A');
		if ( $query->num_rows() > 0 ){
			return $query->result_array();
		}
		else {
			return 0;
		}
	}
}
