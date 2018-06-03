<?php 
   ini_set("display_errors",1);
   ini_set("display_startup_erros",1);
   error_reporting(E_ALL);
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Usuário</title>
    
  <?php include '../views/head.php';?>
    
 <script type="text/javascript">
    jQuery(function($) {
    $.mask.definitions['~']='[+-]';
    $('#data').mask('99/99/9999');
  
  });
  </script>

</head>
<body>

   <div class="container-fluid">

   	  <?php include'../views/menu_principal.php'; ?>

   	  <div class="container-fluid">
   	  	<div class="row">
   	  		 <div class="col-sm-3">

   	  		 	<?php require_once '../views/menu_lateral.php'; ?>
   	  		 	
   	  		 </div>

   	  		 <div class="col-sm-8">
               <div class="panel-usuario">
	   	  		 	<ol class="breadcrumb">

		                <li><a href="home.php"> <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> Home </a></li>

		                <li><a href="site.php"> <span class="glyphicon glyphicon-picture" aria-hidden="true"></span> Visualizar</a></li>

                    <li><a href="ver-postagem.php"> <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> Visualizar todas as postagens</a></li>

		                 <li><a href="cad-postagem.php"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Casdastrar </a></li>
		                
	                </ol>

               </div>

                 <div class="panel panel-default">
                   <div class="panel-heading">
                      <h3 class="panel-title"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>  Cadastrar Postagem</h3>
                    </div>
<?php

   //CADASTRANDO POSTS...
  if(isset($_POST['cadastrar']))
  {
    $titulo  = trim(strip_tags($_POST['titulo']));
    $data  = trim(strip_tags($_POST['data']));
    $exibir  = trim(strip_tags($_POST['exibir']));
    $descricao  =$_POST['descricao'];

    

    //UPLOAD DE IMAGEM
    $file     = $_FILES['img'];
    $numFile  = count(array_filter($file['name']));
    
    //PASTA
    $folder   = '../upload/';
    
    //REQUISITOS
    $permite  = array('image/jpeg', 'image/png');
    $maxSize  = 1024 * 1024 * 1;
    
    //MENSAGENS
    $msg    = array();
    $errorMsg = array(
      1 => 'O arquivo no upload é maior do que o limite definido em upload_max_filesize no php.ini.',
      2 => 'O arquivo ultrapassa o limite de tamanho em MAX_FILE_SIZE que foi especificado no formulário HTML',
      3 => 'o upload do arquivo foi feito parcialmente',
      4 => 'Não foi feito o upload do arquivo'
    );
    
    if($numFile <= 0){
      echo '<div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            Selecione pelo menos 1 fotos para galeria!
          </div>';
    }
    else if($numFile >=2){
      echo '<div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            Você ultrapassou o limite de upload. Selecione apenas 1 fotos e tente novamente!
          </div>';
    }else{
      for($i = 0; $i < $numFile; $i++){
        $name   = $file['name'][$i];
        $type = $file['type'][$i];
        $size = $file['size'][$i];
        $error  = $file['error'][$i];
        $tmp  = $file['tmp_name'][$i];
        
        $extensao = @end(explode('.', $name));
        $novoNome = rand().".$extensao";
        
        if($error != 0)
          $msg[] = "<b>$name :</b> ".$errorMsg[$error];
        else if(!in_array($type, $permite))
          $msg[] = "<b>$name :</b> Erro imagem não suportada!";
        else if($size > $maxSize)
          $msg[] = "<b>$name :</b> Erro imagem ultrapassa o limite de 5MB";
        else{
          
          if(move_uploaded_file($tmp, $folder.'/'.$novoNome)){
            //$msg[] = "<b>$name :</b> Upload Realizado com Sucesso!";
             

      //FAZENDO A SELEÇÃO NO BANCO DE DADOS..
     $insert ="INSERT INTO tb_postagens (titulo, data, imagem, exibir, descricao) VALUES (:titulo, :data,:imagem, :exibir, :descricao)";

     try
     {

      $result = $conexao->prepare($insert);
      $result->bindParam(':titulo', $titulo, PDO::PARAM_STR);
      $result->bindParam(':data', $data, PDO::PARAM_STR);
      $result->bindParam(':imagem', $novoNome, PDO::PARAM_STR);

      $result->bindParam(':exibir', $exibir, PDO::PARAM_STR);
      $result->bindParam(':descricao', $descricao, PDO::PARAM_STR);
      
      $result->execute();

      //Para contar os registros da tabela
      $contar = $result->rowCount();

      if($contar>0)
      {
         
         echo' <div class="alert alert-success">
                      "<strong>Cadastrado</strong> com sucesso"
                 </div> ';

      } else
      {
          echo'<div class="alert alert-danger">
                   "Erro ao inserir <strong>dados</strong>"
                </div> ';
      }

     } catch(PDOException $e)
     { 
        echo "ERROR" . $e->getMessage();
     }







          
              
          }else
            $msg[] = "<b>$name :</b> Desculpe! Ocorreu um erro...";
        
        }
        
        foreach($msg as $pop)
        echo '';
          //echo $pop.'<br>';
      }
    }

  }
  

?>


                   <div class="panel-body ">




                     <div class="control-group">
                     <form action="" method="POST" enctype="multipart/form-data">

                      <label class="control-label" for="username">Titulo da postagem</label>
                      <div class="controls">
                      <input type="text" id="titulo" value="" class="" name="titulo">
                      </div> <!-- /controls -->       
                    </div> <!-- /control-group -->

                    <div class="control-group">                     
                      <label class="control-label" for="">Data</label>
                      <div class="controls">
                       <input type="text" class="span6" id="data" name="data">
                      </div> <!-- /controls -->       
                    </div> <!-- /control-group -->

                  
                     <div class="control-group">                     
                      <label class="control-label" for="lastname">Imagem</label>
                      <div class="controls">
                        <input type="file" class="span6" id="imagem" name="img[]">
                      </div> <!-- /controls -->       
                    </div> <!-- /control-group -->


                    <div class="control-group">                     
                      <label class="control-label" for="">Exibir</label>
                      <div class="controls">
                       <select class="span6 disabled" id="exibir" name="exibir">
                         <option>Sim</option>
                         <option>Não</option>
                       </select>
                      </div> <!-- /controls -->       
                    </div> <!-- /control-group -->


                    <div class="control-group">                     
                      <label class="control-label" for="lastname">Descrição</label>
                      <div class="controls">
                        <textarea class="span4" name="descricao" id="descricao" va
                       cols="80" rows="10" ></textarea>
                      </div> <!-- /controls -->       
                    </div> <!-- /control-group -->

                    <div class="form-actions">

                      <input type="submit" name="cadastrar" value="Save" class="btn btn-primary">

                      <input type="reset" name="btn" value="Cancel" class="btn btn-primary">

                    </div>

                 </form>
                    </div>
                 </div>
   	  		 </div>	  		
   	  	</div>  	  	
   	  </div> 

    <?php require_once '../views/footer.php'; ?> 

<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
<script>tinymce.init({ selector:'textarea' });</script>

</body>
</html>

