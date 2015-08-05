<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Brand extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_brand');
	}
	public function index()
	{
		$data['value']=$this->db->get('barang_brand')->result();
		$this->load->view('brand/page_index',$data);
	}
	function add()
	{
		$this->db->insert('barang_brand', array('nama_brand'=>$this->input->post('nama_brand')));
		$this->session->set_flashdata('msg', "<div class='alert alert-success fade in'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button><strong>Brand baru berhasil ditambahkan</strong> .</div>");
	}
	function del($id)
	{
		$this->db->where('id_brand', $id);
		$this->db->delete('barang_brand');
		$this->session->set_flashdata('msg', "<div class='alert alert-success fade in'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button><strong>Data Brand berhasil dihapus</strong> .</div>");
	}
	function edit(){
		$this->db->where('id_brand', $this->input->post('id_brand'));
		$this->db->update('barang_brand', array('nama_brand'=>$this->input->post('nama_brand')));
		$this->session->set_flashdata('msg', "<div class='alert alert-success fade in'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button><strong>Data Brand berhasil diubah</strong> .</div>");
	}
}

/* End of file brand.php */
/* Location: ./application/modules/data/controllers/brand.php */