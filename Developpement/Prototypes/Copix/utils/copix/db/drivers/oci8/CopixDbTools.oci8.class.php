<?php
/**
* @package	copix
* @subpackage dbtools
* @version	$Id: CopixDbTools.oci8.class.php,v 1.1 2004/07/25 22:12:59 j-charles Exp $
* @author	Croes G�rald, Jouanneau Laurent
*           see copix.aston.fr for other contributors.
* @copyright 2001-2004 Aston S.A.
* @link		http://copix.aston.fr
* @licence  http://www.gnu.org/licenses/gpl.html GNU General Public Licence, see LICENCE file
*/

/**
 * classe d'outils pour g�rer une base de donn�es
 * @package copix
 * @subpackage dbtools
 * @todo  � revoir totalement
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
   * r�cup�re la liste des champs pour une base donn�e.
   * @todo
   * @return	array	 $tab[NomDuChamp] = obj avec prop (tye, length, lengthVar, notnull)
   */
   function _getFieldList ($tableName){
      return null;
   }
}
?>
