<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_supplier extends CI_Model {

	function getDt()
	{
		return $this->db->get('supplier')->result();
	}
	function getMax()
	{
		$this->db->select_max('kode_supplier');
		return $this->db->get('supplier')->row();
	}
}

/* End of file m_supplier.php */
/* Location: ./application/modules/data/models/m_supplier.php */