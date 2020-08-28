<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Shop_cart extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Shop_model');
    }

    function index() {
        if(uid() != '')
        {
            $data['title'] = 'Shop Cart';
            $data['products'] = get_cart();
            $this->load->view("shop_cart", $data);
        }
        else
        redirect('index.php/Login');
    }

    function add()
    {
        if(uid()!= '')
        {
            //check if there is row in purchase table first
            $purchase_id = $this->Shop_model->get_purchase();
             if(empty($purchase_id)){
                $this->db->insert('purchase', ['user_id' => uid()]);
                $purchase_id = $this->db->insert_id();}
            $product_id = $this->input->post('product_id');
            $ret = $this->db->insert('cart', ['user_id' => uid(), 'product_id' => $product_id, 'purchase_id' => $purchase_id]);
             if($ret)
            echo 1;
            else
            echo 0;
        }
        else
        redirect('index.php/Login');
    }
   
    function delete($cart_id = null)
    {
        if($cart_id != null)
        {
            $this->db->where('id', $cart_id);
            $this->db->update('cart', ['deleted' => 1]);
            $this->session->set_flashdata("success", "data deleted successfully");
        }
        redirect('index.php/Shop_cart');
    }

    function deleted_products()
    {
        if(uid()!='')
        {
            $data['title'] = 'Deleted Products';
            $data['deleted_products'] = $this->Shop_model->get_deleted_products();
            $this->load->view('deleted_products', $data);
        }
        else
        redirect('index.php/Login');
    }

    function purchase()
    {
        if($this->Shop_model->add_purchase())
        $this->session->set_flashdata("success", "Products successfully purchased.. Thank You!");
        redirect('index.php/Shop_cart');
    }

}
