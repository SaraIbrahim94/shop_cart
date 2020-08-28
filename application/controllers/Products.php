<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Products extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Shop_model');
    }

    function index() {
        if(uid() != ''){
            $data['title'] = 'Products';
            $data['products'] = $this->Shop_model->get_all_data('products');
            $this->load->view("products", $data);
        }
        else
        redirect('index.php/Login');

    }

   function add()
   {
        if(uid() != ''){
            $this->form_validation->set_rules("name", "name", "trim|required")
                    ->set_rules("price", "price", "trim|required");
            if ($this->form_validation->run()) {
                $dt = $this->input->post();
                $data = [];
                foreach ($dt as $k => $v):
                    $data[$k] = $v;
                endforeach;
                unset($data['userfile']);

                if ($_FILES['userfile']['name'] != '') {
                    $config['upload_path'] = './uploads/products';
                    $config['allowed_types'] = 'jpg|png|jpeg';
                    $this->load->library("upload", $config);
                    if ($this->upload->do_upload()) {
                        $upload_data = $this->upload->data();
                        $data['img'] = $upload_data['file_name'];
                        $this->resizeImage($upload_data['file_name'], 100, 100);
                    } else {
                        $this->session->set_flashdata("error", "image could not be uploaded");
                        redirect(base_url('Products/add'));
                    }
                }
                $this->db->insert('products',$data);
                $this->session->set_flashdata("success", "data submitted successfully");
                redirect(base_url('index.php/Products'));
            }
            else
            {
                $data['title'] = 'Add Product';
                $this->load->view("add_product", $data);
            }
        }
        else
        redirect('index.php/Login');

   }

   function resizeImage($filename, $width, $height) {
    $source_path = FCPATH . '/uploads/products/' . $filename;
   
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
