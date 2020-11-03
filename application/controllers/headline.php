<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Headline extends CI_Controller {

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
		$this->load->model('headline_model');
	}

	public function index()
	{
		$data['headline'] = $this->headline_model->get_data()->result();
		
		$this->load->view('main/navbar_view.php');
		$this->load->view('main/sidebar_view.php');
		$this->load->view('headline_view.php',$data);
		
	}

	public function input_headline()
	{
		if ($_POST['headline']=='') {
			redirect(base_url().'headline');
		}
		$headline_data = array('headline' => $_POST['headline']);

		$this->headline_model->insert_data($headline_data);
		redirect(base_url().'headline');
		
	}

	function delete(){
		$id = $_GET['id_headline'];
		$where = array('id_headline' => $id);
		$this->headline_model->delete($where,'headline');
		redirect(base_url().'headline');
	}
 
	function edit(){
		$id = $_GET['id_headline'];
		$where = array('id_headline' => $id);
		$data['headline'] = $this->headline_model->edit($where,'headline')->result();
		$this->load->view('main/navbar_view.php');
		$this->load->view('main/sidebar_view.php');
		$this->load->view('headline_view.php',$data);
	}

	function update(){
		$id_headline = $this->input->post('id_headline');
		$headline = $this->input->post('headline');
		
		$data = array(
			'headline' => $headline,
		);

		$where = array(
			'id_headline' => $id_headline
		);

		$this->headline_model->update($where,$data,'headline');
		redirect(base_url().'headline');
	}
}
