<?php

/**
* @package	copix
* @subpackage profile
* @version	$Id: CopixGroup.services.class.php,v 1.1 2004/07/25 22:12:59 j-charles Exp $
* @author	Croes Gérald , Jouanneau Laurent
*           see copix.aston.fr for other contributors.
* @copyright 2001-2004 Aston S.A.
* @link		http://copix.aston.fr
* @licence  http://www.gnu.org/licenses/gpl.html GNU General Public Licence, see LICENCE file
*/


class ServicesCopixGroup {
   function save ($group) {
      if ($group->id_cgrp !== null){
         $this->update ($group);
      }else{
         $this->insert ($group);
      }
   }

   function update ($group) {
      //clear users and capabilities first.
      $this->_removeUsers ($group->id_cgrp);
      $this->_removeCapabilities ($group->id_cgrp);

      //capabilities and users.
      $this->_saveCapabilities ($group);
      $this->_saveUsers ($group);
      
      //general informations.
      $daoGroup = & CopixDAOFactory::create ('copix:CopixGroup');
      $record   = & CopixDAOFactory::createRecord ('copix:CopixGroup');

      $record->id_cgrp   = $group->id_cgrp;
      $record->name_cgrp = $group->name_cgrp;
      $record->description_cgrp = $group->description_cgrp;
      $record->all_cgrp    = $group->all_cgrp;
      $record->known_cgrp  = $group->known_cgrp;

      $daoGroup->update ($record);
   }

   function insert ($toSave) {
      $daoGroup     = & CopixDAOFactory::create ('copix:CopixGroup');

      //insert the group itself.
      $group            = & CopixDAOFactory::createRecord ('copix:CopixGroup');
      $group->id_cgrp   = $this->_genId ();
      $group->name_cgrp = $toSave->name_cgrp;
      $group->description_cgrp = $toSave->description_cgrp;
      $group->all_cgrp    = $toSave->all_cgrp;
      $group->known_cgrp  = $toSave->known_cgrp;

      $daoGroup->insert ($group);
      
      $toSave->id_cgrp = $group->id_cgrp;

      $this->_saveCapabilities ($toSave);
      $this->_saveUsers ($toSave);
   }
   
   function delete ($id){
      $this->_removeCapabilities ($id);
      $this->_removeUsers ($id);

      $daoGroup  = & CopixDAOFactory::create ('copix:CopixGroup');
      $daoGroup->delete ($id);
   }

   function _removeUsers ($id){
      $daoUserGroup  = & CopixDAOFactory::create ('copix:CopixUserGroup');
      $daoUserGroup->removeGroup ($id);
   }

   function _removeCapabilities ($id){
      $daoGroupCap  = & CopixDAOFactory::create ('copix:CopixGroupCapabilities');
      $daoGroupCap->removeGroup ($id);
   }

   function _genId (){
      return date ('YmdHis').rand (10, 99);
   }
   
   function _saveCapabilities ($toSave){
      $daoGroupCap  = & CopixDAOFactory::create ('copix:CopixGroupCapabilities');
      $groupCapability = & CopixDAOFactory::createRecord ('copix:CopixGroupCapabilities');

      $groupCapability->id_cgrp = $toSave->id_cgrp;
      foreach ($toSave->getCapabilities () as $name=>$value) {
         $groupCapability->name_ccpb  = $name;
         $groupCapability->value_cgcp = $value;
         $daoGroupCap->insert ($groupCapability);
      }
   }
   
   function _saveUsers ($toSave){
      $daoUserGroup = & CopixDAOFactory::create ('copix:CopixUserGroup');
      $groupUser = & CopixDAOFactory::createRecord ('copix:CopixUserGroup');

      $groupUser->id_cgrp = $toSave->id_cgrp;
      foreach ($toSave->getUsers () as $login) {
         $groupUser->login_cusr = $login;
         $daoUserGroup->insert ($groupUser);
      }
   }
}
?>
