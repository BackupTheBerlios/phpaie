<?php
/**
* @package      copix
* @subpackage   example
* @version      $Id: welcome.actiongroup.php,v 1.1 2004/07/25 22:12:58 j-charles Exp $
* @author       Pierre Raoul
*               see www.phapie.net for other contributors.
* @copyright    2004 Pierre Raoul
* @link         http://www.phpaie.net
* @licence      http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public Licence, see LICENCE file
*/

/**
 * handle the welcome pages: information, registration, legal notice...
 */
class ActionGroupWelcome extends CopixActionGroup {

    /**
     * Gets a general information page
     */
    function getInformation (){

        $_controller = & ProjectCoordination::instance();
      
        $_template = & new CopixTpl ();

        $_template->assign( 'TITLE_PAGE', 'Information page');
        
        $_template->assign( 'MAIN'
                     ,   '<h3>'.CopixI18N::get( '|views.common.s0006' ).'</h3>' ."\n" // Page en travaux 
                       . $_controller->includeStatic( CopixI18N::get( 'project.file.welcome.information' ))
                       . '<a href="./">' .CopixI18N::get( '|views.common.s0005' ) .'</a>' ."\n" // Retour
                       );

        return new CopixActionReturn(COPIX_AR_DISPLAY, $_template);
    }

    /**
     * Gets the legal notice page
     */
    function getLegalNotice () {
        $_template = & new CopixTpl ();

        $_template->assign ('TITLE_PAGE', 'Legal Notice page');
        $_template->assign( 'MAIN'
                     ,   '<h3>'.CopixI18N::get( '|views.common.s0006' ).'</h3>' ."\n" // Page en travaux  
                       . $this->processZone( 'legalNotice' )
                       );

        return new CopixActionReturn (COPIX_AR_DISPLAY, $_template);
    }

    /**
     * Gets the registration page
     */
    function getRegistration () {
        $_template = & new CopixTpl ();

        $_template->assign ('TITLE_PAGE', 'Registration page');
        $_template->assign( 'MAIN'
                     ,   '<h3>'.CopixI18N::get( '|views.common.s0006' ).'</h3>' ."\n" // Page en travaux  
                       . $this->processZone( 'registration' )
                       );

        return new CopixActionReturn (COPIX_AR_DISPLAY, $_template);
    }

}
?>
