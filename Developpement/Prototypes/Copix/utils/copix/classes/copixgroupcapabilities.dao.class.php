<?php
class DAOCopixGroupCapabilities {
   function removeGroup ($id){
      $query = 'delete from CopixGroupCapabilities where id_cgrp='.$id;
      $ct    = & CopixDBFactory::getConnection ();
      $ct->doQuery ($query);
   }

   function removePath ($path){
      $ct    = & CopixDBFactory::getConnection ();
      $query = 'delete from CopixGroupCapabilities where name_ccpb = '.$ct->quote ($path);
      $ct->doQuery ($query);
   }
   
   function movePath ($path, $newPath){
      $ct    = & CopixDBFactory::getConnection ();
      $query = 'update CopixGroupCapabilities set name_ccpb = '.$ct->quote ($newPath).' where name_ccpb='.$ct->quote ($path);
      $ct->doQuery ($query);
   }
}
?>
