<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Edit Item/Service Info</h1>
                <div id="infoMessage" class="alert-info"><?php echo $this->session->flashdata('message'); ?></div>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <!-- row -->
        <div class="row">


            <div class="col-xs-12 col-sm-12 col-md-6">
                <?php foreach ($selecteditem as $item) { ?>

                    <?php $status = $item->status; ?>
                    <?php if ($item->status == "edit") { ?>
                        <!--                        <div class="alert alert-info">
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Info!</strong>, Your Item Under Review For Changes, once approved Changes will be Applied
                                                </div>-->
                    <?php } ?>
                    <p class="validate_msg  btn-danger">Please fix the errors below!</p>
                    <form  method="post" action="<?php echo base_url() . 'seller/edititem/' . $slug ?>" id="form" onsubmit="return validateForm()" name="myform">
                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                        <div class="form-group">
                            <p><strong>Select a Category <span class="required">*</span></strong> <select name="category" class="form-control">

                                    <?php
                                    foreach ($allcats as $mcats) {

                                        echo '<span style="margin-bottom:5px;padding:5px;"><option style="background-color:#000;" disabled="disabled">' . $mcats->name . '</option></span>';
                                        foreach ($allscats as $cats) {
                                            if ($mcats->mcatid == $cats->parentcat) {
                                                if ($item->category == $cats->id) {

                                                    echo '<option selected="selected" value="' . $cats->id . '">- ' . $cats->description . '</option>';
                                                } else {

                                                    echo '<option value="' . $cats->id . '">- ' . $cats->description . '</option>';
                                                }
                                            }
                                        }
                                        ?>



                                    <?php } ?>

                                </select> </p>

                        </div>

                        <div class="form-group">
                            <p><strong>Title <span class="required">*</span></strong>
                                <input type="text" name="title" class="form-control" placeholder="Maximum 60 characters" value="<?php echo $item->title; ?>" maxlength="60">
                                <span class="val_title"></span></p>
                        </div>


                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <p><strong>Purchase Price (Rs)</strong>


                                        <input type="number" name="pprice" list="pprice"  placeholder="" class="form-control" value="<?php echo $item->pprice; ?>">
                                        <datalist id="pprice">
                                            <option>00</option>

                                        </datalist>
                                    </p>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <p><strong>Rental Price (Rs)</strong>

                                        <input type="number" name="rprice" list="rprice" placeholder="" class="form-control" value="<?php echo $item->rprice; ?>">
                                        <datalist id="rprice">
                                            <option>00</option>

                                        </datalist>
                                    </p>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">

                                    <p><strong>Do you want to add this item to a party/food package at a later stage?</strong>

                                        <select id="package-item" class="form-control" name="package" data-toggle="tooltip" data-placement="top" title="If you are selecting 'YES', Please remember to link this item/service to a package within two days. Failing to do so, will result in removal of this post">
                                            <option value="no" <?php
                                            if ($item->package == "no") {

                                                echo set_select('package', 'no');
                                                echo "selected=selected";
                                            }
                                            ?>>no</option>
                                            <option value="yes" <?php
                                            if ($item->package == "yes") {

                                                echo set_select('package', 'yes');
                                                echo "selected=selected";
                                            }
                                            ?>>yes</option>


                                        </select>

                                        </select><span class="val_package"></span>
                                    </p>

                                </div>

                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <span class="val_price"></span>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">

                                    <p><strong>Select a Theme <span class="required">*</span></strong>
                                        <select name="theme" class="form-control" data-toggle="tooltip" data-placement="top" title="Select a theme for this item. Themed items will show top in the search results when filtered by the said theme. Contact us, if your theme is not listed here.">

                                            <option value="Non-Themed"<?php
                                            if ($item->theme == "Non-Themed") {

                                                echo set_select('theme', 'Non-Themed');
                                                echo "selected=selected";
                                            }
                                            ?>>Non-Themed</option>

                                            <?php
                                            foreach ($themes as $theme) {

                                                if ($item->theme == $theme->themename) {

                                                    echo '<option selected="selected" value="' . $theme->themename . '">' . $theme->themename . '</option>';
                                                } else {

                                                    echo '<option value="' . $theme->themename . '">' . $theme->themename . '</option>';
                                                }
                                            }
                                            ?>


                                        </select><span class="val_theme"></span>
                                    </p>

                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">

                                    <p><strong>Select a City <span class="required">*</span></strong>

                                        <select name="city" class="form-control">

                                            <?php foreach ($allprovinces as $province) { ?>

                                                <option style="background-color:#000;" disabled="disabled"><?php echo $province->pro_name; ?></option>
                                                <?php
                                                foreach ($allcities as $city) {
                                                    if ($province->id == $city->province_id) {
                                                        if ($item->city == $city->id) {

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

                            </div>


                        </div>

                        <div class="form-group">
                            <p><strong>Description <span class="required">*</span></strong> <i style="float: right;"><input style="color:red;font-size:12pt;font-style:italic; border: 0px;" readonly type="text" id='q20length' name="q20length2" size="3" maxlength="4" value="5000"> of &nbsp;&nbsp; 5000 characters left</i>
                                <textarea name="description" id="description" class="form-control" placeholder="Describe your item with as much details as you can. You are given 5000 characters to write all about it.  Write away!" rows="6" cols="50" maxlength="5000"  onKeyDown="textCounter(this, 'q20length', 5000)" onKeyUp="textCounter(this, 'q20length', 5000)" ><?php echo $item->description; ?></textarea>
                                <span class="val_des"></span></p>
                        </div>


                        <div class="row">
                            <div class="col-sm-6 col-md-6 xs-margin-10">
                                <button type="submit" id="submit" class="btn btn-lg btn-ml-login btn-block" name="submit">Save Changes</button>
                            </div>
                            <div class="col-sm-6 col-md-6">
                                <a class="btn btn-lg btn-ml-cancel btn-block" href="<?php echo base_url('dashboard') ?>">Cancel</a>
                            </div>
                        </div>
                        <br>
                        <br>
                    </form>
                <?php } ?>
            </div>
            <?php if ($this->session->userdata('user_id') == $item_user_id) { ?>
                <div class="col-xs-12 col-sm-12 col-md-6">
                    <h4>Uploaded Images</h4>
                    <div class="row">
                        <?php
                        $iid = '';
                        foreach ($allImages as $images) {

                            $names = explode(',', $images->image);
                            $max = sizeof($names);
                            $iid = $images->gallery_id;
                            for ($i = 0; $i < $max; $i++) {
                                echo '<div class="col-md-3 col-sm-3 col-xs-4" id="x' . $iid . '"><img class="thumbnail" src="' . base_url("files/thumb/") . $names[$i] . '"  width="100px" height="100px;"/>';
                            }
                            if ($images != '') {
                                ?>

                                <a href="#"  class="btn btn-danger closebtn fa fa-trash-o"  onClick="deletegallimg(<?php echo $iid; ?>)"></a>

                                <?php
                            }
                            echo'</div>';
                        }
                        ?>





                    </div>



                    <h4>Add New Image </h4>
                    <form id="myAwesomeDropzone" action="<?php echo base_url() . 'seller/EdititemimageUpload/' . $slug ?>" method="post" enctype="multipart/form-data" class="dropzone">
                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                        <div class="fallback">
                            <input name="file" type="file" multiple />
                        </div>
                    </form>
                    <p>You are allowed to upload upto 5 files of type jpg, png or gif of size upto 5MB</p>





                </div>
            <?php } ?>

        </div>


    </div>
</div>

</div>
</div>


<script>

    $(document).ready(function() {
        var remain = 5000 - $('#description').val().length;
        $('#q20length').val(remain);
    });
    function textCounter(field, cnt, maxlimit) {
        var cntfield = document.getElementById(cnt);
        if (field.value.length > maxlimit) // if too long...trim it!
            field.value = field.value.substring(0, maxlimit);
        // otherwise, update 'characters left' counter
        else
            cntfield.value = maxlimit - field.value.length;
    }

    function validateForm() {

        var validation_holder;
        var validation_holder = 0;
        var title = document.forms["myform"]["title"].value;
        var desc = document.forms["myform"]["description"].value;
        var pprice = document.forms["myform"]["pprice"].value;
        var rprice = document.forms["myform"]["rprice"].value;
        var theme = document.forms["myform"]["theme"].value;
        var package = document.forms["myform"]["package"].value;
        var city = document.forms["myform"]["city"].value;
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
//        if (pprice == "" && rprice == "" && package == "no") {
//
//            $("span.val_price").html("This field is required.").addClass('validate');
//
//            validation_holder = 1;
//
//        } else {
//
//            $("span.val_price").html("");
//
//        }
        if (city == null || city == "") {

            $("span.val_city").html("This field is required.").addClass('validate');
            validation_holder = 1;
        } else {

            $("span.val_city").html("");
        }


        if (theme == null || theme == "") {

            $("span.val_theme").html("This field is required.").addClass('validate');
            validation_holder = 1;
        } else {

            $("span.val_theme").html("");
        }


        if (validation_holder == 1) { // if have a field is blank, return false

            $("p.validate_msg").slideDown("fast");
            return false;
        }
        validation_holder = 0;
    }

</script>

<script>
    function deletegallimg(id) {
        //var id = id;
        //var divid = $(obj).attr('class');
        //var deletediv = "div#" + divid;

        var uid = '<?php echo $item_user_id; ?>';
        var pid = '<?php echo $id; ?>';
        jQuery.ajax({
            type: "POST",
            url: "<?php echo base_url('seller/deleteimagegallery'); ?>",
            data: {id: id, 'uid': uid, 'pid': pid, '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'},
            success: function(res) {
                if (res)
                {
                    var result = res.result;
                    $("#x" + result).hide();
                }
            }
        });
    }
    $(document).ready(function() {
        $('[data-toggle="tooltip"]').tooltip();
        var status = '<?php echo $status; ?>';
        if (status === "edit") {
            $(':input[type="submit"]').prop('disabled', true);
        }


    }
    );</script>
<script>
// "myAwesomeDropzone" is the camelized version of the HTML element's ID
    var myDropzone = new Dropzone("#myAwesomeDropzone", {
        success: function(file, response) {
            file.previewElement.id = response.id;
        }

    });
    myDropzone.on('removedfile', function(file) {
        var id = file.previewElement.id;
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url('seller/deleteImagegalleryById'); ?>',
            data: {id: id, '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'},
            dataType: 'html'
        });
        var _ref;
        return (((_ref = file.previewElement) != null) && file.previewElement.parentNode) ? _ref.parentNode.removeChild(file.previewElement) : void 0;
    });

</script>