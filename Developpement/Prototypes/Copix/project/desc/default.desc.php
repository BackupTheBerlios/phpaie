<?php
/**
* @package	copix
* @subpackage   project
* @version	$Id: default.desc.php,v 1.1 2004/07/25 22:12:58 j-charles Exp $
* @author	Croes Gérald, Jouanneau Laurent
*               see copix.aston.fr for other contributors.
* @copyright    2001-2003 Aston S.A.
* @link		http://copix.aston.fr
* @licence      http://www.gnu.org/licenses/gpl.html GNU General Public Licence, see LICENCE file
*/

/**
* Appelle la fonction membre "getWelcome" de la classe ActionGroupDefault
* Cette classe est déclarée dans le fichier project/actiongroup/default.actiongroup.php
*/
$default = & new CopixAction ('Default', 'getWelcome');
?>
