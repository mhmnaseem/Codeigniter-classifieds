<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Post Package</h1>
                <div class="row bs-wizard" style="border-bottom:0;">

                    <div id="step1" class="col-xs-4 bs-wizard-step active">
                        <div class="text-center bs-wizard-stepnum">Step 1</div>
                        <div class="progress"><div class="progress-bar"></div></div>
                        <a href="#" class="bs-wizard-dot"></a>
                        <div class="bs-wizard-info text-center">Fill Form</div>
                    </div>

                    <div class="col-xs-4 bs-wizard-step disabled">
                        <div class="text-center bs-wizard-stepnum">Step 2</div>
                        <div class="progress"><div class="progress-bar"></div></div>
                        <a href="#" class="bs-wizard-dot"></a>
                        <div class="bs-wizard-info text-center">Upload Images</div>
                    </div>

                    <div class="col-xs-4 bs-wizard-step disabled">
                        <div class="text-center bs-wizard-stepnum">Step 3</div>
                        <div class="progress"><div class="progress-bar"></div></div>
                        <a href="#" class="bs-wizard-dot"></a>
                        <div class="bs-wizard-info text-center">Include Package Items & Submit</div>
                    </div>

                </div>

                <div id="infoMessage" class="alert-info"><?php echo $this->session->flashdata('message'); ?></div>
                <div class="alert alert-info">
                    IMPORTANT: Please make sure you have already created minimum of one package item, before creating a package). <strong><a href="<?php echo base_url('post-item') ?>"> <i class="fa fa-hand-o-right" aria-hidden="true"></i> Click here to create  </a></strong> package items<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <!-- row -->
        <div class="row">


            <div class="col-xs-12 col-sm-12 col-md-12">
                <p>Fields marked with <span class="required">*</span> are mandatory</p>
                <p class="validate_msg  bg-danger">Please fix the errors below!</p>
                <form  method="post" action="<?php echo base_url() ?>post-package" id="form" onsubmit="return validateForm()" name="myform">
                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">

                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6">
                            <div class="form-group">

                                <p><strong>Package Type <span class="required">*</span></strong>
                                    <select id="package_type" name="package_type" class="form-control" data-toggle="tooltip" data-placement="top" title="Select a Package Type Your wish to Create">
                                        <option value="Party-Packages">Party Package</option>
                                        <option value="Food-Packages">Food Package</option>

                                    </select><span class="val_package"></span>
                                </p>

                            </div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6">
                            <div class="form-group">

                                <p><strong>Package Designed for <span class="required">*</span></strong>
                                    <select  name="package_for" class="form-control">
                                        <option value="Children & adults">Children & adults</option>
                                        <option value="Children">Children</option>
                                        <option value="Adult">Adults</option>

                                    </select><span class="val_package_for"></span>
                                </p>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6">
                            <div class="form-group">

                                <p><strong>Select Theme <span class="required">*</span></strong>
                                    <select name="theme" class="form-control" data-toggle="tooltip" data-placement="top" title="Increase your chance of getting more interested customers by selecting an appropriate theme. Contact us if your theme is not listed here">

                                        <option value="Non-Themed">Non-Themed Package</option>

                                        <?php foreach ($themes as $theme) { ?>

                                            <option value="<?php echo $theme->themename; ?>"><?php echo $theme->themename; ?></option>

                                        <?php } ?>



                                    </select><span class="val_theme"></span>
                                </p>

                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6">
                            <div class="form-group">
                                <p><strong>Title <span class="required">*</span></strong>
                                    <input type="text" name="title" class="form-control" placeholder="Maximum 60 characters" maxlength="60" >
                                    <span class="val_title"></span></p>
                            </div>
                        </div>
                    </div>


                    <div id="party-package-container">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <p><strong>Select Venue</strong>
                                        <select name="venue" class="form-control" data-toggle="tooltip" data-placement="top" title="Select a Venue for this item. Contact us, if your Venue is not listed here">

                                            <option value="No Specific Venue">No Specific Venue</option>

                                            <?php foreach ($venues as $venue) { ?>

                                                <option value="<?php echo $venue->venue_id; ?>"><?php echo $venue->title; ?></option>

                                            <?php } ?>



                                        </select><span class="val_venue"></span>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <p> <strong>Party Duration</strong></p>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <p><strong>Hours</strong>
                                                <select name="party_hours" class="form-control">
                                                    <option value=""></option>
                                                    <?php
                                                    for ($i = 0; $i <= 24; $i++) {
                                                        ?>

                                                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>

                                                    <?php } ?>
                                                </select>

                                                <span class="val_party_hours"></span>
                                            </p>


                                        </div>
                                    </div>

                                    <div class="col-xs-12 col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <p><strong>Minutes</strong>

                                                <select name="party_minutes" class="form-control">
                                                    <option value=""></option>
                                                    <?php
                                                    for ($j = 0; $j <= 60; $j++) {
                                                        ?>

                                                        <option value="<?php echo $j; ?>"><?php echo $j; ?></option>

                                                    <?php } ?>
                                                </select>
                                                <span class="val_party_minutes">
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-6">

                                <p> <strong>No. of Children Allowed</strong></p>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <p><strong>Minimum</strong>
                                                <input type="number" name="children_min" list="party_hours" placeholder="" class="form-control">
                                                <datalist id="party_hours">
                                                    <option>00</option>
                                                </datalist>
                                                <span class="val_children_min">
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <p><strong>Maximum</strong>
                                                <input type="number" name="children_max" list="party_minutes" placeholder="" class="form-control">
                                                <datalist id="party_minutes">
                                                    <option>00</option>
                                                </datalist>
                                                <span class="val_children_max">
                                            </p>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>



                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-6">

                                <p> <strong>No.of Adults Allowed</strong></p>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <p><strong>Minimum</strong>
                                                <input type="number" name="adult_min" list="party_hours" placeholder="" class="form-control">
                                                <datalist id="party_hours">
                                                    <option>00</option>
                                                </datalist>
                                                <span class="val_adult_min">
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <p><strong>Maximum</strong>
                                                <input type="number" name="adult_max" list="party_minutes" placeholder="" class="form-control" >
                                                <datalist id="party_minutes">
                                                    <option>00</option>
                                                </datalist>
                                                <span class="val_adult_max">
                                            </p>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-6">

                                <p> <strong>Children Age limit</strong></p>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <p><strong>Minimum</strong>
                                                <input type="number" name="child_age_min" list="party_hours" placeholder="" class="form-control" >
                                                <datalist id="party_hours">
                                                    <option>00</option>
                                                </datalist>
                                                <span class="val_child_age_min">
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <p><strong>Maximum</strong>
                                                <input type="number" name="child_age_max" list="party_minutes" placeholder="" class="form-control">
                                                <datalist id="party_minutes">
                                                    <option>00</option>
                                                </datalist>
                                                <span class="val_child_age_max">
                                            </p>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <p><strong>Children Per Head Charge</strong>


                                        <input type="number" name="childern_per_head" list="childern_per_head" placeholder="" class="form-control" >
                                        <datalist id="childern_per_head">
                                            <option>00</option>

                                        </datalist>
                                        <span class="val_childern_per_head">
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <p><strong>Adults Per Head Charge </strong>


                                        <input type="number" name="adult_per_head" list="adult_per_head" placeholder="" class="form-control">
                                        <datalist id="adult_per_head">
                                            <option>00</option>

                                        </datalist>
                                        <span class="val_adult_per_head">
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">

                                    <p><strong>Package Price </strong>


                                        <input type="number" name="package_price" list="package_price" placeholder="" class="form-control">
                                        <datalist id="package_price">
                                            <option>00</option>
                                        </datalist>
                                        <span class="val_package_price">
                                    </p>

                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <span class="val_per_head_price"></span>
                        </div>
                    </div>

                    <div id="food-package-container">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">

                                    <p><strong>Type of Food Package <span class="required">*</span></strong>
                                        <select  name="type_food_package" class="form-control">
                                            <option value=""></option>
                                            <option value="Catering">Catering</option>
                                            <option value="Takeaway">Takeaway</option>

                                        </select><span class="val_type_food_package"></span>
                                    </p>

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">

                                    <p><strong>No. Persons Served <span class="required">*</span></strong>


                                        <input type="number" name="no_persons_served" list="no_persons_served" placeholder="" class="form-control">
                                        <datalist id="no_persons_served">
                                            <option>00</option>
                                        </datalist>
                                        <span class="val_no_persons_served">
                                    </p>

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">

                                    <p><strong>Waiters Provided</strong>
                                        <select  name="waiters_provided" class="form-control">
                                            <option value=""></option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>

                                        </select><span class="val_waiters_provided"></span>
                                    </p>

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">

                                    <p><strong>Per Head Charge (If applicable)</strong>


                                        <input type="number" name="food_per_head_charge" list="food_per_head_charge" placeholder="" class="form-control">
                                        <datalist id="food_per_head_charge">
                                            <option>00</option>
                                        </datalist>
                                        <span class="val_food_per_head_charge">
                                    </p>

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">

                                    <p><strong>Package Price (If applicable)</strong>


                                        <input type="number" name="food_package_price" list="food_package_price" placeholder="" class="form-control">
                                        <datalist id="food_package_price">
                                            <option>00</option>
                                        </datalist>
                                        <span class="val_food_package_price">
                                    </p>

                                </div>
                            </div>
                        </div>
                        <p style="color:#7DBE48; font-size: 20px;"><strong>Tableware</strong></p>

                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">

                                    <p><strong>Plates</strong>
                                        <select  name="food_plates" class="form-control">
                                            <option value=""></option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>

                                        </select><span class="val_food_plates"></span>
                                    </p>

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">

                                    <p><strong>Cups</strong>
                                        <select  name="food_cups" class="form-control">
                                            <option value=""></option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>

                                        </select><span class="val_food_cups"></span>
                                    </p>

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">

                                    <p><strong>Straws</strong>
                                        <select  name="food_straws" class="form-control">
                                            <option value=""></option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>

                                        </select><span class="val_food_straws"></span>
                                    </p>

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">

                                    <p><strong>Cutlery</strong>
                                        <select  name="food_cutlery" class="form-control">
                                            <option value=""></option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>

                                        </select><span class="val_food_cutlery"></span>
                                    </p>

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">

                                    <p><strong>Napkins</strong>
                                        <select  name="food_napkins" class="form-control" >
                                            <option value=""></option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>

                                        </select><span class="val_food_napkins"></span>
                                    </p>

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">

                                    <p><strong>Chafing Dishes</strong>
                                        <select  name="food_chafing_dishes" class="form-control">
                                            <option value=""></option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>

                                        </select><span class="val_food_chafing_dishes"></span>
                                    </p>

                                </div>
                            </div>



                        </div>
                    </div>


                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6">
                            <div class="form-group">

                                <p><strong>Delivery/Transport Cost</strong>
                                    <select  name="delivery_cost" class="form-control">
                                        <option value=""></option>
                                        <option value="N/A">N/A</option>
                                        <option value="Free">Free</option>
                                        <option value="Contact Seller">Contact Seller</option>
                                    </select><span class="val_delivery_cost"></span>
                                </p>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6">
                            <div class="form-group">
                                <p><strong>Service Charge %</strong>
                                    <input type="number" name="service_charge" list="service_charge" placeholder="" class="form-control">
                                    <datalist id="service_charge">
                                        <option>00</option>
                                    </datalist>
                                    <span class="val_service_charge">
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6">
                            <div class="form-group">
                                <p><strong>Other Charges</strong>
                                    <input type="number" name="other_charges" list="other_charges" placeholder="" class="form-control">
                                    <datalist id="other_charges">
                                        <option>00</option>
                                    </datalist>
                                    <span class="val_other_charges">
                                </p>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6">
                            <div class="form-group">

                                <p><strong>Select a City <span class="required">*</span></strong>

                                    <select name="city" class="form-control">

                                        <?php foreach ($allprovinces as $province) { ?>

                                            <option style="background-color:#000;" disabled="disabled"><?php echo $province->pro_name; ?></option>
                                            <?php
                                            foreach ($allcities as $city) {
                                                if ($province->id == $city->province_id) {
                                                    if ($user_city == $city->id) {

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
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <p><strong>Description <span class="required">*</span></strong> <i style="float: right;"><input style="color:red;font-size:12pt;font-style:italic; border: 0px;" readonly type="text" id='q20length' name="q20length2" size="3" maxlength="4" value="5000"> of &nbsp;&nbsp; 5000 left</i>
                                    <textarea name="description" class="form-control" placeholder="Describe your Package with as much details as you can. You are given 5000 characters to write all about it.  Write away!" rows="5" cols="50" maxlength="5000" onKeyDown="textCounter(this, 'q20length', 5000)" onKeyUp="textCounter(this, 'q20length', 5000)" ></textarea>
                                    <span class="val_des"></span></p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <br>
                        <br>
                        <div class="col-xs-12 col-sm-6 col-sm-push-3 col-md-6 col-md-push-3">
                            <button type="submit" class="btn btn-lg btn-ml-login btn-block" name="submit">Next</button>
                        </div>
                    </div>
                    <br>
                    <br>
                </form>

            </div>



        </div>


    </div>
</div>




<script>

    function validateForm() {

        var validation_holder;
        var validation_holder = 0;

        // common
        var package_type = document.forms["myform"]["package_type"].value;
        var package_for = document.forms["myform"]["package_for"].value;
        var theme = document.forms["myform"]["theme"].value;
        var title = document.forms["myform"]["title"].value;
        var venue = document.forms["myform"]["venue"].value;
        var city = document.forms["myform"]["city"].value;
//        var delivery_cost = document.forms["myform"]["delivery_cost"].value;
//        var service_charge = document.forms["myform"]["service_charge"].value;
//        var other_charges = document.forms["myform"]["other_charges"].value;
        var description = document.forms["myform"]["description"].value;

        // party packages
//        var party_hours = document.forms["myform"]["party_hours"].value;
//        var party_minutes = document.forms["myform"]["party_minutes"].value;
//        var children_min = document.forms["myform"]["children_min"].value;
//        var children_max = document.forms["myform"]["children_max"].value;
//        var adult_min = document.forms["myform"]["adult_min"].value;
//        var adult_max = document.forms["myform"]["adult_max"].value;
//        var child_age_min = document.forms["myform"]["child_age_min"].value;
//        var child_age_max = document.forms["myform"]["child_age_max"].value;
//        var childern_per_head = document.forms["myform"]["childern_per_head"].value;
//        var adult_per_head = document.forms["myform"]["adult_per_head"].value;
//        var package_price = document.forms["myform"]["package_price"].value;

        // food packages
        var type_food_package = document.forms["myform"]["type_food_package"].value;
        var no_persons_served = document.forms["myform"]["no_persons_served"].value;
//        var waiters_provided = document.forms["myform"]["waiters_provided"].value;
//        var food_per_head_charge = document.forms["myform"]["food_per_head_charge"].value;
//        var food_package_price = document.forms["myform"]["food_package_price"].value;
//        var food_plates = document.forms["myform"]["food_plates"].value;
//        var food_cups = document.forms["myform"]["food_cups"].value;
//        var food_straws = document.forms["myform"]["food_straws"].value;
//        var food_napkins = document.forms["myform"]["food_napkins"].value;
//        var food_cutlery = document.forms["myform"]["food_cutlery"].value;
//        var food_chafing_dishes = document.forms["myform"]["food_chafing_dishes"].value;







        if (package_for == null || package_for == "") {

            $("span.val_package_for").html("This field is required.").addClass('validate');
            validation_holder = 1;
        } else {

            $("span.val_package_for").html("");
        }

        if (theme == null || theme == "") {

            $("span.val_theme").html("This field is required.").addClass('validate');
            validation_holder = 1;
        } else {

            $("span.val_theme").html("");
        }

        if (description == null || description == "") {

            $("span.val_des").html("This field is required.").addClass('validate');
            validation_holder = 1;
        } else {

            $("span.val_des").html("");
        }

        if (title == null || title == "") {

            $("span.val_title").html("This field is required.").addClass('validate');
            validation_holder = 1;
        } else {

            $("span.val_title").html("");
        }
        if (venue == null || venue == "") {

            $("span.val_venue").html("This field is required.").addClass('validate');
            validation_holder = 1;
        } else {

            $("span.val_venue").html("");
        }


        if (city == null || city == "") {

            $("span.val_city").html("This field is required.").addClass('validate');
            validation_holder = 1;
        } else {

            $("span.val_city").html("");
        }

//        if (delivery_cost == null || delivery_cost == "") {
//
//            $("span.val_delivery_cost").html("This field is required.").addClass('validate');
//            validation_holder = 1;
//        } else {
//
//            $("span.val_delivery_cost").html("");
//        }
//
//        if (service_charge == null || service_charge == "") {
//
//            $("span.val_service_charge").html("This field is required.").addClass('validate');
//            validation_holder = 1;
//        } else {
//
//            $("span.val_service_charge").html("");
//        }
//
//        if (other_charges == null || other_charges == "") {
//
//            $("span.val_other_charges").html("This field is required.").addClass('validate');
//            validation_holder = 1;
//        } else {
//
//            $("span.val_other_charges").html("");
//        }


        // Party Package Validation

        if (package_type === "Party-Packages") {


            //reset Fields
            $("span.val_type_food_package").html("");
            $("span.val_no_persons_served").html("");
            $("span.val_waiters_provided").html("");
            $("span.val_food_per_head_charge").html("");
            $("span.val_food_package_price").html("");
            $("span.val_food_plates").html("");
            $("span.val_food_cups").html("");
            $("span.val_food_straws").html("");
            $("span.val_food_napkins").html("");
            $("span.val_food_cutlery").html("");
            $("span.val_food_chafing_dishes").html("");



//            if (party_hours == null || party_hours == "") {
//
//                $("span.val_party_hours").html("This field is required.").addClass('validate');
//                validation_holder = 1;
//            } else {
//
//                $("span.val_party_hours").html("");
//            }
//            if (party_minutes == null || party_minutes == "") {
//
//                $("span.val_party_minutes").html("This field is required.").addClass('validate');
//                validation_holder = 1;
//            } else {
//
//                $("span.val_party_minutes").html("");
//            }
//
//            if (children_min == null || children_min == "") {
//
//                $("span.val_children_min").html("This field is required.").addClass('validate');
//                validation_holder = 1;
//            } else {
//
//                $("span.val_children_min").html("");
//            }
//
//            if (children_max == null || children_max == "") {
//
//                $("span.val_children_max").html("This field is required.").addClass('validate');
//                validation_holder = 1;
//            } else {
//
//                $("span.val_children_max").html("");
//            }
//
//            if (adult_min == null || adult_min == "") {
//
//                $("span.val_adult_min").html("This field is required.").addClass('validate');
//                validation_holder = 1;
//            } else {
//
//                $("span.val_adult_min").html("");
//            }
//            if (adult_max == null || adult_max == "") {
//
//                $("span.val_adult_max").html("This field is required.").addClass('validate');
//                validation_holder = 1;
//            } else {
//
//                $("span.val_adult_max").html("");
//            }
//
//            if (child_age_min == null || child_age_min == "") {
//
//                $("span.val_child_age_min").html("This field is required.").addClass('validate');
//                validation_holder = 1;
//            } else {
//
//                $("span.val_child_age_min").html("");
//            }
//            if (child_age_max == null || child_age_max == "") {
//
//                $("span.val_child_age_max").html("This field is required.").addClass('validate');
//                validation_holder = 1;
//            } else {
//
//                $("span.val_child_age_max").html("");
//            }
//
//
//            if (childern_per_head == "" && adult_per_head == "" && package_price == "") {
//
//                $("span.val_per_head_price").html("This field is required.").addClass('validate');
//                validation_holder = 1;
//            } else {
//
//                $("span.val_per_head_price").html("");
//
//
//            }

            // Food Package Validation
        } else {
            //reset Fields
            $("span.val_party_hours").html("");
            $("span.val_party_minutes").html("");
            $("span.val_children_min").html("");
            $("span.val_children_max").html("");
            $("span.val_adult_min").html("");
            $("span.val_adult_max").html("");
            $("span.val_child_age_min").html("");
            $("span.val_child_age_max").html("");
            $("span.val_per_head_price").html("");




            if (type_food_package == null || type_food_package == "") {

                $("span.val_type_food_package").html("This field is required.").addClass('validate');
                validation_holder = 1;
            } else {

                $("span.val_type_food_package").html("");
            }

            if (no_persons_served == null || no_persons_served == "") {

                $("span.val_no_persons_served").html("This field is required.").addClass('validate');
                validation_holder = 1;
            } else {

                $("span.val_no_persons_served").html("");
            }
//            if (waiters_provided == null || waiters_provided == "") {
//
//                $("span.val_waiters_provided").html("This field is required.").addClass('validate');
//                validation_holder = 1;
//            } else {
//
//                $("span.val_waiters_provided").html("");
//            }
//            if (food_per_head_charge == null || food_per_head_charge == "") {
//
//                $("span.val_food_per_head_charge").html("This field is required.").addClass('validate');
//                validation_holder = 1;
//            } else {
//
//                $("span.val_food_per_head_charge").html("");
//            }
//            if (food_package_price == null || food_package_price == "") {
//
//                $("span.val_food_package_price").html("This field is required.").addClass('validate');
//                validation_holder = 1;
//            } else {
//
//                $("span.val_food_package_price").html("");
//            }
//            if (food_plates == null || food_plates == "") {
//
//                $("span.val_food_plates").html("This field is required.").addClass('validate');
//                validation_holder = 1;
//            } else {
//
//                $("span.val_food_plates").html("");
//            }
//            if (food_cups == null || food_cups == "") {
//
//                $("span.val_food_cups").html("This field is required.").addClass('validate');
//                validation_holder = 1;
//            } else {
//
//                $("span.val_food_cups").html("");
//            }
//            if (food_straws == null || food_straws == "") {
//
//                $("span.val_food_straws").html("This field is required.").addClass('validate');
//                validation_holder = 1;
//            } else {
//
//                $("span.val_food_straws").html("");
//            }
//            if (food_napkins == null || food_napkins == "") {
//
//                $("span.val_food_napkins").html("This field is required.").addClass('validate');
//                validation_holder = 1;
//            } else {
//
//                $("span.val_food_napkins").html("");
//            }
//            if (food_cutlery == null || food_cutlery == "") {
//
//                $("span.val_food_cutlery").html("This field is required.").addClass('validate');
//                validation_holder = 1;
//            } else {
//
//                $("span.val_food_cutlery").html("");
//            }
//            if (food_chafing_dishes == null || food_chafing_dishes == "") {
//
//                $("span.val_food_chafing_dishes").html("This field is required.").addClass('validate');
//                validation_holder = 1;
//            } else {
//
//                $("span.val_food_chafing_dishes").html("");
//            }



        }


        if (validation_holder == 1) { // if have a field is blank, return false

            $("p.validate_msg").slideDown("fast");
            return false;
        }
        validation_holder = 0;
    }

</script>

<script>
    $(document).ready(function() {
        $('[data-toggle="tooltip"]').tooltip();
        $('#food-package-container').hide();
    });

    $("#package_type").change(function() {
        var package = $(this).val();
        if (package === "Party-Packages") {
            $('#party-package-container').show();
            $('#food-package-container').hide();
        } else {
            $('#food-package-container').show();
            $('#party-package-container').hide();

        }
    });


</script>
<script>

    function textCounter(field, cnt, maxlimit) {
        var cntfield = document.getElementById(cnt);
        if (field.value.length > maxlimit) // if too long...trim it!
            field.value = field.value.substring(0, maxlimit);
        // otherwise, update 'characters left' counter
        else
            cntfield.value = maxlimit - field.value.length;
    }
</script>