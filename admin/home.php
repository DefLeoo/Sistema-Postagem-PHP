<!DOCTYPE html>
<html>
<head>

	<meta charset="utf-8">
	<title>Tela de produtos</title>

	   <?php require_once("../views/head.php"); ?>

</head>
<body>
     
    <div class="container-fluid">

        <?php require_once("../views/menu_principal.php");?>

      <div class="container">
          <div class="row">
              <div class="col-sm-3">
                <?php require_once '../views/menu_lateral.php';  ?>
              </div>

              <div class="col-sm-8">
                <?php 

                   if(isset($_GET['acao']))
                   {
                     $acao = $_GET['acao'];
                     if($acao=='welcome')
                     {
                       echo' 
                       <div class="alert alert-success">
                            "<strong>Olá user</strong> Bem vindo ao sistema"
                         </div> ';
                     }
                   }




                ?>

                <h2>Painel de administração do site.</h2>
                <p class="justify">
                  
                    
                    Painel de administração do site,sejam bem vindos,onde você terá acesso a todas as configuração do seu site...
                    Sejam bem vindo a nossa série de criando um sistema de postagem com PHP POO E PDO, espero qeu vocês gostem das aulas...
                     <strong>By Leonardo</strong> 

                </p>
                
              </div>
            
          </div>
        </div>

        <?php require_once '../views/footer.php'; ?>
    </div> 

</body>
</html>
