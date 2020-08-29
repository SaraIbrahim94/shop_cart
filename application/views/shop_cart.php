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
  <strong>Success!</strong> Quantity changed Successfully.
</div>
<div style="display:none;" id="msg-alert-dngr" class="alert alert-danger" role="alert">
  <strong>Oh noo!</strong> Couldn't change the Quantity..
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
                          Subtotal
                        </td>
                        <td class="text-right">
                          Action
                        </td>
                      </tr>
                    </thead>
                    <tbody>
                    <?php if(!empty($products)){ $total = 0;
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
                            <input onchange="quantity('<?=$one->id?>', '<?=$one->price?>')" id="quantity<?=$one->id?>" type="text"  name="quantity" value="<?=$one->quantity?>" size="1" class="quantity form-control form-white">
                          </div>
                        </td>
                        <td class="text-center">
                          $<span class="item-price"><?=$one->price?></span>
                        </td>
                        <td class="text-right">
                          $<span class="item-total" id="sub_total<?=$one->id?>"><?=$one->price * $one->quantity?></span>
                        </td>
                        <td class="text-right">
                          <a data-rel="tooltip" data-original-title="Remove" style="color:red; cursor:pointer;" href="<?=base_url()?>Shop_cart/delete/<?=$one->id?>" data-placement="left" class="">X</a>
                        </td>

                      </tr>
                     <?php $total += $one->price * $one->quantity; ?>
                        <?php }
                    }?>
                    
                    </tbody>
                  </table>
                  <div>
                  <?php if(!empty($products)){?>
                        <strong style="margin-left:680px; font-size:1.4rem;" id="total">Total:&nbsp;$<?=!empty($total)?$total:'';?>
                        </strong>
                  <?php }?>
                    </div>
                  <hr>
                  <div class="text-right">
                  <?php if(!empty($products)){?>
                    <a href="<?=base_url()?>Shop_cart/purchase" class="btn btn-success">Purchase</a>
                  <?php }?>
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
function quantity(cart_id, price){
        var quantity = $('#quantity'+cart_id).val();
        if(quantity == '' || quantity == 0)
          alert('quantity cannot be empty or 0');
          else 
          {
            $('#sub_total'+ cart_id).html(quantity * price);
          var postData = {
                quantity: quantity,
                cart_id: cart_id,
                <?= $this->security->get_csrf_token_name() ?>: '<?= $this->security->get_csrf_hash() ?>'
            };
            $.ajax({
                url: "<?= base_url(); ?>Shop_cart/quantity",
                method: "POST",
                data: postData,
                dataType:"json",
                success: function(data) {
                  if(data.flag==1)
                  {
                        $('#total').html('Total:&nbsp;$' + data.total);
                        $('#msg-alert-succ').fadeIn('slow');
                        setTimeout(function() { 
                            $('#msg-alert-succ').fadeOut('slow');
                    }, 3000);
                  }
                  else if(data.flag==0)
                  {
                    $('#msg-alert-dngr').fadeIn('slow');
                        setTimeout(function() { 
                            $('#msg-alert-dngr').fadeOut('slow');
                    }, 3000);
                  }
                }
            });
          }
}
</script>
</html>