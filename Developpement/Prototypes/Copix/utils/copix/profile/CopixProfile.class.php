<?php
/**
* @package	copix
* @subpackage profile
* @version	$Id: CopixProfile.class.php,v 1.1 2004/07/25 22:12:59 j-charles Exp $
* @author	Croes Gérald , Jouanneau Laurent
*           see copix.aston.fr for other contributors.
* @copyright 2001-2004 Aston S.A.
* @link		http://copix.aston.fr
* @licence  http://www.gnu.org/licenses/gpl.html GNU General Public Licence, see LICENCE file
*/
class CopixProfile {
   var $_groups = array ();

   /**
   * The profile manager.
   */
   function CopixProfile ($login) {
      $daoGroup = & CopixDAOFactory::create ('copix:CopixUserGroup');
      $sp       = & CopixDAOFactory::createSearchParams ();

      //specific groups.
      $sp->addCondition ('login_cusr', '=', $login);
      $groups = $daoGroup->findBy ($sp);
      foreach ($groups as $group) {
         $this->_groups[$group->id_cgrp] = & new CopixGroup ($group->id_cgrp);
      }
      
      //public or known user's groups
      $daoGroup = & CopixDAOFactory::create ('copix:CopixGroup');
      $sp       = & CopixDAOFactory::createSearchParams ();
      $sp->addCondition ('all_cgrp', '=', 1);
      if ($login !== null) {
         $sp->addCondition ('known_cgrp', '=', 1, 'or');
      }

      $groups = $daoGroup->findBy ($sp);
      foreach ($groups as $group) {
         $this->_groups[$group->id_cgrp] = & new CopixGroup ($group->id_cgrp);
      }
   }

   /**
   * do we belongs to this group ?
   */
   function belongsTo ($groupName){
      return isset ($this->_groups[$groupName]);
   }

   /**
   * gets the max value of the capability of the group on the path.
   */
   function valueOf ($path) {
      $currentValue = PROFILE_CCV_NONE;
      foreach ($this->_groups as $group) {
         $groupValue = $group->valueOf ($path);
         if ($currentValue < $groupValue) {
            $currentValue = $groupValue;
         }
      }
      return $currentValue;
   }
   
   function getGroups (){
      return $this->_groups;
   }
}
?>
