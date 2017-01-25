<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
	
	class Edit_page_model extends CI_Model {
	
		
	function __construct() {
		
		parent::__construct();
		$this->load->database();
		}	
			
	// this	updates the page in database after the user hits save changes
	// and pass all the form validations, it updated the page that has 
	// the page slug as uri segment(3)
	function  update_page() {
		
		$page_id = $this->uri->segment(3);
		
		// get fileds from post
		$data = array(
		
		'name' => $this->input->post('name'),
		'slug' => str_replace(' ', '-', $this->input->post('slug')),
		'content' => $this->input->post('content'),
		'title' => $this->input->post('title'),
		'description' => $this->input->post('description'),
		'keywords' => $this->input->post('keywords'),
		'sidebar' => $this->input->post('sidebar')
		);
		
		if ( $this->input->post('page_order') != "" ) {
		    
		    $data['page_order'] = $this->input->post('page_order');
		}
		
		if ( $this->input->post('show') !=""  ) {
		    
		    $data['visible'] = $this->input->post('show');
		}
		
		// check if the parent page was select
		if ( $this->input->post('parent_page') != "" && $this->input->post('parent_page') != $page_id  ) {
		
	        // add one more element to $data array
		$data['parent'] = $this->input->post('parent_page');
		}
		
		
		
		
		$this->db->where('id', $page_id);
		$this->db->update('articles', $data);
		
		}
		
		
		// this pulls all rows from articles tables
	// where page id  = uri->segment(3)
	// this function is made for the edit_page controller
	// see line 15 in edit_page controller inside controllers/admin/edit_page.php
	function get_page() {
		
		$page_id = $this->db->escape($this->uri->segment(3));
		$query = $this->db->query("SELECT * FROM articles WHERE id = $page_id");
		return $query->result();
		
		}	
	
		
	}
		
		
	?>	