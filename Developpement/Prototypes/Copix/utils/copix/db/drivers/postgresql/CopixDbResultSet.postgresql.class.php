<?php
/**
* @package	copix
* @subpackage dbtools
* @version	$Id: CopixDbResultSet.postgresql.class.php,v 1.1 2004/07/25 22:12:59 j-charles Exp $
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
class CopixDBResultSetPostgreSQL extends CopixDBResultSet {
   var $_connector=null;
   function & _fetch(){
      $toReturn = & pg_fetch_object ($this->_idResult);
      return $toReturn;
   }
   function _free (){
      return pg_free_result ($this->_idResult);

   }
 	function numRows(){
		return pg_num_rows($this->_idResult);
   }
}
?>
