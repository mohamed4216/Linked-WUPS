<?php if ( stristr($_SERVER["HTTP_ACCEPT"],"application/rdf+xml") ) { header('Location:http://localhost/Data/Location/id000002010836'); exit();} else { header('Location:http://localhost/Page/Location/id000002010836'); exit();}?>