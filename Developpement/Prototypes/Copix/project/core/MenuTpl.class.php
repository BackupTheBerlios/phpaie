<?php
/**
* @package	project
* @subpackage   core
* @version	
* @author	Pierre Raoul
* @copyright    2004 Pierre Raoul
* @licence  http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public Licence, see LICENCE file
*/

require_once(COPIX_PROJECT_PATH.COPIX_CORE_DIR.'ProjectTpl.class.php');

/**
 * Adaptation du Moteur de template Copix 
 * Permet de définir un menu
 * @package    project
 * @subpackage core
 */
class MenuTpl extends ProjectTpl {  // extends CopixTpl
	
    function MenuTpl( $titlepage = null) {
        ProjectTpl::ProjectTpl($titlepage);
        
        $this->assign( 'MENU', $this->processZone( 'menu' ) );
               
    }

}
?>
