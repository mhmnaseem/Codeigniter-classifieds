<div class="container">
    <!--    breadcrumb   -->
    <div class="row">
        <div class="margin-top-10 float">
            <div class="col-xs-12 col-sm-4 col-md-4">
                <div id="bc1" class="btn-group btn-breadcrumb">
                    <a href="<?php echo base_url(); ?>" class="btn btn-default"><i class="fa fa-home"></i></a>
                    <a href="#" class="btn btn-default"><div>Search Result</div></a>
                </div>
            </div>
            <div class="col-xs-12 col-sm-4 col-md-4">

                <h4 class="search-head-text">Found <?php echo $found; ?> Search results for: <?php echo $search_term; ?></h4>


            </div>
            <div class="col-xs-12 col-sm-4 col-md-4">

                <?php echo $pages; ?>
            </div>
        </div>
    </div>
    <!--   / breadcrumb   -->

</div>

<div class="container">


    <?php foreach ($result as $item) { ?>
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
                                            <li><label>Purchase Price</label><span>Rs <?php echo $item->pprice; ?></span></li>
                                            <li><label>Rental Price</label><span>Rs <?php echo $item->rprice; ?></span></li>
                                        </ul>
                                        <?php if ($item->package == "yes") { ?>
                                            <p> Also Offered as a package Item  </p>
                                        <?php } ?>


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

