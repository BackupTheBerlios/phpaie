<?php
/**
* @package	copix
* @subpackage copixdao
* @version	$Id: CopixDAOGeneratorV1.class.php,v 1.1 2004/07/25 22:12:59 j-charles Exp $
* @author	Croes Gérald , Jouanneau Laurent
*           see copix.aston.fr for other contributors.
* @copyright 2001-2004 Aston S.A.
* @link		http://copix.aston.fr
* @licence  http://www.gnu.org/licenses/gpl.html GNU General Public Licence, see LICENCE file
*/

require_once (COPIX_DAO_PATH.'CopixDAOGenerator.class.php');

class CopixDAOGeneratorV1 extends CopixDAOGenerator{

   /**
   * compile the single class
   */
   function & compileDAORecordClass () {
      //first, the name of ge class.
      $result  = "\nclass ".$this->_compiledDAORecordClassName." {\n";

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
      foreach ($this->_userDefinition->getProperties() as $id=>$field){
         if (!in_array ($field->name, $classVarsList)){
            $usingFields[$id] = $field;
         }
      }
      //declaration of properties.
      $result .= $this->_writeFieldsInfoWith ('name', ' var $', " = null;\n", '', $usingFields);

      if ($this->_userDAORecord !== null){
      
//--constructor.
         $result .= ' function '.$this->_compiledDAORecordClassName.' () {'."\n";
         $result .= '  require_once (\''.$this->_userDAOPath.'\');'."\n";
         $result .= '  $this->_userDAORecord = & new '.$this->_DAORecordClassName.';'."\n";
         $result .= '  $this->_userDAORecord->_compiled = & $this;'."\n";
         if ($syncUserVarsNeeded){
            $result .= '  $this->_synchronizeFromUserDAORecordProperties ();'."\n";
         }
         $result .= " }\n";

//--mapping for every user's DAORecord function.
         foreach ($classMethods as $name){
            $result .= ' function '.$name." () {\n";
            if ($syncUserVarsNeeded){
               $result .= '   $this->_synchronizeToUserDAORecordProperties ();'."\n";
            }
            $result .= '   $args = func_get_args();'."\n";
            $result .= '   $toReturn = call_user_func_array(array(&$this->_userDAORecord, \''.$name.'\'), $args);'."\n";
            if ($syncUserVarsNeeded){
               $result .= '   $this->_synchronizeFromUserDAORecordProperties ();'."\n";
            }
            $result .= '   return $toReturn;'."\n";
            $result .= " }\n";
         }

//--Synchronization functions
         //check if we need a sync process with the user's DAO
         if ($syncUserVarsNeeded) {
            $result .= ' function _synchronizeFromUserDAORecordProperties (){'."\n";
            foreach ($classVars as $name=>$defaultValue) {
               $result .= '  $this->'.$name.' = $this->_userDAORecord->'.$name.';'."\n";
            }
            $result .= " }\n";

            $result .= ' function _synchronizeToUserDAORecordProperties (){'."\n";
            foreach ($classVars as $name=>$defaultValue) {
               $result .= '  $this->_userDAORecord->'.$name.' = $this->'.$name.";\n";
            }
            $result .= " }\n";
         }

      }

//--method check.
      $methodName = in_array ('check', $classMethods) ? '_compiled_check' : 'check';
      $result .= ' function '.$methodName." (){\n";
      $result .= '  $errorObject = new CopixErrorObject ();'."\n";
      foreach ($this->_userDefinition->getProperties() as $id=>$field){
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
            $result .= "  }\n";
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
      $result .='   var $_table=\''.$this->_userDefinition->_tables[$this->_userDefinition->_primaryTable]['TABLENAME'].'\';'."\n";

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
            foreach (get_class_vars ($this->_DAOClassName) as $name=>$defaultValue) {
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
      list($fromClause, $whereClause)= $this->getFromClause(false);
      $sqlFromClause = $fromClause?(' FROM ' .$fromClause):'';
      $sqlWhereClause = $whereClause?(' WHERE ' .$whereClause):'';
      
      $simpleAccessTable = $this->_userDefinition->_tables[ $this->_userDefinition->_primaryTable]['TABLENAME'];
            
      $sqlSelectClause = $this->getSelectClause();
      $connectionName = ($this->_userDefinition->_connectionName ==''?'':'\''. $this->_userDefinition->_connectionName.'\'');

      $result .='   var $_selectQuery=\''.$sqlSelectClause.$sqlFromClause.$sqlWhereClause.'\';'."\n";

      $pkFields = $this->_getPropertiesBy('PkFields');

//Selection, findAll.
      $methodName = in_array ('findall', $classMethods) ? '_compiled_findAll' : 'findAll';
      $result .= ' function '.$methodName.' (){'."\n";
      $result .= '    $dbWidget = & CopixDBFactory::getDbWidget ('.$connectionName.');'."\n";
      $result .= '    return $dbWidget->fetchAllUsing ($this->_selectQuery, \''.$this->_compiledDAORecordClassName.'\');'."\n";
      $result .= " }\n";

//Selection, get.
      $methodName = in_array ('get', $classMethods) ? '_compiled_get' : 'get';
      $result .= ' function '.$methodName.' ('.$this->_writeFieldNamesWith ('$', '', ',', $pkFields).'){'."\n";
      $result .= '    $ct = & CopixDBFactory::getConnection ('.$connectionName.');'."\n"; // obligé pour les $ct->quote
      $result .= '    $query = $this->_selectQuery .\'';

      //condition on the PK
      $sqlCondition = $this->_buildConditions($pkFields);
      $glueCondition = ($sqlWhereClause !='' ? ' AND ':' WHERE ');

      if($sqlCondition != ''){
         $sqlCondition=($sqlCondition == '' ? '' : $glueCondition).$sqlCondition;
      }
      $result .=$sqlCondition;
      $result .= "';\n";// ends the query
      $result .= '    $dbWidget = & new CopixDbWidget ($ct);'."\n";
      $result .= '    return $dbWidget->fetchFirstUsing ($query, \''.$this->_compiledDAORecordClassName.'\');'."\n";
      $result .= " }\n";

//Insertion.
      $methodName = in_array ('insert', $classMethods) ? '_compiled_insert' : 'insert';
      $result .= ' function '.$methodName.' ($object){'."\n";
      $result .= '    $ct = & CopixDBFactory::getConnection ('.$connectionName.');'."\n";
//      $result .= '    $query = \'INSERT INTO '.$this->_userDefinition->_primaryTable.' (';
// La ligne ci-dessous provoque une erreur de MySql
//      $result .= '    $query = \'INSERT INTO '.$FromClause.' (';
// D'où :
//      $simpleAccessTable = $this->_userDefinition->_tables[ $this->_userDefinition->_primaryTable]['TABLENAME'];
      $result .= '    $query = \'INSERT INTO ' .$simpleAccessTable .' (';

      list($fields, $values) = $this->_prepareValues($this->_getPropertiesBy('PrimaryFieldsExcludeAutoIncrement'),'insertMotif', 'object->');

      $result .= implode(',',$fields);
      $result .= ') VALUES (';
      $result .= implode(', ',$values);
      $result .= ")';\n";

      $result .= '   $toReturn = $ct->doQuery ($query);'."\n";
      $result .= '   if($toReturn){'."\n";

      $pkai = $this->_getAutoIncrementField();
      if($pkai !== null){
         if($pkai->sequenceName == '')
            $result .= '     $object->'.$pkai->name.'= $ct->lastId();'."\n";
         else
            $result .= '     $object->'.$pkai->name.'= $ct->lastId(\''.$pkai->sequenceName.'\');'."\n";
      }

      $result .= '    return $toReturn;'."\n      }else return false; \n   }\n";//ends insert function

//mise à jour.
      $methodName = in_array ('update', $classMethods) ? '_compiled_update' : 'update';
      $result .= ' function '.$methodName.' ($object){'."\n";
      $result .= '    $ct = & CopixDBFactory::getConnection ('.$connectionName.');'."\n";
//      $result .= '    $query = \'UPDATE '.$this->_userDefinition->_primaryTable.' SET ';
      $result .= '    $query = \'UPDATE '.$simpleAccessTable .' SET ';

      list($fields, $values)=$this->_prepareValues($this->_getPropertiesBy('PrimaryFieldsExcludePk'),'updateMotif', 'object->');

      $sqlSet='';
      foreach($fields as $k=> $fname){
         $sqlSet.= ', '.$fname. '= '. $values[$k];
      }
      $result.=substr($sqlSet,1);

      //condition on the PK
      $sqlCondition = $this->_buildConditions($pkFields, 'object->', false);
      if($sqlCondition!='')
         $result .= ' WHERE '.$sqlCondition;

      $result .= "';\n";

      $result .= '   return $ct->doQuery ($query);'."\n";
      $result .= " }\n";//ends the update function

//supression.
      $methodName = in_array ('delete', $classMethods) ? '_compiled_delete' : 'delete';
      $result .= ' function '.$methodName.' ('.$this->_writeFieldNamesWith ('$', '', ',', $pkFields).'){'."\n";
      $result .= '    $ct = & CopixDBFactory::getConnection ('.$connectionName.');'."\n";
//      $result .= '    $query = \'DELETE FROM '.$this->_userDefinition->_primaryTable.' where ';
      $result .= '    $query = \'DELETE FROM ' .$simpleAccessTable. ' WHERE ';
      $result .= $this->_buildConditions($pkFields, '', false);
      $result .= "';\n";//ends the query
      $result .= '   return $ct->doQuery ($query);'."\n";
      $result .= " }\n";//ends delete function

//recherche.
      $methodName = in_array ('findby', $classMethods) ? '_compiled_findBy' : 'findBy';
      $result .= ' function '.$methodName.' ($searchParams){'."\n";
      $result .= '    $ct = & CopixDBFactory::getConnection ('.$connectionName.');'."\n";
      $result .= '    $query = $this->_selectQuery;'."\n";

      //les conditions du By de la méthode findBy.
      $result .= '    if (!$searchParams->isEmpty ()){'."\n";
      $result .= '       $query .= \''.($sqlWhereClause!='' ? ' AND ' : ' WHERE ').'\';'."\n";

      //génération des paramètres de la méthode explain
      $fieldsType        = array();
      $fieldsTranslation = array();

      foreach ($this->_userDefinition->_properties as $name=>$field){
         $fieldsTranslation[]='\''.$field->name.'\'=>array(\''.$field->fieldName.'\', \''.$field->type.'\',\''.$field->table.'\',\''.str_replace("'","\\'",$field->selectMotif).'\')';
      }
      $fieldsTranslation = '         array('.implode(', ',$fieldsTranslation).')';

      //fin de la requete
      $result .= '      $query .= $searchParams->explainSQL ('."\n".$fieldsTranslation.",\n".'                $ct );'."\n";
      $result .= "    }\n";
      $result .= '    $dbWidget = & new CopixDBWidget ($ct);'."\n";
      $result .= '    return $dbWidget->fetchAllUsing ($query, \''.$this->_compiledDAORecordClassName.'\');'."\n";
      $result .= " }\n";


// autres méthodes personnalisés
      $allField=array();
      foreach($this->_getPropertiesBy('All') as $field){
         $allField[$field->name]=array($field->fieldName, $field->type, $field->table, str_replace("'","\\'",$field->selectMotif));
      }
      $ct=null;
      foreach($this->_userDefinition->_methods as $name=>$method){
         $result .= ' function '.$method->name.' (';
         $mparam=implode(', $',$method->_parameters);
         if($mparam != '') $result.='$'.$mparam;
         $result .= "){\n";
         $result .= '    $ct = & CopixDBFactory::getConnection ('.$connectionName.');'."\n";
         $result .= '    $query = $this->_selectQuery';
         if($method->_searchParams !== null){
            $sqlCondition = trim($method->_searchParams->explainSQL($allField,$ct));
            $glueCondition = ($sqlWhereClause !='' ? ' AND ':' WHERE ');

            if(trim($sqlCondition) != ''){
               $sqlCondition=($sqlCondition == '' ? '' : $glueCondition).$sqlCondition;
               $result .= '.\''.$sqlCondition."';\n";
            }else
               $result.=";\n";
         }else
            $result.=";\n";
         $result .= '    $dbWidget = & new CopixDbWidget ($ct);'."\n";
         if($method->type == 'selectfirst')
            $result .= '    return $dbWidget->fetchFirstUsing ($query, \''.$this->_compiledDAORecordClassName.'\');'."\n";
         else
            $result .= '    return $dbWidget->fetchAllUsing ($query, \''.$this->_compiledDAORecordClassName.'\');'."\n";
         $result .= " }\n";
      }


      $result .= "}\n";//end of class
      return $result;
   }


   /**
    *  create FROM clause for all SELECT query
    * @return array  FROM string and WHERE string
    */
   function getFromClause($longAnswer = true){
      $ptable= $this->_userDefinition->_tables[ $this->_userDefinition->_primaryTable];

      if($ptable['NAME']!=$ptable['TABLENAME'])
         $sqlFrom =$ptable['TABLENAME'].' AS '.$ptable['NAME'];
      else
         $sqlFrom =$ptable['TABLENAME'];

      $sqlWhere='';

      foreach($this->_userDefinition->_joins as $tablename=>$join){
         if($tablename != $ptable['NAME']){

            $table= $this->_userDefinition->_tables[$tablename];
            if($table['NAME']!=$table['TABLENAME'])
               $sqltable =$table['TABLENAME'].' AS '.$table['NAME'];
            else
               $sqltable =$table['TABLENAME'];

            $fieldjoin=$ptable['NAME'].'.'.$join['pfield'].'='.$table['NAME'].'.'.$join['ffield'];

            if($join['join'] == 'left'){
               $sqlFrom.=' LEFT JOIN '.$sqltable.' ON ('.$fieldjoin.')';
            }elseif($join['join'] == 'right'){
               $sqlFrom.=' RIGHT JOIN '.$sqltable.' ON ('.$fieldjoin.')';
            }else{
               $sqlFrom.=', '.$sqltable;
               $sqlWhere.=' AND '.$fieldjoin;
            }
         }
      }

      if ($sqlWhere !='') 
         $sqlWhere = ($longAnswer?' WHERE ':'') .substr($sqlWhere,4);

      return array(($longAnswer?' FROM ':'').$sqlFrom,$sqlWhere);
   }

   /**
    * build SELECT clause for all SELECT queries
    */
   function getSelectClause(){
      $result = array();

      foreach ($this->_userDefinition->getProperties () as $id=>$prop){

         $table =$this->_userDefinition->_tables[$prop->table]['NAME'] .'.';

         if($prop->selectMotif !=''){

            if($prop->selectMotif =='%s'){
               if($prop->fieldName != $prop->name)
                  $result[]= $table.$prop->fieldName.' as '.$prop->name;
               else
                  $result[]= $table.$prop->fieldName;
            }else{
               $result[]= sprintf($prop->selectMotif, $table.$prop->fieldName).' as '.$prop->name;
            }
         }
      }

      return 'SELECT '.addslashes(implode(', ',$result));
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
   * @param array    $using     list of CopixPropertiesForDAO object. if null, get default fields list
   * @see  CopixPropertiesForDAO
   */
   function _writeFieldsInfoWith ($info, $start = '', $end='', $beetween = '', $using = null){
      $result = array();
      if ($using === null){
         //if no fields are provided, using _userDefinition's as default.
         $using = $this->_userDefinition->getProperties ();
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


   function _buildConditions(&$fields, $prefix='', $forSelect=true){
      require_once('CopixDAOSearchConditions.class.php');
      $searchParams = new CopixDAOSearchConditions('AND', true);
      $f=array();
      foreach($fields as $field){
         if($forSelect)
            $f[$field->name]=array($field->fieldName, $field->type, $field->table);
         else
            $f[$field->name]=array($field->fieldName, $field->type);
         $searchParams->addPHPCondition($field->name, '=', '$'.$prefix.$field->name);
      }
      $ct=null;
      return $searchParams->explainSQL($f,$ct);
   }


   /**
   * gets fields that match a condition returned by the $captureMethod
   */
   function _getPropertiesBy ($captureMethod){
      $captureMethod='_capture'.$captureMethod;
      $result = array ();
      foreach ($this->_userDefinition->_properties as $field){
         if ( $this->$captureMethod($field)){
            $result[$field->name] = $this->_userDefinition->_properties[$field->name];
         }
      }
      return $result;
   }

   function _capturePkFields(&$field){
      return ($field->table == $this->_userDefinition->_primaryTable) && $field->isPK;
   }

   function _capturePrimaryFieldsExcludeAutoIncrement(&$field){
      return ($field->table == $this->_userDefinition->_primaryTable) &&
         ($field->type != 'autoincrement');
   }

   function _capturePrimaryFieldsExcludePk(&$field){
      return ($field->table == $this->_userDefinition->_primaryTable) && !$field->isPK;
   }
   function _captureAll(&$field){
      return true;
   }

      /**
    * get autoincrement PK field
    *
    */
   function _getAutoIncrementField ($using = null){
      $result = array ();
      if ($using === null){
         //if no fields are provided, using _userDefinition's as default.
         $using = $this->_userDefinition->getProperties ();
      }
      foreach ($using as $id=>$field){
         if ($field->type == 'autoincrement'){
            return $field;
         }
      }
      return null;
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

         if($motif != '')
            $values[$field->name]=sprintf($field->$motif,'\'.'.$value.'.\'');
         else
            $values[$field->name]='\'.'.$value.'.\'';

         $fields[$field->name]=$field->fieldName;
      }
      return array($fields, $values);
  }
}

?>
