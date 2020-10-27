<?php

ob_start();
$host="localhost"; // Host name
$username="root"; // Mysql username
$password=""; // Mysql password
$db_name="oprema"; // Database name
$tbl_name="prijava"; // Table name

// Konekcija ka serveru i bazi podataka.
$conn=mysqli_connect("$host", "$username", "$password")or die("cannot connect");
mysqli_select_db($conn, $db_name) or die("cannot select DB");

// Define $korisnik and $lozinka
$korisnik=$_POST['korisnik'];
$lozinka=$_POST['lozinka'];

// Zastita od MySQL injection (vise detalja iz baza podataka u lekciji MySQL injection)
$korisnik = stripslashes($korisnik);
$lozinka = stripslashes($lozinka);
$krisnik = mysqli_real_escape_string($conn, $korisnik);
$lozinka = mysqli_real_escape_string($conn, $lozinka);

$sql="SELECT * FROM $tbl_name WHERE korisnicko_ime='$korisnik' and lozinka=sha1('$lozinka')";
$result=mysqli_query($conn,$sql);

// Mysql_num_row is counting table row
$count=mysqli_num_rows($result);

// Ako postoji poklapanje u $korisnik i $lozinka, tabela mora da ima 1 vrstu
if($count==1) {
	
session_start();
$_SESSION['korisnik'] = $korisnik;

if ($_SESSION['korisnik'] == 'admin'){
    header("location:admin/roba.php");
} 
else {
    header("location:gost/roba.php");
      } 
} 
else {     header("location:login_greska.php");
}
ob_end_flush();
?>