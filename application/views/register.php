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
                            <h1>Register</h1>
                            <p class="text-h3">Happiness is Shopping </p>
                        </div>
                    </div>
                    <form id="form" action="<?=base_url()?>index.php/Register/validation" method="post">
                        <div class="row align-items-center">
                            <div class="col mt-4">
                                <input type="text" class="form-control" name="username" placeholder="Username" >
                                <?php echo form_error('username'); ?>
                            </div>
                        </div>
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
                            <br>
                            <div class="col">
                                <input type="password" class="form-control" name="confirm_password" placeholder="Confirm Password" >
                                <?php echo form_error('confirm_password'); ?>
                            </div>
                        </div>
                        <div class="row justify-content-start mt-4">
                            <div class="col">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="checkbox" id="terms_check" class="form-check-input">
                                        &nbsp;&nbsp;I Read and Accept <a href="#">Terms and Conditions</a>
                                    </label>
                                </div>
                                <br>
                            <h5>Already have account? <a href="<?=base_url()?>index.php/Login">Login</a></h5>
                                <button id="sbmit_btn" class="btn btn-primary mt-4"> Submit </button>
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
                $('#sbmit_btn').click(function(){
                    if(!document.getElementById("terms_check").checked)
                        alert('you have to check the terms and conditions first');
                    else
                    document.getElementById("form").submit();
                    
                });
                </script>

</html>