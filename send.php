<?php
  
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require './PHPMailer/src/Exception.php';
require './PHPMailer/src/PHPMailer.php';
require './PHPMailer/src/SMTP.php';
  
// Faça edições aqui:
$email_address = 'contato@blueheaven.com'; // E-mail do site (ex.: contato@seusite.com).
$email_pw = '12345'; // Senha do e-mail.

$site_name = 'Blue Heaven'; // Nome do site.
$site_url = 'https://www.tigercodes.com.br/projetos/blueheaven/'; // URL do site.

$smtp_host = 'smtp.kinghost.net'; // Host SMTP (ex.: smtp.domain.com.br).
$host_port = '587'; // Porta do Host, geralmente 587 ou 465.

// Não faça edições daqui para baixo:
$email = $_POST['email'];
$name = $_POST['nome'];

// Inicia loop por cada field do formulário.
$body_content = '';
foreach( $_POST as $field => $value) {
  if( $field !== 'enviar') {
    $sanitize_value = filter_var($value, FILTER_SANITIZE_STRING);
    $body_content .= $field . ': ' . $value . "\n";
  }
}

if ($body_content) {

// Inicia novo objeto PHPMailer.
$mail = new PHPMailer(true);

try {
  $mail->CharSet = 'UTF-8';
  
  //$mail->SMTPDebug = 3; // Descomente isto caso queira debugar.
  $mail->isSMTP();
  $mail->Host = $smtp_host;
  $mail->SMTPAuth = true;
  $mail->Username = $email_address;
  $mail->Password = $email_pw;
  $mail->Port = $host_port; 
  $mail->SMTPSecure = 'tls'; // O Protocolo SSL e/ou TLS.
  
  $mail->setFrom($email, 'Formulário - '. $name);
  $mail->addAddress($email_address, $site_name);
  $mail->addReplyTo($email, $name);
  
  $mail->WordWrap = 70;
  $mail->Subject = 'Formulário - ' . $site_name . ' - ' . $name;
  $mail->Body = $body_content;
  
  $mail->send();
?>

  <html>
    <head>
      <title>Formulário enviado</title>
      <meta http-equiv="refresh" content="10;URL='./'">
    </head>
    <body>
      <!-- Mensagem de sucesso -->
      <div id="form-success">
        <h2>Mensagem enviada.</h2>
        <p>Agradecemos o seu contato e retornaremos em breve.</p>
      </div>
    </body>
  </html>

<?php } catch (Exception $e) { ?>

  <html>
    <head>
      <title>Erro no envio</title>
      <meta http-equiv="refresh" content="10;URL='./'">
    </head>
    <body>
      <!-- Mensagem de erro -->
      <div id="form-error">
        <h2>Oops! Um erro ocorreu.</h2>
        <p>Tente de novo ou envie um e-mail para <?php echo $email_address; ?></p>
      </div>
    </body>
  </html>

<?php
  }}
?>