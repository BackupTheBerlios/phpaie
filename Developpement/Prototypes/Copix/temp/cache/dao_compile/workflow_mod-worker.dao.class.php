<?php 
class CompiledDAORecordWorker {
 var $worker_id = null;
 var $first_name = null;
 var $last_name = null;
 var $email = null;
 function check (){
  $errorObject = new CopixErrorObject ();
  return $errorObject->isError () ? $errorObject->asArray () : true;
 }
}
require_once (COPIX_DB_PATH . 'CopixDbWidget.class.php');

class CompiledDAOWorker { 
   var $_table='test_copix_worker';
   var $_connectionName=null;
   var $_selectQuery='SELECT worker.worker_id, worker.worker_first_name as first_name, worker.worker_last_name as last_name, worker.worker_email as email FROM test_copix_worker AS worker';
 function findAll (){
    $dbWidget = & CopixDBFactory::getDbWidget ();
    return $dbWidget->fetchAllUsing ($this->_selectQuery, 'CompiledDAORecordWorker');
 }
 function get ($worker_id){
    $ct = & CopixDBFactory::getConnection ();
    $query = $this->_selectQuery .' WHERE  worker.worker_id='. intval($worker_id).'';
    $dbWidget = & new CopixDbWidget ($ct);
    return $dbWidget->fetchFirstUsing ($query, 'CompiledDAORecordWorker');
 }
 function insert ($object){
    $ct = & CopixDBFactory::getConnection ();
    $query = 'INSERT INTO test_copix_worker (worker_first_name,worker_last_name,worker_email) VALUES ('. $ct->quote ($object->first_name).', '. $ct->quote ($object->last_name).', '. $ct->quote ($object->email).')';
   $toReturn = $ct->doQuery ($query);
   if($toReturn){
     $object->worker_id= $ct->lastId();
    return $toReturn;
      }else return false; 
   }
 function update ($object){
    $ct = & CopixDBFactory::getConnection ();
    $query = 'UPDATE test_copix_worker SET  worker_first_name= '. $ct->quote ($object->first_name).', worker_last_name= '. $ct->quote ($object->last_name).', worker_email= '. $ct->quote ($object->email).' WHERE  worker_id='. intval($object->worker_id).'';
   return $ct->doQuery ($query);
 }
 function delete ($worker_id){
    $ct = & CopixDBFactory::getConnection ();
    $query = 'DELETE FROM test_copix_worker WHERE  worker_id='. intval($worker_id).'';
   return $ct->doQuery ($query);
 }
 function findBy ($searchParams){
    $ct = & CopixDBFactory::getConnection ();
    $query = $this->_selectQuery;
    if (!$searchParams->isEmpty ()){
       $query .= ' WHERE ';
      $query .= $searchParams->explainSQL (
         array('worker_id'=>array('worker_id', 'autoincrement','worker','%s'), 'first_name'=>array('worker_first_name', 'string','worker','%s'), 'last_name'=>array('worker_last_name', 'string','worker','%s'), 'email'=>array('worker_email', 'string','worker','%s')),
                $ct );
    }
    $dbWidget = & new CopixDBWidget ($ct);
    return $dbWidget->fetchAllUsing ($query, 'CompiledDAORecordWorker');
 }
}

?>