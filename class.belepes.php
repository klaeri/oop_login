<?php
class belepes
{
	var $szerver="127.0.0.1";
	var $user="root";
	var $pass="";
	var $adatbazis="php_obj_gyakorlas";
	var $tabla="userek";
	var $belepes_ellenor="belepes_check.php";
	var $belep_gomb_felirat="Belépés";
	var $belepeshiba="Sikertelen belépés!";
	
	
	function belepes( $par )
	{
		foreach( $par as $tulajdonsag=>$ertek )
		{
			$this->$tulajdonsag=$ertek;
		}
	
		$this->kapcsolat=new mysqli( $this->szerver , $this->user , $this->pass );
	
		if( !$this->kapcsolat ) print("Sikertelen kapcsolat az adatbázis szerverrel!");
	
		$this->kapcsolat->query("create database if not exists ".$this->adatbazis );
	

		$this->kapcsolat->select_db( $this->adatbazis );
			
		$pcs="create table if not exists ".$this->tabla;
		
		$pcs.="( id int(9) not null auto_increment ,";
		
		foreach( $this->mezok as $mezonev=>$ertek )
		{
			$pcs.=$mezonev." ".$ertek["tipus"]."(".$ertek["szelesseg"].") not null COLLATE utf8_hungarian_ci ,";
		}
		
		$pcs.=" primary key (id))";
		
		//print $pcs;
				
		$this->kapcsolat->query( $pcs );		
				
		
		if( isset( $_GET["logout"] ) )
		{
			unset($_SESSION[$this->aktuser]);
		}
		
	}
	
	function belepes_creator()
	{
		if( isset( $_SESSION[$this->aktuser] ) )
		{
			print("<DIV class='belepett_user'>".$_SESSION[$this->aktuser][$this->belepeskor_mutat]."</DIV>");
			
			print("<BR><A HREF='".$this->fomodul."?logout=1'>".$this->kilepes_felirat."</A>");
		}
		else
		{
		
		if( isset( $_GET["errorlogin"] ) )
		{
			print("<DIV class='errorlogin'>".$this->belepeshiba."</DIV>");
		}
		
		if( isset($this->mezostilus) )
		{
			$mezostilus=$this->mezostilus;
		}
		else $mezostilus="";
		
		print("<FORM action='".$this->belepes_ellenor."' method='POST'>");
		
		foreach( $this->mezok as $mezonev=>$ertek )
		{
			if( isset( $ertek["belepes_mezo"] ) )
			{
				if( isset( $ertek["mezo_felirat"] ) )
				{
					$mezofelirat=$ertek["mezo_felirat"];
				}
				else $mezofelirat="";
			
				
				if( isset( $ertek["mezo_tipus"] ) )
				{
					$mezo_tipus=$ertek["mezo_tipus"];
				}
				else $mezo_tipus="TEXT";
				
				print("<INPUT name='".$mezonev."' TYPE='".$mezo_tipus."' class='".$mezostilus."' placeholder='".$mezofelirat."'>");
			}
		}
		
	print("<INPUT TYPE='submit' value='".$this->belep_gomb_felirat."'></FORM>");
		
		}
	}
}

?>