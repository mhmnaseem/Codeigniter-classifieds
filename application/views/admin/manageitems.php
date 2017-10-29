<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Manage Items</h1>
                <div id="infoMessage" class="alert-info"><?php echo $this->session->flashdata('message'); ?></div>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->

        <!-- .row -->
        <div class="row">
            <div class="col-lg-12">


                <div class="panel panel-default">
                    <div class="panel-body">
                        <span class="fa fa-indent" aria-hidden="true"></span> All Approved Items
                    </div>

                    <div class="panel-footer">
                        <table width="100%" border="0" class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>

                                    <th scope="col">#</th>
                                    <th scope="col">Parent Category</th>
                                    <th scope="col">Sub Category</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">&nbsp;</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($allitems as $item) {
                                    ?>

                                    <tr>
                                        <td><?php echo $item->id; ?></td>
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

                                        <td><a href="<?php echo site_url('admin/viewitem/' . $item->id); ?>" class="btn btn-warning">view</a>&nbsp;&nbsp;<a href="<?php echo site_url('admin/editItem/' . $item->id); ?>" class="btn btn-primary">Edit</a>&nbsp;&nbsp;<a href="<?php echo site_url('admin/deleteItem/' . $item->id); ?>" class="btn btn-danger" onClick='javascript:return confirm("Are you sure to Delete?")'>Delete</a></td>

                                    </tr>



                                    <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>


            </div>


        </div>
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->

<script type="text/javascript">
    $(document).ready(function() {

        $('#dataTables-example').DataTable({
            responsive: true,
            "order": [[0, "desc"]]
        });

    });
</script>