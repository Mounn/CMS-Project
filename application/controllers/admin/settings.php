<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
	
	class Settings extends CI_Controller {
		
		function __construct() {
			
			parent::__construct();
			
						$this->load->library('session');
			
			//if not logged in the redirect to login page	
			if ( $this->session->userdata('logged') == FALSE ) {
			redirect('admin');
			
			}
			
			}
			
			
		//this is the index page for /admin/settings	
		public function index() {
			
			//  empty message to avoid undefined error
			$data['msg'] = '';
			
			// load the admin settings model
			$this->load->model('admin_settings');
			$data['pages'] = $this->admin_settings->list_pages();
			
			
			// get l settings
			$settings = $this->admin_settings->get_settings();
			
			// put them in variables
			foreach( $settings as $row) {
			$data['current_template'] = ($row->template) ? $row->template : "";
			$data['admin_email'] = ($row->email_address) ? $row->email_address : "";
			$data['site_name'] = ($row->sitename) ? $row->sitename : "";
			}
			

			// load the form helper and validation library
			$this->load->helper('form');
			$this->load->library('form_validation');
			
			// set validation rules
			$this->form_validation->set_rules('indexpage', 'Page', 'required');
			$this->form_validation->set_rules('email_address', 'Admin Email', 'trim|valid_email');
			
			if ($this->input->post('password') !== "") {
				
				$this->form_validation->set_rules('password', 'Password', 'required|matches[password_confirm]|md5');
				$this->form_validation->set_rules('password_confirm', 'Password Confirm', 'required');

				}
			
			
			
			// if validation passed
			if ( $this->form_validation->run() !== false )
			
			{
			
			//load the admin  settings model
			$this->load->model('update_settings');
				
			$data['msg'] = $this->update_settings->update_table();
				
			}
		$this->load->helper('directory');
		$data['list'] = directory_map('./application/template/front', FALSE, TRUE);
		
			// render html
			$this->load->view('admin/settings_html.php', $data);
			
			}
		
		
		
		}
	
	
	
	?>