<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kasir extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_kasir');
		$this->load->helper('string');
		$this->load->helper('kode');
	}
	public function index()
	{
		$data['as']='';
		$data['value']=$this->m_kasir->getTransaksi();
		$this->load->view('kasir/page_index',$data);
	}
	function form_tambah()
	{
		$data['value']=$this->m_kasir->getDtlBrgTtemp();
		$this->load->view('kasir/page_transaksi',$data);
	}
	function setRangePicker(){
		$date=explode('-', $this->input->post('date-range-picker'));
		$array = array(
			'tgl_awal' => $this->changedate($date[0]),
			'tgl_akhir'=>$this->changedate($date[1])
		);
		
		$this->session->set_userdata( $array );
	}
	function changedate($date){
		$ex=explode('/', trim($date));
		return $ex[2].'-'.$ex[0].'-'.$ex[1];
	}
	function setSession()
	{
		$array = array(
			'transaksi' => random_string('alnum', 16)
		);
		
		$this->session->set_userdata( $array );
	}
	function insert_temp($kode)
	{
		$kdbrg=$this->m_kasir->cekRowBrg($kode);
		$cek=$this->m_kasir->cekToCart($kode);
		if($cek->num_rows()==0){
			$data=array('session'=>$this->session->userdata('transaksi'),
					'kode_barang'=>$kode,
					'id_harga'=>$kdbrg->id_harga,
					'qty'=>'1');
			$this->db->insert('transaksi_temp', $data);
		}else{
			$qty=$cek->row()->qty+1;
			$this->db->where('kode_barang', $kode);
			$this->db->where('session', $this->session->userdata('transaksi'));
			$this->db->update('transaksi_temp', array('qty'=>$qty));
		}		
	}
	function delTempBrg($kode)
	{
		$this->db->where('kode_barang', $kode);
		$this->db->where('session', $this->session->userdata('transaksi'));
		$this->db->delete('transaksi_temp');
	}
	function cekKodeBrg($kode)
	{
		$this->db->where('kode_barang', $kode);
		echo $this->db->get('barang')->num_rows();
	}
	function qtyUpdate()
	{
		$data=array('qty'=>$this->input->post('qty'));
		$this->db->where('session', $this->session->userdata('transaksi'));
		$this->db->where('kode_barang', $this->input->post('kode_barang'));
		$this->db->update('transaksi_temp', $data);	
	}
	function simpan_transaksi()
	{
		$kode=$this->kode('K');echo $kode;
		$data=array('kode_transaksi'=>$kode,
					'tgl_transaksi'=>date('Y-m-d H:i:s'),
					'tunai'=>$this->input->post('tunai'),
					'username'=>$this->session->userdata('username'),
					'jenis'=>'K');
		$this->db->insert('transaksi', $data);
		$temp=$this->m_kasir->getDtl($this->session->userdata('transaksi'));
		if($temp){
			$arr=array();
			foreach($temp as $t){
				$dta=array('kode_barang'=>$t->kode_barang,
							'qty'=>$t->qty,
							'id_harga'=>$t->id_harga,
							'id_diskon'=>$t->id_diskon,
							'kode_transaksi'=>$kode);
				array_push($arr, $dta);

				$this->db->where('session', $this->session->userdata('transaksi'));
				$this->db->where('kode_barang', $t->kode_barang);
				$this->db->delete('transaksi_temp');
			}
			$this->db->insert_batch('transaksi_dtl', $arr);
		}
	}
	function kode($jenis) //jenis = masuk / keluar
	{
		$year=date('y');$month=date('m');
		$max=$this->m_kasir->getmaxKode($jenis);
		//echo $max->num_rows();
		//print_r($max);
		if($max->kode_transaksi!=null){
			$ex=explode('-', $max->kode_transaksi);
			$kode="TR".$jenis."-".getCode(3,$ex[1]);
		}else{			
			$kode="TR".$jenis."-".$year.$month."001";
		}
		return $kode;
	}
	function delTempTransaksi(){
		$this->db->where('session', $this->session->userdata('transaksi'));
		$this->db->delete('transaksi_temp');
	}
}

/* End of file kasir.php */
/* Location: ./application/modules/transaksi/controllers/kasir.php */