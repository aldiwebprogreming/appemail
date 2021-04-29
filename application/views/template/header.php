<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title><?= $title ?></title>

        <!-- Bootstrap Core CSS -->
        <link href="<?= base_url() ?>assets/css/bootstrap.min.css" rel="stylesheet">

        <!-- MetisMenu CSS -->
        <link href="<?= base_url() ?>assets/css/metisMenu.min.css" rel="stylesheet">

        <!-- DataTables CSS -->
        <link href="<?= base_url() ?>assets/css/dataTables/dataTables.bootstrap.css" rel="stylesheet">

        <!-- DataTables Responsive CSS -->
        <link href="<?= base_url() ?>assets/css/dataTables/dataTables.responsive.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="<?= base_url() ?>assets/css/startmin.css" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="<?= base_url() ?>assets/css/font-awesome.min.css" rel="stylesheet" type="text/css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>

        <div id="wrapper">

            <!-- Navigation -->
            <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation" style="background-color: blue">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#" style="color: white;">App <strong>Email</strong></a>
                </div>

                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

               <!--  <ul class="nav navbar-nav navbar-left navbar-top-links">
                    <li><a href="#"><i class="fa fa-home fa-fw"></i> Website</a></li>
                </ul> -->

                <ul class="nav navbar-right navbar-top-links">
                    
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-user fa-fw" style="color: white;"></i>  <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li><a href="<?= base_url('login/logout') ?>"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <!-- /.navbar-top-links -->

                <div class="navbar-default sidebar" role="navigation">
                    <div class="sidebar-nav navbar-collapse">
                        <ul class="nav" id="side-menu">
                            <li class="sidebar-search">
                                <div class="input-group custom-search-form">
                                    <input type="text" class="form-control" placeholder="Search...">
                                    <span class="input-group-btn">
                                        <button class="btn btn-primary" type="button">
                                            <i class="fa fa-search"></i>
                                        </button>
                                </span>
                                </div>
                                <!-- /input-group -->
                            </li>
                            <li>
                                <a href="<?= base_url('home') ?>" class="active"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                            </li>
                            
                            <li>
                                <a href="<?= base_url('data-buyer') ?>"><i class="fa fa-table fa-fw"></i> Data Buyer</a>
                            </li>
                            <li>
                                <a href="<?= base_url('data-ultah') ?>"><i class="fa fa-edit fa-fw"></i> Data Birth Date</a>
                            </li>

                            <li>
                                <a href="<?= base_url('data-send') ?>"><i class="fa fa-edit fa-send"></i> Data Send Email</a>
                            </li>
                            
                            
                            
                        </ul>
                    </div>
                </div>
            </nav>



