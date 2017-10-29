<div class="container single-item">
    <?php
    foreach ($singlepackage as $pack) {
        ?>
        <div class="margin-top-10 no-bottom-margin">
            <div id="bc1" class="btn-group btn-breadcrumb">
                <a href="<?php echo base_url(); ?>" class="btn btn-default"><i class="fa fa-home"></i></a>
                <a href="<?php echo ($pack->package_type == "Party-Packages") ? base_url('party-packages') : base_url('food-packages'); ?>" class="btn btn-default"><div><?php echo ($pack->package_type == "Party-Packages") ? 'Party Packages' : 'Food Packages'; ?></div></a>
                <a href="#" class="btn btn-default"><div>Package</div></a>
            </div>
        </div>


        <div itemscope="itemscope" itemtype="http://schema.org/Product">
            <div class="row">

                <div class="col-xs-12 col-sm-5 col-md-5">
                    <div class="margin-top-10">
                        <div class="grey-border">
                            <img class="zoomicon" src="<?php echo base_url() . 'asset/images/zoomicon.png'; ?>">
                            <ul id="imageGallery" class="gallery list-unstyled">

                                <?php
                                // echo '<li data-thumb="' . $path . '"><img src="' . $path . '" width="100%" alt="image of ' . $item->title . ' for sale"/></li>';
                                foreach ($allImages as $images) {

                                    if ($pack->package_id == $images->item_package_id) {


                                        $names = explode(',', $images->image);
                                        $max = sizeof($names);

                                        for ($i = 0; $i < $max; $i++) {
                                            $cl = rand(1, 1000000);

                                            echo '<li itemprop="image" data-thumb="' . base_url() . 'files/thumb/' . $names[$i] . '" ><a href="' . base_url() . 'files/items/' . $names[$i] . '" data-lightbox="' . $pack->title . ' "data-title=" ' . $pack->title . '"><img src="' . base_url() . 'files/gallery/' . $names[$i] . '" alt="image of ' . $pack->title . ' for sale"/></a> </li>';
                                            ?>

                                            <?php
                                        }
                                    }
                                }echo '</ul> ';
                                ?>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-7 col-md-7">
                    <div class="row">
                        <div class="margin-top-10">
                            <div class="col-xs-12">
                                <h4 itemprop="name" class="single-items-title"><?php echo $pack->title; ?></h4>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-8">

                                <ul class="single-item-seller-details">
                                    <li><label>Seller</label><span>
                                            <?php
                                            if (!empty($pack->company)) {
                                                echo $pack->company;
                                            } else {
                                                echo $pack->fname . ' ' . $pack->lname;
                                            }
                                            ?>
                                        </span></li>
                                    <?php
                                    date_default_timezone_set('Asia/Colombo');
                                    $expire = date('Y-m-d');

                                    if ($pack->shop_status == 1 && $pack->shop_expire > $expire) {
                                        ?>
                                        <li><label></label><span>
                                                <a class="btn btn-warning btn-xs" href="<?php echo base_url('shops/' . $pack->name_slug) ?>">Visit Shop</a>
                                            </span></li>
                                    <?php } ?>
                                    <li class="default_text"> Click to show Seller Details</li>
                                    <li class="hidephone"><label><i class="fa fa-mobile" aria-hidden="true"></i> Phone</label><span><?php echo $pack->mobile; ?></span></li>
                                    <li class="hidephone"><label><i class="fa fa-envelope-o" aria-hidden="true"></i> Email</label><span><a href="mailto:<?php echo $pack->email; ?>?Subject=Hello%20again" target="_top"><?php echo $pack->email; ?></a></span></li>
                                </ul>

                                <p class="single-location"><?php echo $pack->pro_name; ?>, <?php echo $pack->city_name; ?></p>


                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="margin-top-10">
                            <div class="col-md-12">

                                <!-- Go to www.addthis.com/dashboard to customize your tools -->
                                <div class="addthis_inline_share_toolbox"></div>
                                <div class="fb-like" data-href="<?php echo current_url(); ?>" data-layout="standard" data-action="like" data-size="large" data-show-faces="true" data-share="false"></div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>





            <div class="row">
                <div class="margin-top-10 float">
                    <div class="col-md-12">

                        <h4>Package Details</h4>



                        <ul class="single-pack-details">
                            <li><label>Party Type</label><span><?php echo $pack->package_for; ?></span></li>
                            <li><label>Theme</label><span><a target="_blank" href="<?php echo base_url('themes'); ?>"><?php echo $pack->theme; ?></a></span><span>
                                    <?php
                                    foreach ($themes as $theme) {
                                        if ($pack->theme == $theme->themename) {
                                            echo '<a href="' . base_url('files/themes/' . $theme->image) . '" data-lightbox="' . $pack->theme . ' "data-title=" ' . $pack->theme . '"><img class="custom-thumbnail" src="' . base_url('files/themes/' . $theme->image) . '" width="100" height="100"></a>';
                                        }
                                    }
                                    ?>


                                </span></li>


                        </ul>


                        <?php if ($pack->package_type == "Party-Packages") { ?>
                            <ul class="single-pack-details">
                                <li><label>Venue</label>

                                    <?php
                                    foreach ($allvenues as $venue) {
                                        if ($pack->venue == $venue->venue_id) {
                                            echo '<span><a target="_blank" href="' . base_url('venues') . '">' . $venue->title . '</a></span>';
                                            echo ' <span><a href="' . base_url('files/venues/' . $venue->image) . '" data-lightbox="' . $venue->title . ' "data-title=" ' . $venue->title . '"><img class="custom-thumbnail" src="' . base_url('files/venues/' . $venue->image) . '" width="100" height="100"></a></span>';
                                        }
                                    }
                                    if ($pack->venue == 'No Specific Venue') {
                                        echo '<span> No Specific Venue </span>';
                                    }
                                    ?>

                                </li>
                                <li><label>Party Duration</label><label class="min-max">Hours:</label><span class="min-max"><?php echo $pack->party_hours; ?></span> <label class="min-max">Minutes:</label><span class="min-max"><?php echo $pack->party_minutes; ?></span></li>
                                <li><label>No. of Children Allowed</label><label class="min-max">Minimum:</label><span class="min-max"><?php echo $pack->children_min; ?></span> <label class="min-max">Maximum:</label><span class="min-max"><?php echo $pack->children_max; ?></span></li>
                                <p>(For additional attendees, contact the seller)<p>
                                <li><label>No.of Adults Allowed</label><label class="min-max">Minimum:</label><span class="min-max"><?php echo $pack->adult_min; ?></span> <label class="min-max">Maximum:</label><span class="min-max"><?php echo $pack->adult_max; ?></span></li>
                                <p>(For additional attendees, contact the seller)<p>
                                <li><label>Children Age Limit</label><label class="min-max">Minimum:</label><span class="min-max"><?php echo $pack->child_age_min; ?></span> <label class="min-max">Maximum:</label><span class="min-max"><?php echo $pack->child_age_min; ?></span></li>
                                <li><label>Children Per Head Charge (Rs)</label><span><?php echo $pack->childern_per_head; ?></span></li>
                                <li><label>Adults Per Head Charge (Rs)</label><span><?php echo $pack->adult_per_head; ?></span></li>
                                <li><label>Package Price (Rs)</label><span><?php echo $pack->package_price; ?></span></li>
                            </ul>
                        <?php } else { ?>
                            <ul class="single-pack-details">
                                <li><label>Type of Food Package</label><span><?php echo $pack->type_food_package; ?></span></li>
                                <li><label>No. Persons Served</label><span><?php echo $pack->no_persons_served; ?></span></li>
                                <li><label>Waiters Provided</label><span><?php echo $pack->waiters_provided; ?></span></li>
                                <li><label>Per Head Charge (If applicable)(Rs)</label><span><?php echo $pack->food_per_head_charge; ?></span></li>
                                <li><label>Package Price (If applicable)(Rs)</label><span><?php echo $pack->food_package_price; ?></span></li>
                            </ul>


                            <br>
                            <h4 class="table-ware">Tableware</h4>
                            <br>

                            <ul class="single-pack-details">
                                <li><label>Plates</label><span><?php echo $pack->food_plates; ?></span></li>
                                <li><label>Cups</label><span><?php echo $pack->food_cups; ?></span></li>
                                <li><label>Straws</label><span><?php echo $pack->food_straws; ?></span></li>
                                <li><label>Cutlery</label><span><?php echo $pack->food_napkins; ?></span></li>
                                <li><label>Napkins</label><span><?php echo $pack->food_cutlery; ?></span></li>
                                <li><label>Chafing Dishes</label><span><?php echo $pack->food_chafing_dishes; ?></span></li>

                            </ul>

                        <?php } ?>


                        <ul class="single-pack-footer-details">
                            <li><label>Delivery/Transport Cost (Rs)</label><span><?php echo $pack->delivery_cost; ?></span></li>
                            <li><label>Service Charge %</label><span><?php echo $pack->service_charge; ?></span></li>
                            <li><label>Other Charges (Rs)</label><span><?php echo $pack->other_charges; ?></span></li>
                        </ul>

                        <h4>Description</h4>
                        <pre itemprop="description">
                            <?php echo $pack->description; ?>
                        </pre>




                        <br>
                        <h4>What's included in the package</h4>
                        <br>
                        <!--                    <div class="table-responsive">-->
                        <table class="table">
                            <thead>
                                <tr>
                                    <th> </th>
                                    <th> </th>
                                    <th>No of Items</th>
                                    <th>Notes</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($linkeditems as $item) { ?>


                                    <tr>
                                        <td class = "col-md-2"><a href = "<?php echo base_url('item/' . $item->slug); ?>"><img src = "<?php echo base_url('files/thumb/' . $item->image); ?>" width = "150" height = "100"></a></td>
                                        <td class = "col-md-3"><a href = "<?php echo base_url('item/' . $item->slug); ?>"><?php echo $item->title; ?></a></td>

                                        <td class="col-md-2"><?php echo $item->max_item_inc; ?></td>
                                        <td class="col-md-3"><?php echo $item->item_extra_note; ?></td>

                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                        </table>
                        <!--                    </div>-->
                    </div>

                </div>
            </div>

        </div>
        <!--  -- recent Slider --- -->
        <div class="row">

            <div class="col-md-12">


                <div class="well well-sm well-red home-well">
                    <p class="recent text-center">Related Packages </p>
                    <section class="related">
                        <?php
                        foreach ($relatedpack as $rpack) {
                            ?>

                            <div class="thumbnail">
                                <a href="<?php echo base_url() . 'package/' . $rpack->slug; ?>"> <img src="<?php echo base_url() . 'files/thumb/' . $rpack->image; ?>" alt="<?php echo $rpack->title; ?>"></a>
                                <h5 class="home-item-title" align="center"><a href="<?php echo base_url() . 'package/' . $rpack->slug; ?>"><?php echo $rpack->title; ?> </a></h5>
                            </div>

                            <?php
                        }
                        ?>
                    </section>



                </div>
            </div>

        </div>

        <?php
    }
    ?>


</div>


<script>
    $(document).ready(function() {
        $('#imageGallery').lightSlider({
            gallery: true,
            item: 1,
            loop: true,
            thumbItem: 9,
            slideMargin: 0,
            enableDrag: true,
            currentPagerPosition: 'left'

        });

        //        $(window).resize(function() {
        //
        //            ellipses1 = $("#bc1 :nth-child(2)");
        //            if ($("#bc1 a:hidden").length > 0) {
        //                ellipses1.show();
        //            } else {
        //                ellipses1.hide();
        //            }
        //
        //        });


        $('.hidephone').hide();
        $('.default_text').click(function() {
            $('.default_text').hide();
            $('.hidephone').show(200);
        });
    });
    $('.related').slick({
        dots: false,
        infinite: false,
        speed: 300,
        slidesToShow: 4,
        slidesToScroll: 4,
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3,
                    infinite: true,
                    dots: true
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
            // You can unslick at a given breakpoint now by adding:

            // settings: "unslick"

            // instead of a settings object

        ]

    });

</script>

<!-- Go to www.addthis.com/dashboard to customize your tools -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-592530fb7b649b5f"></script>

<div id="fb-root"></div>
<script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id))
            return;
        js = d.createElement(s);
        js.id = id;
        js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.9&appId=125427194666750";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>
