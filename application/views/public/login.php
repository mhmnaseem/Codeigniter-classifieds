<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="login-panel panel panel-default" style="margin: 100px 0;">
                <div class="panel-heading">
                    <h3 class="panel-title">Please Sign In</h3>

                </div>
                <div class="panel-body">
                    <div class="row">
                        <div id="infoMessage" class="alert-info">
                            <?php
                            if ($this->session->flashdata('message')) {
                                echo $this->session->flashdata('message');
                            }
                            ?>
                        </div>
                        <div class="col-xs-12 col-sm-5 col-md-5">

                            <form action="<?php echo base_url(); ?>auth/login" method="post" onsubmit="return validateForm()" name="myform" id="register_form input">
                                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">


                                <fieldset>
                                    <div class="form-group">
                                        <input class="form-control" placeholder="E-mail" name="email" type="email" autofocus>
                                        <span class="val_email"></span>
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control" placeholder="Password" name="password" type="password" value="">
                                        <span class="val_pass"></span>
                                    </div>
                                    <!--                                    <div class="checkbox">
                                                                            <label>
                                                                                <input name="remember" type="checkbox" value="Remember Me">Remember Me

                                                                            </label>
                                                                        </div>-->



                                    <!-- Change this to a button or input when using this as a form -->

                                    <button type="submit" class="btn btn-lg btn-ml-login btn-block" name="submit">Sign In</button>

                                    <a class="pull-right" href="<?php echo base_url('forgotpassword'); ?>">Forgot Password?</a>
                                </fieldset>
                            </form>
                        </div>

                        <div class="hidden-xs col-sm-1 col-md-1">

                            <div class="wrapper">
                                <div class="line"></div>
                                <div class="wordwrapper">
                                    <div class="word">or</div>
                                </div>
                            </div>

                        </div>

                        <!-- banner space -->
                        <div class="col-xs-12 col-sm-5 col-md-5" style="margin-top: 35px;">
                            <p class="text-center">
                                <a href="<?php echo $this->facebook->login_url(); ?>" class="text-center"><img src="<?php echo base_url(); ?>asset/images/btn-facebook.png"/></a>

                                <?php if (isset($authUrl)) { ?>
                                    <a href="<?php echo $authUrl; ?>" class="text-center"><img src="<?php echo base_url(); ?>asset/images/btn_google+.png"/></a>
                                <?php } ?>


                            </p>
                            <p style="margin-top: 20px;"><span>Need a Birthdays.lk Account?<a href="<?php echo site_url('register'); ?>" class="text-center"> Sign Up</a></span></p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">

    function validateForm() {

        var validation_holder;

        var validation_holder = 0;

        var un = document.forms["myform"]["email"].value;

        var pwd = document.forms["myform"]["password"].value;

        var email_regex = /^[\w%_\-.\d]+@[\w.\-]+.[A-Za-z]{2,6}$/;





        if (un == "") {

            $("span.val_email").html("This field is required.").addClass('validate');

            validation_holder = 1;

        } else {

            if (!email_regex.test(un)) { // if invalid email

                $("span.val_email").html("Invalid Email!").addClass('validate');

                validation_holder = 1;

            } else {

                $("span.val_email").html("");

            }

        }

        if (pwd == null || pwd == "") {

            $("span.val_pass").html("This field is required.").addClass('validate');

            validation_holder = 1;

        } else {

            $("span.val_pass").html("");

        }

        if (validation_holder == 1) { // if have a field is blank, return false

            $("p.validate_msg").slideDown("fast");

            return false;

        }
        validation_holder = 0;



    }

</script>
