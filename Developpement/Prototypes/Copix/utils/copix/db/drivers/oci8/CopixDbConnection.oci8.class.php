<?php
/**
* @package	copix
* @subpackage dbtools
* @version	$Id: CopixDbConnection.oci8.class.php,v 1.1 2004/07/25 22:12:59 j-charles Exp $
* @author	Croes Gérald, Jouanneau Laurent
*           see copix.aston.fr for other contributors.
* @copyright 2001-2004 Aston S.A.
* @link		http://copix.aston.fr
* @licence  http://www.gnu.org/licenses/gpl.html GNU General Public Licence, see LICENCE file
*/

/**
 *
 * @package copix
 * @subpackage dbtools
 */
class CopixDBConnectionOci8 extends CopixDBConnection {
   function _connect (){
      $funcconnect= ($this->profil->persistent? 'ociplogon':'ocilogon');

      return $funcconnect ($this->profil->user, $this->profil->password , $this->profil->dbname);
   }

   function _disconnect (){
      return ocilogoff ($this->_connection);
   }

   function &_doQuery ($queryString){
      $stmt=ociparse($this->_connection, $queryString);

      if($stmt && ociexecute($stmt)){
         $rs= & new CopixDbResultSetOci8($stmt);
         $rs->_connector = &$this;
         return $rs;
      }else{
         return false;
      }
   }

   function getErrorMessage(){
      if($err= ocierror($this->_connection)){
         return $err['message'];
      }else
         return false;
   }

	function getErrorCode(){
       if($err= ocierror($this->_connection)){
         return $err['code'];
      }else
         return false;
   }


	function affectedRows($ressource = null){
		if($ressource !== null && get_class($ressource) == 'CopixDbResultSetOci8' )
          return ocirowcount($ressource->_idResult);
      else return -1;
   }

	function _quote($text){
		return str_replace("'","''",$text);
   }

   function & begin (){
		return null;
   }

   function & commit (){
		return ocicommit($this->_connection);
   }

   function & rollBack (){
		return ocirollback($this->_connection);
   }
}
?>
