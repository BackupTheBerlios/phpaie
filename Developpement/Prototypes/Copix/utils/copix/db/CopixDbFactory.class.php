<?php
/**
* @package	copix
* @subpackage dbtools
* @version	$Id: CopixDbFactory.class.php,v 1.1 2004/07/25 22:12:59 j-charles Exp $
* @author	Croes G�rald, Jouanneau Laurent
*           see copix.aston.fr for other contributors.
* @copyright 2001-2004 Aston S.A.
* @link		http://copix.aston.fr
* @licence  http://www.gnu.org/licenses/gpl.html GNU General Public Licence, see LICENCE file
*/

/**
 * @ignore
 */
if (!defined ('COPIX_DB_PATH'))
   define ('COPIX_DB_PATH', dirname (__FILE__).'/');

require_once (COPIX_DB_PATH . 'CopixDbConnection.class.php');
require_once (COPIX_DB_PATH . 'CopixDbResultSet.class.php');
require_once (COPIX_DB_PATH . 'CopixDbProfil.class.php');

/**
 *
 * @package copix
 * @subpackage dbtools
 * @see CopixDbConnection CopixDbResultSet CopixDbProfil
 */
class CopixDBFactory {
   /**
   * R�cup�ration d'une connection.
   * @static
   * @param string  $named  nom du profil de connection d�finie dans CopixDb.plugin.conf.php
   * @return CopixDbConnection  objet de connection vers la base de donn�e
   */
   function & getConnection ($named = null){
      if ($named == null){
         return CopixDBFactory::getConnection (CopixDBFactory::getDefaultConnectionName ());
      }
      $profil = & CopixDBFactory::_getProfil ($named);

      //peut �tre partag� ?
      if ($profil->shared){
         $foundedConnection = & CopixDBFactory::_findConnection ($named);
         if ($foundedConnection === null){
            $foundedConnection = & CopixDBFactory::_createConnection ($named);
         }
         return $foundedConnection;
      }else{
         //Ne peut pas �tre partag�.
         return CopixDBFactory::_createConnection ($named);
      }
   }

   /**
   * r�cup�ration d'une connection par d�faut.
   * @static
   * @return    string  nom de la connection par d�faut
   */
   function getDefaultConnectionName (){
      $pluginDB = & $GLOBALS['COPIX']['COORD']->getPlugin ('CopixDb');
      if ($pluginDB === null){
         trigger_error (CopixI18N::get('copix:copix.error.plugin.unregister','CopixDb'), E_USER_ERROR);
      }
      return $pluginDB->config->default;
   }

   function & getDbWidget($connectionName=null){
       require_once (COPIX_DB_PATH . 'CopixDbWidget.class.php');
       return new CopixDbWidget(CopixDBFactory::getConnection($connectionName));
   }

   /**
   * creation d'une connection sans se connecter
   */
   function & getConnector ($connectionName = null) {
      if ($connectionName == null){
         return CopixDBFactory::getConnector (CopixDBFactory::getDefaultConnectionName ());
      }
      $profil = & CopixDBFactory::_getProfil ($connectionName);

      //pas de v�rification sur l'�ventuel partage de l'�l�ment.
      $connector = & CopixDBFactory::_createConnector ($connectionName);
      return $connector;
   }

   function & getTools($connectionName=null){
      require_once (COPIX_DB_PATH . 'CopixDbTools.class.php');
      return new CopixDbTools(CopixDBFactory::getConnection($connectionName));
   }


   /* ======================================================================
   *  private
   */

   /**
   * r�cup�ration d'un profil de connection � une base de donn�es.
   * @access private
   * @param string  $named  nom du profil de connection
   * @return    CopixDbProfil   profil de connection
   */
   function & _getProfil ($named){
      $pluginDB = & $GLOBALS['COPIX']['COORD']->getPlugin ('CopixDb');
      if ($pluginDB === null){
         trigger_error (CopixI18N::get('copix:copix.error.plugin.unregister','CopixDb'), E_USER_ERROR);
      }
      if(isset($pluginDB->config->profils[$named]))
         return $pluginDB->config->profils[$named];
      trigger_error(CopixI18N::get('copix:copix.db.error.profil.unknow',$named),E_USER_ERROR);
   }

   /**
   * R�cup�ration de la connection dans le pool de connection, � partir du nom du profil.
   * @access private
   * @param string  $named  nom du profil de connection
   * @return CopixDbConnection  l'objet de connection
   */
   function & _findConnection ($profilName){
      $profil = & CopixDBFactory::_getProfil ($profilName);
      if ($profil->shared){
         //connection partag�e, on peut retourner celle qui existe.
         if (isset ($GLOBALS['COPIX']['DB'][$profilName])){
            return $GLOBALS['COPIX']['DB'][$profilName];
         }else{
            return null;
         }
      }else{
         //la connection n'est pas partag�e, quoi qu'il arrive, on ne
         // peut pas retourner une connection existante.
         //(On fera confiance au pool de PHP pour cette gestion)
         return null;
      }
   }

   /**
   * cr�ation d'une connection.
   * @access private
   * @param string  $named  nom du profil de connection
   * @return CopixDbConnection  l'objet de connection
   */
   function & _createConnection ($profilName){
      $profil = & CopixDBFactory::_getProfil ($profilName);

		require_once(COPIX_DB_PATH.'/drivers/'.$profil->driver.'/CopixDbConnection.'.$profil->driver.'.class.php');
		require_once(COPIX_DB_PATH.'/drivers/'.$profil->driver.'/CopixDbResultSet.'.$profil->driver.'.class.php');

		$class = 'CopixDbConnection'.$profil->driver;

       //Cr�ation de l'objet
      $obj = & new $class ();
      if ($profil->shared){
         $GLOBALS['COPIX']['DB'][$profilName] = & $obj;
      }
      /*else{
         $GLOBALS['COPIX']['DB'][$profilName][] = & $obj;
      }*/

  		if ($GLOBALS['COPIX']['COORD']->getPluginConf ('CopixDb', 'showQueryEnabled')
          && (isset ($_GET['showQuery'])) && ($_GET['showQuery'] == '1')){
			$obj->_debugQuery=true;
      }

      $obj->connect ($profil);
      return $obj;
   }

   /**
   * cr�ation d'une connection.
   * @access private
   * @param string  $named  nom du profil de connection
   * @return CopixDbConnection  l'objet de connection
   */
   function & _createConnector ($profilName){
      $profil = & CopixDBFactory::_getProfil ($profilName);
		require_once(COPIX_DB_PATH.'/drivers/'.$profil->driver.'/CopixDbConnection.'.$profil->driver.'.class.php');
		require_once(COPIX_DB_PATH.'/drivers/'.$profil->driver.'/CopixDbResultSet.'.$profil->driver.'.class.php');
		$class = 'CopixDbConnection'.$profil->driver;

      //Cr�ation de l'objet
      $obj = & new $class ();
      $obj->profil = $profil;
      //$obj->connect ($profil);
      return $obj;
   }
}
?>
