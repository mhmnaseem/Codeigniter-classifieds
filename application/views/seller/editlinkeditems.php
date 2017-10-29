<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Edit Included Items for Post Package</h1>

                <div id="infoMessage" class="alert-info"><?php echo $this->session->flashdata('message'); ?></div>
                <div class="alert alert-info">
                    IMPORTANT: Please make sure you have already created minimum of one item and get Approved <strong><a target="_blank" href="<?php echo base_url('post-item') ?>"> <i class="fa fa-hand-o-right" aria-hidden="true"></i> Create Here </a></strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">

                <h4>Items Included to Package</h4>

                <table width="100%" border="0" class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Title</th>
                            <th scope="col">No of items</th>
                            <th scope="col">Extra Information specific to this item</th>
                            <th scope="col"></th>

                        </tr>
                    </thead>
                    <tbody>

                        <?php foreach ($linkeditems as $linkeditem) { ?>
                            <tr>

                                <td class="col-xs-4 col-md-4"><?php echo $linkeditem->title; ?></td>
                                <td class="col-xs-2 col-md-2"><?php echo $linkeditem->max_item_inc; ?></td>
                                <td class="col-xs-2 col-md-5"><?php echo $linkeditem->item_extra_note; ?></td>
                                <td class="col-xs-2 col-md-1"><a href="<?php echo base_url('delete-linked-item/' . $linkeditem->linked_id . '/' . $slug); ?>" class="btn btn-danger btn-bott-margin" onClick='javascript:return confirm("Are you sure to Delete?")'>Delete</a></td>
                            </tr>

                            <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- row -->


        <h4>Include New Package Items</h4>


        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <p>Fields marked with <span class="required">*</span> are mandatory</p>
                <p class="validate_msg  btn-danger">Please fix the errors below!</p>
                <form  method="post" action="<?php echo base_url('edit-package-linked-items/' . $slug); ?>" id="form" onsubmit="return validateForm()" name="myform">
                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6">
                            <div class="form-group">

                                <p><strong>Select Item for Package <span class="required">*</span></strong>
                                    <select name="item" class="form-control" data-toggle="tooltip" data-placement="right" title="Select items created as package item">
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
                                    <select name="max_item_inc" class="form-control" data-toggle="tooltip" data-placement="right" title="maximum no of item Included in the package">
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



        <div class="row">
            <br>
            <br>
            <br>
            <br>
            <div class="col-xs-12 col-sm-6 col-sm-push-3 col-md-6 col-md-push-3">
                <a class="btn btn-lg btn-ml-login btn-block" href="<?php echo base_url() . 'edit-item-package/' . $slug ?>">Back To Edit Package</a>
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