<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Contact</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
  </head>
  <body>
    <div class="container">
      <img src="img/Logo.png"  alt="Responsive image">

      <ul class="nav nav-tabs">
    <?php  

      $myNav = ["Home", "About", "Portfolio", "Kontakt", "Login"];
      $myHref = ["home.php","home.php","home.php","contact.php","home.php"];

  for ($i=0; $i < sizeof($myNav); $i++) {

  echo "<li role=\"presentation\"><a href=\"$myHref[$i]\">$myNav[$i]</a></li>"; 

   } ?>
      </ul>
      <h1>Kontakt</h1>

      <?php

    if (!isset($_POST['btnSubmit'])) {
      ?>
      <h3>Wir freuen uns auf Ihre Anfrage!</h3> 
    <form action="#" method="post">
      <div class="form-group">
        <h4>Der Grund für Ihre Anfrage</h4>
        
        <div class="radio">
        <label><input type="radio" name="reason" value="Freie Stelle">Freie Stelle<br></label>
        </div>
        
        <div class="radio">
        <label><input type="radio" name="reason" value="Produktreklamation">Produktreklamation<br></label>
        </div>
        
        <div class="radio">
        <label><input type="radio" name="reason" value="Produktneuheiten">Produktneuheiten<br><br></label>
        </div>
      </div>

      <div class="form-group">
        <h4>Anrede</h4>

        <label class="radio-inline"><input type="radio" name="gender" value="Herr" required>Männlich</label>
        <label class="radio-inline"><input type="radio" name="gender" value="Frau" required>Weiblich</label>        
      </div>

      <div class="form-group">
    <label >Vorname
    <input type="text" class="form-control" name="Vorname" placeholder="Vorname">
    </label>
    <label >Nachname
    <input type="text" class="form-control" name="Nachname" placeholder="Nachname">
    </label>
      </div>
      <div class="form-group">
    <label>PLZ
    <input type="text" class="form-control" name="PLZ" placeholder="Postleitzahl">
    </label>
      </div>
      <div class="form-group">
    <label>Email address
    <input type="email" class="form-control" name="Email" placeholder="Email">
    </label>
      </div>
    <h4>Anfrage</h4>
    <textarea class="form-control" rows="3" name="text"></textarea>

     <button class="btn btn-default" type="submit" name="btnSubmit">Absenden</button>
    </form>
    <?php
    }
    else {  
      ?>
      <p>Herzlichen Dank für Ihre Anfrage! Aufgrund unseres derzeitigen Anfragevolumens kann die Beantwortung Ihrer Anfrage längere Zeit in Anspruch nehmen. Wir bitten um Ihr Verständnis und melden uns sobald als möglich bei Ihnen.</p>
      <p>Ihr Das-Logo Team</p>


      <div class="panel panel-primary">
    <div class="panel-heading">.:: Mail Report ::.</div>
    <div class="panel-body">
   <?php
    
    require 'pwd.php';  
    require 'vendor/autoload.php';

    //Create a new PHPMailer instance
    $mail = new PHPMailer;

    //Tell PHPMailer to use SMTP
    $mail->isSMTP();

    //Enable SMTP debugging
    // 0 = off (for production use)
    // 1 = client messages
    // 2 = client and server messages
    $mail->SMTPDebug = 2;

    //Ask for HTML-friendly debug output
    $mail->Debugoutput = 'html';

    //Set the hostname of the mail server
    $mail->Host = 'smtp.gmail.com';//@TODO
    // use
    // $mail->Host = gethostbyname('smtp.gmail.com');
    // if your network does not support SMTP over IPv6

    //Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
    $mail->Port = 587; //@TODO

    //Set the encryption system to use - ssl (deprecated) or tls
    $mail->SMTPSecure = 'tls'; //@TODO

    //Whether to use SMTP authentication
    $mail->SMTPAuth = true;

    //Username to use for SMTP authentication - use full email address for gmail
    $mail->Username = "rafi.zeiler@gmail.com";//@TODO

    //Password to use for SMTP authentication
    $mail->Password = "$pwd"; //@TODO

    //Set who the message is to be sent from
    $mail->setFrom('from@example.com', 'First Last');

    //Set an alternative reply-to address
    $mail->addReplyTo('replyto@example.com', 'First Last');

    //Set who the message is to be sent to
    $mail->addAddress('r.zeiler@htlkrems.at', 'Mr. X');
    
    $reason = $_POST['reason'];
    $gender = $_POST['gender'];
    $vorname = $_POST['Vorname'];
    $nachname = $_POST['Nachname'];
    $plz = $_POST['PLZ'];
    $email = $_POST['Email'];
    $text = $_POST['text'];

    //Set the subject line
    $mail->Subject = "Anfrage fuer $reason";

    //Read an HTML message body from an external file, convert referenced images to embedded,
    //convert HTML into a basic plain-text alternative body
    $mail->Body    = "$reason $gender $vorname $nachname $plz $email $text";

    //Replace the plain text body with one created manually
    $mail->AltBody = 'This is a plain-text message body';

    //Attach an image file
    //$mail->addAttachment('images/phpmailer_mini.png');

    //send the message, check for errors
    if (!$mail->send()) {
        echo "Mailer Error: " . $mail->ErrorInfo;
    } else {
        echo "Message sent!";
    }

    ?>
    </div>
  </div>  
      <?php 

      }
    ?>

    </div>
  </body>
</html>
      