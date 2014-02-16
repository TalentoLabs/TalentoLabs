<html>
  <body>

  <?php
    session_start();

    $mail_user= $_POST['mail_user'];
    $pass_user= $_POST['pass_user'];

    if ($mail_user != '') {

      if ($pass_user != '') {
        
        $rsConnection = mysql_connect("localhost", "jc", "1Allowme3" ,"usermanager");

        if ($rsConnection) {

          $sql = "SELECT email, pass, active FROM `usermanager`.`student` where email = '" . $mail_user . "'";
          $rsQuery = mysql_query($sql, $rsConnection);
          $linha = mysql_fetch_array($rsQuery);
          if (($mail_user == $linha[0]) && ($pass_user == $linha[1])) {
            if ($linha[2] == 'T') {            
              echo "Logou!";
            }
            else {
              echo "E-Mail nao validado!<br>Por favor, ative sua conta clicando no link que lhe foi enviado por nós para o seu e-mail cadastrado!";
            }
          }
          else {
            echo "Erro no login!";
          }

          mysql_close($rsConnection);

        }
        else {
          echo ("! ! ! C O N N E C T I O N      E R R O R ! ! !<br>".mysql_error());
        }
      }
      else {
        echo "A Senha nao pode ser vazia!";
      }
    }
    else {
      echo "O e-mail nao pode ser vazio!";
    }
  ?>

  </body>
</html>