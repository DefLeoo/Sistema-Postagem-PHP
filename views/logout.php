<?php

   if(isset($_REQUEST['sair']))
   {
      session_decode();
      session_unset(['usuariocoffee']);
      session_unset(['senhacoffee']);
      header("Location:../index.php");
   }

?>