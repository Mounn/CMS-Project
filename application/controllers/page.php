<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Page extends CI_Controller {	
	
	
	function __construct() {
		parent::__construct();
		
		}
	
	public function index() {
		
	// load the menu links model
	// it has a function that gets the articles table
	    $this->load->model('menu_model');
		
		// put the list of pages inside variable to loop later
		$data['menus'] = $this->menu_model->links();
		

		// lets load the page model
		// its the one that pulls page contents , title, etc..
		$this->load->model('page_model');
		
          // check if page doesn't exist
         // I take the segment and look in database for that segment
         // page_exist will return an array
		 // if empty array then we show 404
		 // page_exist() function inside the page_model does the db check
		
		if ( count($this->page_model->page_exsist($this->uri->segment(1)) ) < 1 )
			
			{
				show_404();
				
				}
			
		
		else {
		
		
		$pages = $this->page_model->the_page();
		
		foreach ( $pages as $page ) {
		// contents variables
		$data['title'] = $page->title;
		$data['description'] = $page->description;
		$data['keywords'] = $page->keywords;
		$data['content'] = $page->content;
		$data['sidebar'] = $page->sidebar;		
		}
		
		// load admin settings model so we get website template
		$this->load->model('admin_settings');
		$settings = $this->admin_settings->get_settings();
		
		foreach ( $settings as $setting ) {
		$template = $setting->template;
		$data['sitename'] = $setting->sitename;
		}
		
		// set template path in a variable
		$template = "front/".$template."/page_html.php";
		
		
		// render HTML template
		$this->load->view($template, $data);
		
		 }
	
	}
		
}