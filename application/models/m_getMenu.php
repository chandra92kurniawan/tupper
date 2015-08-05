<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_getMenu extends CI_Model {

	function getMenu($role,$sub){
		$this->db->where('id_role', $role);
		$this->db->where('sub', $sub);
		$this->db->where('status', '1');
		$this->db->join('adm_akses', 'adm_akses.id_menu = adm_menu.id_menu');
		return $this->db->get('adm_menu');
	}	
	function getSubMenu($role,$sub){
		//$this->db->where('adm_akses.id_menu', $id_menu);
		$this->db->where('id_role', $role);
		$this->db->where('sub', $sub);
		$this->db->where('status', '1');
		$this->db->join('adm_akses', 'adm_akses.id_menu = adm_menu.id_menu');
		return $this->db->get('adm_menu');
	}
}

/* End of file m_getMenu.php */
/* Location: ./application/models/m_getMenu.php */