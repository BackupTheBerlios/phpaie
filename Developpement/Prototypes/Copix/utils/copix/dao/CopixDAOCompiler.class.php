<?php
/**
* @package	copix
* @subpackage copixdao
* @version	$Id: CopixDAOCompiler.class.php,v 1.1 2004/07/25 22:12:59 j-charles Exp $
* @author	Croes Gérald , Jouanneau Laurent
*           see copix.aston.fr for other contributors.
* @copyright 2001-2004 Aston S.A.
* @link		http://copix.aston.fr
* @licence  http://www.gnu.org/licenses/gpl.html GNU General Public Licence, see LICENCE file
*/
require_once (COPIX_UTILS_PATH .'CopixFileLocker.class.php');
require_once (COPIX_DAO_PATH.'CopixDAOSearchConditions.class.php');

/**
* The compiler for the DAO classes.
*/
class CopixDAOCompiler {

   /**
   * the current DAO id.
   */
   var $_DAOid ='';

   /**
   * the base name of dao object.
   */
   var $_baseName= '';

   /**
   *
   */
   var $_shortFileName='';

    /**
     * compile the given class id.
     */
    function compile ($DAOid) {

      // recuperation du chemin et nom de fichier de definition xml de la dao
      $this->_DAOid = $DAOid;

      $selector = & CopixSelectorFactory::create ($this->_DAOid);
      if (!$selector->isValid){
         trigger_error (CopixI18N::get('dao.error.selector.invalid', $this->_DAOid), E_USER_ERROR);
      }

      $this->_baseName = $selector->fileName;
      $this->_shortFileName = strtolower ($selector->fileName.'.dao.definition.xml');
      $fileName = $selector->getPath(COPIX_RESOURCES_DIR).$this->_shortFileName;

      if (!(is_file ($fileName) && is_readable ($fileName))){
         trigger_error (CopixI18N::get('copix:dao.error.definitionfile.unknow' , $fileName ), E_USER_ERROR);
      }

      // chargement du fichier XML
      require_once (COPIX_UTILS_PATH.'CopixSimpleXml.class.php');
      $xmlParser  = & new CopixSimpleXML ();
      $parsedFile = $xmlParser->parseFile ($fileName);

      // chargement de l'analyseur de définition et du générateur de code, adéquate à la version de la dao
      $attr = $parsedFile->attributes();
      $version=1;
      if(isset($attr['VERSION'])){
         $version=intval($attr['VERSION']);
      }

      if($version == 1) {
         require_once (COPIX_DAO_PATH.'CopixDAODefinitionV1.class.php');
         require_once (COPIX_DAO_PATH.'CopixDAOGeneratorV1.class.php');
         $userDefinition =& new CopixDAODefinitionV1 ($this);
         $generator = & new CopixDAOGeneratorV1($this);
      }else{
         require_once (COPIX_DAO_PATH.'CopixDAODefinitionV0.class.php');
         require_once (COPIX_DAO_PATH.'CopixDAOGeneratorV0.class.php');
         $userDefinition =& new CopixDAODefinitionV0 ($this);
         $generator = & new CopixDAOGeneratorV0($this);
      }

      // analyse de la définition
      $userDefinition->loadFrom($parsedFile);

      // inclusion des classes "surchargeant" les futures classes générées
      $DAOPath = $selector->getPath (COPIX_CLASSES_DIR).strtolower ($selector->fileName.'.dao.class.php');
//echo '$DAOPath : '. $DAOPath .'<br>';
      if (is_readable ( $DAOPath)){
         require_once ($DAOPath);
         $generator->setUserDAOPath($DAOPath);

         // eventuelle surcharge de la classe DAO
         $className = $this->_DAOClassName ();
//echo '$this->_DAOClassName : '. $className .'<br>';
         if (class_exists ($className)){
            $generator->setUserDAO(new $className ());
         }

         // eventuelle surcharge de la classe du record DAO
         $className = $this->_DAORecordClassName ();
//echo '$this->_DAORecordClassName : '. $className .'<br>';
         if (class_exists ($className)){
            $generator->setUserDAORecord(new $className ());
         }
      }

      $generator->setUserDefinition($userDefinition);

      // génération des classes PHP correspondant à la définition de la DAO
      $compiled = '<?php ';
      $compiled .= $generator->compileDAORecordClass ();
      $compiled .= $generator->compileDAO ();
      $compiled .="\n?>";
      $objectWriter = & new CopixFileLocker ();
      $objectWriter->write (CopixDAOFactory::getCompiledPath ($DAOid), $compiled, 'w');
   }

   /**
   * gets the single class name.
   */
   function _DAORecordClassName (){
      return 'DAORecord'.$this->_baseName;
   }

   /**
   * gets the DAO classname.
   */
   function _DAOClassName (){
      return 'DAO'.$this->_baseName;
   }


   function doDefError($messageI18N, $arg1=null){
      $arg=array($this->_shortFileName);
      if(is_array($arg1))
         $arg=array_merge($arg, $arg1);
      else
         $arg[]=$arg1;
      trigger_error (CopixI18N::get($messageI18N,$arg),E_USER_ERROR);
   }

   function doGenError($messageI18N, $arg1=null){
      $arg=array($this->_shortFileName);
      if(is_array($arg1))
         $arg=array_merge($arg, $arg1);
      else
         $arg[]=$arg1;
      trigger_error (CopixI18N::get($messageI18N, $arg),E_USER_ERROR);
   }
}
?>
