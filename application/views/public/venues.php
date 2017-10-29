<div class="container">
    <!--    <div class="margin-top-10 no-bottom-margin">
            <div id="bc1" class="btn-group btn-breadcrumb">
                <a href="<?php //echo base_url();                                                                                                                                                                                                                                   ?>" class="btn btn-default"><i class="fa fa-home"></i></a>
                <a href="#" class="btn btn-default"><div>Party Items</div></a>
            </div>
        </div>-->

    <!--   --- venues Nav ---  -->
    <div class="venues-nav">
        <div class="row">
            <div class="margin-top-10 no-bottom-margin">
                <div class="col-md-12">

                    <img class="img-responsive" src="<?php echo base_url(); ?>asset/images/venues_header.jpg" />

                </div>
            </div>
        </div>
        <!--   breadcrumb   -->
        <div class="row venues-nav">
            <div class="margin-top-10 float">
                <div class="col-xs-12 col-sm-6 col-md-6">
                    <div id="bc1" class="btn-group btn-breadcrumb">
                        <a href="<?php echo base_url(); ?>" class="btn btn-default"><i class="fa fa-home"></i></a>
                        <a href="#" class="btn btn-default"><div>Venues</div></a>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6">
                    <?php echo $pages; ?>
                </div>
            </div>
        </div>
        <!--   / breadcrumb   -->

    </div>
    <!--  -- /venues Nav --- -->

</div>

<!-- --- Products Listings --- -->


<div class="container">


    <?php foreach ($allvenues as $venue) { ?>
        <div class="list-view float">

            <div class="col-xs-12">
                <div class="row">
                    <div class="col-xs-12 col-sm-3 list-thumb">
                        <div class="row">
                            <img src="<?php echo base_url() . 'files/venues/' . $venue->image ?>"/>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-9 list-content">
                        <div class="row">
                            <div class="col-xs-12">
                                <h4 class="list-item-title"><?php echo $venue->title; ?></h4>
                            </div>
                            <div class="col-xs-12">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <ul class="list-item-details">

                                            <li><label>Address</label><span><?php echo $venue->address; ?></span></li>
                                            <li><label>Telephone</label><span><?php echo $venue->telephone; ?></span></li>
                                            <li><label>Email</label><span><a href="mailto:<?php echo $venue->email; ?>" target="_blank"><?php echo $venue->email; ?></a></span></li>
                                            <li><label>Web</label><span><a target="_blank" href="<?php echo $venue->web; ?>"><?php echo $venue->web; ?></a></span></li>
                                        </ul>


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