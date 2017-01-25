<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
	
	class Delete_page_model extends CI_Model {
	
		
	function __construct() {
		
		parent::__construct();
		$this->load->database();
		}	
		
		
			
	// this	function deletes a page
	function  delete() {
		
		
		$count = $this->db->get('articles');
		
		if ( $count->num_rows() == 1 )
		
		{
		
return 1;
			
		}
		
			else {
			
		
				if ( $this->db->delete('articles', array('id' => $this->uri->segment(3) )) ) {
			
					return 2;
			
						}
			
					else {
				
						return 3;
					
						}
		
			
			}
		
		
		}
		
		
		
		
	}
?>