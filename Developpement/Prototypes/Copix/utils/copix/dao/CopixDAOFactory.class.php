<?php
/**
* @package	copix
* @subpackage copixdao
* @version	$Id: CopixDAOFactory.class.php,v 1.1 2004/07/25 22:12:59 j-charles Exp $
* @author	Croes Gérald , Jouanneau Laurent
*           see copix.aston.fr for other contributors.
* @copyright 2001-2004 Aston S.A.
* @link		http://copix.aston.fr
* @licence  http://www.gnu.org/licenses/gpl.html GNU General Public Licence, see LICENCE file
*/

/**
* Factory to create automatic DAO.
*/
class CopixDAOFactory {
   /**
   * singleton.
   */
   function & instance (){
      static $instance = false;
      if ($instance === false){
         $instance = new CopixDAOFactory ();
      }
      return $instance;
   }

   /**
   * creates a DAO from its Id.
   * If no dao is founded, try to compile a DAO from the user definitions.
   */
   function & create ($DAOid){
      $instance = & CopixDAOFactory::instance ();
      $instance->fileInclude ($DAOid);

      require_once ($instance->getCompiledPath ($DAOid));
      $className = $instance->getDAOName ($DAOid);
      return new $className ();
   }

   /**
   * creates a record object
   */
   function & createRecord ($DAOid){
      $instance = & CopixDAOFactory::instance ();
      $instance->fileInclude ($DAOid);

      $className = $instance->getDAORecordName ($DAOid);
      return new $className ();
   }
   
   /**
   * includes the compiled
   */
   function fileInclude ($DAOid){
      $instance = & CopixDAOFactory::instance ();
      $conf     = & $GLOBALS['COPIX']['CONFIG'];

      //si oui, compilation et retour.
      if ($instance->_needsCompilation ($DAOid)){
         require_once (COPIX_DAO_PATH.'CopixDAOCompiler.class.php');
         $compiler = & new CopixDAOCompiler ();
         $compiler->compile ($DAOid);
      }
      require_once ($instance->getCompiledPath ($DAOid));
   }

   /**
    * @deprecated use createSearchConditions instead, better api
    */
   function & createSearchParams ($kind = 'AND'){
      require_once (COPIX_DAO_PATH.'CopixDAOSearchParams.class.php');
      return new CopixDAOSearchParams ($kind);
   }

   function & createSearchConditions ($kind = 'AND'){
      require_once (COPIX_DAO_PATH.'CopixDAOSearchConditions.class.php');
      return new CopixDAOSearchConditions ($kind);
   }

   /**
   * gets the expected DAO compiled path.
   */
   function getCompiledPath ($DAOid){
      $selector = & CopixSelectorFactory::create ($DAOid);
      if ($selector->isValid){
         return   $GLOBALS['COPIX']['CONFIG']->compile_dao_dir 
                . strtolower( str_replace( array ('|', ':')
                                         , array ('_mod-', '_res-')
                                         , $selector->getSelector()
                                         ))
                . '.dao.class.php'
                ;
      }else{
         trigger_error (CopixI18N::get('copix:dao.error.selector.invalid',$DAOId),E_USER_ERROR);
      }
   }

   /**
   * gets the path where the users elements are supposed to be located.
   */
   function _getUserPath (){
      $selector = & CopixSelectorFactory::create ($DAOid);
      if (!$selector->isValid){
         return $selector->getPath ();
      }
      return null;
   }

   /**
   * gets the expected DAO users element files path.
   */
   function _getUsersFilesPath ($DAOid){
      $toReturn = array ();

      $selector = & CopixSelectorFactory::create ($DAOid);
      if (!$selector->isValid){
         return $toReturn;
      }
      $fileName=strtolower($selector->fileName);
      $toReturn [] = $selector->getPath ().$fileName.'dao.single.class.php';
      //single.class.php

      $toReturn [] = $selector->getPath (COPIX_CLASSES_DIR).$fileName.'.dao.user.class.php';
      //dao.class.php

      $toReturn [] = $selector->getPath (COPIX_RESOURCES_DIR).$fileName.'.dao.definition.xml';
      //dao.definition.class.php
echo '<pre>';
print_r($toReturn);
echo '</pre>';
      return $toReturn;
   }
   
   /**
   * the function says wether or not we need to compile the dao.
   */
   function _needsCompilation ($DAOid){
      if ($GLOBALS['COPIX']['CONFIG']->compile_dao_forced){
         return true;
      }
      //regarde s'il existe la classe compilée.
      $compiledPath = $this->getCompiledPath ($DAOid);
      if (!is_readable($compiledPath)){
         //compiled file does not exists.....
         return true;
      }

      //do we want to check if the compiled file is up to date ?
      if ($GLOBALS['COPIX']['CONFIG']->compile_dao_check){

         $compiledTime = filemtime ($compiledPath);

         $usersPath = $this->_getUsersFilesPath ($DAOid);

         foreach ($usersPath as $name){
            //checks the file age.
            if (is_readable ($name)){
               //not readable, we may consider it is not needed.
               if ($compiledTime < filemtime ($name)){
                  //the file time is greater than the compiled file time.
                  //we need to refresh.
                  return true;
               }
            }
         }
      }
      //nothing matched.... the file appears to be up to date.
      return false;
   }

   /**
   * gets the name of the class from its DAOId
   */
   function getDAOName ($DAOid){
      $selector = & CopixSelectorFactory::create ($DAOid);
      if ($selector->isValid){
         return 'CompiledDAO' .$selector->fileName;
      }
      trigger_error (CopixI18N::get('copix:dao.error.selector.invalid',$DAOId),E_USER_ERROR);
   }

   /**
   * gets the name of the final DAORecord
   */
   function getDAORecordName ($DAOid){
      $selector = & CopixSelectorFactory::create ($DAOid);
      if ($selector->isValid){
         return 'CompiledDAORecord'.$selector->fileName;
      }
      trigger_error (CopixI18N::get('copix:dao.error.selector.invalid',$DAOId),E_USER_ERROR);
   }
}
?>
