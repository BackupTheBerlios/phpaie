<?php
/**
* @package	copix
* @subpackage plugins
* @version	$Id: print.plugin.php,v 1.1 2004/07/25 22:12:59 j-charles Exp $
* @author	Croes Gérald
* @copyright 2001-2004 Aston S.A.
* @link		http://copix.aston.fr
* @licence  http://www.gnu.org/licenses/gpl.html GNU General Public Licence, see LICENCE file
*/

class PluginPrint extends CopixPlugin {
   function PluginPrint ($config){
     parent::CopixPlugin ($config);
   }
   function beforeSessionStart(){
      if ($this->shouldPrint ()){
         $GLOBALS['COPIX']['CONFIG']->mainTemplate = $this->config->_templatePrint;
      }
   }
   /**
   * says if we should be printing.
   */
   function shouldPrint (){
      foreach ($this->config->_runPrintUrl as $name=>$value){
         if (! (isset ($GLOBALS['COPIX']['COORD']->vars[$name]) && $GLOBALS['COPIX']['COORD']->vars[$name] == $value)){
            return false;
         }
      }
      return true;
   }
   /**
   * Gets the url of the current page, with the "ask for print" informations.
   */
   function getPrintableUrl (){
      include_once (COPIX_UTILS_PATH.'CopixUtils.lib.php');
      $urlTab = $GLOBALS['COPIX']['COORD']->vars;
      foreach ($this->config->_runPrintUrl as $key=>$elem){
         $urlTab[$key] = $this->config->_runPrintUrl[$key];
      }
      return 'index.php?'.urlParams ($urlTab);
   }
}
?>
