<!-- $Id: loginscreen.php,v 1.2 2004/07/20 21:33:14 j-charles Exp $ -->
<html>
<head>
<title>LiveUser Login Screen</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link  rel="stylesheet" href="../css/0818.css" type="text/css">
<!--
table {  background-color: #CCCCCC; border-color: #000000 #000000 #000000 black; border-style: solid; border-top-width: 1px; border-right-width: 1px; border-bottom-width: 1px; border-left-width: 1px}
body {  font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10pt; color: #000000; background-color: #FFFFFF}
-->
</style>
</head>

<body bgcolor="#FFFFFF" text="#000000">
<?php
echo '<form name="loginform" method="post" action="';
if (!isset($target)) {
    echo 'example.php">';
} else {
    echo $target.'">';
}
?>
  <table width="300" border="0" cellspacing="0" cellpadding="5" align="center">
    <tr>
      <td colspan="2">Example login</td>
    </tr>
    <tr>
      <td>Handle:</td>
      <td>
        <input type="text" name="handle" maxlength="80" value="">
      </td>
    </tr>
    <tr>
      <td>Password:</td>
      <td>
        <input type="password" name="passwd" maxlength="80" value="">
      </td>
    </tr>
    <tr>
      <td>Remember me:</td>
      <td>
        <input type="checkbox" name="rememberMe">
      </td>
    </tr>
    <tr>
      <td colspan="2">
        <div align="center">
          <input type="submit" name="Submit" value="Login">
        </div>
      </td>
    </tr>
  </table>
</form>
</body>
</html>