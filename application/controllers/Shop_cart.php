<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Shop_cart extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Shop_model');
    }
    //default page when go to Shop_cart path
    function index() {
        if(uid() != '')
        {
            $data['title'] = 'Shop Cart';
            $data['products'] = get_cart();
            $this->load->view("shop_cart", $data);
        }
        else
        redirect('Login');
    }
    //adding product to the cart for specific user
    function add()
    {
        //check first if logged in
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
        else//if not redirect to log in page
        redirect('Login');
    }
   //to delete the product from shop cart when user want to
   //it's soft deleted, when delete the flag deleted will be 1
   //then redirect to shop_cart path again
    function delete($cart_id = null)
    {
        if($cart_id != null)
        {
            $this->db->where('id', $cart_id);
            $this->db->update('cart', ['deleted' => 1]);
            $this->session->set_flashdata("success", "data deleted successfully");
        }
        redirect('Shop_cart');
    }
    //this is the deleted products page when click on deleted products from menu navgiation
    function deleted_products()
    {
        if(uid()!='')
        {
            $data['title'] = 'Deleted Products';
            //get all the deleted products for the logged in user
            $data['deleted_products'] = $this->Shop_model->get_deleted_products();
            $this->load->view('deleted_products', $data);
        }
        else
        redirect('Login');
    }
    //when click on purchase button, the purchase row will be updated to be done
    //if succeded will appear success msg, and redirect to shop cart page
    function purchase()
    {
        if($this->Shop_model->add_purchase())
        $this->session->set_flashdata("success", "Products successfully purchased.. Thank You!");
        redirect('Shop_cart');
    }
    //increase and decrease quantity for specific product
    //calculate the total to update it in the shop cart page
    //if updated succeffully success msg appears and quantity changes
    //else error msg appears 
    function quantity()
    {
        $quantity = $this->input->post('quantity');
        $cart_id = $this->input->post('cart_id');
        $this->db->where('id', $cart_id);
        $ret = $this->db->update('cart', ['quantity' => $quantity]);
        $products = get_cart();
        $total = 0;
        if(!empty($products))
        {
            foreach($products as $one)
            {
                $total += $one->price * $one->quantity;
            }
        }
        $data['total'] = $total;
        if($ret)
        {
            $data['flag'] = 1;
            echo json_encode($data);
        }
        else
        {
            $data['flag'] = 0;
            echo json_encode($data);
        }
    }


}
