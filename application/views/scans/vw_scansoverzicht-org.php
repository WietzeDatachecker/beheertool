<?php
			  $query = $this->db->query('SELECT *, DataCgebruikers.Bedrijfsnaam FROM DataCUploads INNER JOIN DataCgebruikers ON DataCUploads.UserID=DataCgebruikers.UID ORDER BY DataCUploads.UID DESC LIMIT 100');
			?>

<!DOCTYPE html>
<html lang="en">
 <head>
   <title>DataChecker beheer</title>
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link href="../css/bootstrap.min.css" rel="stylesheet" media="screen">
   <link href="../css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
   <link rel="stylesheet" href="../css/font-awesome.min.css">
    <link href="../css/datac-style.css" rel="stylesheet" media="screen">
 </head>
 <body>
 	<div class="navbar navbar-inverse navbar-fixed-top">
	
	<div class="navbar-inner">
		
		<div class="container">
			
			<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
				<i class="icon-cog"></i>
			</a>
			
			<a class="brand">
				DataChecker beheer <sup>1.4</sup>
			</a>		
			 <ul class="nav">vw_
			 	<li class=""><a href="home">Dashboard</a></li>
			 	<li class="dropdown">
			 		<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<i class="icon-user wit"></i> 
							Gebruikers
							<b class="caret wit"></b>
						</a>
						
						<ul class="dropdown-menu">
							<li> <a href="gebruikers">Overzicht</a></li>
							<li> <a href="gebruikers/gebruikersaanmaken">Aanmaken</a></li>
						</ul>
			 	
			 	</li>
			 	<li class="dropdown active">
			 		<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<i class="icon-file-alt wit"></i> 
							Uploads
							<b class="caret wit"></b>
						</a>
						
						<ul class="dropdown-menu">
							<li> <a href="scanoverzicht">Overzicht</a></li>
						</ul>
			 	
			 	</li>	
			 	<li class=""><a href="rapportages" onclick="return false" style="color:#bbb"><i class="icon-eur wit"></i> Rapportages <sup>(soon available)</sup></span></a> </li>	
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
							<li> <a href="home/logout">Uitloggen</a></li>
						</ul>
						
					</li>
				</ul>
			</div><!--/.nav-collapse -->	
	
		</div> <!-- /container -->
		
	</div> <!-- /navbar-inner -->
	
</div>
<br /><br /><br />
<div class="container">
      <div class="row">
        <div class="span8">
			


			<h2>Laatste 100 scans</h2>
			<div class="well">
			          <table class="table">
			              <thead>
			                <tr>
			                  <th></th>
			                  <th>Bedrijfsnaam</th>
			                  <th>Naam</th>
			                  <th>Scan datum</th>
			                  <th>Status</th>
			                </tr>
			              </thead>
			              <tbody>
			                <?php
			                  foreach ($query->result() as $row)
			                    {
			                      if($row->Status == 1 || $row->Status == 2) {
			                        echo "<tr class='success'>";
			                      }
			                      elseif ($row->Status == 3 || $row->Status == 999) {
			                        echo "<tr class='error'>";
			                      }
			                      else{
			                        echo "<tr class='info'>";
			                      }
			                      echo "<td><a href='scanoverzicht/scandetails/".$row->IDCid."'><i class='icon-search'></i></a></td>";
			                      echo "<td class='bl'><a href='gebruikers/haalgebruikersgegevens/".$row->UID."/false/false/false'>".$row->Bedrijfsnaam."</a></td>";
			                      echo "<td>".$row->Voornaam." ".$row->Achternaam."</td>";
			                      echo "<td>".date('d-m-Y H:i:s', strtotime($row->Starttijd))."</td>";
			                       if($row->Status == 1 || $row->Status == 2) {
			                        echo "<td>Goedgekeurd</td>";
			                      }
			                      elseif ($row->Status == 3 || $row->Status == 999) {
			                        echo "<td>Afgekeurd</td>";
			                      }
			                      else{
			                        echo "<td>In behandeling</td>";
			                      }
			                      echo "</tr>"; 
			                    }
			                ?>
			              </tbody>
			            </table>
			</div>
        </div><!--/span-->
        <div class="span4">
       	<h2>Zoek een upload</h2>
       	 <div class="control-group">
						<label class="control-label" for="input01" name="txtachternaam">Achternaam</label>
					      <div class="controls">
					        <input type="text" class="input-xlarge" id="txtachternaam" name="txtachternaam">
					       
					      </div>
					</div>
					<div class="control-group">
						<label class="control-label" for="input01"></label>
					      <div class="controls">
					       <button type="submit" class="btn btn-primary" rel="tooltip" title="first tooltip">Zoek upload</button>
					       
					      </div>
					
					</div>
        </div><!--/span-->
      </div><!--/row-->

      <hr>

      <footer>
        <p>&copy; DataChecker</p>
      </footer>

    </div>


    <script src="http://code.jquery.com/jquery.js"></script>
    <script src="../js/bootstrap.min.js"></script>
 </body>
</html>
