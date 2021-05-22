<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

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
		$this->load->model('product_model');
		$this->load->model('headline_model');
		$this->load->model('alasan_model');
		$this->load->model('bonus_model');
		$this->load->model('calltoaction_model');
		$this->load->model('catatan_model');
		$this->load->model('hashtag_model');
	}

	public function index()
	{

		$this->load->view('main/navbar_view.php');
		$this->load->view('main/sidebar_view.php');
		$this->load->view('dashboard.php');
	}

	public function tulis()
	{	
		//error_reporting(0);

		//$rows = $this->db->query("SELECT * FROM admin where username_admin='".$this->session->userdata('nama')."'")->row_array();
		if (isset($_POST['akun']))
		{
			$level_akun = $_POST['akun'];
		}
		else {
			$level_akun = 0;
		}
		
		$data['merk'] 	= $this->merk_model->get_data()->result();
		$data['hd'] 	= $this->headline_model->get_data()->result();
		$data['al'] 	= $this->alasan_model->get_data()->result();
		$data['bn'] 	= $this->bonus_model->get_data()->result();
		
		$data['call'] 			= $this->calltoaction_model->get_data()->result();
		$where['level_hashtag'] = $level_akun;
		$data['hashtag'] 		= $this->hashtag_model->select($where)->result();
		$this->load->view('main/navbar_view.php');
		$this->load->view('main/sidebar_view.php');
		$this->load->view('tulis_view.php',$data);
		
	}

	public function merk(){
		$data['merk'] = $this->merk_model->get_data()->result();
		
		$this->load->view('main/navbar_view.php');
		$this->load->view('main/sidebar_view.php');
		$this->load->view('merk_view.php',$data);
	}

	public function product(){
		$data['product'] = $this->product_model->get_data()->result();
		
		$this->load->view('main/navbar_view.php');
		$this->load->view('main/sidebar_view.php');
		$this->load->view('product_view.php',$data);
	}

	public function instagram()
	{	
		//error_reporting(0);

		//$rows = $this->db->query("SELECT * FROM admin where username_admin='".$this->session->userdata('nama')."'")->row_array();
		if (isset($_POST['akun']))
		{
			$level_akun = $_POST['akun'];
		}
		else {
			$level_akun = 0;
		}
		
		$data['merk'] = $this->merk_model->get_data()->result();
		$data['hd'] = $this->headline_model->get_data()->result();
		$data['al'] = $this->alasan_model->get_data()->result();
		$data['bn'] = $this->bonus_model->get_data()->result();
		
		$data['call'] = $this->calltoaction_model->get_data()->result();
		$where['level_hashtag'] = $level_akun;
		$data['hashtag'] = $this->hashtag_model->select($where)->result();
		$this->load->view('main/navbar_view.php');
		$this->load->view('main/sidebar_view.php');
		$this->load->view('instagram/instagram_tulis_view.php',$data);
		
	}

	public function instagramhijab()
	{	
		//error_reporting(0);

		//$rows = $this->db->query("SELECT * FROM admin where username_admin='".$this->session->userdata('nama')."'")->row_array();
		if (isset($_POST['akun']))
		{
			$level_akun = $_POST['akun'];
		}
		else {
			$level_akun = 0;
		}
		
		$data['merk'] 	= $this->merk_model->get_data()->result();
		$where['hastag_product'] = "hijab";
		$whereheadline['headline_product'] = "hijab";
		$data['hd'] 	= $this->headline_model->select($whereheadline)->result();
		$data['al'] 	= $this->alasan_model->get_data()->result();
		$data['bn'] 	= $this->bonus_model->get_data()->result();
		
		$data['call'] = $this->calltoaction_model->get_data()->result();
		$data['hashtag'] = $this->hashtag_model->select($where)->result();
		$this->load->view('main/navbar_view.php');
		$this->load->view('main/sidebar_view.php');
		$this->load->view('instagram/instagramhijab_tulis_view.php',$data);
		
	}

	public function shopee()
	{	
		//error_reporting(0);

		//$rows = $this->db->query("SELECT * FROM admin where username_admin='".$this->session->userdata('nama')."'")->row_array();
		if (isset($_POST['akun']))
		{
			$level_akun = $_POST['akun'];
		}
		else {
			$level_akun = 0;
		}
		
		$data['merk'] = $this->merk_model->get_data()->result();
		$data['hd'] = $this->headline_model->get_data()->result();
		$data['al'] = $this->alasan_model->get_data()->result();
		$data['bn'] = $this->bonus_model->get_data()->result();
		
		$data['call'] = $this->calltoaction_model->get_data()->result();
		$where['level_hashtag'] = $level_akun;
		$data['hashtag'] = $this->hashtag_model->select($where)->result();
		$this->load->view('main/navbar_view.php');
		$this->load->view('main/sidebar_view.php');
		$this->load->view('shopee/shopee_tulis_view.php',$data);
		
	}

	public function facebook_toko(){
		$data['merk'] = $this->merk_model->get_data()->result();
		$data['hd'] = $this->headline_model->get_data()->result();
		$data['al'] = $this->alasan_model->get_data()->result();
		$data['bn'] = $this->bonus_model->get_data()->result();
		
		$data['call'] = $this->calltoaction_model->get_data()->result();
		//$where['level_hashtag'] = $level_akun;
		//$data['hashtag'] = $this->hashtag_model->select($where)->result();
		$this->load->view('main/navbar_view.php');
		$this->load->view('main/sidebar_view.php');
		$this->load->view('facebook/tulis_facebook_toko_view.php',$data);
	}

	public function facebook_post(){
		$data['merk'] = $this->merk_model->get_data()->result();
		$data['hd'] = $this->headline_model->get_data()->result();
		$data['al'] = $this->alasan_model->get_data()->result();
		$data['bn'] = $this->bonus_model->get_data()->result();
		
		$data['call'] = $this->calltoaction_model->get_data()->result();
		//$where['level_hashtag'] = $level_akun;
		//$data['hashtag'] = $this->hashtag_model->select($where)->result();
		$this->load->view('main/navbar_view.php');
		$this->load->view('main/sidebar_view.php');
		$this->load->view('facebook/tulis_facebook_post_view.php',$data);
	}

	public function tokopedia_produk(){
		$data['merk'] = $this->merk_model->get_data()->result();
		$data['hd'] = $this->headline_model->get_data()->result();
		$data['al'] = $this->alasan_model->get_data()->result();
		$data['bn'] = $this->bonus_model->get_data()->result();
		
		$data['call'] = $this->calltoaction_model->get_data()->result();
		//$where['level_hashtag'] = $level_akun;
		//$data['hashtag'] = $this->hashtag_model->select($where)->result();
		$this->load->view('main/navbar_view.php');
		$this->load->view('main/sidebar_view.php');
		$this->load->view('tokopedia/tokopedia_produk_view.php',$data);
	}
}
