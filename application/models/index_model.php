<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
	
	
	class Index_model extends CI_Model {
		
		
		function __construct() {
			
			parent::__construct();
			$this->load->database();
			}
			
		// function to get hompepage
		public function home_page() {
			
			// get homepage ID
			$this->db->select('home_page');
			$query = $this->db->get('settings');
			
			$row = $query->row();

			
			
			// get page title , metas , contents 
			$query = $this->db->get_where('articles', array('id' => $row->home_page) );
			
			// if the homepage exist and was not deleted (somehow)
			// then return the results
			if ($query->num_rows() > 0)
			{
			
			return $query->result();
			}
			
			// if  homepage was not found in the articles table then
			// do a new query to pull any available page from articles
			// and return the results, this is to avoid undefined bullshit
			
			else {
				
			$query = $this->db->get('articles', 1, 0 );
			return $query->result();
				}
			
			}
			
	}		
	
	?>