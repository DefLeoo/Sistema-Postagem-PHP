<!--menu bootstrap-->
  <nav class="navbar navbar-default">
      
  <div class="container-fluid navbar_menu container-menu-principal">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    </div>

     

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">


      <div class="col-xs-2 col-md-1 ">
         <a href="#" class="thumbnail">
         <img src="../public/img/w.jpg" class="img-circle" alt="User">
         </a>
      </div>
      
      <form class="navbar-form navbar-left" role="search">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Search">
        </div>
        <button type="submit" class="btn btn-default">Search</button>
      </form>
       
    

      
      <ul class="nav navbar-nav navbar-right">

        <li class="dropdown navbar_dropdown">

         
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> Opções <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="../admin/site.php"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> Visualizar site</a></li>
            <li class="divider"></li>
            <li><a href=""><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Adicionar user</a></li>

             <li class="divider"></li>
            <li><a href=""><span class="glyphicon glyphicon-wrench" aria-hidden="true"></span> Site manutenção</a></li>
          </ul>

        </li>



         <li class="dropdown navbar_dropdown">

         
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> User <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="#"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Meu perfil</a></li>
            <li class="divider"></li>
            <li><a href="?sair" onClick="return confirm('Deseja realmente sair do sistema?')"><span class="glyphicon glyphicon-off" aria-hidden="true"></span> Finalizar sessão</a></li>
          </ul>

        </li>

       
        

      
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->

</nav>
 