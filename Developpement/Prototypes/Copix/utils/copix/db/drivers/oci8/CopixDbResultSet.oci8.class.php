<?php
/**
* @package	copix
* @subpackage dbtools
* @version	$Id: CopixDbResultSet.oci8.class.php,v 1.1 2004/07/25 22:12:59 j-charles Exp $
* @author	Croes Gérald, Jouanneau Laurent
*           see copix.aston.fr for other contributors.
* @copyright 2001-2004 Aston S.A.
* @link		http://copix.aston.fr
* @licence  http://www.gnu.org/licenses/gpl.html GNU General Public Licence, see LICENCE file
*/

/**
 *
 * Couche d'encapsulation des resultset mysql.
 * @package copix
 * @subpackage dbtools
 */
class CopixDBResultSetOci8 extends CopixDBResultSet {
   var $_connector=null;
   function & _fetch(){

      if(ocifetchinto($this->_idResult, $row, OCI_ASSOC + OCI_RETURN_NULLS)){
         return (object) $row;
      }else
         return false;
   }
   function _free (){
      return ocifreestatement ($this->_idResult);

   }
}
?>
