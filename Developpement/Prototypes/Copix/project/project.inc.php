<?php
/**
* Include all needed files for this project
*
* @package	CopixTestApp
* @subpackage   project
* @version	
* @author	Croes Gérald, Jouanneau Laurent (Copix framwork)
* @modified     Pierre Raoul (Phpaie project)
* @copyright    2001-2003 Aston S.A.; 2004 Phpaie
* @link		http://www.phpaie.net
* @licence      http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public Licence, see LICENCE file
*/

// define specific options for this project
//define('COPIX_DIR', 'copix_2.0.1/');
//define('COPIX_DIR', 'copix2.1cvs_20040404/');
define ('COPIX_DIR', realpath(dirname(__FILE__).'/../').'/'); //version embarquée dans Copix

// to use the next line, you must add in utils/copix/copy.inc.php the line:
//        if ( ! defined('COPIX_SMARTY_PATH') )
// before:
//            define ('COPIX_SMARTY_PATH', realpath(dirname(__FILE__).'/../smarty/').'/'); 
//define('COPIX_SMARTY_PATH','Smarty-2.6.0/libs/'); // Smarty not embedded under the project or Copix
// Smarty embedded with Copix => default value of COPIX_SMARTY_PATH 

// htmlMimeMail embedded with Copix 

//includes copix files.
//will define constants, paths, relative to copix.
//require_once ('../utils/copix/copix.inc.php');
require_once (COPIX_DIR.'utils/copix/copix.inc.php');

//include copix_project files.
//will mainly define paths relative to the actual project.
//(zones, pages, modules, plugins, ...)
require_once ('project.struct.option.php');
require_once (COPIX_PROJECT_PATH.COPIX_CORE_DIR.'ProjectConfig.class.php');
ProjectConfig::instance();// to initialize $GLOBALS' variables
require_once('project.misc.option.php');
require_once(COPIX_PROJECT_PATH.COPIX_CORE_DIR.'Properties.class.php');
require_once(COPIX_PROJECT_PATH.COPIX_CORE_DIR.'Service.class.php');
require_once(COPIX_PROJECT_PATH.COPIX_CORE_DIR.'HttpSession.class.php');
require_once(COPIX_PROJECT_PATH.COPIX_CORE_DIR.'HttpRequest.class.php');
require_once(COPIX_PROJECT_PATH.COPIX_CORE_DIR.'ProjectUrl.class.php');
require_once(COPIX_PROJECT_PATH.COPIX_CORE_DIR.'MenuTpl.class.php');


require_once (COPIX_PROJECT_PATH.COPIX_CORE_DIR.'ProjectCoordination.class.php');

if ( ! defined('COPIX_PROJECT_CONFIG') )
    define('COPIX_PROJECT_CONFIG',COPIX_PROJECT_PATH.COPIX_CONFIG_DIR.'copix.conf.php');

?>
