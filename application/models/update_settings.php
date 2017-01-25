<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
	
	class Update_settings extends CI_Model {

		public $res = '';
		
		
		
		public function __Construct() {
			parent::__construct();
			$this->load->library('session');
			$this->load->database();
			
			
		//if not logged in the redirect to login page	
			if ( $this->session->userdata('logged') == FALSE )
			redirect('admin');
			
			}
			
		function update_table() {
		
		$data = array(
		'home_page' => $this->input->post('indexpage'),
		'sitename' => $this->input->post('sitename'),
		'email_address' => $this->input->post('email_address')
		);
		
		if ( $this->input->post('template') ) {$data['template'] = $this->input->post('template');}
		if ( $this->input->post('password') ) {$data['password'] = $this->input->post('password');}
		
		$update = $this->db->update('settings', $data);
		
		if ( $update ) {
			
			$this->res = '<p class="success">Settings were updated successfuly</p>';
			
			}
			
		else {
			
			$this->res = '<p class="success">Settings were updated successfuly</p>';
			
			}
			
			return $this->res;
		
			}	
			

	
	}
	
	
	?>