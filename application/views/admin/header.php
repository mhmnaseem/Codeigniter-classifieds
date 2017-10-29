<?php
if ($this->session->userdata('user_name') != '' && $this->session->userdata('user_type') == "Admin") {
    ?>


    <!DOCTYPE html>
    <html lang="en">

        <head>

            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <meta name="description" content="">
            <meta name="author" content="">

            <title>Admin Panel</title>

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

            <link href="<?= base_url() ?>asset/admin/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet"><!--

             DataTables Responsive CSS
            <link href="<?= base_url() ?>asset/admin/bower_components/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet">-->

            <link href="https://cdn.datatables.net/responsive/2.1.1/css/responsive.bootstrap.min.css" rel="stylesheet">
            <link href="https://cdn.datatables.net/responsive/2.1.1/css/responsive.dataTables.min.css" rel="stylesheet">



            <!-- Custom Fonts -->
    <!--            <link href="<?= base_url() ?>asset/admin/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">-->

            <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet" type="text/css">

            <!-- time picker -->
            <link href="<?= base_url() ?>asset/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
                                                                                                                                                                                                            <!--        <link href="<?= base_url() ?>asset/admin/dist/css/styles.css" rel="stylesheet">-->
            <link href="<?= base_url() ?>asset/css/adminstyle.css?v-<?php echo time(); ?>" rel="stylesheet">

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

            <!-- Morris Charts JavaScript -->
    <!--            <script src="<?= base_url() ?>asset/admin/bower_components/raphael/raphael-min.js"></script>
            <script src="<?= base_url() ?>asset/admin/bower_components/morrisjs/morris.min.js"></script>-->
    <!--        <script src="<?= base_url() ?>asset/admin/js/morris-data.js"></script>-->

            <script src="<?= base_url() ?>asset/admin/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
            <script src="<?= base_url() ?>asset/admin/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>

                                                                                                                                                                <!--            <script src="https://cdn.datatables.net/responsive/2.1.1/js/responsive.bootstrap.min.js"></script>-->
            <script src="https://cdn.datatables.net/responsive/2.1.1/js/dataTables.responsive.min.js"></script>


            <!-- Custom Theme JavaScript -->
            <script src="<?= base_url() ?>asset/admin/dist/js/sb-admin-2.js"></script>

            <!-- Time picker-->
            <script src="<?php echo base_url(); ?>asset/js/moments.min.js"></script>
            <script src="<?php echo base_url(); ?>asset/js/bootstrap-datetimepicker.min.js"></script>


        </head>

        <body>

            <div id="wrapper">

                <!-- Navigation -->
                <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="<?= base_url() ?>"><img src="<?= base_url() ?>asset/images/logo.png" style="
                                                                              height: 36px; "></a>
                    </div>
                    <!-- /.navbar-header -->

                    <ul class="nav navbar-top-links navbar-right">
                        <li>  Hello  <?php echo $this->session->userdata('user_name'); ?></li>

                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-user">

                                <li><a href="<?= base_url() ?>auth/logout"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                                </li>
                            </ul>
                            <!-- /.dropdown-user -->
                        </li>
                        <!-- /.dropdown -->
                    </ul>
                    <!-- /.navbar-top-links -->

                    <div class="navbar-default sidebar" role="navigation">
                        <div class="sidebar-nav navbar-collapse">
                            <ul class="nav" id="side-menu">

                                <li>
                                    <a href="<?= base_url() ?>admin"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                                </li>

                                <li>
                                    <a href="#"><i class="fa fa-user" aria-hidden="true"></i>  Users
                                        <span class="fa arrow"></span></a>
                                    <ul class="nav nav-second-level">

                                        <li>
                                            <a href="<?php echo base_url('admin/adduser'); ?>"><i class="fa fa-plus" aria-hidden="true"></i></i> Add</a>
                                        </li>
                                        <li>
                                            <a href="<?php echo base_url('admin/manageUser'); ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></i> Manage</a>
                                        </li>

                                    </ul>
                                    <!-- /.nav-second-level -->
                                </li>


                                <li>
                                    <a href="#"><i class="fa fa-list" aria-hidden="true"></i> Main Catergory
                                        <span class="fa arrow"></span></a>
                                    <ul class="nav nav-second-level">

                                        <li>
                                            <a href="<?= base_url() ?>admin/addMainCat"><i class="fa fa-plus" aria-hidden="true"></i></i> Add</a>
                                        </li>
                                        <li>
                                            <a href="<?= base_url() ?>admin/manageMainCat"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                </i> Manage</a>
                                        </li>

                                    </ul>
                                    <!-- /.nav-second-level -->
                                </li>
                                <li>
                                    <a href="#"><i class="fa fa-indent" aria-hidden="true"></i> Sub Catergory
                                        <span class="fa arrow"></span></a>
                                    <ul class="nav nav-second-level">

                                        <li>
                                            <a href="<?= base_url() ?>admin/addSubCat"><i class="fa fa-plus" aria-hidden="true"></i> Add </a>
                                        </li>
                                        <li>
                                            <a href="<?= base_url() ?>admin/manageSubCat"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                </i> Manage</a>
                                        </li>

                                    </ul>

                                </li>
                                <li>
                                    <a href="#"><i class="fa fa-tags" aria-hidden="true"></i> All Items
                                        <span class="fa arrow"></span></a>
                                    <ul class="nav nav-second-level">
                                        <!--                                        <li>
                                                                                    <a href="<?= base_url() ?>admin/addItem"><i class="fa fa-plus" aria-hidden="true"></i> Add Item</a>
                                                                                </li>-->
                                        <li>
                                            <a href="<?= base_url() ?>admin/manageItems"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Manage Item</a>
                                        </li>

                                    </ul>

                                </li>
                                <li>
                                    <a href="#"><i class="fa fa-gift" aria-hidden="true"></i> All Packages
                                        <span class="fa arrow"></span></a>
                                    <ul class="nav nav-second-level">
                                        <!--                                        <li>
                                                                                    <a href="<?= base_url() ?>admin/addItem"><i class="fa fa-plus" aria-hidden="true"></i> Add Item</a>
                                                                                </li>-->
                                        <li>
                                            <a href="<?= base_url() ?>admin/managepackage"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Manage Packages</a>
                                        </li>

                                    </ul>

                                </li>

                                <li>
                                    <a href="#"><i class="fa fa-paint-brush" aria-hidden="true"></i> All Themes
                                        <span class="fa arrow"></span></a>
                                    <ul class="nav nav-second-level">
                                        <li>
                                            <a href="<?= base_url() ?>admin/addTheme"><i class="fa fa-plus" aria-hidden="true"></i> Add Themes</a>
                                        </li>
                                        <li>
                                            <a href="<?= base_url() ?>admin/manageThemes"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Manage Themes</a>
                                        </li>

                                    </ul>

                                </li>
                                <li>
                                    <a href="#"><i class="fa fa-home" aria-hidden="true"></i> All Venues
                                        <span class="fa arrow"></span></a>
                                    <ul class="nav nav-second-level">
                                        <li>
                                            <a href="<?= base_url() ?>admin/addVenue"><i class="fa fa-plus" aria-hidden="true"></i> Add Venue</a>
                                        </li>
                                        <li>
                                            <a href="<?= base_url() ?>admin/manageVenues"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Manage Venues</a>
                                        </li>

                                    </ul>

                                </li>
                                <li>
                                    <a href="#"><i class="fa fa-picture-o" aria-hidden="true"></i> Manage Slider
                                        <span class="fa arrow"></span></a>
                                    <ul class="nav nav-second-level">
                                        <li>
                                            <a href="<?= base_url() ?>admin/addslider"><i class="fa fa-plus" aria-hidden="true"></i>

                                                Add Slider</a>
                                        </li>

                                        <li>
                                            <a href="<?= base_url() ?>admin/manageslider"><i class="fa fa-list" aria-hidden="true"></i>

                                                Manage Slides</a>
                                        </li>



                                    </ul>
                                </li>
                                <!--              <li>
                                              <a href="#"><i class="fa fa-support" aria-hidden="true"></i> Support Tickets
                                                  <span class="fa arrow"></span></a>
                                              <ul class="nav nav-second-level">
                                                  <li>
                                                      <a href="<?= base_url() ?>admin/manageSupport"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                          </i> Queue</a>
                                                  </li>


                                              </ul>
                                          </li>
                                          <li>
                                              <a href="#"><i class="fa fa-picture-o" aria-hidden="true"></i> Manage Slider
                                                  <span class="fa arrow"></span></a>
                                              <ul class="nav nav-second-level">
                                                  <li>
                                                      <a href="<?= base_url() ?>admin/addslider"><i class="fa fa-plus" aria-hidden="true"></i>

                                                          Add Slider</a>
                                                  </li>

                                                  <li>
                                                      <a href="<?= base_url() ?>admin/manageslider"><i class="fa fa-list" aria-hidden="true"></i>

                                                          Manage Slides</a>
                                                  </li>



                                              </ul>
                                          </li>
                                          <li>
                                              <a href="#"><i class="fa fa-clone" aria-hidden="true"></i>
                                                  Manage Banner
                                                  <span class="fa arrow"></span></a>
                                              <ul class="nav nav-second-level">
                                                  <li>
                                                      <a href="<?= base_url() ?>admin/addbanner"><i class="fa fa-plus" aria-hidden="true"></i>

                                                          Add Banner</a>
                                                  </li>

                                                  <li>
                                                      <a href="<?= base_url() ?>admin/managebanner"><i class="fa fa-list" aria-hidden="true"></i>

                                                          Manage Banner</a>
                                                  </li>



                                              </ul>
                                          </li>-->




                            </ul>
                        </div>
                        <!-- /.sidebar-collapse -->
                    </div>
                    <!-- /.navbar-static-side -->
                </nav>


                <?php
            } else {

                redirect('/login');
            }
            ?>