<?php
  include("data.php");
	session_start();
	if(isset($_POST['pw']) and $_POST['pw']==$pw) {
		if((isset($_POST['hogwarts_h']) and $_POST['hogwarts_h']==1) and !isset($_POST['hogwarts'])) {
			$_SESSION['control']="Server wurde gestoppt: Hogwarts";
			exec('sudo -u minecraft /home/minecraft/data/hogwarts.sh stop');
		}
		if(!isset($_POST['hogwarts_h']) and (isset($_POST['hogwarts']) and $_POST['hogwarts']=="on")) {
			$_SESSION['control']="Server wurde gestartet: Hogwarts";
			exec('sudo -u minecraft /home/minecraft/data/hogwarts.sh start');
		}
		if((isset($_POST['paintball_h']) and $_POST['paintball_h']==1) and !isset($_POST['paintball'])) {
			$_SESSION['control']="Server wurde gestoppt: Paintball";
			exec('sudo -u minecraft /home/minecraft/data/paintball.sh stop');
		}
		if(!isset($_POST['paintball_h']) and (isset($_POST['paintball']) and $_POST['paintball']=="on")) {
			$_SESSION['control']="Server wurde gestartet: Paintball";
			exec('sudo -u minecraft /home/minecraft/data/paintball.sh start');
		}
		if((isset($_POST['creative_h']) and $_POST['creative_h']==1) and !isset($_POST['creative'])) {
			$_SESSION['control']="Server wurde gestoppt: Creative";
			exec('sudo -u minecraft /home/minecraft/data/creative.sh stop');
		}
		if(!isset($_POST['creative_h']) and (isset($_POST['creative']) and $_POST['creative']=="on")) {
			$_SESSION['control']="Server wurde gestartet: Creative";
			exec('sudo -u minecraft /home/minecraft/data/creative.sh start');
		}
		if((isset($_POST['millenaire_h']) and $_POST['millenaire_h']==1) and !isset($_POST['millenaire'])) {
			$_SESSION['control']="Server wurde gestoppt: Millenaire";
			exec('sudo -u minecraft /home/minecraft/data/millenaire_S15.sh stop');
		}
		if(!isset($_POST['millenaire_h']) and (isset($_POST['millenaire']) and $_POST['millenaire']=="on")) {
			$_SESSION['control']="Server wurde gestartet: Millenaire";
			exec('sudo -u minecraft /home/minecraft/data/millenaire_S15.sh start');
		}
		if((isset($_POST['classic_h']) and $_POST['classic_h']==1) and !isset($_POST['classic'])) {
			$_SESSION['control']="Server wurde gestoppt: Classic";
			exec('sudo -u minecraft /home/minecraft/data/Originalmc.sh stop');
		}
		if(!isset($_POST['classic_h']) and (isset($_POST['classic']) and $_POST['classic']=="on")) {
			$_SESSION['control']="Server wurde gestartet: Classic";
			exec('sudo -u minecraft /home/minecraft/data/Originalmc.sh start');
		}
	}
	header('Location: ./');
?>
