<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Register extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Shop_model');
    }

    function index() {
        if(uid() != '')
        {
            $this->session->set_flashdata('success', 'you already logged in');
            redirect('Products');
        }
        else
        {
            $data['title'] = 'Register';
            $this->load->view("register", $data);
        }
    }

   function validation()
   {
        $this->load->library('form_validation');
        $this->form_validation->set_rules("username", "username", "trim|required");
        $this->form_validation->set_rules("email", "email", "trim|required|is_unique[users.email]");
        $this->form_validation->set_rules("password", "password", "trim|required|matches[confirm_password]|min_length[4]|max_length[20]");
        $this->form_validation->set_rules("confirm_password", "confirm password", "trim|matches[password]");
        if (!$this->form_validation->run()) {
            $this->index();
        }
        else
        {
            $data = $this->input->post();
            unset($data['confirm_password']);
            $data['password'] = do_hash($this->input->post('password'), 'md5');
            $this->db->insert('users', $data);
            $this->session->set_flashdata('success', 'succefflluy registered');
            redirect('Login');

        }
   }

}
