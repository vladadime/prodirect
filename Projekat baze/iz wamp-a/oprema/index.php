<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Login</title>
<style type="text/css">
  body {
    color: black;
    font-family: Arial;
    font-size: 12px;
    font-weight: bold;
    background-image : url('linear-gradient-green-blue.jpg');
  }
  .log{
	  margin-top : 250px;
	  background-color : #4d94ff;
  }
  .dugme{
	  margin-left:0px;
  }
</style>
</head>
<body>
<table width="300" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="white" class="log">
<tr>
<form name="form1" method="post" action="proveralogin.php">
<td>
<table width="100%" border="0" cellpadding="3" cellspacing="1">
<tr>
<td colspan="3"><strong>Prijava </strong></td>
</tr>
<tr>
<td width="78">Korisnicko ime</td>
<td width="6">:</td>
<td width="294"><input name="korisnik" type="text" id="korisnik"></td>
</tr>
<tr>
<td>Lozinka</td>
<td>:</td>
<td><input name="lozinka" type="password" id="lozinka"></td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td><input type="submit" name="Submit" value="Prijavi se" class="dugme"></td>
</tr>
</table>
</td>
</form>
</tr>
</table>
</body>
</html>
