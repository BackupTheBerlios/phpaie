<?php
/**
* @package	copix
* @subpackage profile
* @version	$Id: CopixCapacity.class.php,v 1.1 2004/07/25 22:12:59 j-charles Exp $
* @author	Croes Gérald , Jouanneau Laurent
*           see copix.aston.fr for other contributors.
* @copyright 2001-2004 Aston S.A.
* @link		http://copix.aston.fr
* @licence  http://www.gnu.org/licenses/gpl.html GNU General Public Licence, see LICENCE file
*/
class CopixCapacity {
   var $id_ccap;
   var $description_ccap;
   function CopixCapacity ($id_ccap, $description_ccap){
      $this->id_ccap = $id_ccap;
      $this->description_ccap = $description_ccap;
   }
}

class CopixCapacities {
   var $capacities;
   function & instance (){
      static $instance = false;
      if ($instance === false){
         $instance = new CopixCapacities ();
         $instance->reload ();
      }
      return $instance;
   }
   function reload (){
      $this->capacities = array ();

      $ct = CopixDbFactory::getConnection ();
      $rq = $ct->doQuery ('select ID_CCAP, DESCRIPTION_CCAP from copixcapacities order by ID_CCAP');
      while ($r = $rq->fetchObject ()){
         $this->capacities[] = & new CopixCapacity ($r->ID_CCAP, $r->DESCRIPTION_CCAP);
      }
      $r->free();
   }
   function getList (){
      $instance = & CopixCapacities::instance ();
      return $instance->capacities;
   }
   function insert ($path, $description){
      $instance = & CopixCapacities::instance ();
      if (!in_array ($path, $instance->capacities)){
         $ct = CopixDbFactory::getConnection ();
         $toSet['ID_CCAP'] = $ct->quote ($path,false);
         $toSet['DESCRIPTION_CCAP'] = $ct->quote ($description,false);

         return $ct->doInsert ('copixcapacities', $toSet);
      }
   }
   function delete ($path){
      $ct = CopixDbFactory::getConnection ();
      $ct->doQuery ('delete from copixcapacities where ID_CCAP like '.$ct->quote ($path.'%',false));
   }
}
?>
