<?php
/**
 * Test for the LoginManager class
 * ===============================
 *
 * This example sets up an authorization system using the LoginManager
 * class. You don't have to use this to use the LiveUser class(es), but
 * this way you don't need to take care of the login-process, storing
 * the user object in a session and more...
 *
 * This example is intended to be used with the DB_Medium Perm driver.
 *
 * @version $Id: gestion.php,v 1.2 2004/07/20 21:33:14 j-charles Exp $
 **/
error_reporting(E_ALL);

// right definitions
define('READ_TESTS', 1);
define('WRITE_TESTS', 2);

// Include configuration.
require_once 'conf3.php';
// Get LoginManager class definition
require_once 'LiveUser/LiveUser.php';

// The error handling stuff is not needed and used only for debugging
// while LiveUser is not yet mature
PEAR::setErrorHandling(PEAR_ERROR_CALLBACK, 'eHandler');

function eHandler($errObj)
{
//    echo('<hr><font color=red>'.$errObj->getMessage().':<br>'.$errObj->getUserinfo().'</font><hr>');
}

// Create new LoginManager object
$LU = LiveUser::factory($liveuserConfig);
?>
<html>
<head>
<title>Example gestion</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body bgcolor="#FFFFFF">
<h1>gestion</h1>
<p>&nbsp;</p>
<?php
if(!$LU->isLoggedIn()) {
    $target = 'gestion.php';
    include_once('loginscreen.php');
    exit();
} else {
    if (!$LU->checkRight(READ_TESTS) && !$LU->checkRight(WRITE_TESTS)) {
        echo "<p>Vous navez pas les droits pour cette section (domaine)</p>";
    } else {
        if ($LU->checkRight(READ_TESTS)) {
           echo "<pre>Bonjour <br>Bienvenue<br>";
           echo "<p>Vous avez le droit de<b>lire</b> cette section.<br>";
           echo "Votre dernière connection date du ...</p>";
           echo "<p>User: <b>".$LU->getProperty('handle')."</b><br>LastLogin: <b>".strftime('%Y-%m-%d %H:%M', $LU->getProperty('lastLogin'))."</b><br>";
           echo "etc ...</pre>";
        }
    }
}
?>
<p>&nbsp;</p>
<p>
  <textarea name="textfield" cols="80" rows="10"<?php
  // let's see if the user is allowed to post something
  if ($LU->checkRight(WRITE_TESTS)) {
     echo '>'; # end the textarea tag
     echo 'Vous avez les droits en écriture.';
  } else {
     echo ' disabled>'; # disable the textarea tag
     echo "Vous n'avez pas les droits en écriture.";
  }
?>
  </textarea>
</p>
<p>&nbsp;</p>
<p align="center"><a href="gestion.php?logout=1">Logout</a></p>
</body>
</html>