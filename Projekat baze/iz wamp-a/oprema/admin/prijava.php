<?php session_start();

?>

<html>
<head>
<title>oprema -- prijava</title>
<meta name="generator" http-equiv="content-type" content="text/html">
<style type="text/css">
  body {
    background-color: #FFFFFF;
    color: #000000;
    font-family: Arial;
    font-size: 12px;
  }
  .bd {
    background-color: #FFFFFF;
    color: #000000;
    font-family: Arial;
    font-size: 12px;
  }
  .tbl {
    background-color: #FFFFFF;
  }
  a:link { 
    color: #FF0000;
    font-family: Arial;
    font-size: 12px;
  }
  a:active { 
    color: #0000FF;
    font-family: Arial;
    font-size: 12px;
  }
  a:visited { 
    color: #800080;
    font-family: Arial;
    font-size: 12px;
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
</style>
</head>
<body>

<table width="100%">
<tr>

<td width="10%" valign="top">
<li><a href="boja.php">boja</a>
<li><a href="grad.php">grad</a>
<li><a href="kupci.php">kupci</a>
<li><a href="marka.php">marka</a>
<li><a href="namena.php">namena</a>
<li><a href="narudzbine.php">narudzbine</a>
<li><a href="roba.php">roba</a>
<li><a href="vrsta_robe.php">vrsta_robe</a>
<li><a href="narudzbine_1.php">narudzbine_1</a>
</td>
<td width="5%">
</td>
<td bgcolor="#e0e0e0">
</td>
<td width="5%">
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
<table class="bd" border="0" cellspacing="1" cellpadding="4">
<tr><td>: prijava</td></tr>
<tr><td>Records shown <?php echo $startrec + 1 ?> - <?php echo $reccount ?> of <?php echo $count ?></td></tr>
</table>
<hr size="1" noshade>
<?php showpagenav($page, $pagecount); ?>
<br>
<table class="tbl" border="0" cellspacing="1" cellpadding="5"width="100%">
<tr>
<td class="hr">&nbsp;</td>
<td class="hr">&nbsp;</td>
<td class="hr">&nbsp;</td>
<td class="hr"><?php echo "id" ?></td>
<td class="hr"><?php echo "korisnicko_ime" ?></td>
<td class="hr"><?php echo "lozinka" ?></td>
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
<td class="<?php echo $style ?>"><a href="prijava.php?a=view&recid=<?php echo $i ?>">Pregledaj</a></td>
<td class="<?php echo $style ?>"><a href="prijava.php?a=edit&recid=<?php echo $i ?>">Uredi</a></td>
<td class="<?php echo $style ?>"><a href="prijava.php?a=del&recid=<?php echo $i ?>">Izbrisi</a></td>
<td class="<?php echo $style ?>"><?php echo htmlspecialchars($row["id"]) ?></td>
<td class="<?php echo $style ?>"><?php echo htmlspecialchars($row["korisnicko_ime"]) ?></td>
<td class="<?php echo $style ?>"><?php echo htmlspecialchars($row["lozinka"]) ?></td>
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
<td class="hr"><?php echo htmlspecialchars("korisnicko_ime")."&nbsp;" ?></td>
<td class="dr"><?php echo htmlspecialchars($row["korisnicko_ime"]) ?></td>
</tr>
<tr>
<td class="hr"><?php echo htmlspecialchars("lozinka")."&nbsp;" ?></td>
<td class="dr"><?php echo htmlspecialchars($row["lozinka"]) ?></td>
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
<td class="hr"><?php echo htmlspecialchars("korisnicko_ime")."&nbsp;" ?></td>
<td class="dr"><input type="text" name="korisnicko_ime" maxlength="20" value="<?php echo str_replace('"', '&quot;', trim($row["korisnicko_ime"])) ?>"></td>
</tr>
<tr>
<td class="hr"><?php echo htmlspecialchars("lozinka")."&nbsp;" ?></td>
<td class="dr"><textarea cols="35" rows="4" name="lozinka" maxlength="65"><?php echo str_replace('"', '&quot;', trim($row["lozinka"])) ?></textarea></td>
</tr>
</table>
<?php } ?>

<?php function showpagenav($page, $pagecount)
{
?>
<table class="bd" border="0" cellspacing="1" cellpadding="4">
<tr>
<td><a href="prijava.php?a=add">Dodaj</a>&nbsp;</td>
<?php if ($page > 1) { ?>
<td><a href="prijava.php?page=<?php echo $page - 1 ?>">&lt;&lt;&nbsp;Prethodna</a>&nbsp;</td>
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
<td><a href="prijava.php?page=<?php echo $j ?>"><?php echo $j ?></a></td>
<?php } } } else { ?>
<td><a href="prijava.php?page=<?php echo $startpage ?>"><?php echo $startpage ."..." .$count ?></a></td>
<?php } } } ?>
<?php if ($page < $pagecount) { ?>
<td>&nbsp;<a href="prijava.php?page=<?php echo $page + 1 ?>">Sledeca&nbsp;&gt;&gt;</a>&nbsp;</td>
<?php } ?>
</tr>
</table>
<?php } ?>

<?php function showrecnav($a, $recid, $count)
{
?>
<table class="bd" border="0" cellspacing="1" cellpadding="4">
<tr>
<td><a href="prijava.php">Pocetna stranica</a></td>
<?php if ($recid > 0) { ?>
<td><a href="prijava.php?a=<?php echo $a ?>&recid=<?php echo $recid - 1 ?>">Prethodna stranica</a></td>
<?php } if ($recid < $count - 1) { ?>
<td><a href="prijava.php?a=<?php echo $a ?>&recid=<?php echo $recid + 1 ?>">Sledeca stranica</a></td>
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
<td><a href="prijava.php">Pocetna stranica</a></td>
</tr>
</table>
<hr size="1" noshade>
<form enctype="multipart/form-data" action="prijava.php" method="post">
<p><input type="hidden" name="sql" value="insert"></p>
<?php
$row = array(
  "id" => "",
  "korisnicko_ime" => "",
  "lozinka" => "");
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
<td><a href="prijava.php?a=add">Dodaj</a></td>
<td><a href="prijava.php?a=edit&recid=<?php echo $recid ?>">Uredi</a></td>
<td><a href="prijava.php?a=del&recid=<?php echo $recid ?>">Izbrisi</a></td>
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
<form enctype="multipart/form-data" action="prijava.php" method="post">
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
<form action="prijava.php" method="post">
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
  $conn = mysqli_connect("localhost", "root", "","oprema");
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
  $sql = "SELECT `id`, `korisnicko_ime`, `lozinka` FROM `prijava`";
  $res = mysqli_query($conn, $sql) or die(mysqli_error());
  return $res;
}

function sql_getrecordcount()
{
  global $conn;
  $sql = "SELECT COUNT(*) FROM `prijava`";
  $res = mysqli_query($conn, $sql) or die(mysqli_error());
  $row = mysqli_fetch_assoc($res);
  reset($row);
  return current($row);
}

function sql_insert()
{
  global $conn;
  global $_POST;

  $sql = "insert into `prijava` (`id`, `korisnicko_ime`, `lozinka`) values (" .sqlvalue(@$_POST["id"], false).", " .sqlvalue(@$_POST["korisnicko_ime"], true).", " .sqlvalue(@$_POST["lozinka"], true).")";
  mysqli_query($conn, $sql) or die(mysqli_error());

function sql_update()
{
  global $conn;
  global $_POST;

  $sql = "update `prijava` set `id`=" .sqlvalue(@$_POST["id"], false).", `korisnicko_ime`=" .sqlvalue(@$_POST["korisnicko_ime"], true).", `lozinka`=" .sqlvalue(@$_POST["lozinka"], true) ." where " .primarykeycondition();
  mysqli_query($conn, $sql) or die(mysqli_error());
}

function sql_delete()
{
  global $conn;

  $sql = "delete from `prijava` where " .primarykeycondition();
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
