<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Change Password</h1>
                <div id="infoMessage" class="alert-info"><?php echo $this->session->flashdata('message'); ?></div>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <!-- row -->
        <div class="row">

            <p class="validate_msg  btn-danger">Please fix the errors below!</p>
            <div class="col-xs-12 col-sm-12 col-md-6">


                <form action="<?php echo base_url('change-my-password'); ?>" method="post" onsubmit="return validateForm()" name="myform" id="register_form input">
                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">


                    <div class="form-group">

                        <p>Old Password <input type="password" name="oldpwd" class="form-control" placeholder="Old Password"  /><span class="val_oldpwd"></span> </p>

                    </div>

                    <div class="form-group">

                        <p>New Password <input type="password" name="newpwd" class="form-control" placeholder="New Password" id="password" />


                        <div id="result">
                            <span>Strength </span>
                            <div class="progress">
                                <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" >
                                    <span class="sr-only"></span>
                                </div>
                            </div>

                        </div>

                        <span class="val_newpwd"></span> </p>



                    </div>

                    <div class="form-group">

                        <p>Re-new Password <input type="password" name="renewpwd" class="form-control" placeholder="Re-new Password" /><span class="val_renewpwd"></span> </p>

                    </div>

                    <div class="row">
                        <div class="col-sm-6 col-md-6 xs-margin-10">
                            <button type="submit" class="btn btn-lg btn-ml-login btn-block" name="submit">Update Password</button>
                        </div>
                        <div class="col-sm-6">
                            <a class="btn btn-lg btn-ml-cancel btn-block" href="<?php echo base_url('dashboard') ?>">Cancel</a>
                        </div>
                    </div>
                    <br>
                    <br>



                    </div>




                </form>



            </div>
        </div>


    </div> <!--End Row -->




    <script type="text/javascript">
        $(document).ready(function()
        {
            /*
             assigning keyup event to password field
             so everytime user type code will execute
             */
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

            var oldpwd = document.forms["myform"]["oldpwd"].value;

            var newpwd = document.forms["myform"]["newpwd"].value;

            var renewpwd = document.forms["myform"]["renewpwd"].value;


            if (oldpwd == null || oldpwd == "") {

                $("span.val_oldpwd").html("This field is required.").addClass('validate');

                validation_holder = 1;

            } else {

                $("span.val_oldpwd").html("");

            }

            if (newpwd == null || newpwd == "") {

                $("span.val_newpwd").html("This field is required.").addClass('validate');

                validation_holder = 1;

            } else {

                $("span.val_newpwd").html("");

            }

            if (renewpwd == "") {

                $("span.val_renewpwd").html("This field is required.").addClass('validate');

                validation_holder = 1;

            } else {

                if (renewpwd != newpwd) { // if invalid email

                    $("span.val_renewpwd").html("Password Does Not Matched!").addClass('validate');

                    validation_holder = 1;

                } else {

                    $("span.val_renewpwd").html("");

                }

            }



            if (validation_holder == 1) { // if have a field is blank, return false

                $("p.validate_msg").slideDown("fast");

                return false;

            }
            validation_holder = 0;



        }

    </script>

</div>
