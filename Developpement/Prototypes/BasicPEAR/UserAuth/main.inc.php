<?php

  define('HTTP_HOST', 'localhost');
//  define('HTTP_HOST', getenv('HTTP_HOST'));
 // define('WEB_ROOT', getenv('DOCUMENT_ROOT').'/~PHPAIE');
  define('WEB_ROOT', '/home/PHPAIE/www');
  define('EMAIL_WEBMASTER', 'krausbn@php.net');

  // PEAR path
 // $path_to_liveuser_dir = WEB_ROOT . '/pear/'.PATH_SEPARATOR;
 // ini_set('include_path', $path_to_liveuser_dir.ini_get('include_path'));

// print ">".__FILE__.":".__LINE__."< <br>";
  error_reporting(E_ALL ^ E_NOTICE);

  function php_error_handler($errno, $errstr, $errfile, $errline)
  {
      include_once 'HTML/Template/IT.php';
      $tpl = new HTML_Template_IT();
      $tpl->loadTemplatefile(WEB_ROOT . '/error-page.tpl.php');

      $tpl->setVariable('error_msg', "<b>$errfile ($errline)</b><br>$errstr");

      $tpl->show();
      exit();
  }
  set_error_handler('php_error_handler');

  require_once 'PEAR.php';

  function pear_error_handler($err_obj)
  {
      $error_string = $err_obj->getMessage() . '<br>' . $err_obj->getUserinfo();
      trigger_error($error_string, E_USER_ERROR);
  }
  PEAR::setErrorHandling(PEAR_ERROR_CALLBACK, 'pear_error_handler');


  function showLoginForm($liveUserObj = false)
  {
// print ">".__FILE__.":".__LINE__."< <br>";
      include_once 'HTML/Template/IT.php';
      $tpl = new HTML_Template_IT();
     // $tpl->loadTemplatefile(WEB_ROOT . '/loginform.tpl.php');
      $tpl->loadTemplatefile('loginform.tpl.php');

// print ">".__FILE__.":".__LINE__."< <br>";
      $tpl->setVariable('form_action', $_SERVER['PHP_SELF']);

      if (is_object($liveUserObj)) {
          if ($liveUserObj->status) {
              switch ($liveUserObj->status) {
                  case LIVEUSER_AUTH_ISINACTIVE:
                      $tpl->touchBlock('inactive');
                      break;
                  case LIVEUSER_AUTH_IDLED:
// print ">".__FILE__.":".__LINE__."< <br>";
                      $tpl->touchBlock('idled');
                      break;
                  case LIVEUSER_AUTH_EXPIRED:
                      $tpl->touchBlock('expired');
                      break;
                  default:
                      $tpl->touchBlock('failure');
                      break;
              }
          }
      }

      $tpl->show();
      exit();
  }


// print ">".__FILE__.":".__LINE__."< <br>";
  require_once 'DB/DB.php';

// print ">".__FILE__.":".__LINE__."< <br>";
  // Data Source Name (DSN)



  $myDB = array('localhost' => array('host' => 'localhost',
                                     'type' => 'mysql',
                                     'name' => 'yourBase',
                                     'user' => 'PHPAIE',
                                     'pwd'  => 'Passwd')
               );


// print ">".__FILE__.":".__LINE__."< <br>";
// print_r($myDB);
// print $myDB['localhost']['type'] ;
$dsn = $myDB[HTTP_HOST]['type'] . '://' .  $myDB[HTTP_HOST]['user'] . ':'   .  $myDB[HTTP_HOST]['pwd']  . '@'   .  $myDB[HTTP_HOST]['host'] . '/'   .  $myDB[HTTP_HOST]['name'];

// print ">".__FILE__.":".__LINE__."< <br>";
  $db = DB::connect($dsn, TRUE);
// print ">".__FILE__.":".__LINE__."< <br>";
  $db->setFetchMode(DB_FETCHMODE_ASSOC);

// print ">".__FILE__.":".__LINE__."< <br>";

  require_once 'HTML/Template/IT.php';
  $tpl = new HTML_Template_IT();


// print ">".__FILE__.":".__LINE__."< <br>";
  require_once 'LiveUser/LiveUser.php';
// print ">".__FILE__.":".__LINE__."< <br>";
  $LUOptions = array('autoInit'       => true,
                     'login'          => array('function' => 'showLoginForm',
                                               'force'    => true),
                     'authContainers' => array(array('type'          => 'DB',
                                                     'connection'    => $db,
                                                     'loginTimeout'  => 0,
                                                     'expireTime'    => 3600,
                                                     'idleTime'      => 1800,
                                                     'allowDuplicateHandles' => 0,
                                                     'authTable'     => 'liveuser_users',
                                                     'authTableCols' => array('user_id'       => 'auth_user_id',
                                                                              'handle'       => 'handle',
                                                                              'passwd'     => 'passwd',
                                                                              'lastlogin'    => 'lastlogin'
                                                                             ),
      									            'passwordEncryptionMode' => 'PLAIN'
                                                    )
                                              ),
                     'permContainer'  => array('type'       => 'DB_Complex',
                                               'connection' => $db,
                                               'prefix'     => 'liveuser_')
                    );   
// print ">".__FILE__.":".__LINE__."< <br>";
  $LU = LiveUser::factory($LUOptions);

// print ">".__FILE__.":".__LINE__."< <br>";
  define('AREA_NEWS',          1);
  define('RIGHT_NEWS_NEW',     1);
  define('RIGHT_NEWS_CHANGE',  2);
  define('RIGHT_NEWS_DELETE',  3);

?>
