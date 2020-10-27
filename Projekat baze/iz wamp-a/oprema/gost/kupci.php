<?php session_start();

?>

<html>
<head>
<title>oprema -- kupci</title>
<meta name="generator" http-equiv="content-type" content="text/html">
<style type="text/css">
  body {
    background-image : url('Sport-featured-image');
	background-repeat : no-repeat;
	background-size : 100% 100%;
    color: #000000;
    font-family: Arial;
    font-size: 12px;
  }
  header{
	background-color : #000033;
	opacity : 0.65;
	color : white;
	text-align :center;
  }
  footer{
	position : fixed;
	width : 100%;
	height : 3%;
	background-color : #000033;
	color : red;
	opacity : 0.7;
	bottom : 0px;
	left : 0px;
	text-align : right;
	font-size : 12px;
	font-weight : bold;
  }
  .nav{
	padding : 5px 0px;
	list-style-type : none;
	text-align : center;
	width : 100px;
	color : white;
  }
  .nav li{
	 background-color : #000033;
	 opacity : 0.7;
	 margin-top : 15px;
	 width : 100px;
	 height : 25px;
	 padding : 1px
	 text-align : center;
  }
  .nav li a {
	color : white;  
  }
  .bd {
    color: #000000;
    font-family: Arial;
    font-size: 12px;
  }
  .tbl {
    background-color: #FFFFFF;
	margin-top : 10%;
  }
  .tabela{
	list-style-type : none;
  }
  a:link { 
    color: black;
    font-family: Arial;
    font-size: 15px;
	text-decoration : none;
  }
  a:active { 
    color: black;
    font-family: Arial;
    font-size: 15px;
  }
  a:visited { 
    color: black;
    font-family: Arial;
    font-size: 15px;
  }
  .hr {
    background-color: #808080;
    color: #FFFFFF;
    font-family: Arial;
    font-size: 12px;
  }
  a.hr:link {
    color: #FFFFFF;
    font-family: Arial;
    font-size: 12px;
  }
  a.hr:active {
    color: #FFFFFF;
    font-family: Arial;
    font-size: 12px;
  }
  a.hr:visited {
    color: #FFFFFF;
    font-family: Arial;
    font-size: 12px;
  }
  .dr {
    background-color: #FFFFFF;
    color: #000000;
    font-family: Arial;
    font-size: 12px;
  }
  .sr {
    background-color: #EEEEEE;
    color: #000000;
    font-family: Arial;
    font-size: 12px;
  }
  .addbtn{
	background-color : #000033;
	opacity : 0.7;
	margin-top : 15px;
	width : 38px;
	height : 25px;
	padding : 1px
	text-align : center;
  }
  .addbtn a {
	color : white;
  }
</style>
</head>
<body>
<header>
<h1>SPORTSKA OPREMA <font style="color:red;">PRO STREET</font></h1>
</header>
<table width="100%" class="tabela">
<tr>
<td width="10%" valign="top" class="nav">
<li><a href="roba.php">Proizvodi</a>
<li><a href="kupci.php">Kupci</a>
<li><a href="narudzbine.php">Narudzbine</a>
<li><a href="popust.php">20% Popust!!!</a>
<li><a href="../logout.php">Odjavi se</a>
</td>
<td width="80%" valign="top">
<?php
  $conn = connect();
  $showrecs = 20;
  $pagerange = 10;

  $a = @$_GET["a"];
  $recid = @$_GET["recid"];
  $page = @$_GET["page"];
  if (!isset($page)) $page = 1;

  $sql = @$_POST["sql"];

  switch ($sql) {
    case "insert":
      sql_insert();
      break;
  }

  switch ($a) {
    case "add":
      addrec();
      break;
    case "view":
      viewrec($recid);
      break;
    default:
      select();
      break;
  }


  mysqli_close($conn);
?>
</td></tr></table>
<footer>Copyright &copy by Vladan Dimitrijević
</footer>
</body>
</html>

<?php function select()
  {
  global $a;
  global $showrecs;
  global $page;

  $res = sql_select();
  $count = sql_getrecordcount();
  if ($count % $showrecs != 0) {
    $pagecount = intval($count / $showrecs) + 1;
  }
  else {
    $pagecount = intval($count / $showrecs);
  }
  $startrec = $showrecs * ($page - 1);
  if ($startrec < $count) {mysqli_data_seek($res, $startrec);}
  $reccount = min($showrecs * $page, $count);
?>
<table class="tbl" border="0" cellspacing="1" cellpadding="5"width="100%">
<tr>
<td class="hr">&nbsp;</td>
<td class="hr"><?php echo "Id kupca" ?></td>
<td class="hr"><?php echo "Ime" ?></td>
<td class="hr"><?php echo "Prezime" ?></td>
<td class="hr"><?php echo "Adresa" ?></td>
<td class="hr"><?php echo "Telefon" ?></td>
<td class="hr"><?php echo "Grad" ?></td>
<td class="hr"><?php echo "Email" ?></td>
</tr>
<?php
  for ($i = $startrec; $i < $reccount; $i++)
  {
    $row = mysqli_fetch_assoc($res);
    $style = "dr";
    if ($i % 2 != 0) {
      $style = "sr";
    }
?>
<tr>
<td class="<?php echo $style ?>"><a href="kupci.php?a=view&recid=<?php echo $i ?>">Pregledaj</a></td>
<td class="<?php echo $style ?>"><?php echo htmlspecialchars($row["id"]) ?></td>
<td class="<?php echo $style ?>"><?php echo htmlspecialchars($row["ime"]) ?></td>
<td class="<?php echo $style ?>"><?php echo htmlspecialchars($row["prezime"]) ?></td>
<td class="<?php echo $style ?>"><?php echo htmlspecialchars($row["adresa"]) ?></td>
<td class="<?php echo $style ?>"><?php echo htmlspecialchars($row["telefon"]) ?></td>
<td class="<?php echo $style ?>"><?php echo htmlspecialchars($row["lp_id_grad"]) ?></td>
<td class="<?php echo $style ?>"><?php echo htmlspecialchars($row["email"]) ?></td>
</tr>
<?php
  }
  mysqli_free_result($res);
?>
</table>
<br>
<?php showpagenav($page, $pagecount); ?>
<?php } ?>

<?php function showrow($row, $recid)
  {
?>
<table class="tbl" border="0" cellspacing="1" cellpadding="5"width="50%">
<tr>
<td class="hr"><?php echo htmlspecialchars("id")."&nbsp;" ?></td>
<td class="dr"><?php echo htmlspecialchars($row["id"]) ?></td>
</tr>
<tr>
<td class="hr"><?php echo htmlspecialchars("ime")."&nbsp;" ?></td>
<td class="dr"><?php echo htmlspecialchars($row["ime"]) ?></td>
</tr>
<tr>
<td class="hr"><?php echo htmlspecialchars("prezime")."&nbsp;" ?></td>
<td class="dr"><?php echo htmlspecialchars($row["prezime"]) ?></td>
</tr>
<tr>
<td class="hr"><?php echo htmlspecialchars("adresa")."&nbsp;" ?></td>
<td class="dr"><?php echo htmlspecialchars($row["adresa"]) ?></td>
</tr>
<tr>
<td class="hr"><?php echo htmlspecialchars("telefon")."&nbsp;" ?></td>
<td class="dr"><?php echo htmlspecialchars($row["telefon"]) ?></td>
</tr>
<tr>
<td class="hr"><?php echo htmlspecialchars("id_grad")."&nbsp;" ?></td>
<td class="dr"><?php echo htmlspecialchars($row["lp_id_grad"]) ?></td>
</tr>
<tr>
<td class="hr"><?php echo htmlspecialchars("email")."&nbsp;" ?></td>
<td class="dr"><?php echo htmlspecialchars($row["email"]) ?></td>
</tr>
</table>
<?php } ?>

<?php function showroweditor($row, $iseditmode)
  {
  global $conn;
?>
<table class="tbl" border="0" cellspacing="1" cellpadding="5"width="50%">
<tr>
<td class="hr"><?php echo htmlspecialchars("id")."&nbsp;" ?></td>
<td class="dr"><input type="text" name="id" value="<?php echo str_replace('"', '&quot;', trim($row["id"])) ?>"></td>
</tr>
<tr>
<td class="hr"><?php echo htmlspecialchars("ime")."&nbsp;" ?></td>
<td class="dr"><input type="text" name="ime" maxlength="20" value="<?php echo str_replace('"', '&quot;', trim($row["ime"])) ?>"></td>
</tr>
<tr>
<td class="hr"><?php echo htmlspecialchars("prezime")."&nbsp;" ?></td>
<td class="dr"><input type="text" name="prezime" maxlength="30" value="<?php echo str_replace('"', '&quot;', trim($row["prezime"])) ?>"></td>
</tr>
<tr>
<td class="hr"><?php echo htmlspecialchars("adresa")."&nbsp;" ?></td>
<td class="dr"><textarea cols="35" rows="4" name="adresa" maxlength="150"><?php echo str_replace('"', '&quot;', trim($row["adresa"])) ?></textarea></td>
</tr>
<tr>
<td class="hr"><?php echo htmlspecialchars("telefon")."&nbsp;" ?></td>
<td class="dr"><input type="text" name="telefon" maxlength="10" value="<?php echo str_replace('"', '&quot;', trim($row["telefon"])) ?>"></td>
</tr>
<tr>
<td class="hr"><?php echo htmlspecialchars("id_grad")."&nbsp;" ?></td>
<td class="dr"><select name="id_grad">
<?php
  $sql = "select `id`, `grad` from `grad`";
  $res = mysqli_query($conn, $sql) or die(mysqli_error());

  while ($lp_row = mysqli_fetch_assoc($res)){
  $val = $lp_row["id"];
  $caption = $lp_row["grad"];
  if ($row["id_grad"] == $val) {$selstr = " selected"; } else {$selstr = ""; }
 ?><option value="<?php echo $val ?>"<?php echo $selstr ?>><?php echo $caption ?></option>
<?php } ?></select>
</td>
</tr>
<tr>
<td class="hr"><?php echo htmlspecialchars("email")."&nbsp;" ?></td>
<td class="dr"><textarea cols="35" rows="4" name="email" maxlength="100"><?php echo str_replace('"', '&quot;', trim($row["email"])) ?></textarea></td>
</tr>
</table>
<?php } ?>

<?php function showpagenav($page, $pagecount)
{
?>
<table class="bd" border="0" cellspacing="1" cellpadding="4">
<tr>
<td class="addbtn"><a href="kupci.php?a=add">Dodaj</a>&nbsp;</td>
<?php if ($page > 1) { ?>
<td><a href="kupci.php?page=<?php echo $page - 1 ?>">&lt;&lt;&nbsp;Prethodna</a>&nbsp;</td>
<?php } ?>
<?php
  global $pagerange;

  if ($pagecount > 1) {

  if ($pagecount % $pagerange != 0) {
    $rangecount = intval($pagecount / $pagerange) + 1;
  }
  else {
    $rangecount = intval($pagecount / $pagerange);
  }
  for ($i = 1; $i < $rangecount + 1; $i++) {
    $startpage = (($i - 1) * $pagerange) + 1;
    $count = min($i * $pagerange, $pagecount);

    if ((($page >= $startpage) && ($page <= ($i * $pagerange)))) {
      for ($j = $startpage; $j < $count + 1; $j++) {
        if ($j == $page) {
?>
<td><b><?php echo $j ?></b></td>
<?php } else { ?>
<td><a href="kupci.php?page=<?php echo $j ?>"><?php echo $j ?></a></td>
<?php } } } else { ?>
<td><a href="kupci.php?page=<?php echo $startpage ?>"><?php echo $startpage ."..." .$count ?></a></td>
<?php } } } ?>
<?php if ($page < $pagecount) { ?>
<td>&nbsp;<a href="kupci.php?page=<?php echo $page + 1 ?>">Sledeca&nbsp;&gt;&gt;</a>&nbsp;</td>
<?php } ?>
</tr>
</table>
<?php } ?>

<?php function showrecnav($a, $recid, $count)
{
?>
<table class="bd" border="0" cellspacing="1" cellpadding="4">
<tr>
<td><a href="kupci.php">Pocetna stranica</a></td>
<?php if ($recid > 0) { ?>
<td><a href="kupci.php?a=<?php echo $a ?>&recid=<?php echo $recid - 1 ?>">Prethodna stranica</a></td>
<?php } if ($recid < $count - 1) { ?>
<td><a href="kupci.php?a=<?php echo $a ?>&recid=<?php echo $recid + 1 ?>">Sledeca stranica</a></td>
<?php } ?>
</tr>
</table>
<hr size="1" noshade>
<?php } ?>

<?php function addrec()
{
?>
<table class="bd" border="0" cellspacing="1" cellpadding="4">
<tr>
<td><a href="kupci.php">Pocetna stranica</a></td>
</tr>
</table>
<hr size="1" noshade>
<form enctype="multipart/form-data" action="kupci.php" method="post">
<p><input type="hidden" name="sql" value="insert"></p>
<?php
$row = array(
  "id" => "",
  "ime" => "",
  "prezime" => "",
  "adresa" => "",
  "telefon" => "",
  "id_grad" => "",
  "email" => "");
showroweditor($row, false);
?>
<p><input type="submit" name="action" value="Postavi"></p>
</form>
<?php } ?>

<?php function viewrec($recid)
{
  $res = sql_select();
  $count = sql_getrecordcount();
  mysqli_data_seek($res, $recid);
  $row = mysqli_fetch_assoc($res);
  showrecnav("view", $recid, $count);
?>
<br>
<?php showrow($row, $recid) ?>
<br>
<hr size="1" noshade>
<table class="bd" border="0" cellspacing="1" cellpadding="4">
<tr>
<td class="addbtn"><a href="kupci.php?a=add">Dodaj</a></td>
</tr>
</table>
<?php
  mysqli_free_result($res);
} ?>

<?php function connect()
{
  $conn = mysqli_connect("localhost", "root", "", "oprema");
  return $conn;
}

function sqlvalue($val, $quote)
{
  if ($quote)
    $tmp = sqlstr($val);
  else
    $tmp = $val;
  if ($tmp == "")
    $tmp = "NULL";
  elseif ($quote)
    $tmp = "'".$tmp."'";
  return $tmp;
}

function sqlstr($val)
{
  return str_replace("'", "''", $val);
}

function sql_select()
{
  global $conn;
  $sql = "SELECT * FROM (SELECT t1.`id`, t1.`ime`, t1.`prezime`, t1.`adresa`, t1.`telefon`, t1.`id_grad`, lp5.`grad` AS `lp_id_grad`, t1.`email` FROM `kupci` AS t1 LEFT OUTER JOIN `grad` AS lp5 ON (t1.`id_grad` = lp5.`id`)) subq";
  $res = mysqli_query($conn, $sql) or die(mysqli_error());
  return $res;
}

function sql_getrecordcount()
{
  global $conn;
  $sql = "SELECT COUNT(*) FROM (SELECT t1.`id`, t1.`ime`, t1.`prezime`, t1.`adresa`, t1.`telefon`, t1.`id_grad`, lp5.`grad` AS `lp_id_grad`, t1.`email` FROM `kupci` AS t1 LEFT OUTER JOIN `grad` AS lp5 ON (t1.`id_grad` = lp5.`id`)) subq";
  $res = mysqli_query($conn, $sql) or die(mysqli_error());
  $row = mysqli_fetch_assoc($res);
  reset($row);
  return current($row);
}

function sql_insert()
{
  global $conn;
  global $_POST;

  $sql = "insert into `kupci` (`id`, `ime`, `prezime`, `adresa`, `telefon`, `id_grad`, `email`) values (" .sqlvalue(@$_POST["id"], false).", " .sqlvalue(@$_POST["ime"], true).", " .sqlvalue(@$_POST["prezime"], true).", " .sqlvalue(@$_POST["adresa"], true).", " .sqlvalue(@$_POST["telefon"], true).", " .sqlvalue(@$_POST["id_grad"], false).", " .sqlvalue(@$_POST["email"], true).")";
  mysqli_query($conn, $sql) or die(mysqli_error());
}
function primarykeycondition()
{
  global $_POST;
  $pk = "";
  $pk .= "(`id`";
  if (@$_POST["xid"] == "") {
    $pk .= " IS NULL";
  }else{
  $pk .= " = " .sqlvalue(@$_POST["xid"], false);
  };
  $pk .= ")";
  return $pk;
}
 ?>
