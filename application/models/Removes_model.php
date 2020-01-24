<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Removes_model extends CI_Model {

        function __construct() {
                parent::__construct();
        }

        public function remove_usuario($codiusuario)
        {
                $query = $this->db->delete('tbl_usuarios', array('CodiUsuario' => $codiusuario));
                if ( $query == true ) {
                        return 1;
                }
                else {
                        return 'Erro ao remover o usuário!';
                }
        }

        public function remove_anime($codianime)
        {
                $query = $this->db->delete('tbl_animes', array('CodiAnime' => $codianime));
                if ( $query == true ) {
                        return 1;
                }
                else {
                        return 'Erro ao remover o anime!';
                }
        }
}