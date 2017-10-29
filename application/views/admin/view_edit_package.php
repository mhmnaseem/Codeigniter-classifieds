<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">View Package Changes</h1>

                <div id="infoMessage" class="alert-info"><?php echo $this->session->flashdata('message'); ?></div>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <!-- row -->
        <div class="row">


            <div class="col-xs-12 col-sm-12 col-md-12">
                <?php foreach ($selecteditempackage as $package) { ?>
                    <div class="col-xs-12 col-sm-12 col-md-6">

                        <h4>User Info </h4>
                        <table class="table">
                            <tr>
                                <th>Full Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                            </tr>
                            <tr>
                                <td><?php echo $package->fname . ' ' . $package->lname; ?></td>
                                <td><?php echo $package->email; ?></td>
                                <td><?php echo $package->mobile; ?></td>
                            </tr>
                        </table>

                        <h3>Original</h3>
                        <p>Fields marked with <span class="required">*</span> are mandatory</p>

                        <input type="hidden" id="package_type" name="package_type" value="<?php echo $package->package_type; ?>">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">

                                    <p><strong>Package Designed for <span class="required">*</span></strong>
                                        <select  name="package_for" disabled="disabled"  class="form-control">

                                            <option value="Children & adults"<?php
                                            if ($package->package_for == "Children & adults") {

                                                echo set_select('package_for', 'Children & adults');
                                                echo "selected=selected";
                                            }
                                            ?>>Children & adults</option>

                                            <option value="Children" <?php
                                            if ($package->package_for == "Children") {

                                                echo set_select('package_for', 'Children');
                                                echo "selected=selected";
                                            }
                                            ?>>Children</option>
                                            <option value="Adult"<?php
                                            if ($package->package_for == "Adult") {

                                                echo set_select('package_for', 'Adult');
                                                echo "selected=selected";
                                            }
                                            ?>>Adults</option>

                                        </select><span class="val_package_for"></span>
                                    </p>

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">

                                    <p><strong>Theme <span class="required">*</span></strong>
                                        <select name="theme" disabled="disabled" class="form-control" data-toggle="tooltip" data-placement="top" title="Increase your chance of getting more interested customers by selecting an appropriate theme. Contact us if your theme is not listed here">


                                            <option value="Non-Themed"<?php
                                            if ($package->theme == "Non-Themed") {

                                                echo set_select('theme', 'Non-Themed');
                                                echo "selected=selected";
                                            }
                                            ?>>Non-Themed Package</option>
                                                    <?php
                                                    foreach ($themes as $theme) {

                                                        if ($package->theme == $theme->themename) {

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
                                    <p><strong>Title <span class="required">*</span></strong>
                                        <input type="text" disabled="disabled" name="title" class="form-control" placeholder="Title" value="<?php echo $package->title; ?>" maxlength="60" data-toggle="tooltip" data-placement="top" title="Be concise specific. Do not enter the contact details here, MAX 60 characters">
                                        <span class="val_title"></span></p>
                                </div>
                            </div>


                        </div>
                        <div class="party-package-container">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <p><strong>Venue</strong>
                                            <select name="venue" disabled="disabled" class="form-control" data-toggle="tooltip" data-placement="top" title="Select a Venue for this item. Contact us, if your Venue is not listed here">

                                                <option value="No Specific Venue"<?php
                                                if ($package->venue == "No Specific Venue") {

                                                    echo set_select('venue', 'No Specific Venue');
                                                    echo "selected=selected";
                                                }
                                                ?>>No Specific Venue</option>

                                                <?php
                                                foreach ($venues as $venue) {

                                                    if ($package->venue == $venue->venue_id) {

                                                        echo '<option selected="selected" value="' . $venue->venue_id . '">' . $venue->title . '</option>';
                                                    } else {

                                                        echo '<option value="' . $venue->venue_id . '">' . $venue->title . '</option>';
                                                    }
                                                }
                                                ?>



                                            </select><span class="val_venue"></span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">

                                    <p> <strong>Party Duration</strong></p>
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <p><strong>Hours</strong>
                                                    <select name="party_hours" class="form-control" disabled="disabled">

                                                        <?php
                                                        for ($i = 0; $i <= 24; $i++) {
                                                            if ($package->party_hours == $i) {
                                                                echo '<option selected="selected" value="' . $package->party_hours . '">' . $package->party_hours . '</option>';
                                                            } else {

                                                                echo '<option value="' . $i . '">' . $i . '</option>';
                                                            }
                                                        }
                                                        ?>
                                                    </select>

                                                    <span class="val_party_hours"></span>
                                                </p>


                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <p><strong>Minutes</strong>

                                                    <select name="party_minutes" class="form-control" disabled="disabled">

                                                        <?php
                                                        for ($j = 0; $j <= 60; $j++) {


                                                            if ($package->party_minutes == $j) {
                                                                echo '<option selected="selected" value="' . $package->party_minutes . '">' . $package->party_minutes . '</option>';
                                                            } else {

                                                                echo '<option value="' . $j . '">' . $j . '</option>';
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                    <span class="val_party_minutes">
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <p> <strong>No. of Children Allowed</strong></p>
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <p><strong>Minimum</strong>
                                                    <input type="number" disabled="disabled" name="children_min" list="party_hours" value="<?php echo $package->children_min; ?>" placeholder="" class="form-control">
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
                                                    <input type="number" disabled="disabled" name="children_max" list="party_minutes" placeholder="" value="<?php echo $package->children_max; ?>" class="form-control">
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
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <p> <strong>No.of Adults Allowed</strong></p>
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <p><strong>Minimum</strong>
                                                    <input type="number" disabled="disabled" name="adult_min" list="party_hours" placeholder="" class="form-control" value="<?php echo $package->adult_min; ?>">
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
                                                    <input type="number" disabled="disabled" name="adult_max" list="party_minutes" placeholder="" class="form-control" value="<?php echo $package->adult_max; ?>">
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
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <p> <strong>Children Age limit</strong></p>
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <p><strong>Minimum</strong>
                                                    <input type="number" disabled="disabled" name="child_age_min" list="party_hours" placeholder="" class="form-control" value="<?php echo $package->child_age_min; ?>" >
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
                                                    <input type="number" name="child_age_max" disabled="disabled" list="party_minutes" placeholder="" class="form-control" value="<?php echo $package->child_age_max; ?>">
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
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <p><strong>Children Per Head Charge</strong>


                                            <input type="number" disabled="disabled" name="childern_per_head" list="childern_per_head" placeholder="" class="form-control"  value="<?php echo $package->childern_per_head; ?>">
                                            <datalist id="childern_per_head">
                                                <option>00</option>

                                            </datalist>
                                            <span class="val_childern_per_head">
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <p><strong>Adults Per Head Charge </strong>


                                            <input type="number" disabled="disabled" name="adult_per_head" list="adult_per_head" placeholder="" class="form-control" value="<?php echo $package->adult_per_head; ?>">
                                            <datalist id="adult_per_head">
                                                <option>00</option>

                                            </datalist>
                                            <span class="val_adult_per_head">
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">

                                        <p><strong>Package Price </strong>


                                            <input type="number" disabled="disabled" name="package_price" list="package_price" placeholder="" class="form-control" value="<?php echo $package->package_price; ?>">
                                            <datalist id="package_price">
                                                <option>00</option>
                                            </datalist>
                                            <span class="val_package_price">
                                        </p>

                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <span class="val_per_head_price"></span>
                                </div>
                            </div>




                        </div>

                        <div class="food-package-container">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">

                                        <p><strong>Type of Food Package <span class="required">*</span></strong>
                                            <select  name="type_food_package" class="form-control" disabled="disabled">

                                                <option value="Catering"<?php
                                                if ($package->type_food_package == "Catering") {

                                                    echo set_select('type_food_package', 'Catering');
                                                    echo "selected=selected";
                                                }
                                                ?>>Catering</option>
                                                <option value="Takeaway"<?php
                                                if ($package->type_food_package == "Takeaway") {

                                                    echo set_select('type_food_package', 'Takeaway');
                                                    echo "selected=selected";
                                                }
                                                ?>>Takeaway</option>

                                            </select><span class="val_type_food_package"></span>
                                        </p>

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">

                                        <p><strong>No. Persons Served <span class="required">*</span></strong>


                                            <input type="number" disabled="disabled" name="no_persons_served" list="no_persons_served" placeholder="" class="form-control" value="<?php echo $package->no_persons_served; ?>">
                                            <datalist id="no_persons_served">
                                                <option>00</option>
                                            </datalist>
                                            <span class="val_no_persons_served">
                                        </p>

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">

                                        <p><strong>Waiters Provided</strong>
                                            <select  name="waiters_provided" class="form-control" disabled="disabled">

                                                <option value="Yes"<?php
                                                if ($package->waiters_provided == "Yes") {

                                                    echo set_select('waiters_provided', 'Yes');
                                                    echo "selected=selected";
                                                }
                                                ?>>Yes</option>
                                                <option value="No"<?php
                                                if ($package->waiters_provided == "No") {

                                                    echo set_select('waiters_provided', 'No');
                                                    echo "selected=selected";
                                                }
                                                ?>>No</option>

                                            </select><span class="val_waiters_provided"></span>
                                        </p>

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">

                                        <p><strong>Per Head Charge (If applicable)</strong>


                                            <input type="number" disabled="disabled" name="food_per_head_charge" list="food_per_head_charge" placeholder="" class="form-control" value="<?php echo $package->food_per_head_charge; ?>">
                                            <datalist id="food_per_head_charge">
                                                <option>00</option>
                                            </datalist>
                                            <span class="val_food_per_head_charge">
                                        </p>

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">

                                        <p><strong>Package Price (If applicable)</strong>


                                            <input type="number" disabled="disabled" name="food_package_price" list="food_package_price" placeholder="" class="form-control" value="<?php echo $package->food_package_price; ?>">
                                            <datalist id="food_package_price">
                                                <option>00</option>
                                            </datalist>
                                            <span class="val_food_package_price">
                                        </p>

                                    </div>
                                </div>
                            </div>
                            <p style="color:#7DBE48;"><strong>Tableware</strong></p>

                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">

                                        <p><strong>Plates</strong>
                                            <select  name="food_plates" class="form-control" disabled="disabled">

                                                <option value="Yes"<?php
                                                if ($package->food_plates == "Yes") {

                                                    echo set_select('food_plates', 'Yes');
                                                    echo "selected=selected";
                                                }
                                                ?>>Yes</option>
                                                <option value="No"<?php
                                                if ($package->food_plates == "No") {

                                                    echo set_select('food_plates', 'No');
                                                    echo "selected=selected";
                                                }
                                                ?>>No</option>

                                            </select><span class="val_food_plates"></span>
                                        </p>

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">

                                        <p><strong>Cups</strong>
                                            <select  name="food_cups" class="form-control" disabled="disabled">

                                                <option value="Yes"<?php
                                                if ($package->food_cups == "Yes") {

                                                    echo set_select('food_cups', 'Yes');
                                                    echo "selected=selected";
                                                }
                                                ?>>Yes</option>
                                                <option value="No"<?php
                                                if ($package->food_cups == "No") {

                                                    echo set_select('food_cups', 'No');
                                                    echo "selected=selected";
                                                }
                                                ?>>No</option>

                                            </select><span class="val_food_cups"></span>
                                        </p>

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">

                                        <p><strong>Straws</strong>
                                            <select  name="food_straws" class="form-control" disabled="disabled">

                                                <option value="Yes"<?php
                                                if ($package->food_straws == "Yes") {

                                                    echo set_select('food_straws', 'Yes');
                                                    echo "selected=selected";
                                                }
                                                ?>>Yes</option>
                                                <option value="No"<?php
                                                if ($package->food_straws == "No") {

                                                    echo set_select('food_straws', 'No');
                                                    echo "selected=selected";
                                                }
                                                ?>>No</option>

                                            </select><span class="val_food_straws"></span>
                                        </p>

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">

                                        <p><strong>Cutlery</strong>
                                            <select  name="food_cutlery" class="form-control" disabled="disabled">

                                                <option value="Yes"<?php
                                                if ($package->food_cutlery == "Yes") {

                                                    echo set_select('food_cutlery', 'Yes');
                                                    echo "selected=selected";
                                                }
                                                ?>>Yes</option>
                                                <option value="No"<?php
                                                if ($package->food_cutlery == "No") {

                                                    echo set_select('food_cutlery', 'No');
                                                    echo "selected=selected";
                                                }
                                                ?>>No</option>

                                            </select><span class="val_food_cutlery"></span>
                                        </p>

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">

                                        <p><strong>Napkins</strong>
                                            <select  name="food_napkins" class="form-control" disabled="disabled">

                                                <option value="Yes"<?php
                                                if ($package->food_napkins == "Yes") {

                                                    echo set_select('food_napkins', 'Yes');
                                                    echo "selected=selected";
                                                }
                                                ?>>Yes</option>
                                                <option value="No"<?php
                                                if ($package->food_napkins == "No") {

                                                    echo set_select('food_napkins', 'No');
                                                    echo "selected=selected";
                                                }
                                                ?>>No</option>

                                            </select><span class="val_food_napkins"></span>
                                        </p>

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">

                                        <p><strong>Chafing Dishes</strong>
                                            <select  name="food_chafing_dishes" class="form-control" disabled="disabled">

                                                <option value="Yes"<?php
                                                if ($package->food_chafing_dishes == "Yes") {

                                                    echo set_select('food_chafing_dishes', 'Yes');
                                                    echo "selected=selected";
                                                }
                                                ?>>Yes</option>
                                                <option value="No"<?php
                                                if ($package->food_chafing_dishes == "No") {

                                                    echo set_select('food_chafing_dishes', 'No');
                                                    echo "selected=selected";
                                                }
                                                ?>>No</option>

                                            </select><span class="val_food_chafing_dishes"></span>
                                        </p>

                                    </div>
                                </div>
                            </div>


                        </div>


                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">

                                    <p><strong>Delivery/Transport Cost</strong>
                                        <select  name="delivery_cost" class="form-control" disabled="disabled">

                                            <option value="N/A"<?php
                                            if ($package->delivery_cost == "N/A") {

                                                echo set_select('delivery_cost', 'N/A');
                                                echo "selected=selected";
                                            }
                                            ?>>N/A</option>
                                            <option value="Free"<?php
                                            if ($package->delivery_cost == "Free") {

                                                echo set_select('delivery_cost', 'Free');
                                                echo "selected=selected";
                                            }
                                            ?>>Free</option>
                                            <option value="Contact Seller"<?php
                                            if ($package->delivery_cost == "Contact Seller") {

                                                echo set_select('delivery_cost', 'Contact Seller');
                                                echo "selected=selected";
                                            }
                                            ?>>Contact Seller</option>
                                        </select><span class="val_delivery_cost"></span>
                                    </p>

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <p><strong>Service Charge</strong>
                                        <input type="number" disabled="disabled" name="service_charge" list="service_charge" placeholder="" class="form-control" value="<?php echo $package->service_charge; ?>">
                                        <datalist id="service_charge">
                                            <option>00</option>
                                        </datalist>
                                        <span class="val_service_charge">
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <p><strong>Other Charges</strong>
                                        <input type="number" disabled="disabled" name="other_charges" list="other_charges" placeholder="" class="form-control" value="<?php echo $package->other_charges; ?>">
                                        <datalist id="other_charges">
                                            <option>00</option>
                                        </datalist>
                                        <span class="val_other_charges">
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">

                                    <p><strong>City <span class="required">*</span></strong>

                                        <select name="city" class="form-control" disabled="disabled">

                                            <?php foreach ($allprovinces as $province) { ?>

                                                <option style="background-color:#000;" disabled="disabled"><?php echo $province->pro_name; ?></option>
                                                <?php
                                                foreach ($allcities as $city) {
                                                    if ($province->id == $city->province_id) {
                                                        if ($package->city == $city->id) {

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
                                    <p><strong>Description <span class="required">*</span></strong> <i style="float: right;"><input style="color:red;font-size:12pt;font-style:italic; border: 0px;" readonly type="text" id='q20length' name="q20length2" size="3" maxlength="4" value="5000"> of &nbsp;&nbsp; 5000 characters left</i>
                                        <textarea name="description"  disabled="disabled" id="description" class="form-control" placeholder="Describe your item with as much details as you can. You are given 5000 characters to write all about it.  Write away!" rows="6" cols="50" maxlength="5000"  onKeyDown="textCounter(this, 'q20length', 5000)" onKeyUp="textCounter(this, 'q20length', 5000)" ><?php echo $package->description; ?></textarea>
                                        <span class="val_des"></span></p>
                                </div>
                            </div>
                        </div>





                    <?php } ?>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6">
                    <?php foreach ($packageedit as $editpackage) { ?>
                        <h3>Changes</h3>

                        <p>Fields marked with <span class="required">*</span> are mandatory</p>


                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">

                                    <p><strong>Package Designed for <span class="required">*</span></strong>
                                        <select  name="package_for" disabled="disabled"  class="form-control">

                                            <option value="Children & adults"<?php
                                            if ($editpackage->package_for == "Children & adults") {

                                                echo set_select('package_for', 'Children & adults');
                                                echo "selected=selected";
                                            }
                                            ?>>Children & adults</option>

                                            <option value="Children" <?php
                                            if ($editpackage->package_for == "Children") {

                                                echo set_select('package_for', 'Children');
                                                echo "selected=selected";
                                            }
                                            ?>>Children</option>
                                            <option value="Adult"<?php
                                            if ($editpackage->package_for == "Adult") {

                                                echo set_select('package_for', 'Adult');
                                                echo "selected=selected";
                                            }
                                            ?>>Adults</option>

                                        </select><span class="val_package_for"></span>
                                    </p>

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">

                                    <p><strong>Theme <span class="required">*</span></strong>
                                        <select name="theme" disabled="disabled" class="form-control" data-toggle="tooltip" data-placement="top" title="Increase your chance of getting more interested customers by selecting an appropriate theme. Contact us if your theme is not listed here">


                                            <option value="Non-Themed"<?php
                                            if ($editpackage->theme == "Non-Themed") {

                                                echo set_select('theme', 'Non-Themed');
                                                echo "selected=selected";
                                            }
                                            ?>>Non-Themed Package</option>
                                                    <?php
                                                    foreach ($themes as $theme) {

                                                        if ($editpackage->theme == $theme->themename) {

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
                                    <p><strong>Title <span class="required">*</span></strong>
                                        <input type="text" disabled="disabled" name="title" class="form-control" placeholder="Title" value="<?php echo $editpackage->title; ?>" maxlength="60" data-toggle="tooltip" data-placement="top" title="Be concise specific. Do not enter the contact details here, MAX 60 characters">
                                        <span class="val_title"></span></p>
                                </div>
                            </div>


                        </div>
                        <div class="party-package-container">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <p><strong>Venue</strong>
                                            <select name="venue" disabled="disabled" class="form-control" data-toggle="tooltip" data-placement="top" title="Select a Venue for this item. Contact us, if your Venue is not listed here">

                                                <option value="No Specific Venue"<?php
                                                if ($editpackage->venue == "No Specific Venue") {

                                                    echo set_select('venue', 'No Specific Venue');
                                                    echo "selected=selected";
                                                }
                                                ?>>No Specific Venue</option>

                                                <?php
                                                foreach ($venues as $venue) {

                                                    if ($editpackage->venue == $venue->venue_id) {

                                                        echo '<option selected="selected" value="' . $venue->venue_id . '">' . $venue->title . '</option>';
                                                    } else {

                                                        echo '<option value="' . $venue->venue_id . '">' . $venue->title . '</option>';
                                                    }
                                                }
                                                ?>



                                            </select><span class="val_venue"></span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">

                                    <p> <strong>Party Duration</strong></p>
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <p><strong>Hours</strong>
                                                    <select name="party_hours" class="form-control" disabled="disabled">

                                                        <?php
                                                        for ($i = 0; $i <= 24; $i++) {
                                                            if ($editpackage->party_hours == $i) {
                                                                echo '<option selected="selected" value="' . $package->party_hours . '">' . $package->party_hours . '</option>';
                                                            } else {

                                                                echo '<option value="' . $i . '">' . $i . '</option>';
                                                            }
                                                        }
                                                        ?>
                                                    </select>

                                                    <span class="val_party_hours"></span>
                                                </p>


                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <p><strong>Minutes</strong>

                                                    <select name="party_minutes" class="form-control" disabled="disabled">

                                                        <?php
                                                        for ($j = 0; $j <= 60; $j++) {


                                                            if ($editpackage->party_minutes == $j) {
                                                                echo '<option selected="selected" value="' . $package->party_minutes . '">' . $package->party_minutes . '</option>';
                                                            } else {

                                                                echo '<option value="' . $j . '">' . $j . '</option>';
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                    <span class="val_party_minutes">
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <p> <strong>No. of Children Allowed</strong></p>
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <p><strong>Minimum</strong>
                                                    <input type="number" disabled="disabled" name="children_min" list="party_hours" value="<?php echo $editpackage->children_min; ?>" placeholder="" class="form-control">
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
                                                    <input type="number" disabled="disabled" name="children_max" list="party_minutes" placeholder="" value="<?php echo $editpackage->children_max; ?>" class="form-control">
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
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <p> <strong>No.of Adults Allowed</strong></p>
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <p><strong>Minimum</strong>
                                                    <input type="number" disabled="disabled" name="adult_min" list="party_hours" placeholder="" class="form-control" value="<?php echo $editpackage->adult_min; ?>">
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
                                                    <input type="number" disabled="disabled" name="adult_max" list="party_minutes" placeholder="" class="form-control" value="<?php echo $editpackage->adult_max; ?>">
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
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <p> <strong>Children Age limit</strong></p>
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <p><strong>Minimum</strong>
                                                    <input type="number" disabled="disabled" name="child_age_min" list="party_hours" placeholder="" class="form-control" value="<?php echo $editpackage->child_age_min; ?>" >
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
                                                    <input type="number" name="child_age_max" disabled="disabled" list="party_minutes" placeholder="" class="form-control" value="<?php echo $editpackage->child_age_max; ?>">
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
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <p><strong>Children Per Head Charge</strong>


                                            <input type="number" disabled="disabled" name="childern_per_head" list="childern_per_head" placeholder="" class="form-control"  value="<?php echo $editpackage->childern_per_head; ?>">
                                            <datalist id="childern_per_head">
                                                <option>00</option>

                                            </datalist>
                                            <span class="val_childern_per_head">
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <p><strong>Adults Per Head Charge </strong>


                                            <input type="number" disabled="disabled" name="adult_per_head" list="adult_per_head" placeholder="" class="form-control" value="<?php echo $editpackage->adult_per_head; ?>">
                                            <datalist id="adult_per_head">
                                                <option>00</option>

                                            </datalist>
                                            <span class="val_adult_per_head">
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">

                                        <p><strong>Package Price </strong>


                                            <input type="number" disabled="disabled" name="package_price" list="package_price" placeholder="" class="form-control" value="<?php echo $editpackage->package_price; ?>">
                                            <datalist id="package_price">
                                                <option>00</option>
                                            </datalist>
                                            <span class="val_package_price">
                                        </p>

                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <span class="val_per_head_price"></span>
                                </div>
                            </div>




                        </div>

                        <div class="food-package-container">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">

                                        <p><strong>Type of Food Package <span class="required">*</span></strong>
                                            <select  name="type_food_package" class="form-control" disabled="disabled">

                                                <option value="Catering"<?php
                                                if ($editpackage->type_food_package == "Catering") {

                                                    echo set_select('type_food_package', 'Catering');
                                                    echo "selected=selected";
                                                }
                                                ?>>Catering</option>
                                                <option value="Takeaway"<?php
                                                if ($editpackage->type_food_package == "Takeaway") {

                                                    echo set_select('type_food_package', 'Takeaway');
                                                    echo "selected=selected";
                                                }
                                                ?>>Takeaway</option>

                                            </select><span class="val_type_food_package"></span>
                                        </p>

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">

                                        <p><strong>No. Persons Served <span class="required">*</span></strong>


                                            <input type="number" disabled="disabled" name="no_persons_served" list="no_persons_served" placeholder="" class="form-control" value="<?php echo $editpackage->no_persons_served; ?>">
                                            <datalist id="no_persons_served">
                                                <option>00</option>
                                            </datalist>
                                            <span class="val_no_persons_served">
                                        </p>

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">

                                        <p><strong>Waiters Provided</strong>
                                            <select  name="waiters_provided" class="form-control" disabled="disabled">

                                                <option value="Yes"<?php
                                                if ($editpackage->waiters_provided == "Yes") {

                                                    echo set_select('waiters_provided', 'Yes');
                                                    echo "selected=selected";
                                                }
                                                ?>>Yes</option>
                                                <option value="No"<?php
                                                if ($editpackage->waiters_provided == "No") {

                                                    echo set_select('waiters_provided', 'No');
                                                    echo "selected=selected";
                                                }
                                                ?>>No</option>

                                            </select><span class="val_waiters_provided"></span>
                                        </p>

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">

                                        <p><strong>Per Head Charge (If applicable)</strong>


                                            <input type="number" disabled="disabled" name="food_per_head_charge" list="food_per_head_charge" placeholder="" class="form-control" value="<?php echo $editpackage->food_per_head_charge; ?>">
                                            <datalist id="food_per_head_charge">
                                                <option>00</option>
                                            </datalist>
                                            <span class="val_food_per_head_charge">
                                        </p>

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">

                                        <p><strong>Package Price (If applicable)</strong>


                                            <input type="number" disabled="disabled" name="food_package_price" list="food_package_price" placeholder="" class="form-control" value="<?php echo $editpackage->food_package_price; ?>">
                                            <datalist id="food_package_price">
                                                <option>00</option>
                                            </datalist>
                                            <span class="val_food_package_price">
                                        </p>

                                    </div>
                                </div>
                            </div>
                            <p style="color:#7DBE48;"><strong>Tableware</strong></p>

                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">

                                        <p><strong>Plates</strong>
                                            <select  name="food_plates" class="form-control" disabled="disabled">

                                                <option value="Yes"<?php
                                                if ($editpackage->food_plates == "Yes") {

                                                    echo set_select('food_plates', 'Yes');
                                                    echo "selected=selected";
                                                }
                                                ?>>Yes</option>
                                                <option value="No"<?php
                                                if ($editpackage->food_plates == "No") {

                                                    echo set_select('food_plates', 'No');
                                                    echo "selected=selected";
                                                }
                                                ?>>No</option>

                                            </select><span class="val_food_plates"></span>
                                        </p>

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">

                                        <p><strong>Cups</strong>
                                            <select  name="food_cups" class="form-control" disabled="disabled">

                                                <option value="Yes"<?php
                                                if ($editpackage->food_cups == "Yes") {

                                                    echo set_select('food_cups', 'Yes');
                                                    echo "selected=selected";
                                                }
                                                ?>>Yes</option>
                                                <option value="No"<?php
                                                if ($editpackage->food_cups == "No") {

                                                    echo set_select('food_cups', 'No');
                                                    echo "selected=selected";
                                                }
                                                ?>>No</option>

                                            </select><span class="val_food_cups"></span>
                                        </p>

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">

                                        <p><strong>Straws</strong>
                                            <select  name="food_straws" class="form-control" disabled="disabled">

                                                <option value="Yes"<?php
                                                if ($editpackage->food_straws == "Yes") {

                                                    echo set_select('food_straws', 'Yes');
                                                    echo "selected=selected";
                                                }
                                                ?>>Yes</option>
                                                <option value="No"<?php
                                                if ($editpackage->food_straws == "No") {

                                                    echo set_select('food_straws', 'No');
                                                    echo "selected=selected";
                                                }
                                                ?>>No</option>

                                            </select><span class="val_food_straws"></span>
                                        </p>

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">

                                        <p><strong>Cutlery</strong>
                                            <select  name="food_cutlery" class="form-control" disabled="disabled">

                                                <option value="Yes"<?php
                                                if ($editpackage->food_cutlery == "Yes") {

                                                    echo set_select('food_cutlery', 'Yes');
                                                    echo "selected=selected";
                                                }
                                                ?>>Yes</option>
                                                <option value="No"<?php
                                                if ($editpackage->food_cutlery == "No") {

                                                    echo set_select('food_cutlery', 'No');
                                                    echo "selected=selected";
                                                }
                                                ?>>No</option>

                                            </select><span class="val_food_cutlery"></span>
                                        </p>

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">

                                        <p><strong>Napkins</strong>
                                            <select  name="food_napkins" class="form-control" disabled="disabled">

                                                <option value="Yes"<?php
                                                if ($editpackage->food_napkins == "Yes") {

                                                    echo set_select('food_napkins', 'Yes');
                                                    echo "selected=selected";
                                                }
                                                ?>>Yes</option>
                                                <option value="No"<?php
                                                if ($editpackage->food_napkins == "No") {

                                                    echo set_select('food_napkins', 'No');
                                                    echo "selected=selected";
                                                }
                                                ?>>No</option>

                                            </select><span class="val_food_napkins"></span>
                                        </p>

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">

                                        <p><strong>Chafing Dishes</strong>
                                            <select  name="food_chafing_dishes" class="form-control" disabled="disabled">

                                                <option value="Yes"<?php
                                                if ($editpackage->food_chafing_dishes == "Yes") {

                                                    echo set_select('food_chafing_dishes', 'Yes');
                                                    echo "selected=selected";
                                                }
                                                ?>>Yes</option>
                                                <option value="No"<?php
                                                if ($editpackage->food_chafing_dishes == "No") {

                                                    echo set_select('food_chafing_dishes', 'No');
                                                    echo "selected=selected";
                                                }
                                                ?>>No</option>

                                            </select><span class="val_food_chafing_dishes"></span>
                                        </p>

                                    </div>
                                </div>
                            </div>


                        </div>


                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">

                                    <p><strong>Delivery/Transport Cost</strong>
                                        <select  name="delivery_cost" class="form-control" disabled="disabled">

                                            <option value="N/A"<?php
                                            if ($editpackage->delivery_cost == "N/A") {

                                                echo set_select('delivery_cost', 'N/A');
                                                echo "selected=selected";
                                            }
                                            ?>>N/A</option>
                                            <option value="Free"<?php
                                            if ($editpackage->delivery_cost == "Free") {

                                                echo set_select('delivery_cost', 'Free');
                                                echo "selected=selected";
                                            }
                                            ?>>Free</option>
                                            <option value="Contact Seller"<?php
                                            if ($editpackage->delivery_cost == "Contact Seller") {

                                                echo set_select('delivery_cost', 'Contact Seller');
                                                echo "selected=selected";
                                            }
                                            ?>>Contact Seller</option>
                                        </select><span class="val_delivery_cost"></span>
                                    </p>

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <p><strong>Service Charge</strong>
                                        <input type="number" disabled="disabled" name="service_charge" list="service_charge" placeholder="" class="form-control" value="<?php echo $editpackage->service_charge; ?>">
                                        <datalist id="service_charge">
                                            <option>00</option>
                                        </datalist>
                                        <span class="val_service_charge">
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <p><strong>Other Charges</strong>
                                        <input type="number" disabled="disabled" name="other_charges" list="other_charges" placeholder="" class="form-control" value="<?php echo $editpackage->other_charges; ?>">
                                        <datalist id="other_charges">
                                            <option>00</option>
                                        </datalist>
                                        <span class="val_other_charges">
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">

                                    <p><strong>City <span class="required">*</span></strong>

                                        <select name="city" class="form-control" disabled="disabled">

                                            <?php foreach ($allprovinces as $province) { ?>

                                                <option style="background-color:#000;" disabled="disabled"><?php echo $province->pro_name; ?></option>
                                                <?php
                                                foreach ($allcities as $city) {
                                                    if ($province->id == $city->province_id) {
                                                        if ($editpackage->city == $city->id) {

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
                                    <p><strong>Description <span class="required">*</span></strong> <i style="float: right;"><input style="color:red;font-size:12pt;font-style:italic; border: 0px;" readonly type="text" id='q20length2' name="q20length2" size="3" maxlength="4" value="5000"> of &nbsp;&nbsp; 5000 characters left</i>
                                        <textarea name="description"  disabled="disabled" id="description2" class="form-control" placeholder="Describe your item with as much details as you can. You are given 5000 characters to write all about it.  Write away!" rows="6" cols="50" maxlength="5000"  onKeyDown="textCounter(this, 'q20length2', 5000)" onKeyUp="textCounter(this, 'q20length2', 5000)" ><?php echo $editpackage->description; ?></textarea>
                                        <span class="val_des"></span></p>
                                </div>
                            </div>
                        </div>






                    </div>


                <?php } ?>






            </div>





        </div>
        <div class="row">
            <div class="col-sm-12 col-md-6">
                <a class="btn btn-lg btn-ml-cancel btn-block" href="<?php echo base_url('admin') ?>">Close</a>
            </div>
        </div>
        <div style="margin-bottom: 30px; clear: both;" ></div>



    </div>



</div>


</div>


<script>
    $(document).ready(function() {
        $('[data-toggle="tooltip"]').tooltip();
        var package = $('#package_type').val();
        if (package === "Party-Packages") {
            $('.party-package-container').show();
            $('.food-package-container').hide();
        } else {
            $('.food-package-container').show();
            $('.party-package-container').hide();

        }


    });



    $(document).ready(function() {
        var remain = 5000 - $('#description2').val().length;
        $('#q20length').val(remain);
        var remain2 = 5000 - $('#description2').val().length;
        $('#q20length2').val(remain);
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