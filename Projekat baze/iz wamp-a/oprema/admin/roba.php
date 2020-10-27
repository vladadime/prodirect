<?php session_start();

?>

<html>
<head>
<title>oprema -- roba</title>
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
</style>
</head>
<body>
<header>
<h1>SPORTSKA OPREMA <font style="color:red;">PRO STREET</font></h1>
</header>
<table width="100%" class="tabela">
<tr>
<td width="10%" valign="top" class="nav">
<li><a href="boja.php">Boja</a>
<li><a href="grad.php">Grad</a>
<li><a href="kupci.php">Kupci</a>
<li><a href="marka.php">Marka</a>
<li><a href="namena.php">Namena</a>
<li><a href="narudzbine_1.php">Narudzbine</a>
<li><a href="roba.php">Proizvodi</a>
<li><a href="vrsta_robe.php">Vrsta robe</a>
<li><a href="popust.php">20% Popust!!!</a>
<li><a href="zarada.php">Zarada</a>
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
    case "update":
      sql_update();
      break;
    case "delete":
      sql_delete();
      break;
  }

  switch ($a) {
    case "add":
      addrec();
      break;
    case "view":
      viewrec($recid);
      break;
    case "edit":
      editrec($recid);
      break;
    case "del":
      deleterec($recid);
      break;
    default:
      select();
      break;
  }


  mysqli_close($conn);
?>
</td></tr></table>
<br><br>
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
<td class="hr"><?php echo "Id robe" ?></td>
<td class="hr"><?php echo "Vrsta robe" ?></td>
<td class="hr"><?php echo "Marka" ?></td>
<td class="hr"><?php echo "Naziv robe" ?></td>
<td class="hr"><?php echo "Namena" ?></td>
<td class="hr"><?php echo "Velicina" ?></td>
<td class="hr"><?php echo "Cena" ?></td>
<td class="hr"><?php echo "Pol" ?></td>
<td class="hr"><?php echo "Boja" ?></td>
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
<td class="<?php echo $style ?>"><a href="roba.php?a=view&recid=<?php echo $i ?>">Uredi/Izbrisi</a></td>
<td class="<?php echo $style ?>"><?php echo htmlspecialchars($row["id"]) ?></td>
<td class="<?php echo $style ?>"><?php echo htmlspecialchars($row["lp_id_vrsta_robe"]) ?></td>
<td class="<?php echo $style ?>"><?php echo htmlspecialchars($row["lp_id_marka"]) ?></td>
<td class="<?php echo $style ?>"><?php echo htmlspecialchars($row["naziv_robe"]) ?></td>
<td class="<?php echo $style ?>"><?php echo htmlspecialchars($row["lp_id_namena"]) ?></td>
<td class="<?php echo $style ?>"><?php echo htmlspecialchars($row["velicina"]) ?></td>
<td class="<?php echo $style ?>"><?php echo htmlspecialchars($row["cena"]) ?></td>
<td class="<?php echo $style ?>"><?php echo htmlspecialchars($row["pol"]) ?></td>
<td class="<?php echo $style ?>"><?php echo htmlspecialchars($row["lp_id_boja"]) ?></td>
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
<td class="hr"><?php echo htmlspecialchars("id_vrsta_robe")."&nbsp;" ?></td>
<td class="dr"><?php echo htmlspecialchars($row["lp_id_vrsta_robe"]) ?></td>
</tr>
<tr>
<td class="hr"><?php echo htmlspecialchars("id_marka")."&nbsp;" ?></td>
<td class="dr"><?php echo htmlspecialchars($row["lp_id_marka"]) ?></td>
</tr>
<tr>
<td class="hr"><?php echo htmlspecialchars("naziv_robe")."&nbsp;" ?></td>
<td class="dr"><?php echo htmlspecialchars($row["naziv_robe"]) ?></td>
</tr>
<tr>
<td class="hr"><?php echo htmlspecialchars("id_namena")."&nbsp;" ?></td>
<td class="dr"><?php echo htmlspecialchars($row["lp_id_namena"]) ?></td>
</tr>
<tr>
<td class="hr"><?php echo htmlspecialchars("velicina")."&nbsp;" ?></td>
<td class="dr"><?php echo htmlspecialchars($row["velicina"]) ?></td>
</tr>
<tr>
<td class="hr"><?php echo htmlspecialchars("cena")."&nbsp;" ?></td>
<td class="dr"><?php echo htmlspecialchars($row["cena"]) ?></td>
</tr>
<tr>
<td class="hr"><?php echo htmlspecialchars("pol")."&nbsp;" ?></td>
<td class="dr"><?php echo htmlspecialchars($row["pol"]) ?></td>
</tr>
<tr>
<td class="hr"><?php echo htmlspecialchars("id_boja")."&nbsp;" ?></td>
<td class="dr"><?php echo htmlspecialchars($row["lp_id_boja"]) ?></td>
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
<td class="hr"><?php echo htmlspecialchars("id_vrsta_robe")."&nbsp;" ?></td>
<td class="dr"><select name="id_vrsta_robe">
<?php
  $sql = "select `id`, `vrsta_robe` from `vrsta_robe`";
  $res = mysqli_query($conn, $sql) or die(mysqli_error());

  while ($lp_row = mysqli_fetch_assoc($res)){
  $val = $lp_row["id"];
  $caption = $lp_row["vrsta_robe"];
  if ($row["id_vrsta_robe"] == $val) {$selstr = " selected"; } else {$selstr = ""; }
 ?><option value="<?php echo $val ?>"<?php echo $selstr ?>><?php echo $caption ?></option>
<?php } ?></select>
</td>
</tr>
<tr>
<td class="hr"><?php echo htmlspecialchars("id_marka")."&nbsp;" ?></td>
<td class="dr"><select name="id_marka">
<?php
  $sql = "select `id`, `marka` from `marka`";
  $res = mysqli_query($conn, $sql) or die(mysqli_error());

  while ($lp_row = mysqli_fetch_assoc($res)){
  $val = $lp_row["id"];
  $caption = $lp_row["marka"];
  if ($row["id_marka"] == $val) {$selstr = " selected"; } else {$selstr = ""; }
 ?><option value="<?php echo $val ?>"<?php echo $selstr ?>><?php echo $caption ?></option>
<?php } ?></select>
</td>
</tr>
<tr>
<td class="hr"><?php echo htmlspecialchars("naziv_robe")."&nbsp;" ?></td>
<td class="dr"><input type="text" name="naziv_robe" maxlength="30" value="<?php echo str_replace('"', '&quot;', trim($row["naziv_robe"])) ?>"></td>
</tr>
<tr>
<td class="hr"><?php echo htmlspecialchars("id_namena")."&nbsp;" ?></td>
<td class="dr"><select name="id_namena">
<option value=""></option>
<?php
  $sql = "select `id`, `namena` from `namena`";
  $res = mysqli_query($conn, $sql) or die(mysqli_error());

  while ($lp_row = mysqli_fetch_assoc($res)){
  $val = $lp_row["id"];
  $caption = $lp_row["namena"];
  if ($row["id_namena"] == $val) {$selstr = " selected"; } else {$selstr = ""; }
 ?><option value="<?php echo $val ?>"<?php echo $selstr ?>><?php echo $caption ?></option>
<?php } ?></select>
</td>
</tr>
<tr>
<td class="hr"><?php echo htmlspecialchars("velicina")."&nbsp;" ?></td>
<td class="dr"><input type="text" name="velicina" maxlength="6" value="<?php echo str_replace('"', '&quot;', trim($row["velicina"])) ?>"></td>
</tr>
<tr>
<td class="hr"><?php echo htmlspecialchars("cena")."&nbsp;" ?></td>
<td class="dr"><input type="text" name="cena" value="<?php echo str_replace('"', '&quot;', trim($row["cena"])) ?>"></td>
</tr>
<tr>
<td class="hr"><?php echo htmlspecialchars("pol")."&nbsp;" ?></td>
<td class="dr"><input type="text" name="pol" maxlength="6" value="<?php echo str_replace('"', '&quot;', trim($row["pol"])) ?>"></td>
</tr>
<tr>
<td class="hr"><?php echo htmlspecialchars("id_boja")."&nbsp;" ?></td>
<td class="dr"><select name="id_boja">
<?php
  $sql = "select `id`, `boja` from `boja`";
  $res = mysqli_query($conn, $sql) or die(mysqli_error());

  while ($lp_row = mysqli_fetch_assoc($res)){
  $val = $lp_row["id"];
  $caption = $lp_row["boja"];
  if ($row["id_boja"] == $val) {$selstr = " selected"; } else {$selstr = ""; }
 ?><option value="<?php echo $val ?>"<?php echo $selstr ?>><?php echo $caption ?></option>
<?php } ?></select>
</td>
</tr>
</table>
<?php } ?>

<?php function showpagenav($page, $pagecount)
{
?>
<table class="bd" border="0" cellspacing="1" cellpadding="4">
<tr>
<td class="addbtn"><a href="roba.php?a=add">Dodaj</a>&nbsp;</td>
<?php if ($page > 1) { ?>
<td><a href="roba.php?page=<?php echo $page - 1 ?>">&lt;&lt;&nbsp;Prethodna</a>&nbsp;</td>
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
<td><a href="roba.php?page=<?php echo $j ?>"><?php echo $j ?></a></td>
<?php } } } else { ?>
<td><a href="roba.php?page=<?php echo $startpage ?>"><?php echo $startpage ."..." .$count ?></a></td>
<?php } } } ?>
<?php if ($page < $pagecount) { ?>
<td>&nbsp;<a href="roba.php?page=<?php echo $page + 1 ?>">Sledeca&nbsp;&gt;&gt;</a>&nbsp;</td>
<?php } ?>
</tr>
</table>
<?php } ?>

<?php function showrecnav($a, $recid, $count)
{
?>
<table class="bd" border="0" cellspacing="1" cellpadding="4">
<tr>
<td><a href="roba.php">Pocetna stranica</a></td>
<?php if ($recid > 0) { ?>
<td><a href="roba.php?a=<?php echo $a ?>&recid=<?php echo $recid - 1 ?>">Prethodna stranica</a></td>
<?php } if ($recid < $count - 1) { ?>
<td><a href="roba.php?a=<?php echo $a ?>&recid=<?php echo $recid + 1 ?>">Sledeca stranica</a></td>
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
<td><a href="roba.php">Pocetna stranica</a></td>
</tr>
</table>
<hr size="1" noshade>
<form enctype="multipart/form-data" action="roba.php" method="post">
<p><input type="hidden" name="sql" value="insert"></p>
<?php
$row = array(
  "id" => "",
  "id_vrsta_robe" => "",
  "id_marka" => "",
  "naziv_robe" => "",
  "id_namena" => "",
  "velicina" => "",
  "cena" => "",
  "pol" => "",
  "id_boja" => "");
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
<td class="addbtn"><a href="roba.php?a=edit&recid=<?php echo $recid ?>">Uredi</a></td>
<td class="addbtn"><a href="roba.php?a=del&recid=<?php echo $recid ?>">Izbrisi</a></td>
</tr>
</table>
<?php
  mysqli_free_result($res);
} ?>

<?php function editrec($recid)
{
  $res = sql_select();
  $count = sql_getrecordcount();
  mysqli_data_seek($res, $recid);
  $row = mysqli_fetch_assoc($res);
  showrecnav("edit", $recid, $count);
?>
<br>
<form enctype="multipart/form-data" action="roba.php" method="post">
<input type="hidden" name="sql" value="update">
<input type="hidden" name="xid" value="<?php echo $row["id"] ?>">
<?php showroweditor($row, true); ?>
<p><input type="submit" name="action" value="Postavi"></p>
</form>
<?php
  mysqli_free_result($res);
} ?>

<?php function deleterec($recid)
{
  $res = sql_select();
  $count = sql_getrecordcount();
  mysqli_data_seek($res, $recid);
  $row = mysqli_fetch_assoc($res);
  showrecnav("del", $recid, $count);
?>
<br>
<form action="roba.php" method="post">
<input type="hidden" name="sql" value="delete">
<input type="hidden" name="xid" value="<?php echo $row["id"] ?>">
<?php showrow($row, $recid) ?>
<p><input type="submit" name="action" value="Potvrdi"></p>
</form>
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
  $sql = "SELECT * FROM (SELECT t1.`id`, t1.`id_vrsta_robe`, lp1.`vrsta_robe` AS `lp_id_vrsta_robe`, t1.`id_marka`, lp2.`marka` AS `lp_id_marka`, t1.`naziv_robe`, t1.`id_namena`, lp4.`namena` AS `lp_id_namena`, t1.`velicina`, t1.`cena`, t1.`pol`, t1.`id_boja`, lp8.`boja` AS `lp_id_boja` FROM `roba` AS t1 LEFT OUTER JOIN `vrsta_robe` AS lp1 ON (t1.`id_vrsta_robe` = lp1.`id`) LEFT OUTER JOIN `marka` AS lp2 ON (t1.`id_marka` = lp2.`id`) LEFT OUTER JOIN `namena` AS lp4 ON (t1.`id_namena` = lp4.`id`) LEFT OUTER JOIN `boja` AS lp8 ON (t1.`id_boja` = lp8.`id`)) subq";
  $res = mysqli_query($conn, $sql) or die(mysqli_error());
  return $res;
}

function sql_getrecordcount()
{
  global $conn;
  $sql = "SELECT COUNT(*) FROM (SELECT t1.`id`, t1.`id_vrsta_robe`, lp1.`vrsta_robe` AS `lp_id_vrsta_robe`, t1.`id_marka`, lp2.`marka` AS `lp_id_marka`, t1.`naziv_robe`, t1.`id_namena`, lp4.`namena` AS `lp_id_namena`, t1.`velicina`, t1.`cena`, t1.`pol`, t1.`id_boja`, lp8.`boja` AS `lp_id_boja` FROM `roba` AS t1 LEFT OUTER JOIN `vrsta_robe` AS lp1 ON (t1.`id_vrsta_robe` = lp1.`id`) LEFT OUTER JOIN `marka` AS lp2 ON (t1.`id_marka` = lp2.`id`) LEFT OUTER JOIN `namena` AS lp4 ON (t1.`id_namena` = lp4.`id`) LEFT OUTER JOIN `boja` AS lp8 ON (t1.`id_boja` = lp8.`id`)) subq";
  $res = mysqli_query($conn, $sql) or die(mysqli_error());
  $row = mysqli_fetch_assoc($res);
  reset($row);
  return current($row);
}

function sql_insert()
{
  global $conn;
  global $_POST;

  $sql = "insert into `roba` (`id`, `id_vrsta_robe`, `id_marka`, `naziv_robe`, `id_namena`, `velicina`, `cena`, `pol`, `id_boja`) values (" .sqlvalue(@$_POST["id"], false).", " .sqlvalue(@$_POST["id_vrsta_robe"], false).", " .sqlvalue(@$_POST["id_marka"], false).", " .sqlvalue(@$_POST["naziv_robe"], true).", " .sqlvalue(@$_POST["id_namena"], false).", " .sqlvalue(@$_POST["velicina"], true).", " .sqlvalue(@$_POST["cena"], false).", " .sqlvalue(@$_POST["pol"], true).", " .sqlvalue(@$_POST["id_boja"], false).")";
  mysqli_query($conn, $sql) or die(mysqli_error());
}

function sql_update()
{
  global $conn;
  global $_POST;

  $sql = "update `roba` set `id`=" .sqlvalue(@$_POST["id"], false).", `id_vrsta_robe`=" .sqlvalue(@$_POST["id_vrsta_robe"], false).", `id_marka`=" .sqlvalue(@$_POST["id_marka"], false).", `naziv_robe`=" .sqlvalue(@$_POST["naziv_robe"], true).", `id_namena`=" .sqlvalue(@$_POST["id_namena"], false).", `velicina`=" .sqlvalue(@$_POST["velicina"], true).", `cena`=" .sqlvalue(@$_POST["cena"], false).", `pol`=" .sqlvalue(@$_POST["pol"], true).", `id_boja`=" .sqlvalue(@$_POST["id_boja"], false) ." where " .primarykeycondition();
  mysqli_query($conn, $sql) or die(mysqli_error());
}

function sql_delete()
{
  global $conn;

  $sql = "delete from `roba` where " .primarykeycondition();
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
