<?php
/**
* @package	copix
* @subpackage core
* @version	$Id: CopixPlugin.class.php,v 1.1 2004/07/25 22:12:59 j-charles Exp $
* @author	Croes Gérald, Jouanneau Laurent
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
   * objet de configuration dont la classe à pour nom  nom.plugin.conf.php (nommage par défaut)
   * @var object
   */
   var $config;

   /**
   * reférence sur le coordinateur du framework
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
   * surchargez cette methode si vous avez des traitements à faire, des classes à declarer avant
   * la recuperation de la session
   * @abstract
   */
   function beforeSessionStart(){
      return null;
   }

   /**
   * traitements à faire avant execution de l'action demandée
   * @param	CopixAction	$action	le descripteur de l'action demandée.
   * @abstract
   */
   function beforeProcess(& $action){
      return null;
   }

   /**
   * traitements à faire apres execution de l'action
   * @abstract
   * @param CopixActionReturn		$actionreturn
   */
   function afterProcess($actionreturn){
      return null;
   }
}
?>
