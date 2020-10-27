<?php session_start();

?>

<html>
<head>
<title>oprema -- popust</title>
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
  p{
	color : red;
	text-align : right;
	font-size : 16px; 
	margin-bottom : 0px;
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
</style>
</head>
<body>
<header>
<h1>SPORTSKA OPREMA <font style="color:red;">PRO STREET</font></h1>
</header>
<table width="100%" class="tabela">
<tr>
<p>Napomena: Sve cene su izrazene u dinarima!</p>
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

  switch ($a) {
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
<td class="hr"><?php echo "Vrsta Robe" ?></td>
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
<td class="<?php echo $style ?>"><a href="popust.php?a=view&recid=<?php echo $i ?>">Pregledaj</a></td>
<td class="<?php echo $style ?>"><?php echo htmlspecialchars($row["vrsta_robe"]) ?></td>
<td class="<?php echo $style ?>"><?php echo htmlspecialchars($row["marka"]) ?></td>
<td class="<?php echo $style ?>"><?php echo htmlspecialchars($row["naziv_robe"]) ?></td>
<td class="<?php echo $style ?>"><?php echo htmlspecialchars($row["namena"]) ?></td>
<td class="<?php echo $style ?>"><?php echo htmlspecialchars($row["velicina"]) ?></td>
<td class="<?php echo $style ?>"><?php echo htmlspecialchars($row["popust"]) ?></td>
<td class="<?php echo $style ?>"><?php echo htmlspecialchars($row["pol"]) ?></td>
<td class="<?php echo $style ?>"><?php echo htmlspecialchars($row["boja"]) ?></td>
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
<td class="hr"><?php echo htmlspecialchars("vrsta_robe")."&nbsp;" ?></td>
<td class="dr"><?php echo htmlspecialchars($row["vrsta_robe"]) ?></td>
</tr>
<tr>
<td class="hr"><?php echo htmlspecialchars("marka")."&nbsp;" ?></td>
<td class="dr"><?php echo htmlspecialchars($row["marka"]) ?></td>
</tr>
<tr>
<td class="hr"><?php echo htmlspecialchars("naziv_robe")."&nbsp;" ?></td>
<td class="dr"><?php echo htmlspecialchars($row["naziv_robe"]) ?></td>
</tr>
<tr>
<td class="hr"><?php echo htmlspecialchars("namena")."&nbsp;" ?></td>
<td class="dr"><?php echo htmlspecialchars($row["namena"]) ?></td>
</tr>
<tr>
<td class="hr"><?php echo htmlspecialchars("velicina")."&nbsp;" ?></td>
<td class="dr"><?php echo htmlspecialchars($row["velicina"]) ?></td>
</tr>
<tr>
<td class="hr"><?php echo htmlspecialchars("popust")."&nbsp;" ?></td>
<td class="dr"><?php echo htmlspecialchars($row["popust"]) ?></td>
</tr>
<tr>
<td class="hr"><?php echo htmlspecialchars("pol")."&nbsp;" ?></td>
<td class="dr"><?php echo htmlspecialchars($row["pol"]) ?></td>
</tr>
<tr>
<td class="hr"><?php echo htmlspecialchars("boja")."&nbsp;" ?></td>
<td class="dr"><?php echo htmlspecialchars($row["boja"]) ?></td>
</tr>
</table>
<?php } ?>

<?php function showpagenav($page, $pagecount)
{
?>
<table class="bd" border="0" cellspacing="1" cellpadding="4">
<tr>
<?php if ($page > 1) { ?>
<td><a href="popust.php?page=<?php echo $page - 1 ?>">&lt;&lt;&nbsp;Prethodna</a>&nbsp;</td>
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
<td><a href="popust.php?page=<?php echo $j ?>"><?php echo $j ?></a></td>
<?php } } } else { ?>
<td><a href="popust.php?page=<?php echo $startpage ?>"><?php echo $startpage ."..." .$count ?></a></td>
<?php } } } ?>
<?php if ($page < $pagecount) { ?>
<td>&nbsp;<a href="popust.php?page=<?php echo $page + 1 ?>">Sledeca&nbsp;&gt;&gt;</a>&nbsp;</td>
<?php } ?>
</tr>
</table>
<?php } ?>

<?php function showrecnav($a, $recid, $count)
{
?>
<table class="bd" border="0" cellspacing="1" cellpadding="4">
<tr>
<td><a href="popust.php">Pocetna stranica</a></td>
<?php if ($recid > 0) { ?>
<td><a href="popust.php?a=<?php echo $a ?>&recid=<?php echo $recid - 1 ?>">Prethodna stranica</a></td>
<?php } if ($recid < $count - 1) { ?>
<td><a href="popust.php?a=<?php echo $a ?>&recid=<?php echo $recid + 1 ?>">Sledeca stranica</a></td>
<?php } ?>
</tr>
</table>
<hr size="1" noshade>
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
<?php
  mysqli_free_result($res);
} ?>

<?php function connect()
{
  $conn = mysqli_connect("localhost", "root", "", "oprema");
  return $conn;
}

function sqlstr($val)
{
  return str_replace("'", "''", $val);
}

function sql_select()
{
  global $conn;
  $sql = "SELECT * FROM (SELECT vrsta_robe,marka,naziv_robe,namena,velicina,(cena*0.8) AS popust,pol,boja FROM roba LEFT JOIN Vrsta_robe ON roba.id_vrsta_robe=vrsta_robe.id LEFT JOIN Marka ON roba.id_marka=marka.id LEFT JOIN Namena ON roba.id_namena=namena.id LEFT JOIN Boja ON roba.id_boja=boja.id) subq";
  $res = mysqli_query($conn, $sql) or die(mysqli_error());
  return $res;
}

function sql_getrecordcount()
{
  global $conn;
  $sql = "SELECT COUNT(*) FROM (SELECT vrsta_robe,marka,naziv_robe,namena,velicina,(cena*0.8) AS popust,pol,boja FROM roba LEFT JOIN Vrsta_robe ON roba.id_vrsta_robe=vrsta_robe.id LEFT JOIN Marka ON roba.id_marka=marka.id LEFT JOIN Namena ON roba.id_namena=namena.id LEFT JOIN Boja ON roba.id_boja=boja.id) subq";
  $res = mysqli_query($conn, $sql) or die(mysqli_error());
  $row = mysqli_fetch_assoc($res);
  reset($row);
  return current($row);
} ?>
