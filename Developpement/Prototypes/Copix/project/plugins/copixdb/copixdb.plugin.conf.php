<?php
/**
* @package    phpaie
* @subpackage plugins
* @version 
* @author     Croes Gérald
* @modified   Pierre Raoul
* @copyright  2001-2004 Aston S.A.
* @link       http://copix.aston.fr
* @licence    http://www.gnu.org/licenses/gpl.html GNU General Public Licence, see LICENCE file
*/

require_once (COPIX_PATH . 'db/CopixDbFactory.class.php');

class PluginConfigCopixDb {

    var $profils;            //tab of configs/
//    var $default = 'Select'; //the name of the default database access
//    var $default = COPIX_DEFAULT_DB_ACCESS; //the name of the default database access
    var $default; //the name of the default database access

    /**
     * @var boolean     si activé lorsque l'utilisateur ajoute showRequest=1 dans l'url, les requêtes effectuées en
     *                  base sont affichées. Uniquement celles passant par les AstonDB.... bien sur.
     * @deprecated      migration prevue dans un plugin
     */
    var $showQueryEnabled = true;


    /**
     * constructor, we here initialize the several connections.
     */
    function PluginConfigCopixDb ($defaultAccess = null){
        /**
         * default connection.
         */
        $this->default = $defaultAccess ? $defaultAccess : COPIX_DEFAULT_DB_ACCESS;
        
//        $this->profils[COPIX_DEFAULT_DB_ACCESS] = new CopixDbProfil (
        $this->profils[$this->default] = new CopixDbProfil (
                                        COPIX_DEFAULT_DB_DBMS     // DBMS driver name 
                                     ,  COPIX_DEFAULT_DB_NAME     // DB name
                                     ,  COPIX_DEFAULT_DB_HOST     // host name
                                     ,  COPIX_DEFAULT_DB_USER     // user
                                     ,  COPIX_DEFAULT_DB_PASS     // password
                                     ,  COPIX_DEFAULT_DB_PERSIST  // persistance
                                     ,  COPIX_DEFAULT_DB_POOL     // shared ?
                                     ,  COPIX_DEFAULT_DB_SCHEMA   // schema
                                     );
    }
}
?>
