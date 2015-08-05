<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Menu extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_menu');
		
	}
	public function index()
	{
		$data['judul']="Menu";
		$head=$this->m_menu->getHead();
		$m['']="- Sebagai Head -";
		foreach($head as $menu)
		{
			$m[$menu->id_menu]=$menu->nama_menu;
		}
		$data['menu']=$m;
		$data['list']=$this->m_menu->getMenu();
		$data['bread']=(object)array('lv1'=>'home','lv2'=>'dashboard');
		$this->load->view('page_index', $data);
		//$this->load->view('page_index', $data);
	}
	function add()
	{	$mn=$this->input->post('menu');
		if(empty($mn)){
			$menu=0;
		}else{
			$menu=$mn;
		}
		$data=array("nama_menu"=>$this->input->post('nama'),
					"icon"=>$this->input->post('icon'),
					"controllers"=>$this->input->post('controller'),
					"function"=>$this->input->post('function'),
					"sub"=>$menu
					);
		$this->db->insert('adm_menu', $data);
		$this->session->set_flashdata('msg', "<div class='alert alert-warning fade in'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button><strong>Menu baru berhasil ditambahkan</strong> .</div>");
		//redirect("menu");
	}
	function edit()
	{	$mn=$this->input->post('menu');
		if(empty($mn)){
			$menu=0;
		}else{
			$menu=$mn;
		}
		$id=$this->input->post('id');
		$data=array("nama_menu"=>$this->input->post('nama'),
					"icon"=>$this->input->post('icon'),
					"controllers"=>$this->input->post('controller'),
					"function"=>$this->input->post('function'),
					"sub"=>$menu
					);
		$this->m_menu->update($data,$id);
		$this->session->set_flashdata('msg', "<div class='alert alert-warning fade in'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button><strong>Menu berhasil diubah</strong> .</div>");
		redirect("menu");
	}
	function hapus($id)
	{
		if($this->m_menu->delete($id)){
			echo "berhasil";
		}else{
			echo "gagal";
		}
		$this->session->set_flashdata('msg', "<div class='alert alert-warning fade in'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button><strong>Menu berhasil dihapus</strong> .</div>");
		//redirect("menu");
	}
}

/* End of file menu.php */
/* Location: ./application/modules/menu/controllers/menu.php */