<?php if ( stristr($_SERVER["HTTP_ACCEPT"],"application/rdf+xml") ) { header('Location:http://localhost/Data/Location/id000001598430'); exit();} else { header('Location:http://localhost/Page/Location/id000001598430'); exit();}?>