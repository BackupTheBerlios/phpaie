<?php 
//********************************************************************
// phpaie 
//------------------------------------------------------------------
// Version: 0.1
//
// Copyright (c) 2002 by Jean-Charles Gibier (~Le Mulot Fou~)
// (http://www.phpaie.net)
// (webmaster@machinbidule.com)
//
// Support éventuel sur www.phpaie.net
//*********************************************************************
// This program is free software. You can redistribute it and/or modify
// it under the terms of the GNU Lesser General Public License as 
// published by the Free Software Foundation.
//*********************************************************************
?>
<?php
//Initialisation de la session [INIT_PAGE]
require_once("LIVEUSER1LOGIN_def.php");
require_once("../inc/session_libre.php");
//Trail code ($tr_code)

require_once('conf.php');

// Get LoginManager class definition
require_once 'LiveUser/LiveUser.php';


// Create new LiveUser (LoginManager) object.
// We´ll only use the auth container, permissions are not used.
$LU = LiveUser::factory($liveuserConfig);
//$LU = LiveUser::factory(array());

function PhpaieLogin()
{
$pg_LIVEUSER1LOGIN = new LIVEUSER1LOGIN( ( isset( $_POST ) && array_count_values($_POST) ) ? $_POST : $_GET );
//Récupération des variables pour le formulaire
$pg_LIVEUSER1LOGIN->pageDisplay("");
//exit();
} // end func testLogin
// This sets a callback function if the user hasn't logged in yet
$LU->setLoginFunction('PhpaieLogin');
//$LU->setLogoutFunction('PhpaieLogin');

// This sets a callback function when the user tries to logout.
// In our case it's ok to use the same function.

/**
 * Example callback function on logging in
 */

$LU->init();
 
// Check if the user has logged in successfully
if (!$LU->isLoggedIn()) {
    // The user couldn't login, so let's check if the reason was that
    // he's not yet been declared "valid" by an administrator.
    if ($LU->isInactive()) {
        echo "<h3>Sorry kid, but one of our admins has yet to approve ";
        echo "your user status. Please be patient. Don't call us - ";
        echo "we'll call you.</h3>";
    } else {
        echo "<h3>Sorry, we can't let you in. Check if the spelling of ";
        echo "your handle and password is correct.</h3>";
    }
    echo '<p>&nbsp;</p>';
    echo '<p><i>Login Data for this Example:</i></p>';
    echo '<table border="1">';
    echo '  <tr>';
    echo '    <th width="100">Handle</th>';
    echo '    <th width="100">Password</th>';
    echo '  </tr>';
    echo '  <tr>';
    echo '    <td width="100">father</td>';
    echo '    <td width="100">father</td>';
    echo '  </tr>';
    echo '  <tr>';
    echo '    <td width="100">mother</td>';
    echo '    <td width="100">mother</td>';
    echo '  </tr>';
    echo '  <tr>';
    echo '    <td width="100">child</td>';
    echo '    <td width="100">child</td>';
    echo '  </tr>';
    echo '</table>';
} else {
    // Okay, he's in.
    echo '<h2 align="center">User logged in: '.$LU->getHandle().'</h2>';
    echo "<h3>Congrats, you're in</h3>";
// Show logout link.
echo '<p align="center"><a href="liveuser1login.php?logout=1">Logout</a></p>';
}


// Just some more debug output with no further relevance
echo '<hr><pre>';
print_r($LU);
echo '<hr>';
print_r($_SESSION);
echo '<hr>';
print_r($_POST);
echo '</pre>';

echo '<br>Handle:';
print_r($LU->getHandle());
echo '<br>User Type:';
print_r($LU->getProperty('userType'));

?>
