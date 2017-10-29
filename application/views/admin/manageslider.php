<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Manage Slider</h1>
                <div id="infoMessage" class="alert-info"><?php echo $this->session->flashdata('message'); ?></div>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->

        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-film" aria-hidden="true"></i> Slides
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="dataTable_wrapper">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example2">
                                <thead>
                                    <tr>
                                        <th>Slide #</th>
                                        <th>Slide</th>
                                        <th>link</th>
                                        <th>&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($allslides as $slide) {
                                        ?>

                                        <tr>

                                            <td><?php echo $no; ?></td>

                                            <td><img src="<?php echo base_url() . 'files/slider/' . $slide->slider_img; ?>" width="200" height="100"></td>
                                            <td><?php echo $slide->link ?></td>
                                            <td><a href="<?php echo site_url('admin/deleteslide/' . $slide->slider_id); ?>" class="btn btn-danger btn-bott-margin" onClick='javascript:return confirm("Are you sure you want to detete this slide?")'>Delete</a></td>


                                        </tr>



                                        <?php
                                        $no++;
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.table-responsive -->

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



    });
</script>
