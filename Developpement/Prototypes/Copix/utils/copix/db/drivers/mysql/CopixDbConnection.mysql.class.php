<?php
/**
* @package	copix
* @subpackage dbtools
* @version	$Id: CopixDbConnection.mysql.class.php,v 1.1 2004/07/25 22:12:59 j-charles Exp $
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
class CopixDBConnectionMySQL extends CopixDBConnection {
   var $_fctEscapeString = '';
   function CopixDBConnectionMySQL(){
      parent::CopixDBConnection();
      // fonction d'echappement pour les chaines
      // on essaie de prendre mysql_real_escape_string car tient compte du charset de la base utilisée
      // par contre existe seulement depuis php 4.3.0..
      // on le fait ici, car c'est un test en moins à faire à chaque quote()
      $this->_fctEscapeString= (function_exists('mysql_real_escape_string') ? 'mysql_real_escape_string' : 'mysql_escape_string');
   }

   function _connect (){
      $funcconnect= ($this->profil->persistent? 'mysql_pconnect':'mysql_connect');

      if($cnx = $funcconnect ($this->profil->host, $this->profil->user, $this->profil->password)){
         if(mysql_select_db ($this->profil->dbname, $cnx))
            return $cnx;
         else
            return false;
      }else
         return false;
   }

   function _disconnect (){
      return mysql_close ($this->_connection);
   }

   function & _doQuery ($queryString){
      if ($qI = mysql_query ($queryString, $this->_connection)){
         return new CopixDbResultSetMySQL ($qI);
      }else{
         return false;
      }
   }

	function getErrorMessage(){
       return mysql_error($this->_connection);
   }

	function getErrorCode(){
   	return  mysql_errno($this->_connection);
   }

   /**
    * renvoi une chaine avec les caractères spéciaux échappés
    * @access private
    */
	function _quote($text){
      $function_name = $this->_fctEscapeString;
      return $function_name ($text);
   }

	function affectedRows($ressource = null){
		return mysql_affected_rows($this->_connection);
   }
   function lastId($fromSequence=''){
		return mysql_insert_id($this->_connection);
   }
}
?>
