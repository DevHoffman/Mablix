<?php namespace App\Controllers;

class Home extends BaseController
{
	public function index()
	{
		echo esc($baseURL);
		$data = [
            'page_title' 	=> 'Busicol',
            'header' 		=> 	view('template/header'),
            'sidebar' 		=> 	view('template/sidebar'),
            'footer' 		=> 	view('template/footer'),
            'scripts' 		=> 	view('template/scripts')
        ];

		return view('main', $data);
	}

	//--------------------------------------------------------------------

}
