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


<?php if($_SESSION['authentication_status'] = True):?>

<body class="container-fluid">


  <header id="header" class="sticky-top navbar navbar-expand-md ">


    <div class="collapse navbar-collapse row" id="navbarNav">
      <a id="logo" class="navbar-brand col" href="#">
        <img class="border rounded-left border-secondary" src="img/logo.png" alt="LOGO" />
      </a>
      <ul class="navbar-nav col">
        <li class="nav-item">
          <a class="nav-link text-muted" href="http://www.acap.com.br/#intro">Ir ao site</a>
        </li>
      </ul>
    </div>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
      aria-label="Toggle navigation">
      <i class="fas fa-angle-double-down"></i> ACAP
    </button>
  </header>



  <hr>
  <div class="row">
    <div class="card col-md-6 col-sm-12">

      <h4 class="text-muted">Abaixo, você poderá preencher e editar os campos do site</h4>

      <form id="campos" method="POST" action="controller.php">

        <fieldset class="form-group card">
          <legend>Primeira Janela</legend>

          <label for="introtitle">Título</label>
          <input class="form-control" type="text" id="introtitle" name="introtitle"></input>
          <br>
          <hr>
          <label for="intro">Conteúdo</label>
          <textarea class="form-control" form="campos" name="intro"></textarea>
        </fieldset>

        <fieldset class="form-group card">
          <legend>Segunda Janela</legend>

          <label for="historiatitle">Título</label>
          <input class="form-control" type="text" id="historiatitle" name="historiatitle"></input>
          <br>
          <hr>
          <label for="historia">Conteúdo</label>
          <textarea class="form-control" form="campos" name="historia"></textarea>
        </fieldset>

        <input type="hidden" value="SETCTT" name="task" />
        <input type="hidden" value="TXT" name="type" />
        <input type="submit" class="btn btn-success" value="Atualizar" />
      </form>
    </div>
    <div class="col">
      <div id="introTXT" class="card">

      </div>
      <div class="card">
        <div id="historiaTXT" class="row">
        </div>
      </div>


    </div>
  </div>
  <script src="js/scripts.js">  </script>
</body>

</html>

<?php else:?>

<?php endif;?>