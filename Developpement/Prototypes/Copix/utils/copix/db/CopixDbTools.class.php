<?php
/**
* @package	copix
* @subpackage dbtools
* @version	$Id: CopixDbTools.class.php,v 1.1 2004/07/25 22:12:59 j-charles Exp $
* @author	Croes Gérald, Jouanneau Laurent
*           see copix.aston.fr for other contributors.
* @copyright 2001-2004 Aston S.A.
* @link		http://copix.aston.fr
* @licence  http://www.gnu.org/licenses/gpl.html GNU General Public Licence, see LICENCE file
*/

/**
 * classe d'outils pour gérer une base de données
 * @package copix
 * @subpackage dbtools
 */
class CopixDbTools {
   function CopixDbTools(& $connector){
      $this->connector = & $connector;
   }
   function getTableList (){
      return $this->_getTableList ();
   }
   function getFieldList ($tableName){
      return $this->_getFieldList ($tableName);
   }
}
?>
