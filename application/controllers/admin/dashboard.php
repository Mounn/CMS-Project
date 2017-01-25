<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
		
		class Dashboard Extends CI_Controller {
			
		public function __Construct() {

                parent::__construct();
                $this->load->library('session');
			
			}	
			

		public function index() {
		
		// redirect to login if NO session
			if ( $this->session->userdata('logged') !== FALSE )
				
				{

			// load admin_settings model
			// it has a function that list pages
			$this->load->model('admin_settings');
			
			$data['allpages'] = $this->admin_settings->list_pages();
				
				
		//render dashboard		
			$this->load->view('admin/dashboard_html.php', $data);
			
			    }
			
			else
			{
				redirect('admin');
			}
			
		}
		
			
	}
		
?>