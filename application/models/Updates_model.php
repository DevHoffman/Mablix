<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Updates_model extends CI_Model {

	function __construct() {
		parent::__construct();
	}

	public function update_perfil($id_usuario, $name, $email, $login, $senha = NULL, $senha2 = NULL, $foto = NULL) {
        $query = $this->db->get_where('tbl_usuarios', array('CodiUsuario <>' => $id_usuario, 'Login' => $login));
        if ( $query->num_rows() == 1 ){
        	return 'Este login já existe, tente outro';
        }
        else {

			if ( $senha == $senha2 ) {

				$dados_pessoais = array(
					'Usuario'   =>  $name,
					'Email'     =>  $email,
					'Login'     =>  $login,
				);

				if ( !empty($senha) ){
					$senha = password_hash($senha, PASSWORD_DEFAULT);
					$dados_pessoais['Senha'] = $senha;
				}

				if ( isset($foto) && $foto["error"] == 0 ){

			        $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
			        $filename = $foto["name"];
			        $filetype = $foto["type"];
			        $filesize = $foto["size"];
			    
			        // Verify file extension
			        $ext = pathinfo( $filename, PATHINFO_EXTENSION );
			        if(!array_key_exists($ext, $allowed)) { return "Selecione um formato de arquivo valido"; exit(); }
			    
			        // Verify file size - 5MB maximum
			        $maxsize = 5 * 1024 * 1024;
			        if ( $filesize > $maxsize ) { return "O arquivo excedeu o limite"; exit(); }
			    
			        // Verify MYME type of the file
			        if(in_array($filetype, $allowed)){

			          	move_uploaded_file($foto["tmp_name"], "assets/images/avatars/" . $filename);

			          	$dados_pessoais['Foto'] = $filename;

			        } else{
			            return "Ocorreu um problema ao upar o arquivo. Por favor tente novamente"; exit();
			        }

			    }

				$query = $this->db->where('CodiUsuario', $id_usuario)
					->update('tbl_usuarios', $dados_pessoais);
				if ( $query == true ) {
					return 1;
				}
				else {
					return 'Não foi possível alterar, tente novamente';
				}
			}
			else {
				return 'As senhas devem ser iguais';
			}

        }
	}
	
}
