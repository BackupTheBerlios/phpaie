<?php
/**
* @package	copix
* @subpackage core
* @version	$Id: CopixContext.class.php,v 1.1 2004/07/25 22:12:59 j-charles Exp $
* @author	Croes G�rald, Jouanneau Laurent
*           see copix.aston.fr for other contributors.
* @copyright 2001-2004 Aston S.A.
* @link		http://copix.aston.fr
* @licence  http://www.gnu.org/licenses/gpl.html GNU General Public Licence, see LICENCE file
*/


/**
* Classe de gestion des contextes de l'application.
* Nous allons g�rer le fait des entr�es sorties dans les diff�rents modules.
* Correction du probl�me "module|name".
* @package	copix
* @subpackage generaltools
*/
class CopixContext {
   /**
   * Pile de gestion des contextes.
   */
   var $_contextStack = array ();

   /**
   * Empilement d'un contexte.
   * @param string $module  le nom du module dont on empile le contexte
   */
   function push ($module){
      $stack = & CopixContext::instance ();
      array_push ($stack->_contextStack, $module);
   }

   /**
   * D�pilement d'un contexte.
   * @return string element d�pil�. (le contexte qui n'est plus d'atualit�.)
   */
   function pop (){
      $stack = & CopixContext::instance ();
      if (count ($stack->_contextStack) < 1){
         trigger_error (CopixI18N::get('copix:copix.error.context.stack'), E_USER_ERROR);
      }
      return array_pop ($stack->_contextStack);
   }
   
   /**
   * r�cup�re le contexte actuel
   * @return string le nom du contexte actuel si d�fini, si pas de contexte (projet), retourne null
   */
   function get (){
      $stack = & CopixContext::instance ();
      return (($last = (count ($stack->_contextStack)-1)) >= 0) ? $stack->_contextStack[$last] : null;
   }
   
   /**
   * r�initialise le contexte.
   */
   function clear (){
      $stack = & CopixContext::instance ();
      $stack->_contextStack = array ();
   }
   
   /**
   * r�cup�ration de l'instance de la pile
   *    Utilise le singleton.
   * @return CopixContext   singleton
   */
   function & instance (){
      static $instance = null;
      if ($instance === null){
         $instance = new CopixContext ();
      }
      return $instance;
   }
}
?>
