<?php
if(! isset($session_path))
	{
		return (1);
	}
if(! isset( $vars[PREC]))
	{
	$vars[PREC] = $session_path[($session_cnt - 1 > 0) ? $session_cnt - 1 : 0];
	}
if(! isset( $vars[SUIV]))
	{
	$vars[SUIV] = $session_path[($session_cnt + 1)%15];
	}
print "  <input type=\"hidden\"  size=\"56\" NAME=\"PREC\" VALUE=\"$vars[PREC]\" >\n";
print "  <input type=\"hidden\"  size=\"56\" NAME=\"SUIV\" VALUE=\"$vars[SUIV]\" >\n";
print "  <div align=\"center\">\n";
print "    <center>\n";
print "    <table border=\"0\" width=\"800\" cellspacing=\"0\" cellpadding=\"0\">\n";
print "      <tr>\n";
print "        <td width=\"2%\"></td>\n";
print "        <td width=\"96%\"></td>\n";
print "        <td width=\"2%\"></td>\n";
print "      </tr>\n";
print "      <tr>\n";
print "        <td width=\"2%\"></td>\n";
print "        <td width=\"96%\" valign=\"middle\" align=\"center\">\n";
print "    		<table border=\"0\" width=\"600\" cellspacing=\"0\" cellpadding=\"0\">\n";
print "    		  <tr>\n";
print "    		    <td width=\"20%\" align=\"center\" height=\"16\" valign=\"middle\" ><a href=\"/\"><font face=\"Arial Black\" size=\"2\">Home</font></a></td>\n";
print "    		    <td width=\"20%\" align=\"center\" height=\"16\" valign=\"middle\" ><a href=\"/Betapaye/desk/DESK_1.php\"><font face=\"Arial Black\" size=\"2\">Accueil</font></a></td>\n";
if(! isset( $vars[PREC]))
	{
	print "    		    <td width=\"20%\" align=\"center\" height=\"16\" valign=\"middle\" >". (($session_cnt > 0) ? "<a href=\"../common/goprev.php\">" : "") ."<font face=\"Arial Black\" size=\"2\">Précédant</font>". (($session_cnt > 0) ? "</a>" : "") ."</td>\n";
	}
else
	{
	print "    		    <td width=\"20%\" align=\"center\" height=\"16\" valign=\"middle\" > <a href=\"$vars[PREC]\"> <font face=\"Arial Black\" size=\"2\">Précédant</font></a></td>\n";
	}
if(! isset( $vars[SUIV]))
	{
	print "    		    <td width=\"20%\" align=\"center\" height=\"16\" valign=\"middle\" >". ((($session_cnt + 1)%15 < count ($session_path)%15) ? "<a href=\"../common/gonext.php\">" : "") ."<font face=\"Arial Black\" size=\"2\">Suivant</font>". ((($session_cnt + 1)%15 < count($session_path)%15) ? "</a>" : "") ."</td>\n";
	}
else
	{
	print "    		    <td width=\"20%\" align=\"center\" height=\"16\" valign=\"middle\" > <a href=\"$vars[SUIV]\"> <font face=\"Arial Black\" size=\"2\">Suivant</font></a></td>\n";
	}
print "    		    <td width=\"20%\" align=\"center\" height=\"16\" valign=\"middle\" ><a href=\"../common/NONIMP.html\"><font face=\"Arial Black\" size=\"2\">Aide</font></a></td>\n";
print "    		  </tr>\n";
print "    		</table>\n";
print "        </td>\n";
print "        <td width=\"2%\"></td>\n";
print "      </tr>\n";
print "      <tr>\n";
print "        <td width=\"2%\"></td>\n";
print "        <td width=\"96%\"></td>\n";
print "        <td width=\"2%\"></td>\n";
print "      </tr>\n";
print "    </table>\n";
print "   </center>\n";
print "  </div>\n";
print "  <hd>\n";
return (0);
?>