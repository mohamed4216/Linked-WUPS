<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
  <head>
    <meta charset="UTF-8">
    <title>Linked WUPS</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.4 -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. We have chosen the skin-blue for this starter page.-->
    <link href="dist/css/skins/skin-blue.min.css" rel="stylesheet" type="text/css" />
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  </head>
  <body class="skin-blue sidebar-mini">
  <?php
	//charge the php library for semantic web
require_once( "scripts/sparqllib.php" ); 
	if(!isset($_GET['zip'])){
		header("Location: http://localhost/error.html");
		die();
	}
	$zip=$_GET['zip'];
	$data = sparql_get( "http://localhost:3030/Observation/query",
	"PREFIX Loc: <http://localhost/Ontology/Location.owl#>
	 SELECT DISTINCT   ?full  where {?predicate Loc:ZipCode \"".$zip."\" . ?predicate Loc:full ?full }" );
	if(sizeof($data)==0){
		header("Location: http://localhost/error.html");
		die();
	}
  ?>
    <div class="wrapper">

      <!-- Main Header -->
      <header class="main-header">

        <!-- Logo -->
        <a href="index.php" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini">LIWU</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg">Linked WUPS</span>
        </a>

        <!-- Header Navbar -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
            </ul>
          </div>
        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">

        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- search form (Optional) -->
          <form action="scripts/search.php" method="get" class="sidebar-form">
            <div class="input-group">
              <input type="text" name="city" class="form-control" placeholder="Search..." id="search.php"/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
          </form>
          <!-- /.search form -->

          <!-- Sidebar Menu -->
          <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <!-- Optionally, you can add icons to the links -->
             <li class="active"> 
          <a href="index.php">
                <i class="fa fa-th"></i> <span>Home</span>
          </a>
		 </li>
			   <li class="active"> 
          <a href=<?php echo "\"forecast.php?zip=".$zip."\"";?>>
                <i class="fa fa-th"></i> <span>Forecast</span>
          </a>
		 </li>
        <li class="active"> 
              <a href=<?php echo "\"history.php?zip=".$zip."\"";?>>
                <i class="fa fa-pie-chart"></i>
                <span>History</span>
              </a>
               </li> 
        <li class="active">
			 <a href="sparql.html">
                <i class="fa fa-laptop"></i>
                <span>Sparql endpoint</span>
              </a>
		</li>
		<li class="active">
			<a href="contact.php">
                <i class="fa fa-envelope"></i> <span>Contact Us</span>
              </a>
		</li>
          </ul><!-- /.sidebar-menu -->
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Forecast
            <small>Description</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href=<?php echo "\"forecast.php?zip=".$zip."\"";?>><i class="fa fa-th"></i> forecast </a></li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

          <!-- Your Page Content Here -->
		  <iframe  src=<?php echo "result.php?zip=".$zip;?> style="width:100%;height:500px;">
  <p>Your browser does not support iframes.</p>
</iframe>

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <!-- Main Footer -->
      <footer class="main-footer">
        <!-- To the right -->
        <div class="pull-right hidden-xs">
         
        </div>
        <!-- Default to the left -->
        <strong>Copyright &copy; 2015 <a href="http://www.uni-passau.de/">University of Passau</a>.</strong> All rights reserved.
      </footer>
      
      <!-- Control Sidebar -->      
     
    </div><!-- ./wrapper -->

    <!-- REQUIRED JS SCRIPTS -->

    <!-- jQuery 2.1.4 -->
    <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/app.min.js" type="text/javascript"></script>

    <!-- Optionally, you can add Slimscroll and FastClick plugins.
          Both of these plugins are recommended to enhance the
          user experience. Slimscroll is required when using the
          fixed layout. -->
  </body>
</html>

