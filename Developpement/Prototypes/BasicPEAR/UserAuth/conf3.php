<?php
// $Id: conf3.php,v 1.3 2004/07/20 21:33:14 j-charles Exp $
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
//$path_to_liveuser_dir = './pear/'.PATH_SEPARATOR;
//ini_set('include_path', $path_to_liveuser_dir.ini_get('include_path'));

$liveuserConfig = array(
    'session'           => array('name' => 'PHPSESSID','varname' => 'loginInfo'),
    'login'             => array('username' => 'handle', 'password' => 'passwd', 'remember' => 'rememberMe'),
    'logout'            => array('trigger' => 'logout'),
    'cookie'            => array('name' => 'loginInfo', 'path' => '/', 'domain' => '', 'lifetime' => 30, 'secret' => 'mysecretkey'),
    'autoInit'          => true,
    'authContainers'    => array(0 => array(
        'type' => 'DB',
                  'dsn' => array('username' => 'PHPAIE',
                                 'password' => 'Koly76Xobo69',
                                 'hostspec' => 'localhost',
                                 'phptype'  => 'mysql',
                                 'database' => 'PHPAIE_LOGO'
                                 ),
                  'loginTimeout' => 0,
                  'expireTime'   => 0,
                  'idleTime'     => 0,
                  'allowDuplicateHandles'  => 1,
                  'authTable'     => 'INSCRIPTION',
                  'authTableCols' => array('user_id'    => 'ID_INSCRIPTION',
                  'handle'    => 'INSCRIPTION_PSEUDO_CKEY_VCH',
                  'passwd'  => 'INSCRIPTION_PASSWORD_VCH'),
                  'passwordEncryptionMode' => 'PLAIN'
                   ),

                  'passwordEncryptionMode' => 'PLAIN'
    )
                                ),
    'permContainer' => array(
        'type'   => 'DB_Complex',
                  'dsn' => array('username' => 'PHPAIE',
                                 'password' => 'Koly76Xobo69',
                                 'hostspec' => 'localhost',
                                 'phptype'  => 'mysql',
                                 'database' => 'PHPAIE_LOGO'
                                 ),
         'prefix' => 'liveuser_'
                )
);
?>
