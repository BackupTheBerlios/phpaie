<?php
/**
* Application entry point: lauch the front controller
*
* @package	CopixTestApp
* @subpackage   project
* @version	$Id: do.php,v 1.1 2004/07/25 22:12:58 j-charles Exp $
* @author	Croes Gérald, Jouanneau Laurent
*               see copix.aston.fr for other contributors.
* @copyright    2001-2003 Aston S.A.
* @link		http://copix.aston.fr
* @licence      http://www.gnu.org/licenses/gpl.html GNU General Public Licence, see LICENCE file
*/

// include all needed files.
// will mainly define paths relative to the actual project.
// (zones, pages, modules, plugins, ...)
require_once ('project/project.inc.php');

$controller = & ProjectCoordination::instance();
$controller->process();

?>