<?php if ( stristr($_SERVER["HTTP_ACCEPT"],"application/rdf+xml") ) { header('Location:http://localhost/Data/Observation/id000002598427'); exit();} else { header('Location:http://localhost/Page/Observation/id000002598427'); exit();}?>