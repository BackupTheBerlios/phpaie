<?php
//define ('DEBUG_PR', true);

/**
* Define options for the project
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
* URL AND DEFAULT VALUES
******************************************************************************/
// use of Apache rewrite module ?
define ('APACHE_MOD_REWRITE', true);
// we define what the url should look like.
// here: do.php?action=value_action&module=value_module&desc=value_desc
if (APACHE_MOD_REWRITE) define ('COPIX_NAME_CODE_ENTRY' , 'do');
else define ('COPIX_NAME_CODE_ENTRY' , 'do.php');
define ('COPIX_NAME_CODE_ACTION', 'action');
define ('COPIX_NAME_CODE_DESC'  , 'desc');
define ('COPIX_NAME_CODE_MODULE', 'module');

// then we define the default values for thoose params if not specified.
// Note: When no module is being asked for, we execute a project action
// See documentation for further information on modules and project
define ('COPIX_DEFAULT_VALUE_MODULE', null);
define ('COPIX_DEFAULT_VALUE_ACTION', 'default');
define ('COPIX_DEFAULT_VALUE_DESC'  , 'default');

/******************************************************************************
* DEFAULT DATA BASE ACCESS
******************************************************************************/
// Define the default data base access
// CopixDbID semble ne plus être définie dans la v. 2.1
//require_once (COPIX_PATH . 'db/CopixDbFactory.class.php');
//define ('COPIX_DEFAULT_DB_DBMS'     , CopixDbID::MySQL() );
define ('COPIX_DEFAULT_DB_ACCESS'   , 'Default');
define ('COPIX_DEFAULT_DB_DBMS'     , 'mysql' );
// Must be changed by end user
define ('COPIX_DEFAULT_DB_NAME'     , 'YOUR_DB_NAME');
define ('COPIX_DEFAULT_DB_HOST'     , 'YOUR_DB_HOST');
define ('COPIX_DEFAULT_DB_USER'     , 'YOUR_DB_USER');
define ('COPIX_DEFAULT_DB_PASS'     , 'YOUR_DB_PASS');
define ('COPIX_DEFAULT_DB_PERSIST'  , true);
define ('COPIX_DEFAULT_DB_POOL'     , false);
define ('COPIX_DEFAULT_DB_SCHEMA'   , '');

/******************************************************************************
* DEFAULT VIEW VALUES
******************************************************************************/
// Define the default values for views 
// note: ProjectConfig must be already instancied
define ('PROJECT_TITLE'     , CopixI18N::get ('project.title', null, 'fr' ));
define ('PROJECT_TITLE_BAR' , CopixI18N::get ('project.title.bar', null, 'fr' ));

?>
