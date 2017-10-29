<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Add Themes</h1>
                <div id="infoMessage" class="alert-info"><?php echo $this->session->flashdata('message'); ?></div>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->


        <!-- .row -->
        <div class="row">
            <div class="col-lg-6">
                <p class="validate_msg  bg-danger">Please fix the errors below!</p>
                <form enctype="multipart/form-data" action="<?php echo base_url(); ?>admin/addTheme" method="post" onsubmit="return validateForm()" name="myform" id="register_form input">
                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                    <div class="form-group">
                        <p>Theme Name <input type="text" name="name" class="form-control" placeholder="Theme name"/><span class="val_name"></span> </p>
                    </div>

                    <div class="form-group">
                        <p>Theme Type <select name="type" class="form-control">
                                <option value="All">All</option>
                                <option value="Popular">Popular</option>

                            </select><span class="val_type"></span> </p>
                    </div>

                    <div class="form-group">
                        <p>
                            <label>Upload Image</label>
                            <input type="file" name="userfile" size="20" />
                            <span class="val_image"></span>
                        </p>

                    </div>

                    <button type="submit" class="btn btn-lg btn-ml-login btn-block" name="submit">Add Theme</button>



                </form>
            </div>
            <!-- /.col-lg-6 -->
        </div>
        <!-- /.row -->



    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->
<script type="text/javascript">


    function validateForm() {
        var validation_holder;
        var validation_holder = 0;
        var name = document.forms["myform"]["name"].value;
        var type = document.forms["myform"]["type"].value;
        var userfile = document.forms["myform"]["userfile"].value;


        if (name == "") {
            $("span.val_name").html("This field is required.").addClass('validate');
            validation_holder = 1;
        } else {
            $("span.val_name").html("");
        }

        if (type == "") {

            $("span.val_type").html("This field is required.").addClass('validate');

            validation_holder = 1;

        } else {
            $("span.val_type").html("");
        }


        if (userfile == "") {

            $("span.val_image").html("This field is required.").addClass('validate');

            validation_holder = 1;

        } else {
            $("span.val_image").html("");
        }



        if (validation_holder == 1) {
            $("p.validate_msg").slideDown("fast");
            return false;
        }
        validation_holder = 0;

    }
</script>