<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Query_posts_model extends CI_Model
{

	function __construct()
	{
		parent::__construct();
	}

    public function load_more_animes($limit, $start) {
            $query = $this->db->select("*")
            ->join('tbl_categorias C', "C.CodiCategoria = A.CodiCategoria")
            ->order_by("CodiAnime", "DESC")
            ->limit($limit, $start)
            ->get('tbl_animes A');
            return $query->result_array();
    }

    public function load_more_episodios($id_anime, $limit, $start) {
            $query = $this->db->select('CodiEpisodio, Titulo, Anime, E.Imagem_Destacada, Video')
            ->join('tbl_animes A', "A.CodiAnime = E.CodiAnime")
            ->where('A.CodiAnime', $id_anime)
            ->order_by("E.Titulo", "DESC")
            ->limit($limit, $start)
            ->get('tbl_episodios E');
            return $query->result_array();
    }

	public function get_destaques($limit = NULL){
		$query = $this->db
			->join('tbl_categorias C', "C.CodiCategoria = A.CodiCategoria")
			->get('tbl_animes A', $limit);
		if ($query->num_rows() > 0) {
			return $query->result_array();
		} else {
			return NULL;
		}
	}

	public function get_lancamentos($limit = NULL) {
		$query = $this->db->join('tbl_categorias C', "C.CodiCategoria = A.CodiCategoria")
			->order_by("A.DataLancamento DESC")
			->get('tbl_animes A', $limit);
		if ($query->num_rows() > 0) {
			return $query->result_array();
		} else {
			return NULL;
		}
	}

	public function findAnimeById($id_anime) {
		$query = $this->db
			->join('tbl_categorias C', "C.CodiCategoria = A.CodiCategoria")
			->where("CodiAnime", $id_anime)
			->get('tbl_animes A');
		if ($query->num_rows() > 0) {
			return $query->result_array();
		} else {
			return NULL;
		}
	}

	public function findByIdEpisodio($id_episodio) {
		$query = $this->db->select('CodiEpisodio, Titulo, E.CodiAnime, Anime, E.Imagem_Destacada, Video')
			->join('tbl_animes A', 'A.CodiAnime = E.CodiAnime')
			->join('tbl_categorias C', "C.CodiCategoria = A.CodiCategoria")
			->where("E.CodiEpisodio", $id_episodio)
			->get('tbl_episodios E');
		if ($query->num_rows() > 0) {
			return $query->result_array();
		} else {
			return NULL;
		}
	}

	public function findByIdCategoria($id_categoria) {
		$query = $this->db->where("E.CodiCategoria", $id_categoria)
			->join('tbl_animes A', 'A.CodiAnime = E.CodiAnime')
			->join('tbl_categorias C', "C.CodiCategoria = A.CodiCategoria")
			->get('tbl_episodios E');
		if ($query->num_rows() > 0) {
			return $query->result_array();
		} else {
			return NULL;
		}
	}
	
}
