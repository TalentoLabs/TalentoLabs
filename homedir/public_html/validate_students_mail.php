<html>
  <body>

  <?php

    function decode($data){
      $data = trim( urldecode(strip_tags(@gzuncompress( base64_decode( $data)))));
      return $data;
    }

    echo "Teste de validacao de email de aluno...<br>";
    
    $user = $_GET['u'];
    $user_mail = decode($user);
    echo $user_mail;
    $rsConnection = mysql_connect("localhost", "jc", "1Allowme3" ,"usermanager");
    if ($rsConnection) {
      $sql = "SELECT email FROM `usermanager`.`student` WHERE email = '$user_mail'";
      $rsQuery = mysql_query($sql, $rsConnection);
      $linha = mysql_fetch_array($rsQuery);
      if ($user_mail== $linha[0]) {
        echo "Aluno encontrado!<br>";
      }
      else {
        echo "Aluno nao encontrado!<br>";
      }
      $sql = "UPDATE `usermanager`.`student` SET active = 'T' WHERE email = '$user_mail'";
      mysql_query($sql, $rsConnection);
      echo "Ativacao de aluno efetuada!";    
      mysql_close($rsConnection);
    }
  ?>

  </body>
</html>