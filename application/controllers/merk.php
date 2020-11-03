<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class merk extends CI_Controller {

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
		$this->load->model('merk_model');
	}

	public function index()
	{
		$data['merk'] = $this->merk_model->get_data()->result();
		
		$this->load->view('main/navbar_view.php');
		$this->load->view('main/sidebar_view.php');
		$this->load->view('merk_view.php',$data);
		
	}

	public function input_merk()
	{
		if ($_POST['merk']=='') {
			redirect(base_url().'merk');
		}
		$merk_data = array('merk' => $_POST['merk'], 'kode_merk' => $_POST['kode_merk']);

		$this->merk_model->insert_data($merk_data);
		redirect(base_url().'merk');
		
	}

	function delete(){
		$id = $_GET['id_merk'];
		$where = array('id_merk' => $id);
		$this->merk_model->delete($where,'merk');
		redirect(base_url().'merk');
	}
 
	function edit(){
		$id = $_GET['id_merk'];
		$where = array('id_merk' => $id);
		$data['merk'] = $this->merk_model->edit($where,'merk')->result();
		$this->load->view('main/navbar_view.php');
		$this->load->view('main/sidebar_view.php');
		$this->load->view('merk_view.php',$data);
	}

	function update(){
		$id_merk = $this->input->post('id_merk');
		$merk = $this->input->post('merk');
		$kode_merk = $this->input->post('kode_merk');
		
		$data = array(
			'merk' => $merk,
			'kode_merk' => $kode_merk
		);

		$where = array(
			'id_merk' => $id_merk
		);

		$this->merk_model->update($where,$data,'merk');
		redirect(base_url().'merk');
	}
}
