<?php
/**
 * @package    copixmodules
 * @subpackage auth
 * @version
 * @author     Croes Gérald, Jouanneau Laurent
 * @modified   Pierre Raoul
 * @copyright  2001-2003 Aston S.A. ; 2004 phpaie
 * @link       http://copix.aston.fr
 * @licence    http://www.gnu.org/licenses/gpl.html GNU General Public Licence, see LICENCE file
 */

class ZoneLoginForm extends CopixZone {
    function _createContent (&$toReturn){
        $_template = & new CopixTpl();
        $_controller = & ProjectCoordination::instance();
        $_controller->getStandardTemplateData($_template);
      
        $plugAuth  = & $_controller->getPlugin(PROJECT_PLUGIN_AUTH);
        $aliasUser = $plugAuth->config->name;
        if ($_SESSION[$aliasUser]->isConnected()){
            $_template->assign('USER', $_SESSION[$aliasUser]);
        }else{
            $_template->assign('USER', null);
        }

        if ( isSet($_SESSION['COPIX_USER_FAILED']) && $_SESSION['COPIX_USER_FAILED'] === 1 ){
            $_template->assign('FAILED', 1);
            $_SESSION['COPIX_USER_FAILED'] = 0;
        } else {
            $_template->assign('FAILED', 0);
        }

        if (isSet($this->params['url_return'])) {
            $_template->assign('URL_RETURN',$this->params['url_return']);
        }
        else {
            $_template->assign('URL_RETURN','');
        }

        $toReturn = $_template->fetch('loginzone.tpl');
        return true;
    }
}
?>
