<div class="container">

    <!--   --- party Nav ---  -->
    <div class="shop-nav">
        <div class="row">
            <div class="margin-top-10 no-bottom-margin">
                <div class="col-md-12">
                    <?php if (empty($cover_image)) { ?>
                        <img class="img-responsive" src="<?php echo base_url(); ?>asset/images/default_shop_background.jpg" />
                    <?php } else { ?>
                        <img class="img-responsive" src="<?php echo base_url() . 'files/shops/' . $cover_image; ?>" />
                    <?php } ?>
                </div>
            </div>
        </div>

    </div>
    <h3 class="shop-head"><?php echo $name; ?></h3>
    <div class="row">
        <div class="col-xs-12 col-sm-7 col-md-8">
            <div class="margin-top-10 no-bottom-margin">
                <pre><?php echo $over_view; ?></pre>
            </div>
        </div>
        <div class="col-xs-12 col-sm-5 col-md-4">
            <?php
            extract($times);

            if ($id == $this->session->userdata('user_id')) {
                ?>
                <a class="btn btn-warning btn-sm" href="<?php echo base_url('shop-analytics'); ?>"><i class="fa fa-line-chart" aria-hidden="true"></i> View Shop Analytics Here</a>
            <?php } ?>
            <div class="shop-info">
                <?php
                if ($monstart > 0 || $tuestart > 0 || $wedstart > 0 || $thustart > 0 || $fristart > 0 || $satstart > 0 || $sunstart > 0) {
                    ?>
                    <div class="shop-address">
                        <div class="icon">
                            <i class="fa fa-clock-o fa-2x" aria-hidden="true"></i>
                        </div>
                        <div class="text">
                            <p><?php
                                $storeSchedule = [
                                    'Mon' => ["$monstart" => "$monclose"],
                                    'Tue' => ["$tuestart" => "$tueclose"],
                                    'Wed' => ["$wedstart" => "$wedclose"],
                                    'Thu' => ["$thustart" => "$thuclose"],
                                    'Fri' => ["$fristart" => "$friclose"],
                                    'Sat' => ["$satstart" => "$satclose"],
                                    'Sun' => ["$sunstart" => "$sunclose"]
                                ];

                                // default time zone
                                date_default_timezone_set('Asia/Colombo');
                                $timeObject = new DateTime();
                                $timestamp = $timeObject->getTimeStamp();
                                // default status
                                $status = '<span class="storeclose">Closed now</span>';

                                // loop through time ranges for current day
                                foreach ($storeSchedule[date('D', $timestamp)] as $startTime => $endTime) {

                                    // create time objects from start/end times
                                    $startTime = strtotime($startTime);
                                    $endTime = strtotime($endTime);

                                    // check if current time is within a range
                                    if ($startTime <= $timestamp && $timestamp <= $endTime) {

                                        $status = '<span class="storeopen">Open now</span>';
                                    }
                                }

                                echo "<p><strong> $status </strong></p>";


                                //Monday
                                echo '<span class="day">Mon</span> - ';
                                echo($monstart > 0) ? date('h:i A', strtotime($monstart)) : "Close";
                                echo ($monclose > 0) ? ' - ' . date('h:i A', strtotime($monclose)) : "";
                                echo "<br>";
                                //tuesday
                                echo '<span class="day">Tue</span> - ';
                                echo($tuestart > 0) ? date('h:i A', strtotime($tuestart)) : "Close";
                                echo ($tueclose > 0) ? ' - ' . date('h:i A', strtotime($tueclose)) : "";
                                echo "<br>";
                                //wednesday
                                echo '<span class="day">Wed</span> - ';
                                echo($wedstart > 0 ) ? date('h:i A', strtotime($wedstart)) : "Close";
                                echo ($wedclose > 0) ? ' - ' . date('h:i A', strtotime($wedclose)) : "";
                                echo "<br>";

                                //thursday
                                echo '<span class="day">Thu</span> - ';
                                echo($thustart > 0) ? date('h:i A', strtotime($thustart)) : "Close";
                                echo ($thuclose > 0) ? ' - ' . date('h:i A', strtotime($thuclose)) : "";
                                echo "<br>";

                                //friday
                                echo '<span class="day">Fri</span> - ';
                                echo($fristart > 0) ? date('h:i A', strtotime($fristart)) : "Close";
                                echo ($friclose > 0) ? ' - ' . date('h:i A', strtotime($friclose)) : "";
                                echo "<br>";

                                //saturday
                                echo '<span class="day">Sat</span> - ';
                                echo($satstart > 0) ? date('h:i A', strtotime($satstart)) : "Close";
                                echo ($satclose > 0) ? ' - ' . date('h:i A', strtotime($satclose)) : "";
                                echo "<br>";

                                //sunday
                                echo '<span class="day">Sun</span> - ';
                                echo($sunstart > 0) ? date('h:i A', strtotime($sunstart)) : "Close";
                                echo ($sunclose > 0) ? ' - ' . date('h:i A', strtotime($sunclose)) : "";
                                echo "<br>";
                                ?></p>
                        </div>

                    </div>
                <?php } ?>
                <?php if (!empty($address)) { ?>
                    <div class="shop-address">
                        <div class="icon">
                            <i class="fa fa-map-marker fa-2x" aria-hidden="true"></i>
                        </div>
                        <div class="text">
                            <p><?php echo $address; ?></p>
                        </div>

                    </div>
                <?php } ?>
                <?php if (!empty($mobile)) { ?>
                    <div class="shop-contact">
                        <div class="icon">
                            <i class="fa fa-mobile fa-2x" aria-hidden="true"></i>
                        </div>
                        <div class="text">
                            <p id="default_text">Click to Show Phone Number</p>
                            <p id="hidephone"><?php echo $mobile ?></p>
                        </div>

                    </div>
                <?php } ?>
                <div class="shop-contact">
                    <div class="icon">
                        <i class="fa fa-envelope fa-2x" aria-hidden="true"></i>
                    </div>
                    <div class="text">
                        <p><strong><a href="#"data-toggle="modal" data-target="#myModal" >Send Email</a></strong></p>
                    </div>
                    <div id="infoMessage" class="alert-info"><?php echo $this->session->flashdata('message'); ?></div>
                </div>

            </div>

            <br>
            <!-- Go to www.addthis.com/dashboard to customize your tools -->
            <div class="addthis_inline_share_toolbox"></div>
        </div>
    </div>
    <!--  -- /Seller shop --- -->
    <?php if (!empty($items)) { ?>
        <h4 class="shop-items"><?php //echo $name;    ?> Our Items</h4>
    <?php } ?>
    <div class="row">
        <div class="margin-top-10 float">
            <div class="col-xs-12 col-sm-6 col-sm-push-6 col-md-6 col-md-push-6">

                <?php echo $pages; ?>
            </div>
        </div>
    </div>
    <div class="row">
        <?php
        foreach ($items as $item) {
            ?>
            <div class="col-xs-12 col-sm-3 col-md-3">
                <div class="thumbnail">
                    <a href="<?php echo base_url() . 'item/' . $item->slug; ?>"> <img src="<?php echo base_url() . 'files/thumb/' . $item->profile_img; ?>" alt="<?php echo $item->title; ?>"></a>
                    <h5 class="home-item-title" align="center"><a href="<?php echo base_url() . 'item/' . $item->slug; ?>"><?php echo $item->title; ?> </a></h5>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-6 col-sm-push-6 col-md-6 col-md-push-6">

            <?php echo $pages; ?>
        </div>
    </div>
    <?php if (!empty($packages)) { ?>
        <h4 class="shop-packages"><?php //echo $name;    ?> Our Packages</h4>
    <?php } ?>
    <div class="row">
        <?php
        foreach ($packages as $pack) {
            ?>
            <div class="col-xs-12 col-sm-3 col-md-3">
                <div class="thumbnail">
                    <a href="<?php echo base_url() . 'package/' . $pack->slug; ?>"> <img src="<?php echo base_url() . 'files/thumb/' . $pack->image; ?>" alt="<?php echo $pack->title; ?>"></a>
                    <h5 class="home-item-title" align="center"><a href="<?php echo base_url() . 'package/' . $pack->slug; ?>"><?php echo $pack->title; ?> </a></h5>
                </div>
            </div>
            <?php
        }
        ?>
    </div>

</div>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Send Email To <?php echo $name; ?></h4>
            </div>
            <div class="modal-body">
                <div id="form-messages"></div>
                <form id="ajax-contact" method="post" action="<?php echo base_url('contactseller/' . $slug) ?>" onsubmit="return validateForm()" name="myform">
                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                    <div id="infoMessage" class="alert-info"><?php echo $this->session->flashdata('message'); ?></div>

                    <div id="contactForm">
                        <div class="contact-form col-sm-12" id="inputname">

                            <input class="form-control" name="name" placeholder="Full Name *" type="text"/>
                        </div>

                        <div class="contact-form col-sm-12" id="inputemail">

                            <input class="form-control" name="email" placeholder="Email *" type="text"/>

                        </div>

                        <div class="contact-form col-sm-12" id="inputmessage">

                            <textarea class="form-control" name="message" rows="4" placeholder="Message *" ></textarea>

                        </div>


                        <div class="col-sm-6">
                            <div class="field">
                                <button type="submit" name="submit" value="Send Message" class="btn btn-lg btn-primary" id="sendMessage">Send Message</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>


            <div style="clear: both;"></div>
            <br>
            <!--            <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>-->
        </div>

    </div>
</div>

<script>
    function validateForm() {

        var validation_holder;

        var validation_holder = 0;

        var name = document.forms["myform"]["name"].value;

        var email = document.forms["myform"]["email"].value;

        var message = document.forms["myform"]["message"].value;

        var email_regex = /^[\w%_\-.\d]+@[\w.\-]+.[A-Za-z]{2,6}$/;





        if (message == null || message == "") {

            $("#inputmessage").addClass('has-error');
            $("input[name='message']").focus();

            validation_holder = 1;

        } else {

            $("#inputmessage").removeClass('has-error');

        }

        if (email == "") {

            $("#inputemail").addClass('has-error');
            $("input[name='email']").focus();

            validation_holder = 1;

        } else {

            if (!email_regex.test(email)) { // if invalid email

                $("#inputemail").addClass('has-error');
                $("input[name='email']").focus();

                validation_holder = 1;

            } else {

                $("#inputemail").removeClass('has-error');

            }

        }

        if (name == null || name == "") {

            $("#inputname").addClass('has-error');
            $("input[name='name']").focus();

            validation_holder = 1;

        } else {

            $("#inputname").removeClass('has-error');

        }

        if (validation_holder == 1) { // if have a field is blank, return false

            $("p.validate_msg").slideDown("fast");

            return false;

        }
        validation_holder = 0;



    }

    $('#hidephone').hide();
    $('#default_text').click(function() {
        $('#default_text').hide();
        $('#hidephone').show(200);
    });

</script>
<!-- Go to www.addthis.com/dashboard to customize your tools -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-592530fb7b649b5f"></script>
<?php
if (empty($cover_image)) {
    $image = base_url("asset/images/default_shop_background.jpg");
} else {
    $image = base_url('files/shops/' . $cover_image);
}
?>
<script type="application/ld+json">{
    "@context":["http://schema.org",{"@language":"en-ca"}],
    "@type":"Store",
    "image": "<?php echo $image; ?>",
    "address": {
    "@type": "PostalAddress",
    "addressLocality": "<?php echo(!empty($address)) ? $address : "N/A"; ?>",
    "addressRegion": "<?php echo(!empty($address)) ? $address : "N/A"; ?>",
    "streetAddress": "<?php echo(!empty($address)) ? $address : "N/A"; ?>"
    },
    "name":"<?php echo(!empty($name)) ? $name : "N/A"; ?>",
    "telephone": "<?php echo(!empty($mobile)) ? $mobile : "N/A"; ?>",
    "openingHoursSpecification":
    [
    {"@type":"OpeningHoursSpecification",
    "closes":"<?php echo($sunclose > 0) ? $sunclose . "+05:30" : "00:00"; ?>",
    "dayOfWeek":"http://schema.org/Sunday",
    "opens":"<?php echo($sunstart > 0) ? $sunstart . "+05:30" : "00:00"; ?>"},
    {"@type":"OpeningHoursSpecification",
    "closes":"<?php echo($monclose > 0) ? $monclose . "+05:30" : "00:00"; ?>",
    "dayOfWeek":"http://schema.org/Monday",
    "opens":"<?php echo($monstart > 0) ? $monstart . "+05:30" : "00:00"; ?>"},
    {"@type":"OpeningHoursSpecification",
    "closes":"<?php echo($tueclose > 0) ? $tueclose . "+05:30" : "00:00"; ?>",
    "dayOfWeek":"http://schema.org/Tuesday",
    "opens":"<?php echo($tuestart > 0) ? $tuestart . "+05:30" : "00:00"; ?>"},
    {"@type":"OpeningHoursSpecification",
    "closes":"<?php echo($wedclose > 0) ? $wedclose . "+05:30" : "00:00"; ?>",
    "dayOfWeek":"http://schema.org/Wednesday",
    "opens":"<?php echo($wedstart > 0) ? $wedstart . "+05:30" : "00:00"; ?>"},
    {"@type":"OpeningHoursSpecification",
    "closes":"<?php echo($thuclose > 0) ? $thuclose . "+05:30" : "00:00"; ?>",
    "dayOfWeek":"http://schema.org/Thursday",
    "opens":"<?php echo($thustart > 0) ? $thustart . "+05:30" : "00:00"; ?>"},
    {"@type":"OpeningHoursSpecification",
    "closes":"<?php echo($friclose > 0) ? $friclose . "+05:30" : "00:00"; ?>",
    "dayOfWeek":"http://schema.org/Friday",
    "opens":"<?php echo($fristart > 0) ? $fristart . "+05:30" : "00:00"; ?>"},
    {"@type":"OpeningHoursSpecification",
    "closes":"<?php echo($satclose > 0) ? $satclose . "+05:30" : "00:00"; ?>",
    "dayOfWeek":"http://schema.org/Saturday",
    "opens":"<?php echo($satstart > 0) ? $satstart . "+05:30" : "00:00"; ?>"}]
    }</script>

<script type="application/ld+json">{
    "@context": "http://schema.org",
    "@type": "LocalBusiness",
    "image": "<?php echo $image; ?>",
    "address": {
    "@type": "PostalAddress",
    "addressLocality": "<?php echo(!empty($address)) ? $address : "N/A"; ?>",
    "addressRegion": "<?php echo(!empty($address)) ? $address : "N/A"; ?>",
    "streetAddress": "<?php echo(!empty($address)) ? $address : "N/A"; ?>"
    },
    "description": "<?php echo(!empty($over_view)) ? str_replace("'", "", $over_view) : "N/A"; ?>",
    "name": "<?php echo(!empty($name)) ? $name : "N/A"; ?>",
    "telephone": "<?php echo(!empty($mobile)) ? $mobile : "N/A"; ?>"
    }
</script>