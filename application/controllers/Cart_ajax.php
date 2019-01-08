<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cart_ajax extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Cart_model');
		$this->load->library("cart");
	}

	public function index()
	{
		$data = array();
		$sanpham = $this->Cart_model->select();
		
		$data['sanpham'] = $sanpham;
		
		$this->load->view('Cart_ajax', $data, false);
	}
	function load(){
		$cart = $this->cart->contents();
		echo json_encode($cart);
	}
	function add($id){

		$data_one = $this->Cart_model->select_one($id);

		$data=array(
            "id" => $id,
            "name" => $data_one[0]['Tensp'],
            "qty" => "1",
            "price" => $data_one[0]['Dongia'],
            "option" => array(),
        );
		if($this->cart->insert($data)){
			$cart = $this->cart->contents();
			echo json_encode($cart);
			return false;
		}
		$cart = array('id' => $id, 'name'=>'quan');
		echo json_encode($cart);
	}

}

/* End of file Cart_ajax.php */
/* Location: ./application/controllers/Cart_ajax.php */