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
require_once("LIVEUSER2LOGIN_def.php");
require_once("../inc/session_libre.php");
//Trail code ($tr_code)

require_once('conf2.php');

// Get LoginManager class definition
require_once 'LiveUser/LiveUser.php';


// Create new LiveUser (LoginManager) object.
// We´ll only use the auth container, permissions are not used.
$LU = LiveUser::factory($liveuserConfig);
//$LU = LiveUser::factory(array());

function PhpaieLogin()
{
$pg_LIVEUSER2LOGIN = new LIVEUSER2LOGIN( ( isset( $_POST ) && array_count_values($_POST) ) ? $_POST : $_GET );
//Récupération des variables pour le formulaire
$pg_LIVEUSER2LOGIN->pageDisplay("");
//exit();
} // end func testLogin
define('COOKING', 1);
define('WASHTHEDISHES', 2);
define('WATCHTV', 3);
define('WATCHLATENIGHTTV', 4);
define('USETHECOMPUTER', 5);
define('CONNECTINGTHEINTERNET', 6);



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
    // Okay, he's in. Let's display a cross table with his rights.
    echo '<h2 align="center">User logged in: '.$LU->getHandle().'</h2>';
    echo "<p>You can see user's rights in the table.</p>";

    echo '<table border="1" align="center">';
    echo '  <tr>';
    echo '    <th>right / room</th>';
    echo '    <th>kitchen</th>';
    echo '    <th>livingroom</th>';
    echo '    <th>office</th>';
    echo '  </tr>';


    /**
     * Let's check the rights in the kitchen.
     */

    echo '  <tr align="center">';
    echo '    <th>cooking</th>';
    // check whether the user has the required right
    if ($LU->checkRight(COOKING)) {
        echo '    <td><b>X</b></td>';
    } else {
        echo '    <td>&nbsp;</td>';
    }
    echo '    <td>&nbsp;</td>';
    echo '    <td>&nbsp;</td>';
    echo '  </tr>';
    echo '  <tr align="center">';
    echo '    <th>wash the dishes</th>';
    // check whether the user has the required right
    if ($LU->checkRight(WASHTHEDISHES)) {
        echo '    <td><b>X</b></td>';
    } else {
        echo '    <td>&nbsp;</td>';
    }
    echo '    <td>&nbsp;</td>';
    echo '    <td>&nbsp;</td>';
    echo '  </tr>';


    /**
     * Let's check the rights in the livingroom.
     */

    echo '  <tr align="center">';
    echo '    <th>watch TV</th>';
    echo '    <td>&nbsp;</td>';
    // check whether the user has the required right
    if ($LU->checkRight(WATCHTV)) {
        echo '    <td><b>X</b></td>';
    } else {
        echo '    <td>&nbsp;</td>';
    }
    echo '    <td>&nbsp;</td>';
    echo '  </tr>';
    echo '  <tr align="center">';
    echo '    <th>watch latenight TV</th>';
    echo '    <td>&nbsp;</td>';
    // check whether the user has the required right
    if ($LU->checkRight(WATCHLATENIGHTTV)) {
        echo '    <td><b>X</b></td>';
    } else {
        echo '    <td>&nbsp;</td>';
    }
    echo '    <td>&nbsp;</td>';
    echo '  </tr>';


    /**
     * Let's check the rights in the office.
     */

    echo '  <tr align="center">';
    echo '    <th>use the computer</th>';
    echo '    <td>&nbsp;</td>';
    echo '    <td>&nbsp;</td>';
    // check whether the user has the required right
    if ($LU->checkRight(USETHECOMPUTER)) {
        echo '    <td><b>X</b></td>';
    } else {
        echo '    <td>&nbsp;</td>';
    }
    echo '  </tr>';
    echo '  <tr align="center">';
    echo '    <th>connecting to the internet</th>';
    echo '    <td>&nbsp;</td>';
    echo '    <td>&nbsp;</td>';
    // check whether the user has the required right
    if ($LU->checkRight(CONNECTINGTHEINTERNET)) {
        echo '    <td><b>X</b></td>';
    } else {
        echo '    <td>&nbsp;</td>';
    }
    echo '  </tr>';
    echo '</table>';

}

// Show logout link.
echo '<p align="center"><a href="liveuser2login.php?logout=1">Logout</a></p>';

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

?>
