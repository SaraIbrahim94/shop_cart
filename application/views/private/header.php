
<title> Shop | <?= $title ?></title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->

<meta name="description" content="Shop">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="apple-touch-icon" href="apple-touch-icon.png">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<link rel="stylesheet" href="<?=base_url()?>assets/style.css">
<link rel="stylesheet" href="<?=base_url()?>assets/bootstrap.min.css">

  <!--[if lte IE 7]><script src="lte-ie7.js"></script><![endif]-->
  <!--[if lt IE 9]><script src="assets/js/vendor/html5-3.6-respond-1.4.2.min.js"></script><![endif]-->

  <?php if(uid() != ''){?>
  <nav class="navbar navbar-light bg-light">
      <a class="navbar-brand" href="<?=base_url()?>index.php/Products">Products</a>
      <a class="navbar-brand" href="<?=base_url()?>index.php/Shop_cart">Shop cart</a>
      <a class="navbar-brand" href="<?=base_url()?>index.php/Products/add">Add product</a>
      <a class="navbar-brand" href="<?=base_url()?>index.php/Shop_cart/deleted_products">Deleted products</a>
      <a class="navbar-brand" href="<?=base_url()?>index.php/Login/log_out">Sign out</a>

  </nav>
  <?php } else {?>
  
  <?php }?>
