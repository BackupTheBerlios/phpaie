<?php
/**
* @package	copix
* @subpackage dbtools
* @version	$Id: CopixDbTools.oci8.class.php,v 1.1 2004/07/25 22:12:59 j-charles Exp $
* @author	Croes Gérald, Jouanneau Laurent
*           see copix.aston.fr for other contributors.
* @copyright 2001-2004 Aston S.A.
* @link		http://copix.aston.fr
* @licence  http://www.gnu.org/licenses/gpl.html GNU General Public Licence, see LICENCE file
*/

/**
 * classe d'outils pour gérer une base de données
 * @package copix
 * @subpackage dbtools
 * @todo  à revoir totalement
 */
class CopixDBToolsOci8 {
   function CopixDBToolsOci8(&$connector){
      parent::CopixDBTools($connector);
   }
   /**
   * retourne la liste des tables
   * @todo
   * @return	array	 $tab[] = $nomDeTable
   */
   function _getTableList (){
      return null;
   }
   /**
   * récupère la liste des champs pour une base donnée.
   * @todo
   * @return	array	 $tab[NomDuChamp] = obj avec prop (tye, length, lengthVar, notnull)
   */
   function _getFieldList ($tableName){
      return null;
   }
}
?>
