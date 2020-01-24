<?php
/**
 * Created by PhpStorm.
 * User: dutra
 * Date: 08/06/2019
 * Time: 22:10
 * Template padronizado
 */

Class Template {

    public function __construct()
    {
        $this->CI = &get_instance();
    }

    public function header($data = [])
    {
        $default = [];

        // warning Message
        if ($this->CI->session->has_userdata('warning')) {
            $default['warning'] = json_encode($this->CI->session->warning);
            $this->CI->session->unset_userdata('warning');
        }

        $data = array_merge($data, $default);


        return $this->CI->load->view('template/header', $data, TRUE);
    }

    public function navbar($data = [])
    {
        $logo_n = $this->CI->session->logo;
        $id_usuario = $this->CI->session->id_usuario;

        $logo = "/images/usuarios/{$id_usuario}/{$logo_n}";

        $default = [
            'logo' => base_url( (!empty($logo_n)) ? $logo : "/images/usuarios/no-user.png")
        ];

        $data = array_merge($data, $default);

        return $this->CI->load->view('template/navbar', $data, TRUE);
    }

    public function sidebar($data = [], $view = 'sidebar_painel')
    {
        $default = [
            'routes' => $this->build_menu()
        ];

        $data = array_merge($data, $default);

        return $this->CI->load->view("template/{$view}", $data, TRUE);
    }

    public function scripts($data = [])
    {
        $default = [];

        $data = array_merge($data, $default);

        return $this->CI->load->view('template/scripts', $data, TRUE);
    }

    public function heading($data = [])
    {
        $default = [];

        $data = array_merge($data, $default);

        return $this->CI->load->view('template/heading', $data, TRUE);
    }

    public function footer($data = [])
    {
        $default = [];

        $data = array_merge($data, $default);

        return $this->CI->load->view('template/footer', $data, TRUE);
    }

    private function build_menu()
    {
        $routes = $this->CI->session->routes;
        $menu = [];

        foreach ($routes as $r){
            // sub-menu
            if (is_null($r['id_parente'])) {
                $menu[$r['id']] = $r;
                $menu[$r['id']]['reference'] = str_replace(" ", "", $r['rotulo']) . $r['id'];
            }
        }

        foreach ($routes as $r) {
            // sub-menu
            if (intval($r['id_parente']) > 0) {
                $menu[$r['id_parente']]['submenu'][] = $r;
            }
        }

        #var_dump($menu);exit();

        return $menu;
    }

}
