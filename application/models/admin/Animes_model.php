<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Animes_model extends CI_Model {

        function __construct() {
                parent::__construct();
                $this->load->helper('date');
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

                        date_default_timezone_set('America/Sao_Paulo');

                        $ano = date('Y', time());
                        $mes = date('m', time());
                        $data = date('HmidmY', time());
                
                        if ( !is_dir("assets/animes/{$ano}/{$mes}/imagem_destacada") ) {
                            mkdir("assets/animes/{$ano}/{$mes}/imagem_destacada", 0777, true);
                        }

                        if ( !is_dir("assets/animes/{$ano}/{$mes}/video") ) {
                            mkdir("assets/animes/{$ano}/{$mes}/video", 0777, true);
                        }

                        $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
                        $filename = $data . '-' . $foto["name"];
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
                            $filename = "{$ano}/{$mes}/imagem_destacada/" . $filename;
                            move_uploaded_file($foto["tmp_name"], "assets/animes/" . $filename);
                            $dados_pessoais['Imagem_Destacada'] = $filename;
                        } else{
                            return "Ocorreu um problema ao upar o arquivo. Por favor tente novamente"; exit();
                        }
                }
                else {
                    return 'Imagem do Anime é necessária';
                }

                $this->db->insert('tbl_animes', $dados_pessoais);
                return 1;
        }

        public function update_animes($codianime, $anime, $codicategoria, $descricao, $texto = NULL, $foto, $trailer = NULL) {

            if ( empty($codianime) ) { return 'Este anime não existe.'; }
            if ( empty($anime) ) { return 'Campo título é necessário.'; }
            if ( empty($codicategoria) ) { return 'Campo categoria é necessário.'; }
            if ( empty($descricao) ) { return 'Campo descrição é necessário.'; }

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

                date_default_timezone_set('America/Sao_Paulo');

                $ano = date('Y', time());
                $mes = date('m', time());
                $data = date('HmidmY', time());
        
                if ( !is_dir("assets/animes/{$ano}/{$mes}/imagem_destacada") ) {
                    mkdir("assets/animes/{$ano}/{$mes}/imagem_destacada", 0777, true);
                }

                if ( !is_dir("assets/animes/{$ano}/{$mes}/video") ) {
                    mkdir("assets/animes/{$ano}/{$mes}/video", 0777, true);
                }

                $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
                $filename = $data . '-' . $foto["name"];
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
                    $filename = "{$ano}/{$mes}/imagem_destacada/" . $filename;
                    move_uploaded_file($foto["tmp_name"], "assets/animes/" . $filename);
                    $dados_pessoais['Imagem_Destacada'] = $filename;
                } else{
                    return "Ocorreu um problema ao upar o arquivo. Por favor tente novamente"; exit();
                }
            }

            $query = $this->db->where('CodiAnime', $codianime)
                ->update('tbl_animes', $dados_pessoais);
            if ( $query == true ){
                return 1;
            }
            else {
                return 'Erro ao atualizar o anime';
            }
        }

        public function remove_animes($codianime) {
            $query = $this->db->delete('tbl_animes', array('CodiAnime' => $codianime));
            if ( $query == true ) {
                return 1;
            }
            else {
                return 'Erro ao remover o anime!';
            }
        }
}