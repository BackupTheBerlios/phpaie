<?php
/**
* @package	copix
* @subpackage plugins
* @version	$Id: peardb.plugin.php,v 1.1 2004/07/25 22:12:59 j-charles Exp $
* @author	Jouanneau Laurent
* @copyright 2001-2004 Aston S.A.
* @link		http://copix.aston.fr
* @licence  http://www.gnu.org/licenses/gpl.html GNU General Public Licence, see LICENCE file
*/

/**
* plugin gerant la connection à une base de donnée via PEAR::DB
*/
class PluginPearDB extends CopixPlugin {
	/**
     *
	 * @param	class	$config		objet de configuration du plugin
     */
	function PluginPearDB($config){
        parent::CopixPlugin($config);

		$GLOBALS['COPIX']['DB']= DB::connect($config->dsn,$config->persistantCnx);
        $GLOBALS['COPIX']['DB']->setFetchMode($config->fetchMode);

	}
   /**
   * traitements à faire apres execution du coordinateur de page
   */
	function afterProcess(){
        $GLOBALS['COPIX']['DB']->disconnect();
	}

}
?>
