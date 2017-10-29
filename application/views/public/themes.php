<div class="container">
    <!--    breadcrumb   -->
    <div class="row">
        <div class="margin-top-10 float">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div id="bc1" class="btn-group btn-breadcrumb">
                    <a href="<?php echo base_url(); ?>" class="btn btn-default"><i class="fa fa-home"></i></a>
                    <a href="#" class="btn btn-default"><div>Themes</div></a>
                </div>
            </div>

        </div>
    </div>
    <!--   / breadcrumb   -->
    <div class="row">
        <div class="margin-top-10 float">

            <div class="col-md-12">
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#Popular">Popular Themes</a></li>
                    <li><a data-toggle="tab" href="#All">All Themes</a></li>

                </ul>

                <div class="tab-content">
                    <div id="Popular" class="tab-pane fade in active">
                        <div class="row">
                            <?php
                            foreach ($popthemes as $poptheme) {
                                ?>

                                <div class="col-xs-12 col-sm-6 col-md-4">
                                    <div class="thumbnail text-center">
                                        <h4 class="theme-title"><?php echo $poptheme->themename; ?></h4>
                                        <div class="image">
                                            <figure><img class="themethumb"  id="#theme_<?php echo $poptheme->theme_id; ?>" src="<?php echo base_url() . 'files/themes/' . $poptheme->image ?>" alt="<?php echo $poptheme->themename; ?>"/></figure>

                                        </div>
                                    </div>
                                </div>



                                <?php
                            }
                            ?>
                        </div>

                    </div>
                    <div id="All" class="tab-pane fade">
                        <?php
                        foreach ($allthemes as $alltheme) {
                            ?>

                            <div class="col-xs-12 col-sm-4 col-md-3">
                                <div class="thumbnail text-center">
                                    <h4 class="theme-title"><?php echo $alltheme->themename; ?></h4>
                                    <div class="image">
                                        <figure><img class="themethumb"  id="#theme_<?php echo $alltheme->theme_id; ?>" src="<?php echo base_url() . 'files/themes/' . $alltheme->image ?>" alt="<?php echo $alltheme->themename; ?>"/></figure>

                                    </div>
                                </div>
                            </div>



                            <?php
                        }
                        ?>
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>
<script>
    $(".themethumb").click(function() {

        var value = $(this).attr("id");
        var selctedid = value.substring(value.indexOf('_') + 1);
        var themevalue = $(this).attr("alt");

        $('#select-dropdown').html(themevalue + ' <span class="caret"></span>');
        $(this).addClass('theme-selected');
        Cookies.set('themeselected', selctedid);
        Cookies.set('themevalue', themevalue);
        $('#x').show();
        window.location.replace('<?php echo base_url('party-items') ?>');

    });

</script>
