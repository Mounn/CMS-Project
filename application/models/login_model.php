<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
    
    class Login_model extends CI_Model{
        
        
        public function __construct()
            {
                $this->load->database();
            }
        
            
            public function verify_user($email, $password)
                {
                    
                    $q = $this->db
                            ->where('email_address', $email)
                            ->where('password', sha1($password))
                            ->limit (1)
                            ->get('users');
                    
                    if ( $q->num_rows > 0 )
                        {
                           return $q->row();
                        }
                        
                        else
                            {
                        return false;
                    }
                    
                    
                }
        
    }
    
    ?>