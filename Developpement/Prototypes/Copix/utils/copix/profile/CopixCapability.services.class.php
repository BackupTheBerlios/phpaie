<?php
class ServicesCopixCapability {
   /**
   * Creates a capability
   */
   function create ($path, $description) {
      $dao    = & CopixDAOFactory::create       ('copix:CopixCapability');
      $record = & CopixDAOFactory::createRecord ('copix:CopixCapability');

      $record->name_ccpb        = $path;
      $record->description_ccpb = $description;

      $dao->insert ($record);
   }

   /**
   * Updates a capability, will _not_ update the subcapabilities.
   * If you want to move a capability (eg xxx -> xxY, where you want xxx|YYY to become xxY|YYY), use move instead
   */
   function update ($path, $description) {
      $dao    = & CopixDAOFactory::create       ('copix:CopixCapability');
      $record = & CopixDAOFactory::createRecord ('copix:CopixCapability');

      $record->name_ccpb        = $path;
      $record->description_ccpb = $description;

      $dao->update ($record);
   }

   /**
   * Moves all the path that are linked to the given path
   */
   function move ($path, $newPath){
      $dao         = & CopixDAOFactory::create ('copix:CopixCapability');
      $daoGroupCap = & CopixDAOFactory::create ('copix:CopixGroupCapabilities');

      //gets the moved list.
      $listToMove = $this->getList ($path);
      
      //moves the elements.
      foreach ($listToMove as $pathToReplace){
         $pathToCreate = str_replace ($path, $newPath, $pathToReplace);

         //creates the dest cap.
         $oldCap = & $dao->get ($pathToReplace);
         $newCap = & CopixDAOFactory::createRecord ('copix:CopixCapability');
         $newCap->name_ccpb        = str_replace ($path, $newPath, $pathToReplace);
         $newCap->description_ccpb = $oldCap->description_ccpb;
         $dao->insert ($newCap);

         //moves associations.
         $daoGroupCap->movePath ($pathToReplace, $pathToCreate);
         $dao->delete ($pathToReplace);
      }
   }

   /**
   * deletes all the related path.
   */
   function delete ($path) {
      $dao  = & CopixDAOFactory::create ('copix:CopixCapability');
      $daoGroupCapabilities = & CopixDAOFactory::create ('copix:CopixGroupCapabilities');

      //gets the moved list.
      $listToDelete = $this->getList ($path);

      //moves the elements.
      foreach ((array) $listToDelete as $pathToDelete){
         $daoGroupCapabilities->removePath ($pathToDelete);
         $dao->delete ($pathToDelete);
      }
   }

   /**
   * gets the list of capablities from a base path.
   */
   function getList ($fromPath = null){
      $sp = CopixDAOFactory::createSearchParams ();
      //if given a path.
      if ($fromPath !== null){
         $sp->addCondition ('name_ccpb', 'like', $fromPath.'%');
      }
      $sp->orderBy ('name_ccpb');

      //search
      $dao     = & CopixDAOFactory::create ('copix:CopixCapability');
      $results = $dao->findBy ($sp);

      //we only wants names
      $toReturn = array ();
      foreach ($results as $cap) {
         if($this->checkBelongsTo ($fromPath, $cap->name_ccpb)){//check if matches.
            $toReturn [] = $cap->name_ccpb;
         }
      }

      //we're gonna put the list in the correct order now
      return $toReturn;
   }

   /**
   * Gets capabilities descriptions
   */
   function getDescriptions (){
      $sp = CopixDAOFactory::createSearchParams ();
      $sp->orderBy ('name_ccpb');

      //search
      $dao     = & CopixDAOFactory::create ('copix:CopixCapability');
      $results = $dao->findBy ($sp);

      //we only wants names
      $toReturn = array ();
      foreach ($results as $cap){
         $toReturn[$cap->name_ccpb] = $cap->description_ccpb;
      }
      return $toReturn;
   }

   /**
   * checks if $motherPath is really the mother of childPath
   * ie: we don't want to get things like site|1 being the mother of
   *    site|1234. (reason why we can't use substr here, but we have to explode
   *    strings)
   */
   function checkBelongsTo ($motherPath, $childPath){
      $mother = explode ('|', $motherPath);
      $child  = explode ('|', $childPath);
      //if less in child, it's not a child
      if (count ($child) < count ($mother)){
         return false;
      }

      //we have to check the complete path of mother.
      //If all mothers elements are in child, then it's ok.
      foreach ($mother as $key=>$element){
         if ($child[$key] != $element){
            return false;//does not match, it's not it's child
         }
      }

      //everything was successful.
      return true;
   }
}
?>
