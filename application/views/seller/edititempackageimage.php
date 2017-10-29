<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Edit Images for Package</h1>

                <div id="infoMessage" class="alert-info"><?php echo $this->session->flashdata('message'); ?></div>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <!-- row -->

        <h4>Uploaded Images</h4>
        <div class="row">
            <?php
            $iid = '';
            foreach ($allImages as $images) {

                $names = explode(',', $images->image);
                $max = sizeof($names);
                $iid = $images->package_gallery_id;
                for ($i = 0; $i < $max; $i++) {
                    echo '<div class="col-md-2 col-sm-2 col-xs-4" id="x' . $iid . '"><img class="thumbnail" src="' . base_url("files/thumb/") . $names[$i] . '"  width="100px" height="100px;"/>';
                }
                if ($images != '') {
                    ?>

                    <a href="#"  class="btn btn-danger closebtn fa fa-trash-o"  onClick="deletegallimg(<?php echo $iid; ?>)"></a>

                    <?php
                }
                echo'</div>';
            }
            ?>





        </div>
        <br>
        <br>
        <h4>Add New Image </h4>
        <div class="row">
            <div class="col-md-12">
                <form id="myAwesomeDropzone" action="<?php echo base_url() . 'seller/Edit_item_package_image_Upload/' . $slug ?>" method="post" enctype="multipart/form-data" class="dropzone">
                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                    <div class="fallback">
                        <input name="file" type="file" multiple />
                    </div>
                </form>
                <p>You are allowed to upload upto 5 files of type jpg, png or gif of size upto 5MB</p>
                <br>
                <br>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6 col-sm-push-3 col-md-6 col-md-push-3">
                <a class="btn btn-lg btn-ml-login btn-block" href="<?php echo base_url() . 'edit-item-package/' . $slug ?>">Back To Edit Package</a>
            </div>

        </div>

    </div>
</div>

<script>
    function deletegallimg(id) {
        //var id = id;
        //var divid = $(obj).attr('class');
        //var deletediv = "div#" + divid;
        var uid = '<?php echo $uid; ?>';
        var pid = '<?php echo $pid; ?>';

        jQuery.ajax({
            type: "POST",
            url: "<?php echo base_url('seller/deletepackageimagegallery'); ?>",
            data: {id: id, 'uid': uid, 'pid': pid, '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'},
            success: function(res) {
                if (res)
                {
                    var result = res.result;
                    $("#x" + result).hide();
                }
            }
        });
    }


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
