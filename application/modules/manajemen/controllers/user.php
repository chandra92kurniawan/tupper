<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_user');
    }
	public function index()
	{
        $jb=$this->db->query('select*from adm_role where id_role !="1"')->result();
        $jbt['']="- Pilih Jabatan -";
        foreach($jb as $j){
            $jbt[$j->id_role]=$j->nama_role;
        }
        $data['jbt']=$jbt;
        $data['value']=$this->m_user->getDtUser();
		$this->load->view('user/page_index',$data);
	}
	function add()
    {
        $str = do_hash($this->input->post('password1'), 'md5');
        $user=$this->input->post('username');
        $data=array("username"=>$this->input->post('username'),
                    "nama_user"=>$this->input->post('nama_lengkap'),
                    'password'=>$str,
                    'id_role'=>$this->input->post('jabatan'),
                    'status'=>1,
                    'no_telepon'=>$this->input->post('no_telepon'),
                    'alamat'=>$this->input->post('alamat'));
        $this->db->insert('user', $data);
       $this->session->set_flashdata('msg', "<div class='alert alert-success fade in'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button><strong>User baru berhasil ditambahkan</strong> .</div>");
    }
    function cekUser($user){
        $this->db->where('username', $user);
        $number=$this->db->get('user')->num_rows();
        echo $number;
    }
    function setStatus($status,$user){
        $this->db->where('username', $user);
        $this->db->update('user', array('status'=>$status));
    }
    function dtUpdate($user){
        $this->db->where('username', $user);
        $dt=$this->db->get('user')->row();
        print_r(json_encode($dt));
    }
    function edit()
    {
       $data=array(
                    "nama_user"=>$this->input->post('nama_lengkap'),
                    
                    'id_role'=>$this->input->post('jabatan'),
                    
                    'no_telepon'=>$this->input->post('no_telepon'),
                    'alamat'=>$this->input->post('alamat'));
       $this->db->where('username', $this->input->post('username'));
       $this->db->update('user', $data);
       $this->session->set_flashdata('msg', "<div class='alert alert-success fade in'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button><strong>Data user berhasil diubah</strong> .</div>");
    }
    function getCode()
    {
       $str = do_hash("administrator", 'md5');
       echo $str; 
    }
    function cekPassAksi($pass){
        $pass=do_hash($pass, 'md5');
        $this->db->where('aksi_code', $pass);
        $v=$this->db->get('aksi_code')->num_rows();
        echo $v;
    }
    function delUser($user){
        $this->db->where('username', $user);
        $this->db->delete('user');
    }
    function data_bank()
    {
       
    }
}

/* End of file user.php */
/* Location: ./application/modules/manajemen/controllers/user.php */