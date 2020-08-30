<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Products extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Shop_model');
    }
    //redirect to the products page
    function index() {
        if(uid() != ''){
            $data['title'] = 'Products';
            $data['products'] = $this->Shop_model->get_all_data('products');
            $this->load->view("products", $data);
        }
        else
        redirect('Login');

    }
    //add new product to products list
   function add()
   {
       //check if user is logged in first
        if(uid() != ''){
            //must enter product name and price
            $this->form_validation->set_rules("name", "name", "trim|required")
                    ->set_rules("price", "price", "trim|required");
            if ($this->form_validation->run()) {
                //if fields is filled then add them to products table in database
                //get all input data using POST 
                $dt = $this->input->post();
                $data = [];
                foreach ($dt as $k => $v):
                    $data[$k] = $v;
                endforeach;
                unset($data['userfile']);
                //check if there is an image uploaded
                if ($_FILES['userfile']['name'] != '') {
                    $config['upload_path'] = './uploads/products';
                    $config['allowed_types'] = 'jpg|png|jpeg';
                    $this->load->library("upload", $config);
                    if ($this->upload->do_upload()) {
                        $upload_data = $this->upload->data();
                        $data['img'] = $upload_data['file_name'];
                        //to make all images with same sizes as needed
                        $this->resizeImage($upload_data['file_name'], 100, 100);
                    } else {
                        $this->session->set_flashdata("error", "image could not be uploaded");
                        redirect(base_url('Products/add'));
                    }
                }
                $this->db->insert('products',$data);
                $this->session->set_flashdata("success", "data submitted successfully");
                redirect(base_url('Products'));
            }
            else
            {
                $data['title'] = 'Add Product';
                $this->load->view("add_product", $data);
            }
        }
        else//if not so redirect to login page
        redirect('Login');

   }
   //resize the given image with given width and height
   function resizeImage($filename, $width, $height) {
       //orignial image path
    $source_path = FCPATH . '/uploads/products/' . $filename;
       //The resized image path
    $target_path = FCPATH . '/uploads/thumb/';
    $config_manip = array(
        'image_library' => 'gd2',
        'source_image' => $source_path,
        'new_image' => $target_path,
        'maintain_ratio' => FALSE,
        'create_thumb' => TRUE,
        'thumb_marker' => '',
        'width' => $width,
        'height' => $height
    );
    $this->load->library('image_lib', $config_manip);
    $this->image_lib->initialize($config_manip);
    $this->image_lib->resize();
    $this->image_lib->clear();
}

}
