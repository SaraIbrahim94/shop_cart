<!DOCTYPE html>
<html lang="en">

<head>
<?php $this->load->view('private/header', $title); ?>
</head>
<body>
<div id="alert">
<?= flash_success() ?>
 <?= flash_error() ?>
 </div>
 <div style="display:none;" id="msg-alert-succ" class="alert alert-success" role="alert">
  <strong>Greate Option!</strong> Successfully added to cart.
</div>
<div style="display:none;" id="msg-alert-dngr" class="alert alert-danger" role="alert">
  <strong>Oh noo!</strong> Couldn't added to Cart, please check it again.
</div>
    <div class="container">
        <div class="row shop-card">
        <?php if(!empty($products)){
            foreach($products as $one){?>
            <fieldset>
                <div class="col col-sm-6">
                    <div class="card" style="width: 18rem;">
                        <img src="<?=base_url()?>uploads/thumb/<?=$one->img?>" class="card-img-top rounded-circle" alt="...">
                        <div class="card-body">
                            <h5 class="card-title"><?=$one->name?></h5>
                            <p class="card-text"><?=$one->description?></p>
                            <a onclick="add_cart(<?=$one->id?>)" class="btn btn-primary">add to cart</a>
                        </div>
                    </div>
                </div>
            </fieldset>
        <?php }
            }?>
        </div>
    </div>
  
    <?php $this->load->view('private/footer'); ?>
</body>
<script>
 setTimeout(function() { 
                    $('#alert').fadeOut('slow'); 
                }, 3000);

      function add_cart(product_id){
            var postData = {
            product_id: product_id,
            <?= $this->security->get_csrf_token_name() ?>: '<?= $this->security->get_csrf_hash() ?>'
        };
        $.ajax({
            url: "<?= base_url(); ?>index.php/Shop_cart/add",
            method: "POST",
            data: postData,
            success: function(data) {
               if(data==1)
               {
                    $('#msg-alert-succ').fadeIn('slow');
                    setTimeout(function() { 
                        $('#msg-alert-succ').fadeOut('slow');
                }, 3000);
               }
               else if(data==0)
               {
                $('#msg-alert-dngr').fadeIn('slow');
                    setTimeout(function() { 
                        $('#msg-alert-dngr').fadeOut('slow');
                }, 3000);
               }
            }
        });
       } 
                </script>
</html>