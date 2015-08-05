<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Diskon extends CI_Controller {

	public function index()
	{
		$data['value']=$this->db->get('diskon')->result();
		$this->load->view('diskon/page_index', $data);
	}
	function add()
	{
		$this->db->insert('diskon', array('diskon'=>$this->input->post('jumlah')));
		$this->session->set_flashdata('msg', "<div class='alert alert-success fade in'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button><strong>Format diskon baru berhasil ditambahkan</strong> .</div>");
	}
}

/* End of file diskon.php */
/* Location: ./application/modules/manajemen/controllers/diskon.php */