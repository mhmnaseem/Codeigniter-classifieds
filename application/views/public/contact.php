<div class="container contact-page">

    <!--    breadcrumb   -->
    <div class="row contact">
        <div class="margin-top-10 float">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div id="bc1" class="btn-group btn-breadcrumb">
                    <a href="<?php echo base_url(); ?>" class="btn btn-default"><i class="fa fa-home"></i></a>
                    <a href="#" class="btn btn-default"><div>Contact Us</div></a>
                </div>
            </div>

        </div>
    </div>
    <!--   / breadcrumb   -->
    <div class="text-center">
        <img style="display: inline !important; width:80px !important;" src="<?php echo base_url(); ?>asset/images/logo_icon.png">
    </div>
    <br>
    <p class="text-center" style="font-size: 22px;font-weight: 700;"> We are here to help you  </p>
    <p class="text-center" style="font-size: 15px;"> Here at Birthdays.lk, We take every single mail/message seriously and get back to you ASAP. </p>

    <div class="row">
        <div class="col-sm-6">

            <p class="text-center" style="font-size: 15px;font-weight: 700;">Feeling formal ?  </p>
            <div id="form-messages"></div>
            <form id="ajax-contact" method="post" action="<?php echo base_url('contactus') ?>" onsubmit="return validateForm()" name="myform">
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
        <div class="col-sm-6 xs-margin-50 no-bottom-margin">
            <p class="text-center" style="font-size: 15px;font-weight: 700;">Feeling Social ? </p>
            <div class="text-center">
                Send us a message from <a target="_blank" href="https://www.facebook.com/birthdays.lk"><img style="display: inline !important; width:70px !important; height: 70px !important;" src="<?php echo base_url(); ?>asset/images/facebook.png"></a>
            </div>
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

</script>
