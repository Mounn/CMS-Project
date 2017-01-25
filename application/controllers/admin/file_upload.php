<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    class File_upload extends CI_Controller {
        
        function __construct() {
            parent::__construct();
            $this->load->helper( array('form', 'url') );
            
        $this->load->library('session');			
		//if not logged in the redirect to login page	
			if ( $this->session->userdata('logged') == FALSE ) {
			redirect('admin');
		}
            
        }
        
        public function index() {
        $f_name = 'upload';
        $config['upload_path'] = 'application/uploads';
        $config['allowed_types'] = 'gif|png|jpg|zip';   
        $message = '';

        $this->load->library('upload', $config);
            
        if ( ! $this->upload->do_upload( $f_name ) ) {
            
            $message = $this->upload->display_errors();
        }
        else {
            $uploaded  = $this->upload->data();
            $file_name = $uploaded['file_name'];
            $message = "$file_name was uploaded successfuly!";
            
            $file_url = base_url(). 'application/uploads/'. $file_name;
            
            $funcNum = $_GET['CKEditorFuncNum'] ;
            echo "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction($funcNum, '$file_url', '$message');</script>";
            
        }
        
        
        }
        
    }