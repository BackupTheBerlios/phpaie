<?php
/**
 * @package	copixmodules
 * @subpackage auth
 * @version	$Id: default.desc.php,v 1.1 2004/07/25 22:12:58 j-charles Exp $
 * @author	Croes Gérald, Jouanneau Laurent
 * @copyright 2001-2003 Aston S.A.
 * @link		http://copix.aston.fr
 * @licence  http://www.gnu.org/licenses/gpl.html GNU General Public Licence, see LICENCE file
 */
$in     = & new CopixAction ('Login', 'doLogin');//ask to log in
$out    = & new CopixAction ('Login', 'doLogout');//ask to be logged out
?>