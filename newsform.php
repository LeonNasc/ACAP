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


<?php else:?>


<?php endif;?>
 </div>
  <script src="js/scripts.js">  </script>
</body>

</html>