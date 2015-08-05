<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barang extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_barang');
		$this->load->helper('kode');
	}
	public function index()
	{	
		$brd=$this->db->get('barang_brand')->result();
		$br['']="- Pilih Brand -";
		foreach($brd as $b){
			$br[$b->id_brand]=$b->nama_brand;
		}
		$data['brand']=$br;

		$jns=$this->db->get('barang_jenis')->result();
		$jj['']="- Pilih Jenis -";
		foreach($jns as $j){
			$jj[$j->kode_jenis]=$j->nama_jenis;
		}
		$data['jenis']=$jj;
		$data['value']=$this->getBrg($this->m_barang->lstBrg());
		$this->load->view('barang/page_index',$data);
	}
	function getBrg($brg)
	{		
		$arr=array();
		foreach($brg as $b){
			$data['kode_barang']=$b->kode_barang;
			$data['barcode']=$b->barcode;
			$data['nama_brand']=$b->nama_brand;
			$data['id_brand']=$b->id_brand;
			$data['nama_barang']=$b->nama_barang;
			$data['warna']=$b->warna;
			$data['ukuran']=$b->ukuran;
			$data['kode_jenis']=$b->kode_jenis;
			$data['stok']=$this->db->query("select (sum(masuk)-sum(keluar)) as jumlah from barang_stok where kode_barang='".$b->kode_barang."'")->row()->jumlah;
			$data['harga']=$this->db->query("select*from barang_harga where kode_barang='".$b->kode_barang."' and status='1'")->row()->harga;
			array_push($arr, (object)$data);
		}	
		return $arr;
	}
	function filter()
	{
		$array = array(
			'filter' => $this->input->post('jenis')
		);
		
		$this->session->set_userdata( $array );
	}
	function add()
	{	
		$jenis=$this->input->post('jenis');
		$kode=$this->kode($jenis);
		$br=$this->input->post('barcode');
		if($br==''){$br=$kode;}
		$data=array("kode_barang"=>$kode,
					"barcode"=>$br,
					"nama_barang"=>$this->input->post('nama_barang'),
					"warna"=>$this->input->post('warna'),
					"ukuran"=>$this->input->post('ukuran'),
					'id_brand'=>$this->input->post('brand'),
					'kode_jenis'=>$jenis);
		$this->db->insert('barang', $data); //insert barang

		$dtStok=array("masuk"=>$this->input->post('stok'),"kode_barang"=>$kode);
		$this->db->insert('barang_stok', $dtStok); //insert stok

		$dtHarga=array("harga"=>$this->input->post('harga'),
						"kode_barang"=>$kode,
						"status"=>1,
						"username"=>$this->session->userdata('username'),
						"date"=>date("Y-m-d H:i:s"));
		$this->db->insert('barang_harga', $dtHarga); //insert harga
		$this->session->set_flashdata('msg', "<div class='alert alert-success fade in'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button><strong>Barang baru berhasil ditambahkan</strong> .</div>");
	}
	function kode($jenis)
	{
		$max=$this->m_barang->getMax($jenis);
		if($max){
			$ex=explode('-', $max->kode_barang);
			$kode="B".$jenis."-".getCode(4,$ex[1]);
		}else{
			$kode="B".$jenis."-0001";
		}
		return $kode;
	}
	function dtUpdate($kode)
	{
		$this->db->where('kode_barang', $kode);
		$this->db->join('barang_brand', 'barang_brand.id_brand = barang.id_brand');
		$brg=$this->db->get('barang')->result();
		$data=$this->getBrg($brg);
		print_r(json_encode($data));
	}
	function edit()
	{
		$kode=$this->input->post('kode_barang');
		$br=$this->input->post('barcode');
		$stok=$this->input->post('stok');
		$harga=$this->input->post('harga');
		if($br==''){$br=$kode;}
		$data=array(
					"barcode"=>$br,
					"nama_barang"=>$this->input->post('nama_barang'),
					"warna"=>$this->input->post('warna'),
					"ukuran"=>$this->input->post('ukuran'),
					'id_brand'=>$this->input->post('brand'));
		$this->m_barang->updateBrg($kode,$data);

		$this->prosesHarga($kode,$harga);
		$this->prosesStok($kode,$stok);
		$this->session->set_flashdata('msg', "<div class='alert alert-success fade in'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button><strong>Data Barang berhasil diubah</strong> .</div>");
	}
	function prosesStok($kode,$stok)
	{
		$cek=$this->m_barang->cekStok($kode);
		if($cek<$stok){
			$hasil=$stok-$cek;
			$dtStok=array("masuk"=>$hasil,"kode_barang"=>$kode);
			$this->db->insert('barang_stok', $dtStok);
		}else if($cek>$stok){
			$hasil=$cek-$stok;
			$dtStok=array("keluar"=>$hasil,"kode_barang"=>$kode);
			$this->db->insert('barang_stok', $dtStok);
		}
	}
	function prosesHarga($kode,$harga)
	{
		$cek=$this->m_barang->cekHarga($kode);
		if($cek!=$harga){
			$this->db->where('kode_barang', $kode);
			$this->db->update('barang_harga', array('status'=>'0'));
			$dtHarga=array("harga"=>$harga,
							"kode_barang"=>$kode,
							"status"=>1,
							"username"=>$this->session->userdata('username'),
							"date"=>date("Y-m-d H:i:s"));
			$this->db->insert('barang_harga', $dtHarga);
		}
	}
	function del($kode)
	{
		$this->db->where('kode_barang', $kode);
		$this->db->delete('barang');

		$this->db->where('kode_barang', $kode);
		$this->db->delete('barang_harga');

		$this->db->where('kode_barang', $kode);
		$this->db->delete('barang_stok');
		$this->session->set_flashdata('msg', "<div class='alert alert-success fade in'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button><strong>Data Barang berhasil dihapus</strong> .</div>");
	}
}

/* End of file barang.php */
/* Location: ./application/modules/data/controllers/barang.php */