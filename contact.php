<?php
$mail = 'thierry.hor.sd@gmail.com';
if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $mail)) // filters servers with bugs.
{
	$newLine = "\r\n";
}
else
{
	$newLine = "\n";
}
// messages in text format and HTML.
$message_txt = htmlentities($_POST['name']). " " .htmlentities($_POST['mail']). " " .htmlentities($_POST['message']);
$message_html = "<html><head></head><body>" .htmlentities($_POST['name']). "<br><br>" .htmlentities($_POST['mail']). "<br><br>" .htmlentities($_POST['message']). "</body></html>";
 
// Create boundary
$boundary = "-----=".md5(rand());
//==========
 
// Subject
$subject = "Portfolio";
//=========
 
// Create email's header
$header = "From: " .htmlentities($_POST['name']). htmlentities($_POST['mail']) .$newLine;
$header.= "Reply-to: " .htmlentities($_POST['name']). htmlentities($_POST['mail']) .$newLine;
$header.= "MIME-Version: 1.0".$newLine;
$header.= "Content-Type: multipart/alternative;".$newLine." boundary=\"$boundary\"".$newLine;
//==========
 
// Create message
$message = $newLine."--".$boundary.$newLine;
// Add message in text format
$message.= "Content-Type: text/plain; charset=\"ISO-8859-1\"".$newLine;
$message.= "Content-Transfer-Encoding: 8bit".$newLine;
$message.= $newLine.$message_txt.$newLine;
//==========
$message.= $newLine."--".$boundary.$newLine;
// Add message in HTML format
$message.= "Content-Type: text/html; charset=\"ISO-8859-1\"".$newLine;
$message.= "Content-Transfer-Encoding: 8bit".$newLine;
$message.= $newLine.$message_html.$newLine;
//==========
$message.= $newLine."--".$boundary."--".$newLine;
$message.= $newLine."--".$boundary."--".$newLine;
//==========
 
// Sending email
mail($mail,$subject,$message,$header);
//==========

header('Location: contact.html');
?>
