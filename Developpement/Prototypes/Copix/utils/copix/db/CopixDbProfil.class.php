<?php
/**
* @package	copix
* @subpackage dbtools
* @version	$Id: CopixDbProfil.class.php,v 1.1 2004/07/25 22:12:59 j-charles Exp $
* @author	Croes Gérald, Jouanneau Laurent
*           see copix.aston.fr for other contributors.
* @copyright 2001-2004 Aston S.A.
* @link		http://copix.aston.fr
* @licence  http://www.gnu.org/licenses/gpl.html GNU General Public Licence, see LICENCE file
*/


/**
 * constantes pour les fetchmode
 */
define('COPIXDB_FETCHMODE_DEFAULT', 0);
define('COPIXDB_FETCHMODE_ORDERED', 1);
define('COPIXDB_FETCHMODE_ASSOC', 2);
define('COPIXDB_FETCHMODE_OBJECT', 3);

/**
 *
 * @package copix
 * @subpackage dbtools
 */
class CopixDbProfil {
   var $driver;
   var $dbname;
   var $host;
   var $user;
   var $password;
   var $persistent;
   var $shared;
   var $schema;

   function CopixDbProfil ($drivername, $databasename, $host, $user, $password,
   		$persistent=true, $shared=false,
         $schema =''){
      $this->driver     = $drivername;
      $this->dbname     = $databasename;
      $this->host       = $host;
      $this->user       = $user;
      $this->password   = $password;
      $this->persistent = $persistent;
      $this->shared     = $shared;
      $this->schema     = $schema;
   }
}
?>
