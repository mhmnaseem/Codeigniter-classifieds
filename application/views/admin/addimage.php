<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Add Images</h1>
                <div id="infoMessage" class="alert-info"><?php echo $this->session->flashdata('message'); ?></div>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <!-- row -->
        <div class="row">
            <div class="col-lg-6">
                <form action="<?php echo base_url() ?>admin/imageUpload" method="post" enctype="multipart/form-data" class="dropzone">
                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                    <div class="fallback">
                        <input name="file" type="file" multiple />
                    </div>
                </form>
                <br>
                <br>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <a class="btn btn-lg btn-ml-login btn-block" href="<?php echo base_url() ?>admin/addSubmit">Submit Post</a>
            </div>

        </div>

    </div>
</div>


