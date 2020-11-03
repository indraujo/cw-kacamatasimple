<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Catatan extends CI_Controller {

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
		$this->load->model('catatan_model');
	}

	public function index()
	{
		$data['catatan'] = $this->catatan_model->get_data()->result();
		
		$this->load->view('main/navbar_view.php');
		$this->load->view('main/sidebar_view.php');
		$this->load->view('catatan_view.php',$data);
		
	}

	public function input_catatan()
	{
		if ($_POST['catatan']=='') {
			redirect(base_url().'catatan');
		}
		$catatan_data = array('catatan' => $_POST['catatan']);

		$this->catatan_model->insert_data($catatan_data);
		redirect(base_url().'catatan');
		
	}

	function delete(){
		$id = $_GET['id_catatan'];
		$where = array('id_catatan' => $id);
		$this->catatan_model->delete($where,'catatan');
		redirect(base_url().'catatan');
	}
 
	function edit(){
		$id = $_GET['id_catatan'];
		$where = array('id_catatan' => $id);
		$data['catatan'] = $this->catatan_model->edit($where,'catatan')->result();
		$this->load->view('main/navbar_view.php');
		$this->load->view('main/sidebar_view.php');
		$this->load->view('catatan_view.php',$data);
	}

	function update(){
		$id_catatan = $this->input->post('id_catatan');
		$catatan = $this->input->post('catatan');
		
		$data = array(
			'catatan' => $catatan,
		);

		$where = array(
			'id_catatan' => $id_catatan
		);

		$this->catatan_model->update($where,$data,'catatan');
		redirect(base_url().'catatan');
	}
}
