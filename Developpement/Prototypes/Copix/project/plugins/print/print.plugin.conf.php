<?php
/**
* @package	copix
* @subpackage plugins
* @version	$Id: print.plugin.conf.php,v 1.1 2004/07/25 22:12:59 j-charles Exp $
* @author	Croes Gérald
* @copyright 2001-2004 Aston S.A.
* @link		http://copix.aston.fr
* @licence  http://www.gnu.org/licenses/gpl.html GNU General Public Licence, see LICENCE file
*/

class PluginConfigPrint {
   /**
   * Template we're gonna use to print with
   */
   var $_templatePrint;
   /**
   * says the command needed to activate the print plugin.
   * format: _runPrintUrl['name']=Value
   * will activate the print plugin on index.php?name=value
   */
   var $_runPrintUrl;
   function PluginConfigPrint (){
      $this->_templatePrint = 'main.print.tpl';
      $this->_runPrintUrl = array ('toPrint'=>'1');
   }
}
?>
