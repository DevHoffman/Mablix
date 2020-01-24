<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    public function autenticate($login, $senha) {

        $query = $this->db->get_where('tbl_usuarios', array('Login' => $login), 1, 0);
        if ( $query->num_rows() == 1 ){
            $hash_senha_banco = $query->result_array()[0]['Senha'];
            if(password_verify($senha, $hash_senha_banco)) {
                $query = $this->db->get_where('tbl_usuarios', array('Login' => $login, 'Senha' => $hash_senha_banco), 1, 0);
                if ( $query->num_rows() == 1 ){
					$dados_autenticacao = array(
						'Ip' 			=> 		$_SERVER['REMOTE_ADDR'],
						'Logged_in' 	=> 		TRUE,
						'CodiUsuario'	=>		$query->result_array()[0]['CodiUsuario']
					);
					$this->session->set_userdata($dados_autenticacao); // Pega dados para Sessão

                	$dados_pessoais = array(
                		'Log' 			=> 		'Usuário Autenticado',
						'CodiUsuario' 	=>	 	$query->result_array()[0]['CodiUsuario'],
						'Ip' 			=>	 	$_SERVER['REMOTE_ADDR']
					);
					$this->db->insert('tbl_logs', $dados_pessoais);
					return 1;
                }
                else { 
                    return 'Senha Incorreta';
                }   
            }
            else {
                return 'Senha Incorreta';
            }
        }
        else {
            return 'Login Incorreto';
        }
    }

    public function create_account($login, $senha, $senha2, $name = NULL, $email = NULL) { // Conta não existe, devo inserir
        if ( $senha == $senha2 ){

            $senha = password_hash($senha, PASSWORD_DEFAULT);

            $dados_pessoais = array(
                'Usuario'   =>  $name, 
                'Email'     =>  $email,
                'Login'     =>  $login,
                'Senha'     =>  $senha
            );

            $query = $this->db->get_where('tbl_usuarios', array('Login' => $login), 1, 0);
            
            if ( $query->num_rows() == 0 ){
                $this->db->insert('tbl_usuarios', $dados_pessoais); 
                return 1;
            }
            else {
                return 'Esse login já existe';
            }

        }
        else {
            return 'As senhas devem ser iguais';
        }
    }
    
}
