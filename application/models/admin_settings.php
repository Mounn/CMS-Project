<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
	
	class Admin_settings extends CI_Model {
	
		
	function __construct() {
		
		parent::__construct();
		$this->load->database();
		}	
		
		
	// function to get the articles table	
	function list_pages() {
		
		$query = $this->db->get('articles');
		
		if ( $query->num_rows() > 0 ) {
			
			return $query->result();
			
			}
			
		else {
			
			return false;
			
			}	
		
		}


	// get the whole settings table
	function get_settings() {
		$query = $this->db->get('settings');
		return $query->result();
		
		}
		
		
	
	}
	
		?>