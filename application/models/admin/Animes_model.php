<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Animes_model extends CI_Model {

        function __construct() {
                parent::__construct();
        }

        public function create_animes($anime, $codicategoria, $descricao, $texto = NULL, $foto, $trailer = NULL) {

                if ( empty($anime) ) { return 'Campo título é necessário.'; exit(); }
                if ( empty($codicategoria) ) { return 'Campo categoria é necessário.'; exit(); }
                if ( empty($descricao) ) { return 'Campo descrição é necessário.'; exit(); }

                $dados_pessoais = array(
                        'Anime'         =>      $anime,
                        'CodiCategoria' =>      $codicategoria,
                        'Descricao'     =>      $descricao
                );

                if ( !empty($texto) ) {
                        $dados_pessoais['Texto'] = $texto;
                }

                if ( !empty($trailer) ) {
                        $dados_pessoais['Trailer'] = $trailer;
                }

                if ( !empty($foto) && $foto["error"] == 0 ){

                        $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
                        $filename = $foto["name"];
                        $filetype = $foto["type"];
                        $filesize = $foto["size"];
                    
                        // Verify file extension
                        $ext = pathinfo( $filename, PATHINFO_EXTENSION );
                        if(!array_key_exists($ext, $allowed)) { return "Selecione um formato de arquivo válido"; exit(); }
                    
                        // Verify file size - 5MB maximum
                        $maxsize = 5 * 1024 * 1024;
                        if ( $filesize > $maxsize ) { return "O arquivo excedeu o limite"; exit(); }
                    
                        // Verify MYME type of the file
                        if(in_array($filetype, $allowed)){
                            if( !is_dir("assets/animes/{$anime}/banner/") ){
                                mkdir("assets/animes/{$anime}/banner/", 0777, true);
                                move_uploaded_file($foto["tmp_name"], "assets/animes/{$anime}/banner/" . $filename);
                                $dados_pessoais['Imagem_Destacada'] = $filename;
                            }

                        } else{
                            return "Ocorreu um problema ao upar o arquivo. Por favor tente novamente"; exit();
                        }

                }

                $this->db->insert('tbl_animes', $dados_pessoais);
                return 1;
        }

        public function update_animes($codianime, $anime, $codicategoria, $descricao, $texto = NULL, $foto, $trailer = NULL) {

            if ( empty($codianime) ) { return 'Este anime não existe.'; exit(); }
            if ( empty($anime) ) { return 'Campo título é necessário.'; exit(); }
            if ( empty($codicategoria) ) { return 'Campo categoria é necessário.'; exit(); }
            if ( empty($descricao) ) { return 'Campo descrição é necessário.'; exit(); }

            $dados_pessoais = array(
                    'Anime'         =>      $anime,
                    'CodiCategoria' =>      $codicategoria,
                    'Descricao'     =>      $descricao
            );

            if ( !empty($texto) ) {
                    $dados_pessoais['Texto'] = $texto;
            }

            if ( !empty($trailer) ) {
                    $dados_pessoais['Trailer'] = $trailer;
            }

            if ( !empty($foto) && $foto["error"] == 0 ){

                    $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
                    $filename = $foto["name"];
                    $filetype = $foto["type"];
                    $filesize = $foto["size"];
                
                    // Verify file extension
                    $ext = pathinfo( $filename, PATHINFO_EXTENSION );
                    if(!array_key_exists($ext, $allowed)) { return "Selecione um formato de arquivo válido"; exit(); }
                
                    // Verify file size - 5MB maximum
                    $maxsize = 5 * 1024 * 1024;
                    if ( $filesize > $maxsize ) { return "O arquivo excedeu o limite"; exit(); }
                
                    // Verify MYME type of the file
                    if(in_array($filetype, $allowed)){
                        move_uploaded_file($foto["tmp_name"], "assets/animes/{$anime}/banner/" . $filename);
                        $dados_pessoais['Imagem_Destacada'] = $filename;

                    } else{
                        return "Ocorreu um problema ao upar o arquivo. Por favor tente novamente"; exit();
                    }

            }

            $this->db->where('CodiAnime', $codianime)
                ->update('tbl_animes', $dados_pessoais);
            return 1;
        }

        public function remove_animes($codianime) {
            $this->load->model('Selects_model', 'select');
            $query = $this->select->findById('Anime', 'tbl_animes', array('CodiAnime' => $codianime));

            if (PHP_OS === 'Windows' OR PHP_OS === 'WINNT' ) {
                exec(sprintf("rd /s /q %s", escapeshellarg("assets/animes/{$query[0]['Anime']}")));
            }
            else {
                exec(sprintf("rm -rf %s", escapeshellarg("assets/animes/{$query[0]['Anime']}")));
            }

            $query = $this->db->delete('tbl_animes', array('CodiAnime' => $codianime));
            if ( $query == true ) {
                return 1;
            }
            else {
                return 'Erro ao remover o anime!';
            }
        }
}