<html>
  <body>

  <?php

    function encode($data){
      $data = urlencode(base64_encode(gzcompress($data)));
      return $data;
    }
 
  
    session_start();

    $pass_user= $_POST['pass_user'];
    $cpass_user= $_POST['cpass_user'];
    $name= $_POST['name'];
    $lastname= $_POST['lastname'];
    $email= $_POST['email'];
    $address= $_POST['address'];
    $cep= $_POST['cep'];
    $city= $_POST['city'];
    $state= $_POST['state'];
    $country= $_POST['country'];

    if ($email != '') {
      $rsConnection = mysql_connect("localhost", "jc", "1Allowme3" ,"usermanager");
      if ($rsConnection) {
        $sql = "SELECT email FROM `usermanager`.`student` where email = '" . $email . "'";
        $rsQuery = mysql_query($sql, $rsConnection);
        $linha = mysql_fetch_array($rsQuery);
        if ($linha[0] == $email) {
          echo "E-Mail ja cadastrado!<br>" . $linha[0];
        }
        else {
          if (($pass_user != '') || ($cpass_user != '')) {
            if ($pass_user == $cpass_user) {
              $sql = "INSERT INTO `usermanager`.`student` (pass, 
                                                         name, 
                                                         surname, 
                                                         email, 
                                                         address, 
                                                         cep_zip, 
                                                         city,
                                                         state, 
                                                         country,
                                                         active) 
                                           values ('" . $pass_user . "', '" . 
                                                        $name      . "', '" . 
                                                        $lastname  . "', '" . 
                                                        $email     . "', '" . 
                                                        $address   . "', '" . 
                                                        $cep       . "', '" .
                                                        $city      . "', '" .
                                                        $state     . "', '" . 
                                                        $country   . "', 
                                                        'F')";
              mysql_query($sql, $rsConnection);
              echo "Insercao de aluno efetuada!";
              $cryptmail = encode($email);
              $topic = "Cadastro no Talento-Labs.com";
              $msg = "<html>";
              $msg .= "<body>";
              $msg .= "Oi $email\r\n";
              $msg .= "<br>Voce efetuou um cadastro no Talento-Labs.com</br>";
              $msg .= "<br>Login: $email";
              $msg .= "<br>Senha: $pass_user";
              $msg .= "<br>Para ativar a conta <a href='www.talento-labs.com/validate_students_mail.php?u=$cryptmail'>Clique aqui!</a></br>";
              $msg .= "</body>";
              $msg .= "</html>";
              $headers = "MIME-Version: 1.0\r\n";
              $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
              $headers .= "From: Talento-Labs.com <$email>\r\n";
              mail($email, $topic, $msg, $headers);
            }
            else {
              echo "Os valores da senha e da confirmacao da senha estao diferentes!";
            }
          }
          else {
            echo "A senha e a confirmacao da senha nao podem ser vazias!";
          }
        }
        mysql_close($rsConnection);
      }
      else {
        echo ("! ! ! C O N N E C T I O N      E R R O R ! ! !".mysql_error());
      }
    }
    else {
      echo "O e-mail nao pode ser vazio!";
    }
  ?>

  </body>
</html>