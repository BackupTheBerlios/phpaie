<?php
/**
* @package	copix
* @subpackage profile
* @version	$Id: CopixCapabilitiesManager.class.php,v 1.1 2004/07/25 22:12:59 j-charles Exp $
* @author	Croes Gérald , Jouanneau Laurent
*           see copix.aston.fr for other contributors.
* @copyright 2001-2004 Aston S.A.
* @link		http://copix.aston.fr
* @licence  http://www.gnu.org/licenses/gpl.html GNU General Public Licence, see LICENCE file
*/
class CopixCapabilitiesManager {
   function getList (){
      $dao = & CopixDAOFactory::create('copix:CopixCapability');
      $sp  = & CopixDAOFactory::createSearchParams ();
      $sp->orderBy ('name_ccpb');
      
      return $dao->findBy ($sp);
   }

}
?>
