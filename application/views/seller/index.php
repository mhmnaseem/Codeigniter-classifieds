<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 style="display: inline-block;" class="page-header">Dashboard</h1><h5 style="display: inline-block; float: right; padding-bottom: 9px; margin: 40px 0 20px;"><?php
                    if ($shopactive == 1) {
                        ?>
                        <a class="btn btn-success btn-sm" href="<?php echo base_url('shops/' . $link); ?>">View Shop</a>
                        <?php
                    }
                    ?></h5>
                <div id="infoMessage" class="alert-info"><?php echo $this->session->flashdata('message'); ?></div>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <?php
        if ($totalitems <= 15 && $totalitems >= 1 && $shopactive == 0) {
            ?>
            <div class="alert alert-info">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Info</strong>, Want to have a Birthdays Sellers Shop? Please contact us. <br> What is a Sellers' Shop? .<strong><a href="https://www.facebook.com/birthdays.lk/"> <i class="fa fa-hand-o-right" aria-hidden="true"></i> Click here for details </a>
            </div>
            <?php
        }
        ?>

        <?php
        if ($totalitems >= 15 && $shopactive == 0) {
            ?>
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Info</strong>, Your Shop is Ready for Activation  <strong><a href="<?php echo base_url('createshop/' . $hash) ?>"> <i class="fa fa-hand-o-right" aria-hidden="true"></i> Activate Shop Here </a>
            </div>
            <?php
        }
        ?>

        <?php
        foreach ($user as $singleuser) {
//            if ($singleuser->phone_verify == 0) {
//
            ?>
            <!--                <div class="alert alert-warning">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Warning!</strong>, Your Phone Number not Verified, only Verified numbers will be shown to customers, you can <strong><a href="//<?php echo base_url('profile') ?>"> <i class="fa fa-hand-o-right" aria-hidden="true"></i> Verify Here </a>
                            </div>-->
            <?php
//            }
        }
        ?>
        <?php
        foreach ($user as $singleuserdetails) {
            if ($singleuserdetails->fname == "" || $singleuserdetails->lname == "" || $singleuserdetails->company == "" || $singleuserdetails->mobile == "" || $singleuserdetails->user_city == "") {
                ?>
                <div class="alert alert-info">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Welcome <strong><?php echo $this->session->userdata('user_name'); ?></strong>, In order to better contacted by customers please take a few moments to complete your profile information <strong><a href="<?php echo base_url('profile') ?>"> <i class="fa fa-hand-o-right" aria-hidden="true"></i> Update Here </a>
                </div>
                <?php
            }
        }
        ?>


        <!--        <div class="alert alert-info alerthide">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong><?php echo $this->session->userdata('user_name'); ?></strong>, Welcome To Birthdays.lk Seller Account
                </div>-->


        <?php if (!empty($pendingitem)) { ?>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-tags" aria-hidden="true"></i> Items pending approval
                        </div>
                        <div class="text-center">
                            <br>
                            <a href="<?= base_url('post-item') ?>" class="btn btn-success" >Add Another Item</a>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">


                            <table width="100%" border="0" class="table table-striped table-bordered table-hover" id="dataTables-example2">
                                <thead>
                                    <tr>

                                        <th scope="col">Title</th>
                                        <th scope="col">Image</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($pendingitem as $pitem) {
                                        ?>

                                        <tr>

                                            <td><?php echo $pitem->title; ?></td>
                                            <td><img src="<?php echo base_url() . 'files/thumb/' . $pitem->image; ?>"  width="75" hight="75"></td>
                                            <td><strong>Purchase Price :</strong> <?php echo!empty($pitem->pprice) ? 'Rs ' . $pitem->pprice : 'N/A'; ?> <br><strong> Rental Price:</strong> <?php echo!empty($pitem->rprice) ? 'Rs ' . $pitem->rprice : 'N/A'; ?></td>
                                            <td align="center"><?php
                                                if ($pitem->status == 'pending' || $pitem->status == 'edit') {

                                                    echo 'Under Review';
                                                }
                                                ?></td>
                                            <td><!--<a href="<?php //echo site_url('edit-item/' . $pitem->slug);                                                                                                                         ?>" class="btn btn-primary btn-bott-margin">Edit</a>&nbsp;--><a href="<?php echo site_url('delete-item/' . $pitem->slug); ?>" class="btn btn-danger btn-bott-margin" onClick='javascript:return confirm("Are you sure you want to delete?”")'>Delete</a></td>

                                        </tr>



                                        <?php
                                    }
                                    ?>
                                </tbody>
                            </table>


                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <?php
        }
        if (!empty($pendingpackage)) {
            ?>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-gift" aria-hidden="true"></i> Packages pending approval
                        </div>
                        <div class="text-center">
                            <br>
                            <a href="<?= base_url('post-package') ?>" class="btn btn-success" >Add Another Package</a>
                        </div>

                        <!-- /.panel-heading -->
                        <div class="panel-body">

                            <table width="100%" border="0" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>

                                        <th scope="col">Title</th>
                                        <th scope="col">Package Type</th>
                                        <th scope="col">Image</th>
                                        <th scope="col">Status</th>

                                        <th scope="col">&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($pendingpackage as $ppackage) {
                                        ?>

                                        <tr>

                                            <td><?php echo $ppackage->title; ?></td>
                                            <td><?php echo $ppackage->package_type; ?></td>
                                            <td><img src="<?php echo base_url() . 'files/thumb/' . $ppackage->image; ?>"  width="75" hight="75"></td>

                                            <td align="center"><?php
                                                if ($ppackage->status == 'pending' || $ppackage->status == 'edit') {

                                                    echo 'Under Review';
                                                }
                                                ?></td>
                                            <td><a href="<?php echo site_url('delete-item-package/' . $ppackage->slug); ?>" class="btn btn-danger btn-bott-margin" onClick='javascript:return confirm("Are you sure you want to delete?")'>Delete</a></td>

                                        </tr>



                                        <?php
                                    }
                                    ?>
                                </tbody>
                            </table>


                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->

            <?php
        }
        ?>

    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->
<script>
    $(document).ready(function() {

        $('#dataTables-example').DataTable({
            responsive: true,
            "order": [[0, "desc"]]
        });
        $('#dataTables-example2').DataTable({
            responsive: true,
            "order": [[0, "desc"]]
        });
    });

    window.setTimeout(function() {
        $(".alerthide").fadeTo(500, 0).slideUp(500, function() {
            $(this).remove();
        });
    }, 4000);
</script>
