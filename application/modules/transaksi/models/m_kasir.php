<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_kasir extends CI_Model {

	function cekToCart($kode)
	{
		$this->db->where('kode_barang', $kode);
		$this->db->where('session', $this->session->userdata('transaksi'));
		return $this->db->get('transaksi_temp');
	}
	function getDtlBrgTtemp()
	{
		$this->db->where('session', $this->session->userdata('transaksi'));
		$this->db->join('barang', 'barang.kode_barang = transaksi_temp.kode_barang');
		$this->db->join('barang_brand', 'barang_brand.id_brand = barang.id_brand');
		$this->db->join('barang_harga', "barang_harga.kode_barang = barang.kode_barang and barang_harga.status='1'");
		$this->db->join('barang_diskon', "barang_diskon.kode_barang = barang.kode_barang and barang_diskon.status='1'", 'left');
		$this->db->select('barang.*,transaksi_temp.*,nama_brand,harga,diskon');
		return $this->db->get('transaksi_temp')->result();
	}
	function cekRowBrg($kode)
	{
		$this->db->join('barang_harga', "barang_harga.kode_barang = barang.kode_barang and status='1'");
		$this->db->where('barang.kode_barang', $kode);
		return $this->db->get('barang')->row();
	}
	function getmaxKode($jenis)
	{
		$year=date('Y');$month=date('m');
		$this->db->where('jenis', $jenis);
		$this->db->where('year(tgl_transaksi)', $year);
		$this->db->where('month(tgl_transaksi)', $month);
		$this->db->select_max('kode_transaksi');
		return $this->db->get('transaksi')->row();
	}
	function getDtl($session){
		$this->db->where('session', $session);
		return $this->db->get('transaksi_temp')->result();
	}
	function getTransaksi(){
		$this->db->where('transaksi.jenis', 'K');
		$this->db->where("date(tgl_transaksi) between '".$this->session->userdata('tgl_awal')."' and '".$this->session->userdata('tgl_akhir')."'");
		$this->db->join('user', 'user.username = transaksi.username');
		$this->db->order_by('tgl_transaksi', 'desc');
		return $this->db->get('transaksi')->result();
	}
	
}

/* End of file m_kasir.php */
/* Location: ./application/modules/transaksi/models/m_kasir.php */