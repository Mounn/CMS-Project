<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
	
	class Menu_model extends CI_Model {
	
		
	function __construct() {
		
		parent::__construct();
		$this->load->database();
		}	
		
		
	// function to get the articles table	
	function links() {
		
		// order by page order
		$this->db->order_by("page_order", "asc"); 
		
		// select pages where visible is yes
		$query = $this->db->get_where('articles', array('visible' => 'Yes'));
		
		if ( $query->num_rows() > 0 ) {
			
			return $query->result();
			
			}
			
		else {
			
			// empty array so we dont get  invalid foreach argument in view file
			return array();
			
			}	
		
		}
		
	}	
?>