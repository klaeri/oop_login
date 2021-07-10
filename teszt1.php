<?php
session_start();
?>

<link rel="stylesheet" type="text/css" href="stilus.css">

<?php
include("connect.php");
require("class.belepes.php");

$b1=new belepes();

$b1->belepes(
	array(
		"szerver"=>$szerver,
		"user"=>$db_user,
		"pass"=>$db_pass,
		"adatbazis"=>$db,
		"tabla"=>$db_tabla,
		"aktuser"=>$aktuser,
		"belepeskor_mutat"=>"email",
		"kilepes_felirat"=>"Kijelentkezés",
		"fomodul"=>$fomodul,
		"mezok"=>array(
					"email"=>array("tipus"=>"varchar" , "szelesseg"=>40 , "belepes_mezo"=>true,"mezo_felirat"=>"E-mail")
					,
					"jelszo"=>array("tipus"=>"varchar" , "szelesseg"=>32 , "belepes_mezo"=>true,"mezo_felirat"=>"Jelszó","mezo_tipus"=>"password")
					,
					"ugyfelkod"=>array("tipus"=>"varchar" , "szelesseg"=>10 , "belepes_mezo"=>true,"mezo_felirat"=>"Ügyfélkód","mezo_tipus"=>"password")
					,
					"mobil"=>array("tipus"=>"varchar" , "szelesseg"=>20 , "mezo_felirat"=>"Mobil...")
					),
		"mezostilus"=>"urlap_mezo"
		,
		"belep_gomb_felirat"=>"Belépés"
		,
		"belepes_ellenor"=>"belep.php"
		,
		"belepeshiba"=>"Invalid login"
		)
	);
?>

<DIV class="belepes_doboz">
	<?php
		$b1->belepes_creator();
	?>
</DIV>



