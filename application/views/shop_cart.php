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
<fieldset class="cart-summary">
            <legend style="text-align:center;">Cart Summary</legend>
              <div class="col-md-7 col-md-offset-1">
                <div class="table-responsive shopping-cart-table">
                  <table class="table">
                    <thead>
                      <tr>
                        <td>
                          Image
                        </td>
                        <td class="text-center">
                          Product Details
                        </td>
                        <td class="text-center">
                          Quantity
                        </td>
                        <td class="text-center">
                          Price
                        </td>
                        <td class="text-right">
                          Total
                        </td>
                        <td class="text-right">
                          Action
                        </td>
                      </tr>
                    </thead>
                    <tbody>
                    <?php if(!empty($products)){
                        foreach($products as $one){?>
                      <tr>
                        <td class="text-center">
                          <a href="#">
                          <img style="width: 10rem;" src="<?=base_url()?>uploads/thumb/<?=$one->img?>" alt="bikini 1" class="img-responsive  rounded-circle">
                          </a>
                        </td>
                        <td class="text-center">
                          <a href="#"><?=$one->name?></a>
                        </td>
                        <td class="text-center">
                          <div class="input-group btn-block">
                            <input type="text" name="quantity" value="<?=$one->quantity?>" size="1" class="quantity form-control form-white">
                          </div>
                        </td>
                        <td class="text-center">
                          $<span class="item-price"><?=$one->price?></span>
                        </td>
                        <td class="text-right">
                          $<span class="item-total"><?=$one->price * $one->quantity?></span>
                        </td>
                        <td class="text-right">
                          <a data-rel="tooltip" data-original-title="Remove" style="color:red; cursor:pointer;" href="<?=base_url()?>index.php/Shop_cart/delete/<?=$one->id?>" data-placement="left" class="">X</a>
                        </td>
                      </tr>
                        <?php }
                    }?>
                    </tbody>
                  </table>
                  <hr>
                  <div class="text-right">
                    <a href="<?=base_url()?>index.php/Shop_cart/purchase" class="btn btn-success">Purchase</a>
                  </div>
                </div>
              </div>
            </div>
          </fieldset>

   <?php $this->load->view('private/footer'); ?>
</body>
<script>
   setTimeout(function() { 
                    $('#alert').fadeOut('slow'); 
                }, 3000);
</script>
</html>