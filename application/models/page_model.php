<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
	
	
	class page_model extends CI_Model {
		
		
		function __construct() {
			
			parent::__construct();
			$this->load->database();
			}

		
		// it just tries to get a row where slug = $slug
		// and return an array which we use in the page controller
		// then we check if returned array is empty the we show 404
		public function page_exsist($slug) {
			
			//get page
			$query = $this->db->get_where('articles', array('slug' => $slug) );
			return $query->result();
			}
			
			
		// function to get page  title
		public function the_page() {
			
			// get page slug
			$slug = $this->uri->segment(1);
			
			// escape the slug to protect from sql injection
			$query = $this->db->get_where('articles', array('slug' => $slug) );
			return $query->result();

			}
		
		
		
			
	}
	
	?>