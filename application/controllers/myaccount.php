<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Myaccount extends CI_Controller {


// Construct function for intiating session	 
	 function __construct()
    	 {
    	     parent::__construct();
    	    $this->load->library('session');
    	 }

// This is index of /myaccount page
	public function index()
	{
	    $data['logged_in']  = $this->session->userdata('email');
	    if( $this->session->userdata('logged_in')  == false )
    	    {
    	    redirect('login');    
    	    }
    	    
// store sessio username in a variable    	    
    	$data['user_name'] = $this->session->userdata('email');    
		$this->load->view('front/account_main_html', $data);
	}
	
// Logout function (myaccount/logout)	
	        public function logout()
            {

                $this->session->sess_destroy();
               redirect('login');
            }
	
}
	
?>