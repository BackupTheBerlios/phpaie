<?php
/**
* @package	copix
* @subpackage dbtools
* @version	$Id: CopixDbConnection.postgresql.class.php,v 1.1 2004/07/25 22:12:59 j-charles Exp $
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
class CopixDBConnectionPostgreSQL extends CopixDBConnection {
   function _connect (){
     $funcconnect= ($this->profil->persistent? 'pg_pconnect':'pg_connect');


      // on fait une distinction car si host indiqué -> connection TCP/IP, sinon socket unix
      if($this->profil->host != '')
         return $funcconnect ('host='.$this->profil->host.' dbname='.$this->profil->dbname.' user='.$this->profil->user.' password='.$this->profil->password);
      else
         return $funcconnect ('dbname='.$this->profil->dbname.' user='.$this->profil->user.' password='.$this->profil->password);
   }

   function _disconnect (){
      return pg_close ($this->_connection);
   }

   function &_doQuery ($queryString){
      if ($qI = pg_query ($this->_connection, $queryString)){
         $rs= & new CopixDbResultSetPostgreSQL ($qI);
         $rs->_connector = &$this;
         return $rs;
      }else{
         return false;
      }
   }

   function getErrorMessage(){
      return pg_last_error($this->_connection);
   }

	function getErrorCode(){
      return pg_last_error($this->_connection);
   }

   /**
    * renvoi une chaine avec les caractères spéciaux échappés
    * @access private
    */
	function _quote($text){
      if(function_exists('pg_escape_string'))
		   return pg_escape_string($text);
      else
         return addslashes($text);
   }

	function affectedRows($ressource = null){
		if($ressource !== null && get_class($ressource) == 'CopixDbResultSetPostgreSQL' )
          return pg_affected_rows($ressource->_idResult);
      else return -1;
   }

   function lastId($seqname=''){
      if($seqname == ''){
         trigger_error(get_class($this).'::lastSeqId invalide sequence name',E_USER_WARNING);
         return false;
      }
      $cur=$this->doQuery(" select setval('$seqname', 	nextval('$seqname')-1) as id");
      if($cur){
         $res=$cur->fetch();
         $cur->free();
         if($res)
            return $res->id;
         else
            return false;
      }else{
         trigger_error(get_class($this).'::lastSeqId invalide sequence name',E_USER_WARNING);
         return false;
      }
   }

   /**
    * @deprecated
    */
   function lastSeqId($seqname){
      return $this->lastId($seqname);
   }

   function & begin (){
		return $this->doQuery('BEGIN');
   }

   function & commit (){
		return $this->doQuery('COMMIT');
   }

   function & rollBack (){
		return $this->doQuery('ROLLBACK');
   }
}
?>
