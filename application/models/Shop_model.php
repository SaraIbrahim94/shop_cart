<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Shop_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    //check if the given email and password matches the values in database
    //if so create new session
    //return true
    //else return false
    function validate_login($data)
    {
        $this->db->where("email", $data['email']);
        $this->db->where("password", $data['password']);
        $users = $this->db->get("users")->row();
        if ($users) {
            //add user data to session
            $set_data = [
                'user_id' => $users->id,
                'user_email' => $users->email,
                'logged_in' => TRUE
            ];
            $this->session->set_userdata($set_data);
            return TRUE;
        } else {
            return FALSE;
        }
    }
    //general function to get all data for given table
    function get_all_data($table)
    {
        return $this->db->select('*')->from($table)->get()->result();
    }
    //general function to get one record for given table and id
    function get_record($table, $id)
    {
        return $this->db->select('*')->from($table)->where('id', $id)->get()->row();
    }
    //get all purchase data for specific user
    function get_purchase()
    {
        return $this->db->select('id')->from('purchase')->where('user_id', uid())->where('done!=', 1)->get()->row('id');
    }
    //get all deleted products from shop cart for specific user
    function get_deleted_products()
    {
        $data = [];
        //get the id of the purchased products to get the deleted products before that purchase
        $purchase_id = $this->db->select('id')->from('purchase')->where('user_id', uid())->where('done', 1)->get()->result_array();
        $purchase_id = array_column($purchase_id, "id");
        if(!empty($purchase_id))
        {
            $this->db->select('cart.*, p.name, p.price, p.description, p.img')->from('cart')->where_in('purchase_id', $purchase_id)->where('deleted', 1);
            $this->db->join('products as p', 'p.id = cart.product_id');
            $data['purchased_data'] = $this->db->get()->result();
        }
        //get the id of the not purchased products yet to get the deleted products 
        $purchase_id = $this->db->select('id')->from('purchase')->where('user_id', uid())->where('done !=', 1)->get()->result('array');
        $purchase_id = array_column($purchase_id, "id");
        if(!empty($purchase_id))
        {
            $this->db->select('cart.*, p.name, p.price, p.description, p.img')->from('cart')->where_in('purchase_id', $purchase_id)->where('deleted', 1);
            $this->db->join('products as p', 'p.id = cart.product_id');
            $data['not_purchased_data'] = $this->db->get()->result();
        }
        $data['username'] = $this->db->select('username')->from('users')->where('id', uid())->get()->row('username');
        return $data;
    }
    //last stop in shopping when click on purchase the products are added to purchase and make flag
    //done to 1
    function add_purchase()
    {
        $this->db->where('user_id', uid());
        $this->db->where('done !=', 1);
        return $this->db->update('purchase', ['done' => 1]);
    }
}
