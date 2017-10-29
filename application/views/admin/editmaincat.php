<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Edit Main Catergory</h1>
                <div id="infoMessage" class="alert-info"><?php echo $this->session->flashdata('message'); ?></div>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->


        <!-- .row -->
        <div class="row">
            <div class="col-lg-6">
                <p class="validate_msg  btn-danger">Please fix the errors below!</p>
                <form enctype="multipart/form-data" action="<?php echo base_url() . 'admin/EditMainCat/' . $maincatid; ?>" method="post" onsubmit="return validateForm()" name="myform" id="register_form input">
                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                    <?php foreach ($singlemaincat as $cat) { ?>
                        <div class="form-group">

                            <p>Category Name <input type="text" name="cname" class="form-control" value="<?php echo $cat->name ?>" /><span class="val_email"></span> </p>
                            <input type="hidden" name="id" value="<?php echo $cat->mcatid ?>" />

                        </div>

                        <div class="form-group">
                            <p>Category Url Name (Use "-" or "_" instead of spaces)<input type="text" name="curl" class="form-control" placeholder="Category Url Name" value="<?php echo $cat->slug ?>"/><span class="val_slug"></span> </p>
                        </div>

                        <div class="form-group">

                            <p>Description <textarea name="dis" class="form-control" placeholder="Description"><?php echo $cat->description; ?></textarea><span class="val_dis"></span> </p>

                        </div>

                        <div class="form-group">
                            <p>
                                <label>Upload Image</label>
                                <input type="file" name="userfile" size="20" />
                            </p>

                        </div>
                        <button type="submit" class="btn btn-lg btn-ml-login btn-block" name="submit">Update Main Category</button>
                        <br>
                        <br>
                    </form>
                </div>
                <!-- /.col-lg-6 -->
                <div class="col-lg-6">
                    <?php
                    if ($cat->image != '') {

                        echo '<img class="img-responsive" src="' . base_url() . 'files/catergory/' . $cat->image . '">';
                    } else {
                        echo '<img class="img-responsive" src="' . base_url() . 'asset/images/no-photo.png">';
                    }
                    ?>
                </div>
            </div>
            <!-- /.row -->
        <?php } ?>


    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->
<script type="text/javascript">


    function validateForm() {
        var validation_holder;
        var validation_holder = 0;
        var cn = document.forms["myform"]["cname"].value;
        var dis = document.forms["myform"]["dis"].value;
        var curl = document.forms["myform"]["curl"].value;


        if (cn == "") {
            $("span.val_email").html("This field is required.").addClass('validate');
            validation_holder = 1;
        } else {
            $("span.val_email").html("");
        }

        if (dis == "") {

            $("span.val_dis").html("This field is required.").addClass('validate');

            validation_holder = 1;

        } else {
            $("span.val_dis").html("");
        }


        if (curl == "") {

            $("span.val_slug").html("This field is required.").addClass('validate');

            validation_holder = 1;

        } else {
            $("span.val_slug").html("");
        }



        if (validation_holder == 1) { // if have a field is blank, return false
            $("p.validate_msg").slideDown("fast");
            return false;
        }
        validation_holder = 0;

    }
</script>