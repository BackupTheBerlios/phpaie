<?php
/**
* @package	copix
* @subpackage generaltools
* @version	$Id: CopixUrl.class.php,v 1.1 2004/07/25 22:12:59 j-charles Exp $
* @author	Croes Gérald, Jouanneau Laurent
*           see copix.aston.fr for other contributors.
* @copyright 2001-2004 Aston S.A.
* @link		http://copix.aston.fr
* @licence  http://www.gnu.org/licenses/gpl.html GNU General Public Licence, see LICENCE file
*/

/**
 * Objet url permettant de manipuler facilement une url
 * @package	copix
 * @subpackage core
 */
class CopixUrl {
	/**
	 * nom du script
	 * @var string
	 */
	var $scriptName;

	/**
	 * paramètres de l'url
	 * @var array
	 */
	var $params;

	/**
	 * initialise l'objet
	 * @param	string	$scriptname	nom du script
	 * @param	array	$params	parametres
	 */
	function CopixUrl($scriptname, $params = array ()){
		$this->params = $params;
		$this->scriptName = $scriptname;
	}

	/**
	 * ajoute ou redefini un paramètre url
	 * @param	string	$name	nom du paramètre
	 * @param	string	$value	valeur du paramètre
	 */
	function set($name, $value){
		$this->params[$name]=$value;
	}

	/**
	 * supprime un paramètre
	 * @param	string	$name	nom du paramètre
	 */
	function del($name){
		unset($this->params[$name]);
	}

	/**
	 * efface tout les paramètres
	 */
	function clear(){
		$this->params=array();
	}

	/**
	 * construit l'url
	 * @param	boolean	$forhtml indique si l'url est destiné à être intégré dans une balise HTML ou non
	 * @return	string	l'url formée
	 */
	function getUrl($forhtml=true){
		if(count($this->params)>0){
			$url='';
			foreach($this->params as $k=>$v){
				if($url=='')
					$url=$k.'='.$v;
				else
					$url.=($forhtml?'&amp;':'&').$k.'='.$v;
			}
			$url = $this->scriptName.'?'.$url;
		}else{
			$url = $this->scriptName;
      }
		return $url;
	}
}
?>
