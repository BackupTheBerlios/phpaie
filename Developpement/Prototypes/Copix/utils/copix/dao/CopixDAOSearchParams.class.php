<?php
/**
* @package	copix
* @subpackage copixdao
* @version	$Id: CopixDAOSearchParams.class.php,v 1.1 2004/07/25 22:12:59 j-charles Exp $
* @author	Croes Gérald , Jouanneau Laurent
*           see copix.aston.fr for other contributors.
* @copyright 2001-2004 Aston S.A.
* @link		http://copix.aston.fr
* @licence  http://www.gnu.org/licenses/gpl.html GNU General Public Licence, see LICENCE file
*/

class CopixDAOSearchParamsCondition {
   /**
   * the parent group if any
   */
   var $parent = null;

   /**
   * the conditions in this group
   */
   var $conditions = array ();

   /**
   * the sub groups
   */
   var $group = array ();
   
   /**
   * the kind of group (AND/OR)
   */
   var $kind;

   function CopixDAOSearchParamsCondition (& $parent, $kind){
      if (get_class ($parent) == strtolower ('copixdaosearchparamscondition')){
         $this->parent = & $parent;
      }
      $this->kind   = $kind;
   }
}

class CopixDAOSearchParams {
   /**
   * a DAOSearchParamsCondition objet to describe the coditions we need to apply
   */
   var $condition;

   /**
   * the orders we wants the list to be
   */
   var $order = array ();

   /**
   * the field list we wants to get.
   */
   var $fields = array ();
   
   /**
   * the condition we actually are browsing
   */
   var $_currentCondition;

   function CopixDAOSearchParams ($type = 'AND'){
      $this->condition = & new CopixDAOSearchParamsCondition ($this, $type);
      $this->_currentCondition = & $this->condition;
   }

   /**
   * sets the order by condition
   */
   function orderBy (){
      $args = func_get_args();
      $this->order = $args;
   }

   /**
   * says if the condition is empty
   */
   function isEmpty (){
      return (count ($this->condition->group) == 0) &&
             (count ($this->condition->conditions) == 0);
   }

   /**
   * starts a condition group
   */
   function startGroup ($kind = 'AND'){
      //adds a condition
      $this->_currentCondition->group[] = & new CopixDAOSearchParamsCondition ($this->_currentCondition, $kind);
      $this->_currentCondition = & $this->_currentCondition->group[count ($this->_currentCondition->group)-1];
   }

   /**
   * ends a condition group
   */
   function endGroup (){
      if ($this->_currentCondition->parent !== null){
         $this->_currentCondition = & $this->_currentCondition->parent;
      }
   }

   /**
   * adds a condition..... no more no less
   */
   function addCondition ($field_id, $condition, $value, $kind = 'and'){
      $this->_currentCondition->conditions[] = array ('field_id'=>$field_id, 'value'=>$value, 'condition'=>$condition, 'kind'=>$kind);
   }

   /**
   * explain in SQL (only the where part of the query)
   */
   function explainSQL ($fields, $fieldsType, & $ct, $tableName){
      $sql = $this->_explainSQLCondition ($this->condition, false, $fields, $fieldsType, $ct, $tableName);

      $desc  = false;
      $order = array ();
      foreach ($this->order as $key=>$name){
         if ($name != 'desc'){
            $order[] = $fields[$name];
         }else{
            $desc    = true;
         }
      }
      return (count ($order) > 0) ? ($sql . ' order by '.implode (', ', $order) . ($desc === true ? ' DESC' : '')) : $sql;
   }

   /**
   * explain in SQL a single level of ConditionGroup
   */
   function _explainSQLCondition ($condition, $explainKind, & $fields, & $fieldsType, & $ct, $tableName){

      $r = ' ';

      //direct conditions for the group
      $first = true;
      foreach ($condition->conditions as $conditionDescription){
         if (!$first){
            if (! (is_array ($conditionDescription['value']) && !count ($conditionDescription['value']))){
               $r .= ' '.$conditionDescription['kind'].' ';
            }
         }
         $first = false;

         if($fields[$conditionDescription['field_id']] == $conditionDescription['field_id']){ // fieldname and propertie name = same name ?
            $prefix = $tableName.'.'.$fields[$conditionDescription['field_id']];
         }else{
            $prefix = $conditionDescription['field_id'];
         }

         $prefix.=' '.$conditionDescription['condition'].' ';

         if (!is_array ($conditionDescription['value'])){
           $r .= $prefix.$this->_prepareValue($conditionDescription['value'],$fieldsType[$conditionDescription['field_id']], $ct);
         }else{
            if (count ($conditionDescription['value'])){
               $r .= ' ( ';
               $firstCV = true;
               foreach ($conditionDescription['value'] as $conditionValue){
                  if (!$firstCV){
                     $r .= ' or ';
                  }
                  $r.=$prefix.$this->_prepareValue($conditionValue,$fieldsType[$conditionDescription['field_id']], $ct);
                  $firstCV = false;
               }
               $r .= ' ) ';
            }
         }
      }

      //sub conditions
      $first = true;
      foreach ($condition->group as $conditionDetail){
        $r .= $this->_explainSQLCondition ($conditionDetail, !$first, $fields, $fieldsType, $ct, $tableName);
        $first = false;
      }

      //adds parenthesis around the sql if needed (non empty)
      if (strlen (trim ($r)) > 0){
//         if ($explainKind){
//            $r .= $condition->kind . ' ';
//         }
         $r = ($explainKind ? $condition->kind : '') . '('.$r.')';
      }

      return $r;
   }
   /**
   * explain the condition as it will be
   */
   function explain (){
      $r  = 'select ';

      $r .= count ($this->fields) > 0 ? implode (', ', $this->fields) : ' all ';
      $r .= $this->_explainCondition ($this->condition, false);

      if (count ($this->order) > 0){
         return $r.' order by '.implode (', ', $this->order);
      }

      return $r;
   }

   /**
   * explain a single condition.
   */
   function _explainCondition ($condition, $explainKind){
      $r = ' ';
      if ($explainKind){
         $r .= $condition->kind . ' ';
      }
      $r .= '(';

      //direct conditions for the group
      $first = true;
      foreach ($condition->conditions as $conditionDescription){
         if (!$first){
            $r .= ' '.$conditionDescription['kind'].' ';
         }
         $first = false;
         $r .= $conditionDescription['field_id']. ' '.$conditionDescription['condition'].' '.$conditionDescription['value'];
      }

      //sub conditions
      $first = true;
      foreach ($condition->group as $conditionDetail){
        $r .= $this->_explainCondition ($conditionDetail, !$first);
        $first = false;
      }

      $r .= ')';
      return $r;
   }

   function _prepareValue($value, $fieldType, &$ct){
      switch(strtolower($fieldType)){
         case 'int':
         case 'integer':
         case 'autoincrement':
            $value= intval($value);
            break;
         case 'double':
         case 'float':
            $value= doubleval($value);
            break;
         case 'numeric'://usefull for bigint and stuff
            if (is_numeric ($value)){
               return $value;//was numeric, we can sends it as is
            }else{
               return intval ($value);//not a numeric, nevermind, casting it
            }
            break;
         default:
           $value = $ct->quote ($value);
      }
      return $value;
   }
}
?>
