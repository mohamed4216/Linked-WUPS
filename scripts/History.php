<?php

//creation of the rdf file 
function CreateRDF($id,$arg1,$index,$date){
	
	//the absolute path of our file

	$pathAbsolute='../Data/History/';

	//creation of file 

	$myfile = fopen($pathAbsolute."id".$id.$index.'.rdf', 'w') or die("Unable to open file!");

	//file value 

	$txt="<rdf:RDF

    xmlns:rdf=\"http://www.w3.org/1999/02/22-rdf-syntax-ns#\"

    xmlns:owl=\"http://www.w3.org/2002/07/owl#\"

    xmlns:Prec=\"http://localhost/Ontology/Precipitation.owl#\"

	xmlns:Temp=\"http://localhost/Ontology/Temperature.owl#\"

	xmlns:Loc=\"http://localhost/Ontology/Location.owl#\"
	
	xmlns:Wind=\"http://localhost/Ontology/Wind.owl#\"

	> 

  <rdf:Description rdf:about=\"http://localhost/History/";

	fwrite($myfile, $txt);

	fwrite($myfile,"id".$id.$index."\">\n");
	
	fwrite($myfile,"<Loc:ZipCode>".$id."</Loc:ZipCode>\n");	
	
	fwrite($myfile,"<Loc:UniCode>".$id.$date."</Loc:UniCode>\n");
	
	if(!isset($arg1['history']['observations']['0']['tempm']))
		
		$txt="N/A";
		
	else if($arg1['history']['observations']['0']['tempm']=="")
		
		$txt="N/A";
		
	else 
		
		$txt=$arg1['history']['observations']['0']['tempm'];
		
	fwrite($myfile,"<Temp:temp_c>".$txt."</Temp:temp_c>\n");
	
	if(!isset($arg1['history']['observations']['0']['precipm']))
		
		$txt="N/A";
		
	else if($arg1['history']['observations']['0']['precipm']=="")
		
		$txt="N/A";
		
	else 
		
		$txt=$arg1['history']['observations']['0']['precipm'];
		
	fwrite($myfile,"<Prec:precip_today_metric>".$txt."</Prec:precip_today_metric>\n");
	
	if(!isset($arg1['history']['observations']['0']['hum']))
		
		$txt="N/A";
		
	else if($arg1['history']['observations']['0']['hum']=="")
		
		$txt="N/A";
		
	else 
		
		$txt=$arg1['history']['observations']['0']['hum'];
		
	fwrite($myfile,"<Wind:relative_humidity>".$txt."</Wind:relative_humidity>\n");
	

	fwrite($myfile,"</rdf:Description></rdf:RDF>");

	fclose($myfile);
	$output = shell_exec('sudo /usr/lib/fuseki/bin/s-put http://localhost:3030/History/data default /var/www/Data/History/id'.$id.$index.'.rdf');

   }

//creation of html file 

function createHTML($id,$arg,$index,$date){

	

	//chemin pour le fichier 

	$pathAbsolute='../Page/History/';

	

	//creation de fichier $id

	$myfile = fopen($pathAbsolute."id".$id.$index.'.html', 'w') or die("Unable to open file!");

	

	//contenu de fichier 

	$txt="<html xmlns=\"http://www.w3.org/1999/xhtml\" xml:lang=\"en\" lang=\"en\"><head> <meta http-equiv=\"content-type\" content=\"text/html; charset=UTF-8\"> <title>";

	fwrite($myfile,$txt );

	$txt=$id.':'.$date;

	fwrite($myfile, $txt);

	$txt="</title> <link rel=\"alternate\" type=\"application/rdf+xml\" href=\"";

	fwrite($myfile, $txt);

	$txt="http://localhost/Data/History/id".$id.$index;

	fwrite($myfile, $txt);

	$txt="\" title=\"RDF\"> <link rel=\"stylesheet\" type=\"text/css\" href=\"style.css\"> <script type=\"text/javascript\" src=\"script.js\"></script></head>

			<body onload=\"init();\"><div id=\"header\"><div><h1 id=\"title\">";

	fwrite($myfile, $txt);

	$txt=$id.':'.$date;

	fwrite($myfile, $txt);

	$txt="</h1> </div> <div class=\"page-resource-uri\"><a href=\"";

	fwrite($myfile, $txt);

	$txt="http://localhost/Resource/History/id".$id.$index."\">http://localhost/Resource/History/id".$id.$index;

	fwrite($myfile, $txt);

	$txt="</a></div><div id=\"rdficon\"><a href=\"";

	fwrite($myfile, $txt);

	$txt="http://localhost/Data/History/id".$id.$index;

	fwrite($myfile, $txt);

	$txt="\" title=\"RDF data\"><img src=\"rdf-icon.gif\" alt=\"[This page as RDF]\"></a></div></div>

	  <table class=\"description\">

      <tbody><tr><th width=\"25%\">Property</th><th>Value</th></tr><tr class=\"odd\">

        <td class=\"property\">

          <a class=\"uri\" href=\"http://localhost/Ontology/Location.owl#ZipCode\" title=\"http://localhost/Ontology/Location.owl#ZipCode\"><small>Location:</small>ZipCode</a>

        </td><td><ul><li><span class=\"literal\">";

	fwrite($myfile, $txt);

	$txt=$id;

	fwrite($myfile, $txt);

	$txt="</span> </li></ul></td></tr><tr class=\"even\"><td class=\"property\">

          <a class=\"uri\" href=\"http://localhost/Ontology/Location.owl#UniCode\" title=\"http://localhost/Ontology/Location.owl#UniCode\"><small>Location:</small>UniCode</a>

          </td><td><ul><li><span class=\"literal\">";

	fwrite($myfile, $txt);

	$txt=$id.$date;

	fwrite($myfile,$txt);

	$txt="</span></li></ul></td></tr><tr class=\"odd\"><td class=\"property\">

          <a class=\"uri\" href=\"http://localhost/Ontology/Temperature.owl#temp_c\" title=\"http://localhost/Ontology/Temperature.owl#temp_c\"><small>Temperature:</small>Value</a>

          </td><td><ul><li><span class=\"literal\">";

	fwrite($myfile, $txt);
	
	if(!isset($arg1['history']['observations']['0']['tempm']))
		
		$txt="N/A";
		
	else if($arg1['history']['observations']['0']['tempm']=="")
		
		$txt="N/A";
		
	else 
		
		$txt=$arg1['history']['observations']['0']['tempm'];
		
	fwrite($myfile, $txt);

	$txt="</span> </li></ul></td></tr><tr class=\"even\"><td class=\"property\">

          <a class=\"uri\" href=\"http://localhost/Ontology/Precipitation.owl#precip_today_metric\" title=\"http://localhost/Ontology/Precipitation.owl#precip_today_metric\"><small>Precipitation:</small>Metric</a>

          </td><td><ul><li><span class=\"literal\">";

	fwrite($myfile, $txt);
	
	if(!isset($arg1['history']['observations']['0']['precipm']))
		
		$txt="N/A";
		
	else if($arg1['history']['observations']['0']['precipm']=="")
		
		$txt="N/A";
		
	else 
		
		$txt=$arg1['history']['observations']['0']['precipm'];

	fwrite($myfile, $txt);

	$txt="</span></li></ul></td></tr><tr class=\"odd\"><td class=\"property\">

          <a class=\"uri\" href=\"http://localhost/Ontology/Wind.owl#relative_humidity\" title=\"http://localhost/Ontology/Wind.owl#relative_humidity\"><small>Wind:</small>Relative Humidity</a>

        </td><td><ul><li><span class=\"literal\">";

	fwrite($myfile, $txt);
	
	if(!isset($arg1['history']['observations']['0']['hum']))
		
		$txt="N/A";
		
	else if($arg1['history']['observations']['0']['hum']=="")
		
		$txt="N/A";
		
	else 
		
		$txt=$arg1['history']['observations']['0']['hum'];

	fwrite($myfile, $txt);

	$txt="</span> </li></ul></td></tr></tbody></table><div id=\"footer\"> This page shows information obtained from the SPARQL endpoint at <a class=\"sparql-uri\" href=\"http://localhost/sparql\">http://localhost/sparql</a>.<br><a href=\"";

	fwrite($myfile, $txt);

	$txt="http://localhost/Data/History/id".$id.$index;

	fwrite($myfile, $txt);

	$txt="\">As RDF/XML</a></div></body></html>";

	fwrite($myfile, $txt);

	fclose($myfile);

}

//creation of the resource $id

function createResource($id,$index){

	

	//chemin de ressource $id

	$pathAbsolute='../Resource/History/';

	

	//the content of file resource.$id

	$myfile = fopen($pathAbsolute."id".$id.$index.'.php', 'w') or die("Unable to open file!");

	$txt="<?php if ( stristr("."\$_SERVER[\"HTTP_ACCEPT\"]".",\"application/rdf+xml\") ) { header('Location:";

	fwrite($myfile,$txt);

	$txt="http://localhost/Data/History/id".$id.$index;

	fwrite($myfile,$txt);

	$txt="'); exit();} else { header('Location:";

	fwrite($myfile,$txt);

	$txt="http://localhost/Page/History/id".$id.$index;

	fwrite($myfile,$txt);

	$txt="'); exit();}?>";

	fwrite($myfile,$txt);

	fclose($myfile);

}	



ini_set('max_execution_time', 0);

$handle = fopen("ListOfCities.txt", "r");


//list the date of the last seven days
$date1=date('Ymd',strtotime("-1 days"));
$date2=date('Ymd',strtotime("-2 days"));
$date3=date('Ymd',strtotime("-3 days"));
$date4=date('Ymd',strtotime("-4 days"));
$date5=date('Ymd',strtotime("-5 days"));
$date6=date('Ymd',strtotime("-6 days"));
$date7=date('Ymd',strtotime("-7 days"));

if ($handle) {

    while (($line = fgets($handle)) !== false) {

		$json1=file_get_contents('http://api.wunderground.com/api/4c7f7ffccd9ea79f/history_'.$date1.'/q/zmw:'.$line.'.json');
		$json2=file_get_contents('http://api.wunderground.com/api/4c7f7ffccd9ea79f/history_'.$date2.'/q/zmw:'.$line.'.json');
		$json3=file_get_contents('http://api.wunderground.com/api/4c7f7ffccd9ea79f/history_'.$date3.'/q/zmw:'.$line.'.json');
		$json4=file_get_contents('http://api.wunderground.com/api/4c7f7ffccd9ea79f/history_'.$date4.'/q/zmw:'.$line.'.json');
		$json5=file_get_contents('http://api.wunderground.com/api/4c7f7ffccd9ea79f/history_'.$date5.'/q/zmw:'.$line.'.json');
		$json6=file_get_contents('http://api.wunderground.com/api/4c7f7ffccd9ea79f/history_'.$date6.'/q/zmw:'.$line.'.json');
		$json7=file_get_contents('http://api.wunderground.com/api/4c7f7ffccd9ea79f/history_'.$date7.'/q/zmw:'.$line.'.json');
		$id=str_replace(".","",$line);

		$id1=trim($id);

		$obj1=json_decode($json1,true);
		$obj2=json_decode($json2,true);
		$obj3=json_encode($json3,true);
		$obj4=json_decode($json4,true);
		$obj5=json_decode($json5,true);
		$obj6=json_decode($json6,true);
		$obj7=json_decode($json7,true);
		
		CreateRDF($id1,$obj1,1,$date1);
		CreateRDF($id1,$obj2,2,$date2);
		CreateRDF($id1,$obj3,3,$date3);
		CreateRDF($id1,$obj4,4,$date4);
		CreateRDF($id1,$obj5,5,$date5);
		CreateRDF($id1,$obj6,6,$date6);
		CreateRDF($id1,$obj7,7,$date7);
		
		createHTML($id1,$obj1,1,$date1);
		createHTML($id1,$obj2,2,$date2);
		createHTML($id1,$obj3,3,$date3);
		createHTML($id1,$obj4,4,$date4);
		createHTML($id1,$obj5,5,$date5);
		createHTML($id1,$obj6,6,$date6);
		createHTML($id1,$obj7,7,$date7);
		
		createResource($id1,1);
		createResource($id1,2);
		createResource($id1,3);
		createResource($id1,4);
		createResource($id1,5);
		createResource($id1,6);
		createResource($id1,7);
		
		sleep(20);

    }



    fclose($handle);

} else {

    echo "error open file";

}
?>
