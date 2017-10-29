<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Add Item</h1>
                <div id="infoMessage" class="alert-info"><?php echo $this->session->flashdata('message'); ?></div>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <!-- row -->
        <div class="row">


            <div class="col-xs-12 col-sm-6 col-md-6">
                <p class="validate_msg  btn-danger">Please fix the errors below!</p>
                <form  method="post" action="<?php echo base_url() ?>admin/additem" id="form" onsubmit="return validateForm()" name="myform">
                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                    <div class="form-group">

                        <p><strong>Select Main Category</strong>
                            <select name="mcat" class="form-control" id="mcat">

                                <option value="">-- Select Category --</option>

                                <?php foreach ($mcats as $mcat) { ?>

                                    <option value="<?php echo $mcat->mcatid; ?>"><?php echo $mcat->name; ?></option>

                                <?php } ?>

                            </select><span class="val_mcat"></span>
                        </p>

                    </div>

                    <div class="form-group">

                        <p><strong>Select Sub category</strong>
                            <select disabled="disabled" name="scat"  id="scats" class="form-control">


                            </select><span class="val_scat"></span></p>

                    </div>

                    <div class="form-group">
                        <p><strong>Title</strong>


                            <input type="text" name="title" class="form-control">
                            <span class="val_title"></span></p>
                    </div>
                    <div class="form-group">
                        <p><strong>Description</strong>


                            <textarea name="description" class="form-control" rows="4" cols="50"></textarea>
                            <span class="val_des"></span></p>
                    </div>
                    <div class="form-group">
                        <p><strong>Price</strong>


                            <input type="text" name="price" list="price"  class="form-control">
                            <datalist id="price">
                                <option>Volvo</option>
                                <option>Saab</option>
                                <option>Mercedes</option>
                                <option>Audi</option>
                            </datalist>
                            <span class="val_price"></span></p>
                    </div>

                    <button type="submit" class="btn btn-lg btn-ml-login btn-block" name="submit">Next</button>
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
    jQuery(document).ready(function() {
        $("#mcat").on("change", function() {
            $('#scats').empty();
            $('#scats').val('');
            var category_id = {"category_id": $('#mcat').val()};
            //console.log(category_id);

            $.ajax({
                type: "POST",
                data: {category_id, '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'},
                url: '<?= base_url() ?>admin/getsubcats/',
                success: function(data) {
                    $("#scats").removeAttr('disabled');
                    $.each(data, function(i, data) {

                        $('#scats').append("<option value='" + data.id + "'>" + data.description + "</option>");
                    });
                    $("#scats").prepend("<option value=''>-----    --      ------    --    -----</option>");
                    $('#scats option:first-child').attr("selected", "selected");
                }

            });
        });





    });
    function validateForm() {

        var validation_holder;

        var validation_holder = 0;

        var mcat = document.forms["myform"]["mcat"].value;

        var scat = document.forms["myform"]["scat"].value;

        var title = document.forms["myform"]["title"].value;

        var desc = document.forms["myform"]["description"].value;
        var price = document.forms["myform"]["price"].value;


        if (mcat == null || mcat == "") {

            $("span.val_mcat").html("This field is required.").addClass('validate');

            validation_holder = 1;

        } else {

            $("span.val_mcat").html("");

        }

        if (scat == null || scat == "") {

            $("span.val_scat").html("This field is required.").addClass('validate');

            validation_holder = 1;

        } else {

            $("span.val_scat").html("");

        }

        if (title == null || title == "") {

            $("span.val_title").html("This field is required.").addClass('validate');

            validation_holder = 1;

        } else {

            $("span.val_title").html("");

        }
        if (desc == null || desc == "") {

            $("span.val_des").html("This field is required.").addClass('validate');

            validation_holder = 1;

        } else {

            $("span.val_des").html("");

        }
        if (price == null || price == "") {

            $("span.val_price").html("This field is required.").addClass('validate');

            validation_holder = 1;

        } else {

            $("span.val_price").html("");

        }




        if (validation_holder == 1) { // if have a field is blank, return false

            $("p.validate_msg").slideDown("fast");

            return false;

        }
        validation_holder = 0;



    }

</script>