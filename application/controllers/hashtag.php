<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hashtag extends CI_Controller {

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
		$this->load->model('hashtag_model');
	}

	public function index()
	{
		$data['hashtag'] = $this->hashtag_model->get_data()->result();
		
		$this->load->view('main/navbar_view.php');
		$this->load->view('main/sidebar_view.php');
		$this->load->view('hashtag_view.php',$data);
		
	}

	public function input_hashtag()
	{
		if ($_POST['hashtag']=='') {
			redirect(base_url().'hashtag');
		}
		$level_hashtag = $_POST['level_hashtag'];
		$array_kode = explode(", ", $_POST['hashtag']);
		foreach ($array_kode as $ak) {
			$hashtag = $ak;
			//echo $ak."</br>";
			$hashtag_data = array('hashtag' => $hashtag, 'level_hashtag' => $level_hashtag);
			$this->hashtag_model->insert_data($hashtag_data);
		
		}
		

		redirect(base_url().'hashtag');
		
	}

	function delete(){
		$id = $_GET['id_hashtag'];
		$where = array('id_hashtag' => $id);
		$this->hashtag_model->delete($where,'hashtag');
		redirect(base_url().'hashtag');
	}
 
	function edit(){
		$id = $_GET['id_hashtag'];
		$where = array('id_hashtag' => $id);
		$data['hashtag'] = $this->hashtag_model->edit($where,'hashtag')->result();
		$this->load->view('main/navbar_view.php');
		$this->load->view('main/sidebar_view.php');
		$this->load->view('hashtag_view.php',$data);
	}

	function update(){
		$id_hashtag = $this->input->post('id_hashtag');
		$hashtag = $this->input->post('hashtag');
		
		$data = array(
			'hashtag' => $hashtag,
		);

		$where = array(
			'id_hashtag' => $id_hashtag
		);

		$this->hashtag_model->update($where,$data,'hashtag');
		redirect(base_url().'hashtag');
	}
}
