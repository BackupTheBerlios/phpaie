<?php
/**
* @package	copix
* @subpackage core
* @version	$Id: CopixPlugin.class.php,v 1.1 2004/07/25 22:12:59 j-charles Exp $
* @author	Croes G�rald, Jouanneau Laurent
*           see copix.aston.fr for other contributors.
* @copyright 2001-2004 Aston S.A.
* @link		http://copix.aston.fr
* @licence  http://www.gnu.org/licenses/gpl.html GNU General Public Licence, see LICENCE file
*/

/**
 * classe de base pour les plugins
 * @package	copix
 * @subpackage core
 */
class CopixPlugin{
   /**
   * objet de configuration dont la classe � pour nom  nom.plugin.conf.php (nommage par d�faut)
   * @var object
   */
   var $config;

   /**
   * ref�rence sur le coordinateur du framework
   * @var  CopixCoordination
   */
   var $coordination;
   /**
   * constructeur
   * @param	object	$config		objet de configuration du plugin
   */
	function CopixPlugin(& $config){
      $this->coordination = & $GLOBALS['COPIX']['COORD'];
      $this->config = & $config;
	}

   /**
   * surchargez cette methode si vous avez des traitements � faire, des classes � declarer avant
   * la recuperation de la session
   * @abstract
   */
   function beforeSessionStart(){
      return null;
   }

   /**
   * traitements � faire avant execution de l'action demand�e
   * @param	CopixAction	$action	le descripteur de l'action demand�e.
   * @abstract
   */
   function beforeProcess(& $action){
      return null;
   }

   /**
   * traitements � faire apres execution de l'action
   * @abstract
   * @param CopixActionReturn		$actionreturn
   */
   function afterProcess($actionreturn){
      return null;
   }
}
?>
