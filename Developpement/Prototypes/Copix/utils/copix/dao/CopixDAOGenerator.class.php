<?php
/**
* @package	copix
* @subpackage copixdao
* @version	$Id: CopixDAOGenerator.class.php,v 1.1 2004/07/25 22:12:59 j-charles Exp $
* @author	Croes Gérald , Jouanneau Laurent
*           see copix.aston.fr for other contributors.
* @copyright 2001-2004 Aston S.A.
* @link		http://copix.aston.fr
* @licence  http://www.gnu.org/licenses/gpl.html GNU General Public Licence, see LICENCE file
*/

class CopixDAOGenerator {

   var $_compiler=null;


   /**
   * the user DAO if any.
   */
   var $_userDAO = null;

   /**
   * the user DAO if any.
   */
   var $_userDAORecord= null;

   /**
   * the user definition if any.
   */
   var $_userDefinition = null;

   /**
   * the user single class if any.
   */
   var $_userSingle = null;

   var $_userDAOPath=null;
   var $_DAORecordClassName = null;
   var $_DAOClassName=null;
   var $_compiledDAORecordClassName = null;
   var $_compiledDAOClassName=null;

   function CopixDAOGenerator( & $compiler){
      $this->_compiler= &$compiler;

      $this->_compiledDAOClassName = CopixDAOFactory::getDAOName ($compiler->_DAOid);
      $this->_compiledDAORecordClassName =CopixDAOFactory::getDAORecordName($compiler->_DAOid);
   }

   function setUserDAO(&$userDAO){
      $this->_userDAO = & $userDAO;
      $this->_DAOClassName = get_class($userDAO);
   }

   function setUserDAORecord(&$userDAO){
      $this->_userDAORecord = & $userDAO;
      $this->_DAORecordClassName = get_class($userDAO);
   }

   function setUserDefinition(&$userDefinition){
      $this->_userDefinition = & $userDefinition;
   }
   function setUserDAOPath(&$userpath){
      $this->_userDAOPath = & $userpath;
   }

   function compileDAO () { return '';}
   function compileDAORecordClass () {return ''; }
}


?>
