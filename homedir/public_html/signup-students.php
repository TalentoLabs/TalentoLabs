<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="../../assets/ico/favicon.ico">

    <title>Cadastro de aluno</title>

    <link href="bootstrap.min.css" rel="stylesheet">

    <link href="course.css" rel="stylesheet">

    <link href="carousel.css" rel="stylesheet">


    <style type="text/css">
      #rec {
        position: relative;
        left: 10px;
        top: 5px;
      }    
    </style>

    <!-- Custom styles for this template -->
    <link href="signin-students.css" rel="stylesheet">

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

      <!--Left column can be used for content or not, but should always be here to centralise the style -->
      <div class="leftcolumn">
        <ul>
          <!--<a href="#"><li><img src="img/aulas.png"></li></a>
          <a href="#"><li><img src="img/materiais.png"></li></a>
          <a href="#"><li><img src="img/progresso.png"></li></a>-->
      </div>
      <div class="centercolumn">


          <div class="signup-form">
            <!--<div class="log" id="rec">--> 

            <!-- multistep form -->
              <form name="login" action="signup_students.php" method=POST id="msform">
                <!-- progressbar -->
                <ul id="progressbar">
                  <li class="active">Login e Senha</li>
                  <li>Escolaridade</li>
                  <li>Personal Details</li>
                </ul>
                <!-- fieldsets -->
                <fieldset>
                  <h2 class="fs-title">Crie a sua conta</h2>
                  <h3 class="fs-subtitle">Esses são os seus dados de login</h3>
                  <input type="text" name="email" placeholder="Email que servirá para seu login" />
                  <input type="password" name="pass_user" maxlength="40" placeholder="Senha" />
                  <input type="password" name="cpass_user" maxlength="40" placeholder="Confirme sua senha" />
                  <input type="button" name="next" class="next action-button" value="Próximo" />
                </fieldset>
                <fieldset>
                  <h2 class="fs-title">Escolaridade</h2>
                  <h3 class="fs-subtitle">Preencha com os seus dados mais recentes</h3>
                  <input type="text" name="university" placeholder="Qual a sua universidade? Ex: Universidade de São Paulo" />
                  <input type="text" name="unicourse" placeholder="Qual o seu curso? Ex: Administração de Empresas" />
                  <input type="text" name="uniconclusion" placeholder="Qual o seu ano de conclusão? Ex: 2015" />
                  <input type="button" name="previous" class="previous action-button" value="Anterior" />
                  <input type="button" name="next" class="next action-button" value="Próximo" />
                </fieldset>
                <fieldset>
                  <h2 class="fs-title">Dados pessoais</h2>
                  <h3 class="fs-subtitle">Nunca venderemos seus dados para ninguém</h3>
                  <input type="text" name="name" placeholder="Primeiro Nome" />
                  <input type="text" name="lastname" placeholder="Sobrenome" />
                  <input type="text" name="city" placeholder="Cidade" />
                  <textarea name="summary" placeholder="Descreva um pouco da sua personalidade em um parágrafo."></textarea>
                  <input type="button" name="previous" class="previous action-button" value="Anterior" />
                  <input type="submit" name="submit" class="submit action-button" value="Enviar" />
                </fieldset>
              </form>

              <!-- jQuery -->
              <script src="js/jquery-1.9.1.min.js" type="text/javascript"></script>
              <!-- jQuery easing plugin -->
              <script src="js/jquery.easing.min.js" type="text/javascript"></script>

              <!-- Direciona para a página do InsertNewUser 
              <form name="login" action="signup_students.php" method=POST>

                <td nowrap='nowrap' align='left'>
                  <p>E-Mail  <big><font color="red">*</font></big></p>
                </td>
                <td width="500px" >
                  <input type='text' style='width:250px;'  maxlength='200' name='email' />
                </td>
                <td nowrap='nowrap' align='left'>
                  <p><small>(este será seu usuário para o login)</small></p>
                </td>
                <td nowrap='nowrap' align='left'>
                  <p>Senha  <big><font color="red">*</font></big></p>
                </td>
                <td width="500px" >
                  <input type='password' style='width:150px;'  maxlength='40' name='pass_user' />
                </td>
                <br>
                <td nowrap='nowrap' align='left'>
                  <p>Confirme a Senha  <big><font color="red">*</font></big></p>
                </td>
                <td width="500px" >
                  <input type='password' style='width:150px;'  maxlength='40' name='cpass_user' />
                </td>

                <br><br><br>
                <td nowrap='nowrap' align='left'>
                  <p>Nome</p> 
                </td>
                <td width="500px" >
                  <input type='text' style='width:250px;'  maxlength='200' name='name' />
                </td>
                <br>
                <td nowrap='nowrap' align='left'>
                  <p>Sobrenome</p> 
                </td>
                <td width="500px" >
                  <input type='text' style='width:250px;'  maxlength='200' name='lastname' />
                </td>
                <br>
                <td nowrap='nowrap' align='left'>
                  <p>Endereço</p> 
                </td>
                <td width="500px" >
                  <input type='text' style='width:250px;'  maxlength='200' name='address' />
                </td>
                <br>
                <td nowrap='nowrap' align='left'>
                  <p>Cidade</p> 
                </td>
                <td width="500px" >
                  <input type='text' style='width:250px;'  maxlength='200' name='city' />
                </td>
                <br>
                <td nowrap='nowrap' align='left'>
                  <p>CEP</p> 
                </td>
                <td width="100px" >
                  <input type='text' style='width:100px;'  maxlength='10' name='cep' />
                </td>
                <br>
                <td nowrap='nowrap' align='left'>
                  <p>Estado</p> 
                </td>
                <td width="500px" >
                  <input type='text' style='width:250px;'  maxlength='200' name='state' />
                </td>

                <br>
                <td nowrap='nowrap' align='left'>
                  <p>País</p> 
                </td>
                <td width="500px" >
                  <input type='text' style='width:250px;'  maxlength='200' name='country' />
                </td>
                
                <br><br>
                <td nowrap='nowrap' align='left'>
                  <p><big><font color="red">* Campos obrigatórios</font></big></p>
                </td>

                <td nowrap='nowrap' align='left'>
                  <input type='submit' class="signin-button" value='Enviar' />
                </td>

              </form>-->
            </div>
          </div>
        </tr>
      </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/signup.js" type="text/javascript"></script>
    
  </body>
</html>