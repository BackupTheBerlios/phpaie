<?php
//debugger_on(7869);
//error_reporting (55);
// Classe : menu
// Version : 0.6
// Auteur : Jean - Charles  Gibier
// Desription : La classe menu est un objet représentant une ligne de menu arborescent. Il va constituer une 
// structure en arbre en affectant un tableau de sous menus enfants de même type dans le membre '$what'.
// Modification 11/10/02 Adaptation pour Phpaie -> ajout d'une méthode d'affichage spécifique
// Modification 21/10/02 Correction du passage de paramètres 
// Modification 19/05/03 paramètre chemin des images
// Modification 19/05/03 paramètre nom de l'URL par défaut'

//définition des constantes -> nom des fichiers icône
define("TEE_MINUS_IMG", 		"tee_m_1818.gif");
define("TEE_PLUS_IMG", 			"tee_p_1818.gif");
define("TEE_IMG", 				"tee_1818.gif");
define("CORNER_BL_MINUS_IMG", 	"cbg_m_1818.gif");
define("CORNER_BL_PLUS_IMG", 	"cbg_p_1818.gif");
define("CORNER_BL_IMG", 		"cbg_1818.gif");
define("VERTICAL_IMG", 			"tv_1818.gif");
define("EMPTY_IMG", 			"vide_1818.gif");
define("FOLDER_DEF_IMG", 		"folder_1818.gif");
//chemin du répertoire des icônes
define("PATH_IMG", 				"../menus/images");
//chaîne format du tag IMG
define("TAG_IMG", "<IMG src=\"%s/%s\" align=\"left\" border=\"0\" vspace=\"0\" hspace=\"0\">\n");
//chaîne format du tag HREF
define("TAG_HREF", "<A HREF=\"%s?MENU=%s,%s%s\" target=\"_self\">\n");

class menu {
//$level : niveau de profondeur par rapport à la racine
    var $level;
//$visible : Branche fermée [+] (False) ou visible [-] (True)
    var $visible;
//$name : Nom affiché dans la page HTML
    var $name;
//$ident : identifiant de l'item
    var $ident;
//$url : contient URL 
    var $url;
//$identchild :  Si c'est un noeud : la chaîne contient les 'ident' fils
    var $identchild;
//$what : tableau contenant les sous menus enfant (identifiés dans $url).
    var $what;
//$line : tableau contenant les états des noeuds fils (est ce le dernier de sa branche ou pas ?)
    var $line;
//$havechild : agit comme un booléen si <> 0 le neud a des enfants.
    var $havechild;
    function menu ($l = 0, $v = 0, $n = 0, $i = 0, $u = 0,  $w = 0, $li = 0, $h = 0)
    {
        $this -> level 		= $l;
        $this -> visible 	= $v;
        $this -> name 		= $n;
        $this -> ident 		= trim($i);
        $this -> url 		= $u;
        $this -> what 		= $w;
        $this -> line 		= $li;
        $this -> havechild 	= $h;
    } 


// function add_level() 
// Incrémenter tout les niveaux des élments fils après ajout d'un noeud père.

    function add_level()
    {
        if (isset ($this)) {
            foreach ($this -> what as $key => $value) {
                $this -> what[$key] -> add_level();
            } 
            $this -> level++;
        } 
        return $this;
    } 

// function set_lines()
// Mettre à jour les états de ligne (line) pour chaque noeud et chaque niveau (level).
// args : $all_levels état de ligne du noeud père à copier et mettre à jour dans noeud fils

    function set_lines($all_levels)
    {
        if (isset ($this)) {
            $new_tot = count($this -> what);
            $this -> line = $all_levels ;

            foreach ($this -> what as $key => $value) {
                $all_levels [$this -> level] = (-- $new_tot) ? 1 : 2 ;
                $this -> what[$key] -> set_lines($all_levels);
            } 
        } 
        return $this;
    } 



// function do_visibility().
// Affecte la variable visible (ou pas) de chaque noeud en fonction de l'historique des noeuds masqués
// La variable globale MENU contient la liste des 'ident' de noeuds  actuellement masqués. Cette
// variable est mise à jour en fonction du dernier élément de la liste qui est mis à jour par le lien séléctionné
// sur la page. Ce dernier élément est précédé d'une lettre 'P' ou 'M'. 'P' pour plus (+) indique que le noeud
// doit être masqué (il s'affiche avec le signe +), l'élément qui suit doit être alors ajouté à la liste des 
// éléments à masquer. Inversement 'M' indique que le noeud va être déployé. L'élément qui suit doit 
// être alors retiré de la liste des éléments à masquer, si il y est.

    function do_visibility()
    {
        $What_isn_visible = array();

        if (isset ($GLOBALS["MENU"]) && $GLOBALS["MENU"]) {
            $What_isn_visible = explode(",", $GLOBALS["MENU"]);
            $todo = array_pop ($What_isn_visible);
            $to_mov = substr($todo, 1);

            if ($todo[0] == 'P') { // ajout
                    if (array_search ($to_mov, $What_isn_visible, false) == false); {
                        array_push ($What_isn_visible, $to_mov);
                    } 
                } 
                if ($todo[0] == 'M') { // suppr
                        if (($found = array_search ($to_mov, $What_isn_visible, false)) != false); {
                            unset ($What_isn_visible[$found]);
                        } 
                    } 
                    $GLOBALS["MENU"] = implode(",", $What_isn_visible);
                } 

                $this -> set_visibility($What_isn_visible);
            } 

//  function set_visibility($What_isn_visible)
//  Cette fonction met à jour le flag de visibilité de chaque élément en fonction du tableau $What_isn_visible

            function set_visibility($What_isn_visible)
            {
                if (isset ($this)) {
                    foreach ($this -> what as $key => $value) {
                        $this -> what[$key] -> set_visibility($What_isn_visible);
                    } 

                    foreach ($What_isn_visible as $value) {
                        if ($value == $this -> ident) {
                            $this -> visible = false;
                        } 
                    } 
                } 

                return $this;
            } 
        } 

//  function Arbo_print($object)
// fonction d'affichage. Elle a besoin de l'objet passé en argument pour afficher son contenu et effectuer un appel récursif
// sur tout ses noeuds fils. Le Noeud n'est affiché que s'il est dans l'état visible. (C'est ici qu'il faut ajouter de jolis icônes
// pour montrer les types de fichiers par exemple).

        function Arbo_print($object)
        {
            $What_isn_visible = array();
            $remain_query = "";

            if (isset ($GLOBALS["MENU"]) && $GLOBALS["MENU"]) {
                $What_isn_visible = explode(",", $GLOBALS["MENU"]);
            } 
            
            if ( ereg( "MENU=[^&]*(.*)",$GLOBALS["QUERY_STRING"], $regs ) ) {
                 $remain_query =  $regs[1] ;            
            } else if ($GLOBALS["QUERY_STRING"]) {
                 $remain_query =  "&".$GLOBALS["QUERY_STRING"];
            }
            
            print "<TR valign=\"top\"><TD nowrap>";
            for($count = 0; $count < $object -> level ; $count++) {
                if ($count + 1 == $object -> level) {
                    if ($object -> line[$count] == 1) {
                        if ($object -> havechild) {
                            if ($object -> visible) {
                                printf(TAG_HREF, $GLOBALS["PHP_SELF"], implode(",", $What_isn_visible), 'P'. $object->ident, $remain_query);
                                printf(TAG_IMG, PATH_IMG, TEE_MINUS_IMG);
                                print "</A>\n";

                            } else {
                                printf(TAG_HREF, $GLOBALS["PHP_SELF"], implode(",", $What_isn_visible), 'M'. $object->ident, $remain_query );
                                printf(TAG_IMG, PATH_IMG, TEE_PLUS_IMG);
                                print "</A >\n";
                            } 
                        } else {
                            printf(TAG_IMG, PATH_IMG, TEE_IMG);
                        } 
                    } else {
                        if ($object -> havechild) {
                            if ($object -> visible) {
                                printf(TAG_HREF, $GLOBALS["PHP_SELF"], implode(",", $What_isn_visible), 'P'. $object->ident, $remain_query);
                                printf(TAG_IMG, PATH_IMG, CORNER_BL_MINUS_IMG);
                                print "</A >\n";
                            } else {
                                printf(TAG_HREF, $GLOBALS["PHP_SELF"], implode(",", $What_isn_visible), 'M'. $object->ident, $remain_query);
                                printf(TAG_IMG, PATH_IMG, CORNER_BL_PLUS_IMG);
                                print "</A >\n";
                            } 
                        } else {
                            printf(TAG_IMG, PATH_IMG, CORNER_BL_IMG);
                        } 
                    } 
                } else if ($object -> line[$count] == 1) {
                    printf(TAG_IMG, PATH_IMG, VERTICAL_IMG);
                } else {
                    printf(TAG_IMG, PATH_IMG, EMPTY_IMG);
                } 
            } 

            print "<font size=\"2\">\n";

            if ($object -> havechild || $object -> ident == -1) {
                printf(TAG_IMG, PATH_IMG, FOLDER_DEF_IMG);
//                print "&nbsp;$object->name \n";
                print "&nbsp;<A HREF=\"" . $object -> url."?".$GLOBALS["QUERY_STRING"]. "\">$object->name</A>\n";
            } else {
                printf(TAG_IMG, PATH_IMG, trim($object -> identchild[0]) );
                print "&nbsp;<A HREF=\"" . $object -> url."?".$GLOBALS["QUERY_STRING"]. "\">$object->name</A>\n";
            } 
            print "</font>\n";
            print "</TD></TR>";

            if (isset ($object) && $object -> visible) {
                foreach ($object -> what as $key => $value) {
                    Arbo_print($object -> what[$key]);
                } 
            } 

            return $object;
        } 

// function String_to_Arbo($arbo_string, $titre, $default_page)
// Transforme la chaîne ($arbo_string) de description du menu en arborescence ordonée. Utilise les regexp selon le 
// schéma suivant : Tant qu'un pattern  contenant un parenthèse ouvrante suivit de caractères *excluant une autre 
// parenthèse ouvrante* et terminé par un parenthèse fermante est trouvé on remplace ce pattern par un numéro 
// incrémenté. On stocke les infos (contenu et dépendance) dans l'arborescence. Renvoie le noeud racine.
// $default_page est l'URL associée par défaut au démarrage du menu

        function String_to_Arbo($arbo_string, $titre, $default_page = "ELEMENTS.html")
        {
	    // variable temporaire
            $accepted = array() ;
	    // tableau des noeuds menu
            $object = array() ;
	    // nombre de branches ou de feulles détectés
            $new_num = 1;
	    // suppression  retour et newline de la ligne a parser
	    	$arbo_string = str_replace(array("\r\n", "\r", "\n", "\t"), array("", "", "", ""), $arbo_string);
	    // tant qu'une branche ou un noeud est détecté dans la ligne ...
        // Note: le parsing est récursif et non itératif.
            while (eregi('\(([^\(|^\)]+)\)', $arbo_string, $accepted)) {
	    // suppresion des parenthèses et numérotation du noeud
                $arbo_string = ereg_replace("\(" . $accepted[0] . "\)", "$new_num", $arbo_string);
		// récupération des attributs
                $locales = explode(",", $accepted[1]);
		// génération du noeud 
                $object [$new_num] = new menu (1, $locales[0], $locales[1],  $locales[2], $locales[3], array(), array());
                $object [$new_num]->identchild = array_slice ($locales, 4);
                $new_num ++ ;
            } 
	    // pour chaque noeud fils on affecte ses attributs
            foreach ($object as $key => $value) {
                $numdeps = implode("", $value ->identchild);
                $object[$key ] -> level = 1;
                if (ereg ("^[0-9 ]+$", $numdeps)) {
                    foreach ($value -> identchild as $ref) {
                        $ref = trim($ref);
                        $object [ $ref ] -> add_level ();
                        $object[$key ] -> what [$ref ] = $object [$ref ];
                        $object[$key ] -> havechild = 1;
                        unset ($object [$ref ]);
                    } 
                } else {
                    $object[$key ] -> havechild = 0;
                } 
            } 
            $new_num = count($object);
	    // set_line affecte la profondeur des noeuds
            foreach ($object as $key => $value) {
                $object[ $key ] -> set_lines (array((-- $new_num) ? 1 : 2));
            } 

            return new menu (0 , 1, $titre, -1, $default_page, $object, array());
        } 
?>

