<div class="container">

    <!--   --- foods Nav ---  -->
    <div class="foods-nav">
        <div class="row">
            <div class="margin-top-10 no-bottom-margin">
                <div class="col-md-12">

                    <img class="img-responsive" src="<?php echo base_url(); ?>asset/images/foods_header.jpg" />

                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-md-12">
                <div class="margin-top-10 no-bottom-margin">
                    <nav class="navbar navbar-default">
                        <div class="container-fluid">
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar2">
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>

                            </div>
                            <div class="collapse navbar-collapse" id="myNavbar2">

                                <ul class="nav navbar-nav">
                                    <!--                                    <li><a href="#">All Food Items</a></li>-->
                                    <li><a href="<?php echo base_url('category/birthday-cakes'); ?>">Birthday Cakes</a></li>
                                    <li><a href="<?php echo base_url('category/party-food'); ?>">Party Food</a></li>
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Party Snacks<span class="caret"></span></a>
                                        <ul class="dropdown-menu">
                                            <li><a href="<?php echo base_url('subcategory/candy-floss'); ?>">Candy Floss</a></li>
                                            <li><a href="<?php echo base_url('subcategory/pop-corn'); ?>">Pop Corn</a></li>
                                            <li><a href="<?php echo base_url('subcategory/ice-cream'); ?>">Ice Cream</a></li>
                                            <li><a href="<?php echo base_url('subcategory/chocolate-fountain'); ?>">Chocolate Fountain</a></li>
                                            <li><a href="<?php echo base_url('subcategory/sweets-treats'); ?>">Sweets & Treats</a></li>
                                            <li><a href="<?php echo base_url('subcategory/tea-coffee-machine'); ?>">Tea/Coffee Machine</a></li>
                                            <li><a href="<?php echo base_url('subcategory/other-party-snacks'); ?>">Other Party Snacks</a></li>


                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </nav><!-- /nav -->
                </div>
            </div>

        </div>

        <!--   breadcrumb   -->
        <div class="row foods-nav">
            <div class="margin-top-10 float">
                <div class="col-xs-12 col-sm-4 col-md-5">
                    <div id="bc1" class="btn-group btn-breadcrumb">
                        <a href="<?php echo base_url(); ?>" class="btn btn-default"><i class="fa fa-home"></i></a>
                        <a href="#" class="btn btn-default"><div>Foods</div></a>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-3 col-md-3">

                    <button id="start-compare" class="btn btn-default" data-toggle="tooltip" data-placement="right" data-original-title="MAX 3 Items"><i class="fa fa-balance-scale" aria-hidden="true"></i> Compare</button>
                    <button id="compare-action" class="btn btn-warning"><i class="fa fa-check-square" aria-hidden="true"></i> View Comparison</button>
                    <button id="reset" class="btn btn-default"></i> Reset</button>

                </div>
                <div class="col-xs-12 col-sm-5 col-md-4">

                    <?php echo $pages; ?>
                </div>
            </div>
            <?php if (!empty($filter)) { ?>
                <div class="col-xs-12 col-sm-12 col-md-12 margin-top-10 no-bottom-margin">
                    <div class="alert alert-info">
                        Items displays for your Selected Theme <?php echo $filter; ?>, Clear the Theme to show all items
                    </div>
                </div>
            <?php }
            ?>
        </div>
        <!--   / breadcrumb   -->
    </div>
    <!--  -- /foods Nav --- -->

</div>

<!-- --- Products Listings --- -->


<div class="container">


    <?php foreach ($foods as $item) { ?>
        <div class="list-view float">

            <div class="col-xs-12">
                <div class="row">
                    <div class="col-xs-12 col-sm-3 list-thumb">
                        <div class="row">
                            <a href="<?php echo base_url() . 'item/' . $item->itemslug ?>"><img src="<?php echo base_url() . 'files/thumb/' . $item->image ?>"/></a>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-9 list-content">
                        <div class="row">
                            <div class="col-xs-12">
                                <h4 class="list-item-title"><a href="<?php echo base_url() . 'item/' . $item->itemslug ?>"><?php echo $item->title; ?></a></h4>
                            </div>
                            <div class="col-xs-12">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-8 col-md-8">
                                        <ul class="list-item-details">
                                            <li><label>Theme</label><span><?php echo $item->theme; ?></span></li>
                                            <li><label>Purchase Price</label><span><?php echo!empty($item->pprice) ? 'Rs ' . $item->pprice : 'N/A'; ?></span></li>
                                            <li><label>Rental Price</label><span><?php echo!empty($item->rprice) ? 'Rs ' . $item->rprice : 'N/A'; ?></span></li>
                                        </ul>
                                        <?php if ($item->package == "yes") { ?>
                                            <p> Also Offered as a package Item  </p>
                                        <?php } ?>
                                        <label class="compare_label"> <input  class="compare_checkbox" type="checkbox" name="compare" value="<?php echo $item->item_id; ?>" /><span> Add to Compare</span></label>

                                    </div>
                                    <div class="col-xs-12 col-sm-4 col-md-4">
                                        <p class="item-location"><?php echo $item->pro_name; ?>, <?php echo $item->city_name; ?></p>

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
                    url: '<?= base_url() ?>home/compare',
                    success: function(response) {


                        $('#result').empty();

                        var obj = eval(response);

                        if (obj.length > 0) {
                            $("#result").show();

                            var itemsf = [];
                            $.each(obj, function(i, val) {

                                itemsf.push($('<div class="col-xs-12 col-sm-12 col-md-4"><table class = "table table-striped"><tbody><tr><td><img src="<?php echo base_url('files/thumb/') ?>' + val.image + '" class="img-responsive"></td></tr><tr><td>' + val.title + '</td></tr><tr><td>Theme: ' + val.theme + '</td></tr><tr><td>Purchase Price:' + val.pprice + '</td></tr><tr><td>Rental Price: ' + val.rprice + '</td></tr><tr><td>Package: ' + val.package + '</td></tr></tbody></table></div>'));

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
                alert("Please Select Items for Comparison");
            }

        });

    });
</script>






