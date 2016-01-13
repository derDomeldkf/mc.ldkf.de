<?php
	session_start();
	$i=0;
	$ports = array("1" => "25565", "2" => "25566", "3" => "25567", "4" => "25568");
	include "../bots/ldkf_bot/get.php";
	$type=0;
	$motd="";
	foreach ($ports as $port){
		$server = new MCServerStatus("localhost", $port); 
		$var = $server->online; 
		$domain="ldkf.de:".$port;
		if($var==false) {
 			$status='offline'; 
 			$info="";
		} 
		else {		
			$im= $server->online_players;
			$max=$server->max_players;
			$status='online'; 
			$info='<br>Spieler online: '.$im.'/'.$max; 
			$motd = $server->motd; 
			$motd_out= " (".$motd.")";
			if($port=="25566") {
				$type=1;
			}
			if($i>0) {
				$text[$port]="<br>".$domain.''.$motd_out.'<br>Status: '.$status.''.$info;
			}
			else {
				$text[$port]=$domain.''.$motd_out.'<br>Status: '.$status.''.$info;
			}
			$i++;
		}
	}
	if($i==0) {
		$text[$i]="Alle Server sind offline.";
	}
?>
<!DOCTYPE html>
<html lang="de">
  <head>
	 <link rel="icon" href="favicon.png">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	 <meta http-equiv="content-type" content="text/html; charset=UTF-8" > 
	 <meta name="robots" content="index,follow">
 	 <meta name="description" content="">
	 <meta name="keywords" content=""> 
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>mc.ldkf.de</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/lightbox.css">
    <script type="text/javascript" src="https://msn.ldkf.de/js/jquery-1.11.2.min.js"></script>
    <script type="text/javascript" src="https://msn.ldkf.de/js/bootstrap.min.js"></script>
	 <style>
		@font-face {
			font-family: 'ubuntu-m';
			src: url('fonts/Ubuntu-M.ttf');
		}
		html, body {
			width: 100%;
			height: 100%;
			margin: 0;
			padding: 0;
			overflow: hidden;
		}

		#hintergrund {
			min-width: 100%;
			min-height: 100%;
			position: absolute;
			z-index: 1;
		}
		.dl {
			padding-left:30px;
			padding-top:2px;	
			margin-bottom: 20px;	
		}
		.con_out{
			margin-top: 80px;
			margin-bottom: 80px;
			background-color: rgba(0, 0, 0, 0.6);
		}
		.con_in{
			padding:20px;
			color:white;
			font-family: ubuntu-m;

		}
		#content {
			position: absolute;
			top: 0;
			left: 0;
			width: 100%;
			height: 100%;
			z-index: 2;
			overflow: auto;

		} 
	</style>	
	</head>
<body>
<div>
	<img id="hintergrund" src="bg.jpg"/>
</div>
	<div id="content">
		<div class="con_out" style="width:210px; margin-left:0; margin-right:10px; float:left;">
			<div class="con_in">
			<div style="padding-bottom:8px; padding-left:2px;">
				<?php
					if(!isset($_SESSION['control']) or $_SESSION['control']=="") {
						foreach($text as $output){
							echo $output."<br>";
						}
					}
					else {
						echo $_SESSION['control'];	
						$check=explode(": ", $_SESSION['control']);
						if($check[0]=="Server wurde gestartet") {
							$motd = $check[1];
							echo '<script>							
								Timer = setTimeout("start()", 20000);
							</script>';
						}
						if($check[0]=="Server wurde gestoppt") {
							$motd = "";
						}
						unset($_SESSION['control']);			
					}
				;
				?>
				</div>
				<button class="btn-primary btn" style="color:white;" data-toggle="modal" data-target="#modal" onclick="loadDoc()">
					Start/Stop				
				</button><br><br>
  				<a class="example-image-link" href="bg.jpg" data-lightbox="example-set" data-title="">
					<button class="btn-primary btn" style="color:white;">Gallery</button>
				</a>
				<?php
					$ordner = "gallery/"; 
					$allebilder = scandir($ordner); 
					foreach ($allebilder as $bild) { 
		   			if ($bild != "." && $bild != ".."  && $bild != "_notes") { 
								echo '<a class="example-image-link" href="gallery/'.$bild.'" data-lightbox="example-set" data-title=""></a>';
    					}
 					}   
 				if($type==1) {
					echo  '<br><br><a class="btn-success btn" style="color:white;" href="http://www.ldkf.de:8123/" target="_blank">Dynamic Map</a>';		
 				}
 				?>
 			 </div>  
		</div> 
		<div class="con_out" style="min-width:400px; right:0; float:right;">
			<div class="con_in"> 
				<h3>Downloads</h3>
				<div class="dl">					
					<h4>Modsammlungen:</h4>
					<div class="dl">					
						<?php
							$dlordner = "Downloads/packed_mods"; 
							$downloads = scandir($dlordner); 
							foreach ($downloads as $link) { 
		  						if ($link != "." && $link != ".." && $link !="single_mods") { 
									echo '<a style="color:white;" href="Downloads/packed_mods/'.$link.'">'.$link.'</a><br>';
    							}
 							}   
 						?>
 					</div>
					<h4>Einzelne Mods:</h4>
					<div class="dl">	
						<?php
							$dlordner = "Downloads/single_mods"; 
							$downloads = scandir($dlordner); 
							foreach ($downloads as $link) { 
		  						if ($link != "." && $link != "..") { 
									echo '<a style="color:white;" href="Downloads/single_mods/'.$link.'">'.$link.'</a><br>';
    							}
 							}   
 						?>
 					</div>
 					<h4>Recourcepacks:</h4>
					<div class="dl">	
						<?php
							$dlordner = "Downloads/recourcepacks"; 
							$downloads = scandir($dlordner); 
							foreach ($downloads as $link) { 
		  						if ($link != "." && $link != "..") { 
									echo '<a style="color:white;" href="Downloads/recourcepacks/'.$link.'">'.$link.'</a><br>';
    							}
 							}   
 						?>
 					</div>
 					<h4>Sonstiges:</h4>
					<div class="dl">	
						<?php
							$dlordner = "Downloads/other"; 
							$downloads = scandir($dlordner); 
							foreach ($downloads as $link) { 
		  						if ($link != "." && $link != "..") { 
									echo '<a style="color:white;" href="Downloads/other/'.$link.'">'.$link.'</a><br>';
    							}
 							}   
 						?>
 					</div>
				</div>			   			   		
   		</div> 
		</div> 
		<div class="con_out"  style="min-width:310px;float:left;">
		<?php
					$ordner = "videos/"; 
					$allebilder = scandir($ordner); 
					foreach ($allebilder as $bild) { 
		   			if ($bild != "." && $bild != ".."  && $bild != "_notes") { 
		   				$pic=  str_replace("webm", "png",$bild);
		   				echo '<div class="con_in" style=" padding:10px; ">';
							echo '<video width="390" poster="poster/'.$pic.'" controls><source src="videos/'.$bild.'" type="video/webm">';
							echo '</video> </div>';
    					}
 					}   
 				?>				
			</div>
		</div>
	</div>
	<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog modal-sm" role="document" style="margin-top:52px;">
			<div class="modal-content">
				<div class="modal-header" style="padding-top:5px; padding-bottom:22px; padding-right:10px;">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</div>
				<div class="modal-body">
					<form method="post" class="navbar-form " action="control.php">
					<span><b> Server:</b></span><br>
        			<div class="input-group" style="color:black; vertical-align:middle">
							<span class="input-group">			
								<input style="height:0; margin:1px;" autocomplete="off" type="checkbox" id="Classic" name="classic"<?php if($motd=="Classic"){echo ' checked';  if (isset($check[0]) and $check[0]=="Server wurde gestartet") {echo ' disabled';}  echo'> <input type="hidden" name="classic_h" value="1"';}   ?>> 							
							</span> Classic (ldkf.de:25565)									
						</div>	
						<div class="input-group" style="color:black; vertical-align:middle">
							<span class="input-group">										
								<input style="height:0; margin:1px;" autocomplete="off" type="checkbox" id="Hogwarts" name="hogwarts"<?php if($motd=="Hogwarts"){echo ' checked';  if (isset($check[0]) and $check[0]=="Server wurde gestartet") {echo ' disabled';}  echo'> <input type="hidden" name="hogwarts_h" value="1"';} ?><?php  if($motd=="Creative" or $motd=="Millenaire"){ echo ' disabled';} ?>> 
							</span> Hogwarts (ldkf.de:25566)									
						</div>
						<div class="input-group" style="color:black; vertical-align:middle">
							<span class="input-group">										
								<input style="height:0; margin:1px;" autocomplete="off" type="checkbox" id="Creative" name="creative"<?php if($motd=="Creative"){echo ' checked';  if (isset($check[0]) and $check[0]=="Server wurde gestartet") {echo ' disabled';}  echo'> <input type="hidden" name="creative_h" value="1"';}   ?><?php  if($motd=="Hogwarts" or $motd=="Millenaire"){ echo ' disabled';} ?>> 
							</span> Creative (ldkf.de:25566)									
						</div>
						<div class="input-group" style="color:black; vertical-align:middle">
							<span class="input-group">										
								<input style="height:0; margin:1px;" autocomplete="off" type="checkbox" id="Millenaire" name="millenaire"<?php if($motd=="Millenaire"){echo ' checked';  if (isset($check[0]) and $check[0]=="Server wurde gestartet") {echo ' disabled';}  echo'> <input type="hidden" name="millenaire_h" value="1"';} ?><?php  if($motd=="Hogwarts" or $motd=="Creative"){ echo ' disabled';} ?>> 
							</span> Millenaire (ldkf.de:25566)									
						</div>
						<div class="input-group" style="color:black; vertical-align:middle">
							<span class="input-group">										
								<input style="height:0; margin:1px;" autocomplete="off" type="checkbox" id="Paintball" name="paintball"<?php if($motd=="Paintball"){echo ' checked';  if (isset($check[0]) and $check[0]=="Server wurde gestartet") {echo ' disabled';}  echo'> <input type="hidden" name="paintball_h" value="1"';}   ?>> 
							</span> Paintball (ldkf.de:25568)									
						</div>
						
						<br><br>
						<span><b> Passwort:</b></span><br>
						<input style="" autocomplete="off" type="password" name="pw"> 
						<button type="submit">Gib ihm</button>
					</form>
      		</div>
      	</div>
  		</div>
	</div>
	<script src="js/jquery-1.11.2.min.js"></script>
	<script src="js/lightbox.js"></script>	
	<script type="text/javascript">
	  function start() {
	  	    document.getElementById('<?php echo $check[1] ;?>').disabled = false;
	  }
	</script>
	</body>
</html>