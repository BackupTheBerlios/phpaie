<?php
/**
* @package	copix
* @subpackage core
* @version	$Id: CopixSmartyTpl.class.php,v 1.1 2004/07/25 22:12:59 j-charles Exp $
* @author	Croes Gérald, Jouanneau Laurent
*           see copix.aston.fr for other contributors.
* @copyright 2001-2004 Aston S.A.
* @link		http://copix.aston.fr
* @licence  http://www.gnu.org/licenses/gpl.html GNU General Public Licence, see LICENCE file
*/

/**
 * include smarty class
 */
include_once (COPIX_SMARTY_PATH.'Smarty.class.php');

/**
 * Surcharge l'objet Smarty pour un paramètrage plus aisé
 * Les paramètres se trouvant dans l'objet de configuration de Copix
 * @package	copix
 * @subpackage core
 * @see CopixConfig
 */
class CopixSmartyTpl extends Smarty {
   var $_displayMethod = null;

   /**
   * Initialize the tplEngine with the right parameters.
   */
   function CopixSmartyTpl (){
      $this->template_dir  = $GLOBALS['COPIX']['CONFIG']->template_dir;
      $this->compile_dir   = $GLOBALS['COPIX']['CONFIG']->compile_dir;
      $this->config_dir    = $GLOBALS['COPIX']['CONFIG']->config_dir;
      $this->debugging     = $GLOBALS['COPIX']['CONFIG']->debugging;
      $this->compile_check = $GLOBALS['COPIX']['CONFIG']->compile_check;
      $this->force_compile = $GLOBALS['COPIX']['CONFIG']->force_compile;
      $this->caching       = $GLOBALS['COPIX']['CONFIG']->caching;
      $this->use_sub_dirs  = $GLOBALS['COPIX']['CONFIG']->use_sub_dirs;
      $this->cache_dir     = $GLOBALS['COPIX']['CONFIG']->cache_dir;

      $this->plugins_dir   = array ('plugins', COPIX_PATH.'smarty_plugins');
   }

   function display ($tplName){
      $this->_displayMethod = 'display';
      echo parent::fetch ($tplName);
   }
   function fetch ($tplName){
      $this->_displayMethod = 'fetch';
      return parent::fetch ($tplName);
   }
}
?>
