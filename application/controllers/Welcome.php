<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('karmanta/page_header');
		//$this->load->view('karmanta/page_index');
		$this->load->view('karmanta/page_footer');
	}
	public function index2()
	{
		$data['bread']=(object)array('lv1'=>'home','lv2'=>'dashboard');
		$this->load->view('template/header');
		$this->load->view('template/left_menu');
		//$this->load->view('template/breadcrumb',$data);
		//$this->load->view('template/page'); //coding page
		$this->load->view('template/footer');
	}

}
