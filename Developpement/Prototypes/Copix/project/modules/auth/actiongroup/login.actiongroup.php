<?php
/**
 * @package	copixmodules
 * @subpackage auth
 * @version	$Id: login.actiongroup.php,v 1.1 2004/07/25 22:12:58 j-charles Exp $
 * @author	Croes Gérald, Jouanneau Laurent
 * @copyright 2001-2003 Aston S.A.
 * @link		http://copix.aston.fr
 * @licence  http://www.gnu.org/licenses/gpl.html GNU General Public Licence, see LICENCE file
 */

class ActionGroupLogin extends CopixActionGroup {
    /**
     * Essaye de se logger
     */
    function doLogin (){
        $_controller = & ProjectCoordination::instance();
        $plugAuth = $_controller->getPlugin (PROJECT_PLUGIN_AUTH);
        $user = & $plugAuth->getUser();

        $user->login ($this->vars['auth_login'], $this->vars['auth_password']);

        if(  isSet($this->vars['auth_url_return']) 
          && ($this->vars['auth_url_return'] != '')
          ){
            $url_return=$this->vars['auth_url_return'];
          }
        else{
            $url_return = $plugAuth->config->urlDefaultAfterLogin;
        }

	if (!$user->isConnected ()){
            $_SESSION['COPIX_USER_FAILED']=1;
            sleep (2);
        }
	return new CopixActionReturn (COPIX_AR_REDIRECT, $url_return);
   }

   /**
   * essaye de se délogger
   */
   function doLogout (){
      $_controller = & ProjectCoordination::instance();
      $plugAuth = & $_controller->getPlugin (PROJECT_PLUGIN_AUTH);
      $user = & $plugAuth->getUser();
      $user->logout ();
      if(isset($this->vars['auth_url_return']) && $this->vars['auth_url_return'] != '')
         $url_return=$this->vars['auth_url_return'];
      else
         $url_return = $plugAuth->config->urlDefaultAfterLogout;
      return new CopixActionReturn (COPIX_AR_REDIRECT, $url_return);
   }
}
?>
