<?php
/**
* @package	copix
* @subpackage auth
* @version	$Id: CopixDBUser.class.php,v 1.1 2004/07/25 22:12:59 j-charles Exp $
* @author	Croes Gérald , Jouanneau Laurent
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
   *  Maj des paramètres pour indiquer que l'utilisateur est bien loggé.
   * Ici, on se charge juste de dire que l'utilisateur est passé par la phase d'authentification.
   * Rien de plus. (a la limite, on peut gérer des sortes de stats.... durée de connexion et tout ça)
   * @param string  $name   login
   * @param string  $password   mot de passe
   * @return    boolean indique si authentification ok ou pas
   */
   function _doLogin ($name, $password=null){

      //Création de la requête utilisateur, par remplacement des différents
      //Champs de paramètres si fournits.
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
   * Charge les paramètres sur l'objet utilisateur, a partir de la requête
   * envoyée.
   */
   function _loadParams ($objInfos){
      //parcour des champs, mise à jour de l'utilisateur.
      foreach ($this->fieldPropList as $field=>$userField) {
         $this->$userField = $objInfos->$field;
      }
   }
   
   /**
   * Récupération de la liste des utilisateurs.
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
   * récupère la requête parsée correctement.
   * (Avec les champs spéciaux remplacés.)
   * @param string  $request    requête SQL avec les tags à remplacer
   * @return    string  requête finale
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
   * récupération de la requete avec les logins / password.
   * @param string  $request    requête SQL avec les tags login/password à remplacer
   * @return    string  requête finale
   */
   function _getParsedRequestLoginPassword ($request, $login, $password){
      $ct = CopixDbFactory::getConnection ();
      $request = str_replace ('[--LOGIN--]', $ct->quote ($login), $request);
      return str_replace ('[--PASSWORD--]', $ct->quote ($this->cryptPassword ($password)), $request);
   }
}
?>
