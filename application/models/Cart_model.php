<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cart_model extends CI_Model {


	public function __construct()
	{
		parent::__construct();
		
	}
	function select(){
		
		$this->db->select('*');
		$data = $this->db->get('SanPham');
		$data = $data->result_array();
		return $data;
	}
	function select_one($id){
		$this->db->select('*');
		$this->db->where('Masp', $id);
		$data_one = $this->db->get('SanPham');
		$data_one = $data_one->result_array();
		return $data_one;
	}
	function trang($id){
		$this->db->select('*');
		$data = $this->db->get('SanPham',2, ($id*2-2));
		$data = $data->result_array();
		return $data;
	}
	function total(){
		$this->db->select('*');
		$data = $this->db->get('SanPham');
		$total = $data->num_rows();
		return ceil($total/2);
	}

}

/* End of file SanPham.php */
/* Location: ./application/models/SanPham.php */