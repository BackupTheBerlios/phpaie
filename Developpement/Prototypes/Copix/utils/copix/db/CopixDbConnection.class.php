<?php
/**
* @package	copix
* @subpackage dbtools
* @version	$Id: CopixDbConnection.class.php,v 1.1 2004/07/25 22:12:59 j-charles Exp $
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
class CopixDBConnection {
   /**
    * indique si les requètes doivent être envoyée sur le debugger
    * @var boolean
    */
   var $_debugQuery = false;

	/**
    * indique si il faut provoquer les exceptions
    * @var boolean
    */
   var $_displayError=true;
   /**
   * the internal connection.
   */
   var $_connection = null;
   /**
   * the last query
   */
   var $_lastQueryString = null;

   var $profil;
   var $hasError = false;
   var $msgError = '';

   function CopixDBConnection(){
   }

   /**
    * effectue une connection sur la base
    * @param	CopixDbProfil	$profil	profil de connection
    */
   function connect (& $profil){
      $this->profil = & $profil;
      $this->_connection=$this->_connect();
		if($this->_connection === false || $this->_connection === null)
      	$this->_doError();
   }

   /**
    * effectue une déconnection sur la base
    */
   function disconnect (){
   	if($this->_connection !== false && $this->_connection !== null)
      	$this->_disconnect ();
   }

   /**
    * indique si la connection est ok ou pas
    * @return boolean   etat de la connection (true = ok)
    */
   function isConnected (){
      return $this->_connection !== null && $this->_connection !== false;
   }

   /**
    * execute une requète SQL
    * @param   string   $queryString   requète SQL
    * @return  CopixDbResultSet  le resultset si il s'agit d'un SELECT, true sinon. False si la requète a echouée.
    */
   function & doQuery ($queryString){

      //on se souvient de la dernière requete.
      $this->lastQuery = $queryString;
      $this->_debug ($queryString);
      $this->hasError = false;

      $result = $this->_doQuery ($queryString);
      if(!$result)
      	$this->_doWarning ($queryString);

      return $result;
   }

   /**
    * echappe les caractères d'une chaine, en l'encadrant de quotes, ou renvoi la chaine 'NULL'
    * @param string $text	le texte à échapper
    * @return string le texte échappé
    */
   function quote($text, $checknull=true){
      if($checknull)
         return (is_null ($text) ? 'NULL' : "'".$this->_quote($text)."'");
      else
         return "'".$this->_quote($text)."'";
   }

	/**
    * alias de quote
    * @deprecated
    */
   function formatText ($text){
      trigger_error ('deprecated "formatText"', E_USER_WARNING);
      return $this->quote($text);
   }

   /**
    * génère un warning, à partir du message d'erreur renvoyé par la base
    * @param   string   $otherMsg   message additionnel
    * @access private
    * @see CopixDbConnection::_displayError CopixDbConnection::getErrorMessage
    */
	function _doWarning($otherMsg=''){
		$this->msgError=$this->getErrorMessage();
      if($otherMsg)
      	$this->msgError.=' ('.$otherMsg.')';
      $this->hasError=true;
      if($this->_displayError)
	      trigger_error($this->msgError,E_USER_WARNING);
   }

   /**
    * génère une erreur, à partir du message d'erreur renvoyé par la base
    * @param   string   $otherMsg   message additionnel
    * @access private
    * @see CopixDbConnection::_displayError CopixDbConnection::getErrorMessage
    */
	function _doError($otherMsg=''){
      $this->msgError=$this->getErrorMessage();
      if($otherMsg)
			$this->msgError.=' ('.$otherMsg.')';
      $this->hasError = true;
      if($this->_displayError)
			trigger_error($this->msgError,E_USER_ERROR);
   }

   /**
    * affiche un message pour débuggage. Utilisé pour afficher les requètes
    * quand _debugQuery est activé
    * @param   string   message à afficher pour le débuggage
    * @access private
    * @see CopixDbConnection::_debugQuery
    */
	function _debug($msg){
      if($this->_debugQuery){
         if (isset($GLOBALS['COPIX']['DEBUG'])){
			   $GLOBALS['COPIX']['DEBUG']->addInfo($msg, 'CopixDb :');
         }else{
            echo $msg;
         }
      }
   }

// ====================== méthodes à surcharger (éventuellement)

   /**
    * renvoi la connection, ou false/null si erreur
    * @abstract
    */
   function _connect (){
         return null;
   }

   /**
    * effectue la deconnection (pas besoin de faire le test sur l'id de connection
    * @abstract
    */
   function _disconnect (){
         return null;
   }

   /**
    * effectue la requete
    * @return CopixDbResultSet/boolean    selon la requete, un recordset/true ou false/null si il y a une erreur
    * @abstract
    */
   function &_doQuery ($queryString){
         return null;
   }

   /**
    * @abstract
    */
   function & begin (){
		trigger_error(CopixI18N::get('copix:common.error.functionnality','begin'),E_USER_WARNING);
      return null;
   }

   /**
    * @abstract
    */
   function & commit (){
		trigger_error(CopixI18N::get('copix:common.error.functionnality','commit'),E_USER_WARNING);
      return null;
   }

   /**
    * @abstract
    */
   function & rollBack (){
		trigger_error(CopixI18N::get('copix:common.error.functionnality','rollBack'),E_USER_WARNING);
      return null;
   }

   /**
    * @abstract
    */
   function getErrorMessage(){
		return '';
   }

   /**
    * @abstract
    */
	function getErrorCode(){
   	return '';
   }

   /**
    * renvoi une chaine avec les caractères spéciaux échappés
    * à surcharger pour tenir compte des fonctions propres à la base (mysql_escape_string etC...)
    * @abstract
    * @access private
    */
	function _quote($text){
		return addslashes($text);
   }

   /**
    * @abstract
    */
	function affectedRows($ressource = null){
		trigger_error(CopixI18N::get('copix:common.error.functionnality','affectedRows'),E_USER_WARNING);
   }

   /**
    * @abstract
    */
   function lastId($fromSequence=''){
		trigger_error(CopixI18N::get('copix:common.error.functionnality','lastId'),E_USER_WARNING);
   }
}
?>
