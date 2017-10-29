<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Manage Themes</h1>
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
                        <span class="fa fa-paint-brush" aria-hidden="true"></span> All Themes
                    </div>

                    <div class="panel-footer">
                        <table width="100%" border="0" class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>


                                    <th scope="col">Name</th>
                                    <th scope="col">type</th>
                                    <th scope="col">Image</th>

                                    <th scope="col">&nbsp;</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($allthemes as $theme) {
                                    ?>

                                    <tr>
                                        <td><?php echo $theme->themename; ?></td>

                                        <td><?php echo $theme->type; ?></td>
                                        <td><?php
                                            echo '<img src="' . base_url() . 'files/themes/' . $theme->image . '" width="75" hight="75">';
                                            ?></td>

                                            <td><!--<a href="<?php //echo site_url('admin/editTheme/' . $theme->theme_id);  ?>" class="btn btn-primary">Edit</a>&nbsp;&nbsp;--><a href="<?php echo site_url('admin/deleteTheme/' . $theme->theme_id); ?>" class="btn btn-danger" onClick='javascript:return confirm("Are you sure to Delete?")'>Delete</a></td>

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
            "order": [[0, "asc"]]
        });

    });
</script>