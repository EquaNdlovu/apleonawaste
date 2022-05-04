<?php require APPROOT . '/views/inc/login_header.php'; ?>
<?php
require APPROOT . '/views/inc/PHPMailer/src/Exception.php';
require APPROOT . '/views/inc/PHPMailer/src/PHPMailer.php';
require APPROOT . '/views/inc/PHPMailer/src/SMTP.php';
?>

<?php

/**
 * This example shows making an SMTP connection with authentication.
 */

//Import the PHPMailer class into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

//SMTP needs accurate times, and the PHP time zone MUST be set
//This should be done in your php.ini, but this is how to do it if you don't have access to that
date_default_timezone_set('Etc/UTC');

//require '../vendor/autoload.php';

//Create a new PHPMailer instance
$mail = new PHPMailer();
//Tell PHPMailer to use SMTP
$mail->isSMTP();
//Enable SMTP debugging
//SMTP::DEBUG_OFF = off (for production use)
//SMTP::DEBUG_CLIENT = client messages
//SMTP::DEBUG_SERVER = client and server messages
//$mail->SMTPDebug = SMTP::DEBUG_SERVER;
//Set the hostname of the mail server
$mail->Host = 'smtp.gmail.com';
//Set the SMTP port number - likely to be 25, 465 or 587
$mail->Port = 587;
//Whether to use SMTP authentication
$mail->SMTPAuth = true;
//Username to use for SMTP authentication
$mail->Username = 'apleonaireland@gmail.com';
//Password to use for SMTP authentication
$mail->Password = 'Trantrax$r';
//Set who the message is to be sent from
$mail->setFrom('wasteportal@apleona.com', 'Waste Portal');
//Set an alternative reply-to address
$mail->addReplyTo('noreply@apleona.com', 'Waste Portal');
//Set who the message is to be sent to
$mail->addAddress($_SESSION['email']);
//Set the subject line
$mail->Subject = 'Waste Portal OTP Password Reset Code';
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
$mail->msgHTML($_SESSION['message']);
//Replace the plain text body with one created manually
$mail->AltBody = 'This is a plain-text message body';

//send the message, check for errors
if (!$mail->send()) {
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message sent!';
}
?>

 
        <form class="auth-form" action="<?php echo URLROOT; ?>/users/reset_code" method="post">
          <div class="form-group">
          <label for="otp">An OTP code has been sent to your email <sup></sup></label>
            <input class="form-control <?php echo (!empty($data['otp-error'])) ? 'is-invalid' : ''; ?>" type="number" name="otp" placeholder="Enter code" required>
            <span class="invalid-feedback"><?php echo $data['otp-error']; ?></span>
          </div>
          <div class="row">
            <div class="col">
              <input type="submit" name="check-reset-otp" value="Submit" class="btn btn-success btn-block">
            </div>
            <div class="col">
             
            </div>
          </div>
        </form>
 

<?php require APPROOT . '/views/inc/login_footer.php'; ?>