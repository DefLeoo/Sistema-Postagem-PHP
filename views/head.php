<?php  
  
  //Finalizar session...
  ob_start();
  session_start();
  if(!isset($_SESSION['usuariocoffee']) && (!isset($_SESSION['senhacoffee'])))
  {
     header("Location:../index.php?acao=negado");exit;

  }
  include '../app/conectar.php';
  include 'logout.php';
?>





<link rel="stylesheet" type="text/css" href="../public/css/bootstrap.css" />

<link rel="stylesheet" type="text/css" href="../public/css/style.css">

<script type="text/javascript" src="../public/js/bootstrap.min.js"></script>

<script type="text/javascript" src="../public/js/jquery.js"></script>

<script type="text/javascript" src="../public/js/jquery.maskedinput.min.js"></script>

