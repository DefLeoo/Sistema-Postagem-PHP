<?php

  try
  {

  	//se der tudo certo executa...
  	$conexao = new PDO('mysql:host=localhost;dbname=Postagem2','root','senha');
  	
  	$conexao -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

  }catch(PDOException $e)
  { 
  	//se der erro executa isso...
  	print "ERROR" . $e->getMessage();
      
  }







?>