<?php
/**
* @package	copix
* @subpackage dbtools
* @version	$Id: CopixDbResultSet.class.php,v 1.1 2004/07/25 22:12:59 j-charles Exp $
* @author	Croes Gérald, Jouanneau Laurent
*           see copix.aston.fr for other contributors.
* @copyright 2001-2004 Aston S.A.
* @link		http://copix.aston.fr
* @licence  http://www.gnu.org/licenses/gpl.html GNU General Public Licence, see LICENCE file
*/

define('COPIXDB_TYPE_INTEGER' , 0x01);
define('COPIXDB_TYPE_FLOAT' , 0x02);
define('COPIXDB_TYPE_BOOLEAN' , 0x03);
define('COPIXDB_TYPE_STRING', 0x04);
define('COPIXDB_TYPE_BOOLEAN_STR', 0x0103);
define('COPIXDB_TYPE_BOOLEAN_YN' , 0x0203);
define('COPIXDB_TYPE_BOOLEAN_01' , 0x0303);
define('COPIXDB_TYPE_BOOLEAN_BOOL' , 0x0403);

/**
 *
 * @package copix
 * @subpackage dbtools
 */

class CopixDbResultSet {
   var $_idResult;
   var $_autoFree;

   function CopixDbResultSet ( & $idResult, $autoFree = true){
      $this->_idResult = & $idResult;
      $this->_autoFree = $autoFree;
   }

   /**
    * fetch et renvoi les resultats sous forme d'un objet
    * @return object l'objet contenant les champs récupérés, ou false si le curseur est à la fin
    */
   function & fetch(){
      $result = & $this->_fetch ();

      if(!$result && $this->_autoFree)
         $this->free();

      return $result;
   }

   /**
    * recupere un enregistrement et rempli les propriétes d'un objet existant avec
    * les valeurs récupérées.
    * Si l'objet contient une méthode getTypeProperties qui renvoi un tableau
    * array('nomduchamp'=> COPIXDB_TYPE_* , ..), alors effectue une conversion vers le
    * type indiqué
    * @param object  $object
    * @return  boolean  indique si il y a eu des resultats ou pas.
    */
   function fetchInto (& $object){
      if(! is_object ($object))
         trigger_error ('Wrong argument type', E_USER_ERROR);
      $result = & $this->fetch ();

      if ($result){
         if (method_exists($object, 'getTypeProperties')){
            $typeProp = $object->getTypeProperties();

            foreach(get_object_vars ($result) as $k=>$v) {
               if(isset($typeProp[$k])){
                  switch($typeProp[$k]){
                     case COPIXDB_TYPE_INTEGER :
                         $object->$k = intval($result->$k);
                         break;
                     case COPIXDB_TYPE_FLOAT :
                         $object->$k = doubleval($result->$k);
                         break;
                     case COPIXDB_TYPE_BOOLEAN_STR :
                         $object->$k = ($result->$k ? true : false);
                         break;
                     case COPIXDB_TYPE_BOOLEAN_YN :
                         $object->$k = in_array ($result->$k, array ('Y', 'y','O', 'o'));
                         break;
                     case COPIXDB_TYPE_BOOLEAN_01 :
                         $object->$k = (intval($result->$k) ? true : false);
                         break;
                     case COPIXDB_TYPE_BOOLEAN_BOOL :
                         $object->$k = (substr($result->$k,0,1) == 't' ? true : false);
                         break;                        
                  }
               }else
                  $object->$k = $result->$k;
            }
         }else{
            foreach (get_object_vars ($result) as $k=>$value){
               $object->$k = $value;
            }
         }
         return true;
      }else{
         return false;
      }
   }

   function & fetchUsing ($className){
      $obj = & new $className();
      if($this->fetchInto ($obj))
         return $obj;
      else
         return false;
   }

   function free (){
      if ($this->_idResult){
         $this->_free ();
         $this->_idResult = null;
      }
   }

   /**
    * @abstract
    */
   function _free (){
      return null;
   }

   /**
    * @abstract
    */
   function &_fetch (){
      return null;
   }

   /**
    * @abstract
    */
   function numRows(){
		trigger_error(CopixI18N::get('copix:common.error.functionnality',get_class($this).'::numRows'),E_USER_WARNING);
   }

   /**
    * alias de fetch()
    * @deprecated
    * @see CopixDbResultSet::fetch
    */
   function & fetchObject (){
      trigger_error (CopixI18N::get('copix:common.error.deprecated.use', array('fetchObject','fetch')), E_USER_WARNING);
      return $this->fetch();
   }

   /**
    * fetch et renvoi les resultats sous forme de tableau associatif
    * @return  array resultats ou false si il n'y a plus de lignes.
    * @deprecated
    */
   function & fetchRow (){
      trigger_error (CopixI18N::get('copix:common.error.deprecated','fetchRow'), E_USER_ERROR);
   }
}
?>
