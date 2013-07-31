<?php
// sendmail.php
// by Conor Gilmer (conor.gilmer@gmail.com)
// send a email from a form, and receipt to sender and validate input
 include 'header.php'; ?>

<?php
if(isset($_POST['email'])) {
    $email_to = "conor.gilmer@webelevate.ie"; // who the form sends the email to
    $email_subject = "My Bloomsday Form Messages"; //subject of that msg
     
     
    function died($error) {
        // your error code can go here
	echo " <div class=\"container\"> <div class=\"hero-unit\">	<img src=\"img/jjsq.gif\" height=\"129\" width=\"90\" align=\"right\" valign=\"top\">

        <h1 class=\"joyce\">Contact Form Error!</h1> <p><br></p>    <a class=\"btn btn-primary btn-large\" href=\"download.html\">Download the App &raquo;</a>

  </div><div class=\"span12\">";
        echo "We are very sorry, but there were error(s) found with the form you submitted. ";
        echo "These errors appear below.<br /><br />";
        echo $error."<br /><br />";
        echo "Please go back and fix these errors.<br /><br />";
	echo "</div> <hr> <div class=\"footer\"> 
        <p> My BloomsDay<sup>TM</sup> Copyright &copy; (<a href=\"mailto:conor.gilmer@webelevate.ie\">Conor Gilmer</a>) 2013</p> </div>  </div> 
    <script src=\"http://code.jquery.com/jquery.js\"></script>
    <script src=\"js/bootstrap.min.js\"></script> </body></html>";
        die();
    }
     
    // validation expected data exists
    if(!isset($_POST['first']) ||
        !isset($_POST['last']) ||
        !isset($_POST['email']) ||
        !isset($_POST['type']) ||
        !isset($_POST['message'])) {
        died('We are sorry, but there appears to be a problem with the form you submitted.');      
    }
     
    $first_name = $_POST['first']; // required
    $last_name = $_POST['last']; // required
    $email_from = $_POST['email']; // required
    $type = $_POST['type']; // not required
    $comments = $_POST['message']; // required
     
    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
  if(!preg_match($email_exp,$email_from)) {
    $error_message .= 'The Email Address you entered does not appear to be valid.<br />';
  }
    $string_exp = "/^[A-Za-z .'-]+$/";
  if(!preg_match($string_exp,$first_name)) {
    $error_message .= 'The First Name you entered does not appear to be valid.<br />';
  }
  if(!preg_match($string_exp,$last_name)) {
    $error_message .= 'The Last Name you entered does not appear to be valid.<br />';
  }
  if(strlen($comments) < 2) {
    $error_message .= 'The Comments you entered do not appear to be valid.<br />';
  }
  if(strlen($error_message) > 0) {
    died($error_message);
  }
    $email_message = "Form details below.\n\n";
     
    function clean_string($string) {
      $bad = array("content-type","bcc:","to:","cc:","href");
      return str_replace($bad,"",$string);
    }
     
    $email_message .= "First Name: ".clean_string($first_name)."\n";
    $email_message .= "Last Name: ".clean_string($last_name)."\n";
    $email_message .= "Email: ".clean_string($email_from)."\n";
    $email_message .= "Type: ".clean_string($type)."\n";
    $email_message .= "Comments: ".clean_string($comments)."\n";
     
     
// create email headers
$headers = 'From: '.$email_from."\r\n".
'Reply-To: '.$email_from."\r\n" .
'X-Mailer: PHP/' . phpversion();
@mail($email_to, $email_subject, $email_message, $headers); 

// create and send receipt email
$email_rec = $email_from;
$email_bloom = "info@mybloomsday.ie";
$email_thanks= "Thank You ". $first_name . " for your message.\r\n We shall be in touch with you as soon as possible";
// create email headers
$headersrec = 'From: '.$email_bloom."\r\n".
'Reply-To: '.$email_bloom."\r\n" .
'X-Mailer: PHP/' . phpversion();
$thankssub = "My Bloomsday Thank You!";
@mail($email_rec, $thankssub, $email_thanks, $headersrec); 
?>
 
<!-- include your own success html here -->
 <div class="container">

      <div class="hero-unit">	<img src="img/jjsq.gif" height="129" width="90" align="right" valign="top">


        <h1 class="joyce">Contact Form Processing!</h1><p><br></p>
 <a class="btn btn-primary btn-large" href="download.html">Download the App &raquo;</a>

      </div>
<div class="span12">
 

Thank you for contacting us. We will be in touch with you very soon.<br>
 </div>
<?php
}
?>

<?php include 'footer.php'; ?>

