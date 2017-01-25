<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
	
	class Add_page extends CI_Controller {

		
		public function __Construct() {
			parent::__construct();
			$this->load->library('session');
			
			
		//if not logged in the redirect to login page	
			if ( $this->session->userdata('logged') == FALSE )
			redirect('admin');
			
			}

		
		// index page for /admin/add_page
		// view file is /template/admin/add_page_html
		public function index() {
		
		// empty $msg variable
			$data['msg'] = '';
			
			// load necessary libraries
			$this->load->helper('form');
			$this->load->library('form_validation');
			
			// set validation rules
			$this->form_validation->set_rules('name', 'Page name', 'required');
			$this->form_validation->set_rules('slug', 'Page Slug', '');
			$this->form_validation->set_rules('title', 'Title', '');
			$this->form_validation->set_rules('content', 'Page content', 'required');
			$this->form_validation->set_rules('page_order', 'Page Order', 'numeric');
			
			// if passed form validation (ok)
			if ( $this->form_validation->run() !== FALSE ) 
			
			{
			
			// load the enty mode , can be found at models/entry.php
				$this->load->model('entry');	
				
			// the model "Entry" has the function add_entry()
			// this function insert the data into data base
			// and returns a message , this message returned will be stored in 
			// the variable $msg to be used in the template file
				$data['msg'] = $this->entry->add_entry();

			}
			
			
			// list pages in parent page dropdown
			$this->load->model('admin_settings');
			$data['pages'] = $this->admin_settings->list_pages();
			
			
			// render template for add page
			$this->load->view('admin/add_page_html.php', $data);
			
			}
	
	}
	
	?>