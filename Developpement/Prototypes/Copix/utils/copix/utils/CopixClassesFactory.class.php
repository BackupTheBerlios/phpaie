<?php
/**
* @package	copix
* @subpackage generaltools
* @version	$Id: CopixClassesFactory.class.php,v 1.1 2004/07/25 22:12:59 j-charles Exp $
* @author	Croes Gérald, Jouanneau Laurent
*           see copix.aston.fr for other contributors.
* @copyright 2001-2004 Aston S.A.
* @link		http://copix.aston.fr
* @licence  http://www.gnu.org/licenses/gpl.html GNU General Public Licence, see LICENCE file
*/

/**
 * permet d'instancier des classes
 * @package	copix
 * @subpackage generaltools
 */
class CopixClassesFactory {
   /**
   * creates a new object
   */
   function & createDAO ($name){
      //Récupération des éléments critiques.
      $file = CopixSelectorFactory::create($name);
      $filePath = $file->getPath() .COPIX_CLASSES_DIR.strtolower ($file->fileName).'.class.php' ;

      if (is_readable($filePath)){
         require_once ($filePath);
         $fileClass = 'DAO'.$file->fileName;
         return new $fileClass;
      }else{
         trigger_error (CopixI18N::get('copix:copix.error.unfounded.class',$name.'-'.$filePath), E_USER_ERROR);
         return null;
      }
   }
   /**
   * creates a new object
   */
   function & create ($name){
      //Récupération des éléments critiques.
      $file = CopixSelectorFactory::create($name);
      $filePath = $file->getPath() .COPIX_CLASSES_DIR.strtolower ($file->fileName).'.class.php' ;

      if (is_readable($filePath)){
         require_once ($filePath);
         $fileClass = $file->fileName;
         return new $fileClass;
      }else{
         trigger_error (CopixI18N::get('copix:copix.error.unfounded.class',$name.'-'.$filePath), E_USER_ERROR);
         return null;
      }
   }


}
?>
