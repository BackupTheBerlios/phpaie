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
require_once("LIVEUSER3LOGIN_def.php");
require_once("../inc/session_libre.php");
//Trail code ($tr_code)

require_once('conf3.php');

// Get LoginManager class definition
require_once 'LiveUser/LiveUser.php';


// Create new LiveUser (LoginManager) object.
// We´ll only use the auth container, permissions are not used.
$LU = LiveUser::factory($liveuserConfig);
//$LU = LiveUser::factory(array());

    $NAV_LANGUAGE = '';

    session_start();

    if (isset($_POST['NAV_LANGUAGE'])) {
        $NAV_LANGUAGE = $_POST['NAV_LANGUAGE'];
    } elseif (isset($_SESSION['NAV_LANGUAGE'])) {
        $NAV_LANGUAGE = $_SESSION['NAV_LANGUAGE'];
    } else {
        $NAV_LANGUAGE = 'en';
    }

    $_SESSION['NAV_LANGUAGE'] = $NAV_LANGUAGE;
    $_GET['NAV_LANGUAGE'] = $NAV_LANGUAGE;
    session_write_close();


function PhpaieLogin()
{
$pg_LIVEUSER3LOGIN = new LIVEUSER3LOGIN( ( isset( $_POST ) && array_count_values($_POST) ) ? $_POST : $_GET );
//Récupération des variables pour le formulaire
$pg_LIVEUSER3LOGIN->pageDisplay("");
//exit();
} // end func
PhpaieLogin(); 
?>
