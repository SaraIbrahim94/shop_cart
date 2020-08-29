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
                            <h1>Login</h1>
                            <p class="text-h3">Happiness is Shopping </p>
                        </div>
                    </div>
                    <form action="<?=base_url()?>Login/do_login" method="post">
                        <div class="row align-items-center mt-4">
                            <div class="col">
                                <input type="email" class="form-control" name="email" placeholder="Email" >
                                <?php echo form_error('email'); ?>
                            </div>
                        </div>
                        <div class="row align-items-center mt-4">
                            <div class="col"> 
                                <input type="password" class="form-control" name="password" placeholder="Password" >
                                <?php echo form_error('password'); ?>
                            </div>
                        </div>
                        <br>
                        <h5>Don't have account? <a href="<?=base_url()?>Register">Register</a></h5>
                        <div class="row justify-content-start mt-4">
                            <div class="col">
                                <input type="submit" value="Submit" class="btn btn-primary mt-4">
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