<?php
/**
* Define file organization options for the project
* Note: if require or include instructions here, only for other define instructions
*
* @package	Phpaie
* @subpackage   project
* @version	
* @author	Croes Gérald, Jouanneau Laurent (Copix framework)
* @modified     Pierre Raoul (Phpaie project)
* @copyright    2001-2003 Aston S.A.; 2004 Phpaie
* @link		http://www.phpaie.net
* @licence      http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public Licence, see LICENCE file
*/

/******************************************************************************
* COPIX PATH
* Project, Modules and plugins.
******************************************************************************/
//We consider the project tree is always like:

// project
//  | project.inc.php
//  | project.option.php (this file)
//  |
//  |-desc
//  |-actiongroups
//  |-zones
//  |-templates
//  |-static
//  |-plugins
//  |-module
//  |  |
//  |  |-desc
//  |  |-actiongroups
//  |  |-zones
//  |  |-templates
//  |  |-static
//
//if you want to change thoose values, here you go.
define ('COPIX_PROJECT_PATH'   , dirname (__FILE__).'/');//project is obviously in its own directory
define ('COPIX_DESC_DIR'       , 'desc/');
/**
* kept for compatibility issues.
* @deprecated
* @since Copix2_RC1
*/
define ('COPIX_PAGES_DIR'      , 'actiongroup/');
/**
* Replace COPIX_PAGES_DIR
* @since Copix2_RC1
*/
define ('COPIX_ACTIONGROUP_DIR', 'actiongroup/');

define ('COPIX_ZONES_DIR'      , 'zones/');
define ('COPIX_TEMPLATES_DIR'  , 'templates/');
define ('COPIX_STATIC_DIR'     , 'static/');
define ('COPIX_CLASSES_DIR'    , 'classes/');
define ('COPIX_CORE_DIR'       , 'core/');
define ('COPIX_CONFIG_DIR'     , 'config/');
define ('COPIX_RESOURCES_DIR'  , 'resources/');
define ('COPIX_PLUGINS_DIR'    , 'plugins/');

/**
* framework's main configuration files
*/
define ('COPIX_TEMP_PATH'      , realpath(dirname(__FILE__).'/../temp/').'/');
define ('COPIX_LOG_PATH'       , COPIX_TEMP_PATH.'log/');
define ('COPIX_CACHE_PATH'     , COPIX_TEMP_PATH.'cache/');
define ('COPIX_PLUGINS_PATH'   , COPIX_PROJECT_PATH.'plugins/');
define ('COPIX_MODULE_PATH'    , COPIX_PROJECT_PATH.'modules/');

define ('COPIX_WEB_FILE_PATH'  , 'www/');
define ('COPIX_IMG_PATH'       , COPIX_WEB_FILE_PATH.'img/');
define ('COPIX_LOGO_PATH'      , COPIX_IMG_PATH.'logos/');
define ('COPIX_SCRIPT_PATH'    , COPIX_WEB_FILE_PATH.'script/');

/******************************************************************************
* PROJECT'S SMARTY PLUGINS
******************************************************************************/

define ('PROJECT_SMARTY_PLUGIN_PATH'    , COPIX_PROJECT_PATH.'plugins/smarty');

?>
