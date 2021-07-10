<?php
session_start();

include("connect.php");

$kapcsolat=new mysqli( $szerver,$db_user,$db_pass,$db );

$pcs="select * from ".$db_tabla." where ";

$felt=array();

foreach( $_POST as $mezo=>$ertek )
{
	array_push($felt,$mezo."='".$ertek."'");
}

$pcs=$pcs.implode(" and ",$felt);

$vissza= $kapcsolat->query($pcs);

if( mysqli_num_rows($vissza) == 1 )
{
	//print("ok");
	
	$sor=mysqli_fetch_assoc($vissza);
	
	$_SESSION[ $aktuser ] = $sor;
	
	header("Location:".$fomodul);
	
}
else header("Location:".$fomodul."?errorlogin=1");

?>