<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="../../assets/ico/favicon.ico">

    <title>Esqueci minha senha!</title>

    <link href="bootstrap.min.css" rel="stylesheet">

    <style type="text/css">
      #rec {
        position: relative;
        left: 10px;
        top: 5px;
      }    
    </style>

    <!-- Custom styles for this template -->
    <link href="signin-students.css" rel="stylesheet">

    <link href="carousel.css" rel="stylesheet">
  </head>

  <body>

    <div class="navbar navbar-default navbar-static-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.html"><img src="img/logo.png"></a>
        </div>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="http://www.talento-labs.com/blog">Blog</a></li>
            <li><a href="sobre.html">Sobre o Talento Labs</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Login <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="#">Alunos</a></li>
                <li class="divider"></li>
                <li><a href="#">Empresas</a></li>
              </ul>
            </li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>

    <div class="container"> 
      <div class="centercolumn">
        <tr>
          <br><br><br><br><br><br>

          <div style="background-color:lightgrey;width:550px;height:550px;border:1px solid white">
            <div class="log" id="rec"> 
            <h2>Envio de senha</h2>
            <br>

            <form name="login" action="forgot_pass.php" method=POST>

              <td nowrap='nowrap' align='left'>
                <p>e-mail:</p> 
              </td>
              <td width="500px" >
                <input type='text' style='width:250px;'  maxlength='200' name='mail_user' />
              </td>
              <td nowrap='nowrap' align='left'>
                <small><br>(informe seu e-mail cadastrado no site e lhe enviaremos sua senha)</small> 
              </td>

              <br>
              <td nowrap='nowrap' align='left'>
                <input type='submit' class="signin-button" value='Ok' />
              </td>
          
            </form>

            </div>
          </div>
        </tr>
      </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    
  </body>
</html>