<?php
/**
* @package	copix
* @subpackage dbtools
* @version	$Id: CopixObjectDbProperties.class.php,v 1.1 2004/07/25 22:12:59 j-charles Exp $
* @author	Jouanneau Laurent
* @copyright 2001-2004 Aston S.A.
* @link		http://copix.aston.fr
* @licence  http://www.gnu.org/licenses/gpl.html GNU General Public Licence, see LICENCE file
*/

/**
* classe non officielle
*/

if(!defined('COPIXDB_TYPE_INTEGER')){
   define('COPIXDB_TYPE_INTEGER' , 0x01);
   define('COPIXDB_TYPE_FLOAT' , 0x02);
   define('COPIXDB_TYPE_BOOLEAN' , 0x03);
   define('COPIXDB_TYPE_STRING', 0x04);
   define('COPIXDB_TYPE_BOOLEAN_STR', 0x0103);
   define('COPIXDB_TYPE_BOOLEAN_YN' , 0x0203);
   define('COPIXDB_TYPE_BOOLEAN_01' , 0x0303);
   define('COPIXDB_TYPE_BOOLEAN_BOOL' , 0x0403);
}


class CopixObjectDbProperties {



   // nom du champs dans la table => propri�t� objet
   var $fieldPropList = array ();

   // nom de la table
   var $table     = '';

   // id du champs cl� primaire
   var $fieldKey = '';

   // liste des types de chaque champs
   //    nom du champs => COPIXDB_TYPE_*
   var $fieldTypeList = array();

   // liste des fonctions SQL � appliquer lors de l'insert/update
   //    nom du champs => 'chaine pour sprintf, avec %s indiquant l'emplacement de la valeur'
   var $appliedFunctionToIUList = array();

   // liste des fonctions SQL � appliquer lors du select
   var $appliedFunctionToSelectList = array();



}



?>
