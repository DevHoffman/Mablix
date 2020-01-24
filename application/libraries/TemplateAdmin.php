<?php

Class TemplateAdmin {

	public function __construct() {
		$this->CI = &get_instance();
	}

	public function header($data = [])
	{
		$default = [];

		$data = array_merge($data, $default);

		return $this->CI->load->view('admin/includes/header', $data, TRUE);
	}

	public function navbar($data = [])
	{

		$default = [];

		$data = array_merge($data, $default);

		return $this->CI->load->view('admin/includes/navbar', $data, TRUE);
	}

	public function sidebar($data = []) {
		$default = [];

		$data = array_merge($data, $default);

		return $this->CI->load->view("admin/includes/sidebar", $data, TRUE);
	}

	public function scripts($data = [])
	{
		$default = [];

		$data = array_merge($data, $default);

		return $this->CI->load->view('admin/includes/scripts', $data, TRUE);
	}

	public function heading($data = [])
	{
		$default = [];

		$data = array_merge($data, $default);

		return $this->CI->load->view('admin/includes/heading', $data, TRUE);
	}

	public function footer($data = [])
	{
		$default = [];

		$data = array_merge($data, $default);

		return $this->CI->load->view('admin/includes/footer', $data, TRUE);
	}

//	private function build_menu() {
//		$routes = $this->CI->session->routes;
//		$menu = [];
//
//		foreach ($routes as $r){
//			// sub-menu
//			if (is_null($r['id_parente'])) {
//				$menu[$r['id']] = $r;
//				$menu[$r['id']]['reference'] = str_replace(" ", "", $r['rotulo']) . $r['id'];
//			}
//		}
//
//		foreach ($routes as $r) {
//			// sub-menu
//			if (intval($r['id_parente']) > 0) {
//				$menu[$r['id_parente']]['submenu'][] = $r;
//			}
//		}
//
//		#var_dump($menu);exit();
//
//		return $menu;
//	}

}
