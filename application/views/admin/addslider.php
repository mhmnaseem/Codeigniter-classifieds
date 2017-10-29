<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Add Slider</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->

        <div class="row">
            <p class="validate_msg  alert-error">Please fix the errors below!</p>
            <form method="POST" enctype="multipart/form-data" action="<?php echo base_url(); ?>admin/addslider" onsubmit="return validateForm()" name="regform">
                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                <div class="col-md-6">

                    <div class="form-group">
                        <p>
                            <label>Upload Image (Size 1400px * 450px)</label>
                            <input type="file" name="userfile" size="20" />
                            <span class="val_title"></span> </p>

                    </div>

                    <div class="form-group">
                        <p>
                            <label>Link (fullpath with https)</label>
                            <input type="text" name="link" class="form-control" placeholder="Link" />
                            <span class="val_link"></span> </p>

                    </div>

                    <!--                    Los Angeles <br> San Francisco-->

                    <div class="">
                        <button type="submit" class="btn btn-lg btn-ml-login btn-block">Add Slider</button>
                        <br>
                        <br>
                    </div>
                </div>
            </form>
        </div>


    </div>
</div>

<script type="text/javascript">

    function validateForm() {

        var validation_holder;

        var validation_holder = 0;

        var file = document.forms["regform"]["userfile"].value;
        var link = document.forms["regform"]["link"].value;

        if (file == "") {

            $("span.val_title").html("This field is required.").addClass('validate');

            validation_holder = 1;


        } else {

            $("span.val_title").html("");

        }

        if (link == "") {

            $("span.val_link").html("This field is required.").addClass('validate');

            validation_holder = 1;


        } else {

            $("span.val_link").html("");

        }


        if (validation_holder == 1) { // if have a field is blank, return false

            $("p.validate_msg").slideDown("fast");

            return false;

        }
        validation_holder = 0;



    }



</script>


