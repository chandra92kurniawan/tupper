<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_user extends CI_Model {
	function getDtUser(){
		$this->db->where('user.id_role !=','1');
		$this->db->join('adm_role', 'adm_role.id_role = user.id_role');
		return $this->db->get('user')->result();
	}
	

}

/* End of file m_user.php */
/* Location: ./application/modules/manajemen/models/m_user.php */