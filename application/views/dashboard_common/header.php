<!DOCTYPE html>

<html>

    <head>

        <meta charset="utf-8">

        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <meta name="description" content="">

        <meta name="author" content="Qtech">

        <link rel="shortcut icon" href="assets/images/favicon.ico">



        <title>Work Orders | Buy Fresh Produce Inc.</title>



        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />

        <link href="assets/css/core.css" rel="stylesheet" type="text/css" />

        <link href="assets/css/components.css" rel="stylesheet" type="text/css" />

        <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />

        <link href="assets/css/menu.css" rel="stylesheet" type="text/css" />

        <link href="assets/css/pages.css" rel="stylesheet" type="text/css" />

        <link href="assets/css/responsive.css" rel="stylesheet" type="text/css" />

        <link rel="stylesheet" href="assets/css/easy-autocomplete.min.css">

        <link rel="stylesheet" href="assets/css/easy-autocomplete.themes.min.css">

        <link rel="stylesheet" href="assets/css/jquery.loadingModal.css">

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.2/dist/jquery.fancybox.min.css" />

        <script src="assets/js/modernizr.min.js"></script>

        <link href="assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">



    </head>

    <body class="fixed-left">

        <div id="app" v-cloak>

            <!-- Begin page -->

            <div id="wrapper">

                <!-- Top Bar Start -->

                <div class="topbar">

                    <!-- LOGO -->

                    <div class="topbar-left">

                        <a href="index.html" class="logo"><span>Work <span>Orders</span></span><i class="mdi mdi-layers"></i></a>

                    </div>

                    <!-- Button mobile view to collapse sidebar menu -->

                    <div class="navbar navbar-default" role="navigation">

                        <div class="container">

                            <!-- Navbar-left -->

                            <ul class="nav navbar-nav navbar-left">

                                <li>

                                    <button class="button-menu-mobile open-left waves-effect">

                                    <i class="mdi mdi-menu"></i>

                                    </button>

                                </li>

                                <li class="hidden-xs">

                                    <a href="#" class="menu-item" @click="setDashMenuItem('new_order')"> <i class="fa fa-plus-circle text-success" ></i> Add New Work Order</a>

                                </li>

                            </ul>

                            <!-- Right(Notification) -->

                            <ul class="nav navbar-nav navbar-right">

                                <li>

                                    <a href="#" class="right-menu-item"><?php echo date('h:m:s A | d M Y l'); ?></a>

                                </li>

                                <li class="dropdown user-box">

                                    <a href="" class="dropdown-toggle waves-effect user-link" data-toggle="dropdown" aria-expanded="true">

                                        <img src="assets/images/icons/info.svg" alt="user-img" class="img-circle user-img" style="padding:7px;">

                                    </a>

                                    <ul  class="dropdown-menu dropdown-menu-right arrow-dropdown-menu arrow-menu-right" style="background-color:transparent !important;">

                                        <li v-for="notification in all_notifications">

                                            <p class="alert alert-info">{{ notification.notification }}</p>

                                        </li>

                                    </ul>





                                </li>

                                <li class="dropdown user-box">

                                    <a href="" class="dropdown-toggle waves-effect user-link" data-toggle="dropdown" aria-expanded="true">

                                        <img src="assets/images/users/1.jpg" alt="user-img" class="img-circle user-img">

                                    </a>

                                    <ul class="dropdown-menu dropdown-menu-right arrow-dropdown-menu arrow-menu-right user-list notify-list">

                                        <li>

                                            <h5>Hi, <?php echo $this->ion_auth->user()->row()->username; ?></h5>

                                        </li>

                                        <li><a href="settings.html" id="settings_btn"><i class="ti-settings m-r-5"></i> Settings</a></li>

                                        <li><a href="javascript:void(0)" id="logout_btn"><i class="ti-power-off m-r-5"></i> Logout</a></li>

                                    </ul>

                                </li>

                                </ul> <!-- end navbar-right -->

                        </div><!-- end container -->

                    </div><!-- end navbar -->

                </div>

                <!-- Top Bar End -->

                <!-- ========== Left Sidebar Start ========== -->

                <div class="left side-menu">

                    <div class="sidebar-inner slimscrollleft">

                        <!--- Sidemenu -->

                        <div id="sidebar-menu">

                            <ul>

                                <li class="menu-title">Navigation</li>



                                <li @click="setDashMenuItem('dashboard',$event)">

                                    <a href="#" class="waves-effect" >

                                        <i class="mdi mdi-view-dashboard"></i>

                                        <span> Dashboard </span>

                                    </a>

                                </li>



                                <li @click="setDashMenuItem('work_orders',$event)">

                                    <a href="#" class="waves-effect" >

                                        <span class="label label-primary pull-right">{{ new_work_orders.length }}</span>

                                        <i class="mdi mdi-star-circle"></i>

                                        <span> New Work Orders </span>

                                    </a>

                                </li>



                                <li @click="setDashMenuItem('completed',$event)">

                                    <a href="completed" class="waves-effect">

                                        <span class="label label-success pull-right">{{ completed_work_orders.length }}</span>

                                        <i class="mdi mdi-clipboard-check"></i>

                                        <span> Completed Jobs </span>

                                    </a>

                                </li>



                                <li @click="setDashMenuItem('overdue',$event)">

                                    <a href="overdue" class="waves-effect">

                                        <span class="label label-danger pull-right">{{ overdue_work_orders.length }}</span>

                                        <i class="mdi mdi-alert"></i>

                                        <span> Overdue </span>

                                    </a>

                                </li>



                                <li @click="setDashMenuItem('pending',$event)">

                                    <a href="pending" class="waves-effect">

                                        <span class="label label-warning pull-right">{{ pending_work_orders.length }}</span>

                                        <i class="mdi mdi-clock-alert"></i>

                                        <span> Pending Jobs </span>

                                    </a>

                                </li>



                                <li @click="setDashMenuItem('reports',$event)">

                                    <a href="reports" class="waves-effect">

                                        <i class="mdi mdi-file-document-box"></i>

                                        <span> Reports </span>

                                    </a>

                                </li>



                                <?php if ($this->ion_auth->in_group('1')) {?>



                                <li @click="setDashMenuItem('edit_report',$event)">

                                    <a href="edit_report" class="waves-effect">

                                        <i class="mdi mdi-file-document-box"></i>

                                        <span> Edit Reports </span>

                                    </a>

                                </li>







                                <li @click="setDashMenuItem('equipment',$event)">

                                    <a href="equipment" class="waves-effect">

                                        <i class="mdi mdi-file-document-box"></i>

                                        <span> Equipments </span>

                                    </a>

                                </li>



                                <li @click="setDashMenuItem('users',$event)">

                                    <a href="users" class="waves-effect">

                                        <i class="mdi mdi-account-multiple"></i>

                                        <span> Users </span>

                                    </a>

                                </li>



                                <?php }?>

                            </ul>

                        </div>

                        <!-- Sidebar -->

                        <div class="clearfix"></div>

                    </div>

                    <!-- Sidebar -left -->

                </div>

                            <!-- Left Sidebar End -->