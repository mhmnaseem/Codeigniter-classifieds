<?php
if ($this->session->userdata('user_id') != '' && $this->session->userdata('user_type') == "Seller") {
    ?>
    <!DOCTYPE html>
    <html lang="en">

        <head>
            <link rel="shortcut icon" href="<?php echo base_url(); ?>asset/images/favicon-32.png">
            <link rel="apple-touch-icon" href="<?php echo base_url(); ?>asset/images/favicon-57.png">
            <link rel="apple-touch-icon" sizes="72x72" href="<?php echo base_url(); ?>asset/images/favicon-72.png">
            <link rel="apple-touch-icon" sizes="114x114" href="<?php echo base_url(); ?>asset/images/favicon-114.png">
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <meta name="description" content="">
            <meta name="author" content="">

            <title>Dashboard | Birthdays.lk</title>

            <!-- Bootstrap Core CSS -->
            <link href="<?= base_url() ?>asset/admin/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

            <!-- MetisMenu CSS -->
            <link href="<?= base_url() ?>asset/admin/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

            <!-- Timeline CSS -->
            <link href="<?= base_url() ?>asset/admin/dist/css/timeline.css" rel="stylesheet">

            <!-- Custom CSS -->
            <link href="<?= base_url() ?>asset/admin/dist/css/sb-admin-2.css" rel="stylesheet">

            <!--drop zone CSS -->
            <link href="<?= base_url() ?>asset/css/dropzone.css" rel="stylesheet">
            <script src="<?= base_url() ?>asset/js/dropzone.js?v-<?php echo time(); ?>"></script>

            <!-- Morris Charts CSS -->
            <link href="<?= base_url() ?>asset/admin/bower_components/morrisjs/morris.css" rel="stylesheet">

            <link href="<?= base_url() ?>asset/admin/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">

            <!-- DataTables Responsive CSS-->

            <link href="https://cdn.datatables.net/responsive/2.1.1/css/responsive.bootstrap.min.css" rel="stylesheet">
            <link href="https://cdn.datatables.net/responsive/2.1.1/css/responsive.dataTables.min.css" rel="stylesheet">

            <!-- Custom Fonts -->
            <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet" type="text/css">

            <!-- time picker -->
            <link href="<?= base_url() ?>asset/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
                                                                                                                                                                                  <!--        <link href="<?= base_url() ?>asset/admin/dist/css/styles.css" rel="stylesheet">-->
            <link href="<?= base_url() ?>asset/css/style.css?v-<?php echo time(); ?>" rel="stylesheet">

            <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
            <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
            <!--[if lt IE 9]>
                <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
                <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
            <![endif]-->

            <!-- jQuery -->
            <script src="<?= base_url() ?>asset/admin/bower_components/jquery/dist/jquery.min.js"></script>

            <!-- Bootstrap Core JavaScript -->
            <script src="<?= base_url() ?>asset/admin/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

            <!-- Metis Menu Plugin JavaScript -->
            <script src="<?= base_url() ?>asset/admin/bower_components/metisMenu/dist/metisMenu.min.js"></script>

            <script src="<?= base_url() ?>asset/admin/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
            <script src="<?= base_url() ?>asset/admin/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>

            <script src="https://cdn.datatables.net/responsive/2.1.1/js/dataTables.responsive.min.js"></script>

            <!-- Custom Theme JavaScript -->
            <script src="<?= base_url() ?>asset/admin/dist/js/sb-admin-2.js"></script>

            <!-- Js Cookie-->
            <script src="<?php echo base_url(); ?>asset/js/jscookie.js"></script>

            <!--            input mask
                        <script src="<?php echo base_url(); ?>asset/js/mask.js"></script>-->

            <!-- Time picker-->
            <script src="<?php echo base_url(); ?>asset/js/moments.min.js"></script>
            <script src="<?php echo base_url(); ?>asset/js/bootstrap-datetimepicker.min.js"></script>


        </head>

        <body>

            <div id="wrapper">
                <?php require APPPATH . 'views/partials/topheader.php'; ?>

                <div class="margin-top-10"</div>





                <!-- Navigation -->
                <nav class="navbar navbar-default" role="navigation" style="margin-bottom: 0;background-color: #427db6; border-color:#427db6;    border-radius: 0px;  ">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar-2">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>

                    </div>
                    <!-- /.navbar-header -->

                    <ul class="nav navbar-top-links navbar-right">
                        <li class="user_name">  &nbsp;&nbsp; Hello  <?php echo $this->session->userdata('user_name'); ?></li>

                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-user">

                                <li>
                                    <a href="<?php
                                    if ($this->session->userdata('login_type') == "facebook") {
                                        echo $this->facebook->logout_url();
                                    } else if ($this->session->userdata('login_type') == "google") {
                                        echo 'https://www.google.com/accounts/Logout?continue=https://appengine.google.com/_ah/logout?continue=' . base_url() . 'auth/glogout';
                                    } else {
                                        echo base_url() . 'auth/logout';
                                    }
                                    ?>"><i class="fa fa-sign-out"></i>&nbsp;Logout</a>
                                </li>
                            </ul>
                            <!-- /.dropdown-user -->
                        </li>
                        <!-- /.dropdown -->
                    </ul>
                    <!-- /.navbar-top-links -->

                    <div class="navbar-default sidebar" role="navigation">
                        <div class="sidebar-nav navbar-collapse" id="myNavbar-2">
                            <ul class="nav" id="side-menu">

                                <li>
                                    <a href="<?= base_url('dashboard') ?>"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                                </li>

                                <li>
                                    <a href="#"><i class="fa fa-user" aria-hidden="true"></i>  Profile
                                        <span class="fa arrow"></span></a>
                                    <ul class="nav nav-second-level">

                                        <li>
                                            <a href="<?php echo base_url('profile'); ?>"><i class="fa fa-edit" aria-hidden="true"></i></i> Edit Profile</a>
                                        </li>
                                        <li>
                                            <a href="<?php echo base_url('change-my-password'); ?>"><i class="fa fa-key" aria-hidden="true"></i></i> Change Password</a>
                                        </li>
                                        <?php if ($shopactive == 1) { ?>
                                            <li>
                                                <a href="<?php echo base_url('shop-settings'); ?>"><i class="fa fa-cogs" aria-hidden="true"></i></i> Shop Settings</a>
                                            </li>
                                            <li>
                                                <a href="<?php echo base_url('shop-analytics'); ?>"><i class="fa fa-line-chart" aria-hidden="true"></i></i> Shop Analytics</a>
                                            </li>
                                        <?php } ?>

                                    </ul>
                                    <!-- /.nav-second-level -->
                                </li>
                                <li>
                                    <a href="#"><i class="fa fa-tags" aria-hidden="true"></i> Items
                                        <span class="fa arrow"></span></a>
                                    <ul class="nav nav-second-level">
                                        <li>
                                            <a href="<?= base_url('post-item') ?>"><i class="fa fa-plus" aria-hidden="true"></i> Post Item</a>
                                        </li>
                                        <li>
                                            <a href="<?= base_url('manage-items') ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Manage Items</a>
                                        </li>

                                    </ul>

                                </li>

                                <li>
                                    <a href="#"><i class="fa fa-gift" aria-hidden="true"></i> Item Packages
                                        <span class="fa arrow"></span></a>
                                    <ul class="nav nav-second-level">

                                        <li>
                                            <a href="<?= base_url('post-package') ?>"><i class="fa fa-plus" aria-hidden="true"></i> Post Package </a>
                                        </li>
                                        <li>
                                            <a href="<?= base_url('manage-packages') ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                </i> Manage Packages</a>
                                        </li>

                                    </ul>

                                </li>






                            </ul>
                        </div>
                        <!-- /.sidebar-collapse -->
                    </div>
                    <!-- /.navbar-static-side -->
                </nav>


                <?php
            } else {

                redirect('login');
            }
            ?>