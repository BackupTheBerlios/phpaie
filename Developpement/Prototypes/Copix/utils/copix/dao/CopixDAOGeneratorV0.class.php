<?php
/**
* @package	copix
* @subpackage copixdao
* @version	$Id: CopixDAOGeneratorV0.class.php,v 1.1 2004/07/25 22:12:59 j-charles Exp $
* @author	Croes Gérald , Jouanneau Laurent
*           see copix.aston.fr for other contributors.
* @copyright 2001-2004 Aston S.A.
* @link		http://copix.aston.fr
* @licence  http://www.gnu.org/licenses/gpl.html GNU General Public Licence, see LICENCE file
*/

require_once (COPIX_DAO_PATH.'CopixDAOGenerator.class.php');

class CopixDAOGeneratorV0 extends CopixDAOGenerator{

   /**
   * compile the single class
   */
   function & compileDAORecordClass (){
      //first, the name of ge class.
      $result  = "\nclass ".$this->_compiledDAORecordClassName." { \n";

//--Vars
      $classVars=array();
      $syncUserVarsNeeded = false;
      $classMethods =array();

      if ($this->_userDAORecord !== null){
         $classMethods = (array) get_class_methods ($this->_DAORecordClassName);

         $result .= ' var $_userDAORecord=null;'."\n";

//DAORecord user's fields
         //adds definition for every user's DAO properties.
         $result .= '//Vars defined in User\s DAORecord'."\n";
         $classVars = (array) get_class_vars ($this->_DAORecordClassName);
         foreach ($classVars as $name=>$default){
            $syncUserVarsNeeded = true;
            $result .= ' var $'.$name.' = null;'."\n";
         }
         $result .= '//-- end of user\'s Record vars'."\n";
      }

//DAORecord fields (not in user's DAO)
      //building the tab for the required properties.
      $usingFields = array ();
      $classVarsList= array_keys($classVars);
      foreach ($this->_userDefinition->getFields () as $id=>$field){
         if (!in_array ($field->name, $classVarsList)){
            $usingFields[$id] = $field;
         }
      }
      //declaration of properties.
      $result .= $this->_writeFieldsInfoWith ('name', ' var $', ' = null;'."\n", '', $usingFields);

      if ($this->_userDAORecord !== null){

//--constructor.
         $result .= ' function '.$this->_compiledDAORecordClassName.' () {'."\n";
         $result .= '  require_once (\''.$this->_userDAOPath.'\');'."\n";
         $result .= '  $this->_userDAORecord = & new '.$this->_DAORecordClassName.';'."\n";
         $result .= '  $this->_userDAORecord->_compiled = & $this;'."\n";
         if ($syncUserVarsNeeded){
            $result .= '  $this->_synchronizeFromUserDAORecordProperties ();'."\n";
         }
         $result .= ' }'."\n";

//--mapping for every user's DAORecord function.
         foreach ($classMethods as $name){
            $result .= ' function '.$name.' () {'."\n";
            if ($syncUserVarsNeeded){
               $result .= '   $this->_synchronizeToUserDAORecordProperties ();'."\n";
            }
            $result .= '   $args = func_get_args();'."\n";
            $result .= '   $toReturn = call_user_func_array(array(&$this->_userDAORecord, \''.$name.'\'), $args);'."\n";
            if ($syncUserVarsNeeded){
               $result .= '   $this->_synchronizeFromUserDAORecordProperties ();'."\n";
            }
            $result .= '   return $toReturn;'."\n";
            $result .= ' }'."\n";
         }

//--Synchronization functions
         //check if we need a sync process with the user's DAO
         if ($syncUserVarsNeeded) {
            $result .= ' function _synchronizeFromUserDAORecordProperties (){'."\n";
            foreach ($classVars as $name=>$defaultValue) {
               $result .= '  $this->'.$name.' = $this->_userDAORecord->'.$name.';'."\n";
            }
            $result .= ' }'."\n";

            $result .= ' function _synchronizeToUserDAORecordProperties (){'."\n";
            foreach ($classVars as $name=>$defaultValue) {
               $result .= '  $this->_userDAORecord->'.$name.' = $this->'.$name.';'."\n";
            }
            $result .= ' }'."\n";
         }

      }

//--method check.
      $methodName = in_array ('check', $classMethods) ? '_compiled_check' : 'check';
      $result .= ' function '.$methodName.' (){'."\n";
      $result .= '  $errorObject = new CopixErrorObject ();'."\n";
      foreach ($this->_userDefinition->_properties as $id=>$field){
         //if required, add the test.
         if ($field->required && $field->type != 'autoincrement'){
            $result .= '  if (strlen ($this->'.$field->name.') <= 0){'."\n";
            $result .= '    $errorObject->addError (\''.$field->name.'\', CopixI18N::get (\'copix:dao.errors.required\',';
            if ($field->captionI18N !== null){
              $result.= 'CopixI18N::get (\''.$field->captionI18N.'\')';
            }else{
              $result.= '\''.$field->caption.'\'';
            }
            $result .= "));\n  }\n";
         }
         //if a regexp is given, check it....
         if ($field->regExp !== null){
            $result .= '  if (strlen ($this->'.$field->name.') > 0){'."\n";
            $result .= '   if (preg_match (\''.$field->regExp.'\', $this->'.$field->name.') === 0){'."\n";
            $result .= '      $errorObject->addError (\''.$field->name.'\', CopixI18N::get (\'copix:dao.errors.format\',';
            if ($field->captionI18N !== null){
              $result.= 'CopixI18N::get (\''.$field->captionI18N.'\')';
            }else{
              $result.= '\''.$field->caption.'\'';
            }
            $result .=  "));\n  }\n";
            $result .= '  }'."\n";
         }
      }
      $result .= '  return $errorObject->isError () ? $errorObject->asArray () : true;'."\n";
      $result .= " }\n}\n";
      return $result;
   }

   /**
   * compile the DAO classe
   */
   function & compileDAO (){

      $result = 'require_once (COPIX_DB_PATH . \'CopixDbWidget.class.php\');'."\n";
      $result .= "\nclass ".$this->_compiledDAOClassName." { \n";
      $result .='   var $_table=\''.$this->_userDefinition->getTableName().'\';'."\n";

      if($this->_userDefinition->_connectionName =='')
         $result .='   var $_connectionName=null;'."\n";
      else
         $result .='   var $_connectionName=\''.$this->_userDefinition->_connectionName.'\';'."\n";

      if ($this->_userDAO !== null){
         $result .= ' var $_userDAO;'."\n";

    //Base elements for the DAO
         //adds definition for every user's DAO properties.
         $result .= '//Vars defined in User\s DAO'."\n";
         $syncUserVarsNeeded = false;
         foreach (get_class_vars ($this->_DAOClassName) as $name=>$default){
            $syncUserVarsNeeded = true;
            $result .= ' var $'.$name.';'."\n";
         }
         $result .= "//--\n";

         $result .= ' function '.$this->_compiledDAOClassName.' () {'."\n";
         $result .= '  require_once (\''.$this->_userDAOPath.'\');'."\n";
         $result .= '  $this->_userDAO = & new '.$this->_DAOClassName.';'."\n";
         if ($syncUserVarsNeeded){
            $result .= '  $this->_synchronizeFromUserDAOProperties ();'."\n";
         }
         $result .= " }\n";

         //adds mapping for every user's DAO function.
         foreach ($classMethods = (array) get_class_methods ($this->_DAOClassName) as $name){
            $result .= ' function '.$name.' () {'."\n";
            if ($syncUserVarsNeeded){
               $result .= '   $this->_synchronizeToUserDAOProperties ();'."\n";
            }
            $result .= '   $args = func_get_args();'."\n";
            $result .= '   $toReturn = call_user_func_array(array(&$this->_userDAO, \''.$name.'\'), $args);'."\n";
            if ($syncUserVarsNeeded){
               $result .= '   $this->_synchronizeFromUserDAOProperties ();'."\n";
            }
            $result .= '   return $toReturn;'."\n";
            $result .= " }\n";
         }
         
         //check if we need a sync process with
         if ($syncUserVarsNeeded) {
            $result .= ' function _synchronizeFromUserDAOProperties (){'."\n";
            foreach (get_class_vars ($this->_DAOClassName ) as $name=>$defaultValue) {
               $result .= '  $this->'.$name.' = $this->_userDAO->'.$name.';'."\n";
            }
            $result .= " }\n";

            $result .= ' function _synchronizeToUserDAOProperties (){'."\n";
            foreach (get_class_vars ($this->_DAOClassName) as $name=>$defaultValue) {
               $result .= '  $this->_userDAO->'.$name.' = $this->'.$name.';'."\n";
            }
            $result .= " }\n";
         }
      }else{
         $classMethods = array ();
      }

// prepare some values to generate methods
       // generate part of sql queries about foreign table
      list( $sqlFkTables, $sqlFkCondition, $sqlFkFields) = $this->_buildFKInfosForSelect();
      $connectionName = ($this->_userDefinition->_connectionName ==''?'':'\''. $this->_userDefinition->_connectionName.'\'');

//Selection, findAll.
      $methodName = in_array ('findall', $classMethods) ? '_compiled_findAll' : 'findAll';
      $result .= ' function '.$methodName.' (){'."\n";
      $result .= '    $query = \'select '.$this->_writeFieldNamesListForSelect ($this->_userDefinition->getTableName ().'.');

      $result .= $sqlFkFields;
      $result .= ' from '.$this->_userDefinition->getTableName ().$sqlFkTables.' '.
                  ($sqlFkCondition!=''?' where '.$sqlFkCondition:'').'\';'."\n";
      $result .= '    $dbWidget = & CopixDBFactory::getDbWidget ('.$connectionName.');'."\n";
      $result .= '    return $dbWidget->fetchAllUsing ($query, \''.$this->_compiledDAORecordClassName.'\');'."\n";
      $result .= ' }'."\n";

//Selection, get.
      $methodName = in_array ('get', $classMethods) ? '_compiled_get' : 'get';
      $result .= ' function '.$methodName.' ('.$this->_writeFieldNamesWith ('$', '', ',', $this->_getPKFields ()).'){'."\n";
      $result .= '    $ct = & CopixDBFactory::getConnection ('.$connectionName.');'."\n"; // obligé pour les $ct->quote
      $result .= '    $query = \'select '
                  .$this->_writeFieldNamesListForSelect ($this->_userDefinition->getTableName ().'.')
                  .$sqlFkFields.' from '.$this->_userDefinition->getTableName ().$sqlFkTables;

      //condition on the PK
      $sqlCondition = $this->_buildPKCondition('', $this->_userDefinition->getTableName ().'.');

      if($sqlFkCondition != ''){
         $sqlCondition.=($sqlCondition == '' ? '' : ' and ').$sqlFkCondition;
      }

      if($sqlCondition != ''){
         $result.=' where '.$sqlCondition;
      }

      $result .= '\';'."\n";// ends the query
      $result .= '    require_once (COPIX_DB_PATH . \'CopixDbWidget.class.php\');';
      $result .= '    $dbWidget = & new CopixDbWidget ($ct);'."\n";
      $result .= '    return $dbWidget->fetchFirstUsing ($query, \''.$this->_compiledDAORecordClassName.'\');'."\n";
      $result .= ' }'."\n";

//Insertion.
      $methodName = in_array ('insert', $classMethods) ? '_compiled_insert' : 'insert';
      $result .= ' function '.$methodName.' (& $object){'."\n";
      $result .= '    $ct = & CopixDBFactory::getConnection ('.$connectionName.');'."\n";
      $result .= '    $query = \'INSERT INTO '.$this->_userDefinition->getTableName ().' (';

      list($fields, $values)=$this->_prepareValues($this->_getFieldsExcludeTypes(array ('autoincrement')),'insertMotif', 'object->');

      $result .= implode(',',$fields);
      $result .= ') VALUES (';
      $result .= implode(', ',$values);
      $result .= ')\';'."\n";

      $result .= '   $toReturn = $ct->doQuery ($query);'."\n";
      $result .= '   if($toReturn){'."\n";

      $pkai = $this->_getAutoIncrementField();
      if($pkai !== null){
         if($pkai->sequenceName == '')
            $result .= '      $object->'.$pkai->name.'= $ct->lastId();'."\n";
         else
            $result .= '     $object->'.$pkai->name.'= $ct->lastId(\''.$pkai->sequenceName.'\');'."\n";
      }

      $result .= '    return $toReturn;'."\n      }else return false; \n   }\n";//ends insert function

//mise à jour.
      $methodName = in_array ('update', $classMethods) ? '_compiled_update' : 'update';
      $result .= ' function '.$methodName.' ($object){'."\n";
      $result .= '    $ct = & CopixDBFactory::getConnection ('.$connectionName.');'."\n";
      $result .= '    $query = \'UPDATE '.$this->_userDefinition->getTableName ().' SET ';

      list($fields, $values)=$this->_prepareValues($this->_getFieldsExcludePK(),'updateMotif', 'object->');

      $sqlSet='';
      foreach($fields as $k=> $fname){
         $sqlSet.= ', '.$fname. '= '. $values[$k];
      }
      $result.=substr($sqlSet,1);

      //condition on the PK
      $sqlCondition = $this->_buildPKCondition('object->');
      if($sqlCondition!='')
         $result .= ' where '.$sqlCondition;

      $result .= '\';'."\n";

      $result .= '   return $ct->doQuery ($query);'."\n";
      $result .= ' }'."\n";//ends the update function

//supression.
      $methodName = in_array ('delete', $classMethods) ? '_compiled_delete' : 'delete';
      $result .= ' function '.$methodName.' ('.$this->_writeFieldNamesWith ('$', '', ',', $this->_getPKFields ()).'){'."\n";
      $result .= '    $ct = & CopixDBFactory::getConnection ('.$connectionName.');'."\n";
      $result .= '    $query = \'DELETE FROM '.$this->_userDefinition->getTableName ().' where ';
      $result .= $this->_buildPKCondition();
      $result .= '\';'."\n";//ends the query
      $result .= '   return $ct->doQuery ($query);'."\n";
      $result .= ' }'."\n";//ends delete function

//recherche.
      $methodName = in_array ('findby', $classMethods) ? '_compiled_findBy' : 'findBy';
      $result .= ' function '.$methodName.' ($searchParams){'."\n";
      $result .= '    $ct = & CopixDBFactory::getConnection ('.$connectionName.');'."\n";
      $result .= '    $query = \'select '.$this->_writeFieldNamesListForSelect ($this->_userDefinition->getTableName ().'.');
      $result .= $sqlFkFields;
      $result .= ' from '.$this->_userDefinition->getTableName ().$sqlFkTables.' '.($sqlFkCondition!=''?' where '.$sqlFkCondition:'').'\';'."\n";

      //les conditions du By de la méthode findBy.
      $result .= '    if (!$searchParams->isEmpty ()){'."\n";
      $result .= '       $query .= \''.($sqlFkCondition!='' ? ' AND ' : ' WHERE ').'\';'."\n";
      $result .= '    }'."\n";

      //génération des paramètres de la méthode explain
      $fieldsType        = array();
      $fieldsTranslation = array();

      foreach ($this->_userDefinition->_properties as $name=>$field){
         $fieldsTranslation[]='\''.$field->name.'\'=>\''.$field->fieldName.'\'';
         $fieldsType[]='\''.$field->name.'\'=>\''.$field->type.'\'';
      }
      $fieldsTranslation = '         array('.implode(', ',$fieldsTranslation).')';
      $fieldsType        = '         array('.implode(', ',$fieldsType).')';

      //fin de la requete
      $result .= '    $query .= $searchParams->explainSQL ('."\n".$fieldsTranslation.",\n".$fieldsType.','."\n".'             $ct, \''.$this->_userDefinition->getTableName ().'\');'."\n";
      $result .= '    require_once (COPIX_DB_PATH . \'CopixDbWidget.class.php\');'."\n";
      $result .= '    $dbWidget = & new CopixDBWidget ($ct);'."\n";
      $result .= '    return $dbWidget->fetchAllUsing ($query, \''.$this->_compiledDAORecordClassName.'\');'."\n";
      $result .= ' }'."\n";

      $result .= '}'."\n";//end of class
      return $result;
   }

   /**
   * format field names with start, end and between strings.
   *   will write the field named info.
   *   eg info == name
   *   echo $field->name
   * @param string   $info    property to get from objects in $using
   * @param string   $start   string to add before the info
   * @param string   $end     string to add after the info
   * @param string   $beetween string to add between each info
   * @param array    $using     list of CopixFieldForDAO object. if null, get default fields list
   * @see  CopixFieldForDAO
   */
   function _writeFieldsInfoWith ($info, $start = '', $end='', $beetween = '', $using = null){
      $result = array();
      if ($using === null){
         //if no fields are provided, using _userDefinition's as default.
         $using = $this->_userDefinition->getFields ();
      }

      foreach ($using as $id=>$field){
         $result[] = $start . $field->$info . $end;
      }
      return implode($beetween,$result);;
   }

   /**
   * format field names with start, end and between strings.
   */
   function _writeFieldNamesWith ($start = '', $end='', $beetween = '', $using = null){
      return $this->_writeFieldsInfoWith ('name', $start, $end, $beetween, $using);
   }


   function _writeFieldNamesListForSelect ($start, $using = null){
      $result = array();
      if ($using === null){
         //if no fields are provided, using _userDefinition's as default.
         $using = $this->_userDefinition->getFields ();
      }

      foreach ($using as $id=>$field){
         if($field->selectMotif !=''){
            $str=sprintf($field->selectMotif, $start.$field->fieldName);

            if($field->fieldName != $field->name)
               $result[]= $str.' as '.$field->name;
            else
               $result[]= $str;
         }
      }

      return implode(', ',$result);
   }

   /**
   * replaces field names with
   */
   function _replaceFieldNames ($formatIt, $using = null){
      $result = '';
      if ($using === null){
         //if no fields are provided, using _userDefinition's as default.
         $using = $this->_userDefinition->getFields ();
      }
      foreach ($using as $id=>$field){
         $result .= str_replace ('[FIELDNAME]', $field->name, $formatIt);
      }
      return $result;
   }

   /**
    * get autoincrement PK field
    *
    */
   function _getAutoIncrementField ($using = null){
      $result = array ();
      if ($using === null){
         //if no fields are provided, using _userDefinition's as default.
         $using = $this->_userDefinition->getFields ();
      }
      foreach ($using as $id=>$field){
         if ($field->type == 'autoincrement'){
            return $field;
         }
      }
      return null;
   }


   /**
   * gets fields that belongs to the PK
   */
   function _getPKFields ($using = null){
      $result = array ();
      if ($using === null){
         //if no fields are provided, using _userDefinition's as default.
         $using = $this->_userDefinition->getFields ();
      }
      foreach ($using as $id=>$field){
         if ($field->isPK){
            $result[$field->name] = $field;
         }
      }
      return $result;
   }

   /**
   * gets fields that do not belong to given types
   */
   function _getFieldsExcludeTypes ($types){
      $result = array ();
      $using = $this->_userDefinition->getFields ();
      foreach ($using as $id=>$field){
         if (!in_array ($field->type, $types)){
            $result[$field->name] = $field;
         }
      }
      return $result;
   }


   /**
   * gets fields that isn't primary keys
   */
   function _getFieldsExcludePK (){
      $result = array ();
      $using = $this->_userDefinition->getFields ();
      foreach ($using as $id=>$field){
         if (!$field->isPK){
            $result[$field->name] = $field;
         }
      }
      return $result;
   }


   /**
   * gets the FK infos, returns an array ('FIELDS'=>, 'TABLES', 'CONDITIONS')
   */
   function _getFKInfos (){
      $toReturn = array ('Tables'    =>array (),
                         'Fields'    =>array (),
                         'Conditions'=>array ());

      foreach ($this->_userDefinition->getFields () as $id=>$field){
         if ($field->fkTable !== null){
            //if not already in the fkTables list, adds the fkTable
            if (! in_array ($field->fkTable, $toReturn['Tables'])){
               $toReturn['Tables'][] = $field->fkTable;
               $toReturn['Fields'][$field->fkTable]=array();
            }
            //adds the fields to select for the given fkTable
            //to produce select fkTableName.fieldName
            $toReturn['Fields'][$field->fkTable]       = array_merge ($field->fkFields, $toReturn['Fields'][$field->fkTable]);
            //to produce where fkTableName.fieldName=fieldName
            $toReturn['Conditions'][$field->fkTable][] = $field->fieldName;
         }
      }
      return $toReturn;
   }

   /**
    * build parts of SQL query to do a join with foreign table
    */
  function _buildFKInfosForSelect(){

      //gets the foreign keys.
      $fkInfos      = $this->_getFKInfos ();
      $fkTables     = & $fkInfos['Tables'];
      $fkConditions = & $fkInfos['Conditions'];
      $fkFields     = & $fkInfos['Fields'];

      //creates SQL Strings for the table names
      $sqlTables = implode(', ',$fkTables);
      if($sqlTables != '')
         $sqlTables=', '.$sqlTables;

      //creates SQL strings for the fields to select
      $sqlFields = '';
      foreach ($fkFields as $tableName=>$fields){
         foreach($fields as $field){
            $sqlFields.=', '.$tableName.'.'.$field;
         }
      }

      //creates SQL strings for FK conditions.
      $first = true;
      $sqlCondition = '';
      foreach ($fkConditions as $tableName=>$fields){
         foreach ($fields as $fieldName){
            if (!$first){
               $sqlCondition .= ' AND ';
            }/*else{
               $sqlCondition .= ' where ';
            }  */
            $sqlCondition.= ' '.$tableName.'.'.$fieldName.'='.$this->_userDefinition->getTableName ().'.'.$fieldName.' ';
            $first = false;
         }
      }

      return array($sqlTables, $sqlCondition, $sqlFields);
  }


  /**
   * build where clause
   * @param array $fieldList  list of CopixFieldForDAO objects
   * @param array $prefixFieldName the prefix you wants to have (eg table name) before the field in the where clause
   *    eg where [prefixFieldName][fieldName] = [prefixField][fieldName]
   */
  function _buildPKCondition($prefixfield='', $prefixFieldName=''){

      list($fields, $values)=$this->_prepareValues($this->_getPKFields (), '', $prefixfield);
      $result='';
      foreach($fields as $name =>$fieldname){
          $values[$name] = $prefixFieldName.$fieldname.' = '. $values[$name];
      }

      return implode(' and ', $values);
  }


  function _prepareValues($fieldList, $motif='', $prefixfield=''){
      $values = $fields = array();
      $first = true;
      foreach ($fieldList as $fieldName=>$field){
         if($motif != '' && $field->$motif == '')
            continue;

         switch(strtolower($field->type)){
            case 'int':
            case 'integer':
            case 'autoincrement':
               $value=' intval($'.$prefixfield.$fieldName.')';
               break;
            case 'double':
            case 'float':
               $value=' doubleval($'.$prefixfield.$fieldName.')';
               break;

            case 'numeric'://usefull for bigint and stuff
               $value=' (is_numeric ($'.$prefixfield.$fieldName.') ? $'.$prefixfield.$fieldName.' : intval($'.$prefixfield.$fieldName.')) ';
               break;

            default:
               if($field->required){
                  $value=' $ct->quote ($'.$prefixfield.$fieldName.',false)';
               }else{
                  $value=' $ct->quote ($'.$prefixfield.$fieldName.')';
               }
         }

         if($motif != ''){
            $values[$field->name]=sprintf($field->$motif,'\'.'.$value.'.\'');
         } else {
            $values[$field->name]='\'.'.$value.'.\'';
         }

         $fields[$field->name]=$field->fieldName;
      }
      return array($fields, $values);
  }
}
?>
