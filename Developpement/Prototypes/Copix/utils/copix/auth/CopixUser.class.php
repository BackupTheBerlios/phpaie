<?php
/**
* @package	copix
* @subpackage auth
* @version	$Id: CopixUser.class.php,v 1.1 2004/07/25 22:12:59 j-charles Exp $
* @author	Croes Gérald , Jouanneau Laurent
*           see copix.aston.fr for other contributors.
* @copyright 2001-2004 Aston S.A.
* @link		http://copix.aston.fr
* @licence  http://www.gnu.org/licenses/gpl.html GNU General Public Licence, see LICENCE file
*/

/**
 * This is the base class for authentification process
 * You should extend this class to fit your needs.
 * @package	copix
 * @subpackage auth
 */
class CopixUser {
   var $login = null;//the login that was used to establish the connection.
   var $level = 0;//Le niveau de droits de l'utilisateur.

   var $_isConnected;//if we are connected or not.
   var $_lastError;  //the last error code.
   var $_connectedTimeStamp;//when did we really connect to the application.

   function CopixUser (){
      $this->_setNotConnected ();
   }
   /**
   *  essaye de se logger avec le password donné.
   */
   function login ($name, $password){
      if (!$this->_doLogin ($name, $password)){
         $this->logout ();
         return false;
      }
      //Date de connexion.
      $this->_connectedTimeStamp = date ('d-m-Y:H:i:s');
      $this->_isConnected  = true;
      return true;
   }
   /**
   *  Maj des paramètes pour indiquer que l'utilisateur n'est pas loggé.
   */
   function logout (){
      $this->_setNotConnected();
   }
   /**
   * Initialise les paramètres de l'objet utilisateur à l'état non connecté.
   */
   function _setNotConnected (){
      $this->login = null;
      $this->level = 0;

      $this->_isConnected = false;
      $this->_lastError = null;
      $this->_connectedTimeStamp = null;//when did we really connect to the application.
   }
   /**
   *  Maj des paramètres pour indiquer que l'utilisateur est bien loggé.
   *  Ici, on se charge juste de dire que l'utilisateur est passé par la phase d'authentification.
   *  Rien de plus. (a la limite, on peut gérer des sortes de stats.... durée de connexion et tout ça)
   */
   function _doLogin ($name, $password){
      trigger_error( CopixI18N::get('copix:common.error.class.abstract'
                   , get_class($this).'::doLogin')
                   , E_USER_ERROR
                   );
   }
   /**
   * returns the crypted password.
   */
   function cryptPassword ($clearPass){
      return md5 ($clearPass);
   }
   /**
   * Retourne le niveau de droit de l'utilisateur.
   */
   function getUserLevel (){
      return $this->level;
   }
   /**
   * Récupération de la liste des utilisateurs.
   */
   function getList (){
      trigger_error (CopixI18N::get('copix:common.error.class.abstract',get_class($this).'::getList'), E_USER_ERROR);
   }
   /**
   * Indique si l'utilisateur est connecté.
   */
   function isConnected (){
      return $this->_isConnected;
   }

  /**
   * Check if the user have all the needed rights to perform the requested action.
   *
   * We assume the rights are defined as array ('auth', array ('ModuleName'=>'formula', 'ModuleName'=>'OtherFormula'))
   *  if more than one module is defined in the requested rights, we perform an "and"
   *
   * eg
   *  array ('News'=>'read', 'Newsletter'=>'read&write');
   *  we will need both the "read on the news" and "read and write on the newsletter"
   *  rigths to perform the described action
   */
   function checkAllNeededRights (&$p){
      //if there's no param at all for the auth plugin, we assume we can do it
      //nothing to do with any sportware....
      if ( isset ($p['Auth']) ){
         return $this->level >= $p['Auth'];
      }else{
         return true;
      }
   }
}
?>
