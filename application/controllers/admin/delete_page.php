<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Delete_page extends CI_Controller {


public function __Construct() {
parent::__construct();

}

public function index() {

// load the delete page model
$this->load->model('delete_page_model');


// if no page ID in url
if ($this->uri->segment(3) === FALSE ) {redirect('admin/dashboard');}

// model delete function
$query = $this->delete_page_model->delete();

// check returned 

switch($query){
case 1:
echo "You cant delete your only page!";
break;
case 2:
redirect('admin/dashboard');
break;
case 3:
echo "Could not delete page.";		
}

}	


}
?>