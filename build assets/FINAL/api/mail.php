<?php 
require_once('phpmailer/PHPMailerAutoload.php');

$mail = new PHPMailer;
$mail->CharSet = 'utf-8';


$body = '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">';
$body .= '<html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"></head>';
$body .= '<body>';
$body .= '<table width="100%" bgcolor="#FFFFFF"><tbody><tr><td>';
$body .= '<br><br>';
$body .= '<table width="600" align="center" cellspacing="1" cellpadding="20" bgcolor="#E0E0E0"><tbody>';
$body .= '<tr>';
$body .= '<td bgcolor="#FFFFFF">';
$body .= '<p></p>';
foreach($_POST as $key => $value)
  {
    $body .= '<p><strong>'.$key." : </strong>".$value."</p>";
    
  }
$body .= '<p></p>';
$body .= '</td>';
$body .= '</tr></tbody></table>';
$body .= '</td></tr></tbody></table></body></html>';


//$mail->SMTPDebug = 3;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'mail.hafizovtimur.ru';  					// Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'no-reply@hafizovtimur.ru'; // Ваш логин от почты с которой будут отправляться письма
$mail->Password = '8R6f0M1y'; // Ваш пароль от почты с которой будут отправляться письма
$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 465; // TCP port to connect to / этот порт может отличаться у других провайдеров

$mail->setFrom('no-reply@hafizovtimur.ru'); // от кого будет уходить письмо?
$mail->addAddress('libafer99@yandex.ru');     // Кому будет уходить письмо 
//$mail->addAddress('ellen@example.com');               // Name is optional
//$mail->addReplyTo('info@example.com', 'Information');
//$mail->addCC('cc@example.com');
//$mail->addBCC('bcc@example.com');
//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
$mail->isHTML(true);      // Set email format to HTML

// === file send=== (атрибут name="file[]" включает в себя скобки)
$file = $_FILES['uploadedfile'];

if (!empty($file['name'][0])) {
    $uploadfile = tempnam(sys_get_temp_dir(), sha1($file['name'][0]));
    $filename = $file['name'][0];
    if (move_uploaded_file($file['tmp_name'][0], $uploadfile)) {
        $mail->addAttachment($uploadfile, $filename);
        $rfile[] = "Файл $filename прикреплён";
    } else {
        $rfile[] = "Не удалось прикрепить файл $filename";
    }   
}


$mail->Subject = 'Новая заявка с сайта project.ru';
$mail->Body    = $body;
$mail->AltBody = '';

$mail->send();
?>