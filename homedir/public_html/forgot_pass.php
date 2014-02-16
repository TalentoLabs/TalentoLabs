<html>
  <body>

  <?php

    $user_mail =  $_POST['user_mail'];
    echo "Teste de envio de senha de aluno...<br>";
    
    $rsConnection = mysql_connect("localhost", "jc", "1Allowme3" ,"usermanager");
    if ($rsConnection) {
      $sql = "SELECT email, pass FROM `usermanager`.`student` WHERE email = '$user_mail'";
      $rsQuery = mysql_query($sql, $rsConnection);
      $linha = mysql_fetch_array($rsQuery);
      if ($user_mail== $linha[0]) {
        echo "Aluno encontrado!<br>Enviando senha...";

        $tópico = "Cadastr";
	$mensagem = "<html>";
	$mensagem .= "<body>";
	$mensagem .= "Ol\r\n";
	$mensagem .= "<br>Voc efetuou um cadastro no .</br>";
	$mensagem .=	"<br>Login";
	$mensagem .=	"<br>Senha";
	$mensagem .=	"</body>";
	$mensagem .=	"</html>";
	$headers = "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
        $headers .= "From: $nome_site <$email>\r\n";
	mail($email, $tópico, $mensagem, $headers);               

        /*$topic = "Senha Talento-Labs.com";
        $msg = "<html>";
        $msg .= "<body>";
        $msg .= "Oi $email\r\n";
        $msg .= "<br>Sua senha atual: $linha[1]";
        $msg .= "</body>";
        $msg .= "</html>";
        $headers = "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
        $headers .= "From: Talento-Labs.com <$email>\r\n";
        mail($email, $topic, $msg, $headers);*/
      }
      else {
        echo "Aluno nao encontrado!<br>";
      }
      mysql_close($rsConnection);
    }
  ?>

  </body>
</html>