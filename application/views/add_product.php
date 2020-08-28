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
    <section>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-8 col-lg-8 col-xl-6">
                    <div class="row">
                        <div class="col text-center">
                            <h1>Add product</h1>
                            <p class="text-h3"> </p>
                        </div>
                    </div>
                    <form action="<?=base_url()?>index.php/Products/add" method="post" enctype="multipart/form-data">
                        <div class="row align-items-center mt-4">
                            <div class="col">
                            <label for="name">Product Name</label>
                                <input type="text" class="form-control" name="name" placeholder="name" >
                                <?php echo form_error('name'); ?>
                            </div>
                        </div>
                        <br>
                        <div class="row align-items-center mt-4">
                            <div class="col"> 
                            <label for="name">Product Description</label>
                                <input type="text" class="form-control" name="description" placeholder="description" >
                                <?php echo form_error('description'); ?>
                            </div>
                        </div>
                        <br>
                        <div class="row align-items-center mt-4">
                            <div class="col"> 
                            <label for="name">Product Price</label>
                                <input type="price" class="form-control" name="price" placeholder="price" >
                                <?php echo form_error('price'); ?>
                            </div>
                        </div>
                        <br>
                        <div class="row align-items-center mt-4">
                            <div class="col"> 
                            <label for="name">Product Photo</label>
                                <input type="file" class="form-control" name="userfile" placeholder="img" >
                                <?php echo form_error('img'); ?>
                            </div>
                        </div>
                        <div class="row justify-content-start mt-4">
                            <div class="col">
                                <input type="submit" value="Save" class="btn btn-primary mt-4">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <?php $this->load->view('private/footer'); ?>
</body>
<script>

setTimeout(function() { 
                    $('#alert').fadeOut('slow'); 
                }, 3000);
</script>

</html>