<?php
if(isset($_POST['email'])) {
	
	$email_to = "info@trackinyourlife.de";
    $email_subject = "Buy request form";
 
    function died($error) {
        // your error code can go here
        echo "We are very sorry, but there were error(s) found with the form you submitted. ";
        echo "These errors appear below.<br /><br />";
        echo $error."<br /><br />";
        echo "Please go back and fix these errors.<br /><br />";
        die();
    }
 
 
    // validation expected data exists
    if(!isset($_POST['first_name']) ||
        !isset($_POST['last_name']) ||
        !isset($_POST['strasse_name']) ||
        !isset($_POST['haus_number']) ||
        !isset($_POST['plz_number']) ||
        !isset($_POST['city']) ||
        !isset($_POST['email']) ||
        !isset($_POST['telephone']) ||
        !isset($_POST['items']) ||
        !isset($_POST['comments'])) {
        died('We are sorry, but there appears to be a problem with the form you submitted.');       
    }
 
     
 
    $first_name = $_POST['first_name']; // required
    $last_name = $_POST['last_name']; // required
    $co_name = $_POST['co_name']; // not required
    $strasse_name = $_POST['strasse_name']; // required
    $haus_number = $_POST['haus_number']; // required
    $plz_number = $_POST['plz_number']; // required
    $city = $_POST['city']; // required
    $email_from = $_POST['email']; // required
    $telephone = $_POST['telephone']; // not required
    $items = $_POST['items']; // required
    $comments = $_POST['comments']; // required
 
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
 
 // if(strlen($comments) < 2) {
 //   $error_message .= 'The Comments you entered do not appear to be valid.<br />';
 // }
 
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
    $email_message .= "CO: ".clean_string($co_name)."\n";
    $email_message .= "Street: ".clean_string($strasse_name)."\n";
    $email_message .= "Haus Number: ".clean_string($haus_number)."\n";
    $email_message .= "PLZ: ".clean_string($plz_number)."\n";
    $email_message .= "Stadt: ".clean_string($city)."\n";
    $email_message .= "Email: ".clean_string($email_from)."\n";
    $email_message .= "Telephone: ".clean_string($telephone)."\n";
    $email_message .= "Items to buy: ".clean_string($items)."\n";
    $email_message .= "Comments: ".clean_string($comments)."\n";
 
// create email headers
$headers = 'From: '.$email_from."\r\n".
'Reply-To: '.$email_from."\r\n" .
'X-Mailer: PHP/' . phpversion();
mail($email_to, $email_subject, $email_message, $headers);  
?>
 
<!-- include your own success html here -->
 
<img src="https://support.formstack.com/customer/portal/attachments/643564" alt width="500" 
height="250" align="middle">
<script type="text/javascript">
var timer = 3; //seconds
 website = "https://www.trackinyourlife.de"
function delayer() {
 window.location = website;
}
setTimeout('delayer()', 1000 * timer); 
</script>

<?php
 
}
?>
