<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Add Venues</h1>
                <div id="infoMessage" class="alert-info"><?php echo $this->session->flashdata('message'); ?></div>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <!-- row -->
        <div class="row">


            <div class="col-xs-12 col-sm-6 col-md-6">
                <p class="validate_msg  btn-danger">Please fix the errors below!</p>
                <form enctype="multipart/form-data"  method="post" action="<?php echo base_url() ?>admin/addvenue" id="form" onsubmit="return validateForm()" name="myform">
                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">

                    <div class="form-group">
                        <p><strong>Title</strong>


                            <input type="text" name="title" class="form-control">
                            <span class="val_title"></span></p>
                    </div>

                    <div class="form-group">
                        <p><strong>Address</strong>


                            <input type="text" name="address"  class="form-control">

                            <span class="val_address"></span></p>
                    </div>
                    <div class="form-group">
                        <p><strong>Telephone</strong>


                            <input type="tel" name="telephone"  class="form-control">

                            <span class="val_telephone"></span></p>
                    </div>
                    <div class="form-group">
                        <p><strong>Email</strong>


                            <input type="email" name="email"  class="form-control">

                            <span class="val_email"></span></p>
                    </div>
                    <div class="form-group">
                        <p><strong>Web address (with http://)</strong>


                            <input type="text" name="web"  class="form-control">

                            <span class="val_web"></span></p>
                    </div>
                    <div class="form-group">
                        <p>
                            <label>Upload Image</label>
                            <input type="file" name="userfile" size="20" />
                            <span class="val_image"></span> </p>

                    </div>
                    <button type="submit" class="btn btn-lg btn-ml-login btn-block" name="submit">Add Venue</button>
                    <br>
                    <br>
                </form>

            </div>

            <div class="col-xs-12 col-sm-6 col-md-6">

            </div>

        </div>


    </div>
</div>

</div>
</div>


<script>

    function validateForm() {

        var validation_holder;

        var validation_holder = 0;

        var title = document.forms["myform"]["title"].value;
        var address = document.forms["myform"]["address"].value;
        //var telephone = document.forms["myform"]["telephone"].value;
        //var email = document.forms["myform"]["email"].value;
        // var web = document.forms["myform"]["web"].value;
        var userfile = document.forms["myform"]["userfile"].value;


        if (title == null || title == "") {

            $("span.val_title").html("This field is required.").addClass('validate');

            validation_holder = 1;

        } else {

            $("span.val_title").html("");

        }

        if (address == null || address == "") {

            $("span.val_address").html("This field is required.").addClass('validate');

            validation_holder = 1;

        } else {

            $("span.val_address").html("");

        }
//        if (telephone == null || telephone == "") {
//
//            $("span.val_telephone").html("This field is required.").addClass('validate');
//
//            validation_holder = 1;
//
//        } else {
//
//            $("span.val_telephone").html("");
//
//        }
//        if (email == null || email == "") {
//
//            $("span.val_email").html("This field is required.").addClass('validate');
//
//            validation_holder = 1;
//
//        } else {
//
//            $("span.val_email").html("");
//
//        }
//        if (web == null || web == "") {
//
//            $("span.val_web").html("This field is required.").addClass('validate');
//
//            validation_holder = 1;
//
//        } else {
//
//            $("span.val_web").html("");
//
//        }
        if (userfile == null || userfile == "") {

            $("span.val_image").html("This field is required.").addClass('validate');

            validation_holder = 1;

        } else {

            $("span.val_image").html("");

        }




        if (validation_holder == 1) { // if have a field is blank, return false

            $("p.validate_msg").slideDown("fast");

            return false;

        }
        validation_holder = 0;



    }

</script>