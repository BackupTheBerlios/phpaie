<?php
/**
* @package	copix
* @subpackage dbtools
* @version	$Id: CopixDbTools.mysql.class.php,v 1.1 2004/07/25 22:12:59 j-charles Exp $
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
 */
class CopixDBToolsMySQL {
   function CopixDBToolsMySQL(&$connector){
      parent::CopixDBTools($connector);
   }

   /**
   * retourne la liste des tables
   * @return	array	 $tab[] = $nomDeTable
   */
   function _getTableList (){
      $results = array ();

      $rs = $this->connector->doQuery ('SHOW TABLES FROM '.$this->profil->name);
      $col_name = 'Tables_in_'.$this->connector->profil->name;

      while ($line = $rs->fetchObject ()){
         $results[] = $line->$col_name;
      }

      return $results;
   }

   /**
   * récupère la liste des champs pour une base donnée.
   * @return	array	 $tab[NomDuChamp] = obj avec prop (tye, length, lengthVar, notnull)
   */
   function _getFieldList ($tableName){
      $results = array ();

      $sql_get_fields = 'SHOW FIELDS FROM ' . $tableName;
      $rs = $this->connector->doQuery ($sql_get_fields);

      while ($result_line = $rs->fetchObject ()){
         $p_result_line->type      = $result_line->Type;
         $type = $result_line->Type;

          /**
          * récupéré depuis phpMyAdmin
          */
          // set or enum types: slashes single quotes inside options
          $type   = eregi_replace('BINARY', '', $type);
          $type   = eregi_replace('ZEROFILL', '', $type);
          $type   = eregi_replace('UNSIGNED', '', $type);

          if (eregi('^(set|enum)\((.+)\)$', $type, $tmp)){
              $type   = $tmp[1];
              $length = substr(ereg_replace('([^,])\'\'', '\\1\\\'', ',' . $tmp[2]), 1);
          }else{
              $length = $type;
              $type   = chop(eregi_replace('\\(.*\\)', '', $type));
              if (!empty($type)){
                  $length = eregi_replace("^$type\(", '', $length);
                  $length = eregi_replace('\)$', '', trim($length));
              }
              if ($length == $type){
                  $length = '';
              }
          }

          /**
          * Fin récupéré depuis phpMyADmin
          */
          $p_result_line->length    = $length;
          $p_result_line->notnull   = (strcmp (trim ($result_line->Null), 'YES') == 0);
          $p_result_line->is_index  = (strcmp(trim ($result_line->Key), 'PRI') == 0);
          $results[$result_line->Field] = $p_result_line;
      }
      return $results;
   }
}
?>
