<?php
/**
 * Smarty plugin
 * -------------------------------------------------------------
 * File:       function.checked.php
 * Type:       function
 * Name:       checked
 * Version:    1.0
 * Date:       15.04.2004
 * Purpose:    check if an Id is in an array 
 * Input:      id         identifier to check 
 *             list       array of selected identifier         
 * Author:     Pierre Raoul
 * Credits:    -
 * Examples:   {checked}
 * -------------------------------------------------------------
 * @version   
 * @package   Smarty plugins for Phpaie
 * @author    Pierre Raoul
 * @since     PHP 4.0
 * @copyright Copyright (c) 2004 Pierre Raoul : LGPL - See LICENCE
 */


/**
 * checked function
 *
 * Check if an id is in a selected id list
 *
 * @package   SmartyPlugins
 *
 * @package   Smarty plugins for Phpaie
 * @author    Pierre Raoul
 * @since     PHP 4.0
 * @copyright Copyright (c) 2004 Pierre Raoul : LGPL - See LICENCE
 */
function smarty_function_checked( $params, & $smarty )
{
    
    extract($params);
    
    if ( !isSet($id) || ($id === null) ) {
        $id=-1;
    }
    
    if ( !isSet($list) || !is_array($list) ) {
        $list=array();
    }

    if (in_array($id,$list))
        $_out='checked="checked" ' ."\n";
    else
        $_out='';
    
    return $_out;

}

?>
