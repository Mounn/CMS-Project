<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
	
	class Entry extends CI_Model {
		
		var $name ='';
		var $visible ='Yes';
		var $slug = '';
		var $title = '';
		var $content = '';
		var $description = '';
		var $keywords ='';
		var $sidebar ='';
		var $article_date = '';
		var $page_order = '';
		var $parent = '';
		private $res ='';
		
		function __construct() {
			
			parent::__construct();
			$this->load->database();
			}
		
	
		
		// function to insert page in database
		function add_entry() {
			
			// assign values from $_POST to class variables
			$this->name = $this->input->post('name');
			$this->visible = $this->input->post('show');
			$this->parent = $this->input->post('parent_page');
			
			// replace spaces with hash
			$this->slug = str_replace(' ', '-', $this->input->post('slug'));
			
			$this->content = $this->input->post('content');
			$this->title = $this->input->post('title');
			$this->description = $this->input->post('description');
			$this->keywords = $this->input->post('keywords');
			$this->sidebar = $this->input->post('sidebar');
			$this->page_order = $this->input->post('page_order');
			$this->article_date = time();
			
			//check if page exsist
			$query = $this->db->get_where('articles', array('name' => $this->name) );
			
			if ( $query->num_rows() > 0 ) 
			
			{ $this->res = "<p class='fail'>You already have a page with this name.</p>";}
			

			else {
			
			// check if there is a page with same slug
			$query = $this->db->get_where('articles', array('slug' => $this->slug) );
			
			// if found then adda number to the slug to differs it
			if ( $query->num_rows() > 0 ) { $this->slug = $this->slug ."1";}
			
			// everything is ok Insert now
			$this->db->insert('articles', $this);
			
			// set result message
			$this->res = "<p class='success'>Page created..</p>";
			}
			
			return $this->res;
			
		}	
		
	}	

	?>