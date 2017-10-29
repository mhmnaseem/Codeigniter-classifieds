<div class="container">

    <div class="row">
        <div class="margin-top-10 no-bottom-margin">
            <div class="col-md-12">

                <img class="img-responsive" src="<?php echo base_url(); ?>asset/images/main-category-header.jpg" />

            </div>
        </div>
    </div>

    <div class="margin-top-10 float">
        <?php
        $cat_slug = '';
        foreach ($allcats as $cats) {

            if ($cats->mcatid == $catid) {
                $catsname = $cats->name;
            }
        }

        if ($catid == 16 || $catid == 17 || $catid == 18 || $catid == 19 || $catid == 20 || $catid == 24 || $catid == 25) {
            $collection = "Party Items";
            $link = "party-items";
        } elseif ($catid == 26 || $catid == 27 || $catid == 28) {
            $collection = "Foods";
            $link = "foods";
        } elseif ($catid == 29 || $catid == 30 || $catid == 31) {
            $collection = "Games Activites & Services";
            $link = "games-activities-services";
        }
        ?>
        <div class="row main-cat">
            <div class="col-xs-12 col-sm-4 col-md-5">

                <div id="bc1" class="btn-group btn-breadcrumb">
                    <a href="<?php echo base_url(); ?>" class="btn btn-default"><i class="fa fa-home"></i></a>
                    <a href="<?php echo base_url($link); ?>" class="btn btn-default"><div><?php echo $collection; ?></div></a>
                    <a href="#" class="btn btn-default"><div><?php echo $catsname; ?></div></a>
                </div>
            </div>


            <div class="col-xs-12 col-sm-3 col-md-3">

                <button id="start-compare" class="btn btn-default" data-toggle="tooltip" data-placement="right" data-original-title="MAX 3 Items"><i class="fa fa-balance-scale" aria-hidden="true"></i> Compare</button>
                <button id="compare-action" class="btn btn-warning"><i class="fa fa-check-square" aria-hidden="true"></i> View Compare</button>
                <button id="reset" class="btn btn-default"></i> Reset</button>

            </div>
            <div class="col-xs-12 col-sm-5 col-md-4">

                <?php echo $pages; ?>
            </div>

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


    <div class="row">
        <div class="col-xs-12 col-sm-3 col-md-3">

            <!--            <div class="form-group">
                            <select class="form-control" id="sort">
                                <option value="">Sort by</option>
                                <option value="date">Most recent</option>
                                <option value="price">Lowest price</option>

                            </select>
                        </div>-->
            <h4 class="all-cat cats-head">Categories</h4>
            <?php
            foreach ($allcats as $cats) {
                if ($cats->slug == $this->uri->segment(2)) {
                    ?>

                    <div class="custom-collapse">

                        <a id="btn<?php echo $cats->slug; ?>" class="collapse-toggle cat-head" type="button" data-toggle="collapse" data-parent="custom-collapse" data-target="#<?php echo $cats->slug; ?>">

                            <span><strong><?php echo $cats->name; ?></strong></span>

                            <span class="icon-bar"></span>

                            <span class="icon-bar"></span>

                            <span class="icon-bar"></span>

                            <span class="pull-right" style="padding-right:10px;"><i class="fa fa-caret-down" aria-hidden="true"></i></span>

                        </a>

                        <ul class="list-group collapse" id="<?php echo $cats->slug; ?>">

                            <script>
                                var slug = '<?php echo $cats->slug; ?>';
                                var url = '<?php echo $this->uri->segment(2); ?>';
                                if (slug == url) {
                                    $("#<?php echo $this->uri->segment(2); ?>").addClass('collapse in');
                                    $("#btn<?php echo $this->uri->segment(2) ?>").css("color", "#FCB040");
                                    $("#btn<?php echo $this->uri->segment(2); ?>").removeClass('collapsed');
                                }
                            </script>

                            <?php
                            foreach ($allscats as $scats) {

                                $count = 0;

                                foreach ($items as $item) {

                                    if ($scats->id == $item->category) {

                                        $count++;
                                    }
                                }

                                if ($cats->mcatid == $scats->parentcat) {





                                    echo '<a href="' . site_url() . 'subcategory/' . $scats->slug . '"><li id="' . $scats->slug . '" class="list-group-item"><span class="badge">' . $count . '</span>' . $scats->name . '</li></a>';
                                }
                                ?>

                            <?php } ?>



                        </ul>

                    </div>

                    <?php
                }
            }
            ?>












        </div>

        <div class="col-xs-12 col-sm-9 col-md-9">

            <?php
            if (!empty($allmcatitems)) {
                foreach ($allmcatitems as $item) {
                    ?>
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
                    <?php
                }
            } else {
                echo'<h4 class="text-center"> Sorry. No items found in this category.</h4>';
            }
            ?>
        </div>
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
                            $('#result').html("No Items Found");
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










<script>

    function getParameterByName(name) {
        var regexS = "[\\?&]" + name + "=([^&#]*)",
                regex = new RegExp(regexS),
                results = regex.exec(window.location.search);
        if (results == null) {
            return "";
        } else {
            return decodeURIComponent(results[1].replace(/\+/g, " "));
        }
    }




    $(document).ready(function() {
        $("#sort").change(function() {
            var pageURL = window.location.href.split('?')[0];
            var sort = $("#sort").val();
            if (sort === 'date') {

                window.location.href = pageURL + '?sort=date';
            } else if (sort === 'price') {
                window.location.href = pageURL + '?sort=price';
            }
        });

        var result = getParameterByName('sort');
        if (result === "date") {
            $('#sort').val('date');

        } else if (result === "price") {
            $('#sort').val('price');
        }


    });


</script>


