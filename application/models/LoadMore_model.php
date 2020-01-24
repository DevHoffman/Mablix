<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class LoadMore_model extends CI_Model {

        function __construct() {
                parent::__construct();
        }

        public function fetch_data($limit, $start) {
                $query = $this->db->select("*")
                ->order_by("CodiAnime", "DESC")
                ->limit($limit, $start)
                ->get('tbl_animes');
                return $query->result_array();
        }
}