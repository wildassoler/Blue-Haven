<?php
    $msg = "";

    if (isset($_POST['enviar'])) {
            require 'phpmailer-file/PHPMailerAutoload.php';

            function sendemail($to, $from, $fromName, $body, $attachment) {
                $mail = new PHPMailer();
                $mail->CharSet = 'UTF-8';
                $mail->IsSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->Port = 587; 
                $mail->SMTPAuth = true;
                $mail->Username = 'projetoblueheaven@gmail.com';
                $mail->Password = '12345';
                $mail->setFrom($from, $fromName);
                $mail->addAddress($to);
                $mail->addReplyTo($from, $fromName);
                $mail->addAttachment($attachment);
                $mail->Subject = 'Currículo - Trabalhe Conosco';
                $mail->Body = $body;
                $mail->IsHTML = false;

                if(!$mail->send()) {
                   echo 'Mailer error: ' . $mail->ErrorInfo;
                   return false;
                } else 
                   return true;
            }

            $name = $_POST['nome'];
            $email = $_POST['email'];
            $to = 'projetoblueheaven@gmail.com';

            $body = "$name\n$email";

            $file = "anexos/" . basename($_FILES['curriculo']['name']);
            $extension = pathinfo($file, PATHINFO_EXTENSION);
            
            if ($_FILES['curriculo']['size'] > 1000000)
            $msg = "O tamanho máximo permitido para o arquivo é de 1MB."; // O tamanho é em bytes
            else if ($extension != "pdf" && $extension != "jpg" && $extension != "jpeg" && $extension != "png") // Coloque aqui as extensões permitidas
            $msg = "ERRO! Envie apenas nos formatos PDF, JPG ou PNG."; // Mensagem de erro de formato
            else if (move_uploaded_file($_FILES['curriculo']['tmp_name'], $file)) {
                if (sendemail($to, $email, $name, $body, $file)) {
                    $msg = 'Enviado com sucesso!'; // Mensagem de sucesso
                } else
                    $msg = 'Erro no envio! Envie um e-mail para contato@blueheaven.com'; // Mensagem de erro no envio
            } else
                $msg = "Por favor, confira seu anexo ou envie um e-mail para contato@blueheaven.com"; // Mensagem de erro no envio
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="description" content="Agende salto de paraquedas, voo de asa-delta e passeio de balão." />
    <meta property="og:title" content="Blue Heaven | Descubra a sensação de voar." />
    <meta property="og:description" content="Agende salto de paraquedas, voo de asa-delta e passeio de balão." />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="https://www.tigercodes.com.br/projetos/blue-heaven/" />
    <meta property="og:image" content="https://www.tigercodes.com.br/projetos/blue-heaven/img/og-blue-heaven.png" />

    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/sobre.css">
    <link rel="stylesheet" href="css/passeios.css">
    <link rel="stylesheet" href="css/contato.css">
    <link rel="stylesheet" href="css/trabalhe-conosco.css">
    <link rel="stylesheet" href="css/responsivo.css">

    <script>document.documentElement.classList.add("js");</script>
    
    <title>Blue Heaven | Trabalhe conosco</title>
</head>
<body>
    <header class="header">
        <nav class="container header-container" data-animate="scroll">
            <a href="./"> <img src="img/blue-heaven.svg" alt="Logo da Blue blue-heaven"></a>
            <button data-menu="hamburguer" aria-controls="menu">Menu</button>
            <ul data-menu="lista" id="menu">
                <li><a href="./">Home</a></li>
                <li><a href="sobre.html">Sobre</a></li>
                <li><a href="passeios.html">Passeios</a></li>
                <li><a class="ativo" href="contato.html">contato</a></li>
            </ul>
        </nav>
    </header>
    <section class="main trabalhe-conosco">
        <div class="container" data-animate="scroll">
            <h1>Trabalhe conosco</h1>
            <p>Junte-se ao Time</p>
        </div>
    </section>

    <section class="container procura-se" data-animate="scroll">
        <h1 class="titulo">Procuramos pessoa como voce!</h1>
        <form method="POST" action="./trabalhe-conosco.php" enctype="multipart/form-data" class="form">
            <label for="Nome">Nome</label>
            <input type="text" name="nome" id="nome" required>
            <label for="email">E-mail</label>
            <input type="email" name="mail" id="email" required>
            <label for="curriculo">curriculo</label>
            <input type="file" name="curriculo" id="curriculo" class="curriculo" required >
            <button class="cta" type="submit" name="enviar" id="enviar">Enviar</button>
        </form>
        <div style="text-aling: center; margin-top: 1rem;">
            <?php echo $msg; ?>
        </div>
    </section>

    <footer class="footer">
        <div class="container"></div>
            <ul class="footer-container">
                <li>
                    <h2>Localizacao</h2>
                    <p>Rua Céu Azul, 123 <br> Bairro das Nuvens <br> Sao Paulo - SP 
                    Clique aqui para abrir o mapa.
                    </p>
                    <a href="#">Clique aqui para descobrir no mapa.</a>
                </li>
                <li>
                    <h2>Mapa do site</h2>
                    <ul class="mapa-do-site">
                        <li><a href="./">- Home</a></li>
                        <li><a href="sobre.html">- Sobre</a> </li>
                        <li><a href="passeios.html">- Passeios</a></li>
                        <li><a href="contatos.html">- Contatos</a></li>
                        <li><a href="trabalhe.conosco"></a> - Trabalhe conosco</li>
                    </ul>
                </li>
                <li>
                    <h2>Contato</h2>
                    <ul class="footer-contato">
                        <li><a href="tel: +5511999999"> +55 (11) 99999-9999</a></li>
                        <li><a href="mailto:contato@blueheaven.com">contato@blueheaven.com</a></li>
                    </ul>
                </li>
                <li>
                    <h2>Redes Sociais</h2>
                    <ul class="redes-sociais">
                        <li><a href="https://www.facebook.com"><img src="img/facebook.svg" alt="facebook" target="_black"></a> </li>
                        <li><a href="https://www.instagram.com"><img src="img/instagram.svg" alt="instagram" target="_black"> </a> </li>
                        <li><a href="https://www.whatsapp.com"><img src="img/whatsapp.svg" alt="whatsapp" target="_black"> </a> </li>
                        <li><a href="https://www.youtube.com"><img src="img/youtube.svg" alt="youtube" target="_black"> </a> </li>
                    </ul>
                </li>
            </ul>
        </div>
        <div class="copyright">
            <p>Copyright @ 2021 Blue Heaven. Todos os direotos reservados.</p>
            <p>Este site é um projeto Tiger Codes. Mais informacoes em tigercodes.com.br</p>
        </div>
    </footer>
    <script src="./js/script.js" type="module"></script>
</body>
</html>