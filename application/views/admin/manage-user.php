<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Manage Users</h1>
                <div id="infoMessage" class="alert-info"><?php echo $this->session->flashdata('message'); ?></div>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-users" aria-hidden="true"></i> Admin Users
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">

                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th>User #</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Company</th>
                                    <th>Active</th>
                                    <th>&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($alladminusers as $users) {
                                    ?>

                                    <tr>

                                        <td><?php echo $users->id; ?></td>

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
                                        <td><a href="<?php echo site_url('admin/edituser/' . $users->id); ?>" class="btn btn-primary">Edit</a>&nbsp;&nbsp;<a href="<?php echo site_url('admin/deleteusers/' . $users->id); ?>" class="btn btn-danger" onClick='javascript:return confirm("Are you sure to Delete?")'>Delete</a></td>

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
                        <i class="fa fa-users" aria-hidden="true"></i> Seller Users
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">

                        <table class="table table-striped table-bordered table-hover" id="dataTables-example1">
                            <thead>
                                <tr>
                                    <th>User #</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Company</th>
                                    <th>Active</th>
                                    <th>&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($allsellerusers as $susers) {
                                    ?>

                                    <tr>

                                        <td><?php echo $susers->id; ?></td>

                                        <td><?php echo $susers->fname . ' ' . $susers->lname; ?></td>

                                        <td><?php echo $susers->email; ?></td>

                                        <td><?php echo $susers->company; ?></td>

                                        <td align="center"><?php
                                            if ($susers->active == 1) {
                                                echo '<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>';
                                            } else {
                                                echo '<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>';
                                            }
                                            ?></td>
                                        <td><a href="<?php echo site_url('admin/edituser/' . $susers->id); ?>" class="btn btn-primary">Edit</a>&nbsp;&nbsp;<a href="<?php echo site_url('admin/deleteusers/' . $susers->id); ?>" class="btn btn-danger" onClick='javascript:return confirm("Are you sure to Delete?")'>Delete</a></td>

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
        $('#dataTables-example').DataTable({
            responsive: true,
            "order": [[0, "desc"]]
        });
        $('#dataTables-example1').DataTable({
            responsive: true,
            "order": [[0, "desc"]]
        });
        $('#dataTables-example2').DataTable({
            responsive: true,
            "order": [[0, "desc"]]
        });
    });
</script>
