<?php 
class CompiledDAORecordBranch {
 var $branch_id = null;
 var $branch_name = null;
 var $branch_status = null;
 var $branch_email = null;
 function check (){
  $errorObject = new CopixErrorObject ();
  return $errorObject->isError () ? $errorObject->asArray () : true;
 }
}
require_once (COPIX_DB_PATH . 'CopixDbWidget.class.php');

class CompiledDAOBranch { 
   var $_table='test_copix_branch';
   var $_connectionName=null;
 var $_userDAO;
//Vars defined in User\s DAO
 var $toto;
//--
 function CompiledDAOBranch () {
  require_once ('/home/PHPAIE/www/protos/CopixWebApp/project/modules/workflow/classes/branch.dao.class.php');
  $this->_userDAO = & new daobranch;
  $this->_synchronizeFromUserDAOProperties ();
 }
 function daobranch () {
   $this->_synchronizeToUserDAOProperties ();
   $args = func_get_args();
   $toReturn = call_user_func_array(array(&$this->_userDAO, 'daobranch'), $args);
   $this->_synchronizeFromUserDAOProperties ();
   return $toReturn;
 }
 function _synchronizeFromUserDAOProperties (){
  $this->toto = $this->_userDAO->toto;
 }
 function _synchronizeToUserDAOProperties (){
  $this->_userDAO->toto = $this->toto;
 }
   var $_selectQuery='SELECT branch.branch_id, branch.branch_name, branch.branch_status, branch.branch_email FROM test_copix_branch AS branch';
 function findAll (){
    $dbWidget = & CopixDBFactory::getDbWidget ();
    return $dbWidget->fetchAllUsing ($this->_selectQuery, 'CompiledDAORecordBranch');
 }
 function get ($branch_id){
    $ct = & CopixDBFactory::getConnection ();
    $query = $this->_selectQuery .' WHERE  branch.branch_id='. intval($branch_id).'';
    $dbWidget = & new CopixDbWidget ($ct);
    return $dbWidget->fetchFirstUsing ($query, 'CompiledDAORecordBranch');
 }
 function insert ($object){
    $ct = & CopixDBFactory::getConnection ();
    $query = 'INSERT INTO test_copix_branch (branch_name,branch_status,branch_email) VALUES ('. $ct->quote ($object->branch_name).', '. $ct->quote ($object->branch_status).', '. $ct->quote ($object->branch_email).')';
   $toReturn = $ct->doQuery ($query);
   if($toReturn){
     $object->branch_id= $ct->lastId('branch_id');
    return $toReturn;
      }else return false; 
   }
 function update ($object){
    $ct = & CopixDBFactory::getConnection ();
    $query = 'UPDATE test_copix_branch SET  branch_name= '. $ct->quote ($object->branch_name).', branch_status= '. $ct->quote ($object->branch_status).', branch_email= '. $ct->quote ($object->branch_email).' WHERE  branch_id='. intval($object->branch_id).'';
   return $ct->doQuery ($query);
 }
 function delete ($branch_id){
    $ct = & CopixDBFactory::getConnection ();
    $query = 'DELETE FROM test_copix_branch WHERE  branch_id='. intval($branch_id).'';
   return $ct->doQuery ($query);
 }
 function findBy ($searchParams){
    $ct = & CopixDBFactory::getConnection ();
    $query = $this->_selectQuery;
    if (!$searchParams->isEmpty ()){
       $query .= ' WHERE ';
      $query .= $searchParams->explainSQL (
         array('branch_id'=>array('branch_id', 'autoincrement','branch','%s'), 'branch_name'=>array('branch_name', 'string','branch','%s'), 'branch_status'=>array('branch_status', 'string','branch','%s'), 'branch_email'=>array('branch_email', 'string','branch','%s')),
                $ct );
    }
    $dbWidget = & new CopixDBWidget ($ct);
    return $dbWidget->fetchAllUsing ($query, 'CompiledDAORecordBranch');
 }
}

?>