<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
   "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<title>Example 4</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta http-equiv="Content-Language" content="de">
</head>
<body bgcolor="#FFFFFF" text="#000000" link="#787878" vlink="#787878" alink="#787878" onLoad="">
<table cellspacing="0" cellpadding="0" width="700" align="center" border="1">
  <tr>
    <td>
      <table width="700" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td valign="top" width="130">
            <table width="107" border="0" cellspacing="0" cellpadding="0" name="navigation">
              <tr>
                <td colspan="2" height="40">&nbsp;</td>
              </tr>
              <tr>
                <td width="15" valign="top">
                  <ul><li></ul>
                </td>
                <td width="93" nowrap><a href="news_new.php">Write news </a></td>
              </tr>
              <tr>
                <td width="15" valign="top">
                  <ul><li></ul>
                </td>
                <td width="93" nowrap><a href="news_change.php">Change
                  / delete news</a></td>
              </tr>
              <tr>
                <td width="15" valign="top"><ul><li></ul></td>
                <td width="93" nowrap><a href="news_view.php">View
                  news</a></td>
              </tr>
              <tr>
                <td colspan="2" height="100">&nbsp;</td>
              </tr>
              <tr>
                <td colspan="2" align="center">
                  <table width="107" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td rowspan="2" valign="top">&nbsp;</td>
                      <td><font size="-2">{user}</font></td>
                    </tr>
                    <tr>
                      <td><font size="-2">{group}</font></td>
                    </tr>
                    <tr valign="bottom">
                      <td colspan="2" height="40"><font size="-2">Last login:<br>
                        {lastLogin}</font></td>
                    </tr>
                    <tr valign="bottom">
                      <td colspan="2" height="40"><font size="-2"><a href="news_change.php?logout=1">Logout</a></font></td>
                    </tr>
                  </table>
                </td>
              </tr>
            </table>
          </td>
          <td valign="top" width="500">
            <h1 align="right">change / delete news</h1>
            <script src="functions.js" type="text/javascript" language="javascript"></script>
            {script_msg}
            <table width="90%" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td colspan="4">&nbsp;</td>
              </tr>
              <tr>
                <td><b>Date</b></td>
                <td><b>Message</b></td>
                <td><b>Author</b></td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td colspan="4">&nbsp;</td>
              </tr>
              <!-- BEGIN row -->
              <tr onMouseOver="setPointer(this, '{color_h}')" onMouseOut="setPointer(this, '{color_n}')">
                <td valign="top" bgcolor="{color_n}">{time}</td>
                <td valign="top" bgcolor="{color_n}">{news}</td>
                <td valign="top" bgcolor="{color_n}">{author}</td>
                <td valign="top" bgcolor="{color_n}"> <!-- BEGIN change -->
                  <a href="{link_change}">Change</a>
                  <!-- END change --> &nbsp;&nbsp; <!-- BEGIN delete --> <a href="{link_delete}">Delete</a>
                  <!-- END delete --> </td>
              </tr>
              <!-- END row -->
              <tr>
                <td colspan="4">&nbsp;</td>
              </tr>
            </table>
            <p>&nbsp;</p>
          </td>
        </tr>
        <tr align="center">
          <td colspan="2"><a href="mailto:krausbn@php.net">&copy; 2003 by Björn
            Kraus</a></td>
        </tr>
      </table>
    </td>
  </tr>
</table>
</body>
</html>