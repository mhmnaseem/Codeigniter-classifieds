<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Manage Sub Category</h1>
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
                        <span class="fa fa-indent" aria-hidden="true"></span> All Sub categories
                    </div>

                    <div class="panel-footer">
                        <table width="100%" border="0" class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>

                                    <th scope="col">#</th>
                                    <th scope="col">Parent</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Url Name</th>
                                    <th scope="col">Description</th>
<!--                                    <th scope="col">Image</th>-->
                                    <th scope="col">&nbsp;</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($allsubcats as $cats) {
                                    ?>

                                    <tr>

                                        <td><?php echo $cats->id; ?></td>
                                        <td><?php
                                            foreach ($allcats as $pcat) {
                                                if ($pcat->mcatid == $cats->parentcat) {
                                                    echo $pcat->name;
                                                }
                                            }
                                            ?></td>
                                        <td><?php echo $cats->name; ?></td>

                                        <td><?php echo $cats->slug; ?></td>

                                        <td><?php echo $cats->description; ?></td>
    <!--                                        <td><?php
                                        if ($cats->image != '') {

                                            echo '<img src="' . base_url() . 'files/catergory/' . $cats->image . '" width="75" hight="75">';
                                        } else {
                                            echo '<img src="' . base_url() . 'asset/images/no-photo.png" width="75" hight="75">';
                                        }
                                        ?></td>-->

                                        <td><a href="<?php echo site_url('admin/editSubcat/' . $cats->id); ?>" class="btn btn-primary">Edit</a>&nbsp;&nbsp;<a href="<?php echo site_url('admin/deleteSubCat/' . $cats->id); ?>" class="btn btn-danger" onClick='javascript:return confirm("Are you sure to Delete?")'>Delete</a></td>

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