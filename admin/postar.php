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
                      <h3 class="panel-title"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>  Opções Postagem</h3>
                    </div>
                   <div class="panel-body">
                      
                      <img src="../public/img/g.jpg" style="width: 800px;height: 400px;">

                      <br>
                      <hr>


      <div class="panel-heading" style="background-color:#9FF098;">
          <h3 class="panel-title"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>  Últimas Postagem</h3>
      </div>
                     
      <div class="widget-content">
        <table class="table table-striped">
          <thead>
            <tr>
              <th>Título da postagem</th>
              <th>Data</th>
              <th>Resumo</th>
              <th class="td-actions"></th>
            </tr>

          </thead>
          <tbody>


<?php
   
   //Delete...
   if(isset($_GET['delete']))
   {
     $id_delete = $_GET['delete'];

     //select the image...
     $selecionar = "SELECT * FROM tb_postagens WHERE id=:id_delete ";

     try
     {
       $result = $conexao->prepare($selecionar);
       $result->bindParam(':id_delete',$id_delete,PDO::PARAM_INT);
       $result->execute();

       $contar = $result->rowCount();
       if($contar>0)
       {
         $loop = $result->fetchAll();
         foreach($loop as $exibir)
         {

         }

         $fotoDeleta = $exibir['imagem'];
         $arquivo = "../upload/" . $fotoDeleta;
         unlink($arquivo);

         //Excluir a imagem
         $selecionar = "DELETE FROM tb_postagens WHERE id=:id_delete ";

            try
         {
           $result = $conexao->prepare($selecionar);
           $result->bindParam('id_delete',$id_delete,PDO::PARAM_INT);
           $result->execute();

           $contar = $result->rowCount();
           if($contar>0)
           {
              echo' <div class="alert alert-success">
                      "<strong>Post</strong> deletado com sucesso"
                 </div> ';
           }else
           {
             echo'<div class="alert alert-danger">
                   "Erro ao deletar <strong>o post</strong>"
                </div> ';
           }

       }catch(PDOException $e)
         {
           echo "ERROR" .$e->getMessage();
         }
      }else
      {

      }


     }catch(PDOException $e)
     {
       echo "ERROR" .$e->getMessage();
     }
   }
  

?>



<?php
 //INCLUINDO A FUNÇÃO LIMITA TEXTO
 include("function/limit-text.php");
 //PEGANDO OS DADOS DO BANCO DE DADOS...
 $select = "SELECT * FROM tb_postagens ORDER BY id DESC LIMIT 5";

 $cont = 0;

 try
 {

    $result = $conexao-> prepare($select);
    $result->execute();
    $contar = $result->rowCount();

    if($contar > 0)
    {
       while($show = $result->FETCH(PDO::FETCH_OBJ))
      {
?>
   
          <tr>
            <td><?php echo $cont++;?></td>
            <td><?php echo $show->titulo;?></td>
            <td><?php echo $show->data;?></td>
            <td><?php echo limitarTexto($show->descricao,$limite=200)?></td>

            <td class="td-actions"><a href="edit-postagem.php?&id=<?php echo $show->id;?>" class="btn btn-small btn-success">Editar</a>

            <a href="postar.php?&delete=<?php echo $show->id;?>" class="btn btn-small btn-danger" onClick="return confirm('Deseja realmente deletar o post?')">Deletar</a></td>
          </tr>

 <?php
      }

    } else
    {
      echo' <div class="alert alert-danger">
                      "<strong>Post</strong> not found"
                 </div> ';
    }

 } catch(PDOException $ex)
 { 
   print 'ERROR'. $ex->getMessage();
 }   
 ?>                    
                      </tbody>
                     </table>
                  </div>   
                  
                       
                    </div>
                 </div>
   	  		 </div>	  		
   	  	</div>  	  	
   	  </div> 
    
    

    <?php require_once '../views/footer.php'; ?>  

   </div>

</body>
</html>