<?php
/**
* @package	copix
* @subpackage profile
* @version	$Id: CopixUserProfile.class.php,v 1.1 2004/07/25 22:12:59 j-charles Exp $
* @author	Croes Gérald , Jouanneau Laurent
*           see copix.aston.fr for other contributors.
* @copyright 2001-2004 Aston S.A.
* @link		http://copix.aston.fr
* @licence  http://www.gnu.org/licenses/gpl.html GNU General Public Licence, see LICENCE file
*/

require_once (COPIX_PROFILE_PATH.'CopixProfile.class.php');

/**
* the current user's profile.
*/
class CopixUserProfile {
   var $profile = null;

   /**
   * singleton.
   */
   function & instance (){
      static $me = false;
      if ($me === false){
         $user = $GLOBALS['COPIX']['COORD']->getPlugin ('Auth');
         if ($user === null){
            trigger_error (CopixI18N::get ('copix.error.plugin.unregistered', 'Auth'));
         }
         $user = $user->getUser ();
         $me   = new CopixUserProfile ($user->login);
      }
      return $me;
   }

   /**
   * Gives the max value of a right.
   * basePath is the path we're going from (have to include the trailing pipe "|" ).
   * completionArray is the list of values we're gonna complete the path with.
   */
   function valueOfInArray ($basePath, $completionArray) {
      $me = & CopixUserProfile::instance ();

      $current = PROFILE_CCV_NONE;
      foreach ($completionArray as $element) {
         $completePath = $basePath.$element;
         //echo $completePath, '<br />';
         if (($positionValue = $me->valueOf ($completePath)) > $current) {
            $current = $positionValue;
         }
         //echo $positionValue;
      }
      return $current;
   }

   /**
   * gets the maximum value on a given path for the user.
   */
   function valueOf ($path){
      $me = & CopixUserProfile::instance ();
      return $me->profile->valueOf ($path);
   }

   /**
   * says if the user belongs to a given group
   */
   function belongsTo ($group) {
      $me = & CopixUserProfile::instance ();
      return $me->profile->belongsTo ($group);
   }

   /**
   * gets the groups the user belongs to.
   */
   function getGroups (){
      $me = & CopixUserProfile::instance ();
      return $me->profile->getGroups ();
   }

   /**
   * constructor. Will load the given profile.
   */
   function CopixUserProfile ($login) {
      $this->profile = & new CopixProfile ($login);
   }
}
?>
