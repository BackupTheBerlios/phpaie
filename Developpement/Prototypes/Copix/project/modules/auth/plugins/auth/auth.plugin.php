<?php
/**
* @package	copixmodules
* @subpackage auth
* @version	$Id: auth.plugin.php,v 1.1 2004/07/25 22:12:58 j-charles Exp $
* @author	Croes Gérald
* @copyright 2001-2004 Aston S.A.
* @link		http://copix.aston.fr
* @licence  http://www.gnu.org/licenses/gpl.html GNU General Public Licence, see LICENCE file
*/

class PluginAuth extends CopixPlugin {
    var $secure_with_ip_passed = true;//if the test has passed, if not, will redirect and destroy the session.

    /**
     * @param	class	$config		objet de configuration du plugin
     */
    function PluginAuth($config) {
        parent::CopixPlugin($config);
    }

    /**
     * surchargez cette methode si vous avez des traitements à faire, des classes à declarer avant
     * la recuperation de la session
     */
    function beforeSessionStart (){
        //inclusion de l'objet utilisateur du projet.
        require_once ($this->config->full_class_path);
    }

    /**
     * traitements à faire avant execution du coordinateur de page
     * @param	CopixAction	$action	le descripteur de page détecté.
     */
    function beforeProcess (&$execParam){
        //si sécurisation de la session par stockage du la personne ayant
        //   démarré la session.
        if ($this->config->secure_with_ip){
            if (!isset ($_SESSION[$this->config->secure_with_ip_name])){
                $_SESSION[$this->config->secure_with_ip_name] = $this->_getIpForSecure ();
            }else{
                $this->secure_with_ip_passed = ($_SESSION[$this->config->secure_with_ip_name] == $this->_getIpForSecure ());
            }
        }

        //test du passage de la session, avec sécurisation de l'ip
        if (!$this->secure_with_ip_passed){
            session_destroy ();
            $execParam = $this->config->sessionCrackRedirect;
            return false;
        }

	if (!isset ($_SESSION[$this->config->name])){
	      //créer l'objet utilisateur demandé dans le fichier de conf,
              //  sous le nom demandé.
	      $_SESSION[$this->config->name] = & new $this->config->class_name ();
        }

	//vérification des droits sur la page demandée.
	if ($_SESSION[$this->config->name]->checkAllNeededRights ($execParam->params)){
            return true;
        }else{
	      //on retourne l'utilisateur vers l'url de "Voux n'avez pas les droits pour".
	      //Ou simplement la page standard.
			$execParam = $this->config->noRightsExecParam;
			return false;
        }
    }

	/**
	 * traitements à faire apres execution du coordinateur de page
	 */
	function afterProcess (){
	}

	function _getIpForSecure (){
	   //this method is heavily based on the article found on
	   // phpbuilder.com, and from the comments on the official phpdoc.
		if (isset ($_SERVER['HTTP_X_FORWARDED_FOR']) && $_SERVER['HTTP_X_FORWARDED_FOR']){
		  $IP_ADDR = $_SERVER['HTTP_X_FORWARDED_FOR'];
	   }else if (isset ($_SERVER['HTTP_CLIENT_IP']) && $_SERVER['HTTP_CLIENT_IP']){
		  $IP_ADDR =  $_SERVER['HTTP_CLIENT_IP'];
		}else{
		  $IP_ADDR = $_SERVER['REMOTE_ADDR'];
	   }

      // get server ip and resolved it
		$FIRE_IP_ADDR = $_SERVER['REMOTE_ADDR'];
		$ip_resolved = gethostbyaddr($FIRE_IP_ADDR);
		// builds server ip infos string
	   $FIRE_IP_LITT = ($FIRE_IP_ADDR != $ip_resolved && $ip_resolved) ? $FIRE_IP_ADDR." - ". $ip_resolved : $FIRE_IP_ADDR;
		// builds client ip full infos string
		$toReturn = ($IP_ADDR != $FIRE_IP_ADDR) ? "$IP_ADDR | $FIRE_IP_LITT" : $FIRE_IP_LITT;
		return $toReturn;//$toReturn;
	}
   
   /**
   * Récupération de l'objet utilisateur.
   */
   function & getUser (){
      return $_SESSION[$this->config->name];
   }
}
?>
