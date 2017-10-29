<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Add Images for Post Package</h1>
                <div class="row bs-wizard" style="border-bottom:0;">

                    <div id="step1" class="col-xs-4 bs-wizard-step complete">
                        <div class="text-center bs-wizard-stepnum">Step 1</div>
                        <div class="progress"><div class="progress-bar"></div></div>
                        <a href="#" class="bs-wizard-dot"></a>
                        <div class="bs-wizard-info text-center">Fill Form</div>
                    </div>

                    <div class="col-xs-4 bs-wizard-step active">
                        <div class="text-center bs-wizard-stepnum">Step 2</div>
                        <div class="progress"><div class="progress-bar"></div></div>
                        <a href="#" class="bs-wizard-dot"></a>
                        <div class="bs-wizard-info text-center">Upload Images</div>
                    </div>

                    <div class="col-xs-4 bs-wizard-step disabled">
                        <div class="text-center bs-wizard-stepnum">Step 3</div>
                        <div class="progress"><div class="progress-bar"></div></div>
                        <a href="#" class="bs-wizard-dot"></a>
                        <div class="bs-wizard-info text-center">Include Package Items & Submit</div>
                    </div>

                </div>
                <div id="infoMessage" class="alert-info"><?php echo $this->session->flashdata('message'); ?></div>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <!-- row -->
        <div class="row">
            <div class="col-md-12">
                <form id="myAwesomeDropzone" action="<?php echo base_url() ?>seller/itemPackageImageUpload" method="post" enctype="multipart/form-data" class="dropzone">
                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                    <input type="hidden" id="submited" value="">
                    <div class="fallback">
                        <input name="file" type="file" multiple />
                    </div>
                </form>
                <span class="val_image"></span>
                <p>You can upload upto 5 files of type .jpg, .png or .gif of size 5MB each</p>
                <br>
                <br>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6 col-md-6 xs-margin-10">
                <form action="<?php echo base_url('post-package-link-item') ?>" method="post" id="form" name="myform">
                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                    <button id="submit_next" type="submit" class="btn btn-lg btn-ml-login btn-block">Next</button>
                </form>

            </div>

            <div class="col-sm-6 col-md-6">
                <a class="btn btn-lg btn-ml-cancel btn-block" href="<?php echo base_url('seller/cancel_package_post') ?>">Cancel</a>
            </div>
            <!--            <div class="col-sm-6 col-sm-push-3 col-md-6 col-md-push-3">
                            <a class="btn btn-lg btn-ml-login btn-block" href="<?php echo base_url('post-package-link-item') ?>">Next</a>
                        </div>-->

        </div>

    </div>
</div>
<script>

    $(document).ready(function() {
        $('#submit_next').click(function(e) {
            e.preventDefault();
            $.ajax({
                type: "POST",
                data: {'<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'},
                url: '<?= base_url() ?>seller/validate_image_upload_pack/',
                success: function(data) {

                    if (data != 0) {
                        $("span.val_image").html("");

                        $("#submited").val('submit');

                        $("#form").submit();



                    } else {
                        e.preventDefault();
                        $("span.val_image").html("Please upload minimun one picture.").addClass('validate');

                    }

                }

            });

        });
    });

</script>

<script>
// "myAwesomeDropzone" is the camelized version of the HTML element's ID
    var myDropzone = new Dropzone("#myAwesomeDropzone", {
        success: function(file, response) {
            file.previewElement.id = response.id;

        }

    });
    myDropzone.on('removedfile', function(file) {
        var id = file.previewElement.id;
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url('seller/deletepackageimagegalleryById'); ?>',
            data: {id: id, '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'},
            dataType: 'html'
        });
        var _ref;
        return (((_ref = file.previewElement) != null) && file.previewElement.parentNode) ? _ref.parentNode.removeChild(file.previewElement) : void 0;
    });

</script>
<script>
//    (function(global) {
//
//        if (typeof (global) === "undefined") {
//            throw new Error("window is undefined");
//        }
//
//        var _hash = "!";
//        var noBackPlease = function() {
//            global.location.href += "#";
//
//            // making sure we have the fruit available for juice (^__^)
//            global.setTimeout(function() {
//                global.location.href += "!";
//            }, 50);
//        };
//
//        global.onhashchange = function() {
//            if (global.location.hash !== _hash) {
//                global.location.hash = _hash;
//            }
//        };
//
//        global.onload = function() {
//            noBackPlease();
//
//            // disables backspace on page except on input fields and textarea..
//            document.body.onkeydown = function(e) {
//                var elm = e.target.nodeName.toLowerCase();
//                if (e.which === 8 && (elm !== 'input' && elm !== 'textarea')) {
//                    e.preventDefault();
//                }
//                // stopping event bubbling up the DOM tree..
//                e.stopPropagation();
//            };
//        }
//
//    })(window);


    $(document).ready(function() {

        $(window).unload(function() {
            var value = $('#submited').val();
            if (value !== "submit") {
                $.ajax({
                    type: "POST",
                    async: false,
                    data: {'<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'},
                    url: '<?= base_url() ?>seller/cancel_package_post_back_button/',
                    success: function(data) {


                    }

                });
            }

        });

    });
</script>


