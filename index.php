 <!DOCTYPE html>
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
	<link rel="stylesheet" href="css/jquery-jvectormap-1.2.2.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="css/pace-theme-flash.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="css/style.css" type="text/css" media="screen" />
  </head>
  <body class="skin-blue sidebar-mini">
    <?php 
	
	//charge the semantic library
	require_once( "scripts/sparqllib.php" ); 
	
	//the query to select position(latitude,longitude)
	$data = sparql_get( 
		"http://localhost:3030/Location/query",
		"PREFIX movie: <http://localhost/Ontology/Location.owl#>
	SELECT   ?latitude ?longitude ?ZipCode  ?full where {?predicate movie:full ?full . ?predicate movie:latitude ?latitude .?predicate 		movie:longitude ?longitude .?predicate movie:ZipCode ?ZipCode}" );
	
	//put the data into an array
	$tab=array();
	
	//verify if the result is null or not
	if(isset($data)){
	foreach( $data as $row ){
		$arr=array();
		foreach( $data->fields() as $field ){
			array_push($arr,$row[$field]);
		}
		array_push($tab,$arr);
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
          <a  class="sidebar-toggle" data-toggle="offcanvas" role="button">
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
            Home
            <small>Principal Page</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Home </a></li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
        <!--map-->
        <div id="map-container">
			 <div class="controller"  >
                <a href="javascript:;" class="reload"  ></a>
            </div>
            <div id="map" style="width:118%;height:100%;" ></div>
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
	<!-- jvectormap -->
	<script type="text/javascript" src="js/jquery-jvectormap-1.2.2.min.js"></script>
	<script type="text/javascript" src="js/jquery-jvectormap-world-mill-en.js"></script>
	<script type="text/javascript" src="js/jquery-jvectormap-data-malaysia-aea-en.js"></script>
	<!-- blockUI -->
	<script type="text/javascript" src="js/jquery-blockui.js"></script>
	<!-- pace -->
	<script type="text/javascript" src="js/pace.min.js"></script>
	<script type="text/javascript">
	 function initMap() {
	//create table of data
	var table=<?php echo json_encode( $tab ) ?>;
	
        // plot marker on map by latitude & longitude
        var markers_data = [];
      	//initiation of the array
		for(i=0;i<table.length;i++){
			markers_data.push({latLng: [table[i][0], table[i][1]]});
		
		}
		// show the size of marker
		var location_area_data = [];

		//initiation of the array location_arrea_data
		for(i=0;i<table.length;i++){
			location_area_data.push(49.1);
		}
		$('#map').vectorMap({
            map: 'world_mill_en',
            scaleColors: ['#C8EEFF', '#0071A4'],
            normalizeFunction: 'polynomial',
            zoomOnScroll:false,
            zoomMin:1.5,
			
            hoverColor: false,
            regionStyle:{
                initial: {
                    fill: '#a5ded9',
                    "fill-opacity": 1,
                    stroke: '#a5ded9',
                    "stroke-width": 0,
                    "stroke-opacity": 0
                },
                hover: {
                    "fill-opacity": 0.8
                },
                selected: {
                    fill: 'yellow'
                },
                selectedHover: { }
            },
            markerStyle: {
                initial: {
                    fill: '#f35958',
                    stroke: '#f35958',
                    "fill-opacity": 1,
                    "stroke-width": 6,
                    "stroke-opacity": 0.5,
                    r: 3
                },
                hover: {
                    stroke: 'black',
                    "stroke-width": 2
                },
                selected: {
                    fill: 'blue'
                },
                selectedHover: { }
            },
            backgroundColor: '#ffffff',
            markers : markers_data,
            series: {
                markers: [{
                    attribute: 'r',
                    scale: [3, 7],
                    values: location_area_data
                }]
            },
            onMarkerLabelShow: function(event, label, index){
                var text=table[index][3];
                label.html(text);
            },
            onRegionLabelShow: function(event, label, code) {
                var text = label.text();
                label.html(text);
            },
            onRegionClick: function(event, code) {
                console.log('Country ' + code + ' clicked');
            },
	    onMarkerClick: function(events, index) {
                      window.location.href='forecast.php?zip='+table[index][2];
                  }
        });
    }

    initMap();


    $('.controller .reload').click(function () { 
        var el =$(this).parent().parent().parent();
        blockUI(el);
          window.setTimeout(function () {
               unblockUI(el);
            }, 1000);
    });
    $('.controller .remove').click(function () {
        $(this).parent().parent().hide(1000);
    });

    // show spinner
    function blockUI(el) {
        $(el).block({
            message: '<div class="loading-animator"></div>',
            css: {
                border: 'none', padding: '2px',
                backgroundColor: 'none'
            },
            overlayCSS: {
                backgroundColor: '#fff',
                opacity: 0.3,
                cursor: 'wait'
            }
        });
    }
    function unblockUI(el) {
        $(el).unblock();
    }
	</script>
</body>
</html>
