<?php
/**
* @package	CopixWebApp
* @subpackage   -
* @version	
* @author	Pierre Raoul
*               see www.phpaie.net for other contributors.
* @copyright    2004 Pierre Raoul
* @link		http://www.phpaie.net
* @licence      see LICENCE file
*/

include_once 'utils/HttpHeader.funct.php' ;

// no given action : use action from "$default" variable
// no given description : use "default.desc.php" file  
// no given module : use "project/desc" path
http_location( 'do' ) ;
// if the above instruction doesn't work, use the next one:
//http_location( 'do.php' ) ;
?>
