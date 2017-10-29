<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Edit User Info</h1>
                <div id="infoMessage" class="alert-info"><?php echo $this->session->flashdata('message'); ?></div>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <!-- row -->
        <div class="row">
            <p>Fields marked with <span class="required">*</span> are mandatory</p>
            <p class="validate_msg  btn-danger">Please fix the errors below!</p>
            <div class="col-xs-12 col-sm-12 col-md-6">
                <form action="<?php echo base_url('profile'); ?>" method="post" onsubmit="return validateForm()" name="myform" id="register_form input" enctype= "multipart/form-data">

                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                    <input type="hidden" name="action" value="update">
                    <?php foreach ($user as $user) { ?>


                        <div class="form-group">

                            <p><label>First Name <span class="required">*</span></label><input type="text" name="username1" class="form-control" placeholder="First Name" value="<?php echo $user->fname; ?>" /><span class="val_name"></span> </p>

                        </div>

                        <div class="form-group">

                            <p><label>Last Name <span class="required">*</span></label> <input type="text" name="username2" class="form-control" placeholder="Last Name" value="<?php echo $user->lname; ?>" /><span class="val_name2"></span> </p>

                        </div>

                        <div class="form-group">

                            <p><strong>Your City <span class="required">*</span></strong>

                                <select name="city" class="form-control">

                                    <?php foreach ($allprovinces as $province) { ?>

                                        <option style="background-color:#000;" disabled="disabled"><?php echo $province->pro_name; ?></option>
                                        <?php
                                        foreach ($allcities as $city) {
                                            if ($province->id == $city->province_id) {
                                                if ($user->user_city == $city->id) {

                                                    echo '<option selected="selected" value="' . $city->id . '">&nbsp;&nbsp;' . $city->city_name . '</option>';
                                                } else {

                                                    echo '<option value="' . $city->id . '">&nbsp;&nbsp;' . $city->city_name . '</option>';
                                                }
                                            }
                                        }
                                        ?>
                                    <?php } ?>

                                </select>
                                <span class="val_city"></span></p>

                        </div>

                        <div class="form-group">

                            <p><label>Company Name</label> <input type="text" name="company" class="form-control" placeholder="Company name"  value="<?php echo $user->company; ?>"/><span class="val_company"></span> </p>

                        </div>
                        <div class="form-group">

                            <p><label>Phone Number</label> <input id="phone" type="tel" pattern="^[0-9]{10,10}$" title="You can only enter numbers of 10 characters" name="mobile" class="form-control" placeholder="Phone Number"   maxlength="10" value="<?php echo $user->mobile; ?>"/><span class="val_mobile"></span> </p>

                        </div>


                        <div class="row">
                            <div class="col-sm-6 col-md-6 xs-margin-10">
                                <button type="submit" class="btn btn-lg btn-ml-login btn-block" name="submit">Update User</button>
                            </div>
                            <div class="col-sm-6 col-md-6">
                                <a class="btn btn-lg btn-ml-cancel btn-block" href="<?php echo base_url('dashboard') ?>">Cancel</a>
                            </div>
                        </div>
                        <br>
                        <br>

                    <?php } ?>
                </form>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6">


                <input  type="hidden" value="+94" id="country_code"  />
                <input  type="hidden" placeholder="phone number" id="phone_number"/>
                <!--                <h4>Update Or Verify Your Phone</h4>
                                <button class="btn btn-success btn-lg" onclick="smsLogin();
                        ">Verify Your Phone</button>-->

                <form id="login_success" method="post" action="<?php echo base_url('phone-verify');
                    ?>">
                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                    <input id="csrf" type="hidden" name="csrf" />
                    <input id="code" type="hidden" name="code" />
                    <input type="hidden" name="action" value="verify">

                </form>

            </div>











        </div>
    </div>
    <!-- /.row -->



</div>
<!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->
<script src="https://sdk.accountkit.com/en_US/sdk.js"></script>
<script>

// initialize Account Kit with CSRF protection
                    AccountKit_OnInteractive = function() {
                        AccountKit.init(
                                {
                                    appId: "1835827223404024",
                                    state: "<?php echo $this->security->get_csrf_hash(); ?>",
                                    version: "v1.1",
                                    fbAppEventsEnabled: true

                                }
                        );
                    };

// login callback
                    function loginCallback(response) {
                        if (response.status === "PARTIALLY_AUTHENTICATED") {

                            document.getElementById("code").value = response.code;
                            document.getElementById("csrf").value = response.state;
                            document.getElementById("login_success").submit();
                            // Send code to server to exchange for access token
                        } else if (response.status === "NOT_AUTHENTICATED") {
                            // handle authentication failure
                            alert("Your Phone Not Verified");
                        } else if (response.status === "BAD_PARAMS") {
                            // handle bad parameters
                            alert("Your Phone Not Verified");
                        }
                    }

// phone form submission handler
                    function smsLogin() {
                        var countryCode = document.getElementById("country_code").value;
                        var phoneNumber = document.getElementById("phone_number").value;
                        AccountKit.login(
                                'PHONE',
                                {countryCode: countryCode, phoneNumber: phoneNumber}, // will use default values if not specified
                                loginCallback
                                );
                    }



</script>

<script>
    function validateForm() {

        var validation_holder;

        var validation_holder = 0;

        var un = document.forms["myform"]["username1"].value;

        var un2 = document.forms["myform"]["username2"].value;

        var city = document.forms["myform"]["city"].value;


        //var tel = document.forms["myform"]["tel"].value;






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

        if (city == null || city == "") {

            $("span.val_city").html("This field is required.").addClass('validate');

            validation_holder = 1;

        } else {

            $("span.val_city").html("");

        }

        /*if(tel == null || tel == "(") {

         $("span.val_tel").html("This field is required.").addClass('validate');

         validation_holder = 1;

         }else {

         $("span.val_tel").html("");

         }
         */


        if (validation_holder == 1) { // if have a field is blank, return false

            $("p.validate_msg").slideDown("fast");

            return false;

        }
        validation_holder = 0;



    }

//    $(document).ready(function() {
//        $('#phone').mask('(000) 000-0000');
//    });

</script>