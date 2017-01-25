<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
	
	class Edit_page extends CI_Controller {

		
		public function __Construct() {
			parent::__construct();
			
			$this->load->library('session');
			
			//if not logged in the redirect to login page	
			if ( $this->session->userdata('logged') == FALSE ) {
			redirect('admin');
			
			}
			
		}
		
	public function index() {
	
	$this->load->model('edit_page_model');
	$data['msg'] = '';
	
	// looad the necessary helpers and librarries
	$this->load->helper('form');
	$this->load->library('form_validation');
	
	// set validation rules 
	// this is for /template/admin/edit_page_html
	$this->form_validation->set_rules('name', 'Page name', 'required');
	$this->form_validation->set_rules('slug', 'Page Slug', 'required');
	$this->form_validation->set_rules('content', 'Page content', 'required');
	$this->form_validation->set_rules('title', 'Page tile', 'required');
	$this->form_validation->set_rules('name', 'Page name', 'required');
	$this->form_validation->set_rules('page_order', 'Page Order', 'numeric');
	
	if ( $this->form_validation->run() !== FALSE )
	{
		
	// If the form was submited and validation password
	// edit page model is already loaded in this file - on line 14
	// use  its update function to update the page
		
	$this->edit_page_model->update_page();
	$data['msg'] = "<p class='success'>Page was updated.</p>";
	}

	
	
	$data['page'] = $this->edit_page_model->get_page();
	
			// list pages in parent page dropdown
			$this->load->model('admin_settings');
			$data['pages'] = $this->admin_settings->list_pages();
	
	// render HTML
	$this->load->view('admin/edit_page_html.php', $data);
	
	
		}	
		
		
		
}
?>