<!DOCTYPE html>
<!-- saved from url=(0090)http://www.wunderground.com/cgi-bin/findweather/getForecast?query=London%2C+United+Kingdom -->
<html>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
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
$data = sparql_get( "http://localhost:3030/Observation/query",
	"PREFIX Loc: <http://localhost/Ontology/Location.owl#>
	 PREFIX Temp: <http://localhost/Ontology/Temperature.owl#>
     PREFIX Wind: <http://localhost/Ontology/Wind.owl#>
	 PREFIX Prec: <http://localhost/Ontology/Precipitation.owl#>
	 PREFIX Wea: <http://localhost/Ontology/Weather.owl#>
	 PREFIX Time: <http://localhost/Ontology/Time.owl#>
	 PREFIX Yester: <http://localhost/Ontology/Yesterday.owl#>
	 PREFIX Astro: <http://localhost/Ontology/Astronomy.owl#>
SELECT DISTINCT   ?full  ?Hour ?Minute ?Elevation ?latitude ?longitude ?temp_c ?high ?low ?heat_index_c ?windchill_c ?dewpoint_c ?feelslike_c ?wind_degrees 
?wind_dir ?wind_kph ?wind_gust_kph ?pressure_mb ?pressure_trend ?relative_humidity ?prob_of_precip ?rainfall ?snow_depth ?precip_today_metric ?precip_1hr_metric 
?visibility_km ?icon ?icon_url ?temp  ?max ?min ?rain ?sunrise_hour ?sunrise_minute ?sunset_hour ?sunset_minute ?moon_phase ?visible where {?predicate Loc:ZipCode \"".$zip."\" . ?predicate Loc:full ?full . 
?predicate Time:Hour ?Hour . ?predicate Time:Minute ?Minute . ?predicate Loc:Elevation ?Elevation . ?predicate Loc:latitude ?latitude . ?predicate Loc:longitude 
?longitude . ?predicate Temp:temp_c ?temp_c . ?predicate Temp:high ?high . ?predicate Temp:low ?low . ?predicate Temp:heat_index_c ?heat_index_c . ?predicate Temp:windchill_c 
?windchill_c . ?predicate Temp:dewpoint_c ?dewpoint_c . ?predicate Temp:feelslike_c ?feelslike_c . ?predicate Wind:wind_degrees ?wind_degrees . ?predicate Wind:wind_dir 
?wind_dir . ?predicate Wind:wind_kph ?wind_kph . ?predicate Wind:wind_gust_kph ?wind_gust_kph . ?predicate Wind:pressure_mb ?pressure_mb . ?predicate Wind:pressure_trend ?pressure_trend . 
?predicate Wind:relative_humidity ?relative_humidity . ?predicate Prec:prob_of_precip ?prob_of_precip . ?predicate Prec:rainfall ?rainfall . ?predicate Prec:snow_depth ?snow_depth . ?predicate 
Prec:precip_today_metric ?precip_today_metric . ?predicate Prec:precip_1hr_metric ?precip_1hr_metric . ?predicate Wea:visibility_km ?visibility_km . ?predicate Wea:icon ?icon 
. ?predicate Wea:icon_url ?icon_url . ?predicate Yester:temp ?temp . ?predicate Yester:max ?max . ?predicate Yester:min ?min . ?predicate Yester:rain ?rain
. ?predicate Astro:sunrise_hour ?sunrise_hour . ?predicate Astro:sunrise_minute ?sunrise_minute . ?predicate Astro:sunset_hour ?sunset_hour . ?predicate Astro:sunset_minute ?sunset_minute
    . ?predicate Astro:moon_phase ?moon_phase . ?predicate Astro:visible ?visible}" );


//put the result into table
foreach($data as $row){
	$arr=array();
        foreach( $data->fields() as $field )
        {
                array_push($arr,$row[$field]);
 
        }
}

?>
<title><?php echo $arr[0];?>, Forecast | Weather Underground PS</title>
<link rel="stylesheet" href="http://style.wxug.com/css/wu4/core.css?v=2015042001">
<link rel="stylesheet" href="http://style.wxug.com/css/wu4/omnibus.css?v=2015062602">
<style>
		.tabs a{
			cursor: pointer;
			padding: 5px;
			background: #fff;
			color: #000;
			border: 1px solid #666;
			border-bottom: 0;
		}
		.tabs a:hover, .tabs a.active{
			background: #666;
			color: #fff;
		}

		.tabContent{
			border: 1px solid #aaa;
			margin: 4px 0;
			padding: 5px;
		}
</style>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script>
	$(document).ready(function(){
		$("#test").hide();
		$("#hide").click(function(){
			$("#test").hide();
			$("#hide").hide();
			$("#show").show();
			
		});
		$("#show").click(function(){
			$("#test").show();
			$("#hide").show();
			$("#show").hide();
    });
});
</script>
<script type="text/javascript">
	$.fn.html5jTabs = function(options){
		return this.each(function(index, value){
			var obj = $(this),
			objFirst = obj.eq(index),
			objNotFirst = obj.not(objFirst);
      
			$("#" +  objNotFirst.attr("data-toggle")).hide();
			$(this).eq(index).addClass("active");
      
			obj.click(function(evt){
        
				toggler = "#" + obj.attr("data-toggle");
				togglerRest = $(toggler).parent().find("div");
        
				togglerRest.hide().removeClass("active");
				$(toggler).show().addClass("active");

				//toggle Active Class on tab buttons
				$(this).parent("div").find("a").removeClass("active");
				$(this).addClass("active");

				return false; //Stop event Bubbling and PreventDefault
			});
		});
	};
</script>
<script type="text/javascript">
	$(function() {
		$(".tabs a").html5jTabs();
	});
</script>
<body>	
<div id="location">
	<h1 >
		<a onclick=<?php echo "\"window.top.location.href ='http://localhost/Resource/Location/id".$zip."'\"";?>><?php echo $arr[0];?></a>
	</h1>
	<div class="local-time"><i class="fi-clock"></i> <span><?php echo date ( 'h:i  A' )." ".date('F d,Y');?></span><?php echo " (GMT ".date('O').")"; ?></div>	
</div>

<div id="current" class="row">
	<div class="small-12 medium-6 large-4 columns cc1" id="cc1">
		<div class="row">
		<div class="small-12 columns">
		<h2>
		<span class="wx-data">
		<a onclick=<?php echo "\"window.top.location.href ='http://localhost/Resource/Observation/id".$zip."'\"";?>>Elev</a>
		<span class="wx-value"><?php  if($arr[3]=="N/A") echo "--";else echo number_format($arr[3]);?></span>
		<span class="wx-unit">m</span>
		</span>
		<span class="wx-data" >
		<span class="wx-data"><span class="wx-value"><?php if($arr[4]=="N/A") echo "--";else echo number_format($arr[4]);?></span>
		<span class="wx-unit">°N</span></span>,
		</span>
		<span class="wx-data">
		<span class="wx-data"><span class="wx-value"><?php if($arr[5]=="N/A") echo "--";else echo number_format($arr[5]);?></span>
		<span class="wx-unit">°W</span></span>
		</span>
		<span class="split">|</span>
		<a onclick=<?php echo "\"window.top.location.href ='http://localhost/Resource/Observation/id".$zip."'\"";?>>Updated</a>
		<span id="update-time"><?php if($arr[1]=="N/A" || $arr[2]=="N/A"){echo " 0 min ago";}else {$date=date('i');$dif1=$date-$arr[2];$dif2=date('H')-$arr[1];$result=$dif1+60*$dif2;echo $result." min ago";}?></span>
		</h2>
		</div>
		<div class="small-3 columns">
		<div id="curIcon"><img src=<?php echo"\"".$arr[27]."\"";?>  class="wx-data" ></div>
		<div id="curCond" class="wx-data"><span class="wx-value"><?php if($arr[26]=="N/A") echo "Not available";else echo $arr[26];?></span></div>
		</div>
		<div class="small-6 columns">
		<div id="curTemp" style="color: #fd843b;">
	<span class="wx-data" >
		<span class="wx-value"><a onclick=<?php echo "\"window.top.location.href ='http://localhost/Resource/Observation/id".$zip."'\"";?>><?php if($arr[6]=="N/A") echo "--";else echo $arr[6];?></a></span>
		<span class="wx-unit">°C</span>
	</span>
		</div>
		<div id="curFeel">
		<span class="wx-label"><a onclick=<?php echo "\"window.top.location.href ='http://localhost/Resource/Observation/id".$zip."'\"";?>>Feels Like</a></span>
		<span style="color: #fd843b;">
	<span class="wx-data" >
		<span class="wx-value"><?php if($arr[12]=="N/A") echo "--";else echo $arr[12];?></span>
		<span class="wx-unit">°C</span>
	</span>
		</span>
		</div>
		</div>
		<div class="small-3 columns">
		<div id="curWind">
		<div id="windCompassContainer">
		<div id="windCompass" class="wx-data" style="transform:rotate(270deg); -ms-transform:rotate(270deg); -webkit-transform:rotate(".<?php if($arr[13]=="N/A") echo "0";else echo $arr[13];?>."deg);">
		<div class="dial">
		<div class="arrow-direction"></div>
		</div>
		</div>
		<div id="windN">N</div>
		<div id="windCompassSpeed" class="wx-data" >
		<span class="wx-value"><a onclick=<?php echo "\"window.top.location.href ='http://localhost/Resource/Observation/id".$zip."'\"";?>><?php if($arr[15]=="N/A") echo "0";else echo $arr[15];?></a></span>
		</div>
		</div>
		</div>
		<div id="windDir">
		<span class="wx-data">
		<span class="is-variable">Wind Variable</span>
		<span class="not-variable">Wind from <span class="wx-value"><?php if($arr[14]=="N/A") echo "West";else echo $arr[14]; ?></span></span>
		</span>
		</div>
		</div>
		</div>
		<div id="precip-above" class="row precip-wrap precip-test">
		</div>
<div id="wx-quickie" class="wx-data">
	<p id="precip-inline">
	</p><p class="wx-value">Today is forecast to be <span class="b warmer"><?php if($arr[6]=="N/A" || $arr[28]=="N/A"){echo "the same";}else {if($arr[6]>$arr[28]) echo "warmer";else echo "colder";}?></span> than Yesterday.</p>
</div>
		<div class="row collapse" id="todaySummary">
	
	<div class="small-6 columns">
		<span class="today" ><a onclick=<?php echo "\"window.top.location.href ='http://localhost/Resource/Observation/id".$zip."'\"";?>>Today</a></span>
		<div>High <strong class="high"><?php if($arr[7]=="N/A") echo "--";else  echo $arr[7];?></strong> <span class="split">|</span> Low <strong class="low"><?php if($arr[8]=="N/A") echo "--";echo $arr[8];?></strong> °C</div>
		<div id="precip-link">
		
		<span class="pop" title="chance of precipitation"></span><strong><?php if($arr[20]=="N/A") echo "0";else echo $arr[20];?></strong>% Chance of Precip.
		
		</div>
	</div>
	<div class="small-6 columns">
		<a onclick=<?php echo "\"window.top.location.href ='http://localhost/Resource/Observation/id".$zip."'\"";?>>Yesterday</a>
		<div>High <strong class="high"><?php if($arr[29]=="N/A") echo "--";else  echo $arr[29];?></strong> <span class="split">|</span> Low <strong class="low"><?php if($arr[30]=="N/A") echo "--";else echo $arr[30];?></strong> °C</div>
		<div>
		Precip. <strong><?php if($arr[23]=="N/A") echo "0";else  echo $arr[23];?></strong> mm
		
		</div>
	</div>
</div>
		<div id="precip-below" class="row precip-wrap precip-test">
		</div>
		<div class="row collapse astronomy-data" id="curAstronomy">
		<div class="columns">
		<a onclick=<?php echo "\"window.top.location.href ='http://localhost/Resource/Observation/id".$zip."'\"";?>>Sun &amp; Moon</a>
		</div>
		<div class="small-6 columns sun">
		<span class="rise"><span class="astro-data" id="cc-sun-rise"><?php echo $arr[32].':'.$arr[33];?></span> <span class="ampm">AM</span></span>
		<span class="set"><span class="astro-data" id="cc-sun-set"><?php echo $arr[34].':'.$arr[35];?></span> <span class="ampm">PM</span></span>
		</div>
		<div class="small-6 columns moon">
		<div class="moonNorth">
		<span class="astro-data p-waxinggibbous" id="cc-moon-phase"></span>
		<strong><?php if($arr[36]!=="N/A")echo $arr[36].",";?></strong>
		<span class="nobr"><strong><?php if($arr[37]=="N/A") echo "50";else  echo $arr[37];?></strong>% visible</span>
		</div>
		</div>
		</div>
		<div class="ccDetails">
	
<p class="cc3-toggle">
	<a  class="cc3-toggle-show" id="show">More Conditions</a>
	<a  class="cc3-toggle-hide" id="hide">Fewer Conditions</a>
	<table id="test"><tr>
		<tr>
		<td><dfn><a onclick=<?php echo "\"window.top.location.href ='http://localhost/Resource/Observation/id".$zip."'\"";?>>Pressure</a></dfn></td>
		<td>
		<span class="pSteady">
	<span class="wx-data" >
		<?php if($arr[17]=="N/A") echo "<span class=\"wx-na\">Not available.</span>"; else echo "<span class=\"wx-value\">".$arr[17]."</span><span class=\"wx-unit\"> hPa</span>";?>
	</span>
		</span>
		</td>
	</tr>
	<tr>
		<td><dfn><a onclick=<?php echo "\"window.top.location.href ='http://localhost/Resource/Observation/id".$zip."'\"";?>>Visibility</a></dfn></td>
		<td>
	<span class="wx-data">
		<?php if($arr[25]=="N/A") echo "<span class=\"wx-na\">Not available.</span>";else echo "<span class=\"wx-value\">".$arr[25]."</span><span class=\"wx-unit\"> kilometers</span>";?></span>
	</span>
</td>
	</tr>
	<tr>
		<td><a onclick=<?php echo "\"window.top.location.href ='http://localhost/Resource/Observation/id".$zip."'\"";?>>Clouds</a></td>
		<td> 
<span class="wx-data" >
		<span class="wx-value">Few 121</span>
		<span class="wx-unit">m</span>
	</span>
</br> 
<span class="wx-data" >
		<span class="wx-value">Scattered Clouds 3352</span>
		<span class="wx-unit">m</span>
	</span>
</br>
<span class="wx-data" >
		<span class="wx-value">Mostly Cloudy 4572</span>
		<span class="wx-unit">m</span>
	</span>
		</td>
	</tr>
	<tr>
		<td><dfn><a onclick=<?php echo "\"window.top.location.href ='http://localhost/Resource/Observation/id".$zip."'\"";?>>Dew Point</a></dfn></td>
		<td>
	<span class="wx-data">
		<?php if($arr[11]=="N/A") echo "<span class=\"wx-na\">Not available.</span>";else echo "<span class=\"wx-value\">".$arr[11]."</span><span class=\"wx-unit\"> °C</span>";?>
	</span>
</td>
	</tr>
	<tr>
		<td><dfn><a onclick=<?php echo "\"window.top.location.href ='http://localhost/Resource/Observation/id".$zip."'\"";?>>Humidity</a></dfn></td>
		<td>
	<span class="wx-data">
		<?php if($arr[19]=="N/A") echo "<span class=\"wx-na\">Not available.</span>";else echo "<span class=\"wx-value\">".$arr[19]."</span>";?>
	</span>
</td>
	</tr>
	<tr>
		<td><a onclick=<?php echo "\"window.top.location.href ='http://localhost/Resource/Observation/id".$zip."'\"";?>>Rainfall</a></td>
		<td>
	<span class="wx-data">
		<?php if($arr[21]=="N/A") echo "<span class=\"wx-na\">Not available.</span>";else echo "<span class=\"wx-value\">".$arr[21]."</span><span class=\"wx-unit\">mm</span>";?>
	</span>
</td>
	</tr>
	<tr>
		<td><dfn><a onclick=<?php echo "\"window.top.location.href ='http://localhost/Resource/Observation/id".$zip."'\"";?>>Snow Depth</a></dfn></td>
		<td>
		<span class="wx-na"><?php if($arr[22]) echo "<span class=\"wx-na\">Not available.</span>";else echo $arr[22]; ?></span>
		</td>
	</tr>
	<tr>
		<td><a onclick=<?php echo "\"window.top.location.href ='http://localhost/Resource/Observation/id".$zip."'\"";?>>UV</a></td>
		<td><span class="wx-na">Not available.</span></td>
	</tr>
	<tr>
		<td><a onclick=<?php echo "\"window.top.location.href ='http://localhost/Resource/Observation/id".$zip."'\"";?>>Pollen</a></td>
		<td>
		<span class="wx-na">Not available.</span>
		</td>
	</tr>
		<tr>
		<td><a onclick=<?php echo "\"window.top.location.href ='http://localhost/Resource/Observation/id".$zip."'\"";?>>Air Quality</a></td>
		<td><span class="wx-na">Not available.</span></td>
		</tr>
	<tr>
		<td><a onclick=<?php echo "\"window.top.location.href ='http://localhost/Resource/Observation/id".$zip."'\"";?>>Flu Activity</a></td>
		<td>
		<span class="wx-na">Not available.</span>
		</td>
	</tr>
	<tr>
		<td colspan="2"><code>METAR EGLL 291750Z 27006KT 220V340 CAVOK 25/10 Q1021 NOSIG</code></td>
	</tr>
	</table>
</p>
		</div>
	</div>
	<div class="show-for-large-up large-3 columns cc2">
		<table cellpadding="0" cellspacing="0" class="cc3">
	<tbody><tr>
		<td><dfn><a onclick=<?php echo "\"window.top.location.href ='http://localhost/Resource/Observation/id".$zip."'\"";?>>Pressure</a></dfn></td>
		<td>
		<span class="pSteady">
	<span class="wx-data" >
		<?php if($arr[17]=="N/A") echo "<span class=\"wx-na\">Not available.</span>"; else echo "<span class=\"wx-value\">".$arr[17]."</span><span class=\"wx-unit\"> hPa</span>";?>
	</span>
		</span>
		</td>
	</tr>
	<tr>
		<td><dfn><a onclick=<?php echo "\"window.top.location.href ='http://localhost/Resource/Observation/id".$zip."'\"";?>>Visibility</a></dfn></td>
		<td>
	<span class="wx-data">
		<?php if($arr[25]=="N/A") echo "<span class=\"wx-na\">Not available.</span>";else echo "<span class=\"wx-value\">".$arr[25]."</span><span class=\"wx-unit\"> kilometers</span>";?></span>
	</span>
</td>
	</tr>
	<tr>
		<td><a onclick=<?php echo "\"window.top.location.href ='http://localhost/Resource/Observation/id".$zip."'\"";?>>Clouds</a></td>
		<td> 
<span class="wx-data" >
		<span class="wx-value">Few 121</span>
		<span class="wx-unit">m</span>
	</span>
</br> 
<span class="wx-data" >
		<span class="wx-value">Scattered Clouds 3352</span>
		<span class="wx-unit">m</span>
	</span>
</br>
<span class="wx-data" >
		<span class="wx-value">Mostly Cloudy 4572</span>
		<span class="wx-unit">m</span>
	</span>
		</td>
	</tr>
	<tr>
		<td><dfn><a onclick=<?php echo "\"window.top.location.href ='http://localhost/Resource/Observation/id".$zip."'\"";?>>Dew Point</a></dfn></td>
		<td>
	<span class="wx-data">
		<?php if($arr[11]=="N/A") echo "<span class=\"wx-na\">Not available.</span>";else echo "<span class=\"wx-value\">".$arr[11]."</span><span class=\"wx-unit\"> °C</span>";?>
	</span>
</td>
	</tr>
	<tr>
		<td><dfn><a onclick=<?php echo "\"window.top.location.href ='http://localhost/Resource/Observation/id".$zip."'\"";?>>Humidity</a></dfn></td>
		<td>
	<span class="wx-data">
		<?php if($arr[19]=="N/A") echo "<span class=\"wx-na\">Not available.</span>";else echo "<span class=\"wx-value\">".$arr[19]."</span>";?>
	</span>
</td>
	</tr>
	<tr>
		<td><a onclick=<?php echo "\"window.top.location.href ='http://localhost/Resource/Observation/id".$zip."'\"";?>>Rainfall</a></td>
		<td>
	<span class="wx-data">
		<?php if($arr[21]=="N/A") echo "<span class=\"wx-na\">Not available.</span>";else echo "<span class=\"wx-value\">".$arr[21]."</span><span class=\"wx-unit\">mm</span>";?>
	</span>
</td>
	</tr>
	<tr>
		<td><dfn><a onclick=<?php echo "\"window.top.location.href ='http://localhost/Resource/Observation/id".$zip."'\"";?>>Snow Depth</a></dfn></td>
		<td>
		<span class="wx-na"><?php if($arr[22]) echo "<span class=\"wx-na\">Not available.</span>";else echo $arr[22]; ?></span>
		</td>
	</tr>
	<tr>
		<td><a onclick=<?php echo "\"window.top.location.href ='http://localhost/Resource/Observation/id".$zip."'\"";?>>UV</a></td>
		<td><span class="wx-na">Not available.</span></td>
	</tr>
	<tr>
		<td><a onclick=<?php echo "\"window.top.location.href ='http://localhost/Resource/Observation/id".$zip."'\"";?>>Pollen</a></td>
		<td>
		<span class="wx-na">Not available.</span>
		</td>
	</tr>
		<tr>
		<td><a onclick=<?php echo "\"window.top.location.href ='http://localhost/Resource/Observation/id".$zip."'\"";?>>Air Quality</a></td>
		<td><span class="wx-na">Not available.</span></td>
		</tr>
	<tr>
		<td><a onclick=<?php echo "\"window.top.location.href ='http://localhost/Resource/Observation/id".$zip."'\"";?>>Flu Activity</a></td>
		<td>
		<span class="wx-na">Not available.</span>
		</td>
	</tr>
	<tr>
		<td colspan="2"><code>METAR EGLL 291750Z 27006KT 220V340 CAVOK 25/10 Q1021 NOSIG</code></td>
	</tr>
</tbody></table>
	</div>
	<div class="small-12 medium-6 large-5 columns ccMap" id="ccMap">
	<div id="weather-map">
	<!-- map ui will be inserted here -->
	<div class="map-ui">
	<div class="tabs">
    <a data-toggle="tab1">Satellite</a>
    <a data-toggle="tab2">Radar</a>

  </div>
<div class="tabContent">  
  <div id="tab1">
  <img src="http://api.wunderground.com/api/4c7f7ffccd9ea79f/animatedsatellite/image.gif?lat=<?php echo $arr[4];?>&lon=<?php echo $arr[5];?>&radius=100&width=280&height=180&key=sat_ir4_bottom&basemap=1g\"" style="width:100%;">
     </div>
  
  <div id="tab2">
	<img src="http://api.wunderground.com/api/4c7f7ffccd9ea79f/radar/image.gif?centerlat=<?php echo $arr[4];?>&centerlon=<?php echo $arr[5]?>&radius=100&width=280&height=180&newmaps=1" style="width:100%;">
  </div>
</div>
	</div>
</div></div>
</div>

						</body></html>
