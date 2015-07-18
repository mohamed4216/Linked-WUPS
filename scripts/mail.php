  <?php

// Pear Mail Library
require_once "mail/Mail.php";

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

$value="";

if (PEAR::isError($mail)) {
     $value="error";
} else {
    $value="ok";
}
return $value;
}
$valuefinal=sendmail();
header("Location: http://localhost/contact.php");
die();
?>

