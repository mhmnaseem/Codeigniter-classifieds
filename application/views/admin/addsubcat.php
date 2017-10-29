<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Add Sub Catergory</h1>
                <div id="infoMessage" class="alert-info"><?php echo $this->session->flashdata('message'); ?></div>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->


        <!-- .row -->
        <div class="row">
            <div class="col-lg-6">
                <p class="validate_msg  bg-danger">Please fix the errors below!</p>
                <form enctype="multipart/form-data" action="<?php echo base_url(); ?>admin/addSubCat" method="post" onsubmit="return validateForm()" name="myform" id="register_form input">
                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                    <div class="form-group">
                        <p>Parent Category <select name="pcat" class="form-control">
                                <option value="">--Select Parent Category--</option>
                                <?php foreach ($allMcats as $cats) { ?>
                                    <option value="<?php echo $cats->mcatid; ?>"><?php echo $cats->name; ?></option>
                                <?php } ?>
                            </select><span class="val_pcat"></span> </p>
                    </div>
                    <div class="form-group">
                        <p>Sub Category Name <input type="text" name="cname" class="form-control" placeholder="Category Name"/><span class="val_email"></span> </p>
                    </div>

                    <div class="form-group">
                        <p>Sub Category Url Name (Use "-" or "_" instead of spaces)<input type="text" name="curl" class="form-control" placeholder="Category Url Name"/><span class="val_slug"></span> </p>
                    </div>
                    <div class="form-group">

                        <p>Sub Category Description <textarea name="dis" class="form-control" placeholder="Description"></textarea><span class="val_dis"></span> </p>

                    </div>
                    <div class="form-group">
                        <p>
                            <label>Upload Image</label>
                            <input type="file" name="userfile" size="20" />
                        </p>

                    </div>

                    <button type="submit" class="btn btn-lg btn-ml-login btn-block" name="submit">Add Sub Category</button>
                    <br>
                    <br>


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
        var cn = document.forms["myform"]["cname"].value;
        var pcat = document.forms["myform"]["pcat"].value;
        var dis = document.forms["myform"]["dis"].value;
        var url = document.forms["myform"]["curl"].value;

        if (url == "") {
            $("span.val_slug").html("This field is required.").addClass('validate');
            validation_holder = 1;
        } else {
            $("span.val_slug").html("");
        }
        if (cn == "") {
            $("span.val_email").html("This field is required.").addClass('validate');
            validation_holder = 1;
        } else {
            $("span.val_email").html("");
        }
        if (pcat == "") {
            $("span.val_pcat").html("Please Select Parent Category.").addClass('validate');
            validation_holder = 1;
        } else {
            $("span.val_pcat").html("");
        }
        if (dis == "") {

            $("span.val_dis").html("This field is required.").addClass('validate');

            validation_holder = 1;

        } else {
            $("span.val_dis").html("");
        }

        if (validation_holder == 1) { // if have a field is blank, return false
            $("p.validate_msg").slideDown("fast");
            return false;
        }
        validation_holder = 0;
    }
</script>