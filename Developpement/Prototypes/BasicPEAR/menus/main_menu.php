<?php
//********************************************************************
// Phpaie 
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
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation.
//*********************************************************************
$t_string = "
	( 1,Employeur, 1,Employeur/EMPLOY1_MP.php, 
		( 1,Définition du plan de paie, 2,Planpaie/DEFINITION_MP.php, 
		( 1, Critères du profil, 3,Planpaie/CRITERE_MP.php, file_1818.gif )
	), 
	( 1,Salarie, 4,Salarie/SALARI0_MP.php, 
		( 1, Emploi, 5,Salarie/SALARI1_MP.php, file_1818.gif ), 
		( 1, Données contractuelles, 6,Salarie/SALARI2_MP.php, file_1818.gif ), 
		( 1, Renseignements personnels, 7,Salarie/SALARI3_MP.php, file_1818.gif ), 
		( 1, Contexte de paie, 8,Salarie/SALARI4_MP.php, file_1818.gif ), 
		( 1, Variables, 9,Formule/VARIABLES_MP.php, file_1818.gif )
	), 
	( 1,Organismes collecteurs, 10,Orgcoll/ORGANCO_MP.php, 
		( 1,Groupe de rubriques, 11,Rubrique/GRUB_MP.php, 
			( 1, Rubrique, 12,Rubrique/RUBR_MP.php, file_1818.gif )
		), 
		( 1, Variables, 13,Formule/VARIABLEO_MP.php, file_1818.gif )
	), 
	( 1, Totalisateur, 14,Rubrique/TOTALIS_MP.php, file_1818.gif ), 
	( 1,Totalisateur - rubrique, 15,Rubrique/TOTALISRUBR_MP.php, 
		( 1, Totalisateur, 16,Rubrique/TOTALIS_MP.php, file_1818.gif ), 
		( 1, Rubrique, 17,Rubrique/RUBR_MP.php, file_1818.gif )
	), 
	( 1, Variables, 18,Formule/VARIABLEE_MP.php, file_1818.gif ), 
	( 1, Élément calculé, 19,Formule/ECALCUL_MP.php, file_1818.gif ), 
	( 1,Convention Collective, 20,Employeur/CCOLL_MP.php, 
		( 1, Variables, 21,Formule/VARIABLEC_MP.php, file_1818.gif )
	)
)";
?>
