<?php
/**
* @package	copix
* @subpackage plugins
* @version	$Id: copixdb.plugin.php,v 1.1 2004/07/25 22:12:59 j-charles Exp $
* @author	Croes Gérald
* @copyright 2001-2004 Aston S.A.
* @link		http://copix.aston.fr
* @licence  http://www.gnu.org/licenses/gpl.html GNU General Public Licence, see LICENCE file
*/

class PluginCopixDb extends CopixPlugin {
	/**
	 * @param	class	$config		objet de configuration du plugin
    */
	function PluginCopixDb($config) {
		parent::CopixPlugin($config);
	}

	/**
	 * surchargez cette methode si vous avez des traitements à faire, des classes à declarer avant
	 * la recuperation de la session
	 */
	function beforeSessionStart (){
	}

	/**
	 * traitements à faire avant execution du coordinateur de page
	 * @param	CopixAction	$action	le descripteur de page détécté.
	 */
	function beforeProcess (&$execParam){
   }

	/**
	 * traitements à faire apres execution du coordinateur de page
	 */
	function afterProcess (){
	}

}
?>
