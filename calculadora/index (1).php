<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <title>Calculadora</title>
  <style>
    .center {
      display: flex;
      justify-content: left;

      height: 100vh;
    }
  </style>
</head>

<body class="center">
  <?php
  session_start();

  if (empty($_SESSION['calculo'])) {
    $_SESSION['calculo'] = '';
  }

  if (!empty($_POST['entrou'])) {
    $sSbsCalculo = substr($_SESSION['calculo'], -1);

    if ($_POST['valor'] != '=') {
      $_SESSION['calculo'] = sprintf('%s%s', $_SESSION['calculo'], $_POST['valor']);
    }

    if ($_POST['valor'] == '=' && (strpos($_SESSION['calculo'], '-') || strpos($_SESSION['calculo'], '+') || strpos($_SESSION['calculo'], '*') || strpos($_SESSION['calculo'], '/')) && ($sSbsCalculo != '*' && $sSbsCalculo != '+' && $sSbsCalculo != '-' && $sSbsCalculo != '/')) {
      $valor = $result = eval('return ' . $_SESSION['calculo'] . ';');
      unset($_SESSION['calculo']);
    } else {
      $valor = $_SESSION['calculo'];
    }

    if (($sSbsCalculo == '*' || $sSbsCalculo == '+' || $sSbsCalculo == '-' || $sSbsCalculo == '/') && ($_POST['valor'] == '+' || $_POST['valor'] == '-' || $_POST['valor'] == '/' || $_POST['valor'] == '*')) {
      $_SESSION['calculo'] = sprintf(substr($_SESSION['calculo'], 0, -1), $_POST['valor']);
    }

    if ($_POST['valor'] == 'C') {
      unset($_SESSION['calculo']);
      $valor = 0;
    }
  }
  ?>

  <form method="POST" style="width: 400px">
      <div class="mb-2">
        <input type="text" value="entrou" name="entrou" style="display:none;">
        <input type="text" disabled id="visor" value="<?= !empty($valor) ? $valor : 0 ?>" class="btn btn-outline-dark text-right">
      </div>
      <div class="mb-1">
        <input type="submit" value="7" name="valor" class="btn btn-lg btn-outline-success">
        <input type="submit" value="8" name="valor" class="btn btn-lg btn-outline-success">
        <input type="submit" value="9" name="valor" class="btn btn-lg btn-outline-success">
        <input type="submit" value="0" name="valor" class="btn btn-lg btn-outline-success">
      </div>
      <div class="mb-1">
        <input type="submit" value="4" name="valor" class="btn btn-lg btn-outline-success">
        <input type="submit" value="5" name="valor" class="btn btn-lg btn-outline-success">
        <input type="submit" value="6" name="valor" class="btn btn-lg btn-outline-success">
        <input type="submit" value="*" name="valor" class="btn btn-lg btn-outline-danger">
      </div>
      <div class="mb-1">
        <input type="submit" value="1" name="valor" class="btn btn-lg btn-outline-success">
        <input type="submit" value="2" name="valor" class="btn btn-lg btn-outline-success">
        <input type="submit" value="3" name="valor" class="btn btn-lg btn-outline-success">
        <input type="submit" value="-" name="valor" class="btn btn-lg btn-outline-danger">
      </div>
      <div>
        <input type="submit" value="/" name="valor" class="btn btn-lg btn-outline-danger">
        <input type="submit" value="C" name="valor" class="btn btn-lg btn-outline-warning">
        <input type="submit" value="=" name="valor" class="btn btn-lg btn-outline-success">
        <input type="submit" value="+" name="valor" class="btn btn-lg btn-outline-danger">
      </div>
  </form>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>