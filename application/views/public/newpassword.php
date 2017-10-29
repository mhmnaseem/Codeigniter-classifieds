
<div class="container toppadding">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="login-panel panel panel-default" style="margin: 100px 0;">
                <div class="panel-heading">
                    <h3 class="panel-title">Change Password</h3>

                </div>
                <div class="panel-body">
                    <div class="row">
                        <div id="infoMessage" class="alert-info"><?php echo $this->session->flashdata('message'); ?></div>
                        <?php
                        if ($msg == 'ok') {
                            echo '<div class="alert alert-success" role="alert"><span>Password Reset Successfull. </span></div>
			<p class="text-center">Click <a href="' . base_url('login') . '">Here </a>to Sign in.</p>';
                        } else {
                            if ($msg == 'error') {
                                echo '<div class="alert alert-danger" role="alert"><span>Email or Reset Code Does not Match!. Please Enter the correct reset code</span></div>';
                            }
                            ?>

                            <div class="col-xs-12 col-sm-5 col-md-5">

                                <p class="validate_msg  btn-danger">Please fix the errors below!</p>
                                <form action="<?php echo base_url(); ?>auth/newpwd" method="post" onSubmit="return validateForm()" name="myform" id="register_form input">
                                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                                    <div class="body bg-gray">
                                        <div class="form-group"> </div>
                                        <div class="form-group">
                                            <p>
                                                <input type="text" name="email" class="form-control" placeholder="E-mail"/>
                                                <span class="val_email"></span> </p>
                                        </div>
                                        <div class="form-group">
                                            <p> <input type="text" name="code" class="form-control" placeholder="Reset Code"/>
                                                <span class="val_code"></span></p>
                                        </div>
                                        <div class="form-group">
                                            <p>
                                                <input type="password" name="password" class="form-control" placeholder="Password"/>
                                                <span class="val_pass"></span> </p>
                                        </div>
                                        <div class="form-group">
                                            <p>
                                                <input type="password" name="repassword" class="form-control" placeholder="Re-Type Password"/>
                                                <span class="val_repass"></span> </p>
                                        </div>

                                    </div>
                                    <div class="footer">
                                        <button type="submit" class="btn btn-lg btn-ml-login btn-block" name="submit">Reset Password</button>
                                    </div>
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

                                <p style="margin-top: 20px;"><span>Have a Birthdays.lk Account?<a href="<?php echo site_url('login'); ?>" class="text-center"> Sign In</a></span></p>
                                <p style="margin-top: 20px;"><span>Need a Birthdays.lk Account?<a href="<?php echo site_url('register'); ?>" class="text-center"> Sign Up</a></span></p>
                            </div>

                        <?php } ?>
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
        var code = document.forms["myform"]["code"].value;

        var repwd = document.forms["myform"]["repassword"].value;


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



        if (repwd == null || repwd == "") {

            $("span.val_repass").html("This field is required.").addClass('validate');

            validation_holder = 1;

        } else {

            if (pwd != repwd) {

                $("span.val_repass").html("Password not matched.").addClass('validate');

                validation_holder = 1;

            } else {

                $("span.val_repass").html("");

            }



        }
        if (code == null || code == "") {

            $("span.val_code").html("This field is required.").addClass('validate');

            validation_holder = 1;

        } else {

            $("span.val_code").html("");

        }



        if (validation_holder == 1) { // if have a field is blank, return false

            $("p.validate_msg").slideDown("fast");

            return false;

        }
        validation_holder = 0;



    }

</script>