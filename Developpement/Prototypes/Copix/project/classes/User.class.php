<?php
/**
* @package	phpaie
* @subpackage   security
* @version	
* @author	Pierre Raoul
*               see www.phpaie.net for other contributors.
* @copyright    2003-2004 Pierre Raoul
* @link		http://www.phpaie.net
* @licence      http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public Licence, see LICENCE file
*/

/**
 * User class
 *
 */
require_once (COPIX_AUTH_PATH.'CopixDBUser.class.php');
class User extends CopixDBUser {
   /**
   * Constructeur, pour surcharger les paramétrage de l'objet standard.
   */
   function User (){
      parent::CopixDBUser ();
      $this->loginRequest  = 'SELECT [--FIELDS--] from [--USERTABLE--]
                            WHERE  [--LOGINFIELD--] = [--LOGIN--] and [--PASSWORDFIELD--] = PASSWORD ([--PASSWORD--])';
      $this->fieldPropList = array ( 'user_name'  => 'login'
                                   , 'user_level' => 'level'
                                   );
      $this->userTable     = 'test_copix_user';
      $this->loginField    = 'user_login';
      $this->passwordField = 'user_password';
   }
   /**
   * We wants MySQL to handle the encryption of the password
   */
   function cryptPassword ($clearPass){
      return $clearPass;
   }
}
?>
