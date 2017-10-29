<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Admin - Dashboard</h1>
                <div id="infoMessage" class="alert-info"><?php echo $this->session->flashdata('message'); ?></div>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->

        <?php if (!empty($pendingitems)) { ?>
            <!-- .row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-tags" aria-hidden="true"></i> Approve Pending Items
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">

                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th scope="col">Parent Category</th>
                                        <th scope="col">Sub Category</th>
                                        <th scope="col">Title</th>
                                        <th scope="col">Image</th>
                                        <th scope="col">&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($pendingitems as $item) {
                                        ?>

                                        <tr>

                                            <td><?php
                                                foreach ($pcatandsubcat as $pcat) {
                                                    if ($item->category == $pcat->id) {
                                                        echo $pcat->parentname;
                                                    }
                                                }
                                                ?></td>
                                            <td><?php
                                                foreach ($allscats as $scat) {
                                                    if ($scat->id == $item->category) {
                                                        echo $scat->name;
                                                    }
                                                }
                                                ?></td>
                                            <td><?php echo $item->title; ?></td>
                                            <td><?php
                                                echo '<img src="' . base_url() . 'files/thumb/' . $item->image . '" width="75" hight="75">';
                                                ?></td>

                                            <td> <a href="<?php echo site_url('admin/viewItem/' . $item->id); ?>" class="btn btn-warning btn-bott-margin">View</a>&nbsp;  <a href="<?php echo site_url('admin/editItem/' . $item->id); ?>" class="btn btn-success btn-bott-margin">Edit</a>&nbsp;<a href="<?php echo site_url('admin/approveItem/?var1=' . $item->id . '&var2=approve'); ?>" class="btn btn-primary btn-bott-margin">Approve</a>&nbsp;<a href="<?php echo site_url('admin/approveItem/?var1=' . $item->id . '&var2=declin'); ?>" class="btn btn-danger btn-bott-margin" onClick='javascript:return confirm("Are you sure you want to decline this Item?")'>Decline</a></td>

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
        if (!empty($pendingitemsedits)) {
            ?>
            <!-- .row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-tags" aria-hidden="true"></i> Approve Pending Items Edits
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">

                            <table class="table table-striped table-bordered table-hover" id="dataTables-example2">
                                <thead>
                                    <tr>
                                        <th scope="col">Parent Category</th>
                                        <th scope="col">Sub Category</th>
                                        <th scope="col">Title</th>
                                        <th scope="col">Image</th>
                                        <th scope="col">&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($pendingitemsedits as $pitem) {
                                        ?>

                                        <tr>

                                            <td><?php
                                                foreach ($pcatandsubcat as $pcat) {
                                                    if ($pitem->category == $pcat->id) {
                                                        echo $pcat->parentname;
                                                    }
                                                }
                                                ?></td>
                                            <td><?php
                                                foreach ($allscats as $scat) {
                                                    if ($scat->id == $pitem->category) {
                                                        echo $scat->name;
                                                    }
                                                }
                                                ?></td>
                                            <td><?php echo $pitem->title; ?></td>
                                            <td><?php
                                                echo '<img src="' . base_url() . 'files/thumb/' . $pitem->image . '" width="75" hight="75">';
                                                ?></td>

                                            <td> <a href="<?php echo site_url('admin/viewEditItem/' . $pitem->id); ?>" class="btn btn-warning">view</a>&nbsp;&nbsp;<a href="<?php echo site_url('admin/editapproveItem/?var1=' . $pitem->id . '&var2=approve'); ?>" class="btn btn-primary btn-bott-margin">Approve</a>&nbsp;<a href="<?php echo site_url('admin/editapproveItem/?var1=' . $pitem->id . '&var2=declin'); ?>" class="btn btn-danger btn-bott-margin" onClick='javascript:return confirm("Are you sure you want to decline this Item?")'>Decline</a></td>

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


        if (!empty($pendingitemspackage)) {
            ?>
            <!-- .row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-tags" aria-hidden="true"></i> Approve Pending Packages
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">

                            <table class="table table-striped table-bordered table-hover" id="dataTables-example3">
                                <thead>
                                    <tr>

                                        <th scope="col">Title</th>
                                        <th scope="col">Package Type</th>
                                        <th scope="col">Image</th>
                                        <th scope="col">&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($pendingitemspackage as $itempack) {
                                        ?>

                                        <tr>

                                            <td><?php echo $itempack->title; ?></td>
                                            <td><?php echo $itempack->package_type; ?></td>
                                            <td><?php
                                                echo '<img src="' . base_url() . 'files/thumb/' . $itempack->image . '" width="75" hight="75">';
                                                ?></td>

                                            <td><a href="<?php echo site_url('admin/viewItemPackage/' . $itempack->package_id); ?>" class="btn btn-warning">view</a>&nbsp;&nbsp;<a href="<?php echo site_url('admin/EditItemPackage/' . $itempack->package_id); ?>" class="btn btn-primary">Edit</a>&nbsp;&nbsp;<a href="<?php echo site_url('admin/approvePackage/?var1=' . $itempack->item_package_id . '&var2=approve'); ?>" class="btn btn-primary btn-bott-margin">Approve</a>&nbsp;<a href="<?php echo site_url('admin/approvePackage/?var1=' . $itempack->item_package_id . '&var2=declin'); ?>" class="btn btn-danger btn-bott-margin" onClick='javascript:return confirm("Are you sure you want to decline this Package?")'>Decline</a></td>

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
        if (!empty($pendingitemspackageedit)) {
            ?>
            <!-- .row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-tags" aria-hidden="true"></i> Approve Pending Packages Edit
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">

                            <table class="table table-striped table-bordered table-hover" id="dataTables-example4">
                                <thead>
                                    <tr>

                                        <th scope="col">Title</th>
                                        <th scope="col">Package Type</th>
                                        <th scope="col">Image</th>
                                        <th scope="col">&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($pendingitemspackageedit as $itempackedit) {
                                        ?>

                                        <tr>

                                            <td><?php echo $itempackedit->title; ?></td>
                                            <td><?php echo $itempackedit->package_type; ?></td>
                                            <td><?php
                                                echo '<img src="' . base_url() . 'files/thumb/' . $itempackedit->image . '" width="75" hight="75">';
                                                ?></td>

                                            <td><a href="<?php echo site_url('admin/viewItemPackageedit/' . $itempackedit->item_package_id); ?>" class="btn btn-warning btn-bott-margin">View</a>&nbsp;<a href="<?php echo site_url('admin/editapprovePackage/?var1=' . $itempackedit->item_package_id . '&var2=approve'); ?>" class="btn btn-primary btn-bott-margin">Approve</a>&nbsp;<a href="<?php echo site_url('admin/editapprovePackage/?var1=' . $itempackedit->item_package_id . '&var2=declin'); ?>" class="btn btn-danger btn-bott-margin" onClick='javascript:return confirm("Are you sure you want to decline this Package?")'>Decline</a></td>

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
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-users" aria-hidden="true"></i> Recent Users Registration
                    </div>
                    <div class="text-center">
                        <br>
                        <a href="<?= base_url() ?>admin/download" class="btn btn-success" >Download .xls file</a>
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">

                        <table width="100%" border="0" class="table table-striped table-bordered table-hover" id="dataTables-example5">
                            <thead>
                                <tr>
                                    <th scope="col">User #</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Company</th>
                                    <th scope="col">Active</th>
                                    <th scope="col">&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($recentusers as $users) {
                                    ?>

                                    <tr>

                                        <td><?php echo $users->id ?></td>

                                        <td><?php echo $users->fname . ' ' . $users->lname; ?></td>

                                        <td><?php echo $users->email; ?></td>

                                        <td><?php echo $users->company; ?></td>

                                        <td align="center"><?php
                                            if ($users->active == 1) {
                                                echo '<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>';
                                            } else {
                                                echo '<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>';
                                            }
                                            ?></td>
                                        <td><a href="<?php echo site_url('admin/edituser/' . $users->id); ?>" class="btn btn-primary btn-bott-margin">Edit</a>&nbsp;<?php if ($users->active == 1) { ?><a href="<?php echo site_url('admin/createshop/' . $users->hash . '/' . $users->id); ?>" class="btn btn-success btn-bott-margin">Create Shop</a><?php } ?>&nbsp;<a href = "<?php echo site_url('admin/deleteusers/' . $users->id); ?>" class = "btn btn-danger btn-bott-margin" onClick = 'javascript:return confirm("Are you sure to Delete?")'>Delete</a></td>

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


        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-building-o" aria-hidden="true"></i> Active Shops
                    </div>

                    <!-- /.panel-heading -->
                    <div class="panel-body">

                        <table width="100%" border="0" class="table table-striped table-bordered table-hover" id="dataTables-example6">
                            <thead>
                                <tr>

                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Company</th>
                                    <th scope="col">User Visits</th>
                                    <th scope="col">Shop Link</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($usershops as $usershop) {
                                    ?>

                                    <tr>

                                        <td><?php echo $usershop->fname . ' ' . $usershop->lname; ?></td>

                                        <td><?php echo $usershop->email; ?></td>

                                        <td><?php echo $usershop->company; ?></td>
                                        <td><?php echo $usershop->visits; ?></td>
                                        <td><a class="btn btn-success" target="_blank" href="<?php echo site_url('shops/' . $usershop->name_slug); ?>">Visit Shop</a></td>

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


    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->
<script>
    $(document).ready(function() {

        $('#dataTables-example,#dataTables-example1,#dataTables-example2,#dataTables-example3,#dataTables-example4,#dataTables-example5,#dataTables-example6').DataTable({
            responsive: true,
            "order": [[0, "desc"]]
        });
//        $('#dataTables-example2').DataTable({
//            responsive: true,
//            "order": [[0, "desc"]]
//        });
//        $('#dataTables-example3').DataTable({
//            responsive: true,
//            "order": [[0, "desc"]]
//        });
    });
</script>
