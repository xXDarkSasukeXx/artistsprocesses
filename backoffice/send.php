<?php
require '../phpmailer/PHPMailerAutoload.php';
require '../functions/init.php';

$db = connectBdd();

$query = $db -> prepare('SELECT email FROM users WHERE id=:id ;');
$query ->execute([
  'id'=>$_GET['id']
]);
$result = $query->fetch();
print_r($result);
$mail = new PHPMailer;
$mail->setFrom($result['email'], "User#".$_GET['id']."");
$mail->addAddress('mounir.bakhalek@hotmail.fr', 'Admin');
$mail->Subject  = $_POST['object'];
$mail->Body     = $_POST['body'];
$mail->IsSMTP();
$mail->Host = "smtp.live.com";
$mail->SMTPAuth = true;
$mail->Port = 25;
$mail->Username = 'mounir.bakhalek@hotmail.fr';
$mail->Password = 'splanchnopleure1475963';
if(!$mail->send()) {
  echo 'Message was not sent.';
  echo 'Mailer error: ' . $mail->ErrorInfo;
} else {
  echo "<script type='text/javascript'>alert('Message has been sent.');</script>";
}
