<?php if ($shopactive == 1) { ?>

    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Shop Analytics</h1>

                    <div id="infoMessage" class="alert-info"><?php echo $this->session->flashdata('message'); ?></div>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->

            <!-- row -->
            <h4>Total Shop Visits <span  class="badge"><?php echo $visits; ?></span></h4>
            <br>
            <?php if (!empty($allitems)) { ?>
                <!-- .row -->
                <div class="row">
                    <div class="col-lg-12">


                        <div class="panel panel-default">
                            <div class="panel-body">
                                <span class="fa fa-tags" aria-hidden="true"></span> Items Analytics
                            </div>

                            <div class="panel-footer">
                                <table width="100%" border="0" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>


                                            <th scope="col">Parent Category</th>
                                            <th scope="col">Sub Category</th>
                                            <th scope="col">Title</th>
                                            <th scope="col">Image</th>
                                            <th scope="col">Views</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($allitems as $item) {
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

                                                <td><?php echo $item->views; ?></td>

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
            <?php } ?>
            <?php if (!empty($allpackages)) { ?>
                <!-- .row -->
                <div class="row">
                    <div class="col-lg-12">


                        <div class="panel panel-default">
                            <div class="panel-body">
                                <span class="fa fa-gift" aria-hidden="true"></span> Packages Analytics
                            </div>

                            <div class="panel-footer">
                                <table width="100%" border="0" class="table table-striped table-bordered table-hover" id="dataTables-example2">
                                    <thead>
                                        <tr>
                                            <th scope="col">Title</th>
                                            <th scope="col">Package Type</th>
                                            <th scope="col">Image</th>
                                            <th scope="col">Views</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($allpackages as $pack) {
                                            ?>

                                            <tr>


                                                <td><?php echo $pack->title; ?></td>
                                                <td><?php echo $pack->package_type; ?></td>

                                                <td><?php
                                                    echo '<img src="' . base_url() . 'files/thumb/' . $pack->image . '" width="75" hight="75">';
                                                    ?></td>

                                                <td><?php echo $pack->views; ?></td>

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
            <?php } ?>

        </div>

    </div>


    <?php
} else {
    $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert"><span>Error With Accessing Shop Anylytics..!</span></div>');
    redirect("dashboard");
}
?>

<script type="text/javascript">
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
</script>