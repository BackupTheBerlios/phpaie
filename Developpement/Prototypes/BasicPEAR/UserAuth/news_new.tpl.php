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
                      <td colspan="2" height="40"><font size="-2"><a href="news_new.php?logout=1">Logout</a></font></td>
                    </tr>
                  </table>
                </td>
              </tr>
            </table>
          </td>
          <td valign="top" width="500">
            <h1 align="right">write news</h1>
            {script_msg}
            <form action="{form_action}" method="POST">
              <table width="450" border="0" cellpadding="0" cellspacing="5">
                <tr>
                  <td><b>Message:</b></td>
                  <td>
                    <textarea name="news" cols="40" rows="6">{message}</textarea>
                  </td>
                </tr>
                <tr>
                  <td><b>Valid:</b></td>
                  <td>
                    <input type="text" name="valid_to" maxlength="2" value="{valid}" size="4">
                    &nbsp;Weeks</td>
                </tr>
                <!-- BEGIN group -->
                <tr>
                  <td><b>For Group:</b></td>
                  <td>
                    <select name="group_id" size="1">
                      <!-- BEGIN choose_group -->
                      <option value="{value}" {selected}>{label}</option>
                      <!-- END choose_group -->
                    </select>
                  </td>
                </tr>
                <!-- END group -->
                <tr>
                  <td colspan="2">&nbsp;</td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td>
                    <input type="submit" name="Button" value="Send">
                    <!-- BEGIN button_abort -->
                    <input type="submit" name="Button2" value="Abort">
                    <!-- END button_abort --> </td>
                </tr>
              </table>
              <!-- BEGIN set_group -->
              <input type="hidden" name="group_id" value="{group_id}">
              <!-- END set_group --> <!-- BEGIN set_news -->
              <input type="hidden" name="news_id" value="{news_id}">
              <!-- END set_news --> <!-- BEGIN action -->
              <input type="hidden" name="action" value="change">
              <!-- END action -->
            </form>
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