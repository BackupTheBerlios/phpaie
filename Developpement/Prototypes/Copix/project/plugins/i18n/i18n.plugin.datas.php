<?php
/**
* @package	copix
* @subpackage plugins
* @version	$Id: i18n.plugin.datas.php,v 1.1 2004/07/25 22:12:59 j-charles Exp $
* @author	Jouanneau Laurent
* @copyright 2001-2004 Aston S.A.
* @link		http://copix.aston.fr
* @licence  http://www.gnu.org/licenses/gpl.html GNU General Public Licence, see LICENCE file
*/

$i18n_languages = array(
    // code => array (name , default currency code )
    // @todo enlever le 3ieme parametres quand base sera modifié
    'fr'=>array('Français', 'EUR','1'),
    'en'=>array('English',  'EUR','2')

);


$i18n_currencies = array(
    // code => array(name, symbol left, symbol right, decimal point, thousands point,
                                        // decimal_places, value, last_updated
    'EUR' => array('Euro',  '', '&euro;',   ',',    ' ',    2,  1.00000000,  '2002-12-09 11:19:14'),
    'FRF' => array('Franc', '', 'FRF',      ',',    ' ',    2,  6.55957000,  '2002-12-09 11:19:14')

);

?>
