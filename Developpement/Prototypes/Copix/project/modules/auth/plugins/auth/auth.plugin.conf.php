<?php
/**
* @package	copixmodules
* @subpackage   auth
* @version	$Id: auth.plugin.conf.php,v 1.1 2004/07/25 22:12:58 j-charles Exp $
* @author	Croes Gérald
* @modified     Pierre Raoul
* @copyright    2001-2004 Aston S.A.
* @link	        http://copix.aston.fr
* @licence      http://www.gnu.org/licenses/gpl.html GNU General Public Licence, see LICENCE file
*/

if( ! defined('COPIX_USER_CLASS_NAME') )    define('COPIX_USER_CLASS_NAME'    , 'User');
if( ! defined('COPIX_DEFAULT_RETURN_IN') )  define('COPIX_DEFAULT_RETURN_IN'  , 'index.php');
if( ! defined('COPIX_DEFAULT_RETURN_OUT') ) define('COPIX_DEFAULT_RETURN_OUT' , 'welcome.php');
if( ! defined('COPIX_DEFAULT_NO_RIGHT') )   define('COPIX_DEFAULT_NO_RIGHT'   , 'noright');
if( ! defined('COPIX_DEFAULT_RETURN_REF') ) define('COPIX_DEFAULT_RETURN_REF' , 'welcome');
if( ! defined('COPIX_DEFAULT_RETURN_AG') )  define('COPIX_DEFAULT_RETURN_AG'  , 'default');

class PluginConfigAuth {
    var $name = 'copixuser';
    var $class_name;//nom de la classe utilisateur.
    var $full_class_path;//chemin de la classe utilisateur.
    var $noRightsExecParam;
    var $sessionCrackRedirect;

    var $secure_with_ip_name = 'COPIX_SECURE_WITH_IP';//le nom de la variable de session dans laquelle l'information ip sera.
    var $secure_with_ip = false;//si l'on effectue un contrôle sur l'adresse ip qui a démarrer la session.

    var $connectionToUse;//nom de la connection à utiliser si authentification via une base de données.
    var $connectionType;//base, ldap, autres.

    var $useGroups;//utilisation des groupes d'utilisateurs ou non ?
    var $superAdminEnabled;//si un utilisateur super admin est capable de tout faire.

    // used by auth module, to do redirection after login or logout, if no url_return params given
    var $urlDefaultAfterLogin = COPIX_DEFAULT_RETURN_IN;
    var $urlDefaultAfterLogout = COPIX_DEFAULT_RETURN_OUT;

    function PluginConfigAuth (){

        $this->class_name = COPIX_USER_CLASS_NAME;
        $this->full_class_path = COPIX_PROJECT_PATH.COPIX_CLASSES_DIR.COPIX_USER_CLASS_NAME.'.class.php';

        $this->noRightsExecParam    = & new CopixAction( COPIX_DEFAULT_RETURN_AG
                                                       , 'get'.COPIX_DEFAULT_NO_RIGHT
                                                       );
        $this->sessionCrackRedirect = & new CopixAction( COPIX_DEFAULT_RETURN_AG
                                                       , 'get'.COPIX_DEFAULT_RETURN_REF
                                                       );
   }
}
?>
