<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Supplier extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_supplier');
		$this->load->helper('kode');
	}
	public function index()
	{
		$data['value']=$this->m_supplier->getDt();
		$this->load->view('supplier/page_index', $data);
	}
	function add()
	{
		$kode=$this->getKode();
		$data=array("kode_supplier"=>$kode,
					"nama_supplier"=>$this->input->post('nama_perusahaan'),
					"alamat_supplier"=>$this->input->post('alamat'),
					"nama_kontak"=>$this->input->post('nama_kontak'),
					"no_kontak"=>$this->input->post('no_kontak'));
		$this->db->insert('supplier', $data);
		$this->session->set_flashdata('msg', "<div class='alert alert-success fade in'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button><strong>Supplier baru berhasil ditambahkan</strong> .</div>");
	}
	function getKode()
	{
		$data=$this->m_supplier->getMax();
		if($data){
			$ex=explode('-', $data->kode_supplier);
			$kode="S-".getCode(3,$ex[1]);
		}else{
			$kode="S-001";
		}
		
		return $kode;
	}
	function dtUpdate($user)
	{
		$this->db->where('kode_supplier', $user);
		$v=$this->db->get('supplier')->row();
		print_r(json_encode($v));
	}
	function edit()
	{
		$data=array(
					"nama_supplier"=>$this->input->post('nama_perusahaan'),
					"alamat_supplier"=>$this->input->post('alamat'),
					"nama_kontak"=>$this->input->post('nama_kontak'),
					"no_kontak"=>$this->input->post('no_kontak'));
		$this->db->where('kode_supplier', $this->input->post('kode_perusahaan'));
		$this->db->update('supplier', $data);
		$this->session->set_flashdata('msg', "<div class='alert alert-success fade in'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button><strong>Data Supplier berhasil diubah</strong> .</div>");
	}
	function del($kode)
	{
		$this->db->where('kode_supplier', $kode);
		$this->db->delete('supplier');
		$this->session->set_flashdata('msg', "<div class='alert alert-success fade in'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button><strong>Data Supplier berhasil dihapus</strong> .</div>");
	}
}

/* End of file supplier.php */
/* Location: ./application/modules/data/controllers/supplier.php */