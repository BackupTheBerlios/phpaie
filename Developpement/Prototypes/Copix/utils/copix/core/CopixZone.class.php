<?php
/**
* @package	copix
* @subpackage core
* @version	$Id: CopixZone.class.php,v 1.1 2004/07/25 22:12:59 j-charles Exp $
* @author	Croes Gérald, Jouanneau Laurent
*           see copix.aston.fr for other contributors.
* @copyright 2001-2004 Aston S.A.
* @link		http://copix.aston.fr
* @licence  http://www.gnu.org/licenses/gpl.html GNU General Public Licence, see LICENCE file
*/

/**
* Squelette d'un objet capable de gérer une zone avec un cache.
*
* @package	copix
* @subpackage core
* @abstract
* @see CopixCoordination
*/
class CopixZone {
      
   var $_useCache = false;
	/**
	* nom des parametres de la zone permettant de l'identifiant de façon unique
	* @var array
	*/
	var $_cacheParams = array ();
	
   /**
   * Paramètres d'exécution passés à la zone.
   */
   var $params;

   /**
   * Replaces the old (and long) syntax $GLOBALS['COPIX']['COORD']->processZone (something, $params);
   * is'nt this cleaner: CopixZone::process (something, $params); ?
   * @static
   */
   function process ($name, $params=array ()){
     return $GLOBALS['COPIX']['COORD']->processZone ($name, $params);
   }

   /**
   * Replaces the old (and long) syntax $GLOBALS['COPIX']['COORD']->clearZone (something, $params);
   * is'nt this cleaner: CopixZone::clear (something, $params); ?
   * @static
   */
   function clear ($name, $params=array ()){
     return $GLOBALS['COPIX']['COORD']->clearZone ($name, $params);
   }

   /**
	* Méthode qui gère la zone
	* Selon si le cache doit être utilisé, et est valide ou non, on retournera le contenu du cache
	* ou on calculera la zone puis la retournera après l'avoir stockée de nouveau dans le cache
	* @param array  $Params les paramètres de contexte pour la zone. (généralement le contenu de l'url)
	* @return   string  le contenu de la zone
	* @access public
	*/
   function processZone ($params = array ()){
      $this->params = $params;

      //if (count ($this->_cacheParams) > 0){
      if ($this->_useCache){
         $module=CopixContext::get ();
         if($module .= '') $module.='_';

         $cache = & new CopixCache ($this->_makeId (), 'Zones|'.$module.get_class($this));
         if(!$contents = $cache->read ()){
            if ($this->_createContent($contents)){
               $cache->write($contents);
            }
         }
         unset ($cache);
		}else{
         $this->_createContent($contents);
      }
      return $contents;
   }


   /**
	* Méthode qui efface le cache de la zone
	* @param array  $Params les paramètres de contexte pour la zone.
	* @return   boolean  si tout s'est bien passé
	* @access public
	*/
	function clearZone ($params = array ()){
      $this->params = $params;

      //if (count ($this->_cacheParams) > 0){
      if ($this->_useCache){
         $module=CopixContext::get ();
         if($module .= '') $module.='_';

         $cache = & new CopixCache ($this->_makeId (), 'Zones|'.$module.get_class($this));
         $cache->remove();
      }
      return true;
   }

   /**
   * Méthode de création de contenu pour la zone.
   *
   * Contient le processus de récupération et de création de contenu a partir des paramètres donnés.
   * C'est cette méthode qui sera invoquée par processZone pour créer le contenu
   * s'il n'existe pas en cache
   * @param string	$ToReturn	contient le contenu de la zone, à recuperer aprés appel de la methode
   * @return boolean	indique si on peut mettre le contenu généré en cache ou pas
   * @access protected
   * @abstract
   */
	function _createContent (&$toReturn){
		return false;
	}
	
   /**
   * création de l'identifiant à partir des paramètres de la zone.
   * @access private
   */
   function _makeId (){
      $toReturn = array ();
      foreach ($this->_cacheParams as $key){
         $toReturn[$key] = isset ($this->params[$key]) ? $this->params[$key] : null;
      }
      return $toReturn;
	}
}
?>
