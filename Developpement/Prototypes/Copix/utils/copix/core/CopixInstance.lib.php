<?php
/**
* @subpackage core
* @package	copix
* @version	$Id: CopixInstance.lib.php,v 1.1 2004/07/25 22:12:59 j-charles Exp $
* @author	Croes Gérald, Jouanneau Laurent
*           see copix.aston.fr for other contributors.
* @copyright 2001-2004 Aston S.A.
* @link		http://copix.aston.fr
* @licence  http://www.gnu.org/licenses/gpl.html GNU General Public Licence, see LICENCE file
*/

/**
* nom de la variable de session qui contient la liste des instances d'objet
*/
define('CPX_INSTANCE_NAME','CPXInstances');

if(!isset($GLOBALS[CPX_INSTANCE_NAME])){
	$GLOBALS[CPX_INSTANCE_NAME]=array();
}

/**
* retourne l'instance d'un objet
* creer une instance si l'objet n'existe pas
* si la classe correspondante n'est pas chargée (incluse), son fichier est inclus.
* le fichier nommé nomdelaclasse.class.php, doit se trouver dans l'un des chemins indiqués dans include_path
* @param	string	$name	nom de la classe de l'objet
* @return	&object	a reference to the object. don't forget ! use the =& operator to assign to a variable, or you'll have a copy of the object, not itself
*/
function  & get_instance($name){
	if(!isset($GLOBALS[CPX_INSTANCE_NAME][$name])){
        require_once($name.'.class.php');
		$GLOBALS[CPX_INSTANCE_NAME][$name] = & new $name;
	}
	return $GLOBALS[CPX_INSTANCE_NAME][$name];
}


/**
* enregistre un objet dans l'instanceur
* Si il existe un objet du meme type en instance, l'objet n'est pas enregistré (renvoi false)
* @param	object	$object		objet à enregistrer
* @return	boolean		indique si tout s'est bien passé
*/
function set_instance(&$object){
	$name=get_class($object);
	if(!isset($GLOBALS[CPX_INSTANCE_NAME][$name])){
		$GLOBALS[CPX_INSTANCE_NAME][$name] = $object;
		return true;
	}else{
		return false;
	}
}
?>
