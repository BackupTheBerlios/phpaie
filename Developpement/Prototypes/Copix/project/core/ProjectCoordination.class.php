<?php
/**
* @package	phpaie
* @subpackage   project/core
* @version	
* @author	Pierre Raoul
*               see www.phpaie.net for other contributors.
* @copyright    2004 Phpaie
* @link		http://www.phpaie.net
* @licence      http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public Licence, see LICENCE file
*/

require_once('Service.class.php');

class ProjectCoordination extends CopixCoordination {

    /**
     * constructor
     *
     * @private
     */  
    function ProjectCoordination ($configFile = null){
        // specify the default configuration file
        if (  ! isSet($configFile)
    	   || ! $configFile 
    	   ) {
            $configFile = COPIX_PROJECT_CONFIG;
    	}
    	CopixCoordination::CopixCoordination($configFile);
//        $this->execPath = dirname($_SERVER['SCRIPT_NAME']);
    }

    /**
     * instance function, just to hide the $GLOBALS access
     * TODO : remove the $GLOBALS => use static function
     * 
     * @pattern singleton
     * @public
     */  
    function & instance (){
    	return Service::instance('ProjectCoordination');
    }

    /**
     * Include all object definitions that must be known during a session
     * and all works needed before session start
     *
     * @access private
     */
     function _beforeSessionStart(){
         parent::_beforeSessionStart(); // needed for the Copix plugins
     }

    /**
     * @private
     */  
    function _processStandard( &$tplObject ) {
    	if ( ! isSet($tplObject->pageTitle) || ($tplObject->pageTitle === null) )
            $tplObject->assign ('PAGE_TITLE', PROJECT_TITLE);
    	if ( ! isSet($tplObject->titleBar)  || ($tplObject->titleBar  === null) )
            $tplObject->assign ('TITLE_BAR', PROJECT_TITLE_BAR);

        $this->getStandardTemplateData($tplObject);
    }
    
    /**
     * make this initialization accessible from the CopixZone::_createContent
     *
     * @public
     */  
    function getStandardTemplateData( & $tplObject ) {
        
        // URLs to WEB files
        if (! $tplObject->isAssigned('WEB_FILE_PATH')){
           $tplObject->assign ('WEB_FILE_PATH', COPIX_WEB_FILE_PATH);
        }
        if (! $tplObject->isAssigned('LOGOS_FILE_PATH')){
           $tplObject->assign ('LOGOS_FILE_PATH', COPIX_LOGO_PATH);
        }
        if (! $tplObject->isAssigned('SCRIPTS_FILE_PATH')){
           $tplObject->assign ('SCRIPTS_FILE_PATH', COPIX_SCRIPT_PATH);
        }

        // URL params
        if (! $tplObject->isAssigned('ENTRY_POINT')){
           $tplObject->assign ('ENTRY_POINT', COPIX_NAME_CODE_ENTRY);
        }
        if (! $tplObject->isAssigned('ACTION_PARAM')){
           $tplObject->assign ('ACTION_PARAM', COPIX_NAME_CODE_ACTION);
        }
        if (! $tplObject->isAssigned('DESC_PARAM')){
           $tplObject->assign ('DESC_PARAM', COPIX_NAME_CODE_DESC);
        }
        if (! $tplObject->isAssigned('MODULE_PARAM')){
           $tplObject->assign ('MODULE_PARAM', COPIX_NAME_CODE_MODULE);
        }
        
    }

}
?>
