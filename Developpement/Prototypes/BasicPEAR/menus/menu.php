<?php
//debugger_on(7869);
//error_reporting (55);
// Classe : menu
// Version : 0.6
// Auteur : Jean - Charles  Gibier
// Desription : La classe menu est un objet repr�sentant une ligne de menu arborescent. Il va constituer une 
// structure en arbre en affectant un tableau de sous menus enfants de m�me type dans le membre '$what'.
// Modification 11/10/02 Adaptation pour Phpaie -> ajout d'une m�thode d'affichage sp�cifique
// Modification 21/10/02 Correction du passage de param�tres 
// Modification 19/05/03 param�tre chemin des images
// Modification 19/05/03 param�tre nom de l'URL par d�faut'

//d�finition des constantes -> nom des fichiers ic�ne
define("TEE_MINUS_IMG", 		"tee_m_1818.gif");
define("TEE_PLUS_IMG", 			"tee_p_1818.gif");
define("TEE_IMG", 				"tee_1818.gif");
define("CORNER_BL_MINUS_IMG", 	"cbg_m_1818.gif");
define("CORNER_BL_PLUS_IMG", 	"cbg_p_1818.gif");
define("CORNER_BL_IMG", 		"cbg_1818.gif");
define("VERTICAL_IMG", 			"tv_1818.gif");
define("EMPTY_IMG", 			"vide_1818.gif");
define("FOLDER_DEF_IMG", 		"folder_1818.gif");
//chemin du r�pertoire des ic�nes
define("PATH_IMG", 				"../menus/images");
//cha�ne format du tag IMG
define("TAG_IMG", "<IMG src=\"%s/%s\" align=\"left\" border=\"0\" vspace=\"0\" hspace=\"0\">\n");
//cha�ne format du tag HREF
define("TAG_HREF", "<A HREF=\"%s?MENU=%s,%s%s\" target=\"_self\">\n");

class menu {
//$level : niveau de profondeur par rapport � la racine
    var $level;
//$visible : Branche ferm�e [+] (False) ou visible [-] (True)
    var $visible;
//$name : Nom affich� dans la page HTML
    var $name;
//$ident : identifiant de l'item
    var $ident;
//$url : contient URL 
    var $url;
//$identchild :  Si c'est un noeud : la cha�ne contient les 'ident' fils
    var $identchild;
//$what : tableau contenant les sous menus enfant (identifi�s dans $url).
    var $what;
//$line : tableau contenant les �tats des noeuds fils (est ce le dernier de sa branche ou pas ?)
    var $line;
//$havechild : agit comme un bool�en si <> 0 le neud a des enfants.
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
// Incr�menter tout les niveaux des �lments fils apr�s ajout d'un noeud p�re.

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
// Mettre � jour les �tats de ligne (line) pour chaque noeud et chaque niveau (level).
// args : $all_levels �tat de ligne du noeud p�re � copier et mettre � jour dans noeud fils

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
// Affecte la variable visible (ou pas) de chaque noeud en fonction de l'historique des noeuds masqu�s
// La variable globale MENU contient la liste des 'ident' de noeuds  actuellement masqu�s. Cette
// variable est mise � jour en fonction du dernier �l�ment de la liste qui est mis � jour par le lien s�l�ctionn�
// sur la page. Ce dernier �l�ment est pr�c�d� d'une lettre 'P' ou 'M'. 'P' pour plus (+) indique que le noeud
// doit �tre masqu� (il s'affiche avec le signe +), l'�l�ment qui suit doit �tre alors ajout� � la liste des 
// �l�ments � masquer. Inversement 'M' indique que le noeud va �tre d�ploy�. L'�l�ment qui suit doit 
// �tre alors retir� de la liste des �l�ments � masquer, si il y est.

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
//  Cette fonction met � jour le flag de visibilit� de chaque �l�ment en fonction du tableau $What_isn_visible

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
// fonction d'affichage. Elle a besoin de l'objet pass� en argument pour afficher son contenu et effectuer un appel r�cursif
// sur tout ses noeuds fils. Le Noeud n'est affich� que s'il est dans l'�tat visible. (C'est ici qu'il faut ajouter de jolis ic�nes
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
// Transforme la cha�ne ($arbo_string) de description du menu en arborescence ordon�e. Utilise les regexp selon le 
// sch�ma suivant : Tant qu'un pattern  contenant un parenth�se ouvrante suivit de caract�res *excluant une autre 
// parenth�se ouvrante* et termin� par un parenth�se fermante est trouv� on remplace ce pattern par un num�ro 
// incr�ment�. On stocke les infos (contenu et d�pendance) dans l'arborescence. Renvoie le noeud racine.
// $default_page est l'URL associ�e par d�faut au d�marrage du menu

        function String_to_Arbo($arbo_string, $titre, $default_page = "ELEMENTS.html")
        {
	    // variable temporaire
            $accepted = array() ;
	    // tableau des noeuds menu
            $object = array() ;
	    // nombre de branches ou de feulles d�tect�s
            $new_num = 1;
	    // suppression  retour et newline de la ligne a parser
	    	$arbo_string = str_replace(array("\r\n", "\r", "\n", "\t"), array("", "", "", ""), $arbo_string);
	    // tant qu'une branche ou un noeud est d�tect� dans la ligne ...
        // Note: le parsing est r�cursif et non it�ratif.
            while (eregi('\(([^\(|^\)]+)\)', $arbo_string, $accepted)) {
	    // suppresion des parenth�ses et num�rotation du noeud
                $arbo_string = ereg_replace("\(" . $accepted[0] . "\)", "$new_num", $arbo_string);
		// r�cup�ration des attributs
                $locales = explode(",", $accepted[1]);
		// g�n�ration du noeud 
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

