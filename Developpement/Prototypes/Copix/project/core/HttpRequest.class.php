<?php
/**
 * @package      phpaie
 * @subpackage   project/core
 *
 * Class for holding Request State.
 *
 * @version    $Id: HttpRequest.class.php,v 1.1 2004/07/25 22:12:58 j-charles Exp $
 * @origine    Phrame
 * @author     Alex Belgraver
 */
class HttpRequest
{

    /** Array holding request state */
    var $requestState;

    /**
     * Constructor.
     * @access public
     */
    function HttpRequest() {
        $this->requestState = array();
        $this->_mapRequest();
    }

    /**
     * Get an instance
     * @access public
     * @return HttpRequest
     */
    function & instance(){
//        return Service::instance('HttpRequest');
// __CLASS__ only with PHP 4.3.0 & above
        return Service::instance('HttpRequest');
    }

    /**
     * map $_REQUEST to this object.
     * @access private
     */
    function _mapRequest(){
        while (list($key,$value) = each($_REQUEST)) {
            $this->setAttribute($key, $value);
        }
    }

    /**
     * Retrieve an HttpSession object.
     * @access public
     * @return HttpSession
     */
    function & getSession(){
        return HttpSession::instance();
    }

    /**
     * Retrieve a list of available attributes
     * @access public
     * @return array
     */
    function & getAttributeNames(){
        return array_keys($this->requestState);
    }

    /**
     * Set a new request attribute
     * @param $name string
     * @param $obj object
     * @access public
     */
    function setAttribute($name, $obj){
        $this->requestState[$name] = $obj;
    }

    /**
     * Get a request attribute
     * @access public
     * @param $name string
     * @return mixed
     */
    function & getAttribute($name){
        return isSet($this->requestState[$name])?$this->requestState[$name]:null;
    }

    /**
     * Remove a request attribute
     * @access public
     * @param $name string
     * @return mixed
     */
    function removeAttribute($name){
        unset($this->requestState[$name]);
    }

    /**
     * Returns the session ID of this request.
     * @access public
     * @return string
     */
    function getRequestedSessionId(){
//        return $_COOKIE[session_name()];
        return session_id();
    }

    /**
     * Get the path of the request from the environment.
     * @access public
     * @return string
     */
    function getContextPath()
    {
        return substr($_SERVER["SCRIPT_NAME"],0,strrpos($_SERVER["SCRIPT_NAME"],"/"));
    }

    /**
     * Get path information from the environment.
     * @access public
     * @return string
     */
    function getPathInfo()
    {
        $contextPath = $this->getContextPath();
        $pos=strpos($_SERVER["REQUEST_URI"],$contextPath);
        return substr($_SERVER["REQUEST_URI"],$pos+strlen($contextPath));
    }

    /**
     * Give all the parametres in a array
     * @access public
     * @return array
     */
    function & toArray()
    {
        return $this->requestState;
    }

}

?>
