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
//mise à jour des variables de session de renseignement
// Initialisation de la session.
session_start();
// Détruit toutes les variables de session
session_unset();
// Finalement, détruit la session
//session_destroy();
session_start();
setlocale (LC_TIME, "fr");
?>
