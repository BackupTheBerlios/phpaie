<?php
class DAOCopixUserGroup {
   function removeGroup ($id){
      $query = 'delete from CopixUserGroup where id_cgrp='.$id;
      $ct    = & CopixDBFactory::getConnection ();
      $ct->doQuery ($query);
   }
}
?>
