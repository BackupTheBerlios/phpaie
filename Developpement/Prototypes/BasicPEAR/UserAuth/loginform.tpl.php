<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>

<head>
  <title>Example 4</title>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
  <meta http-equiv="Content-Language" content="en">
</head>

<body bgcolor="#FFFFFF">
<div align="center">
  <h1><font size="6"><b><i>BackOffice</i></b></font></h1>
  <p>&nbsp;</p>
  <p>Greetings! Please insert your username and password:</p>
  <!-- BEGIN failure -->
  <p><font color="red"><b>Username or password wrong.<br>
    Please try it again!</b></font></p>
  <!-- END failure -->
  <!-- BEGIN expired -->
  <p><font color="red"><b>You are expired.</b></font></p>
  <!-- END expired -->
  <!-- BEGIN idled -->
  <p><font color="red"><b>You are idled.</b></font></p>
  <!-- END idled -->
  <!-- BEGIN inactive -->
  <p><font color="red"><b>Your account has been deactivated.<br>
    Please contact the <a href="mailto:krausbn@php.net">webmaster</a>!</b></font></p>
  <!-- END inactive -->
  <form name="loginform" action="{form_action}" method="post">
    <table border="0" cellspacing="0" cellpadding="0" align="center">
      <tr bgcolor="#000066">
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr bgcolor="#000066">
        <td></td>
        <td valign="top">
          <table bgcolor="#D3DCE3" border="0" cellpadding="3" cellspacing="0">
            <tr>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td colspan="2" align="center">Login
                <hr style="width:260px; text-align:center;">
              </td>
            </tr>
            <tr>
              <td align="right">Username:</td>
              <td>
                <input type="text" name="username" maxlength="32" size="20">
              </td>
            </tr>
            <tr>
              <td align="right">Password:</td>
              <td>
                <input type="password" name="password" maxlength="32" size="20">
              </td>
            </tr>
            <tr>
              <td colspan="2" align="center">
                <hr style="width:260px; text-align:center;">
                <input type="submit" name="Submit" value="Login"></td>
            </tr>
          </table>
        </td>
        <td></td>
      </tr>
      <tr bgcolor="#000066">
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table>
  </form>
</div>

<script type="text/javascript">
<!--
  if (document.forms[0][0].value != '') {
      document.forms[0][1].focus();
  } else {
      document.forms[0][0].focus();
  }
// -->
</script>
</body>
</html>