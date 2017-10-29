<?php if ($shopactive == 1) { ?>

    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Shop Settings</h1>

                    <div id="infoMessage" class="alert-info"><?php echo $this->session->flashdata('message'); ?></div>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <?php
            extract($store_info);
            ?>
            <!-- row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="padding-top-10">
                        <p><i class="fa fa-link" aria-hidden="true"></i> Set Your Store Username</p>
                        <div class="row">
                            <div class="col-xs-12">
                                <p style="word-break: break-all;">Your Shop Link Is <strong><?php echo base_url() . "shops/" . $link; ?></strong> </p>
                            </div>
                        </div>

                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#urlModal">Edit Username</button> <a class="btn btn-success" target="_blank" href="<?php echo base_url() . "shops/" . $link; ?>">Visit Link</a>



                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="padding-top-10">
                        <p><i class="fa fa-building" aria-hidden="true"></i> Set Your Company Name</p>

                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#companyModal">Edit Company Name</button>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="padding-top-10">
                        <p><i class="fa fa-picture-o" aria-hidden="true"></i> Set Your Store Cover Image (Image Dimensions 1200px * 375px, Max Size 5MB)</p>

                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#coverimgModal">Edit Cover Image</button>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="padding-top-10">
                        <p><i class="fa fa-commenting-o" aria-hidden="true"></i> Tell About Your Store</p>

                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#overviewModal">Edit Overview</button>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="padding-top-10">
                        <p><i class="fa fa-clock-o" aria-hidden="true"></i> Set Your Store Opening and Close time</p>
                        <!-- Trigger the modal with a button -->
                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#timeModal">Edit Store Time</button>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="padding-top-10">
                        <p><i class="fa fa-map-marker" aria-hidden="true"></i> Set Your Store Address</p>

                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#addressModal">Edit Address</button>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="padding-top-10">
                        <p><i class="fa fa-mobile" aria-hidden="true"></i> Set Your Store Phone Number</p>

                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#phoneModal">Edit Phone Number</button>
                    </div>
                </div>


                <!-- Set Url Modal -->
                <div id="urlModal" class="modal fade" role="dialog">
                    <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Edit Your Store Username</h4>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-xs-9 col-sm-6">
                                        <input type="text" name="link" id="link" class="form-control" maxlength="100" placeholder="Store Link" onkeyup="checklink()" value ="<?php echo $link; ?>"/>
                                        <input type="hidden" id="update"  value="0"/>
                                    </div>
                                    <div class="col-xs-3 col-sm-1">
                                        <div id="result">

                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-5 xs-margin-10">
                                        <button type="button" id="savelink" class="savebtn btn btn-success" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Saving Changes">Save Changes</button>
                                        <button type="button" class="btn btn-ml-cancel" data-dismiss="modal">Cancel</button>
                                    </div>

                                </div>
                            </div>
                            <!--                            <div style="clear: both;" class="modal-footer">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                        </div>-->
                        </div>

                    </div>
                </div>

                <!-- Set companyname Modal -->
                <div id="companyModal" class="modal fade" role="dialog">
                    <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Edit Your Company Name</h4>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-xs-9 col-sm-6">
                                        <input type="text" name="companyname" id="companyname" maxlength="100" class="form-control" placeholder="Company Name" value ="<?php echo $company; ?>"/>

                                    </div>
                                    <div class="col-xs-12 col-sm-6 xs-margin-10">
                                        <button type="button" id="savecompany" class="savebtn btn btn-success" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Saving Changes">Save Changes</button>
                                        <button type="button" class="btn btn-ml-cancel" data-dismiss="modal">Cancel</button>
                                    </div>

                                </div>
                            </div>
                            <!--                            <div style="clear: both;" class="modal-footer">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                        </div>-->
                        </div>

                    </div>
                </div>

                <!-- Set company Overview Modal -->
                <div id="overviewModal" class="modal fade" role="dialog">
                    <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Edit Your Company Overview</h4>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-xs-12">

                                        <textarea class="form-control" rows="5" name="overview" maxlength="1000" id="overview" placeholder="Company Overview, Max 1000 characters"><?php echo $overview; ?></textarea>

                                    </div>


                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-xs-12 xs-margin-10">
                                        <button type="button" id="saveoverview" class="savebtn btn btn-success" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Saving Changes">Save Changes</button>
                                        <button type="button" class="btn btn-ml-cancel" data-dismiss="modal">Cancel</button>
                                    </div>
                                </div>
                            </div>
                            <!--                            <div style="clear: both;" class="modal-footer">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                        </div>-->
                        </div>

                    </div>
                </div>


                <!-- Set company address Modal -->
                <div id="addressModal" class="modal fade" role="dialog">
                    <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Edit Your Company Address</h4>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-xs-9 col-sm-6">
                                        <input type="text" name="address" id="address" maxlength="200" class="form-control" placeholder="Company Address" value ="<?php echo $address; ?>"/>

                                    </div>
                                    <div class="col-xs-12 col-sm-6 xs-margin-10">
                                        <button type="button" id="saveaddress" class="savebtn btn btn-success" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Saving Changes">Save Changes</button>
                                        <button type="button" class="btn btn-ml-cancel" data-dismiss="modal">Cancel</button>
                                    </div>

                                </div>
                            </div>
                            <!--                            <div style="clear: both;" class="modal-footer">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                        </div>-->
                        </div>

                    </div>
                </div>


                <!-- Set company mobile Modal -->
                <div id="phoneModal" class="modal fade" role="dialog">
                    <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Edit Your Company Phone Number</h4>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-xs-9 col-sm-6">
                                        <input type="tel" name="phone" id="phone" maxlength="10" class="form-control" placeholder="Company Phone" value ="<?php echo $mobile; ?>"/>

                                    </div>
                                    <div class="col-xs-12 col-sm-6 xs-margin-10">
                                        <button type="button" id="savephone" class="savebtn btn btn-success" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Saving Changes">Save Changes</button>
                                        <button type="button" class="btn btn-ml-cancel" data-dismiss="modal">Cancel</button>
                                    </div>

                                </div>
                            </div>

                        </div>

                    </div>
                </div>

                <!-- Set company cover img Modal -->
                <div id="coverimgModal" class="modal fade" role="dialog">
                    <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Edit Your Company Cover Image</h4>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <p><strong>Current Cover Image</strong></p>
                                        <?php if (empty($cover_img)) { ?>
                                            <img class="img-responsive" src="<?php echo base_url(); ?>asset/images/default_shop_background.jpg" />
                                        <?php } else { ?>
                                            <img class="img-responsive" src="<?php echo base_url() . 'files/shops/' . $cover_img; ?>" />
                                        <?php } ?>

                                        <br>
                                        <p><strong>Edit New Cover Image</strong></p>
                                        <p>Image Dimensions 1200px * 375px, Max Size 5MB</p>

                                    </div>
                                    <form enctype="multipart/form-data" action="<?php echo base_url(); ?>seller/savecoverimage" method="post" id="form-upload">

                                        <div class="col-xs-9 col-sm-6">

                                            <input type="file" name="userfile" size="20" />

                                            <div class="progress" style="display:none;">
                                                <div id="progress-bar" class="progress-bar progress-bar-success progress-bar-striped " role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100" style="width: 30%;">
                                                    20%
                                                </div>
                                            </div>

                                        </div>
                                        <div class="col-xs-12 col-sm-6 xs-margin-10">
                                            <button type="button" id="upload-btn" class="savebtn btn btn-success" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Saving Changes">Save Changes</button>
                                            <button type="button" class="btn btn-ml-cancel" data-dismiss="modal">Cancel</button>
                                        </div>



                                    </form>
                                </div>
                            </div>
                            <!--                            <div style="clear: both;" class="modal-footer">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                        </div>-->
                        </div>

                    </div>
                </div>


                <!-- open time Modal -->
                <div id="timeModal" class="modal fade" role="dialog">
                    <div class="modal-dialog modal-lg">

                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Edit Store Opening/Close Time</h4>
                            </div>
                            <div class="modal-body">

                                <p>Leave Empty the fields for Store Close Days</p>

                                <div class="row">
                                    <div class="col-xs-12">

                                        <div class="col-xs-6 col-sm-4">
                                            <label style="display: block;">&nbsp;</label>
                                            <label>Monday</label>
                                        </div>

                                        <div class="col-xs-6 col-sm-4">
                                            <input id="time" type="hidden" value="1">
                                            <!-- time Picker -->
                                            <div class="bootstrap-timepicker">
                                                <div class="form-group">
                                                    <label>Open Time</label>
                                                    <div class="input-group bootstrap-timepicker timepicker">
                                                        <input id="timepicker1" type="text" class="form-control input-small" name="open_time" value ="<?php echo($monstart == "00:00:00") ? "" : $monstart; ?>">
                                                        <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                                    </div>
                                                </div><!-- /.form group -->
                                            </div>

                                        </div>
                                        <div class="col-xs-6 col-xs-push-6 col-sm-4 col-sm-push-0">

                                            <!-- time Picker -->
                                            <div class="bootstrap-timepicker">
                                                <div class="form-group">
                                                    <label>Close Time</label>
                                                    <div class="input-group bootstrap-timepicker timepicker">
                                                        <input id="timepicker2" type="text" class="form-control input-small" name="close_time" value ="<?php echo($monclose == "00:00:00") ? "" : $monclose; ?>">
                                                        <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                                    </div>
                                                </div><!-- /.form group -->
                                            </div>

                                        </div>



                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-xs-12">
                                        <div class="col-xs-6 col-sm-4">
                                            <label style="display: block;">&nbsp;</label>
                                            <label>Tuesday</label>
                                        </div>


                                        <div class="col-xs-6 col-sm-4">

                                            <!-- time Picker -->
                                            <div class="bootstrap-timepicker">
                                                <div class="form-group">
                                                    <label>Open Time</label>
                                                    <div class="input-group bootstrap-timepicker timepicker">
                                                        <input id="timepicker3" type="text" class="form-control input-small" name="open_time" value ="<?php echo($tuestart == "00:00:00") ? "" : $tuestart; ?>">
                                                        <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                                    </div>
                                                </div><!-- /.form group -->
                                            </div>

                                        </div>
                                        <div class="col-xs-6 col-xs-push-6 col-sm-4 col-sm-push-0">

                                            <!-- time Picker -->
                                            <div class="bootstrap-timepicker">
                                                <div class="form-group">
                                                    <label>Close Time</label>
                                                    <div class="input-group bootstrap-timepicker timepicker">
                                                        <input id="timepicker4" type="text" class="form-control input-small" name="close_time" value ="<?php echo($tueclose == "00:00:00") ? "" : $tueclose; ?>">
                                                        <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                                    </div>
                                                </div><!-- /.form group -->
                                            </div>

                                        </div>



                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-xs-12">
                                        <div class="col-xs-6 col-sm-4">
                                            <label style="display: block;">&nbsp;</label>
                                            <label>Wednesday</label>
                                        </div>


                                        <div class="col-xs-6 col-sm-4">

                                            <!-- time Picker -->
                                            <div class="bootstrap-timepicker">
                                                <div class="form-group">
                                                    <label>Open Time</label>
                                                    <div class="input-group bootstrap-timepicker timepicker">
                                                        <input id="timepicker5" type="text" class="form-control input-small" name="open_time" value ="<?php echo($wedstart == "00:00:00") ? "" : $wedstart; ?>">
                                                        <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                                    </div>
                                                </div><!-- /.form group -->
                                            </div>

                                        </div>
                                        <div class="col-xs-6 col-xs-push-6 col-sm-4 col-sm-push-0">

                                            <!-- time Picker -->
                                            <div class="bootstrap-timepicker">
                                                <div class="form-group">
                                                    <label>Close Time</label>
                                                    <div class="input-group bootstrap-timepicker timepicker">
                                                        <input id="timepicker6" type="text" class="form-control input-small" name="close_time" value ="<?php echo($wedclose == "00:00:00") ? "" : $wedclose; ?>">
                                                        <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                                    </div>
                                                </div><!-- /.form group -->
                                            </div>

                                        </div>



                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-xs-12">
                                        <div class="col-xs-6 col-sm-4">
                                            <label style="display: block;">&nbsp;</label>
                                            <label>Thursday</label>
                                        </div>


                                        <div class="col-xs-6 col-sm-4">

                                            <!-- time Picker -->
                                            <div class="bootstrap-timepicker">
                                                <div class="form-group">
                                                    <label>Open Time</label>
                                                    <div class="input-group bootstrap-timepicker timepicker">
                                                        <input id="timepicker7" type="text" class="form-control input-small" name="open_time" value ="<?php echo($thustart == "00:00:00") ? "" : $thustart; ?>">
                                                        <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                                    </div>
                                                </div><!-- /.form group -->
                                            </div>

                                        </div>
                                        <div class="col-xs-6 col-xs-push-6 col-sm-4 col-sm-push-0">

                                            <!-- time Picker -->
                                            <div class="bootstrap-timepicker">
                                                <div class="form-group">
                                                    <label>Close Time</label>
                                                    <div class="input-group bootstrap-timepicker timepicker">
                                                        <input id="timepicker8" type="text" class="form-control input-small" name="close_time" value ="<?php echo($thuclose == "00:00:00") ? "" : $thuclose; ?>">
                                                        <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                                    </div>
                                                </div><!-- /.form group -->
                                            </div>

                                        </div>



                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-xs-12">
                                        <div class="col-xs-6 col-sm-4">
                                            <label style="display: block;">&nbsp;</label>
                                            <label>Friday</label>
                                        </div>


                                        <div class="col-xs-6 col-sm-4">

                                            <!-- time Picker -->
                                            <div class="bootstrap-timepicker">
                                                <div class="form-group">
                                                    <label>Open Time</label>
                                                    <div class="input-group bootstrap-timepicker timepicker">
                                                        <input id="timepicker9" type="text" class="form-control input-small" name="open_time" value ="<?php echo($fristart == "00:00:00") ? "" : $fristart; ?>">
                                                        <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                                    </div>
                                                </div><!-- /.form group -->
                                            </div>

                                        </div>
                                        <div class="col-xs-6 col-xs-push-6 col-sm-4 col-sm-push-0">

                                            <!-- time Picker -->
                                            <div class="bootstrap-timepicker">
                                                <div class="form-group">
                                                    <label>Close Time</label>
                                                    <div class="input-group bootstrap-timepicker timepicker">
                                                        <input id="timepicker10" type="text" class="form-control input-small" name="close_time" value ="<?php echo($friclose == "00:00:00") ? "" : $friclose; ?>">
                                                        <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                                    </div>
                                                </div><!-- /.form group -->
                                            </div>

                                        </div>



                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-xs-12">
                                        <div class="col-xs-6 col-sm-4">
                                            <label style="display: block;">&nbsp;</label>
                                            <label>Saturday</label>
                                        </div>


                                        <div class="col-xs-6 col-sm-4">

                                            <!-- time Picker -->
                                            <div class="bootstrap-timepicker">
                                                <div class="form-group">
                                                    <label>Open Time</label>
                                                    <div class="input-group bootstrap-timepicker timepicker">
                                                        <input id="timepicker11" type="text" class="form-control input-small" name="open_time" value ="<?php echo($satstart == "00:00:00") ? "" : $satstart; ?> ?>">
                                                        <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                                    </div>
                                                </div><!-- /.form group -->
                                            </div>

                                        </div>
                                        <div class="col-xs-6 col-xs-push-6 col-sm-4 col-sm-push-0">

                                            <!-- time Picker -->
                                            <div class="bootstrap-timepicker">
                                                <div class="form-group">
                                                    <label>Close Time</label>
                                                    <div class="input-group bootstrap-timepicker timepicker">
                                                        <input id="timepicker12" type="text" class="form-control input-small" name="close_time" value ="<?php echo($satclose == "00:00:00") ? "" : $satclose; ?>">
                                                        <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                                    </div>
                                                </div><!-- /.form group -->
                                            </div>

                                        </div>



                                    </div>

                                </div>



                                <div class="row">
                                    <div class="col-xs-12">
                                        <div class="col-xs-6 col-sm-4">
                                            <label style="display: block;">&nbsp;</label>
                                            <label>Sunday</label>
                                        </div>


                                        <div class="col-xs-6 col-sm-4">

                                            <!-- time Picker -->
                                            <div class="bootstrap-timepicker">
                                                <div class="form-group">
                                                    <label>Open Time</label>
                                                    <div class="input-group bootstrap-timepicker timepicker">
                                                        <input id="timepicker13" type="text" class="form-control input-small" name="open_time" value ="<?php echo($sunstart == "00:00:00") ? "" : $sunstart; ?> ?>">
                                                        <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                                    </div>
                                                </div><!-- /.form group -->
                                            </div>

                                        </div>
                                        <div class="col-xs-6 col-xs-push-6 col-sm-4 col-sm-push-0">

                                            <!-- time Picker -->
                                            <div class="bootstrap-timepicker">
                                                <div class="form-group">
                                                    <label>Close Time</label>
                                                    <div class="input-group bootstrap-timepicker timepicker">
                                                        <input id="timepicker14" type="text" class="form-control input-small" name="close_time" value ="<?php echo ($sunclose == "00:00:00") ? "" : $sunclose; ?>">
                                                        <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                                    </div>
                                                </div><!-- /.form group -->
                                            </div>

                                        </div>



                                    </div>

                                </div>


                                <div class="row">
                                    <div class="col-xs-12 xs-margin-10">
                                        <button type="button" id="savetimes" class="savebtn btn btn-success" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Saving Changes">Save Changes</button>
                                        <button type="button" class="btn btn-ml-cancel" data-dismiss="modal">Cancel</button>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>



                </div>
            </div>
        </div>

    </div>
    <script>
        $('.modal').on('hidden.bs.modal', function() {
            location.reload();
        });




        $('#savetimes').click(function() {
            var time = $('#time').val();
            var monstart = $('#timepicker1').val();
            var monclose = $('#timepicker2').val();
            var tuestart = $('#timepicker3').val();
            var tueclose = $('#timepicker4').val();
            var wedstart = $('#timepicker5').val();
            var wedclose = $('#timepicker6').val();
            var thustart = $('#timepicker7').val();
            var thuclose = $('#timepicker8').val();
            var fristart = $('#timepicker9').val();
            var friclose = $('#timepicker10').val();
            var satstart = $('#timepicker11').val();
            var satclose = $('#timepicker12').val();
            var sunstart = $('#timepicker13').val();
            var sunclose = $('#timepicker14').val();

            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>" + "seller/storeopenclose",
                data: {time: time, monstart: monstart, monclose: monclose, tuestart: tuestart, tueclose: tueclose, wedstart: wedstart, wedclose: wedclose, thustart: thustart, thuclose: thuclose, fristart: fristart, friclose: friclose, satstart: satstart, satclose: satclose, sunstart: sunstart, sunclose: sunclose, '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'},
                success: function(res) {
                    if (res) {

                        try {
                            if (res.result === 1) {
                                $('#timeModal').modal('toggle');
                            } else {
                                $('#timeModal').modal('toggle');
                            }

                        } catch (e) {
                            alert('Exception while request..');
                        }


                    }
                }
            });
        });

        // check Url

        function checklink() {


            var link = $('#link').val();
            $.ajax({
                type: "POST",
                dataType: 'json',
                url: "<?php echo base_url(); ?>" + "seller/checklink",
                data: {link: link, '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'},
                success: function(res) {
                    if (res) {

                        try {
                            if (res.result === 1) {
                                $('#result').empty();
                                $('#result').append('<i style="color:#F10402;" class="fa fa-times fa-2x" aria-hidden="true"></i>');
                                $('#update').val('0');
                            } else {
                                $('#result').empty();
                                $('#result').append('<i style="color:#5cb85c;" class="fa fa-check fa-2x" aria-hidden="true"></i>');
                                $('#update').val('1');
                            }

                        } catch (e) {
                            alert('Exception while request..');
                        }

                        //$( "#modal-data" ).html(res);
                    }
                }
            });
        }


        // SAVE Url

        $("#savelink").click(function() {

            var update = $('#update').val();
            var link = $('#link').val();
            if (update == 1) {
                $.ajax({
                    type: "POST",
                    dataType: 'json',
                    url: "<?php echo base_url(); ?>" + "seller/savelink",
                    data: {link: link, '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'},
                    success: function(res) {
                        if (res) {

                            try {
                                if (res.result === 1) {
                                    $('#update').val('0');
                                    $('#urlModal').modal('toggle');
                                } else {
                                    $('#update').val('1');
                                    $('#urlModal').modal('toggle');
                                }

                            } catch (e) {
                                alert('Exception while request..');
                            }

                            //$( "#modal-data" ).html(res);
                        }
                    }
                });
            } else {
                $('#result').empty();
                $('#result').append('<i style="color:#F10402;" class="fa fa-times fa-2x" aria-hidden="true"></i>');
                $('#update').val('0');
                alert("Username alreday exist please try a new username");
                //$('#urlModal').modal('toggle');

            }
        });

        // Set Company Name

        $("#savecompany").click(function() {


            var companyname = $('#companyname').val();

            $.ajax({
                type: "POST",
                dataType: 'json',
                url: "<?php echo base_url(); ?>" + "seller/savecompany",
                data: {companyname: companyname, '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'},
                success: function(res) {
                    if (res) {

                        try {
                            if (res.result === 1) {
                                $('#companyModal').modal('toggle');
                            } else {
                                $('#companyModal').modal('toggle');
                            }

                        } catch (e) {
                            alert('Exception while request..');
                        }

                        //$( "#modal-data" ).html(res);
                    }
                }
            });

        });

        // Set Company Overview

        $("#saveoverview").click(function() {


            var overview = $('#overview').val();

            $.ajax({
                type: "POST",
                dataType: 'json',
                url: "<?php echo base_url(); ?>" + "seller/saveoverview",
                data: {overview: overview, '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'},
                success: function(res) {
                    if (res) {

                        try {
                            if (res.result === 1) {
                                $('#overviewModal').modal('toggle');
                            } else {
                                $('#overviewModal').modal('toggle');
                            }

                        } catch (e) {
                            alert('Exception while request..');
                        }

                        //$( "#modal-data" ).html(res);
                    }
                }
            });

        });

        // Set Company address

        $("#saveaddress").click(function() {


            var address = $('#address').val();

            $.ajax({
                type: "POST",
                dataType: 'json',
                url: "<?php echo base_url(); ?>" + "seller/saveaddress",
                data: {address: address, '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'},
                success: function(res) {
                    if (res) {

                        try {
                            if (res.result === 1) {
                                $('#addressModal').modal('toggle');
                            } else {
                                $('#addressModal').modal('toggle');
                            }

                        } catch (e) {
                            alert('Exception while request..');
                        }

                        //$( "#modal-data" ).html(res);
                    }
                }
            });

        });


        // Set Company Mobile

        $("#savephone").click(function() {


            var phone = $('#phone').val();

            $.ajax({
                type: "POST",
                dataType: 'json',
                url: "<?php echo base_url(); ?>" + "seller/savephone",
                data: {phone: phone, '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'},
                success: function(res) {
                    if (res) {

                        try {
                            if (res.result === 1) {
                                $('#phoneModal').modal('toggle');
                            } else {
                                $('#phoneModal').modal('toggle');
                            }

                        } catch (e) {
                            alert('Exception while request..');
                        }

                        //$( "#modal-data" ).html(res);
                    }
                }
            });

        });

        // Set Company Cover Image

        $(function() {
            var inputFile = $('input[name=userfile]');
            var uploadURI = $('#form-upload').attr('action');
            var progressBar = $('#progress-bar');

            $('#upload-btn').on('click', function(event) {
                event.preventDefault();
                var fileToUpload = inputFile[0].files[0];
                // make sure there is file to upload
                if (fileToUpload != 'undefined') {
                    // provide the form data
                    // that would be sent to sever through ajax
                    var formData = new FormData();
                    formData.append("userfile", fileToUpload);
                    formData.append('<?php echo $this->security->get_csrf_token_name(); ?>', '<?php echo $this->security->get_csrf_hash(); ?>');
                    // now upload the file using $.ajax
                    $.ajax({
                        url: uploadURI,
                        type: 'post',
                        data: formData,
                        processData: false,
                        contentType: false,
                        enctype: 'multipart/form-data',
                        success: function(data) {
                            if (data.result == '1') {

                                $('#coverimgModal').modal('toggle');

                            } else {
                                alert("Error With Uploading Cover Image, Please Select the Right Image to upload");
                            }
                        },
                        xhr: function() {
                            var xhr = new XMLHttpRequest();
                            xhr.upload.addEventListener("progress", function(event) {
                                if (event.lengthComputable) {
                                    var percentComplete = Math.round((event.loaded / event.total) * 100);
                                    // console.log(percentComplete);

                                    $('.progress').show();
                                    progressBar.css({width: percentComplete + "%"});
                                    progressBar.text(percentComplete + '%');
                                }
                                ;
                            }, false);
                            return xhr;
                        }
                    });
                }
            });
            $('body').on('change.bs.fileinput', function(e) {
                $('.progress').hide();
                progressBar.text("0%");
                progressBar.css({width: "0%"});
            });
        });

        $(function() {
            $('.input-small').datetimepicker({
                format: 'LT'

            });
        });

    </script>

    <?php
} else {
    $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert"><span>Error With Accessing Shop Settings..!</span></div>');
    redirect("dashboard");
}
?>