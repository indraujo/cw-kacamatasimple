<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Alasan extends CI_Controller {

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
		$this->load->model('alasan_model');
	}

	public function index()
	{
		$data['alasan'] = $this->alasan_model->get_data()->result();
		
		$this->load->view('main/navbar_view.php');
		$this->load->view('main/sidebar_view.php');
		$this->load->view('alasan_view.php',$data);
		
	}

	public function input_alasan()
	{
		if ($_POST['alasan']=='') {
			redirect(base_url().'alasan');
		}
		$alasan_data = array('alasan' => $_POST['alasan']);

		$this->alasan_model->insert_data($alasan_data);
		redirect(base_url().'alasan');
		
	}

	function delete(){
		$id = $_GET['id_alasan'];
		$where = array('id_alasan' => $id);
		$this->alasan_model->delete($where,'alasan');
		redirect(base_url().'alasan');
	}
 
	function edit(){
		$id = $_GET['id_alasan'];
		$where = array('id_alasan' => $id);
		$data['alasan'] = $this->alasan_model->edit($where,'alasan')->result();
		$this->load->view('main/navbar_view.php');
		$this->load->view('main/sidebar_view.php');
		$this->load->view('alasan_view.php',$data);
	}

	function update(){
		$id_alasan = $this->input->post('id_alasan');
		$alasan = $this->input->post('alasan');
		
		$data = array(
			'alasan' => $alasan,
		);

		$where = array(
			'id_alasan' => $id_alasan
		);

		$this->alasan_model->update($where,$data,'alasan');
		redirect(base_url().'alasan');
	}
}
