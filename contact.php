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

// Pear Mail Library
require_once "scripts/mail/Mail.php";

function sendmail(){
$from = '<SenderLinkedWUPS2015@gmail.com>';
$to = '<receiverlinkedwups2015@gmail.com>';
$subject="Notification";
if(!isset($_POST['emailto'])){
	$sender="Nothing";
}else if($_POST['emailto']==""){

	$sender="Nothing";
}else {
	$sender=$_POST['emailto'];
}

if(!isset($_POST['subject'])){
	$object="Nothing";
}else if($_POST['subject']==""){

	$object="Nothing";
}else {
	$object=$_POST['subject'];
}

if(!isset($_POST['body'])){
	$mail="Nothing";
}else if($_POST['body']==""){

	$mail="Nothing";
}else {
	$mail=$_POST['body'];
}

$body = "Sender:".$sender."\n\n"."Object:".$object."\n\n"."Body:".$mail;

$headers = array(
    'From' => $from,
    'To' => $to,
    'Subject' => $subject
);

$smtp = Mail::factory('smtp', array(
        'host' => 'ssl://smtp.gmail.com',
        'port' => '465',
        'auth' => true,
        'username' => 'SenderLinkedWUPS2015@gmail.com',
        'password' => 'motdepasse2015'
    ));

$mail = $smtp->send($to, $headers, $body);

if (PEAR::isError($mail)) {
    
} else {
 
}
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
              <input type="text" name="city" class="form-control" placeholder="Search..." id="city"/>
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
                <i class="fa fa-dashboard"></i> <span>Home</span>
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
          Information
            <small>about us</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="contact.php"><i class="fa fa-envelope"></i> Contact us </a></li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
		    <div class="row">
			<div class="col-md-6">
              <div class="box box-solid">
                <div class="box-header with-border">
                </div><!-- /.box-header -->
                <div class="box-body">
                  <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                      <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                      <li data-target="#carousel-example-generic" data-slide-to="1" class=""></li>
                      <li data-target="#carousel-example-generic" data-slide-to="2" class=""></li>
                    </ol>
                    <div class="carousel-inner">
                      <div class="item active">
                        <img src="img/Project.png" style="height:300px; margin-left: auto;
    margin-right: auto;"alt="First slide">
                        <div class="carousel-caption">
                        </div>
                      </div>
                      <div class="item">
                        <img src="img/wunderground.png" style="height:300px; margin-left: auto;
    margin-right: auto;"alt="Second slide">
                        <div class="carousel-caption">
				
                        </div>
                      </div>
                      <div class="item">
                        <img src="img/Ontology.png" style="height:300px; margin-left: auto;
    margin-right: auto;"alt="Third slide">
                        <div class="carousel-caption">
                      
                        </div>
                      </div>
                    </div>
                    <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                      <span class="fa fa-angle-left"></span>
                    </a>
                    <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                      <span class="fa fa-angle-right"></span>
                    </a>
                  </div>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
			 <div class="col-md-6">
              <div class="box box-solid">
                <div class="box-header with-border">
                  <h3 class="box-title">Information</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <div class="box-group" id="accordion">
                    <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
                    <div class="panel box box-primary">
                      <div class="box-header with-border">
                        <h4 class="box-title">
                          <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                            Project
                          </a>
                        </h4>
                      </div>
                      <div id="collapseOne" class="panel-collapse collapse in">
                        <div class="box-body">
                          Linked WUPS is an open initiative of the <a href="http://www.uni-passau.de/"><strong>University Of Passau</strong></a> and the <a href="http://www.supcom.mincom.tn/"><strong>Higher School of Communication of Tunis</strong></a> whose aim is to enrich the Web of Data with  geospatial data. This initiative started off by publishing diverse information sources belonging to the <a href="http://www.wunderground.com/"><strong>Weather Underground Website</strong></a>. Such sources are made available as RDF (Resource Description Framework) knowledge bases according to the Linked Data principles.
                        </div>
                      </div>
                    </div>
                    <div class="panel box box-danger">
                      <div class="box-header with-border">
                        <h4 class="box-title">
                          <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                            Meteorological information
                          </a>
                        </h4>
                      </div>
                      <div id="collapseTwo" class="panel-collapse collapse">
                        <div class="box-body">
                          Linked WUPS Data contains 10 minute data from around 430 weather stations of <a href="http://www.wunderground.com/"><strong>Weather Underground</strong></a> Stations Network. Observational data are always referred to Universal Coordinated Time (UTC)
                        </div>
                      </div>
                    </div>
                    <div class="panel box box-success">
                      <div class="box-header with-border">
                        <h4 class="box-title">
                          <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                            Models
                          </a>
                        </h4>
                      </div>
                      <div id="collapseThree" class="panel-collapse collapse">
                        <div class="box-body">
 The aim of the <a href="Ontology.zip"><strong>Linked WUPS ontology network </strong></a>is to represent knowledge related to measurements made by the network of meteorological stations of <a href="http://www.wunderground.com/"><strong>Weather Underground Website</strong></a>. Each of these measurements represents the state of the atmosphere (humidity, pressure, temperature, wind, etc.) in a particular place and time and is conducted through the sensor equipped with each weather station. 
                        </div>
                      </div>
                    </div>
                  </div>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
            
          </div><!-- /.row -->
          <!-- END ACCORDION & CAROUSEL-->
<!--mail box-->
             <div class="box box-info">
                <div class="box-header">
                  <i class="fa fa-envelope"></i>
                  <h3 class="box-title">Email</h3>
                  <!-- tools box -->
                </div>
                <div class="box-body">
                  <form method="post" action="scripts/mail.php"  id="form">
                    <div class="form-group">
                      <input type="email" class="form-control" name="emailto" placeholder="Email from:"/>
                    </div>
                    <div class="form-group">
                      <input type="text" class="form-control" name="subject" placeholder="Subject" />
                    </div>
                    <div>
                      <textarea class="textarea" placeholder="Message" style="width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" name="body" id="body"></textarea>
                    </div>
                  </form>
                </div>
                <div class="box-footer clearfix">
                  <button  class="pull-right btn btn-default" id="sendEmail" >Send <i class="fa fa-arrow-circle-right"></i></button>
                </div>
              </div>

		  

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
    <script type="text/javascript">
    $('#sendEmail').click(function(){
	document.getElementById("form").submit();
	alert("your message has been sent.We will contact you soon");
	});
    </script>
  </body>
</html>
