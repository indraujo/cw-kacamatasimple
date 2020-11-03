<?php
class Table_merk extends ci_controller
{
function index()
{
//meload library table
$this->load->library('table');

 //mengquerykan database
$data['data']=$this->db->get('merk');

 //mensetting caption tabel
$this->table->set_caption('<h1>Menampilkan data dengan class Tabel di codeigniter</h1>');

 //mensetting header tabel
$this->table->set_heading(array('id','merk','kode'));

//mensetting tampilan tabel
$tmp=array('table_open'=>'<table border="1" cellpadding="2" border="1" width="40%">');
$this->table->set_template($tmp);

 //memanggil view, untuk menampilkan tabel
$this->load->view('tabel',$data);
}
}