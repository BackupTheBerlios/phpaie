<?php
/**
* @package	Phpaie
* @subpackage   project
* @version	
* @author	Pierre Raoul
*               see www.phpaie.net for other contributors.
* @copyright    2004 Pierre Raoul
* @link		http://www.phpaie.net
* @licence      http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public Licence, see LICENCE file
*/

class ActionGroupDefault extends CopixActionGroup {
   /**
    * Constructor
    */
    function ActionGroupDefault (){
        parent::CopixActionGroup ();
    }

   /**
    * Prepare data for welcome page
    */
   function getWelcome() {
      
      //création de l'objet.
      $_template = & new CopixTpl();
      
      $_template->assign( 'MAIN', $this->processZone('Welcome') );


      //retour de la fonction.
      return new CopixActionReturn(COPIX_AR_DISPLAY, $_template);
   }

   /**
    * Ask for login information
    */
   function getNoRight() {
      
      //création de l'objet.
      $_template = & new CopixTpl();
      
//      $_url_return = 'do.php?action=' .$this->vars['action'] .'&' .'module=' .$this->vars['module']; 
      $_returnUrl = & new ProjectUrl( $this->vars['action'], null, $this->vars['module']);
      $_template->assign( 'LOGIN_FORM'
                        , $this->processZone ( 'auth|LoginForm'   
//                                             , array('url_return' => $_url_return)
                                             , array('url_return' => $_returnUrl->getUrl())
                                             ));

      //retour de la fonction.
      return new CopixActionReturn(COPIX_AR_DISPLAY, $_template);
   }

}
?>
