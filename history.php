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

//the zip of code of the location
if(!isset($_GET['zip'])){
	header("Location: http://localhost/error.html");
	die();
}
$zip=$_GET['zip'];

//get the result 
$data = sparql_get( "http://localhost:3030/History/query",
	"PREFIX Loc: <http://localhost/Ontology/Location.owl#>
	 PREFIX Temp: <http://localhost/Ontology/Temperature.owl#>
         PREFIX Wind: <http://localhost/Ontology/Wind.owl#>
	 PREFIX Prec: <http://localhost/Ontology/Precipitation.owl#>
SELECT DISTINCT   ?UniCode  ?temp_c ?precip_today_metric ?relative_humidity  where {?predicate Loc:ZipCode \"".$zip."\" . ?predicate Loc:UniCode ?UniCode . ?predicate Temp:temp_c ?temp_c . ?predicate Wind:relative_humidity ?relative_humidity  . ?predicate 
Prec:precip_today_metric ?precip_today_metric}" );

//redirect to error.html if $data is empty

if(sizeof($data)==0){
	header("Location: http://localhost/error.html");
	die();
}


//put the result into table

$table=array();
foreach($data as $row){
	$arr=array();
        foreach( $data->fields() as $field )
        {
                array_push($arr,$row[$field]);
 
        }
	array_push($table,$arr);
}
$temp=array();
$precip=array();
$humidity=array();
for($i=0;$i<sizeof($table);$i++){
	
	if($table[$i][1]!=="N/A"){
	
		array_push($temp,[6-$i,$table[$i][1]]);
	}

	if($table[$i][2]=="N/A" || $table[$i][2]=="-9999.0"){
		array_push($precip,[6-$i,0]);
	}else {
		array_push($precip,[6-$i,$table[$i][2]]);
	}
	$year=substr($table[6-$i][0], strlen ($table[6-$i][0])-8, 4); 
	$month=substr($table[6-$i][0], strlen ($table[6-$i][0])-4, 2);
	$day=substr($table[6-$i][0], strlen ($table[6-$i][0])-2, 2);
	

	if($table[$i][3]!=="N/A"){
		array_push($humidity,[$day."/".$month."/".$year,$table[6-$i][3]]);	
	}else {
		
		array_push($humidity,[$day."/".$month."/".$year,0]);
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
              <input type="text" name="city" class="form-control" placeholder="Search..."/>
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
            History
            <small>Charts Analysis</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href=<?php echo "\"history.php?zip=".$zip."\"";?>><i class="fa fa-pie-chart"></i> History </a></li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

          <!-- Your Page Content Here -->
		       <div class="box box-primary">
                <div class="box-header with-border">
                  <i class="fa fa-sun-o"></i>
                  <h3 class="box-title">Temperature</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <div class="box-body">
                  <div id="line-chart" style="height: 300px;"></div>
                </div><!-- /.box-body-->
              </div>
			  
			   <div class="box box-primary">
                <div class="box-header with-border">
                  <i class="fa fa-cloud"></i>
                  <h3 class="box-title">Precipitation</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <div class="box-body">
                  <div id="area-chart" style="height: 338px;" class="full-width-chart"></div>
                </div><!-- /.box-body-->
              </div><!-- /.box -->

			  
			   <div class="box box-primary">
                <div class="box-header with-border">
                  <i class="fa  fa-umbrella"></i>
                  <h3 class="box-title">Relative humidity</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <div class="box-body">
                  <div id="bar-chart" style="height: 300px;"></div>
                </div><!-- /.box-body-->
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
	 <script src="plugins/flot/jquery.flot.min.js" type="text/javascript"></script>
    <!-- FLOT RESIZE PLUGIN - allows the chart to redraw when the window is resized -->
    <script src="plugins/flot/jquery.flot.resize.min.js" type="text/javascript"></script>
    <!-- Optionally, you can add Slimscroll and FastClick plugins.
          Both of these plugins are recommended to enhance the
          user experience. Slimscroll is required when using the
          fixed layout. -->
      <script src="plugins/flot/jquery.flot.categories.min.js" type="text/javascript"></script>
		  <script type="text/javascript">
		   $(function () {
	//create table of data
	var temp1=<?php echo json_encode( $temp ) ?>;
	var precip1=<?php echo json_encode($precip)?>;
	var humidity1=<?php echo json_encode($humidity)?>;
	var data=<?php echo json_encode($table)?>;
	
	var dat1=[];
	for(var count=0;count<7;count++){
		var year=data[6-count][0].substr(data[6-count][0].length-8,4);
		var month=data[6-count][0].substr(data[6-count][0].length-4,2);
		var day=data[6-count][0].substr(data[6-count][0].length-2);
		dat1.push(day+"/"+month+"/"+year);
		if(humidity1[count][1]=="N/A"){
			humidity1[count][1]=0;	
			console.log(humidity1[count][1]);	
		}
	}
	
        var line_data1 = {
          data: temp1,
          color: "#3c8dbc"
        };
        $.plot("#line-chart", [line_data1], {
          grid: {
            hoverable: true,
            borderColor: "#f3f3f3",
            borderWidth: 1,
            tickColor: "#f3f3f3"
          },
          series: {
            shadowSize: 0,
            lines: {
              show: true
            },
            points: {
              show: true
            }
          },
          lines: {
            fill: false,
            color: ["#3c8dbc", "#f56954"]
          },
          yaxis: {
            show: true,
          },
          xaxis: {
            show: true
          }
        });
        //Initialize tooltip on hover
        $("<div class='tooltip-inner' id='line-chart-tooltip'></div>").css({
          position: "absolute",
          display: "none",
          opacity: 0.8
        }).appendTo("body");
        $("#line-chart").bind("plothover", function (event, pos, item) {

          if (item) {
            var x = item.datapoint[0].toFixed(0),
                y = item.datapoint[1].toFixed(1);

            $("#line-chart-tooltip").html(dat1[x]+" : " + y)
                    .css({top: item.pageY + 5, left: item.pageX + 5})
                    .fadeIn(200);
          } else {
            $("#line-chart-tooltip").hide();
          }

        });
		      
        $.plot("#area-chart", [precip1], {
          grid: {
            borderWidth: 0
          },
          series: {
            shadowSize: 1, // Drawing is faster without shadows
            color: "#00c0ef"
          },
          lines: {
            fill: true //Converts the line chart to area chart
          },
          yaxis: {
            show: false
          },
          xaxis: {
            show: false
          }
        });

		 var bar_data = {
          data:humidity1 ,
          color: "#3c8dbc"
        };
        $.plot("#bar-chart", [bar_data], {
          grid: {
            borderWidth: 1,
            borderColor: "#f3f3f3",
            tickColor: "#f3f3f3"
          },
          series: {
            bars: {
              show: true,
              barWidth: 0.5,
              align: "center"
            }
          },
          xaxis: {
            mode: "categories",
            tickLength: 0
          }
        });
		});
		
		
		  </script>
  </body>
</html>
