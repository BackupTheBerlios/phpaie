<?php
/**
* @package	copix
* @subpackage copixdao
* @version	$Id: CopixDAODefinitionV1.class.php,v 1.1 2004/07/25 22:12:59 j-charles Exp $
* @author	Croes Gérald , Jouanneau Laurent
*           see copix.aston.fr for other contributors.
* @copyright 2001-2004 Aston S.A.
* @link		http://copix.aston.fr
* @licence  http://www.gnu.org/licenses/gpl.html GNU General Public Licence, see LICENCE file
*/
/**
 * Analyseur des fichiers XML de définition DAO, de la syntaxe daodefinition version 1 finale
 */
class CopixDAODefinitionV1 {
   /**
   * the properties list.
   * keys = field code name
   * values = CopixPropertyForDAO object
   */
   var $_properties = array ();

   /**
   * all tables with their properties, and their own fields
   * keys = table code name
   * values = array()
   *              'name'=> table code name, 'tablename'=>'real table name', 'JOIN'=>'join type',
   *              'primary'=>'bool', 'fields'=>array(list of field code name)
   */
   var $_tables=array();

   /**
    * primary table code name
    */
   var $_primaryTable='';

   /**
    * liste des jointures, entre toutes les tables
    * keys = foreign table name
    * values = array('join'=>'type jointure', 'pfield'=>'real field name', 'ffield'=>'real field name');
    */
   var $_joins=array();

   /**
    * the connection name to use.
    * null if you wants to use the default connection
    */
   var $_connectionName = null;

   var $_methods=array();


   function CopixDAODefinitionV1(& $compiler){
      $this->_compiler= & $compiler;
   }



   /**
   * loads an XML file if given.
   */
   function loadFrom( & $parsedFile){

      // -- tables
      if(isset($parsedFile->DATASOURCE) && isset($parsedFile->DATASOURCE->TABLES) &&
         isset($parsedFile->DATASOURCE->TABLES->TABLE)){

         if(!is_array($parsedFile->DATASOURCE->TABLES->TABLE)){
            $this->addTable($parsedFile->DATASOURCE->TABLES->TABLE->attributes());
         }else{
            foreach($parsedFile->DATASOURCE->TABLES->TABLE as $table){
               $this->addTable($table->attributes());
            }
         }
      }else{
         $this->_compiler->doDefError('copix:dao.error.definitionfile.table.missing');
      }

      if($this->_primaryTable == '')
          $this->_compiler->doDefError('copix:dao.error.definitionfile.table.primary.missing');

      // -- connection
      if (isset ($parsedFile->DATASOURCE->CONNECTION)){
         $connection = $parsedFile->DATASOURCE->CONNECTION->attributes ();
         if (isset ($connection['NAME'])){
            $this->_connectionName = $connection ['NAME'];
         }
      }

      //adds the properties
      if(isset($parsedFile->PROPERTIES) && isset($parsedFile->PROPERTIES->PROPERTY)){
         if(is_array($parsedFile->PROPERTIES->PROPERTY)){
            foreach ($parsedFile->PROPERTIES->PROPERTY as $field){
               $this->addProperty (new CopixPropertyForDAO ($field->attributes(), $this));
            }
         }else{
            $this->addProperty (new CopixPropertyForDAO ($parsedFile->PROPERTIES->PROPERTY->attributes(), $this));
         }
      }else
          $this->_compiler->doDefError('copix:dao.error.definitionfile.properties.missing');


      // get additionnal methods definition

      if(isset($parsedFile->METHODS) && isset($parsedFile->METHODS->METHOD)){
         if(is_array($parsedFile->METHODS->METHOD)){
            $kcnt= count($parsedFile->METHODS->METHOD);
            for($k=0; $k < $kcnt; $k++){
              $this->addMethod (new CopixMethodForDAO ($parsedFile->METHODS->METHOD[$k], $this));
            }
         }else{
            $this->addMethod (new CopixMethodForDAO ($parsedFile->METHODS->METHOD, $this));
         }
      }
   }

   /**
   * adds a field to the list.
   */
   function addProperty ($field){
      $this->_properties[$field->name] = $field;
      $this->_tables[$field->table]['FIELDS'][]=$field->name;
      if($field->fkTable !== null){
         if(!isset($this->_joins[$field->fkTable]))
            $this->_compiler->doDefError('copix:dao.error.definitionfile.properties.foreign.table.missing', $field->name);
         $this->_joins[$field->fkTable]['pfield']=$field->fieldName;
         $this->_joins[$field->fkTable]['ffield']=$field->fkFieldName;
      }
   }


   function getProperties (){
      return $this->_properties;
   }

   function addTable($tableinfos){
      if (!isset ($tableinfos['NAME']) ||trim($tableinfos['NAME']) == '' )
         $this->_compiler->doDefError('copix:dao.error.definitionfile.table.name');

      if(!isset($tableinfos['TABLENAME']) || $tableinfos['TABLENAME'] == '')
         $tableinfos['TABLENAME']=$tableinfos['NAME'];

      $tableinfos['FIELDS']=array();
      $this->_tables[$tableinfos['NAME']]=$tableinfos;

      if(isset($tableinfos['PRIMARY']) && $this->_getBool($tableinfos['PRIMARY'])){
         if($this->_primaryTable != '')
            $this->_compiler->doDefError('copix:dao.error.definitionfile.table.primary.duplicate',$this->_primaryTable);

         $this->_primaryTable=$tableinfos['NAME'];
      }else{
         $join=isset($tableinfos['JOIN']) ? strtolower(trim($tableinfos['JOIN'])) : '';
         if(!in_array($join, array('left','right','inner','')))
            $this->_compiler->doDefError('copix:dao.error.definitionfile.table.join.invalid',$tableinfos['NAME']);

         if($join == 'inner') $join='';

         $this->_joins[$tableinfos['NAME']]=array('join'=>$join, 'pfield'=>'', 'ffield'=>'');
      }

      return true;
   }

   function getTables(){
      return $this->_tables;

   }

   function addMethod(&$method){
      if(isset( $this->_methods[$method->name]))
         $this->_compiler->doDefError('copix:dao.error.definitionfile.method.duplicate',$method->name);
      $this->_methods[$method->name] = $method;

   }
  /**
   * just a quick way to retriveve boolean values from a string.
   *  will accept yes, true, 1 as "true" values
   *  the rest will be considered as false values.
   * @return boolean true / false
   */
   function _getBool ($value){
      return in_array (trim ($value), array ('true', '1', 'yes'));
   }



}




class CopixPropertyForDAO {
   /**
   * the name of the property of the object
   */
   var $name='';

   /**
   * the name of the field in table
   */
   var $fieldName='';

   /**
   * give the regular expression that needs to be matched against.
   */
   var $regExp=null;
   /**
   * says if the field is required.
   */
   var $required=false;
   /**
   * The i18n key for the caption of the element.
   */
   var $captionI18N=null;
   var $caption=null;
   /**
   * Is it a string ?
   */
   var $isString=true;
   /**
   * Says if it's a primary key.
   */
   var $isPK=false;
   var $isFK=false;

   var $table=null;
   var $updateMotif='%s';
   var $insertMotif='%s';
   var $selectMotif='%s';

   var $fkTable=null;
   var $fkFieldName=null;
    var $sequenceName='';

   /**
   * constructor.
   */
   function CopixPropertyForDAO ($params, & $def){
      if (!isset ($params['NAME'])){
         $def->_compiler->doDefError('copix:dao.error.definitionfile.missing.attr', array('name', 'property'));
      }
      $this->name       = $params['NAME'];
      $this->fieldName  = isset ($params['FIELDNAME']) ? $params['FIELDNAME'] : $this->name;
      $this->table      = isset ($params['TABLE']) ? $params['TABLE'] : $def->_primaryTable;

      if(!isset( $def->_tables[$this->table]))
         $def->_compiler->doDefError('copix:dao.error.definitionfile.property.unknow.table', $this->name);

      $this->required   = isset ($params['REQUIRED']) ? $this->_getBool ($params['REQUIRED']) : false;
      if(isset ($params['REGEXP'])){
         if(trim($params['REGEXP']) != ''){
            $this->regExp     = $params['REGEXP'];
            $this->required = true;
         }
      }

      $this->captionI18N = isset ($params['CAPTIONI18N']) ? $params['CAPTIONI18N'] : null;
      $this->caption     = isset ($params['CAPTION']) ? $params['CAPTION'] : null;
      if ($this->caption == null && $this->captionI18N == null){
         //trigger_error (CopixI18N::get('copix:dao.error.definitionfile.missing.attr.caption',$def->_shortFileName),E_USER_ERROR);
         $this->caption=$this->name;
      }

      $this->isPK       = isset ($params['PK']) ? $this->_getBool ($params['PK']): false;
      if (!isset ($params['TYPE'])){
         $def->_compiler->doDefError('copix:dao.error.definitionfile.missing.attr', array('type', 'field'));
      }
      $this->needsQuotes = $this->_typeNeedsQuotes ($params['TYPE']);
      $this->type = strtolower($params['TYPE']);

      if($this->table == $def->_primaryTable){ // on ignore les champs fktable et fkfieldName pour les propriétés qui n'appartiennent pas à la table principale
         $this->fkTable = isset ($params['FKTABLE']) ? $params['FKTABLE'] : null;
         $this->fkFieldName = isset ($params['FKFIELDNAME']) ? $params['FKFIELDNAME'] : '';
         if($this->fkTable !== null){
            if($this->fkFieldName == '')
               $def->_compiler->doDefError('copix:dao.error.definitionfile.property.foreign.field.missing', array($this->name));
         }
      }
      $this->isFK =  $this->fkTable !== null;
      if($this->type == 'autoincrement' && isset ($params['SEQUENCE'])){
         $this->sequenceName = $params['SEQUENCE'];
      }
      // on ignore les attributs *motif sur les champs PK et FK
      // (je ne sais plus pourquoi mais il y avait une bonne raison...)
      if(!$this->isPK && !$this->isFK){
         $this->updateMotif= isset($params['UPDATEMOTIF']) ? $params['UPDATEMOTIF'] :'%s';
         $this->insertMotif= isset($params['INSERTMOTIF']) ? $params['INSERTMOTIF'] :'%s';
         $this->selectMotif= isset($params['SELECTMOTIF']) ? $params['SELECTMOTIF'] :'%s';
      }

      // pas de motif update et insert pour les champs des tables externes
      if($this->table != $def->_primaryTable){
         $this->updateMotif='';
         $this->insertMotif='';
         $this->required = false;
         $this->ofPrimaryTable=false;
      }else
         $this->ofPrimaryTable=true;
   }

   /**
   * just a quick way to retriveve boolean values from a string.
   *  will accept yes, true, 1 as "true" values
   *  the rest will be considered as false values.
   * @return boolean true / false
   */
   function _getBool ($value){
      return in_array (trim ($value), array ('true', '1', 'yes'));
   }

   /**
   * says if the data type needs to be quoted while being SQL processed
   */
   function _typeNeedsQuotes ($typeName){
      return in_array (trim ($typeName), array ('string', 'date', 'varchardate'));
   }
}






class CopixMethodForDAO{
   var $name;
   var $type;
   var $_searchParams=null;
   var $_parameters=array();

   function CopixMethodForDAO(&$method, &$def){
      $this->def = &$def;
      if (!isset ($method->__attributes['NAME'])){
         $def->_compiler->doDefError('copix:dao.error.definitionfile.missing.attr', array('name', 'method'));
      }

      $this->name       = $method->__attributes['NAME'];
      $this->type  = isset ($method->__attributes['TYPE']) ? strtolower($method->__attributes['TYPE']) : 'select';

      if (isset ($method->PARAMETERS) && isset ($method->PARAMETERS->PARAMETER)){
         if(!is_array($method->PARAMETERS->PARAMETER)){
            $this->addParameter($method->PARAMETERS->PARAMETER->attributes(), $def);
         }else{
            foreach($method->PARAMETERS->PARAMETER as $param){
               $this->addParameter($param->attributes(), $def);
            }
         }
      }


      if (isset ($method->CONDITIONS)){
         if(isset($method->CONDITIONS->__attributes['LOGIC']))
            $kind=$method->CONDITIONS->__attributes['LOGIC'];
         else $kind='AND';

         $this->_searchParams = new CopixDAOSearchConditions($kind, true);
         $this->_parseConditions($method,true);

      }
      if (isset($method->ORDER) && isset($method->ORDER->ORDERITEM)){
         if(is_array($method->ORDER->ORDERITEM)){
            foreach($method->ORDER->ORDERITEM as $item)
               $this->addOrder($item->attributes(), $def);
         }else{
             $this->addOrder($method->ORDER->ORDERITEM->attributes(), $def);
         }

      }
   }

   function _parseConditions(&$node, $first=false){

      if (isset ($node->CONDITIONS)){

         if(!$first){
            if(isset($node->CONDITIONS->__attributes['LOGIC']))
               $kind=$node->CONDITIONS->__attributes['LOGIC'];
            else $kind='AND';

            $this->_searchParams->startGroup($kind);
         }


         if(!is_array($node->CONDITIONS)){
            if(isset($node->CONDITIONS->CONDITION)){
                $this->addCondition($node->CONDITIONS->CONDITION);
            }
         }else{
            foreach($node->CONDITIONS as $cond){
               if(isset($node->CONDITIONS->CONDITION))
                  $this->addCondition( $node->CONDITIONS->CONDITION);
            }
         }

         $this->_parseConditions($node->CONDITIONS);

         if(!$first){
            $this->_searchParams->endGroup();
         }

      }
   }

   function addCondition( &$node){
      if(!is_array($node)){
         $this->_addCondition($node->attributes());
      }else{
         foreach($node as $param){
            $this->_addCondition($param->attributes());
         }
      }
   }


   function _addCondition( $attributes){

      $field_id = (isset($attributes['PROPERTY']) ? $attributes['PROPERTY']:'');
      $operator = (isset($attributes['OPERATOR']) ? $attributes['OPERATOR']:'');
      $value =    (isset($attributes['VALUE']) ? $attributes['VALUE']:null);
      $valueparam = (isset($attributes['VALUEOFPARAM']) ? $attributes['VALUEOFPARAM']:null);

      if($value !== null){
         $this->_searchParams->addPHPCondition ($field_id, $operator, '\''.str_replace("'","\'",$value).'\'');
      }elseif($valueparam !== null){
         if(in_array($valueparam,$this->_parameters))
            $this->_searchParams->addPHPCondition ($field_id, $operator, '$'.$valueparam);
         else
            $def->_compiler->doDefError('copix:dao.error.definitionfile.method.parameter.unknow', array($this->name, $valueparam));
      }
   }


   function addParameter($attributes, &$def){
      if (!isset ($attributes['NAME'])){
         $def->_compiler->doDefError('copix:dao.error.definitionfile.method.parameter.unknowname', array($this->name));
      }
      $this->_parameters[]=$attributes['NAME'];
   }

   function addOrder($attr, &$def ){

      $prop = (isset($attr['PROPERTY'])?trim($attr['PROPERTY']):'');
      $way=(isset($attr['WAY'])?trim($attr['WAY']):'ASC');
      if($prop != ''){
         if(isset($def->_properties[$prop]))
            $this->_searchParams->addItemOrder($prop, $way);
         else
            $def->_compiler->doDefError('copix:dao.error.definitionfile.method.orderitem.bad', array($prop, $this->name));
      }else{
         $def->_compiler->doDefError('copix:dao.error.definitionfile.method.orderitem.bad', array($prop, $this->name));
      }
   }


}


?>
