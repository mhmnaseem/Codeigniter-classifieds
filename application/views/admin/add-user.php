<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Add User</h1>
                <div id="infoMessage" class="alert-info"><?php echo $this->session->flashdata('message'); ?></div>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <!-- row -->
        <div class="row">

            <p class="validate_msg  btn-danger">Please fix the errors below!</p>
            <div class="col-xs-12 col-sm-6 col-md-6">
                <form action="<?php echo base_url() . 'admin/adduser'; ?>" method="post" onsubmit="return validateForm()" name="myform" id="register_form input" enctype= "multipart/form-data">

                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">

                    <div class="form-group">
                        <p><label>Account Type</label>
                            <select class="form-control" name="acctype">
                                <option value="Admin">Admin</option>
                                <option value="Seller">Seller</option>


                            </select>
                        </p>
                    </div>


                    <div class="form-group">

                        <p><label>First Name </label><input type="text" name="username1" class="form-control" placeholder="First Name"  /><span class="val_name"></span> </p>

                    </div>

                    <div class="form-group">

                        <p><label>Last Name</label> <input type="text" name="username2" class="form-control" placeholder="Last Name"  /><span class="val_name2"></span> </p>

                    </div>

                    <div class="form-group">

                        <p><label>Email </label><input type="text" name="email" class="form-control" placeholder="E-mail"  /><span class="val_email"></span> </p>

                    </div>

                    <div class="form-group">

                        <p><label>Password</label> <input type="text" name="password" class="form-control" placeholder="Password" /><span class="val_password"></span> </p>

                    </div>
                    <div class="form-group">

                        <p><label>Company Name</label> <input type="text" name="company" class="form-control" placeholder="Company name"  /><span class="val_company"></span> </p>

                    </div>
                    <div class="form-group">

                        <p><label>Mobile</label> <input type="tel" name="mobile" class="form-control" placeholder="Mobile Contact"   maxlength="14" /><span class="val_mobile"></span> </p>

                    </div>






                    <button type="submit" class="btn btn-lg btn-ml-login btn-block" name="submit">Add User</button>

                    <br>
                    <br>














                </form>

            </div>
        </div>
        <!-- /.row -->



    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->
<script>
    function validateForm() {

        var validation_holder;

        var validation_holder = 0;

        var un = document.forms["myform"]["username1"].value;

        var un2 = document.forms["myform"]["username2"].value;

        var email = document.forms["myform"]["email"].value;

        var password = document.forms["myform"]["password"].value;


        //var tel = document.forms["myform"]["tel"].value;


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

        if (password == null || password == "") {

            $("span.val_password").html("This field is required.").addClass('validate');

            validation_holder = 1;

        } else {

            $("span.val_name2").html("");

        }


        if (validation_holder == 1) { // if have a field is blank, return false

            $("p.validate_msg").slideDown("fast");

            return false;

        }
        validation_holder = 0;



    }

</script>