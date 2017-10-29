<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Link Items for Post Package</h1>
                <div class="row bs-wizard" style="border-bottom:0;">

                    <div id="step1" class="col-xs-4 bs-wizard-step complete">
                        <div class="text-center bs-wizard-stepnum">Step 1</div>
                        <div class="progress"><div class="progress-bar"></div></div>
                        <a href="#" class="bs-wizard-dot"></a>
                        <div class="bs-wizard-info text-center">Fill Form</div>
                    </div>

                    <div class="col-xs-4 bs-wizard-step complete">
                        <div class="text-center bs-wizard-stepnum">Step 2</div>
                        <div class="progress"><div class="progress-bar"></div></div>
                        <a href="#" class="bs-wizard-dot"></a>
                        <div class="bs-wizard-info text-center">Upload Images</div>
                    </div>

                    <div class="col-xs-4 bs-wizard-step active">
                        <div class="text-center bs-wizard-stepnum">Step 3</div>
                        <div class="progress"><div class="progress-bar"></div></div>
                        <a href="#" class="bs-wizard-dot"></a>
                        <div class="bs-wizard-info text-center">Include Package Items & Submit</div>
                    </div>

                </div>
                <div id="infoMessage" class="alert-info"><?php echo $this->session->flashdata('message'); ?></div>
                <div class="alert alert-info">
                    IMPORTANT: Please make sure you have already created minimum of one item and get Approved, before creating a package). <strong><a href="<?php echo base_url('post-item') ?>"> <i class="fa fa-hand-o-right" aria-hidden="true"></i> Click here to create  </a></strong> and , You also can include items in the edit package page.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <!-- row -->
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <p>Fields marked with <span class="required">*</span> are mandatory</p>
                <p class="validate_msg  btn-danger">Please fix the errors below!</p>
                <form  method="post" action="<?php echo base_url('post-package-link-item'); ?>" id="form" onsubmit="return validateForm()" name="myform">
                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6">
                            <div class="form-group">

                                <p><strong>Select Item for Package <span class="required">*</span></strong>
                                    <select name="item" class="form-control">
                                        <option value=""></option>
                                        <?php foreach ($items as $item) { ?>

                                            <option value="<?php echo $item->id; ?>"><?php echo $item->title; ?></option>

                                        <?php } ?>

                                    </select>
                                    <span class="val_item"></span></p>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6">
                            <div class="form-group">

                                <p><strong>No of Items <span class="required">*</span></strong>
                                    <select name="max_item_inc" class="form-control">
                                        <option value="N/A">N/A</option>
                                        <?php
                                        for ($i = 1; $i <= 100; $i++) {
                                            ?>

                                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>

                                        <?php } ?>
                                    </select>
                                    <span class="val_max_item_inc"></span> </p>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6">
                            <div class="form-group">

                                <p>
                                    <strong>Extra Information specific to this item</strong>

                                    <textarea name="item_extra_note" class="form-control" rows="4" cols="50" maxlength="500" placeholder="Any additional info about this item in relation to the package can be entered here. E.g. If this item can be substituted for another item/cost for additional requests etc."></textarea>

                                </p>

                            </div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-6">
                            <br>

                            <button type="submit" class="btn btn-lg btn-warning btn-block" name="submit"><i class="fa fa-link" aria-hidden="true"></i> Include Item</button>
                        </div>
                    </div>
                </form>



            </div>
        </div>
        <br>
        <br>
        <p>Items Included to Package</p>

        <table width="100%" border="0" class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th scope="col">Title</th>
                    <th scope="col">No of items</th>
                    <th scope="col">Extra Information specific to this item</th>


                </tr>
            </thead>
            <tbody>

                <?php foreach ($linkeditems as $linkeditem) { ?>
                    <tr>

                        <td class="col-xs-5 col-md-5" ><?php echo $linkeditem->title; ?></td>
                        <td class="col-xs-2 col-md-2"><?php echo $linkeditem->max_item_inc; ?></td>
                        <td class="col-xs-5 col-md-5"><?php echo $linkeditem->item_extra_note; ?></td>

                    </tr>

                    <?php
                }
                ?>
            </tbody>
        </table>

        <div class="row">
            <br>
            <br>
            <br>
            <br>
            <div class="col-xs-12 col-sm-6 col-md-6 xs-margin-10">
                <a class="btn btn-lg btn-ml-login btn-block" href="<?php echo base_url() ?>seller/addSubmit">Submit Post Package</a>
            </div>

            <div class="col-sm-6 col-md-6">
                <a class="btn btn-lg btn-ml-cancel btn-block" href="<?php echo base_url('seller/cancel_package_post') ?>">Cancel</a>
            </div>

        </div>

    </div>
</div>


<script>

    function validateForm() {

        var validation_holder;
        var validation_holder = 0;
        var item = document.forms["myform"]["item"].value;
        var max_item_inc = document.forms["myform"]["max_item_inc"].value;


        if (item == null || item == "") {

            $("span.val_item").html("This field is required.").addClass('validate');
            validation_holder = 1;
        } else {

            $("span.val_item").html("");
        }


        if (max_item_inc == null || max_item_inc == "") {

            $("span.val_max_item_inc").html("This field is required.").addClass('validate');
            validation_holder = 1;
        } else {

            $("span.val_max_item_inc").html("");
        }



        if (validation_holder == 1) { // if have a field is blank, return false

            $("p.validate_msg").slideDown("fast");
            return false;
        }
        validation_holder = 0;
    }


</script>

<script>
//    (function(global) {
//
//        if (typeof (global) === "undefined") {
//            throw new Error("window is undefined");
//        }
//
//        var _hash = "!";
//        var noBackPlease = function() {
//            global.location.href += "#";
//
//            // making sure we have the fruit available for juice (^__^)
//            global.setTimeout(function() {
//                global.location.href += "!";
//            }, 50);
//        };
//
//        global.onhashchange = function() {
//            if (global.location.hash !== _hash) {
//                global.location.hash = _hash;
//            }
//        };
//
//        global.onload = function() {
//            noBackPlease();
//
//            // disables backspace on page except on input fields and textarea..
//            document.body.onkeydown = function(e) {
//                var elm = e.target.nodeName.toLowerCase();
//                if (e.which === 8 && (elm !== 'input' && elm !== 'textarea')) {
//                    e.preventDefault();
//                }
//                // stopping event bubbling up the DOM tree..
//                e.stopPropagation();
//            };
//        }
//
//    })(window);


</script>