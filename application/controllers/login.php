<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
    class Login extends CI_Controller {
        
    function __construct()
        {
        parent:: __construct();    
        $this->load->library('session');
        }
        
        public function  index()
            {
    
                $data['logged_in']  = $this->session->userdata('email');
                
                
   // if user is already logged in then redirect to (myaccount)
                
                if( $this->session->userdata('logged_in') )
                    {
                        redirect('myaccount');
                    }
                
                $this->load->library('form_validation');
                $this->form_validation->set_rules('email_address', 'Email Address', 'required|valid_email');
               $this->form_validation->set_rules('password', 'Password', 'required');
               

               
               if ( $this->form_validation->run()  !== false) 
                   {
                       
               $this->load->model('login_model');
               $res = $this->login_model->verify_user($this->input->post('email_address'), $this->input->post('password') );
                   
               
                     if ( $res !== false )
                {
                $data  = array(
                    'email' => $this->input->post('email_address'),
                    'logged_in' => TRUE
                    );    
                    
                $this->session->set_userdata($data);
                redirect('myaccount');
                }  
               
               
           }

                
                 
               $this->load->view('front/login_html', $data);
            }
        

            
            
    }
    
    
    
    ?>