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
                      <h3 class="panel-title"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>  Visualizar todas postagem</h3>
                    </div>
                   <div class="panel-body">

                      <div class="widget-content">
        <table class="table table-striped">
          <thead>
            <tr>
                <th></th>
                <th>Título</th>
                <th>Data</th>
                <th>Imagem</th>
                <th>Exibição</th>
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

 //Paginação de postagens....
 if(empty($_GET['pg'])){}else{$pg = $_GET['pg'];}
 if(isset($pg)){$pg = $_GET['pg'];}
     else
  {
    $pg = 1;
    

  if(!is_numeric($pg)){
    echo '<script language="javascript">
              location.href="ver-postagem.php";
          </script>';
  }


  }

 $quantidade = 3;
 $inicio = ($pg*$quantidade) - $quantidade;

 //PEGANDO OS DADOS DO BANCO DE DADOS...
 $select = "SELECT * FROM tb_postagens ORDER BY id DESC LIMIT $inicio, $quantidade";

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
            <td><?php echo $cont++; ?></td>
            <td><?php echo $show->titulo; ?></td>
            <td><?php echo $show->data;?></td>
            <td><img src="../upload/<?php echo $show->imagem;?>" width="50px" /></td>
            <td><?php echo $show->exibir;?></td>
            <td><?php echo limitarTexto($show->descricao,$limite=200)?></td>

            <td class="td-actions"><a href="edit-postagem.php?&id=<?php echo $show->id;?>" class="btn btn-small btn-success">Editar</a>


            <a href="ver-postagem.php?&pg=<?php echo $pg;?>&delete=<?php echo $show->id;?>" class="btn btn-small btn-danger" onClick="return confirm('Deseja realmente deletar o post?')">Deletar</a></td>
          </tr>

 <?php
      }

    } else
    {
      echo' <div class="alert alert-danger">
                      "<strong>Post</strong> não há postagens"
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


<style type="text/css">
   .paginas
   {
    width: 100%;
    padding: 10px 0;
    text-align: center;
    background:#fff;
    height: auto;
    margin: 10px auto;
   }

   .paginas a
   {
     width: auto;
     padding: 15px;
     background:#eee;
     color:#333;
     margin:0px 2.5px;
   }
   .paginas a:hover
   {
      text-decoration: none;
      background:#00BA88;
      color: #fff;
   }
  
   <?php
      
      if(isset($_GET['pg'])){
        $num_pg = $_GET['pg'];
      } else
      {
        $num_pg = 1;
      }
   ?>


   .paginas a.ativo<?php echo $num_pg ?>
   {
     background:#00BA88;
     color: #fff;
   }



</style>

 
 
          <?php

             $sql = "SELECT * FROM tb_postagens";

             try{
                $result = $conexao->prepare($sql);
                $result->execute();
                $totalRegistros = $result->rowCount();
             }catch(PDOException $e){
               echo $e;
             }

             if($totalRegistros <=$quantidade){}else{
              //ceil para arredondar valor exemplo 1.5 arred. para 2
               $paginas = ceil($totalRegistros/$quantidade);
               
                if($pg > $paginas)
                {
                     echo '<script language="javascript">
                               location.href="ver-postagem.php";
                           </script>';
                }






               $links = 5;
               if(isset($i)){}
                else
                {
                  $i = '1';
                }
              
          ?>
          <div class="paginas">
             <a href="ver-postagem.php?&pg=1">Primeira página</a>
           
           <?php 
              if(isset($_GET['pg']))
              {
                 $num_pg = $_GET['pg'];

              }

              for ($i = $pg-$links; $i <= $pg-1; $i++)
               {
                 if($i <= 0){}else
                 {
                 ?>

               <a href="ver-postagem.php?&pg=<?php echo $i;?>" class="ativo<?php echo $i; ?>"><?php echo $i;?></a>
             
          <?php
              }
              }
           ?>

           <a href="ver-postagem.php?$pg=<?php echo $pg; ?>" class="ativo<?php echo $i; ?>"><?php echo $pg; ?></a>

           <?php
              for ($i = $pg+1; $i <= $pg + $links ; $i++) { 
                if($i>$paginas){}
              else{

         ?>
         
         <a href="ver-postagem.php?&pg=<?php echo $i; ?>" class="ativo<?php echo $i; ?>"><?php echo $i;?></a>     


       <?php
       
            }
            }
        ?>    
       
        <a href="ver-postagem.php?&pg=<?php echo $paginas; ?>" class="ativo">Última página</a>

                </div>

                <?php  

                         }
                ?>  
                  
</div>
</div>

<?php require_once '../views/footer.php'; ?>  

  

</body>
</html>                    