<?php
/**
* @package	copix
* @subpackage plugins
* @version	$Id: peardb.plugin.conf.php,v 1.1 2004/07/25 22:12:59 j-charles Exp $
* @author	Jouanneau Laurent
* @copyright 2001-2004 Aston S.A.
* @link		http://copix.aston.fr
* @licence  http://www.gnu.org/licenses/gpl.html GNU General Public Licence, see LICENCE file
*/

include_once('DB.php');

class PluginConfigPearDB {
    var $dsn = 'mysql://login:pwd@localhost/base';
    var $fetchMode = DB_FETCHMODE_ASSOC;
	 var $persistantCnx = true;
}
?>
