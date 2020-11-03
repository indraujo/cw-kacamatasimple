<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Testimoni extends CI_Controller {

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
		$this->load->model('testimoni_model');
	}

	public function index()
	{
		$data['testimoni'] = $this->testimoni_model->get_data()->result();
		
		$this->load->view('main/navbar_view.php');
		$this->load->view('main/sidebar_view.php');
		$this->load->view('testimoni_view.php',$data);
		
	}

	public function input_testimoni()
	{
		if ($_POST['testimoni']=='') {
			redirect(base_url().'testimoni');
		}
		$testimoni_data = array('testimoni' => $_POST['testimoni']);

		$this->testimoni_model->insert_data($testimoni_data);
		redirect(base_url().'testimoni');
		
	}

	function delete(){
		$id = $_GET['id_testimoni'];
		$where = array('id_testimoni' => $id);
		$this->testimoni_model->delete($where,'testimoni');
		redirect(base_url().'testimoni');
	}
 
	function edit(){
		$id = $_GET['id_testimoni'];
		$where = array('id_testimoni' => $id);
		$data['testimoni'] = $this->testimoni_model->edit($where,'testimoni')->result();
		$this->load->view('main/navbar_view.php');
		$this->load->view('main/sidebar_view.php');
		$this->load->view('testimoni_view.php',$data);
	}

	function update(){
		$id_testimoni = $this->input->post('id_testimoni');
		$testimoni = $this->input->post('testimoni');
		
		$data = array(
			'testimoni' => $testimoni,
		);

		$where = array(
			'id_testimoni' => $id_testimoni
		);

		$this->testimoni_model->update($where,$data,'testimoni');
		redirect(base_url().'testimoni');
	}
}
