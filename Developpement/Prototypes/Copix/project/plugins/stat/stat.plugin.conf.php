<?php
/**
* @package	copix
* @subpackage plugins
* @version	$Id: stat.plugin.conf.php,v 1.1 2004/07/25 22:12:59 j-charles Exp $
* @author	Croes Gérald
* @copyright 2001-2004 Aston S.A.
* @link		http://copix.aston.fr
* @licence  http://www.gnu.org/licenses/gpl.html GNU General Public Licence, see LICENCE file
*/

class PluginConfigStat {
   /**
   * The table name in the database.
   */
   var $tableName;
   /**
   * Associative array INFO=>FIELDNAME
   */
   var $fields;

   function PluginConfigStat (){
      $this->tableName = 'STATS';
      $this->fields = array ('COUNT'=>'COUNT_STAT',
                             'URL'=>'URL_STAT');
   }
}
?>
