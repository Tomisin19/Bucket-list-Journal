<?php
require_once "Mail.php";  //this includes the pear SMTP mail library
$from = "Password System Reset <noreply@loki.trentu.ca>";
$to = "tomi.awo24@gmail.com";  //put user's email here
$subject = "Password Reset";
$body = "This is the link to reset your password => https://loki.trentu.ca/~davidawodumila/3420/assn/assn3/resetpassword.php";
$host = "smtp.trentu.ca";
$headers = array ('From' => $from,
  'To' => $to,
  'Subject' => $subject);
$smtp = Mail::factory('smtp',
  array ('host' => $host));
  
$mail = $smtp->send($to, $headers, $body);
if (PEAR::isError($mail)) {
  echo("<p>" . $mail->getMessage() . "</p>");
 } else {
  echo("<p>Message successfully sent!</p>");
 }

?>