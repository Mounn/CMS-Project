<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */

	 function __construct()
    	 {
    	     parent::__construct();
    	    $this->load->library('session');
			$this->load->database();
    	 }
    	 

	 
	public function index()
	{
	    
	$this->load->helper('template_helper');    
	
	// load the menu links model
	// it has a function that gets the articles table
	    $this->load->model('menu_model');
		
		// put the list of pages inside variable to loop later
		$data['menus'] = $this->menu_model->links();
		
		
		// load the home page model
		$this->load->model('index_model');
		
		foreach ( $this->index_model->home_page() as $row ) {
		
		// contents variables
		$data['title'] = $row->title;
		$data['description'] = $row->description;
		$data['keywords'] = $row->keywords;
		$data['content'] = $row->content;
		$data['sidebar'] = $row->sidebar;
		
		}

        $data['logged_in']  = $this->session->userdata('email');
		
		
		// load admin settings model so we get website template
		$this->load->model('admin_settings');
		$settings = $this->admin_settings->get_settings();
		
		foreach ( $settings as $setting ) {
		$template = $setting->template;
		$data['sitename'] = $setting->sitename;
		}
		
		// set template path
		$template = "front/".$template."/home_html.php";
		
		$this->load->view($template, $data);
	
		
	
	}
	
	

		


	
}
	
	
	

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */