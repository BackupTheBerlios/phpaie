<?php
/**
* @package	copix
* @subpackage dbtools
* @version	$Id: CopixDbTools.class.php,v 1.1 2004/07/25 22:12:59 j-charles Exp $
* @author	Croes G�rald, Jouanneau Laurent
*           see copix.aston.fr for other contributors.
* @copyright 2001-2004 Aston S.A.
* @link		http://copix.aston.fr
* @licence  http://www.gnu.org/licenses/gpl.html GNU General Public Licence, see LICENCE file
*/

/**
 * classe d'outils pour g�rer une base de donn�es
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
