<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Shop_model');
    }

    function index() {
        if(uid() != '')
            redirect('index.php/Products');
        else
        {
            $data['title'] = 'Login';
            $this->load->view("login", $data);
        }
    }

   function do_login()
   {
        $this->load->library('form_validation');
        $this->form_validation->set_rules("email", "email", "trim|required");
        $this->form_validation->set_rules("password", "password", "trim|required");
        if (!$this->form_validation->run()) {
            $this->index();
        }
        else
        {
            $data = $this->input->post();
            $data['password'] =  do_hash($this->input->post('password'), 'md5');
            unset($data['confirm_password']);
            $is_logged = $this->Shop_model->validate_login($data);
            if($is_logged)
            {
                $this->session->set_flashdata('success', 'succefflluy logged in');
                redirect('index.php/Products');
            }
            else
            {
                $this->session->set_flashdata('error', 'invalid email or password..!');
                $this->index();
            }
            
        }
   }

   function log_out()
   {
    if ((uid() != "")) {
        $new_data = [
            'logged_in' => FALSE,
            'user_id' => '',
            'user_email' => '',
        ];
        $this->session->unset_userdata($new_data);
        $this->session->sess_destroy();
        redirect('index.php/Login');
    } else {
        redirect('index.php/Login');
    }
   }

}
