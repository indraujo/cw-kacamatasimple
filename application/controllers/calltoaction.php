<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Calltoaction extends CI_Controller {

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
		$this->load->model('calltoaction_model');
	}

	public function index()
	{
		$data['calltoaction'] = $this->calltoaction_model->get_data()->result();
		
		$this->load->view('main/navbar_view.php');
		$this->load->view('main/sidebar_view.php');
		$this->load->view('calltoaction_view.php',$data);
		
	}

	public function input_calltoaction()
	{
		if ($_POST['calltoaction']=='') {
			redirect(base_url().'calltoaction');
		}
		$calltoaction_data = array('calltoaction' => $_POST['calltoaction']);

		$this->calltoaction_model->insert_data($calltoaction_data);
		redirect(base_url().'calltoaction');
		
	}

	function delete(){
		$id = $_GET['id_calltoaction'];
		$where = array('id_calltoaction' => $id);
		$this->calltoaction_model->delete($where,'calltoaction');
		redirect(base_url().'calltoaction');
	}
 
	function edit(){
		$id = $_GET['id_calltoaction'];
		$where = array('id_calltoaction' => $id);
		$data['calltoaction'] = $this->calltoaction_model->edit($where,'calltoaction')->result();
		$this->load->view('main/navbar_view.php');
		$this->load->view('main/sidebar_view.php');
		$this->load->view('calltoaction_view.php',$data);
	}

	function update(){
		$id_calltoaction = $this->input->post('id_calltoaction');
		$calltoaction = $this->input->post('calltoaction');
		
		$data = array(
			'calltoaction' => $calltoaction,
		);

		$where = array(
			'id_calltoaction' => $id_calltoaction
		);

		$this->calltoaction_model->update($where,$data,'calltoaction');
		redirect(base_url().'calltoaction');
	}
}
