<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="container toppadding-1">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="login-panel panel panel-default" style="margin: 100px 0;">
                <div class="panel-heading">
                    <h3 class="panel-title">Please Sign Up</h3>

                </div>
                <div class="panel-body">
                    <div class="row">
                        <div id="infoMessage" class="alert-info"><?php echo $this->session->flashdata('message'); ?></div>

                        <div class="col-xs-12 col-sm-6 col-md-6">


                            <p>Fields marked with <span class="required">*</span> are mandatory</p>
                            <p class="validate_msg  bg-danger">Please fix the errors below!</p>

                            <form action="<?php echo base_url(); ?>auth/register" method="post" onsubmit="return validateForm()" name="myform" id="register_form input">

                                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                                <div class="form-group">
                                    <p><label>First Name  <span class="required">*</span></label>
                                        <input type="text" name="username1" class="form-control" placeholder="First Name" value="<?php echo set_value('username1'); ?>"/><span class="val_name"></span>
                                    </p>
                                </div>
                                <div class="form-group">
                                    <p><label>Last Name  <span class="required">*</span></label>
                                        <input type="text" name="username2" class="form-control" placeholder="Last Name"  value="<?php echo set_value('username2'); ?>"/><span class="val_name2"></span>
                                    </p>
                                </div>



                                <div class="form-group">
                                    <p><label>E-mail  <span class="required">*</span></label>
                                        <input type="text" name="email" class="form-control" placeholder="E-mail" value="<?php echo set_value('email'); ?>"/><span class="val_email"></span>
                                    </p>
                                </div>


                                <div class="form-group">
                                    <p><label>Password  <span class="required">*</span></label>
                                        <input id="password" type="password" name="password" class="form-control" placeholder="Password" /><span class="val_pass">
                                            <div id="result">
                                                <span>Strength </span>
                                                <div class="progress">
                                                    <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" >
                                                        <span class="sr-only"></span>
                                                    </div>
                                                </div>

                                            </div>

                                    </p>
                                </div>

                                <div class="form-group">
                                    <p><label>Re-type Password  <span class="required">*</span></label>
                                        <input type="password" name="repassword" class="form-control" placeholder="Re-type Password"  /><span class="val_repass"></span>
                                    </p>
                                </div>

                                <div class="form-group">

                                    <p><strong>Select a District <span class="required">*</span></strong>

                                        <select name="province" class="form-control" id="province" data-toggle="tooltip" data-placement="top" title="Item Location">

                                            <option value=""></option>

                                            <?php foreach ($allprovinces as $province) { ?>

                                                <option value="<?php echo $province->id; ?>"><?php echo $province->pro_name; ?></option>


                                            <?php } ?>

                                        </select>
                                        <span class="val_province"></span></p>

                                </div>
                                <div class="form-group">

                                    <p><strong>Select a City <span class="required">*</span></strong>
                                        <select disabled="disabled" name="city" id="city" class="form-control"></select>
                                        <span class="val_city"></span></p>

                                </div>

                                <div class="form-group">

                                    <p><label>Company Name</label> <input type="text" name="company" class="form-control" placeholder="Company Name" value="<?php echo set_value('company'); ?>"/><span class="val_company"></span> </p>

                                </div>
                                <div class="form-group">
                                    <p><label>Phone Number</label> <input type="tel" pattern="^[0-9]{10,10}$" title="You can only enter numbers of 10 characters"  id="phone" name="mobile" class="form-control" placeholder="Phone Number"   maxlength="10" value="<?php echo set_value('mobile'); ?>" /><span class="val_mobile"></span> </p>
                                </div>


                                <div class="footer">

                                    <button type="submit" class="btn btn-lg btn-ml-login btn-block" name="submit">SIGN UP</button>




                                </div>

                            </form>




                        </div>




                        <div class="hidden-xs col-sm-1 col-md-1">

                            <div class="wrapper1">
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
                        </div>

                    </div>
                </div>
            </div>
        </div>


    </div>
</div>



<script type="text/javascript">
    $(document).ready(function() {

        $('#result').hide('');
        $('#password').keyup(function()
        {
            $('#result').html(checkStrength($('#password').val()));
        });

        /*
         checkStrength is function which will do the
         main password strength checking for us
         */

        function checkStrength(password)
        {
            //initial strength
            var strength = 0
            if (password.length < 2) {

                $('#result').hide('');
            }
            //if the password length is less than 6, return message.
            if (password.length < 6 && password.length > 2) {
                $('#result').show('');

                //return 'Too short'
            }

            //length is ok, lets continue.

            //if length is 8 characters or more, increase strength value
            if (password.length > 7)
                strength += 1;

            //if password contains both lower and uppercase characters, increase strength value
            if (password.match(/([a-z].*[A-Z])|([A-Z].*[a-z])/))
                strength += 1;

            //if it has numbers and characters, increase strength value
            if (password.match(/([a-zA-Z])/) && password.match(/([0-9])/))
                strength += 1;

            //if it has one special character, increase strength value
            if (password.match(/([!,%,&,@,#,$,^,*,?,_,~])/))
                strength += 1;

            //if it has two special characters, increase strength value
            if (password.match(/(.*[!,%,&,@,#,$,^,*,?,_,~].*[!,%,&,@,#,$,^,*,?,_,~])/))
                strength += 1;

            //now we have calculated strength value, we can return messages



            //if value is less than 2
            if (strength < 2)
            {

                $('#result').removeClass();
                $('#result').addClass('weak');
                $(".progress-bar").css("width", "20%");
                //return 'Weak'
            } else if (strength == 2)
            {
                $('#result').removeClass();
                $('#result').addClass('good');
                $(".progress-bar").css("width", "50%");
                //return 'Good'
            } else if (strength == 4)
            {
                $('#result').removeClass();
                $('#result').addClass('good');
                $(".progress-bar").css("width", "75%");
                //return 'Good'
            } else
            {
                $('#result').removeClass();
                $('#result').addClass('strong');
                $(".progress-bar").css("width", "100%");
                //return 'Strong'
            }
        }
    });

    function validateForm() {

        var validation_holder;

        var validation_holder = 0;

        var un = document.forms["myform"]["username1"].value;

        var un2 = document.forms["myform"]["username2"].value;

        var email = document.forms["myform"]["email"].value;

        var pwd = document.forms["myform"]["password"].value;

        var repwd = document.forms["myform"]["repassword"].value;

        var province = document.forms["myform"]["province"].value;
        var city = document.forms["myform"]["city"].value;

        var email_regex = /^[\w%_\-.\d]+@[\w.\-]+.[A-Za-z]{2,6}$/;




        if (un == null || un == "") {

            $("span.val_name").html("This field is required.").addClass('validate');

            validation_holder = 1;

        } else {

            $("span.val_name").html("");

        }

        if (un2 == null || un2 == "") {

            $("span.val_name2").html("This field is required.").addClass('validate');

            validation_holder = 1;

        } else {

            $("span.val_name2").html("");

        }

        if (email == "") {

            $("span.val_email").html("This field is required.").addClass('validate');

            validation_holder = 1;

        } else {

            if (!email_regex.test(email)) { // if invalid email

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

        if (province == null || province == "") {

            $("span.val_province").html("This field is required.").addClass('validate');
            validation_holder = 1;
        } else {

            $("span.val_province").html("");
        }
        if (city == null || city == "") {

            $("span.val_city").html("This field is required.").addClass('validate');
            validation_holder = 1;
        } else {

            $("span.val_city").html("");
        }

        if (repwd == null || repwd == "") {

            $("span.val_repass").html("This field is required.").addClass('validate');

            validation_holder = 1;

        } else {

            if (pwd != repwd) {

                $("span.val_repass").html("Passwords do not match.").addClass('validate');

                validation_holder = 1;

            } else {

                $("span.val_repass").html("");

            }



        }



        if (validation_holder == 1) { // if have a field is blank, return false

            $("p.validate_msg").slideDown("fast");

            return false;

        }
        validation_holder = 0;



    }

//    $(document).ready(function() {
//        $('#phone').mask('(000) 000-0000');
//    });

    $("#province").change(function() {
        $('#city').empty();
        var province_id = $('#province').val();
        //console.log(province_id);

        $.ajax({
            type: "POST",
            data: {'province_id': province_id, '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'},
            url: '<?= base_url() ?>seller/getcity/',
            success: function(data) {
                $("#city").prop('disabled', false);

                $.each(data, function(i, data) {
                    $('#city').append("<option  value='" + data.id + "'>" + data.city_name + "</option>");
                    $("#city option:first").attr('selected', 'selected');
                    //console.log(data.id);
                    //console.log(data.city_name);
                });
            }

        });
    }
    );


</script>