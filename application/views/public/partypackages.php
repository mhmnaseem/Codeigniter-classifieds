<div class="container">
    <!--    <div class="margin-top-10 no-bottom-margin">
            <div id="bc1" class="btn-group btn-breadcrumb">
                <a href="<?php //echo base_url();                                                                                                                                                                                                                                                                    ?>" class="btn btn-default"><i class="fa fa-home"></i></a>
                <a href="#" class="btn btn-default"><div>Party Items</div></a>
            </div>
        </div>-->

    <!--   --- birthday Nav ---  -->
    <div class="birthday-nav">
        <div class="row">
            <div class="margin-top-10 no-bottom-margin">
                <div class="col-md-12">

                    <img class="img-responsive" src="<?php echo base_url(); ?>asset/images/party_packages.jpg" />

                </div>
            </div>
        </div>

        <!--    breadcrumb   -->
        <div class="row package-nav">
            <div class="margin-top-10 float">
                <div class="col-xs-12 col-sm-4 col-md-4">
                    <div id="bc1" class="btn-group btn-breadcrumb">
                        <a href="<?php echo base_url(); ?>" class="btn btn-default"><i class="fa fa-home"></i></a>
                        <a href="#" class="btn btn-default"><div>Party Packages</div></a>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-3 col-md-4">

                    <button id="start-compare" class="btn btn-default" data-toggle="tooltip" data-placement="right" data-original-title="MAX 3 Packages"><i class="fa fa-balance-scale" aria-hidden="true"></i> Compare</button>
                    <button id="compare-action" class="btn btn-warning"><i class="fa fa-check-square" aria-hidden="true"></i> View Comparison</button>
                    <button id="reset" class="btn btn-default"></i> Reset</button>

                </div>
                <div class="col-xs-12 col-sm-5 col-md-4 text-right">
                    <?php echo $pages; ?>
                </div>
            </div>
            <?php if (!empty($filter)) { ?>
                <div class="col-xs-12 col-sm-12 col-md-12 margin-top-10 no-bottom-margin">
                    <div class="alert alert-info">
                        Package displays for your Selected Theme <?php echo $filter; ?>, Clear the Theme to show all items
                    </div>
                </div>
            <?php }
            ?>
        </div>
        <!--   / breadcrumb   -->

    </div>
    <!--  -- /birthday Nav --- -->

</div>

<!-- --- Products Listings --- -->


<div class="container">


    <?php foreach ($partypack as $pack) { ?>
        <div class="list-view float">

            <div class="col-xs-12">
                <div class="row">
                    <div class="col-xs-12 col-sm-3 list-thumb">
                        <div class="row">
                            <a href="<?php echo base_url() . 'package/' . $pack->packslug ?>"><img src="<?php echo base_url() . 'files/thumb/' . $pack->image ?>"/></a>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-9 list-content">
                        <div class="row">
                            <div class="col-xs-12">
                                <h4 class="list-item-title"><a href="<?php echo base_url() . 'package/' . $pack->packslug ?>"><?php echo $pack->title; ?></a></h4>
                            </div>
                            <div class="col-xs-12">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-8 col-md-8">
                                        <ul class="list-item-details">
                                            <li><label>Theme</label><span><?php echo $pack->theme; ?></span></li>
                                            <li><label>Package For</label><span><?php echo $pack->package_for; ?></span></li>
                                            <li><label>Seller</label><span><?php
                                                    if (!empty($pack->company)) {
                                                        echo $pack->company;
                                                    } else {
                                                        echo $pack->fname . ' ' . $pack->lname;
                                                    }
                                                    ?></span></li>

                                        </ul>

                                        <label class="compare_label"> <input  class="compare_checkbox" type="checkbox" name="compare" value="<?php echo $pack->pack_id; ?>" /><span> Add to Compare</span></label>

                                    </div>
                                    <div class="col-xs-12 col-sm-4 col-md-4">
                                        <p class="item-location"><?php echo $pack->pro_name; ?>, <?php echo $pack->city_name; ?></p>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>


    <!--   Footer pagination   -->
    <div class="row">
        <div class="margin-top-10 float">

            <div class="col-xs-12 col-sm-12 col-md-12">
                <?php echo $pages; ?>
            </div>
        </div>
    </div>
    <!--   / Footer pagination   -->

</div>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Compare Result</h4>
            </div>
            <div class="modal-body">
                <div id="result">

                </div>
            </div>
            <div style="clear: both;"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>
<script>
    $(document).ready(function() {

        $('[data-toggle="tooltip"]').tooltip();


        $('#compare-action').click(function() {
            var sel = [];
            var sel = $('input[type=checkbox]:checked').map(function(_, el) {
                return $(el).val();
            }).get();

            if (sel.length !== 0) {
                //alert(sel);

                $.ajax({
                    type: "POST",
                    data: {'id': sel, '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'},
                    url: '<?= base_url('home/packcompare') ?>',
                    success: function(response) {


                        $('#result').empty();

                        var obj = eval(response);

                        if (obj.length > 0) {
                            $("#result").show();

                            var itemsf = [];
                            $.each(obj, function(i, val) {

                                if (val.title == null) {
                                    var venues = "N/A";
                                } else {
                                    var venues = val.title;
                                }

                                itemsf.push($('<div class="col-xs-12 col-sm-12 col-md-4"><table class = "table table-striped"><tbody><tr><td><img src="<?php echo base_url('files/thumb/') ?>' + val.pack_image + '" class="img-responsive"></td></tr><tr><td>' + val.pack_title + '</td></tr><tr><td>Theme: ' + val.theme + '</td></tr><tr><td> Venue: ' + venues + '</td></tr><tr><td> Party Duration: Hours: ' + val.party_hours + ' - Minutes: ' + val.party_minutes + '</td></tr><tr><td> Children Allowed: Min: ' + val.children_min + ' - Max: ' + val.children_max + '</td></tr><tr><td> Adults Allowed: Min: ' + val.adult_min + ' - Max: ' + val.adult_max + '</td></tr><tr><td> Children Age Limit: Min: ' + val.child_age_min + ' - Max: ' + val.child_age_max + '</td></tr><tr><td> Children Per Head Charge: ' + val.childern_per_head + ' </td></tr><tr><td> Adults Per Head Charge: ' + val.adult_per_head + ' </td></tr><tr><td> Package Price: ' + val.package_price + ' </td></tr><tr><td> Delivery/Transport Cost: ' + val.delivery_cost + ' </td></tr><tr><td> Service Charge: ' + val.service_charge + ' </td></tr><tr><td> Other Charges: ' + val.other_charges + ' </td></tr></tbody></table></div>'));

                            });
                            $('#result').append.apply($('#result'), itemsf);
                        } else
                        {
                            $("#result").show();
                            $('#result').html("No Listing Found");
                        }
                    }
                });
                $('#myModal').modal('toggle');



            } else {
                alert("Please Select Packages for Comparison");
            }

        });

    });
</script>