
<?php 

function uid() {
    $CI = &get_instance();
    return $CI->session->userdata("user_id");
}

//general success msg label
function flash_success() {
    $CI = &get_instance();
    $flash = "";
    if ($CI->session->flashdata("success")) {
        $flash .= "<div class='row'>
                <div class='col-md-12'>
                    <div class='alert alert-block alert-success fade in'>
                        <a class='close' data-dismiss='alert' href='#'>×</a>
                        <p></p><h4><i class='fa fa-check'></i> " . $CI->session->flashdata("success") . "</h4><p></p>
                    </div>
                </div>
            </div>
    ";
    }
    return $flash;
}
//general error msg label
function flash_error() {
    $CI = &get_instance();
    $flash = "";
    if ($CI->session->flashdata("error")) {
        $flash .= "<div class='row'>
                <div class='col-md-12'>
                    <div class='alert alert-block alert-danger fade in'>
                        <a class='close' data-dismiss='alert' href='#'>×</a>
                        <p></p><h4><i class='fa fa-times'></i> " . $CI->session->flashdata("error") . "</h4><p></p>
                    </div>
                </div>
            </div>
    ";
    }
    return $flash;
}

//get all cart data for specified user
//firstly get the purchase row id
//then get products data by joining cart and products tables
function get_cart()
{
    $CI = &get_instance();
    $purchase_id = $CI->db->select('id')->from('purchase')->where('user_id', uid())->where('done !=',1)->get()->row('id');
    $CI->db->select('cart.* , p.name, p.price, p.img, p.description')->from('cart')->where('cart.purchase_id', $purchase_id)->where('cart.deleted !=',1);
    $CI->db->join('products as p', 'p.id = cart.product_id');
    return $CI->db->get()->result();
}


?>