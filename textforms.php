<?php session_start(); ?>
<!DOCTYPE HTML>
<html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"></meta>
  <meta lang="pt-br"></meta>
  <meta charset="utf-8"></meta>

  <title>ACAP - Área administrativa</title>

  <!-- Arquivos CSS -->
  <link rel="stylesheet" href="css/bootstrap.min.css"></link>
  <link rel="stylesheet" href="css/responsivefonts.css"></link>
  <link rel="stylesheet" href="css/styles.css"></link>
  <link rel="stylesheet" href="css/footer.css"></link>

  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
  <!-- Fim dos Arquivos CSS -->
  <style>
    div.card {
      margin: 1em;
      padding: 1em;
    }

    textarea.form-control {
      height: 33vh
    }

    #historiaTXT,
    #introTXT {
      overflow-y: scroll;
      max-height: 60vh;
    }
  </style>
</head>


  <header id="header" class="sticky-top navbar navbar-expand-md ">


    <div class="collapse navbar-collapse row" id="navbarNav">
      <a id="logo" class="navbar-brand col" href="#">
        <img class="border rounded-left border-secondary" src="img/logo.png" alt="LOGO" />
      </a>
      <ul class="navbar-nav col">
        <li class="nav-item">
          <a class="nav-link text-muted" href="/ACAP/content.html#intro">Ir ao site</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-muted" href="/ACAP/controller.php?task=LOGF">Log off</a>
        </li>
      </ul>
    </div>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
      aria-label="Toggle navigation">
      <i class="fas fa-angle-double-down"></i> ACAP
    </button>
  </header>


<?php if($_SESSION['authentication_status'] == True):?>

<body class="container-fluid">

  <hr>
  <div class="row">
    <div class="card col-md-6 col-sm-12">

      <h4 class="text-muted">Abaixo, você poderá preencher e editar os campos do site</h4>

      <form id="campos" method="POST" action="controller.php">

        <fieldset class="form-group card">
          <legend>Primeira Janela</legend>

          <label for="A1T">Título</label>
          <input class="form-control" type="text" id="A1T" name="introtitle"></input>
          <br>
          <hr>
          <label for="A1C">Conteúdo</label>
          <textarea class="form-control" form="campos" name="A1C"></textarea>
        </fieldset>

        <fieldset class="form-group card">
          <legend>Segunda Janela</legend>

          <label for="A2T">Título</label>
          <input class="form-control" type="text" id="A2T" name="historiatitle"></input>
          <br>
          <hr>
          <label for="A2C">Conteúdo</label>
          <textarea class="form-control" form="campos" name="A2C"></textarea>
          
          <label for="A2S">Assinatura</label>
          <input class="form-control" type="text" id="A2S" name="historiasignature" placeholder="Fulano de tal"></input>
          <input class="form-control" type="text" id="A2SS" name="historiasignaturecargo" placeholder="Auxiliar de limpeza"></input>
        </fieldset>

        <fieldset class="form-group card">
          <legend>Terceira Janela</legend>

          <label for="A3T">Título</label>
          <input class="form-control" type="text" id="A3t" name="A3T"></input>
          <br>
          <hr>
          <label for="A3C">Conteúdo</label>
          <textarea class="form-control" form="campos" name="A3C"></textarea>
          
          <label for="A2S">Assinatura</label>
          <input class="form-control" type="text" id="A2S" name="A2S" placeholder="Fulano de tal"></input>
          <input class="form-control" type="text" id="A2S" name="A2SS" placeholder="Auxiliar de limpeza"></input>
        </fieldset>

        <input type="hidden" value="SETCTT" name="task" />
        <input type="hidden" value="TXT" name="type" />
        <input type="submit" class="btn btn-success" value="Atualizar" />
      </form>
    </div>
    <div class="col">
      <div id="A1C" class="card">

      </div>
      <div class="card">
        <div id="A2C" class="row">
        </div>
      </div>
    </div>
<?php else:?>

<div class="container card">
<h1>Login de Administrador</h1>
<form action="controller.php" method="POST">
  
  <label for="token">Token de autenticação</label>
  <input class="form-control" type="text" name="token" placeholder="token de autenticação"/>
  <input type="hidden" name="task" value="AUTH"/>
  
  
</form>
</div>
<?php endif;?>
 </div>
  <script src="js/scripts.js">  </script>
</body>

</html>