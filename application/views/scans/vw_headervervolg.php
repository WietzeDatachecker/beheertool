<?php
	$testurl = 'http://development.datachecker.nl/beheertool/';
	$liveurl = 'http://www.datachecker.nl/Databeheer/';
	$test = false;

	
?>
<!DOCTYPE html>
<html lang="en">
 <head>
 <?php
 	if($test == true){
	 	echo '<title>DataChecker beheer</title>';
	    echo '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
	    echo '<link href="'.$testurl.'css/bootstrap.min.css" rel="stylesheet" media="screen">';
	    echo '<link href="'.$testurl.'css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">';
	    echo '<link rel="stylesheet" href="'.$testurl.'css/font-awesome.min.css">';
	    echo '<link href="'.$testurl.'css/datac-style.css" rel="stylesheet" media="screen">';
	} else {
		echo '<title>DataChecker beheer</title>';
	    echo '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
	    echo '<link href="../../../css/bootstrap.min.css" rel="stylesheet" media="screen">';
	    echo '<link href="../../../css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">';
	    echo '<link rel="stylesheet" href="../../../css/font-awesome.min.css">';
	    echo '<link href="../../../css/datac-style.css" rel="stylesheet" media="screen">';
	    
	}

?>
   
 </head>
 <body>
 	<div class="navbar navbar-inverse navbar-fixed-top">
	
	<div class="navbar-inner">
		
		<div class="container">
			
			<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
				<i class="icon-cog"></i>
			</a>
			
			<a href="home" class="brand">
				DataChecker beheer <sup>1.8</sup>
			</a>		
			 <ul class="nav">
			 	<li class=""><a href="../../home">Dashboard</a></li>
			 	<li class="dropdown">
			 		<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<i class="icon-user wit"></i> 
							Gebruikers
							<b class="caret wit"></b>
						</a>
						
						<ul class="dropdown-menu">
							<li> <a href="../../gebruikers">Overzicht</a></li>
							<li> <a href="../../gebruikers/gebruikersaanmaken">Aanmaken</a></li>
						</ul>
			 	
			 	</li>
			 	<li class="dropdown ">
			 		<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<i class="icon-file-alt wit"></i> 
							Uploads
							<b class="caret wit"></b>
						</a>
						
						<ul class="dropdown-menu">
							<li> <a href="../../scanoverzicht">Overzicht</a></li>
						</ul>
			 	
			 	</li>
			 	<li class=""><a href="../../rapportage"><i class="icon-eur wit"></i> Rapportages </span></a> </li>	
			 </ul>
			<div class="nav-collapse collapse">
				<ul class="nav pull-right">
			
					<li class="dropdown">
						
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<i class="icon-user wit"></i> 
							<?php echo $naam; ?>
							<b class="caret wit"></b>
						</a>
						
						<ul class="dropdown-menu">
							<li> <a href="../../home/logout">Uitloggen</a></li>
						</ul>
						
					</li>
				</ul>
			</div><!--/.nav-collapse -->
		</div> <!-- /container -->
	</div> <!-- /navbar-inner -->
</div>
<br /><br /><br />
