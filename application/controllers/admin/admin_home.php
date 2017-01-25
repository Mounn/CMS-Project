<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
	class Admin_home extends CI_Controller {

		
        function __construct()
            {
                parent::__construct();
                $this->load->library('session');

            }
			
		public function index() 
		{	
		
			$data['error'] = "";
			
			// check if admin is logged in
               if( $this->session->userdata('logged') == TRUE)
			   
                    {
                        redirect('admin/dashboard');
                    }
			
			// render login page
			else {
			
			//Login code

				// Load the form validation library
				$this->load->library('form_validation');
				
				// Set validation rules
				$this->form_validation->set_rules('username', 'Username', 'trim|required' );
				$this->form_validation->set_rules('password', 'Password', 'trim|required|md5');
				
				// if form was submited and passed validation
				if ( $this->form_validation->run() !== FALSE ) {
					
					
				// load admin settings model
				// this is needed to check password in db
				$this->load->model('admin_settings');
					
				$settings = $this->admin_settings->get_settings();
				
				foreach( $settings as $row ) {
				
				// admin password in database
				$admin_password = $row->password;
				
				}
				
				
				 if ($this->input->post('username') == "admin" && $this->input->post('password') == $admin_password )
					
					{
						
						// start session for admin
					$data  = array(
                    'uname' => $this->input->post('username'),
                    'logged' => TRUE);
					 
					$this->session->set_userdata($data);
						
						// Logged in , redirect to dashboard
						redirect('admin/dashboard');	
						
					}

					else {
				
				// set error message
				$data['error'] = "<p>Username or Password is Incorrect.</p>";

				// lload form helper
				$this->load->helper('form');
				
				// render admin login page
				$this->load->view('admin/login.php', $data);
						
					}
					
				}

				else {
	
				// lload form helper
				$this->load->helper('form');
				
				// render admin login page
				$this->load->view('admin/login.php', $data);
				
				}
			
		}	

	}

		public function logout() {
			
			$this->session->sess_destroy();
			redirect(base_url());
		}
		
}


?>