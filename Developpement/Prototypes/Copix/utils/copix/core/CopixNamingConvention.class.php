<?php
/**
* @package	copix
* @subpackage generaltools
* @version	$Id: CopixNamingConvention.class.php,v 1.1 2004/07/25 22:12:59 j-charles Exp $
* @author	Croes G�rald
* @copyright 2001-2004 Aston S.A.
* @link		http://copix.aston.fr
* @licence  http://www.gnu.org/licenses/gpl.html GNU General Public Licence, see LICENCE file
*/

/**
 * sert � d�coder les nomages copix
 *
 * @package	copix
 * @subpackage generaltools
 */
class CopixNamingConvention {
   /**
   * extrait le nom du module depuis une chaine format�e comme suit: module|nomFichier
   * @param    string  $from   le nom format� du fichier
   * @return   string  le nom du module
   */
   function getModule ($from){
      if (!CopixNamingConvention::isSafe ($from)){
         trigger_error ('Invalid '.$from.'', E_USER_ERROR);
      }
      $into = explode ('|', $from);

      //si trouv�, premier element == module, sinon module courant.
      return (count ($into) > 1) ? $into[0] : null;
   }

   /**
   * extrait le nom du fichier a partir d'une chaine format�e module|nom
   * @param    string  $from   le nom format� du fichier
   * @return   string   le nom du fichier
   */
   function getFile ($from){
      if (!CopixNamingConvention::isSafe ($from)){
         trigger_error ('Invalid '.$from.'', E_USER_ERROR);
      }

      $into = explode ('|', $from);
      //si trouv�, second element == nom de fichier, sinon tout est le nom du
      //   fichier.
      return (count ($into) > 1) ? $into[1] : $from;
   }

   /**
   * indique si le chemin est s�curis�.
   * @param	string	$toCheck
   */
   function isSafe ($toCheck){
      return ! ereg ("^[|_0-9a-zA-Z-]$", $toCheck);
   }
   
   /**
   * extrait le nom du module de la chaine, utilise le contexte pour retourner
   *   un r�sultat.
   * @param    string  $from   le nom format� du fichier
   * @return   string  le nom du module, null si projet
   */
   function getModuleUsingContext ($from){
      //v�rifie que le nom soit sur.
      if (!CopixNamingConvention::isSafe ($from)){
         trigger_error ('Invalid '.$from.'', E_USER_ERROR);
      }

      //r�cup�ration des deux �l�ments.
      $into = explode ('|', $from);

      //Si un �l�ment module est demand�, retour.
      if (count ($into) > 1){
         return $into[0] !== '' ? $into[0] : null;
      }else{
         //Pas d'�l�ment trouv�, retourne le contexte courant.
         return CopixContext::get ();
      }
   }
}
?>
