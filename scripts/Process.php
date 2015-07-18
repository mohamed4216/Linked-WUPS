<?php



//cette fonction permet de creer le fichier rdf pour une observation a une date bien determinée

function CreateRDF($id,$arg,$arg1,$arg2,$arg3){

	

	//obtention de la date de systme

	$year=date('Y');

	$month=date('n');

	$day=date('j');

	$hour=date('H');

	$minute=date('i');

	$second=date('s');

	$pathAbsolute='../Data/Observation/';

	

	//creation de fichier 

	$myfile = fopen($pathAbsolute."id".$id.'.rdf', 'w') or die("Unable to open file!");

	

	//chemin pour la creation de fichier 

	$path="http://localhost/Resource/Location/id".$id;

	

	//contenu de fichier

	$txt="<rdf:RDF

    xmlns:rdf=\"http://www.w3.org/1999/02/22-rdf-syntax-ns#\"

    xmlns:owl=\"http://www.w3.org/2002/07/owl#\"

    xmlns:Prec=\"http://localhost/Ontology/Precipitation.owl#\"

	xmlns:Wea=\"http://localhost/Ontology/Weather.owl#\"

	xmlns:Temp=\"http://localhost/Ontology/Temperature.owl#\"

	xmlns:Wind=\"http://localhost/Ontology/Wind.owl#\"

	xmlns:Loc=\"http://localhost/Ontology/Location.owl#\"

	xmlns:Time=\"http://localhost/Ontology/Time.owl#\"

	xmlns:Yester=\"http://localhost/Ontology/Yesterday.owl#\"
	
	xmlns:Astro=\"http://localhost/Ontology/Astronomy.owl#\"
	> 

  <rdf:Description rdf:about=\"http://localhost/Resource/Observation/";

	fwrite($myfile, $txt);

	fwrite($myfile,"id".$id."\">\n");

	fwrite($myfile,"<Loc:full>".$arg['current_observation']['display_location']['full']."</Loc:full>\n");

	fwrite($myfile,"<Loc:city>".$path."</Loc:city>\n");

	fwrite($myfile,"<Loc:ZipCode>".$id."</Loc:ZipCode>\n");	

	fwrite($myfile,"<Time:Hour>".$hour."</Time:Hour>\n");

	fwrite($myfile,"<Time:Minute>".$minute."</Time:Minute>\n");

	fwrite($myfile,"<Time:Day>".$day."</Time:Day>\n");

	fwrite($myfile,"<Time:Month>".$month."</Time:Month>\n");

	fwrite($myfile,"<Time:Year>".$year."</Time:Year>\n");
	
	if(!isset($arg['current_observation']['display_location']['elevation']))
		
		$txt="N/A";
	
	else if($arg['current_observation']['display_location']['elevation']=="")

		$txt="N/A";

	else

		$txt=$arg['current_observation']['display_location']['elevation'];

	fwrite($myfile,"<Loc:Elevation>".$txt."</Loc:Elevation>\n");
	
	if(!isset($arg['current_observation']['display_location']['latitude']))
		
		$txt="N/A";
	
	else if($arg['current_observation']['display_location']['latitude']=="")

		$txt="N/A";

	else

		$txt=$arg['current_observation']['display_location']['latitude'];

	fwrite($myfile,"<Loc:latitude>".$txt."</Loc:latitude>\n");
	
	if(!isset($arg['current_observation']['display_location']['longitude']))
		
		$txt="N/A";
	
	else if($arg['current_observation']['display_location']['longitude']=="")

		$txt="N/A";

	else

		$txt=$arg['current_observation']['display_location']['longitude'];

	fwrite($myfile,"<Loc:longitude>".$txt."</Loc:longitude>\n");
	
	if(!isset($arg['current_observation']['temperature_string']))
	
		$txt="N/A";
	
	else if($arg['current_observation']['temperature_string']=="")

		$txt="N/A";

	else

		$txt=$arg['current_observation']['temperature_string'];

	fwrite($myfile,"<Temp:temperature_string>".$txt."</Temp:temperature_string>\n");

	if(!isset($arg['current_observation']['temp_f']))
		
		$txt="N/A";
	
	else if($arg['current_observation']['temp_f']=="")

		$txt="N/A";

	else

		$txt=$arg['current_observation']['temp_f'];

	fwrite($myfile,"<Temp:temp_f>".$txt."</Temp:temp_f>\n");

	if(!isset($arg['current_observation']['temp_c']))
		
		$txt="N/A";
	
	else if($arg['current_observation']['temp_c']=="")

		$txt="N/A";

	else

		$txt=$arg['current_observation']['temp_c'];

	fwrite($myfile,"<Temp:temp_c>".$txt."</Temp:temp_c>\n");
	
	if(!isset($arg1['forecast']['simpleforecast']['forecastday'][0]['high']['celsius']))
		
		$txt="N/A";
	
	else if($arg1['forecast']['simpleforecast']['forecastday'][0]['high']['celsius']=="")

		$txt="N/A";

	else

		$txt=$arg1['forecast']['simpleforecast']['forecastday'][0]['high']['celsius'];

	fwrite($myfile,"<Temp:high>".$txt."</Temp:high>\n");
	
	if(!isset($arg1['forecast']['simpleforecast']['forecastday'][0]['low']['celsius']))
		
		$txt="N/A";
	
	else if($arg1['forecast']['simpleforecast']['forecastday'][0]['low']['celsius']=="")

		$txt="N/A";

	else

		$txt=$arg1['forecast']['simpleforecast']['forecastday'][0]['low']['celsius'];

	fwrite($myfile,"<Temp:low>".$txt."</Temp:low>\n");

	if(!isset($arg['current_observation']['heat_index_string']))
		
		$txt="N/A";
	
	else if($arg['current_observation']['heat_index_string']=="")

		$txt="N/A";

	else

		$txt=$arg['current_observation']['heat_index_string'];

	fwrite($myfile,"<Temp:heat_index>".$txt."</Temp:heat_index>\n");

	if(!isset($arg['current_observation']['heat_index_f']))
		
		$txt="N/A";
	
	else if($arg['current_observation']['heat_index_f']=="")

		$txt="N/A";

	else

		$txt=$arg['current_observation']['heat_index_f'];

	fwrite($myfile,"<Temp:heat_index_f>".$txt."</Temp:heat_index_f>\n");

	if(!isset($arg['current_observation']['heat_index_c']))

		$txt="N/A";

	else if($arg['current_observation']['heat_index_c']=="")

		$txt="N/A";

	else 

		$txt=$arg['current_observation']['heat_index_c'];

	fwrite($myfile,"<Temp:heat_index_c>".$txt."</Temp:heat_index_c>\n");

	if(!isset($arg['current_observation']['windchill_string']))
		
		$txt="N/A";
	
	else if($arg['current_observation']['windchill_string']=="")

		$txt="N/A";

	else

		$txt=$arg['current_observation']['windchill_string'];

	fwrite($myfile,"<Temp:windchill>".$txt."</Temp:windchill>\n");

	if(!isset($arg['current_observation']['windchill_f']))
		
		$txt="N/A";
	
	else if($arg['current_observation']['windchill_f']=="")

		$txt="N/A";

	else

		$txt=$arg['current_observation']['windchill_f'];

	fwrite($myfile,"<Temp:windchill_f>".$txt."</Temp:windchill_f>\n");

	if(!isset($arg['current_observation']['windchill_c']))
		
		$txt="N/A";
	
	else if($arg['current_observation']['windchill_c']=="")

		$txt="N/A";

	else

		$txt=$arg['current_observation']['windchill_c'];

	fwrite($myfile,"<Temp:windchill_c>".$txt."</Temp:windchill_c>\n");

	if(!isset($arg['current_observation']['dewpoint_string']))
		
		$txt="N/A";
	
	else if($arg['current_observation']['dewpoint_string']=="")

		$txt="N/A";

	else

		$txt=$arg['current_observation']['dewpoint_string'];

	fwrite($myfile,"<Temp:dewpoint>".$txt."</Temp:dewpoint>\n");

	if(!isset($arg['current_observation']['dewpoint_f']))
		
		$txt="N/A";
	
	else if($arg['current_observation']['dewpoint_f']=="")

		$txt="N/A";

	else

		$txt=$arg['current_observation']['dewpoint_f'];

	fwrite($myfile,"<Temp:dewpoint_f>".$txt."</Temp:dewpoint_f>\n");

	if(!isset($arg['current_observation']['dewpoint_c']))
		
		$txt="N/A";
	
	else if($arg['current_observation']['dewpoint_c']=="")

		$txt="N/A";

	else

		$txt=$arg['current_observation']['dewpoint_c'];

	fwrite($myfile,"<Temp:dewpoint_c>".$txt."</Temp:dewpoint_c>\n");

	if(!isset($arg['current_observation']['feelslike_string']))
		
		$txt="N/A";
	
	else if($arg['current_observation']['feelslike_string']=="")

		$txt="N/A";

	else

		$txt=$arg['current_observation']['feelslike_string'];

	fwrite($myfile,"<Temp:feelslike>".$txt."</Temp:feelslike>\n");

	if(!isset($arg['current_observation']['feelslike_c']))
		
		$txt="N/A";
	
	else if($arg['current_observation']['feelslike_c']=="")

		$txt="N/A";

	else
		$txt=$arg['current_observation']['feelslike_c'];

	fwrite($myfile,"<Temp:feelslike_c>".$txt."</Temp:feelslike_c>\n");

	if(!isset($arg['current_observation']['wind_degrees']))
		
		$txt="N/A";
	
	else if($arg['current_observation']['wind_degrees']=="")

		$txt="N/A";

	else

		$txt=$arg['current_observation']['wind_degrees'];

	fwrite($myfile,"<Wind:wind_degrees>".$txt."</Wind:wind_degrees>\n");

	if(!isset($arg['current_observation']['wind_dir']))
		
		$txt="N/A";
	
	else if($arg['current_observation']['wind_dir']=="")

		$txt="N/A";

	else

		$txt=$arg['current_observation']['wind_dir'];

	fwrite($myfile,"<Wind:wind_dir>".$txt."</Wind:wind_dir>\n");

	if(!isset($arg['current_observation']['wind_mph']))
		
		$txt="N/A";
	
	else if($arg['current_observation']['wind_mph']=="")

		$txt="N/A";

	else

		$txt=$arg['current_observation']['wind_mph'];

	fwrite($myfile,"<Wind:wind_mph>".$txt."</Wind:wind_mph>\n");

	if(!isset($arg['current_observation']['wind_kph']))
		
		$txt="N/A";
	
	else if($arg['current_observation']['wind_kph']=="")

		$txt="N/A";

	else

		$txt=$arg['current_observation']['wind_kph'];

	fwrite($myfile,"<Wind:wind_kph>".$txt."</Wind:wind_kph>\n");

	if(!isset($arg['current_observation']['wind_gust_mph']))
		
		$txt="N/A";
	
	else if($arg['current_observation']['wind_gust_mph']=="")

		$txt="N/A";

	else

		$txt=$arg['current_observation']['wind_gust_mph'];

	fwrite($myfile,"<Wind:wind_gust_mph>".$txt."</Wind:wind_gust_mph>\n");

	if(!isset($arg['current_observation']['wind_gust_kph']))
		
		$txt="N/A";
	
	else if($arg['current_observation']['wind_gust_kph']=="")

		$txt="N/A";

	else

		$txt=$arg['current_observation']['wind_gust_kph'];

	fwrite($myfile,"<Wind:wind_gust_kph>".$txt."</Wind:wind_gust_kph>\n");

	if(!isset($arg['current_observation']['pressure_mb']))
		
		$txt="N/A";
	
	else if($arg['current_observation']['pressure_mb']=="")

		$txt="N/A";

	else

		$txt=$arg['current_observation']['pressure_mb'];

	fwrite($myfile,"<Wind:pressure_mb>".$txt."</Wind:pressure_mb>\n");

	if(!isset($arg['current_observation']['pressure_in']))
		
		$txt="N/A";
	
	else if($arg['current_observation']['pressure_in']=="")

		$txt="N/A";

	else

		$txt=$arg['current_observation']['pressure_in'];

	fwrite($myfile,"<Wind:pressure_in>".$txt."</Wind:pressure_in>\n");

	if(!isset($arg['current_observation']['pressure_trend']))
	
		$txt="N/A";
	
	else if($arg['current_observation']['pressure_trend']=="")

		$txt="N/A";

	else

		$txt=$arg['current_observation']['pressure_trend'];

	fwrite($myfile,"<Wind:pressure_trend>".$txt."</Wind:pressure_trend>\n");

	if(!isset($arg['current_observation']['relative_humidity']))
		
		$txt="N/A";
	
	else if($arg['current_observation']['relative_humidity']=="")

		$txt="N/A";

	else

		$txt=$arg['current_observation']['relative_humidity'];

	fwrite($myfile,"<Wind:relative_humidity>".$txt."</Wind:relative_humidity>\n");
	
	if(!isset($arg1['forecast']['simpleforecast']['forecastday'][0]['pop']))
		
		$txt="N/A";
	
	else if($arg1['forecast']['simpleforecast']['forecastday'][0]['pop']=="")

		$txt="N/A";

	else

		$txt=$arg1['forecast']['simpleforecast']['forecastday'][0]['pop'];

	fwrite($myfile,"<Prec:prob_of_precip>".$txt."</Prec:prob_of_precip>\n");
	
	if(!isset($arg1['forecast']['simpleforecast']['forecastday'][0]['qpf_allday']['mm']))
		
		$txt="N/A";
	
	else if($arg1['forecast']['simpleforecast']['forecastday'][0]['qpf_allday']['mm']=="")

		$txt="N/A";

	else

		$txt=$arg1['forecast']['simpleforecast']['forecastday'][0]['qpf_allday']['mm'];

	fwrite($myfile,"<Prec:rainfall>".$txt."</Prec:rainfall>\n");
	
	if(!isset($arg1['forecast']['simpleforecast']['forecastday'][0]['snow_allday']['mm']))
		
		$txt="N/A";
	
	else if($arg1['forecast']['simpleforecast']['forecastday'][0]['snow_allday']['mm']=="")

		$txt="N/A";

	else

		$txt=$arg1['forecast']['simpleforecast']['forecastday'][0]['snow_allday']['mm'];

	fwrite($myfile,"<Prec:snow_depth>".$txt."</Prec:snow_depth>\n");
	

	$txt=($arg['current_observation']['precip_today_metric'] == "--") ? 'N/A' : $arg['current_observation']['precip_today_metric'];

	fwrite($myfile,"<Prec:precip_today_metric>".$txt."</Prec:precip_today_metric>\n");

	$txt=($arg['current_observation']['precip_today_in'] == "") ? 'N/A' : $arg['current_observation']['precip_today_in'];

	fwrite($myfile,"<Prec:precip_today_in>".$txt."</Prec:precip_today_in>\n");

	if(!isset($arg['current_observation']['precip_1hr_in']))
		
		$txt="N/A";
	
	else if($arg['current_observation']['precip_1hr_in']=="")

		$txt="N/A";

	else

		$txt=$arg['current_observation']['precip_1hr_in'];

	fwrite($myfile,"<Prec:precip_1hr_in>".$txt."</Prec:precip_1hr_in>\n");

	if(!isset($arg['current_observation']['precip_1hr_metric']))
		
		$txt="N/A";
	
	else if($arg['current_observation']['precip_1hr_metric']=="")

		$txt="N/A";

	else

		$txt=$arg['current_observation']['precip_1hr_metric'];

	fwrite($myfile,"<Prec:precip_1hr_metric>".$txt."</Prec:precip_1hr_metric>\n");

	if(!isset($arg['current_observation']['visibility_km']))
		
		$txt="N/A";
	
	else if($arg['current_observation']['visibility_km']=="")

		$txt="N/A";

	else

		$txt=$arg['current_observation']['visibility_km'];

	fwrite($myfile,"<Wea:visibility_km>".$txt."</Wea:visibility_km>\n");

	if(!isset($arg['current_observation']['visibility_mi']))
		
		$txt="N/A";
	
	else if($arg['current_observation']['visibility_mi']=="")

		$txt="N/A";

	else

		$txt=$arg['current_observation']['visibility_mi'];

	fwrite($myfile,"<Wea:visibility_mi>".$txt."</Wea:visibility_mi>\n");

	if(!isset($arg['current_observation']['icon']))
		
		$txt="N/A";
	
	else if($arg['current_observation']['icon']=="")

		$txt="N/A";

	else

		$txt=$arg['current_observation']['icon'];

	fwrite($myfile,"<Wea:icon>".$txt."</Wea:icon>\n");

	if(!isset($arg['current_observation']['icon_url']))
		
		$txt="N/A";
	
	else if($arg['current_observation']['icon_url']=="")

		$txt="N/A";

	else

		$txt=$arg['current_observation']['icon_url'];

	fwrite($myfile,"<Wea:icon_url>".$txt."</Wea:icon_url>\n");
	
	if(!isset($arg2['history']['observations'][0]['tempm']))
		
		$txt="N/A";
	
	else if($arg2['history']['observations'][0]['tempm']=="")

		$txt="N/A";

	else

		$txt=$arg2['history']['observations'][0]['tempm'];

	fwrite($myfile,"<Yester:temp>".$txt."</Yester:temp>\n");
	
	if(!isset($arg2['history']['observations'][0]['maxtempm']))
		
		$txt="N/A";
	
	else if($arg2['history']['observations'][0]['maxtempm']=="")

		$txt="N/A";

	else

		$txt=$arg2['history']['observations'][0]['maxtempm'];

	fwrite($myfile,"<Yester:max>".$txt."</Yester:max>\n");
	
	if(!isset($arg2['history']['observations'][0]['mintempm']))
		
		$txt="N/A";
	
	else if($arg2['history']['observations'][0]['mintempm']=="")

		$txt="N/A";

	else

		$txt=$arg2['history']['observations'][0]['mintempm'];

	fwrite($myfile,"<Yester:min>".$txt."</Yester:min>\n");
	
	if(!isset($arg2['history']['observations'][0]['rain']))
		
		$txt="N/A";
	
	else if($arg2['history']['observations'][0]['rain']=="")

		$txt="N/A";

	else

		$txt=$arg2['history']['observations'][0]['rain'];

	fwrite($myfile,"<Yester:rain>".$txt."</Yester:rain>\n");
	
	if(!isset($arg3['moon_phase']['sunrise']['hour']))
	
		$txt="N/A";

	else if($arg3['moon_phase']['sunrise']['hour']=="")

		$txt="N/A";

	else

		$txt=$arg3['moon_phase']['sunrise']['hour'];

	fwrite($myfile,"<Astro:sunrise_hour>".$txt."</Astro:sunrise_hour>\n");
	
	if(!isset($arg3['moon_phase']['sunrise']['minute']))
		
		$txt="N/A";
	
	else if($arg3['moon_phase']['sunrise']['minute']=="")

		$txt="N/A";

	else

		$txt=$arg3['moon_phase']['sunrise']['minute'];

	fwrite($myfile,"<Astro:sunrise_minute>".$txt."</Astro:sunrise_minute>\n");
	
	if(!isset($arg3['moon_phase']['sunset']['hour']))
		
		$txt="N/A";
	
	else if($arg3['moon_phase']['sunset']['hour']=="")

		$txt="N/A";

	else

		$txt=$arg3['moon_phase']['sunset']['hour'];

	fwrite($myfile,"<Astro:sunset_hour>".$txt."</Astro:sunset_hour>\n");
	
	if(!isset($arg3['moon_phase']['sunset']['minute']))
		
		$txt="N/A";
	
	else if($arg3['moon_phase']['sunset']['minute']=="")

		$txt="N/A";

	else

		$txt=$arg3['moon_phase']['sunset']['minute'];

	fwrite($myfile,"<Astro:sunset_minute>".$txt."</Astro:sunset_minute>\n");
	
	if(!isset($arg3['moon_phase']['phaseofMoon']))
		
		$txt="N/A";
	
	else if($arg3['moon_phase']['phaseofMoon']=="")

		$txt="N/A";

	else

		$txt=$arg3['moon_phase']['phaseofMoon'];

	fwrite($myfile,"<Astro:moon_phase>".$txt."</Astro:moon_phase>\n");
	
	if(!isset($arg3['moon_phase']['percentIlluminated']))
		
		$txt="N/A";
	
	else if($arg3['moon_phase']['percentIlluminated']=="")

		$txt="N/A";

	else

		$txt=$arg3['moon_phase']['percentIlluminated'];

	fwrite($myfile,"<Astro:visible>".$txt."</Astro:visible>\n");
	
	
	fwrite($myfile,"</rdf:Description></rdf:RDF>");

	fclose($myfile);
	$output = shell_exec('sudo /usr/lib/fuseki/bin/s-put http://localhost:3030/Observation/data default /var/www/Data/Observation/id'.$id.'.rdf');
   }

   

//creation de fichier html :representation html de resource $id

function createHTML($id,$arg){

	

	//chemin pour le fichier 

	$pathAbsolute='../Page/Observation/';

	

	//creation de fichier $id

	$myfile = fopen($pathAbsolute."id".$id.'.html', 'w') or die("Unable to open file!");

	

	//contenu de fichier 

	$txt="<html xmlns=\"http://www.w3.org/1999/xhtml\" xml:lang=\"en\" lang=\"en\"><head> <meta http-equiv=\"content-type\" content=\"text/html; charset=UTF-8\"> <title>";

	fwrite($myfile,$txt );

	$txt=$arg['current_observation']['display_location']['city'].':'.date("d-m-Y");

	fwrite($myfile, $txt);

	$txt="</title> <link rel=\"alternate\" type=\"application/rdf+xml\" href=\"";

	fwrite($myfile, $txt);

	$txt="http://localhost/Data/Observation/id".$id;

	fwrite($myfile, $txt);

	$txt="\" title=\"RDF\"> <link rel=\"stylesheet\" type=\"text/css\" href=\"style.css\"> <script type=\"text/javascript\" src=\"script.js\"></script></head>

			<body onload=\"init();\"><div id=\"header\"><div><h1 id=\"title\">";

	fwrite($myfile, $txt);

	$txt=$arg['current_observation']['display_location']['city'].':'.date("d-m-Y");

	fwrite($myfile, $txt);

	$txt="</h1> </div> <div class=\"page-resource-uri\"><a href=\"";

	fwrite($myfile, $txt);

	$txt="http://localhost/Resource/Observation/id".$id."\">http://localhost/Resource/Observation/id".$id;

	fwrite($myfile, $txt);

	$txt="</a></div><div id=\"rdficon\"><a href=\"";

	fwrite($myfile, $txt);

	$txt="http://localhost/Data/Observation/id".$id;

	fwrite($myfile, $txt);

	$txt="\" title=\"RDF data\"><img src=\"rdf-icon.gif\" alt=\"[This page as RDF]\"></a></div></div>

	  <table class=\"description\">

      <tbody><tr><th width=\"25%\">Property</th><th>Value</th></tr><tr class=\"odd\">

        <td class=\"property\">

          <a class=\"uri\" href=\"http://localhost/Ontology/Location.owl#full\" title=\"http://localhost/Ontology/Location.owl#full\"><small>Location:</small>Full Name</a>

        </td><td><ul><li><span class=\"literal\">";

	fwrite($myfile, $txt);

	$txt=$arg['current_observation']['display_location']['full'];

	fwrite($myfile, $txt);

	$txt="</span> </li></ul></td></tr><tr class=\"even\"><td class=\"property\">

          <a class=\"uri\" href=\"http://localhost/Ontology/Location.owl#city\" title=\"http://localhost/Ontology/Location.owl#city\"><small>Location:</small>City Name</a>

          </td><td><ul><li><span class=\"literal\">";

	fwrite($myfile, $txt);

	$txt="<a href =\"http://localhost/Resource/Location/id".$id."\">http://localhost/Resource/Location/id".$id;

	fwrite($myfile,$txt);

	$txt="</span></li></ul></td></tr><tr class=\"odd\"><td class=\"property\">

          <a class=\"uri\" href=\"http://localhost/Ontology/Temperature.owl#temperature_string\" title=\"http://localhost/Ontology/Temperature.owl#temperature_string\"><small>Temperature:</small>Value</a>

          </td><td><ul><li><span class=\"literal\">";

	fwrite($myfile, $txt);
	
	if(!isset($arg['current_observation']['temperature_string']))
		
		$txt="N/A";

	else if($arg['current_observation']['temperature_string']=="")

		$txt="N/A";

	else

		$txt=$arg['current_observation']['temperature_string'];

	fwrite($myfile, $txt);

	$txt="</span> </li></ul></td></tr><tr class=\"even\"><td class=\"property\">

          <a class=\"uri\" href=\"http://localhost/Ontology/Temperature.owl#heat_index\" title=\"http://localhost/Ontology/Temperature.owl#heat_index\"><small>Temperature:</small>Heat Index</a>

          </td><td><ul><li><span class=\"literal\">";

	fwrite($myfile, $txt);
	
	if(!isset($arg['current_observation']['heat_index_string']))
		
		$txt="N/A";

	else if($arg['current_observation']['heat_index_string']=="")

		$txt="N/A";

	else

		$txt=$arg['current_observation']['heat_index_string'];

	fwrite($myfile, $txt);

	$txt="</span></li></ul></td></tr><tr class=\"odd\"><td class=\"property\">

          <a class=\"uri\" href=\"http://localhost/Ontology/Temperature.owl#windchill\" title=\"http://localhost/Ontology/Temperature.owl#windchill\"><small>Temperature:</small>Wind Chill</a>

        </td><td><ul><li><span class=\"literal\">";

	fwrite($myfile, $txt);
	
	if(!isset($arg['current_observation']['windchill_string']))
		
		$txt="N/A";

	else if($arg['current_observation']['windchill_string']=="")

		$txt="N/A";

	else

		$txt=$arg['current_observation']['windchill_string'];

	fwrite($myfile, $txt);

	$txt="</span> </li></ul></td></tr><tr class=\"even\"><td class=\"property\">

          <a class=\"uri\" href=\"http://localhost/Ontology/Temperature.owl#dewpoint\" title=\"http://localhost/Ontology/Temperature.owl#dewpoint\"><small>Temperature:</small>Dew Point</a>

          </td><td><ul><li><span class=\"literal\">";

	fwrite($myfile, $txt);
	
	if(!isset($arg['current_observation']['dewpoint_string']))
		
		$txt="N/A";

	else if($arg['current_observation']['dewpoint_string']=="")

		$txt="N/A";

	else

		$txt=$arg['current_observation']['dewpoint_string'];

	fwrite($myfile, $txt);

	$txt="</span></li></ul></td></tr><tr class=\"odd\"><td class=\"property\">

          <a class=\"uri\" href=\"http://localhost/Ontology/Temperature.owl#feelslike\" title=\"http://localhost/Ontology/Temperature.owl#feelslike\"><small>Temperature:</small>feels-like</a>

        </td><td><ul><li><span class=\"literal\">";

	fwrite($myfile, $txt);
	
	if(!isset($arg['current_observation']['feelslike_string']))
		
		$txt="N/A";

	else if($arg['current_observation']['feelslike_string']=="")

		$txt="N/A";

	else

		$txt=$arg['current_observation']['feelslike_string'];

	fwrite($myfile, $txt);

	$txt="</span> </li></ul></td></tr><tr class=\"even\"><td class=\"property\">

          <a class=\"uri\" href=\"http://localhost/Ontology/Wind.owl#wind_degrees\" title=\"http://localhost/Ontology/Wind.owl#wind_degrees\"><small>Wind:</small>Degrees</a>

          </td><td><ul><li><span class=\"literal\">";

	fwrite($myfile, $txt);
	
	if(!isset($arg['current_observation']['wind_degrees']))
		
		$txt="N/A";

	else if($arg['current_observation']['wind_degrees']=="")

		$txt="N/A";

	else

		$txt=$arg['current_observation']['wind_degrees'];

	fwrite($myfile, $txt);

	$txt="</span></li></ul></td></tr><tr class=\"odd\"><td class=\"property\">

          <a class=\"uri\" href=\"http://localhost/Ontology/Wind.owl#wind_dir\" title=\"http://localhost/Ontology/Wind.owl#wind_dir\"><small>Wind:</small>Direction</a>

        </td><td><ul><li><span class=\"literal\">";

	fwrite($myfile, $txt);
	
	if(!isset($arg['current_observation']['wind_dir']))
		
		$txt="N/A";

	else if($arg['current_observation']['wind_dir']=="")

		$txt="N/A";

	else

		$txt=$arg['current_observation']['wind_dir'];

	fwrite($myfile, $txt);

	$txt="</span> </li></ul></td></tr><tr class=\"even\"><td class=\"property\">

          <a class=\"uri\" href=\"http://localhost/Ontology/Wind.owl#wind_mph\" title=\"http://localhost/Ontology/Wind.owl#wind_mph\"><small>Wind:</small>Speed(MPH)</a>

          </td><td><ul><li><span class=\"literal\">";

	fwrite($myfile, $txt);
	
	if(!isset($arg['current_observation']['wind_mph']))
		
		$txt="N/A";

	else if($arg['current_observation']['wind_mph']=="")

		$txt="N/A";

	else

		$txt=$arg['current_observation']['wind_mph'];

	fwrite($myfile, $txt);

	$txt="</span></li></ul></td></tr><tr class=\"odd\"><td class=\"property\">

          <a class=\"uri\" href=\"http://localhost/Ontology/Wind.owl#wind_kph\" title=\"http://localhost/Ontology/Wind.owl#wind_kph\"><small>Wind:</small>Speed(KPH)</a>

        </td><td><ul><li><span class=\"literal\">";

	fwrite($myfile, $txt);
	
	if(!isset($arg['current_observation']['wind_kph']))
		
		$txt="N/A";

	else if($arg['current_observation']['wind_kph']=="")

		$txt="N/A";

	else

		$txt=$arg['current_observation']['wind_kph'];

	fwrite($myfile, $txt);

	$txt="</span> </li></ul></td></tr><tr class=\"even\"><td class=\"property\">

          <a class=\"uri\" href=\"http://localhost/Ontology/Wind.owl#pressure_mb\" title=\"http://localhost/Ontology/Wind.owl#pressure_mb\"><small>Wind:</small>Pressure(MB)</a>

          </td><td><ul><li><span class=\"literal\">";

	fwrite($myfile, $txt);
	
	if(!isset($arg['current_observation']['pressure_mb']))

		$txt="N/A";
		
	else if($arg['current_observation']['pressure_mb']=="")

		$txt="N/A";

	else

		$txt=$arg['current_observation']['pressure_mb'];

	fwrite($myfile, $txt);

	$txt="</span></li></ul></td></tr><tr class=\"odd\"><td class=\"property\">

          <a class=\"uri\" href=\"http://localhost/Ontology/Wind.owl#pressure_in\" title=\"http://localhost/Ontology/Wind.owl#pressure_in\"><small>Wind:</small>Pressure(KPH)</a>

        </td><td><ul><li><span class=\"literal\">";

	fwrite($myfile, $txt);
	
	if(!isset($arg['current_observation']['pressure_in']))
		
		$txt="N/A";

	else if($arg['current_observation']['pressure_in']=="")

		$txt="N/A";

	else

		$txt=$arg['current_observation']['pressure_in'];

	fwrite($myfile, $txt);

	$txt="</span> </li></ul></td></tr><tr class=\"even\"><td class=\"property\">

          <a class=\"uri\" href=\"http://localhost/Ontology/Wind.owl#relative_humidity\" title=\"http://localhost/Ontology/Wind.owl#relative_humidity\"><small>Wind:</small>Relative Humidity</a>

          </td><td><ul><li><span class=\"literal\">";

	fwrite($myfile, $txt);
	
	if(!isset($arg['current_observation']['relative_humidity']))
		
		$txt="N/A";

	else if($arg['current_observation']['relative_humidity']=="")

		$txt="N/A";

	else

		$txt=$arg['current_observation']['relative_humidity'];

	fwrite($myfile, $txt);

	$txt="</span></li></ul></td></tr><tr class=\"odd\"><td class=\"property\">

          <a class=\"uri\" href=\"http://localhost/Ontology/Precipitation.owl#precip_today_in\" title=\"http://localhost/Ontology/Precipitation.owl#precip_today_in\"><small>Precipitation:</small>Today(in)</a>

        </td><td><ul><li><span class=\"literal\">";

	fwrite($myfile, $txt);

	$txt=($arg['current_observation']['precip_today_in'] == "") ? 'N/A' : $arg['current_observation']['precip_today_in'];

	fwrite($myfile, $txt);

	$txt="</span> </li></ul></td></tr><tr class=\"even\"><td class=\"property\">

          <a class=\"uri\" href=\"http://localhost/Ontology/Precipitation.owl#precip_today_metric\" title=\"http://localhost/Ontology/Precipitation.owl#precip_today_metric\"><small>Precipitation:</small>Today(m)</a>

          </td><td><ul><li><span class=\"literal\">";

	fwrite($myfile, $txt);

	$txt=($arg['current_observation']['precip_today_metric'] == "--") ? 'N/A' : $arg['current_observation']['precip_today_metric'];

	fwrite($myfile, $txt);

	$txt="</span></li></ul></td></tr><tr class=\"odd\"><td class=\"property\">

          <a class=\"uri\" href=\"http://localhost/Ontology/Weather.owl#visibility_km\" title=\"http://localhost/Ontology/Weather.owl#visibility_km\"><small>Weather:</small>Visibility(km)</a>

        </td><td><ul><li><span class=\"literal\">";

	fwrite($myfile, $txt);
	
	if(!isset($arg['current_observation']['visibility_km']))
		
		$txt="N/A";
	
	else if($arg['current_observation']['visibility_km']=="")

		$txt="N/A";

	else

		$txt=$arg['current_observation']['visibility_km'];

	fwrite($myfile, $txt);

	$txt="</span> </li></ul></td></tr><tr class=\"even\"><td class=\"property\">

          <a class=\"uri\" href=\"http://localhost/Ontology/Weather.owl#visibility_mi\" title=\"http://localhost/Ontology/Weather.owl#visibility_mi\"><small>Weather:</small>Visibility(mi)</a>

          </td><td><ul><li><span class=\"literal\">";

	fwrite($myfile, $txt);
	
	if(!isset($arg['current_observation']['visibility_mi']))
		
		$txt="N/A";

	else if($arg['current_observation']['visibility_mi']=="")

		$txt="N/A";

	else

		$txt=$arg['current_observation']['visibility_mi'];

	fwrite($myfile, $txt);	

	$txt="</span></li></ul></td></tr><tr class=\"odd\"><td class=\"property\">

          <a class=\"uri\" href=\"http://localhost/Ontology/Weather.owl#icon_url\" title=\"http://localhost/Ontology/Weather.owl#icon_url\"><small>Weather:</small>Image</a>

        </td><td><ul><li><span class=\"literal\">";

	fwrite($myfile, $txt);

	$txt="<a href =\"".$arg['current_observation']['icon_url']."\">".$arg['current_observation']['icon_url']."</a>";

	fwrite($myfile, $txt);

	$txt="</span> </li></ul></td></tr></tbody></table><div id=\"footer\"> This page shows information obtained from the SPARQL endpoint at <a class=\"sparql-uri\" href=\"http://localhost/sparql\">http://localhost/sparql</a>.<br><a href=\"";

	fwrite($myfile, $txt);

	$txt="http://localhost/Data/Observation/id".$id;

	fwrite($myfile, $txt);

	$txt="\">As RDF/XML</a></div></body></html>";

	fwrite($myfile, $txt);

	fclose($myfile);

}



//creation de ressource $id

function createResource($id){

	

	//chemin de ressource $id

	$pathAbsolute='../Resource/Observation/';

	

	//contenu de resource $id

	$myfile = fopen($pathAbsolute."id".$id.'.php', 'w') or die("Unable to open file!");

	$txt="<?php if ( stristr("."\$_SERVER[\"HTTP_ACCEPT\"]".",\"application/rdf+xml\") ) { header('Location:";

	fwrite($myfile,$txt);

	$txt="http://localhost/Data/Observation/id".$id;

	fwrite($myfile,$txt);

	$txt="'); exit();} else { header('Location:";

	fwrite($myfile,$txt);

	$txt="http://localhost/Page/Observation/id".$id;

	fwrite($myfile,$txt);

	$txt="'); exit();}?>";

	fwrite($myfile,$txt);

	fclose($myfile);

}	



//generation des fichiers .php,.html et .rdf a partir de la liste de pays (ListOfCities)

ini_set('max_execution_time', 0);

$handle = fopen("ListOfCities.txt", "r");

if ($handle) {

    while (($line = fgets($handle)) !== false) {

		$json1=file_get_contents('http://api.wunderground.com/api/4c7f7ffccd9ea79f/conditions/q/zmw:'.$line.'.json');
		$json2=file_get_contents('http://api.wunderground.com/api/4c7f7ffccd9ea79f/forecast/q/zmw:'.$line.'.json');
		$json3=file_get_contents('http://api.wunderground.com/api/4c7f7ffccd9ea79f/Yesterday/q/zmw:'.$line.'.json');
		$json4=file_get_contents('http://api.wunderground.com/api/4c7f7ffccd9ea79f/astronomy/q/zmw:'.$line.'.json');

		$id=str_replace(".","",$line);

		$id1=trim($id);

		$obj1=json_decode($json1,true);
		$obj2=json_decode($json2,true);
		$obj3=json_encode($json3,true);
		$obj4=json_decode($json4,true);
		
		createResource($id1);

		createHTML($id1,$obj1);

		createRDF($id1,$obj1,$obj2,$obj3,$obj4);

		sleep(8);

    }



    fclose($handle);

} else {

    echo "error open file";

} 

?>
