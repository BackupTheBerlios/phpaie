<?php
/**
* @package	copix
* @subpackage dbtools
* @version	$Id: CopixDbTools.postgresql.class.php,v 1.1 2004/07/25 22:12:59 j-charles Exp $
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
class CopixDBToolsPostgreSQL {
   function CopixDBToolsPostgreSQL(&$connector){
      parent::CopixDBTools($connector);
   }
   /**
   * retourne la liste des tables
   * @return	array	 $tab[] = $nomDeTable
   */
   function _getTableList (){
      $results = array ();
      $sql = "SELECT tablename FROM pg_tables WHERE tablename NOT LIKE 'pg_%' ORDER BY tablename";
      $rs = $this->doQuery ($sql);
      while ($line = $rs->fetchObject ()){
         $results[] = $line->tablename;
      }
      return $results;
   }
   /**
   * récupère la liste des champs pour une base donnée.
   * @return	array	 $tab[NomDuChamp] = obj avec prop (tye, length, lengthVar, notnull)
   */
   function _getFieldList ($tableName){
      $results = array ();
      $sql_get_fields = "SELECT
					a.attname, t.typname as type, a.attlen, a.atttypmod, a.attnotnull, a.atthasdef,
					(SELECT adsrc FROM pg_attrdef adef WHERE a.attrelid=adef.adrelid AND a.attnum=adef.adnum) AS adsrc
				FROM
					pg_attribute a,
					pg_class c,
					pg_type t
				WHERE
					c.relname = '{$tableName}' AND a.attnum > 0 AND a.attrelid = c.oid AND a.atttypid = t.oid
				ORDER BY a.attnum";

      $results = $this->getAll ($sql_get_fields);

      return $results;
   }
}
?>
