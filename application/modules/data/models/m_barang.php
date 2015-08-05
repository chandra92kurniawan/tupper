<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_barang extends CI_Model {
	function getMax($jenis)
	{
		$this->db->select_max('kode_barang');
		$this->db->where('kode_jenis', $jenis);
		return $this->db->get('barang')->row();
	}
	function lstBrg(){
		//$this->db->query('select*from barang a join barang_brand b on a.id_brand=b.id_brand')->result()
		$filter=$this->session->userdata('filter');
		if($filter!==''){
			$this->db->where('kode_jenis', $filter);
		}
		$this->db->join('barang_brand', 'barang_brand.id_brand = barang.id_brand');
		return $this->db->get('barang')->result();
	}
	function updateBrg($kode,$data)
	{
		$this->db->where('kode_barang', $kode);
		$this->db->update('barang', $data);
	}
	function cekHarga($kode)
	{
		$this->db->where('status', '1');
		$this->db->where('kode_barang', $kode);
		return $this->db->get('barang_harga')->row()->harga;
	}
	function cekStok($kode)
	{
		return $this->db->query("select (sum(masuk)-sum(keluar)) as jumlah from barang_stok where kode_barang='".$kode."'")->row()->jumlah;
	}
}

/* End of file m_barang.php */
/* Location: ./application/modules/data/models/m_barang.php */