<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	function __construct() {
	parent::__construct();

	//  Path to simple_html_dom
	//include APPPATH . 'third_party/clipboard.js/dist/clipboard.min.js';
		if($this->session->userdata('status') != "login"){
			redirect(base_url("login"));
		}
		$this->load->helper('url', 'form');
		//$this->load->model('merk_model');
		$this->load->model('product_model');

		//load Helper for Form
		$this->load->library('form_validation');

	}

	public function index()
	{
		$data['product'] = $this->product_model->get_data()->result();
		
		$this->load->view('main/navbar_view.php');
		$this->load->view('main/sidebar_view.php');
		$this->load->view('product_view.php',$data);
		
	}

	public function input_product(){
		if ($_POST['product_name']=='') {
			redirect(base_url().'product');
		}
		
		$product_data = array(
			'product_name' => $_POST['product_name'], 
			'product_desc' => $_POST['product_desc'],
			'product_price' => $_POST['product_price'],
			'product_image' => $_POST['product_image']		
		);
		
		$this->product_model->insert_data($product_data);
		//redirect(base_url().'product');
		
	}

	function delete(){
		$id = $_GET['product_id'];
		$where = array('product_id' => $id);
		$this->product_model->delete($where,'product');
		redirect(base_url().'product');
	}
 
	function edit(){
		$id = $_GET['product_id'];
		$where = array('product_id' => $id);
		$data['product'] = $this->product_model->edit($where,'product')->result();
		$this->load->view('main/navbar_view.php');
		$this->load->view('main/sidebar_view.php');
		$this->load->view('product_view.php',$data);
	}

	function update(){
		$id_alasan = $this->input->post('product_id');
		$product = $this->input->post('product');
		
		$data = array(
			'product' => $product,
		);

		$where = array(
			'product_id' => $product_id
		);

		$this->product_model->update($where,$data,'product');
		redirect(base_url().'alasan');
	}
}
