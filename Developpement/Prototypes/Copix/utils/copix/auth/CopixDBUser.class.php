<?php
/**
* @package	copix
* @subpackage auth
* @version	$Id: CopixDBUser.class.php,v 1.1 2004/07/25 22:12:59 j-charles Exp $
* @author	Croes G�rald , Jouanneau Laurent
*           see copix.aston.fr for other contributors.
* @copyright 2001-2004 Aston S.A.
* @link		http://copix.aston.fr
* @licence  http://www.gnu.org/licenses/gpl.html GNU General Public Licence, see LICENCE file
*/

/**
 * @ignore
 */
require_once (COPIX_AUTH_PATH.'CopixUser.class.php');

/**
* This is the base class for authentification process
* You should extend this class to fit your needs.
* @package	copix
* @subpackage auth
* @see ProjectUser.class.php
*/
class CopixDBUser extends CopixUser {
   var $loginRequest  = 'SELECT [--FIELDS--] from [--USERTABLE--]
                         WHERE  [--LOGINFIELD--] = [--LOGIN--]
                                AND [--PASSWORDFIELD--] = PASSWORD ([--PASSWORD--])';

   var $fieldPropList = array ('login_cusr'=>'login', 'name_cusr'=>'name',
                               'firstname_cusr'=>'firstname');

   var $userTable     = 'CopixUser';
   var $loginField    = 'login_cusr';
   var $passwordField = 'password_cusr';
   
   function CopixDBUser (){
      parent::CopixUser ();
   }

   /**
   *  Maj des param�tres pour indiquer que l'utilisateur est bien logg�.
   * Ici, on se charge juste de dire que l'utilisateur est pass� par la phase d'authentification.
   * Rien de plus. (a la limite, on peut g�rer des sortes de stats.... dur�e de connexion et tout �a)
   * @param string  $name   login
   * @param string  $password   mot de passe
   * @return    boolean indique si authentification ok ou pas
   */
   function _doLogin ($name, $password=null){

      //Cr�ation de la requ�te utilisateur, par remplacement des diff�rents
      //Champs de param�tres si fournits.
      $request = $this->_getParsedRequest ($this->loginRequest);
      //remplacement de login / password.
      $request = $this->_getParsedRequestLoginPassword ($request, $name, $password);

      $dbw = CopixDbFactory::getDbWidget();

      //remplacement des champs [--USER--] et [--PASSWORD--]
      if( $r = $dbw->fetchFirst ($request)){
         $this->_loadParams ($r);
         return true;
      }else{
         return false;
      }
   }

   /**
   * Charge les param�tres sur l'objet utilisateur, a partir de la requ�te
   * envoy�e.
   */
   function _loadParams ($objInfos){
      //parcour des champs, mise � jour de l'utilisateur.
      foreach ($this->fieldPropList as $field=>$userField) {
         $this->$userField = $objInfos->$field;
      }
   }
   
   /**
   * R�cup�ration de la liste des utilisateurs.
   * @return    array   liste des utilisateurs
   */
   function getList ($userobjectname='ProjectUser'){
      $toReturn = array ();
      $ct = CopixDBFactory::getDBWidget ();

      $rs = $ct->doSelect ($this->userTable, array_keys($this->fieldPropList), array ());
      while ($r = $rs->fetch ()){
         $pu = new $userobjectname ();
         foreach ($this->fieldPropList as $field=>$userField) {
            $pu->$userField = $r->$field;
         }
         $toReturn[] = $pu;
      }
      return $toReturn;
   }

   /**
   * r�cup�re la requ�te pars�e correctement.
   * (Avec les champs sp�ciaux remplac�s.)
   * @param string  $request    requ�te SQL avec les tags � remplacer
   * @return    string  requ�te finale
   */
   function _getParsedRequest ($request){
      //la liste des champs.
      $fieldString = implode (', ', array_keys ($this->fieldPropList));
      $request = str_replace('[--FIELDS--]', $fieldString, $request);

      //remplacement de la table des users.
      $request  = str_replace ('[--USERTABLE--]', $this->userTable, $request);

      //Remplacement du champ de login.
      $request = str_replace ('[--LOGINFIELD--]', $this->loginField, $request);

      //remplacement du champ password.
      return str_replace ('[--PASSWORDFIELD--]', $this->passwordField, $request);
   }

   /**
   * r�cup�ration de la requete avec les logins / password.
   * @param string  $request    requ�te SQL avec les tags login/password � remplacer
   * @return    string  requ�te finale
   */
   function _getParsedRequestLoginPassword ($request, $login, $password){
      $ct = CopixDbFactory::getConnection ();
      $request = str_replace ('[--LOGIN--]', $ct->quote ($login), $request);
      return str_replace ('[--PASSWORD--]', $ct->quote ($this->cryptPassword ($password)), $request);
   }
}
?>
