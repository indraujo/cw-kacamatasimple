<?php

class Headline_model extends CI_Model {
	
    function __construct(){
        parent::__construct();
        
	}

    function insert_data($data){
        $this->db->insert('headline', $data);
    }

    function get_data(){
        return $this->db->get('headline');
    }
    
    function select_all(){
        $this->db->select('*');
		$this->db->from('headline');
		$this->db->order_by('id_headline', 'asc');
		return $this->db->get();
    }

    function select($where){
        $this->db->select('*');
        $this->db->from('headline');
        $this->db->where($where);
        return $this->db->get();
    }

    function delete($where,$table){
        $this->db->where($where);
        $this->db->delete($table);
    }

    function edit($where,$table){      
        return $this->db->get_where($table,$where);
    }
 
    function update($where,$data,$table){
        $this->db->where($where);
        $this->db->update($table,$data);
    }

}
?>