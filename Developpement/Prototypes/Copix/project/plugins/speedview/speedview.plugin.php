<?php
/**
* @package	copix
* @subpackage plugins
* @version	$Id: speedview.plugin.php,v 1.1 2004/07/25 22:12:59 j-charles Exp $
* @author	Croes Gérald
* @copyright 2001-2004 Aston S.A.
* @link		http://copix.aston.fr
* @licence  http://www.gnu.org/licenses/gpl.html GNU General Public Licence, see LICENCE file
*/

class PluginSpeedView extends CopixPlugin {
   var $startTime = 0;
   var $stopTime = 0;
   var $elapsedTime = 0;

   function PluginSpeedView($config){
     parent::CopixPlugin($config);
   }

   function beforeSessionStart(){
     $this->startTime = $this->_getMicroTime();
   }

   function afterProcess(){
      $this->stopTime = $this->_getMicroTime();
      $this->elapsedTime = max(0, intval(($this->stopTime - $this->startTime)*1000) / 1000);
      if($this->config->showTimeCounterEnabled &&
         isset ($GLOBALS['COPIX']['COORD']->vars['showTimeCounter']) &&
         ($GLOBALS['COPIX']['COORD']->vars['showTimeCounter']==1)){
         echo $this->elapsedTime;
      }
   }

   function _getMicroTime(){
      list($micro,$time) = explode (' ', microtime());
      return $micro + $time;
   }

}
?>
