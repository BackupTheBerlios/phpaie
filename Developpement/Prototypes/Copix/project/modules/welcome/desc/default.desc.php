<?php
/**
* @package	copix
* @subpackage   example
* @version	$Id: default.desc.php,v 1.1 2004/07/25 22:12:58 j-charles Exp $
* @author	Croes Gérald, Jouanneau Laurent
*               see copix.aston.fr for other contributors.
* @copyright    2001-2003 Aston S.A.
* @link		http://copix.aston.fr
* @licence      http://www.gnu.org/licenses/gpl.html GNU General Public Licence, see LICENCE file
*/

$information  = & new CopixAction ('Welcome', 'getInformation');
$registration = & new CopixAction ('Welcome', 'getRegistration');
$legalNotice  = & new CopixAction ('Welcome', 'getLegalNotice');
$default      = & $information;
?>
