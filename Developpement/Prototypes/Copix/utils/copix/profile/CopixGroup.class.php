<?php
/**
* @package	copix
* @subpackage profile
* @version	$Id: CopixGroup.class.php,v 1.1 2004/07/25 22:12:59 j-charles Exp $
* @author	Croes Gérald , Jouanneau Laurent
*           see copix.aston.fr for other contributors.
* @copyright 2001-2004 Aston S.A.
* @link		http://copix.aston.fr
* @licence  http://www.gnu.org/licenses/gpl.html GNU General Public Licence, see LICENCE file
*/
class CopixGroup {
   /**
   * capabilities
   */
   var $_capabilities = array ();

   /**
   * only logins here.
   */
   var $_users = array ();

   /**
   * group id
   */
   var $id_cgrp;
   
   /**
   * group name
   */
   var $name_cgrp;

   /**
   * group description
   */
   var $description_cgrp;
   
   /**
   * Groupe public ?
   */
   var $all_cgrp;
   
   /**
   * Groupe pour tous les authentifiés.
   */
   var $known_cgrp;

   /**
   * constructor.
   */
   function CopixGroup ($id){
      //look for the capability values for the given group
      $this->id_cgrp = $id;
      if ($id !== null){
         //check if the group exists.
         $daoGroup   = & CopixDAOFactory::create ('copix:CopixGroup');
         $group      = & $daoGroup->get ($id);
         if ($group === null){
            trigger_error ('Given group does not exists');
         }

         $this->description_cgrp = $group->description_cgrp;
         $this->name_cgrp        = $group->name_cgrp;
         $this->all_cgrp         = $group->all_cgrp;
         $this->known_cgrp       = $group->known_cgrp;

         $daoCap      = & CopixDAOFactory::create ('copix:CopixGroupCapabilities');
         $sp          = & CopixDAOFactory::createSearchParams ();
         $sp->addCondition ('id_cgrp', '=', $id);

         //load capabilities.
         $capabilities = $daoCap->findBy ($sp);
         foreach ($capabilities as $capability){
            $this->setCapability ($capability->name_ccpb, $capability->value_cgcp);
         }

         //load logins
         $daoUserGroup = & CopixDAOFactory::create ('copix:CopixUserGroup');
         $sp           = & CopixDAOFactory::createSearchParams ();
         $sp->addCondition ('id_cgrp', '=', $id);
         $logins = $daoUserGroup->findBy ($sp);

         //adds the logins in the object
         foreach ($logins as $login){
            $this->addUsers ($login->login_cusr);
         }
      }
   }

   /**
   * récupération de la liste des utilisateurs.
   */
   function getUsers (){
      return $this->_users;
   }

   /*
   * ajout d'utilisateurs.
   */
   function addUsers ($users){
      if (is_array ($users)){
         foreach ($users as $user){
            if (!in_array ($user, $this->_users)){
               $this->_users[] = $user;
            }
         }
      }else{
         if (!in_array ($users, $this->_users)){
            $this->_users[] = $users;
         }
      }
   }

   /**
   * suppression d'utilisateurs.
   */
   function removeUser ($userName){
      if (in_array ($userName, $this->_users)){
         unset ($this->_users[array_search ($userName, $this->_users)]);
      }
   }

   /**
   * gets the max value of the element
   */
   function valueOf ($path){
      $currentValue = PROFILE_CCV_NONE;//starts with NONE
      $testString   = '';
      $values       = explode ('|', $path);
      
      //we're gonna test path first, to see if there is PROFILE_CCV_NONE.
      //If so, then we'll force to NONE, as the site admin did purposely a
      //right removal.
      if (isset ($this->_capabilities[$path])){
         if ($this->_capabilities[$path] == PROFILE_CCV_NONE){
            return PROFILE_CCV_NONE;
         }
      }

      //test all given elements.
      //eg for site|module|something|other
      //   testing site,
      //           site|module,
      //           site|module|something,
      //           site|module|something|other
      $first = true;
      foreach ($values as $element){
         if (!$first){
            $testString .= '|';
         }
         $first = false;
         $testString .= $element;//the test string.

         //If the value is known, and if the value is below (to remeber the maximum value)
         if (isset ($this->_capabilities[$testString]) && ($this->_capabilities[$testString] > $currentValue)){
            $currentValue = $this->_capabilities[$testString];
         }
      }
      return $currentValue;
   }

   /**
   * adds the capability to the list.
   * will replace any value in the list.
   */
   function setCapability ($path, $value){
      if (isset ($this->_capabilities[$path])){
         $this->_capabilities[$path] = $value;
      }else{
         $this->_capabilities[$path] = $value;
      }
   }
   
   /**
   * retire une capability du groupe
   */
   function removeCapability ($path){
      if (isset ($this->_capabilities[$path])){
         unset ($this->_capabilities[$path]);
      }
   }

   /**
   * ajoute des capacités en groupe, défini à une valeur donnée.
   */
   function addCapabilities ($paths, $value = PROFILE_CCV_READ){
      foreach ($paths as $path){
         $this->setCapability ($path, $value);
      }
   }

   /**
   * gets the list of capabilities
   * associative array key == value.
   */
   function getCapabilities () {
      return $this->_capabilities;
   }
}
?>
