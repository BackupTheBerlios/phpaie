<?php
/**
* @package	copix
* @version	$Id: copix.inc.php,v 1.1 2004/07/25 22:12:59 j-charles Exp $
* @author	Croes Gérald, Jouanneau Laurent
*           see copix.aston.fr for other contributors.
* @copyright 2001-2004 Aston S.A.
* @link		http://copix.aston.fr
* @licence  http://www.gnu.org/licenses/gpl.html GNU General Public Licence,
*    see LICENCE file
*/

/******************************************************************************
* COPIX PATH
* Core only.
* to change the defaults path for the projects, modules and plugins,
* go to config/copix.conf.php.
*
* That way, you can update your copix distribution without taking care
*  of your path preferences for your projects.
*
******************************************************************************/
define ('COPIX_PATH',dirname (__FILE__).'/');//Copix is in its own directory.... obviously.
define ('COPIX_CORE_PATH', COPIX_PATH.'core/');//core objects.
define ('COPIX_UTILS_PATH', COPIX_PATH.'utils/');//utils, library, ...
define ('COPIX_BUSINESS_PATH', COPIX_PATH.'business/');
define ('COPIX_AUTH_PATH', COPIX_PATH.'auth/');
define ('COPIX_DB_PATH', COPIX_PATH.'db/');
define ('COPIX_PROFILE_PATH', COPIX_PATH.'profile/');
define ('COPIX_DAO_PATH', COPIX_PATH.'dao/');
define ('COPIX_VERSION', 'COPIX_2_1_DEVEL');//Ici, on met le tag CVS de la version,
//suffixé de _DEV si version en cours de développement.
//Exemple:
//         version 2 - COPIX_2
//         une fois la version taggée passage immédiat en COPIX_2_1_DEVEL.
//         une fois la version 2_1 terminée passage à COPIX_2_1, tag / branche dans CVS
//         et passage à COPIX_2_2_DEVEL.
// etc.
//Nous devrions donc avoir dans les sources l'information de version correcte.
//X_Y_DEVEL si la version X_Y n'est pas terminée, X_Y si la version est terminée.

/******************************************************************************
* OTHER PATH
* required libraries
******************************************************************************/
if ( ! defined('COPIX_SMARTY_PATH') )
    define ('COPIX_SMARTY_PATH', realpath(dirname(__FILE__).'/../smarty/').'/');

/******************************************************************************
* COPIX NAMES
* File extensions, classes names, ...
******************************************************************************/
define ('COPIX_DESC_EXT','.desc.php');

/**
* kept for compatibility issues.
* @since Copix_2_RC1
* @deprecated
*/
define ('COPIX_PAGES_EXT','.actiongroup.php');
/**
* replace COPIX_PAGES_EXT
* @since Copix_2_RC1
*/
define ('COPIX_ACTIONGROUP_EXT','.actiongroup.php');
define ('COPIX_ZONE_EXT','.zone.php');

/**
* kept for compatibility issues.
* @since Copix_2_RC1
* @deprecated
*/
define ('COPIX_PAGES_CLASSNAME','ActionGroup');
/**
* replace COPIX_PAGES_CLASSNAME
* @since Copix_2_RC1
*/
define ('COPIX_ACTIONGROUP_CLASSNAME','ActionGroup');
define ('COPIX_ZONE_CLASSNAME','Zone');

/******************************************************************************
* COPIX CONSTS
* Codes, errors, ...
******************************************************************************/
//CopixActionReturn
define ('COPIX_AR_DISPLAY',1);//to display the given template into the default template.
define ('COPIX_AR_ERROR', 2);//to display an error message
define ('COPIX_AR_REDIRECT', 3);//to redirect to an url.
define ('COPIX_AR_REDIR_ACT', 4);
define ('COPIX_AR_STATIC', 5);//to display a static file
define ('COPIX_AR_NONE', 6);//you won't do anything
define ('COPIX_AR_DISPLAY_IN', 7);//display n a particular template
define ('COPIX_AR_DOWNLOAD', 8);//to download a file.
define ('COPIX_AR_BINARY', 9);//to generate images, pdf, ...
define ('COPIX_AR_USER',50);

//CopixAction types
define ('COPIX_ACTION_TYPE_FILE', 1);
define ('COPIX_ACTION_TYPE_OBJ', 2);
define ('COPIX_ACTION_TYPE_MODULE', 3);
define ('COPIX_ACTION_TYPE_REDIRECT', 4);
define ('COPIX_ACTION_TYPE_STATIC', 5);
define ('COPIX_ACTION_TYPE_ZONE', 6);

define ('ERR_MSG_NOTHING'   ,0);
define ('ERR_MSG_ECHO'      ,1);
define ('ERR_MSG_LOG_FILE'  ,2);
define ('ERR_MSG_LOG_MAIL'  ,4);
define ('ERR_MSG_LOG_SYSLOG',8);

define ('ERR_ACT_REDIRECT',  128);
define ('ERR_ACT_EXIT',      256);
define ('ERR_ACT_NOTHING',   0);
define ('ERR_MSG_ECHO_EXIT', ERR_MSG_ECHO | ERR_ACT_EXIT);

/**
* COPIX INCLUDES
* classes
*/
require_once (COPIX_CORE_PATH .'CopixFileSelector.class.php');
require_once (COPIX_CORE_PATH .'CopixContext.class.php');
require_once (COPIX_CORE_PATH .'CopixErrorObject.class.php');
require_once (COPIX_CORE_PATH .'CopixPluginFactory.class.php');
require_once (COPIX_CORE_PATH .'CopixConfig.class.php');
require_once (COPIX_CORE_PATH .'CopixTpl.class.php');
require_once (COPIX_CORE_PATH .'CopixAction.class.php');
require_once (COPIX_CORE_PATH .'CopixCoordination.class.php');

require_once (COPIX_CORE_PATH .'CopixActionReturn.class.php');
require_once (COPIX_CORE_PATH .'CopixActionGroup.class.php');
require_once (COPIX_CORE_PATH .'CopixZone.class.php');
require_once (COPIX_CORE_PATH .'CopixHTMLHeader.class.php');

//require_once (COPIX_CORE_PATH .'CopixInstance.lib.php');
require_once (COPIX_CORE_PATH .'CopixErrorHandler.lib.php');

require_once (COPIX_UTILS_PATH .'CopixUrl.class.php');
require_once (COPIX_UTILS_PATH .'CopixCache.class.php');
require_once (COPIX_UTILS_PATH .'CopixClassesFactory.class.php');
require_once (COPIX_UTILS_PATH .'CopixI18N.class.php');
require_once (COPIX_DAO_PATH   .'CopixDAOFactory.class.php');
?>
