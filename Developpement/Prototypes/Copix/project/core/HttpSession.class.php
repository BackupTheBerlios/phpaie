<?php
/**
 * @package      phpaie
 * @subpackage   project/core
 *
 * HttpSession class, holding Session attributes
 * for framework. This is different than the php $_SESSION
 * handling, although this object *does* utilize those sessions.
 *
 * @version    $Id: HttpSession.class.php,v 1.1 2004/07/25 22:12:58 j-charles Exp $
 * @origine    Phrame
 * @author    Alex Belgraver
 */

if ( ! defined('_SESSION_STATE') ) define('_SESSION_STATE','_session_state');

class HttpSession
{
    /**
     * Constructor.
     * @access public
     */
    function HttpSession(){
        if (  ! isSet($_SESSION[_SESSION_STATE])
           || ! is_array($_SESSION[_SESSION_STATE]) 
           ) {
            $_SESSION[_SESSION_STATE] = array();
        }
    }

    /**
     * Get an instance
     * @access public
     * @return HttpSession
     */
    function & instance(){
//        return Service::instance('HttpSession');
// __CLASS__ only with PHP 4.3.0 & above
        return Service::instance('HttpSession');
    }

    /**
     * Retrieve a list of available attributes
     * @access public
     * @return array
     */
    function & getAttributeNames(){
        return array_keys($_SESSION[_SESSION_STATE]);
    }

    /**
     * Set a new session attribute
     * @param $name string
     * @param $obj object
     * @access public
     */
    function setAttribute($name, $obj){
        $_SESSION[_SESSION_STATE][$name] = $obj;
    }

    /**
     * Get a session attribute
     * @access public
     * @param $name string
     * @return mixed
     */
    function & getAttribute($name){
        return isSet($_SESSION[_SESSION_STATE][$name])?$_SESSION[_SESSION_STATE][$name]:null;
    }

    /**
     * Remove a request attribute
     * @param $name string
     * @access public
     * @return mixed
     */
    function removeAttribute($name){
        unset($_SESSION[_SESSION_STATE][$name]);
    }
}

?>
