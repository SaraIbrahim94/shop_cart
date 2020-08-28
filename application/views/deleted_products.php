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
                          username
                        </td>
                        <td class="text-center">
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
                        <fieldset>
                        <legend>Deleted Products from Basket and purchased the rest</legend>
                    <?php if(!empty($deleted_products['purchased_data'])){
                        foreach($deleted_products['purchased_data'] as $one){?>
                      <tr>
                      <td class="text-center">
                      <strong><?=!empty($deleted_products['username'])? $deleted_products['username']:''?></strong>
                        </td>
                        <td class="text-left">
                          <a href="#">
                          <img style="width: 10rem;" src="<?=base_url()?>uploads/thumb/<?=$one->img?>" alt="bikini 1" class="img-responsive  rounded-circle">
                          </a>
                        </td>
                        <td class="text-center">
                          <a href="#"><?=$one->name?></a>
                        </td>
                        <td class="text-center">
                          <div class="input-group btn-block">
                            <input disabled type="text" name="quantity" value="<?=$one->quantity?>" size="1" class="quantity form-control form-white">
                          </div>
                        </td>
                        <td class="text-center">
                          $<span class="item-price"><?=$one->price?></span>
                        </td>
                        <td class="text-right">
                          $<span class="item-total"><?=$one->price * $one->quantity?></span>
                        </td>
                        <td class="text-right">
                            <strong style="color:red;">Deleted</strong> 
                        </td>
                      </tr>
                        <?php }
                    }?>
                    </fieldset>
                    </tbody>
                  </table>
                  <hr>
                  <hr>
                  <table class="table">
                    <thead>
                      <tr>
                      <td>
                          username
                        </td>
                        <td class="text-center">
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
                    <fieldset>
                        <legend>Deleted Products from Basket and still shopping</legend>
                        <?php if(!empty($deleted_products['not_purchased_data'])){
                        foreach($deleted_products['not_purchased_data'] as $one){?>
                      <tr>
                      <td class="text-left">
                          <strong><?=!empty($deleted_products['username'])? $deleted_products['username']:''?></strong>
                        </td>
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
                            <input disabled type="text" name="quantity" value="<?=$one->quantity?>" size="1" class="quantity form-control form-white">
                          </div>
                        </td>
                        <td class="text-center">
                          $<span class="item-price"><?=$one->price?></span>
                        </td>
                        <td class="text-right">
                          $<span class="item-total"><?=$one->price * $one->quantity?></span>
                        </td>
                        <td class="text-right">
                            <strong style="color:red;">Deleted</strong> 
                        </td>
                      </tr>
                        <?php }
                    }?>
                    </fieldset>
                    </tbody>
                  </table>
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