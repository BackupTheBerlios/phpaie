<?php
/**
 * Smarty plugin
 * -------------------------------------------------------------
 * File:       function.dummy.php
 * Type:       function
 * Name:       dummy
 * Version:    1.0
 * Date:       15.04.2004
 * Purpose:    No one...
 * Input:               
 * Author:     Pierre Raoul
 * Credits:    
 * Examples:   {dummy}
 * -------------------------------------------------------------
 * @version   
 * @package   Smarty plugins for Phpaie
 * @author    Pierre Raoul
 * @since     PHP 4.0
 * @copyright Copyright (c) 2004 Pierre Raoul : LGPL - See LICENCE
 */


/**
 * Dummy function
 *
 * Do nothing
 *
 * @package   SmartyPlugins
 *
 * @package   Smarty plugins for Phpaie
 * @author    Pierre Raoul
 * @since     PHP 4.0
 * @copyright Copyright (c) 2004 Pierre Raoul : LGPL - See LICENCE
 */
function smarty_function_dummy( $params, & $smarty )
{

	return '<b>dummy</b>';

}

?>
