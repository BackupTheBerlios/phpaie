<?php
/**
* @package	copix
* @subpackage generaltools
* @version	$Id: CopixDate.lib.php,v 1.1 2004/07/25 22:12:59 j-charles Exp $
* @author	Croes G�rald, Jouanneau Laurent
*           see copix.aston.fr for other contributors.
* @copyright 2001-2004 Aston S.A.
* @link		http://copix.aston.fr
* @licence  http://www.gnu.org/licenses/gpl.html GNU General Public Licence, see LICENCE file
*/

/**
* convertit une date format fr au format mysql. (a utiliser avant l'envois vers mysql)
* @param   string  $DateToConvert  La date a convertir.
* @param   string  $SplitChar      le caract�re de s�paration utilis� dans $DateToConvert. (facultatif)
* @return  string  La chaine de caract�re compr�hensible par mysql.
*/
function dateFrToMySQL ( $DateToConvert, $SplitChar='/'){
   return dateFrToBd($DateToConvert, $SplitChar);
}
/**
 * convertit une date format fr au format mysql. (a utiliser avant l'envois vers mysql)
 * @param  string   $DateToConvert  La date a convertir.
 * @param  string   $SplitChar      le caract�re de s�paration utilis� dans $DateToConvert. (facultatif)
 * @return string   La chaine de caract�re compr�hensible par mysql.
 */
function dateFrToBd ($DateToConvert, $SplitChar='/'){
   if ($DateToConvert == ''){
      return '';
   }
   $tmp = explode ($SplitChar, $DateToConvert);
   return $tmp[2].'-'.$tmp[1].'-'.$tmp[0];
}
/**
 * convertit une date format mysql au format fr. (a utiliser a la r�ception des donn�es MySql)
 * @param  string   $DateToConvert  La date a convertir.
 * @param  string   $FrSplitChar     le caract�re de s�paration utilis� dans le format fran�ais (facultatif)
 * @return string   La chaine de caract�re compr�hensible par mysql.
 */
function dateMySQLToFr ($DateToConvert, $FrSplitChar='/'){
   return dateBdToFr($DateToConvert, $FrSplitChar);
}
/**
 * convertit une date format mysql au format fr. (a utiliser a la r�ception des donn�es d'un sgbd)
 * @param  string   $DateToConvert   La date a convertir.
 * @param  string   $FrSplitChar     le caract�re de s�paration utilis� dans le format fran�ais (facultatif)
 * @param  string   $BdSplitChar     le caract�re de s�paration utilis� dans le format base de donn�e (facultatif)
 * @return string   La chaine de caract�re compr�hensible par mysql.
 */
function dateBdToFr ( $DateToConvert, $FrSplitChars='/', $BdSplitChar='-'){
   if ($DateToConvert == ''){
      return '';
   }
   $tmp = substr ($DateToConvert, 0, 10);
   $tmp = explode ($BdSplitChar, $tmp);
   return $tmp[2].$FrSplitChars.$tmp[1].$FrSplitChars.$tmp[0];
}

/**
 * Calcul le laps de temps �coul� entre deux dates.
 * @param   string  $DteMin     la date a soustraire de DteMax Chaine au format Fr jj/mm/aaaa.
 * @param   string  $DteMax     la date d'ou soustraire DteMin Chaine au format Fr jj/mm/aaaa.
 * @param   string  $SplitChar  le caractere s�parateur utilis� dans les dates (par defaut : /)
 * @return integer  Positif Max > Min, Negatif Max < Min, 0 Max = Min.
 */
function timeBetween ($DteMin, $DteMax, $SplitChar='/'){
   $MinTable = explode ($SplitChar, $DteMin);
   $MaxTable = explode ($SplitChar, $DteMax);
   $Between = mktime (0,0,0,$MaxTable[1], $MaxTable[0], $MaxTable[2]) - mktime (0,0,0,$MinTable[1], $MinTable[0], $MinTable[2]);
   return $Between;
}

/**
 * Ajoute un nombre de jours/mois/ann�es � une date et retourne la nouvelle date obtenue.
 * @param  string    $ToDate    La date que l'on va incr�menter. Format Fr.
 * @param  integer   $Day       le nombre de jours � ajouter.
 * @param  integer   $Month     le nombre de mois a ajouter.
 * @param  integer   $year      le nombre d'ann�es � ajouter.
 * @param   string  $SplitChar  le caractere s�parateur utilis� dans les dates (par defaut : /)
 * @return string   La date modifi�e. Format fr jj-mm-aaaa.
 */
function addToDate ($ToDate, $Day, $Month=0, $Year=0, $SplitChar='/') {
   $TblToDate = explode ($SplitChar, $ToDate);//Tableau avec les valeurs actuelles.
   $BeforeTime = mktime (0, 0, 0, $TblToDate[1], $TblToDate[0], $TblToDate[2]);//Cr�ation d'une marque temps avec l'ancienne date.
   $NewValue = $BeforeTime + mktime (0, 0, 0, $Month, $Day, $Year);
   return date('d'.$SplitChar.'m'.$SplitChar.'Y', $NewValue);//Reconversion de la valeur en format date.
}
?>
