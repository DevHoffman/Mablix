<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Episodios_model extends CI_Model {

        function __construct() {
                parent::__construct();
        }

        public function create_episodios($episodio, $codianime, $anime, $video, $foto) {

                if ( empty($episodio) ) { return 'Campo título é necessário.';  }
                if ( empty($video) ) { return 'Campo video é necessário.';  }

                $dados_pessoais = array(
                        'Titulo'         =>      $episodio,
                        'CodiAnime' =>      $codianime,
                        'Video' =>      $video,
                );

                if ( !empty($foto) && $foto["error"] == 0 ){

                    date_default_timezone_set('America/Sao_Paulo');

                    $ano = date('Y', time());
                    $mes = date('m', time());
                    $data = date('HmidmY', time());
            
                    if ( !is_dir("assets/animes/episodios/{$ano}/{$mes}/imagem_destacada") ) {
                        mkdir("assets/animes/episodios/{$ano}/{$mes}/imagem_destacada", 0777, true);
                    }

                    if ( !is_dir("assets/animes/episodios/{$ano}/{$mes}/video") ) {
                        mkdir("assets/animes/episodios/{$ano}/{$mes}/video", 0777, true);
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
                        move_uploaded_file($foto["tmp_name"], "assets/animes/episodios/" . $filename);
                        $dados_pessoais['Imagem_Destacada'] = $filename;
                    } else{
                        return "Ocorreu um problema ao upar o arquivo. Por favor tente novamente"; exit();
                    }
                }
                else {
                    return 'Imagem do episódio é necessária';
                }

                $this->db->insert('tbl_episodios', $dados_pessoais);
                return 1;
        }

        public function update_episodios($codiepisodio, $titulo, $codianime, $anime, $video, $foto) {

            if ( empty($titulo) ) { return 'Campo título é necessário.';  }
            if ( empty($video) ) { return 'Campo video é necessário.';  }

            $dados_pessoais = array(
                    'Titulo'         =>      $titulo,
                    'CodiAnime' =>      $codianime,
                    'Video' =>      $video,
            );

            if ( !empty($foto) && $foto["error"] == 0 ){

                date_default_timezone_set('America/Sao_Paulo');

                $ano = date('Y', time());
                $mes = date('m', time());
                $data = date('HmidmY', time());
        
                if ( !is_dir("assets/animes/episodios/{$ano}/{$mes}/imagem_destacada") ) {
                    mkdir("assets/animes/episodios/{$ano}/{$mes}/imagem_destacada", 0777, true);
                }

                if ( !is_dir("assets/animes/episodios/{$ano}/{$mes}/video") ) {
                    mkdir("assets/animes/episodios/{$ano}/{$mes}/video", 0777, true);
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
                    move_uploaded_file($foto["tmp_name"], "assets/animes/episodios/" . $filename);
                    $dados_pessoais['Imagem_Destacada'] = $filename;
                } else{
                    return "Ocorreu um problema ao upar o arquivo. Por favor tente novamente"; exit();
                }
            }

            // var_dump($dados_pessoais); exit();

            $this->db->where('CodiEpisodio', $codiepisodio)
            ->update('tbl_episodios', $dados_pessoais);
            return 1;
        }

        public function remove_episodios($codiepisodio) {
            $this->load->model('Query_posts_model', 'query');
            $query = $this->query->findByIdEpisodio($codiepisodio);

            if (PHP_OS === 'Windows' OR PHP_OS === 'WINNT' ) {
                exec(sprintf("rd /s /q %s", escapeshellarg("assets/animes/{$query[0]['Anime']}/{$query[0]['Titulo']}")));
            }
            else {
                exec(sprintf("rm -rf %s", escapeshellarg("assets/animes/{$query[0]['Anime']}/{$query[0]['Titulo']}")));
            }

            $query = $this->db->delete('tbl_episodios', array('CodiEpisodio' => $codiepisodio));
            if ( $query == true ) {
                return 1;
            }
            else {
                return 'Erro ao remover o anime!';
            }
        }
}