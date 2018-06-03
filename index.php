<?php  
  
  //Comprovar session...
  ob_start();
  session_start();
  if(isset($_SESSION['usuariocoffee']) && (isset($_SESSION['senhacoffee'])))
  {
     header("Location:admin/home.php");exit;
  }
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	    <!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

	<style>

	    body
	    {
	    	background-color:#E6E7E7 ; 
	    }
		
		.formulario
		{
			width: 400px;
			height: 400px;
			text-align: center;
			margin-left: 35%;
			margin-top: 140px;
			border-radius: 20px;
			background-color:#0612F3;
		}

		.form-group
		{
			width: 80%;
			margin-left: 40px;
		}

		.form-group label
		{ 
           margin-top: 20px;
           color: #fff;
           font-size: 20px;
		}
        
        .checkbox
        {
        	color: #fff;
        }
	</style>

</head>
<body>

<div class="formulario">
<?php
    
    if(isset($_GET['acao']))
    {
      if(!isset($_POST['logar'])){

      $acao = $_GET['acao'];
      if($acao =='negado')
      {
           echo'<div class="alert alert-danger">
                   "Você precisa estar logado <strong>para acessar o sistema</strong>"
                </div> ';
      }
       }
    }



?>
<?php
  
  include 'app/conectar.php';

  




  if(isset($_POST['logar']))
  {
     //RECUPRERANDO OS DADOS DO FORMULÁRIO...
     $usuario = trim(strip_tags($_POST['usuario']));
     $senha = trim(strip_tags($_POST['senha']));

     //FAZENDO A SELEÇÃO NO BANCO DE DADOS..
     $select ="SELECT * FROM login WHERE BINARY usuario=:usuario AND BINARY senha=:senha";

     try
     {

     	$result = $conexao->prepare($select);
     	$result->bindParam(':usuario', $usuario, PDO::PARAM_STR);
     	$result->bindParam(':senha', $senha, PDO::PARAM_STR);
     	$result->execute();

     	//Para contar os registros da tabela
     	$contar = $result->rowCount();

     	if($contar>0)
     	{
           $usuario = ['usuario'];
           $senha = ['senha'];

           $_SESSION['usuariocoffee'] = $usuario;
           $_SESSION['senhacoffee'] = $senha;
          
         
     	   echo' <div class="alert alert-success">
                      "<strong>Logado</strong> com sucesso"
                 </div> ';

           header("Refresh:1, admin/home.php?acao=welcome");
          
     	} else
     	{
     	    echo'<div class="alert alert-danger">
                   "Os dados digitados estão <strong>incorretos</strong>"
                </div> ';
     	}

     } catch(PDOException $e)
     { 
        echo "ERROR" . $e->getMessage();
     }
  }
?>
	 <form action="#" method="POST" enctype="multipart/form-data" >

		  <div class="form-group">
		    <label for="exampleInputEmail1">Usuário : </label>
		    <input type="text" class="form-control" name="usuario" placeholder="User name">
		  </div>

		  <div class="form-group">
		    <label for="exampleInputPassword1">Password : </label>
		    <input type="password" class="form-control" name="senha" placeholder="Password">
		  </div>
		  
		  <div class="checkbox">
		    <label>
		      <input type="checkbox"> Check me out
		    </label>
		  </div>
		  <input type="submit" name="logar" value="Logar" class="btn btn-default">
          
	</form>
</div>

</body>
</html>