<?php 
class CompiledDAORecordContract {
 var $contract_id = null;
 var $worker_id = null;
 var $worker_first_name = null;
 var $worker_last_name = null;
 var $branch_id = null;
 var $branch_name = null;
 var $wage = null;
 var $begin_date = null;
 var $end_date = null;
 function check (){
  $errorObject = new CopixErrorObject ();
  if (strlen ($this->worker_id) <= 0){
    $errorObject->addError ('worker_id', CopixI18N::get ('copix:dao.errors.required','Worker id'));
  }
  if (strlen ($this->branch_id) <= 0){
    $errorObject->addError ('branch_id', CopixI18N::get ('copix:dao.errors.required','Branch id'));
  }
  return $errorObject->isError () ? $errorObject->asArray () : true;
 }
}
require_once (COPIX_DB_PATH . 'CopixDbWidget.class.php');

class CompiledDAOContract { 
   var $_table='test_copix_contract';
   var $_connectionName=null;
   var $_selectQuery='SELECT contract.contract_id, contract.worker_id, worker.worker_first_name, worker.worker_last_name, contract.branch_id, branch.branch_name, contract.wage, contract.begin_date, contract.end_date FROM test_copix_contract AS contract, test_copix_worker AS worker, test_copix_branch AS branch WHERE  contract.worker_id=worker.worker_id AND contract.branch_id=branch.branch_id';
 function findAll (){
    $dbWidget = & CopixDBFactory::getDbWidget ();
    return $dbWidget->fetchAllUsing ($this->_selectQuery, 'CompiledDAORecordContract');
 }
 function get ($contract_id){
    $ct = & CopixDBFactory::getConnection ();
    $query = $this->_selectQuery .' AND  contract.contract_id='. intval($contract_id).'';
    $dbWidget = & new CopixDbWidget ($ct);
    return $dbWidget->fetchFirstUsing ($query, 'CompiledDAORecordContract');
 }
 function insert ($object){
    $ct = & CopixDBFactory::getConnection ();
    $query = 'INSERT INTO test_copix_contract (worker_id,branch_id,wage,begin_date,end_date) VALUES ('. intval($object->worker_id).', '. intval($object->branch_id).', '. intval($object->wage).', '. $ct->quote ($object->begin_date).', '. $ct->quote ($object->end_date).')';
   $toReturn = $ct->doQuery ($query);
   if($toReturn){
     $object->contract_id= $ct->lastId();
    return $toReturn;
      }else return false; 
   }
 function update ($object){
    $ct = & CopixDBFactory::getConnection ();
    $query = 'UPDATE test_copix_contract SET  worker_id= '. intval($object->worker_id).', branch_id= '. intval($object->branch_id).', wage= '. intval($object->wage).', begin_date= '. $ct->quote ($object->begin_date).', end_date= '. $ct->quote ($object->end_date).' WHERE  contract_id='. intval($object->contract_id).'';
   return $ct->doQuery ($query);
 }
 function delete ($contract_id){
    $ct = & CopixDBFactory::getConnection ();
    $query = 'DELETE FROM test_copix_contract WHERE  contract_id='. intval($contract_id).'';
   return $ct->doQuery ($query);
 }
 function findBy ($searchParams){
    $ct = & CopixDBFactory::getConnection ();
    $query = $this->_selectQuery;
    if (!$searchParams->isEmpty ()){
       $query .= ' AND ';
      $query .= $searchParams->explainSQL (
         array('contract_id'=>array('contract_id', 'autoincrement','contract','%s'), 'worker_id'=>array('worker_id', 'int','contract','%s'), 'worker_first_name'=>array('worker_first_name', 'string','worker','%s'), 'worker_last_name'=>array('worker_last_name', 'string','worker','%s'), 'branch_id'=>array('branch_id', 'int','contract','%s'), 'branch_name'=>array('branch_name', 'string','branch','%s'), 'wage'=>array('wage', 'int','contract','%s'), 'begin_date'=>array('begin_date', 'timestamp','contract','%s'), 'end_date'=>array('end_date', 'timestamp','contract','%s')),
                $ct );
    }
    $dbWidget = & new CopixDBWidget ($ct);
    return $dbWidget->fetchAllUsing ($query, 'CompiledDAORecordContract');
 }
}

?>