<?php
//this script used for quering the dataset 
require_once( "scripts/sparqllib.php" );

//this script to transform an array to an xml file
include("scripts/array2xml.php");

//the default value of our dataset
$sparql_end_point="http://localhost:3030/Location/query";

//verify if the user set the value of dataset
if($_GET['dataset']!==""){
	$sparql_end_point="http://localhost:3030/".$_GET['dataset']."/query";
}

//the syntax of the query to process
$query=$_GET['query'];

//processing the query and get the results
$data = sparql_get($sparql_end_point, $query);
	
//verify the result :if empty or not 
if( !isset($data) ){
	//show the 404 not found page
	print 	'<!DOCTYPE html>
	<!--
	This is a starter template page. Use this page to start your new project from
	scratch. This page gets rid of all links and provides the needed markup only.
	-->
	<html>
  	<head>
    	<meta charset="UTF-8">
    	<title>Linked WUPS</title>
    	<!-- Tell the browser to be responsive to screen width -->
    	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
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
  	</head>
  	<body class="skin-blue sidebar-mini">
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
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
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
            	Problem
          	</h1>
         	<ol class="breadcrumb">
            	<li><a href="sparql.html"><i class="fa fa-laptop"></i> sparql endpoint </a></li>
          	</ol>
        	</section>

        <!-- Main content -->
        <section class="content">

          <!-- Your Page Content Here -->
	
          <div class="error-page">
            <h2 class="headline text-yellow"> 404</h2>
            <div class="error-content">
              <h3><i class="fa fa-warning text-yellow"></i> Oops! Page not found.</h3>
              <p>
                We could not find the page you were looking for.
                Meanwhile, you may <a href="index.html">return to the main page</a> 
              </p>
            </div><!-- /.error-content -->
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
      
      	<!-- Control Sidebar -->      
      	<aside class="control-sidebar control-sidebar-dark">                
        <!-- Create the tabs -->
        <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
          	<li class="active"><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
          	<li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
        </ul>
        <!-- Tab panes -->
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
	</html>';
}else{

	//the format of our result depends on our variable format
	if($_GET['format']=="HTML"){

		//show the html page which contains an array of our variables
		print '<!DOCTYPE html><!--
		This is a starter template page. Use this page to start your new project from
		scratch. This page gets rid of all links and provides the needed markup only.
		-->
		<html>
  		<head>
    		<meta charset="UTF-8">
    		<title>Linked WUPS</title>
    		<!-- Tell the browser to be responsive to screen width -->
    		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
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
		<link href="plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
  		</head>
  		<body class="skin-blue sidebar-mini">
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
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
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
            		Results
          	</h1>
          	<ol class="breadcrumb">
            	<li><a href="sparql.html"><i class="fa fa-laptop"></i> Sparql endpoint </a></li>
            	<li class="active">results</li>
          	</ol>
        	</section>

        	<!-- Main content -->
        	<section class="content">

          	<!-- Your Page Content Here -->
		  
              	<div class="box">
                <div class="box-header">
                  <h3 class="box-title">Query result</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>';

		//read the headers of our results 
		foreach( $data->fields() as $field ){
			print " <th>".$field."</th>";
		}

		print  "</tr>";
		print "</thead>";
		print "<tbody>";
		

		//print the content of our array
		foreach( $data as $row ){
			
			//print the row of our array
			print "<tr>";
			
			//print the column of our array
			foreach( $data->fields() as $field ){
				print "<td>".$row[$field]."</td>";
			}
			
			print "</tr>";
		}

		//print the rest of our page
		print '</table>
                </div><!-- /.box-body -->
              	</div><!-- /.box -->
            

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
     		<script src="plugins/datatables/jquery.dataTables.min.js" type="text/javascript"></script>
    		<script src="plugins/datatables/dataTables.bootstrap.min.js" type="text/javascript"></script>
		<script type="text/javascript">
     		 $(function () {
       		 $("#example1").DataTable();
       
      		});
    		</script>
  		</body>
		</html>';
	}elseif ($_GET['format']=="JSON"){
	
		//create the json file 
		$filename = "sparql.json";
		$f = fopen($filename, 'w');

		//put the array into the json file
		//first  put the headers
		$keys=array();
         	foreach( $data->fields() as $field ){
                	array_push($keys,$field);
        	}
		
		//then put the values of the array 
		$tab=array();
		foreach( $data as $row ){
        		$arr=array();
        		foreach( $data->fields() as $field ){
                		array_push($arr,$row[$field]);
        		}
        	 	array_push($tab,array_combine($keys, $arr));
		}

		fwrite($f, json_encode($tab));
		fclose($f);
		
		//download the file (sparql.json)
		header("Cache-Control: public");
		header("Content-Description: File Transfer");
		header("Content-Length: ". filesize("$filename").";");
		header("Content-Disposition: attachment; filename=$filename");
		header("Content-Type: application/octet-stream; "); 
		header("Content-Transfer-Encoding: binary");
		readfile($filename);
	}elseif ($_GET['format']=="XML"){
		//the file name (sparql.xml)
		$filename = "sparql.xml";

		//creating object of SimpleXMLElement
		$xml_user_info = new SimpleXMLElement("<?xml version=\"1.0\"?><root></root>");

		//function call to convert array to xml format
		$keys=array();
	 	foreach( $data->fields() as $field ){
                	array_push($keys,$field);
        	}
		
		//read the result and put it into an array
		$tab=array();
		foreach( $data as $row ){
        		$arr=array();
        		foreach( $data->fields() as $field ){
                		array_push($arr,$row[$field]);
        		}
        		array_push($tab,array_combine($keys, $arr));
		}
		
		//transform an array to an xml format
		array_to_xml($tab,$xml_user_info);

		//saving generated xml file
		$xml_file = $xml_user_info->asXML($filename);	
		header("Cache-Control: public");
       		header("Content-Description: File Transfer");
        	header("Content-Length: ". filesize("$filename").";");
        	header("Content-Disposition: attachment; filename=$filename");
        	header("Content-Type: application/octet-stream; "); 
        	header("Content-Transfer-Encoding: binary");
        	readfile($filename);

	}elseif ($_GET['format']=="CSV"){
		
		//the name of csv file
		$filename="sparql.csv";
	
		//creating the file
		$fp = fopen($filename, 'w');
		
		//put the data in an array
		$tab=array();
		foreach( $data->fields() as $field ){
                	array_push($tab,$field);
        	}
		
		fputcsv($fp,$tab);
		foreach( $data as $row) {
        		$arr=array();
        		foreach( $data->fields() as $field ){
                		array_push($arr,$row[$field]);
               		}
        	fputcsv($fp, $arr);
		}
		fclose($fp);

		//download csv file 
		header("Cache-Control: public");
        	header("Content-Description: File Transfer");
        	header("Content-Length: ". filesize("$filename").";");
        	header("Content-Disposition: attachment; filename=$filename");
        	header("Content-Type: application/octet-stream; "); 
        	header("Content-Transfer-Encoding: binary");
        	readfile($filename);
	}

}
?>
