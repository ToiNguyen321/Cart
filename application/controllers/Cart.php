<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cart extends CI_Controller {

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
		$cart = $this->cart->contents();
		$data['sanpham'] = $sanpham;
		$data['cart'] = $cart;
		$this->load->view('index', $data, false);
	}
	function addtocart($id){
		$data_one = $this->Cart_model->select_one($id);
		

		$data=array(
            "id" => $id,
            "name" => $data_one[0]['Tensp'],
            "qty" => "1",
            "price" => $data_one[0]['Dongia'],
            "option" => array(),
        );

        // Them san pham vao gio hang
        if($this->cart->insert($data)){
        	$data2=$this->cart->contents();
  //       echo "<pre>";
		// var_dump($data2['c4ca4238a0b923820dcc509a6f75849b']);
		// echo "</pre>";
             redirect(base_url('Cart'),'refresh');
        }else{

        }

	}
	function deletetocart($id){
		$data=$this->cart->contents();
		foreach ($data as $item) {
			if($item['id'] == $id){
				$dele_one = array("rowid" => $item['rowid'], "qty" => 0);
			}
		}
		if($this->cart->update($dele_one)){
			redirect(base_url('Cart'),'refresh');
		}
	}
	function deleteallcart(){
		$this->cart->destroy();
		redirect(base_url('Cart'),'refresh');
	}
	function update(){
		$qty = array();
		$qty = $this->input->post('SoLuong');
		$data=$this->cart->contents();
		foreach ($data as $item) {
			$id = $item['id'];
			$qty_sp = $qty[$id];
			$dele_one = array("rowid" => $item['rowid'], "qty" => $qty_sp);
			$this->cart->update($dele_one);
		}
		redirect(base_url('Cart'),'refresh');
	}
	function trang($id = 0){
		if($id == 0){
			redirect(base_url('Cart'),'refresh');
		}else{
			$data = array();
			$sanpham = $this->Cart_model->trang($id);
			$total = $this->Cart_model->total();
			$cart = $this->cart->contents();
			$data['sanpham'] = $sanpham;
			$data['total'] = $total;
			$data['cart'] = $cart;
			$this->load->view('index', $data, false);
		}
	}
}	

/* End of file Cart.php */
/* Location: ./application/controllers/Cart.php */