<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Garansi extends CI_Controller {

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
		$this->load->helper('url');
		$this->load->model('merk_model');
		$this->load->model('garansi_model');
	}

	public function index()
	{
		$data['garansi'] = $this->garansi_model->get_data()->result();
		
		$this->load->view('main/navbar_view.php');
		$this->load->view('main/sidebar_view.php');
		$this->load->view('garansi_view.php',$data);
		
	}

	public function input_garansi()
	{
		if ($_POST['garansi']=='') {
			redirect(base_url().'garansi');
		}
		$garansi_data = array('garansi' => $_POST['garansi']);

		$this->garansi_model->insert_data($garansi_data);
		redirect(base_url().'garansi');
		
	}

	function delete(){
		$id = $_GET['id_garansi'];
		$where = array('id_garansi' => $id);
		$this->garansi_model->delete($where,'garansi');
		redirect(base_url().'garansi');
	}
 
	function edit(){
		$id = $_GET['id_garansi'];
		$where = array('id_garansi' => $id);
		$data['garansi'] = $this->garansi_model->edit($where,'garansi')->result();
		$this->load->view('main/navbar_view.php');
		$this->load->view('main/sidebar_view.php');
		$this->load->view('garansi_view.php',$data);
	}

	function update(){
		$id_garansi = $this->input->post('id_garansi');
		$garansi = $this->input->post('garansi');
		
		$data = array(
			'garansi' => $garansi,
		);

		$where = array(
			'id_garansi' => $id_garansi
		);

		$this->garansi_model->update($where,$data,'garansi');
		redirect(base_url().'garansi');
	}
}
