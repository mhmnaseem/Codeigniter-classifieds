<div class="container single-item">

    <?php
    foreach ($singleitem as $item) {
        ?>
        <div class="margin-top-10 no-bottom-margin">
            <div id="bc1" class="btn-group btn-breadcrumb">
                <a href="<?php echo base_url(); ?>" class="btn btn-default"><i class="fa fa-home"></i></a>

                <?php
                $parentCat = "";
                $parentSlug = "";
                foreach ($pcatandsubcat as $pcat) {
                    if ($item->category == $pcat->id) {
                        $parentCat = $pcat->parentname;
                        $parentSlug = $pcat->maincatslug;
                    }
                }
                ?>
                <?php
                $subCatName = "";
                $subCatSlug = "";
                foreach ($allscats as $scat) {
                    if ($scat->id == $item->category) {
                        $subCatName = $scat->name;
                        $subCatSlug = $scat->slug;
                    }
                }
                ?>
                <a href="<?php echo base_url() . 'category/' . $parentSlug; ?>" class="btn btn-default"><div><?php echo $parentCat; ?></div></a>
                <a href="<?php echo base_url() . 'subcategory/' . $subCatSlug; ?>" class="btn btn-default"><div><?php echo $subCatName; ?></div></a>


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

                                    if ($item->item_id == $images->item_id) {


                                        $names = explode(',', $images->image);
                                        $max = sizeof($names);

                                        for ($i = 0; $i < $max; $i++) {
                                            $cl = rand(1, 1000000);

                                            echo ' <li itemprop="image" data-thumb="' . base_url() . 'files/thumb/' . $names[$i] . '" ><a href="' . base_url() . 'files/items/' . $names[$i] . '" data-lightbox="' . $item->title . ' "data-title=" ' . $item->title . '"><img src="' . base_url() . 'files/gallery/' . $names[$i] . '" alt="' . $item->title . '"/></a> </li>';
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
                                <h4 itemprop="name" class="single-items-title"><?php echo $item->title; ?></h4>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <ul class="single-item-details">
                                    <li><label>Theme</label><span><?php echo $item->theme; ?></span></li>
                                    <li><label>Purchase Price</label><span><?php echo!empty($item->pprice) ? 'Rs ' . $item->pprice : 'N/A'; ?></span></li>
                                    <li><label>Rental Price</label><span><?php echo!empty($item->rprice) ? 'Rs ' . $item->rprice : 'N/A'; ?></span></li>
                                </ul>
                                <?php if ($item->package == "yes") { ?>
                                    Also Offered as a package Item <br><a href="#" data-toggle="modal" data-target="#myModal"><strong> <i class="fa fa-hand-o-right" aria-hidden="true"></i> Click Here for Details</strong></a>
                                <?php } ?>
                                <br>
                                <br>
                                <p class="single-location"><?php echo $item->pro_name; ?>, <?php echo $item->city_name; ?></p>
                                <br>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="well well-sm">


                                    <ul class="single-item-seller-details">
                                        <li><label>Seller</label><span>
                                                <?php
                                                if (!empty($item->company)) {
                                                    echo $item->company;
                                                } else {
                                                    echo $item->fname . ' ' . $item->lname;
                                                }
                                                ?>
                                            </span></li>

                                        <?php
                                        date_default_timezone_set('Asia/Colombo');
                                        $expire = date('Y-m-d');

                                        if ($item->shop_status == 1 && $item->shop_expire > $expire) {
                                            ?>
                                            <li><label></label><span>
                                                    <a class="btn btn-warning btn-xs" href="<?php echo base_url('shops/' . $item->name_slug) ?>">Visit Shop</a>
                                                </span></li>
                                        <?php } ?>
                                        <li class="default_text">Click to show Seller Details</li>
                                        <li class="hidephone"><label><i class="fa fa-mobile" aria-hidden="true"></i> Phone</label><span><?php echo $item->mobile; ?></span></li>
                                        <li class="hidephone"><label><i class="fa fa-envelope-o" aria-hidden="true"></i> Email</label><span><a href="mailto:<?php echo $item->email; ?>?Subject=Hello%20again" target="_top"><?php echo $item->email; ?></a></span></li>
                                    </ul>

                                </div>
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
                        <pre itemprop="description">
                            <?php echo $item->description; ?>
                        </pre>

                    </div>

                </div>
            </div>


        </div>

        <!--  -- recent Slider --- -->
        <div class="row">

            <div class="col-md-12">


                <div class="well well-sm well-red home-well">
                    <p class="recent text-center">Related Items </p>
                    <section class="related">
                        <?php
                        foreach ($relateditems as $ritem) {
                            ?>

                            <div class="thumbnail">
                                <a href="<?php echo base_url() . 'item/' . $ritem->item_slug; ?>"> <img src="<?php echo base_url() . 'files/thumb/' . $ritem->image; ?>" alt="<?php echo $ritem->title; ?>"></a>
                                <h5 class="home-item-title" align="center"><a href="<?php echo base_url() . 'item/' . $ritem->item_slug; ?>"><?php echo $ritem->title; ?> </a></h5>
                            </div>

                            <?php
                        }
                        ?>
                    </section>



                </div>
            </div>

        </div>


        <!-- Modal -->
        <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Packages Offered with <?php echo $item->title; ?></h4>
                    </div>
                    <div class="modal-body">

                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Title</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($linkedpackages as $pack) { ?>


                                    <tr>
                                        <td class = "col-md-4"><a href = "<?php echo base_url('package/' . $pack->slug); ?>"><img src = "<?php echo base_url('files/items/' . $pack->image); ?>" width = "150" height = "100"></a></td>
                                        <td class = "col-md-8"><a href = "<?php echo base_url('package/' . $pack->slug); ?>"><?php echo $pack->title; ?></a></td>

                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                        </table>




                    </div>

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
    }(document, 'script', 'facebook-jssdk'));
</script>
