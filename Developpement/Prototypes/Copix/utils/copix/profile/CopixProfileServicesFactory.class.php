<?php
class CopixProfileServicesFactory {
   function & createGroupServices () {
      require_once (COPIX_PROFILE_PATH.'CopixGroup.services.class.php');
      $object = & new ServicesCopixGroup ();
      return $object;
   }

   function createCapabilityServices () {
      require_once (COPIX_PROFILE_PATH.'CopixCapability.services.class.php');
      $object = & new ServicesCopixCapability ();
      return $object;
   }
}
?>
