<?php
/**
* @package	copix
* @subpackage dbtools
* @version	$Id: CopixDbResultSet.mysql.class.php,v 1.1 2004/07/25 22:12:59 j-charles Exp $
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
class CopixDBResultSetMySQL extends CopixDBResultSet {
   function & _fetch (){
      return mysql_fetch_object ($this->_idResult);
   }
   function _free (){
      return mysql_free_result ($this->_idResult);
   }
 	function numRows(){
		return mysql_num_rows($this->_idResult);
   }
}
?>
