<?php
// $Id: conf2.php,v 1.1 2004/03/17 11:33:53 j-charles Exp $

// BC hack
if(!defined('PATH_SEPARATOR')) {
    if(defined('DIRECTORY_SEPARATOR') && DIRECTORY_SEPARATOR == "\\") {
        define('PATH_SEPARATOR', ';');
    } else {
        define('PATH_SEPARATOR', ':');
    }
}

// set this to the path in which the directory for liveuser resides
// more remove the following two lines to test LiveUser in the standard
// PEAR directory
$path_to_liveuser_dir = $_SERVER['DOCUMENT_ROOT'].'/PEAR/'.PATH_SEPARATOR;
ini_set('include_path', $path_to_liveuser_dir.ini_get('include_path'));

$liveuserConfig = array('session'           => array('name' => 'PHPSESSID','varname' => 'loginInfo'),
                        'login'             => array('username' => 'handle', 'password' => 'passwd', 'function' => 'PhpaieLogin'),
//                        'logout'            => array('trigger' => 'logout', 'redirect' => 'loginscreen.php'),
                        'cookie'            => array('name' => 'loginInfo', 'path' => '/', 'domain' => 'localhost', 'lifetime' => 30),
                        'autoInit'          => true,
                        'authContainers'    => array(0 => array('type' => 'XML',
                                                                'file' => $_SERVER['DOCUMENT_ROOT'].'/modules/examples/example2/Auth_XML.xml',
//                                                                'file' => $_SERVER['DOCUMENT_ROOT'].'/PEAR/LiveUser/examples/example2/Auth_XML.xml',
                                                                'loginTimeout' => 0,
                                                                'expireTime'   => 3600,
                                                                'idleTime'     => 1800,
                                                                'allowDuplicateHandles'  => 0,
                                                                'passwordEncryptionMode' => 'MD5'
                                                               )
                                                    ),
                        'permContainer'     => array('type'   => 'XML_Simple',
                                                                'file' => $_SERVER['DOCUMENT_ROOT'].'/modules/examples/example2/Perm_XML.xml',
//                                                     'file' => $_SERVER['DOCUMENT_ROOT'].'/PEAR/LiveUser/examples/example2/Perm_XML.xml'
                                                    )
                       );
?>