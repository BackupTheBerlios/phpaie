<?php
// Généré le Thu Jun 19 10:03:28 2003 par PHPLISTE
// fetchListe( NOMTABLE, NOMCOLONNE, CLAUSEWHERE, TYPESELECT , LSTSELECT, VARIABLES )
function fetchListe( $nomtbl, $nomitem, $where_clause, $select_type, $list_name, & $vars )
{
include "../inc/cnx_param.php";
require_once("../inc/funcs.php");
$vars['RETURN_STATUS'] = 1;
$where_clause = strtoupper ($where_clause);
$nomtbl = strtoupper ($nomtbl);
$nomitem = strtoupper ($nomitem);
$link =  mysql_connect($serv, $user, $pass );
if ( ! $link )
	die( "Impossible de se connecter à MySQL" );
mysql_select_db( $db, $link ) or die ( mysql_error() );
$req="$where_clause";
$nom_ndx="";
$nom_col="";
$nom_ali="";
if ( ereg( "(.*)\.(.*)", $nomitem, $r_nomitem ))
	{
	$nom_ali = $r_nomitem[1].".";
	$nom_col = $r_nomitem[2];
	$nom_ndx = "ID_". ereg_replace ("_[^_]*(_KEY|_CKEY)(_TI|_SI|_MI|_I|_BI|_F|_DO|_DE|_C|_DATE|_TIME|_CH|_VCH|_TE|_BL)$", "", $r_nomitem[2]);
	}
else
	{
	$nom_col = $nomitem;
	$nom_ndx = "ID_". $nomtbl;
	}
$nomitem = $nom_ali.$nom_ndx.", ".$nomitem ;
// Si aucun champ n'est rempli on prend tout
$req = "SELECT $select_type $nomitem FROM $nomtbl $req";
//    print "<option NAME=\"TEST\"> $req </option>";
$count_id = 0;
$result = mysql_query( "$req");
$num_rows = mysql_num_rows( $result );
while ( $a_row = mysql_fetch_assoc( $result ) )
	{
	$nl = 0;
	while (list($key, $value) = each ($a_row))
		{
		if ($key==$nom_ndx)
			{
			$lid = $a_row["$nom_ndx"];
			if ($vars[$list_name] == $lid)
				print "		<option value=\"$lid\" selected=\"selected\"> $a_row[$nom_col]</option>\n";
			else
				print "		<option value=\"$lid\">$a_row[$nom_col]</option>\n";
			}
		}
	}
$vars['RETURN_STATUS'] = 0;
mysql_close( $link );
mysql_free_result($result);
}
?>
