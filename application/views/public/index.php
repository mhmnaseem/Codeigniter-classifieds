<div class="container">
    <!--   --- Home Nav ---  -->
    <div class="home-nav">
        <div class="row">
            <div class="margin-top-10 no-bottom-margin">
                <div class="col-xs-12 col-sm-9 col-md-9">

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

                                    <li class="dropdown menu-large mega-mu-li">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span>All Categories</span></a>
                                        <ul class="dropdown-menu megamenu row">
                                            <li class="col-sm-4">
                                                <h4 style="color:#000;padding-left: 20px;">Party Items</h4>
                                                <ul>
                                                    <li><a href="<?php echo base_url('category/printing'); ?>" class="nav-child">Printing</a></li>
                                                    <li><a href="<?php echo base_url('category/party-favours'); ?>">Party Favours</a></li>
                                                    <li><a href="<?php echo base_url('category/tableware'); ?>">Tableware</a></li>
                                                    <li><a href="<?php echo base_url('category/wearables'); ?>">Wearables</a></li>
                                                    <li><a href="<?php echo base_url('category/decorations'); ?>">Decorations</a></li>
                                                    <li><a href="<?php echo base_url('category/balloons'); ?>">Balloons</a></li>
                                                    <li><a href="<?php echo base_url('category/party-furniture'); ?>">Party Furniture</a></li>
                                                </ul>
                                                <br>
                                                <h4 style="color:#000;padding-left: 20px;">Packages</h4>
                                                <ul>
                                                    <li><a href="<?php echo base_url('party-packages'); ?>" class="nav-child">Party Packages</a></li>
                                                    <li><a href="<?php echo base_url('food-packages'); ?>" class="nav-child">Food Packages</a></li>

                                                </ul>




                                            </li>
                                            <li class="col-sm-4">
                                                <h4 style="color:#000;padding-left: 20px;">Games, Activities & Services</h4>
                                                <ul>
                                                    <li><a href="<?php echo base_url('category/play-areas-entertainment'); ?>" class="nav-child">Play Areas & Entertaintment</a></li>
                                                    <li><a href="<?php echo base_url('category/games-group-activities'); ?>">Games & Group Activities</a></li>
                                                    <li><a href="<?php echo base_url('category/professional-services'); ?>">Professional Services</a></li>
                                                </ul>
                                                <h4 style="color:#000; padding-left: 20px;">Party Venues</h4>
                                                <ul>
                                                    <li><a href="<?php echo base_url('venues'); ?>" class="nav-child">Party Venues</a></li>

                                                </ul>


                                            </li>
                                            <li class="col-sm-4">
                                                <h4 style="color:#000; padding-left: 20px;">Foods</h4>
                                                <ul>

                                                    <li><a href="<?php echo base_url('category/birthday-cakes'); ?>" class="nav-child">Birthday Cakes</a></li>
                                                    <li><a href="<?php echo base_url('category/party-food'); ?>">Party Food</a></li>
                                                    <li><a href="<?php echo base_url('category/party-snacks'); ?>">Party Snacks</a></li>

                                                    <br>
                                                    <br>
                                                    <br>

                                                </ul>





                                            </li>


                                        </ul>
                                    </li>

                                    <li class="mega-mu-li"><a href="<?php echo base_url('party-items'); ?>">Party Items</a></li>
                                    <li class="mega-mu-li"><a href="<?php echo base_url('foods'); ?>">Foods</a></li>
                                    <li class="mega-mu-li"><a href="<?php echo base_url('games-activities-services'); ?>">Activities & Services</a></li>
                                    <li class="mega-mu-li"><a href="<?php echo base_url('party-packages'); ?>">Packages</a></li>
                                    <li class="mega-mu-li"><a href="<?php echo base_url('venues'); ?>">Venues</a></li>
                                    <li class="mega-mu-li"><a class="themes-with-font" href="<?php echo base_url('themes'); ?>">Themes</a></li>


                                </ul>
                            </div>
                        </div>
                    </nav><!-- /nav -->
                </div>

                <div class="col-xs-12 col-sm-3 col-md-3 xs-padding">
    <!--                <p class="text-center">Got Something To Sell</p>-->
                    <a href="<?php echo base_url('post-item') ?>" class="btn btn-default btn-lg btn-block">POST ITEM FOR FREE</a>
                </div>
            </div>
        </div>
    </div>
    <!--  -- /Home Nav --- -->
    <!--  -- Slider --- -->
    <div class="row">
        <div class="col-md-12">
            <div class="margin-top-10 no-bottom-margin">
                <ul class="bxslider">
                    <?php
                    foreach ($allslides as $slide) {
                        ?>

                        <li><a href="<?php echo $slide->link; ?>"><img src="<?php echo base_url() ?>files/slider/<?php echo $slide->slider_img; ?>" /></a>


                        <?php } ?>
                </ul>
            </div>
        </div>
    </div>
    <!--  -- /Slider --- -->
    <!--  -- Services --- -->
    <h4 class="text-center" style="margin: 20px 0px">Popular Items</h4>
    <div class="row home-thumbnail">


        <div class="col-sm-3 col-md-3 text-center">
            <div class="margin-top-30">
                <a href="<?php echo base_url('party-items'); ?>"><img class="home-nav-img" src="<?php echo base_url(); ?>asset/images/mask.png" height="150" width="150" alt="party-items"/></a>
                <h5 class="text-center services-title"><a style="font-size: 15px; font-weight: 700; color: #ffc61b;" href="<?php echo base_url('party-items'); ?>">Party Items (<?php echo $totalpartyitems; ?>)</a></h5>
            </div>
        </div>
        <div class="col-sm-3 col-md-3 text-center">
            <div class="margin-top-30">
                <a href="<?php echo base_url('category/balloons'); ?>"><img class="home-nav-img" src="<?php echo base_url(); ?>asset/images/balloons.png" height="150" width="150" alt="balloons"/></a>
                <h5 class="text-center services-title"><a style="font-size: 15px; font-weight: 700; color: #5ab1c5;" href="<?php echo base_url('category/balloons'); ?>">Balloons (<?php echo $totalballoons; ?>)</a></h5>
            </div>
        </div>
        <div class="col-sm-3 col-md-3 text-center">
            <div class="margin-top-30">
                <a href="<?php echo base_url('category/birthday-cakes'); ?>"><img class="home-nav-img" src="<?php echo base_url(); ?>asset/images/food.png"  height="150" width="150" alt="Birthday Cakes"/></a>
                <h5 class="text-center services-title"><a style="font-size: 15px; font-weight: 700; color: #9c91ac;" href="<?php echo base_url('category/birthday-cakes'); ?>">Birthday Cakes (<?php echo $totalbirthdaycakes; ?>)</a></h5>
            </div>
        </div>
        <div class="col-sm-3 col-md-3 text-center">
            <div class="margin-top-30">
                <a href="<?php echo base_url('foods'); ?>"><img class="home-nav-img" src="<?php echo base_url(); ?>asset/images/pizza.png" height="150" width="150" alt="Foods" /></a>
                <h5 class="text-center services-title"><a style="font-size: 15px; font-weight: 700; color: #b3404a;" href="<?php echo base_url('foods'); ?>">Foods (<?php echo $totalfoods; ?>)</a></h5>
            </div>
        </div>
        <div class="col-sm-3 col-md-3 text-center">
            <div class="margin-top-30">
                <a href="<?php echo base_url('category/decorations'); ?>"><img class="home-nav-img" src="<?php echo base_url(); ?>asset/images/garlands.png" height="150" width="150" alt="decorations"/></a>
                <h5 class="text-center services-title"><a style="font-size: 15px; font-weight: 700; color: #adc57f;" href="<?php echo base_url('category/decorations'); ?>">Decorations (<?php echo $totaldecorations; ?>)</a></h5>
            </div>
        </div>
        <div class="col-sm-3 col-md-3 text-center">
            <div class="margin-top-30">
                <a href="<?php echo base_url('games-activities-services'); ?>"><img class="home-nav-img" src="<?php echo base_url(); ?>asset/images/clown.png" height="150" width="150" alt="Games, Activities & Services"/></a>
                <h5 class="text-center services-title"><a style="font-size: 15px; font-weight: 700; color: #c65e59;" href="<?php echo base_url('games-activities-services'); ?>">Games, Activities & Services (<?php echo $totalgames; ?>)</a></h5>
            </div>
        </div>
        <div class="col-sm-3 col-md-3 text-center">
            <div class="margin-top-30">
                <a href="<?php echo base_url('subcategory/photographer'); ?>"><img class="home-nav-img" src="<?php echo base_url(); ?>asset/images/photo-camera.png" height="150" width="150" alt="photographer"/></a>
                <h5 class="text-center services-title"><a style="font-size: 15px; font-weight: 700; color: #ffc61b;" href="<?php echo base_url('subcategory/photographer'); ?>">Photographers (<?php echo $totalphotograpy; ?>)</a></h5>
            </div>
        </div>
        <div class="col-sm-3 col-md-3 text-center">
            <div class="margin-top-30">
                <a class="" href="<?php echo base_url('venues'); ?>"><img class="home-nav-img" src="<?php echo base_url(); ?>asset/images/hut.png" height="150" width="150"  alt="Party Venues"/></a>
                <h5 class="text-center services-title"><a style="font-size: 15px; font-weight: 700; color: #adc57f;" href="<?php echo base_url('venues'); ?>">Party Venues (<?php echo $totalvenues; ?>)</a></h5>
            </div>
        </div>
        <div class="col-sm-3 col-sm-push-3 col-md-3 col-md-push-3 text-center">
            <div class="margin-top-30">
                <a href="<?php echo base_url('party-packages'); ?>"><img class="home-nav-img" src="<?php echo base_url(); ?>asset/images/puzzle.png" height="150" width="150" alt="Party Packages"/></a>
                <h5 class="text-center services-title"><a style="font-size: 15px; font-weight: 700; color: #4cdbc4;" href="<?php echo base_url('party-packages'); ?>">Party Packages (<?php echo $totalparty; ?>)</a></h5>
            </div>
        </div>
        <div class="col-sm-3 col-sm-push-3 col-md-3 col-md-push-3 text-center">
            <div class="margin-top-30">
                <a href="<?php echo base_url('food-packages'); ?>"><img class="home-nav-img" src="<?php echo base_url(); ?>asset/images/catering.png" height="150" width="150" alt="Food Packages"/></a>
                <h5 class="text-center services-title"><a style="font-size: 15px; font-weight: 700; color: #fda162;" href="<?php echo base_url('food-packages'); ?>">Food Packages (<?php echo $totalfood; ?>)</a></h5>
            </div>
        </div>

    </div>
    <!--  -- /Services --- -->




    <!--  -- recent Slider --- -->
    <div class="row">

        <div class="col-md-12">


            <div class="well well-sm well-red home-well">
                <p class="recent text-center">What's New </p>
                <section class = "recent-items">
                    <?php
                    foreach ($allitems as $item) {
                        ?>

                        <div class="thumbnail">
                            <a href="<?php echo base_url() . 'item/' . $item->slug; ?>"> <img src="<?php echo base_url() . 'files/thumb/' . $item->image; ?>" alt="<?php echo $item->title; ?>"></a>
                            <h5 class="home-item-title" align="center"><a href="<?php echo base_url() . 'item/' . $item->slug; ?>"><?php echo $item->title; ?> </a></h5>
                        </div>

                        <?php
                    }
                    ?>
                </section>



            </div>
        </div>

    </div>
    <!--  -- /whats new Slider --- -->

</div>




<script>
    $(document).ready(function() {
        $('.bxslider').bxSlider();
    });
</script>

<script>
    $(document).ready(function() {

        $(".mega-mu-li").hover(function() {
            $(this).addClass('mega-hover');
        }, function() {
            $(this).removeClass('mega-hover');
        });
    });
    $('.recent-items').slick({
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
