<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bonus extends CI_Controller {

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
		$this->load->model('bonus_model');
	}

	public function index()
	{
		$data['bonus'] = $this->bonus_model->get_data()->result();
		
		$this->load->view('main/navbar_view.php');
		$this->load->view('main/sidebar_view.php');
		$this->load->view('bonus_view.php',$data);
		
	}

	public function input_bonus()
	{
		if ($_POST['bonus']=='') {
			redirect(base_url().'bonus');
		}
		$bonus_data = array('bonus' => $_POST['bonus']);

		$this->bonus_model->insert_data($bonus_data);
		redirect(base_url().'bonus');
		
	}

	function delete(){
		$id = $_GET['id_bonus'];
		$where = array('id_bonus' => $id);
		$this->bonus_model->delete($where,'bonus');
		redirect(base_url().'bonus');
	}
 
	function edit(){
		$id = $_GET['id_bonus'];
		$where = array('id_bonus' => $id);
		$data['bonus'] = $this->bonus_model->edit($where,'bonus')->result();
		$this->load->view('main/navbar_view.php');
		$this->load->view('main/sidebar_view.php');
		$this->load->view('bonus_view.php',$data);
	}

	function update(){
		$id_bonus = $this->input->post('id_bonus');
		$bonus = $this->input->post('bonus');
		
		$data = array(
			'bonus' => $bonus,
		);

		$where = array(
			'id_bonus' => $id_bonus
		);

		$this->bonus_model->update($where,$data,'bonus');
		redirect(base_url().'bonus');
	}
}
