<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">View Item/Service Info Changes</h1>
                <div id="infoMessage" class="alert-info"><?php echo $this->session->flashdata('message'); ?></div>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <!-- row -->
        <div class="row">


            <div class="col-xs-12 col-sm-6 col-md-6">


                <h3>Original</h3>
                <?php foreach ($selecteditem as $item) { ?>


                    <h4>User Info </h4>
                    <table class="table">
                        <tr>
                            <th>Full Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                        </tr>
                        <tr>
                            <td><?php echo $item->fname . ' ' . $item->lname; ?></td>
                            <td><?php echo $item->email; ?></td>
                            <td><?php echo $item->mobile; ?></td>
                        </tr>
                    </table>


                    <form  method="post" action="" id="form" onsubmit="return validateForm()" name="myform">

                        <div class="form-group">
                            <p><strong>Category <span class="required">*</span></strong> <select disabled="disabled" name="category" class="form-control">

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
                                <input type="text" disabled="disabled" name="title" class="form-control" placeholder="Maximum 60 characters" value="<?php echo $item->title; ?>" maxlength="60">
                                <span class="val_title"></span></p>
                        </div>


                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <p><strong>Purchase Price (Rs)</strong>


                                        <input type="number" disabled="disabled" name="pprice" list="pprice"  placeholder="" class="form-control" value="<?php echo $item->pprice; ?>">
                                        <datalist id="pprice">
                                            <option>00</option>

                                        </datalist>
                                    </p>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <p><strong>Rental Price (Rs)</strong>

                                        <input type="number" disabled="disabled" name="rprice" list="rprice" placeholder="" class="form-control" value="<?php echo $item->rprice; ?>">
                                        <datalist id="rprice">
                                            <option>00</option>

                                        </datalist>
                                    </p>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">

                                    <p><strong>Do you want to add this item to a party/food package at a later stage?</strong>

                                        <select id="package-item" disabled="disabled" class="form-control" name="package" data-toggle="tooltip" data-placement="top" title="If you are selecting 'YES', Please remember to link this item/service to a package within two days. Failing to do so, will result in removal of this post">
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

                                    <p><strong>Theme <span class="required">*</span></strong>
                                        <select name="theme" disabled="disabled" class="form-control" data-toggle="tooltip" data-placement="top" title="Select a theme for this item. Themed items will show top in the search results when filtered by the said theme. Contact us, if your theme is not listed here.">

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

                                    <p><strong>City <span class="required">*</span></strong>

                                        <select name="city" disabled="disabled" class="form-control">

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
                                <textarea name="description" disabled="disabled" id="description" class="form-control" placeholder="Describe your item with as much details as you can. You are given 5000 characters to write all about it.  Write away!" rows="6" cols="50" maxlength="5000"  onKeyDown="textCounter(this, 'q20length', 5000)" onKeyUp="textCounter(this, 'q20length', 5000)" ><?php echo $item->description; ?></textarea>
                                <span class="val_des"></span></p>
                        </div>

                    </form>
                <?php } ?>
            </div>

            <div class="col-xs-12 col-sm-6 col-md-6">

                <h3>Changes</h3>

                <?php foreach ($selecteditemedit as $edititem) { ?>

                    <form  method="post" action="" id="form" onsubmit="return validateForm()" name="myform">

                        <div class="form-group">
                            <p><strong>Category <span class="required">*</span></strong> <select disabled="disabled" name="category" class="form-control">

                                    <?php
                                    foreach ($allcats as $mcats) {

                                        echo '<span style="margin-bottom:5px;padding:5px;"><option style="background-color:#000;" disabled="disabled">' . $mcats->name . '</option></span>';
                                        foreach ($allscats as $cats) {
                                            if ($mcats->mcatid == $cats->parentcat) {
                                                if ($edititem->category == $cats->id) {

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
                                <input type="text" disabled="disabled" name="title" class="form-control" placeholder="Maximum 60 characters" value="<?php echo $edititem->title; ?>" maxlength="60">
                                <span class="val_title"></span></p>
                        </div>


                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <p><strong>Purchase Price (Rs)</strong>


                                        <input type="number" disabled="disabled" name="pprice" list="pprice"  placeholder="" class="form-control" value="<?php echo $edititem->pprice; ?>">
                                        <datalist id="pprice">
                                            <option>00</option>

                                        </datalist>
                                    </p>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <p><strong>Rental Price (Rs)</strong>

                                        <input type="number" disabled="disabled" name="rprice" list="rprice" placeholder="" class="form-control" value="<?php echo $edititem->rprice; ?>">
                                        <datalist id="rprice">
                                            <option>00</option>

                                        </datalist>
                                    </p>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">

                                    <p><strong>Do you want to add this item to a party/food package at a later stage?</strong>

                                        <select id="package-item" disabled="disabled" class="form-control" name="package" data-toggle="tooltip" data-placement="top" title="If you are selecting 'YES', Please remember to link this item/service to a package within two days. Failing to do so, will result in removal of this post">
                                            <option value="no" <?php
                                            if ($edititem->package == "no") {

                                                echo set_select('package', 'no');
                                                echo "selected=selected";
                                            }
                                            ?>>no</option>
                                            <option value="yes" <?php
                                            if ($edititem->package == "yes") {

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

                                    <p><strong>Theme <span class="required">*</span></strong>
                                        <select name="theme" disabled="disabled" class="form-control" data-toggle="tooltip" data-placement="top" title="Select a theme for this item. Themed items will show top in the search results when filtered by the said theme. Contact us, if your theme is not listed here.">

                                            <option value="Non-Themed"<?php
                                            if ($edititem->theme == "Non-Themed") {

                                                echo set_select('theme', 'Non-Themed');
                                                echo "selected=selected";
                                            }
                                            ?>>Non-Themed</option>

                                            <?php
                                            foreach ($themes as $theme) {

                                                if ($edititem->theme == $theme->themename) {

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

                                    <p><strong>City <span class="required">*</span></strong>

                                        <select name="city" disabled="disabled" class="form-control">

                                            <?php foreach ($allprovinces as $province) { ?>

                                                <option style="background-color:#000;" disabled="disabled"><?php echo $province->pro_name; ?></option>
                                                <?php
                                                foreach ($allcities as $city) {
                                                    if ($province->id == $city->province_id) {
                                                        if ($edititem->city == $city->id) {

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
                            <p><strong>Description <span class="required">*</span></strong> <i style="float: right;"><input style="color:red;font-size:12pt;font-style:italic; border: 0px;" readonly type="text" id='q20length2' name="q20length2" size="3" maxlength="4" value="5000"> of &nbsp;&nbsp; 5000 characters left</i>
                                <textarea name="description" disabled="disabled" id="description2" class="form-control" placeholder="Describe your item with as much details as you can. You are given 5000 characters to write all about it.  Write away!" rows="6" cols="50" maxlength="5000"  onKeyDown="textCounter(this, 'q20length2', 5000)" onKeyUp="textCounter(this, 'q20length2', 5000)" ><?php echo $edititem->description; ?></textarea>
                                <span class="val_des"></span></p>
                        </div>

                    </form>
                <?php } ?>




            </div>

            <div class="col-xs-12 col-sm-6 col-md-6">

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



                            <?php
                        }
                        echo'</div>';
                    }
                    ?>

                </div>








            </div>
            <div class="row">

                <div class="col-md-6">
                    <a class="btn btn-lg btn-ml-cancel btn-block" href="<?php echo base_url('admin') ?>">Close</a>
                </div>
            </div>
            <br>
            <br>

        </div>


    </div>
</div>

</div>
</div>


<script>

    $(document).ready(function() {
        var remain = 5000 - $('#description').val().length;
        $('#q20length').val(remain);
        var remain2 = 5000 - $('#description2').val().length;
        $('#q20length2').val(remain2);
    });
    function textCounter(field, cnt, maxlimit) {
        var cntfield = document.getElementById(cnt);
        if (field.value.length > maxlimit) // if too long...trim it!
            field.value = field.value.substring(0, maxlimit);
        // otherwise, update 'characters left' counter
        else
            cntfield.value = maxlimit - field.value.length;
    }
</script>

