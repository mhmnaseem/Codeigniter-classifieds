<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Post Item/Service</h1>
                <div class="row bs-wizard" style="border-bottom:0;">

                    <div id="step1" class="col-xs-6 bs-wizard-step active">
                        <div class="text-center bs-wizard-stepnum">Step 1</div>
                        <div class="progress"><div class="progress-bar"></div></div>
                        <a href="#" class="bs-wizard-dot"></a>
                        <div class="bs-wizard-info text-center">Fill Form</div>
                    </div>

                    <div class="col-xs-6 bs-wizard-step disabled">
                        <div class="text-center bs-wizard-stepnum">Step 2</div>
                        <div class="progress"><div class="progress-bar"></div></div>
                        <a href="#" class="bs-wizard-dot"></a>
                        <div class="bs-wizard-info text-center">Upload Images & Submit</div>
                    </div>

                </div>
                <div id="infoMessage" class="alert-info"><?php echo $this->session->flashdata('message'); ?></div>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <!-- row -->
        <div class="row">


            <div class="col-xs-12 col-sm-12 col-md-12">
                <p>Fields marked with <span class="required">*</span> are mandatory</p>
                <p class="validate_msg  bg-danger">Please fix the errors below!</p>
                <form  method="post" action="<?php echo base_url('seller/additem') ?>" id="form" onsubmit="return validateForm()" name="myform">
                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                    <div class="row">


                        <div class="col-xs-12 col-sm-12 col-md-6">

                            <div class="form-group">

                                <p><strong>Select a Main Category <span class="required">*</span></strong> <span>(Not sure which category to post? </span><a href="#"data-toggle="modal" data-target="#myModal" >Click here</a><span>..)</span>

                                    <select name="mcat" class="form-control" id="mcat"  data-toggle="tooltip" data-placement="top" title="Please contact us if your category/sub category is not listed here">

                                        <option value=""></option>

                                        <?php foreach ($mcats as $mcat) { ?>

                                            <option value="<?php echo $mcat->mcatid; ?>"><?php echo $mcat->name; ?></option>

                                        <?php } ?>

                                    </select><span class="val_mcat"></span>
                                </p>

                            </div>

                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6">
                            <div class="form-group">

                                <p><strong>Select a Sub Category <span class="required">*</span></strong>
                                    <select disabled="disabled" name="scat"  id="scats" class="form-control">


                                    </select><span class="val_scat"></span></p>

                            </div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6">

                            <div class="form-group">
                                <p><strong>Title <span class="required">*</span></strong>
                                    <input type="text" name="title" class="form-control" placeholder="Maximum 60 characters" maxlength="60">
                                    <span class="val_title"></span></p>
                            </div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6">
                            <div class="form-group">

                                <p><strong>Select a Theme <span class="required">*</span></strong>
                                    <select name="theme" class="form-control" data-toggle="tooltip" data-placement="top" title="Increase your chance of getting more interested customers by selecting an appropriate theme. Contact us if your theme is not listed here ">

                                        <option value="Non-Themed">Non-Themed Item</option>

                                        <?php foreach ($themes as $theme) { ?>

                                            <option value="<?php echo $theme->themename; ?>"><?php echo $theme->themename; ?></option>

                                        <?php } ?>


                                    </select><span class="val_theme"></span>
                                </p>

                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-3">
                            <div class="form-group">
                                <p><strong>Purchase Price (Rs)</strong>


                                    <input type="number" name="pprice" list="pprice" placeholder="" class="form-control">
                                    <datalist id="pprice">
                                        <option>00</option>

                                    </datalist>
                                </p>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-3">
                            <div class="form-group">
                                <p><strong>Rental Price (Rs)</strong>


                                    <input type="number" name="rprice" list="rprice" placeholder="" class="form-control">
                                    <datalist id="rprice">
                                        <option>00</option>

                                    </datalist>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6">
                            <div class="form-group">

                                <p><strong>Do you want to add this item to a party/food package at a later stage?</strong>
                                    <select id="package-item" name="package" class="form-control" data-toggle="tooltip" data-placement="top" title="If you are selecting 'YES', Please remember to link this item/service to a package within two days. Failing to do so, will result in removal of this post">
                                        <option value="no">No</option>
                                        <option value="yes">Yes</option>

                                    </select><span class="val_package"></span>
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
                    <div class="form-group">
                        <p><strong>Description <span class="required">*</span></strong> <i style="float: right;"><input style="color:red;font-size:12pt;font-style:italic; border: 0px;" readonly type="text" id='q20length' name="q20length2" size="3" maxlength="4" value="5000"> of  &nbsp;&nbsp; 5000 left</i>
                            <textarea name="description" class="form-control" placeholder="Describe your item with as much details as you can. You are given 5000 characters to write all about it.  Write away!" rows="5" cols="50" maxlength="5000" onKeyDown="textCounter(this, 'q20length', 5000)" onKeyUp="textCounter(this, 'q20length', 5000)" ></textarea>
                            <span class="val_des"></span></p>
                    </div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-sm-push-3 col-md-6 col-md-push-3">
                            <button type="submit" class="btn btn-lg btn-ml-login btn-block" name="submit">Next</button>
                            <br>
                            <br>
                            </form>
                        </div>
                    </div>
            </div>

            <div class="col-xs-12 col-sm-6 col-md-6">

            </div>

        </div>


    </div>
</div>

</div>
</div>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Categories</h4>
            </div>
            <div class="modal-body">
                <table width="100%" border="0" class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                        <tr>
                            <th scope="col">Your Item</th>
                            <th scope="col">Categories</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Adults Tables and Chairs</td>
                            <td>Party Items/Party Furniture</td>
                        </tr>
                        <tr>
                            <td>Balloon Twisting & Modelling</td>
                            <td>Party Items/Balloons</td>
                        </tr>
                        <tr>
                            <td>Balloon Twisting & Modelling</td>
                            <td>Games, Activities & Services/Play Areas & Entertainment</td>
                        </tr>
                        <tr>
                            <td>Balloons Arch/Decor</td>
                            <td>Party Items/Balloons</td>
                        </tr>
                        <tr>
                            <td>Banners Printing</td>
                            <td>Party Items/Printing</td>
                        </tr>
                        <tr>
                            <td>Banners</td>
                            <td>Party Items/Decorations</td>
                        </tr>
                        <tr>
                            <td>Birthday Cake Decorations</td>
                            <td>Party Items/Decorations</td>
                        </tr>
                        <tr>
                            <td>Birthday Cakes</td>
                            <td>Foods/Birthday Cakes</td>
                        </tr>
                        <tr>
                            <td>Bounces</td>
                            <td>Games, Activities & Services/Play Areas & Entertainment </td>
                        </tr>
                        <tr>
                            <td>Bubble Machine</td>
                            <td>Party Items/Decorations </td>
                        </tr>
                        <tr>
                            <td>Buntings</td>
                            <td>Party Items/Decorations </td>
                        </tr>
                        <tr>
                            <td>Cake Holders</td>
                            <td>Party Items/Tableware </td>
                        </tr>
                        <tr>
                            <td>Cake Table</td>
                            <td>Party Items/Party Furniture</td>
                        </tr>
                        <tr>
                            <td>Candles</td>
                            <td>Party Items/Decorations</td>
                        </tr>
                        <tr>
                            <td>Candy Floss</td>
                            <td>Foods/Party Snacks</td>
                        </tr>
                        <tr>
                            <td>Catering Tables</td>
                            <td>Party Items/Party Furniture</td>
                        </tr>
                        <tr>
                            <td>Chocolate Fountain</td>
                            <td>Foods/Party Snacks</td>
                        </tr>
                        <tr>
                            <td>Clown</td>
                            <td>Games, Activities & Services/Play Areas & Entertainment </td>
                        </tr>
                        <tr>
                            <td>Coloured Hair Spray</td>
                            <td>Party Items/Wearables</td>
                        </tr>
                        <tr>
                            <td>Confetti & Party Strings</td>
                            <td>Party Items/Decorations</td>
                        </tr>
                        <tr>
                            <td>Costumes</td>
                            <td>Party Items/Wearables</td>
                        </tr>
                        <tr>
                            <td>Disco balls & lights</td>
                            <td>Party Items/Decorations </td>
                        </tr>
                        <tr>
                            <td>DJ</td>
                            <td>Games, Activities & Services/Play Areas & Entertainment  </td>
                        </tr>
                        <tr>
                            <td>Door Decor</td>
                            <td>Party Items/Decorations </td>
                        </tr>
                        <tr>
                            <td>Drinkware</td>
                            <td>Party Items/Tableware</td>
                        </tr>
                        <tr>
                            <td>Face Paint</td>
                            <td>Party Items/Wearables</td>
                        </tr>
                        <tr>
                            <td>Face/Body/Nail painting</td>
                            <td>Games, Activities & Services/Play Areas & Entertainment</td>
                        </tr>
                        <tr>
                            <td>Floor runners</td>
                            <td>Party Items/Decorations</td>
                        </tr>
                        <tr>
                            <td>Foil Balloons</td>
                            <td>Party Items/Balloons </td>
                        </tr>
                        <tr>
                            <td>Games & Group Activities</td>
                            <td>Games, Activities & Services/Games & Group Activities</td>
                        </tr>
                        <tr>
                            <td>Gas Balloons</td>
                            <td>Party Items/Balloons</td>
                        </tr>
                        <tr>
                            <td>Gift Tables</td>
                            <td>Party Items/Party Furniture </td>
                        </tr>
                        <tr>
                            <td>Gloves</td>
                            <td>Party Items/Wearables</td>
                        </tr>
                        <tr>
                            <td>Hanging Decorations</td>
                            <td>Party Items/Decorations </td>
                        </tr>
                        <tr>
                            <td>Hats</td>
                            <td>Party Items/Wearables</td>
                        </tr>
                        <tr>
                            <td>Ice Cream</td>
                            <td>Foods/Party Snacks</td>
                        </tr>
                        <tr>
                            <td>Invitation printing</td>
                            <td>Party Items/Printing</td>
                        </tr>
                        <tr>
                            <td>Kiddy Rides</td>
                            <td>Games, Activities & Services/Play Areas & Entertainment </td>
                        </tr>
                        <tr>
                            <td>Kids Tables and Chairs</td>
                            <td>Party Items/Party Furniture</td>
                        </tr>
                        <tr>
                            <td>Latex Balloons</td>
                            <td>Party Items/Balloons </td>
                        </tr>
                        <tr>
                            <td>Loot Bag Fillers</td>
                            <td>Party Items/Party Favours</td>
                        </tr>
                        <tr>
                            <td>Loot/Goody Bags</td>
                            <td>Party Items/Party Favours</td>
                        </tr>
                        <tr>
                            <td>Magic Balloons</td>
                            <td>Party Items/Balloons</td>
                        </tr>
                        <tr>
                            <td>Magician</td>
                            <td>Games, Activities & Services/Play Areas & Entertainment </td>
                        </tr>
                        <tr>
                            <td>Mascot</td>
                            <td>Games, Activities & Services/Play Areas & Entertainment  </td>
                        </tr>
                        <tr>
                            <td>Merry-go-round</td>
                            <td>Games, Activities & Services/Play Areas & Entertainment  </td>
                        </tr>
                        <tr>
                            <td>Mugs Printing</td>
                            <td>Party Items/Printing</td>
                        </tr>
                        <tr>
                            <td>Music/Karaoke</td>
                            <td>Games, Activities & Services/Play Areas & Entertainment  </td>
                        </tr>
                        <tr>
                            <td>Mustaches & beards</td>
                            <td>Party Items/Wearables</td>
                        </tr>
                        <tr>
                            <td>Other Balloons Decorations</td>
                            <td>Party Items/Balloons</td>
                        </tr>
                        <tr>
                            <td>Other Decorations</td>
                            <td>Party Items/Decorations </td>
                        </tr>
                        <tr>
                            <td>Other Entertainers</td>
                            <td>Games, Activities & Services/Play Areas & Entertainment </td>
                        </tr>
                        <tr>
                            <td>Other Headwear</td>
                            <td>Party Items/Wearables</td>
                        </tr>
                        <tr>
                            <td>Other Party Favours</td>
                            <td>Party Items/Party Favours</td>
                        </tr>
                        <tr>
                            <td>Other Party Furniture</td>
                            <td>Party Items/Party Furniture</td>
                        </tr>
                        <tr>
                            <td>Other Party Snacks</td>
                            <td>Foods/Party Snacks</td>
                        </tr>
                        <tr>
                            <td>Other Printing</td>
                            <td>Party Items/Printing</td>
                        </tr>
                        <tr>
                            <td>Other Professionals</td>
                            <td>Games, Activities & Services/Professional Services</td>
                        </tr>
                        <tr>
                            <td>Other Tableware</td>
                            <td>Party Items/Tableware</td>
                        </tr>
                        <tr>
                            <td>Other Wearables</td>
                            <td>Party Items/Wearables </td>
                        </tr>
                        <tr>
                            <td>Others Play Areas & Entertainment</td>
                            <td>Games, Activities & Services/Play Areas & Entertainment </td>
                        </tr>
                        <tr>
                            <td>Paper plates, Cups & Straws</td>
                            <td>Party Items/Tableware</td>
                        </tr>
                        <tr>
                            <td>Paper/Tissue paper decor</td>
                            <td>Party Items/Tableware</td>
                        </tr>
                        <tr>
                            <td>Paper plates, Cups & Straws</td>
                            <td>Party Items/Decorations</td>
                        </tr>
                        <tr>
                            <td>Party Food</td>
                            <td>Foods/Party Food</td>
                        </tr>
                        <tr>
                            <td>Party Jewelry</td>
                            <td>Party Items/Wearables</td>
                        </tr>
                        <tr>
                            <td>Party Masks</td>
                            <td>Party Items/Wearables</td>
                        </tr>
                        <tr>
                            <td>Party Vests</td>
                            <td>Party Items/Wearables</td>
                        </tr>
                        <tr>
                            <td>Photo stand-ins</td>
                            <td>Party Items/Decorations</td>
                        </tr>
                        <tr>
                            <td>Photographer</td>
                            <td>Games, Activities & Services/Professional Services</td>
                        </tr>
                        <tr>
                            <td>Pinatas</td>
                            <td>Party Items/Decorations</td>
                        </tr>
                        <tr>
                            <td>Plastic Cutlery</td>
                            <td>Party Items/Tableware</td>
                        </tr>
                        <tr>
                            <td>Pom poms</td>
                            <td>Party Items/Decorations</td>
                        </tr>
                        <tr>
                            <td>Pop Corn</td>
                            <td>Foods/Party Snacks</td>
                        </tr>
                        <tr>
                            <td>Printed Balloons</td>
                            <td>Party Items/Balloons</td>
                        </tr>
                        <tr>
                            <td>Servers/Helpers</td>
                            <td>Games, Activities & Services/Professional Services</td>
                        </tr>
                        <tr>
                            <td>Smoke Machine</td>
                            <td>Party Items/Decorations</td>
                        </tr>
                        <tr>
                            <td>Standups & cutouts</td>
                            <td>Party Items/Decorations</td>
                        </tr>
                        <tr>
                            <td>Stationery</td>
                            <td>Party Items/Party Favours</td>
                        </tr>
                        <tr>
                            <td>Stickers</td>
                            <td>Party Items/Party Favours</td>
                        </tr>
                        <tr>
                            <td>Sunglasses</td>
                            <td>Party Items/Wearables</td>
                        </tr>
                        <tr>
                            <td>Sweets & Treats</td>
                            <td>Foods/Party Snacks</td>
                        </tr>
                        <tr>
                            <td>Table Covers</td>
                            <td>Party Items/Tableware</td>
                        </tr>
                        <tr>
                            <td>Table Decor</td>
                            <td>Party Items/Decorations</td>
                        </tr
                        ><tr>
                            <td>Tea/Coffee Machine</td>
                            <td>Foods/Party Snacks</td>
                        </tr>
                        <tr>
                            <td>Temporary Tattoos</td>
                            <td>Party Items/Wearables</td>
                        </tr>
                        <tr>
                            <td>Tiaras and Crowns</td>
                            <td>Party Items/Wearables</td>
                        </tr>
                        <tr>
                            <td>Toys</td>
                            <td>Party Items/Party Favours</td>
                        </tr>
                        <tr>
                            <td>Trampoline</td>
                            <td>Games, Activities & Services/Play Areas & Entertainment </td>
                        </tr>
                        <tr>
                            <td>Trays</td>
                            <td>Party Items/Tableware</td>
                        </tr>
                        <tr>
                            <td>Water/Juice Dispenser</td>
                            <td>Party Items/Tableware</td>
                        </tr>
                        <tr>
                            <td>Wigs & Extensions</td>
                            <td>Party Items/Wearables</td>
                        </tr>
                        <tr>
                            <td>Food Packages</td>
                            <td>Packages</td>
                        </tr>
                        <tr>
                            <td>Party Packages</td>
                            <td>Packages</td>
                        </tr>
                        <tr>
                            <td>Venues</td>
                            <td>Venues</td>
                        </tr>

                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>



<script>
    jQuery(document).ready(function() {
        $("#mcat").on("change", function() {
            $('#scats').empty();
            $('#scats').val('');
            var category_id = $('#mcat').val();
            //console.log(category_id);

            $.ajax({
                type: "POST",
                data: {'category_id': category_id, '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'},
                url: '<?= base_url() ?>seller/getsubcats/',
                success: function(data) {

                    $("#scats").prop('disabled', false);

                    $.each(data, function(i, data) {

                        $('#scats').append("<option value='" + data.id + "'>" + data.description + "</option>");
                    });
//                    $("#scats").prepend("<option value=''>-----    --      ------    --    -----</option>");
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
        var theme = document.forms["myform"]["theme"].value;
        var city = document.forms["myform"]["city"].value;
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
        if (desc == null || desc == "") {

            $("span.val_des").html("This field is required.").addClass('validate');
            validation_holder = 1;
        } else {

            $("span.val_des").html("");
        }

//        if (pprice == "" && rprice == "" && package == "no") {
//
//            $("span.val_price").html("This field is required.").addClass('validate');
//            validation_holder = 1;
//        } else {
//
//            $("span.val_price").html("");
//        }

        if (theme == null || theme == "") {

            $("span.val_theme").html("This field is required.").addClass('validate');
            validation_holder = 1;
        } else {

            $("span.val_theme").html("");
        }

        if (city == null || city == "") {

            $("span.val_city").html("This field is required.").addClass('validate');
            validation_holder = 1;
        } else {

            $("span.val_city").html("");
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
<script type="text/javascript">
    $(document).ready(function() {

        $('#dataTables-example').DataTable({
            responsive: true,
            "iDisplayLength": 10

        });

    });
</script>

