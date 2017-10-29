<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<style>
    #suggestions{
        position: relative;
        z-index: 10000;
    }

    #autoSuggestionsList > li {

        background: none repeat scroll 0 0 #F3F3F3;
        border-bottom: 1px solid #E3E3E3;
        list-style: none outside none;
        padding: 3px ;
        text-align: left;
        height: 48px;
        overflow: hidden;

    }

    #autoSuggestionsList > li a {  color: #1d80c2; height: 16px; overflow: hidden !important;}

    .auto_list {

        border: 1px solid #E3E3E3;
        border-radius: 5px 5px 5px 5px;
        position: absolute;
        width: 100%;

    }
    .search-img{
        width: 50px !important;
    }


</style>
<div class="top-header">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-md-12">
                <nav class="navbar navbar-default">
                    <div class="container-fluid">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>

                        </div>
                        <div class="collapse navbar-collapse" id="myNavbar">

                            <ul class="nav navbar-nav navbar-right">

                                <li class="nav-purple dropdown">
                                    <a id="select-dropdown" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">What's your party theme <span style="font-size: 15px; font-weight: 700;" id="popoverData" data-content="You can select your party theme and view the items belonging to that theme only.<br> You can clear the selected theme from any page to view all items" rel="popover" data-placement="bottom" data-original-title="What's your party theme" data-trigger="hover"> ? </span> <span class="caret"></span></a>
                                    <ul id="drop_menu" class="dropdown-menu" style="height: 300px; overflow: auto">
                                        <li class="theme" id="5000"><a class="selected" href="#">Non-Themed</a></li>
                                        <?php
                                        foreach ($themes as $theme) {
                                            ?>
                                            <li class="theme" id="<?php echo $theme->theme_id; ?>"><a class="selected" href="#"><?php echo $theme->themename; ?></a></li>
                                        <?php } ?>
                                        <li class="clear" id="x"><a href="#"><span class="fa fa-times"></span> Clear</a></li>
                                    </ul>
                                </li>

<!--                                <li class="nav-red"><a href="#"><span class="fa fa-lightbulb-o"> </span> Comparisons</a></li>-->
<!--                                <li class="nav-purple"><a href="#"><span class="fa fa-star"> </span> Favourites</a></li>-->
                                <?php if ($this->session->userdata('user_type') == "Seller") { ?>
                                    <li class="nav-blue"><a href="<?php echo base_url('dashboard'); ?>"><span class="fa fa-user"> </span> Dashboard</a></li>
                                    <li class="nav-red"><a href="<?php
                                        if ($this->session->userdata('login_type') == "facebook") {
                                            echo $this->facebook->logout_url();
                                        } else if ($this->session->userdata('login_type') == "google") {
                                            echo 'https://www.google.com/accounts/Logout?continue=https://appengine.google.com/_ah/logout?continue=' . base_url() . 'auth/glogout';
                                        } else {
                                            echo base_url() . 'auth/logout';
                                        }
                                        ?>"><span class="fa fa-sign-out"> </span> Logout</a></li>


                                <?php } else { ?>
                                    <li class="nav-blue"><a href="<?php echo base_url('login'); ?>"><span class="fa fa-sign-in"> </span> Seller Login</a></li>
                                <?php }
                                ?>
                                <li class="nav-green"><a href="<?php echo base_url('faq'); ?>"><span class="fa fa-comments"> </span> FAQ</a></li>
                                <li class="nav-yellow"><a href="<?php echo base_url('contact'); ?>"><span class="fa fa-envelope"> </span> Contact Us</a></li>
                            </ul>
                        </div>
                    </div>
                </nav><!-- /nav -->
            </div> <!-- /div -->
        </div> <!-- /row -->
    </div><!-- /container -->
</div> <!--<!-- /Header-->
<div class="header">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-4 col-md-3">

                <a href="<?php echo base_url(); ?>"><img class="main-logo" src="<?php echo base_url(); ?>asset/images/logo.png" alt="logo"></a>

            </div>

            <div class="col-xs-12 col-sm-8 col-md-9 search-top-margin">

                <!-- Live search  -->
                <div itemscope itemtype="http://schema.org/WebSite" class="serachbar">
                    <meta itemprop="url" content="https://www.birthdays.lk"/>
                    <form itemprop="potentialAction" itemscope itemtype="http://schema.org/SearchAction" action="<?php echo base_url('search'); ?>" method="post">
                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                        <meta itemprop="target" content="<?php echo base_url() ?>search?q={search_term}"/>
                        <div class="row">
                            <div class="col-xs-6 col-sm-3 col-md-3">
                                <select class="form-control" name="district" id="district">
                                    <option value="ALL">All Districts</option>
                                    <?php
                                    foreach ($allprovinces as $province) {

                                        if (get_cookie('search_district') == $province->id) {

                                            echo '<option selected="selected" value="' . $province->id . '">' . $province->pro_name . '</option>';
                                        } else {

                                            echo '<option value="' . $province->id . '">' . $province->pro_name . '</option>';
                                        }
                                    }
                                    ?>
                                </select>

                            </div>
                            <div class="col-xs-6 col-sm-3 col-md-3">

                                <select class="form-control" name="theme" id="theme">
                                    <option value="ALL">All Themes</option>
                                    <option value="Non-Themed" <?php
                                    if (get_cookie('search_theme') == "Non-Themed") {

                                        echo set_select('theme', 'Non-Themed');
                                        echo "selected=selected";
                                    }
                                    ?>>Non-Themed</option>
                                            <?php
                                            foreach ($themes as $theme) {
                                                if (get_cookie('search_theme') == $theme->themename) {

                                                    echo '<option selected="selected" value="' . $theme->themename . '">' . $theme->themename . '</option>';
                                                } else {

                                                    echo '<option value="' . $theme->themename . '">' . $theme->themename . '</option>';
                                                }
                                            }
                                            ?>
                                </select>

                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-6">
                                <input required="required" itemprop="query-input" type="text" id="search_data" class="form-control search-input" name="search_term" placeholder="What are you looking for?" onkeyup="liveSearch()" autocomplete="off" value="<?php
                                echo get_cookie('search_data');
                                ?>">
                                <div id="suggestions">
                                    <div id="autoSuggestionsList">

                                    </div>
                                </div>
                            </div>

                        </div>
                        <button type="submit" id="search_btn" class="left-searchbtn"><i class="fa fa-search" style="color: #048CCE;"></i></button>

                    </form>
                </div>


                <!--End of Live Search-->
            </div>

        </div><!-- /row -->

    </div><!-- /container -->
</div><!-- /Header-->

<script>
    $(".theme").click(function() {
        $('.theme').hide();
        $(this).show();
        var value = $(this).attr('id');
        var themevalue = $(this).children('.selected').text();
        $('#select-dropdown').html(themevalue + ' <span class="caret"></span>');
        $(this).addClass('theme-selected');
        Cookies.set('themeselected', value);
        Cookies.set('themevalue', themevalue);
        $('#x').show();
        $('#drop_menu').css("height", 100);
        location.reload();

    });
    $(document).ready(function() {
        $('#popoverData').popover({html: true, container: 'body'});

        if (typeof Cookies.get('themeselected') === 'undefined') {
            $('#x').hide();
        } else {
            $('#drop_menu').css("height", 100);
            $('#x').show();
            $('.theme').hide();
            $(this).addClass('theme-selected');

            var selected = Cookies.get('themeselected');
            var themevalue = Cookies.get('themevalue');
            $('#select-dropdown').html(themevalue + ' <span class="caret"></span>');
            $('#' + selected).show();
            $('#' + selected).addClass('theme-selected');
        }
    });

    $('#x').click(function() {
        $('.theme').show();
        $('#x').hide();
        $('#drop_menu').css("height", 300);
        var selected = Cookies.get('themeselected');
        $('#' + selected).removeClass('theme-selected');
        $('#select-dropdown').html('What\'s your party theme <span style="font-size: 15px; font-weight: 700; ">?</span> <span class="caret"></span>');
        Cookies.remove('themeselected');
        Cookies.remove('themevalue');
        location.reload();
    });
</script>
<script>

    function liveSearch() {

        var input_data = $('#search_data').val();
        var district = $('#district').val();
        var theme = $('#theme').val();
        if (input_data.length === 0) {
            $('#suggestions').hide();
        } else {
            $.ajax({
                type: "POST",
                cache: false,
                url: "<?php echo base_url(); ?>home/liveSearch",
                data: {'search_data': input_data, 'district': district, 'theme': theme, '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'},
                success: function(data) {

                    // return success
                    if (data.length > 0) {
                        $('#suggestions').show();
                        $('#autoSuggestionsList').addClass('auto_list');
                        $('#autoSuggestionsList').html(data);
                    }
                }
            });
        }
    }
    $(document).ready(function() {
        $('#search_btn').click(function() {
            var search_data = $('#search_data').val();
            var district = $('#district').val();
            var theme = $('#theme').val();
            Cookies.set('search_district', district);
            Cookies.set('search_theme', theme);
            Cookies.set('search_data', search_data);
        });
    });
</script>

