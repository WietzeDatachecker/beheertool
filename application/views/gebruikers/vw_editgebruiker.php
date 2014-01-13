<?php
    

	$qrylaatstescans = $this->db->query('SELECT * FROM DataCUploads WHERE UserID ='.$id.' ORDER BY UID DESC' );
	$qrygegevens = $this->db->query('SELECT * FROM `DataCgebruikers` LEFT OUTER JOIN DataCGebruikersNaw ON DataCgebruikers.UID=DataCGebruikersNaw.GebruikersID WHERE DataCgebruikers.UID ='.$id );
	$qrylogging = $this->db->query('SELECT * FROM `DataCLogging` WHERE GebruikersID ='.$id.' order by UID ASC');
	$qryopmerkingen = $this->db->query('SELECT * FROM `DataCOpmerkingen` WHERE GebruikersID ='.$id.' order by UID DESC');

	foreach ($qrygegevens->result() as $row)
	{
		//gebruikers gegevens
		$mbID = $row->mbID;
		$bedrijfsnaam = $row->Bedrijfsnaam;
		$gebruikersnaam = $row->Gebruikersnaam;
		$wachtwoord = $row->Wachtwoord;
		$laatstelogin = $row->Laatst_inlog;
		$saldo = $row->Saldo;
		$portal =  $row->Type_check;

		//adres gegevens
		$adres = $row->Adres;
		$postcode = $row->Postcode;
		$plaats = $row->Plaats;
		$telfoonnummer = $row->Telefoon;
		$mobielnummer = $row->mobiel;
		$emailadres = $row->emailadres;
		$contactpersoon = $row->Contact_persoon;
		$website = $row->website;
	}

	if($mbID > 0) {
		
		$invoiceinfo = $this->mod_moneybird->getinvoice($mbID);

	}
	




?>
<div class="container">
	<!-- Modal -->
<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <h3 id="myModalLabel">Saldo ophogen</h3>
  </div>
  <div class="modal-body">
    <form class="form-horizontal pull-left " id="registerHere" method="post" action="<?php echo base_url();?>index.php/gebruikers/insert_saldo">
	  <fieldset>
	    <div class="control-group">
	      <label class="control-label" for="input01">Aanvrager <span style="color:red;">*</span></label>
	      <div class="controls">
	        <input type="text" class="input-xlarge" id="saldo_aanvrager" name="saldo_aanvrager" >
	        <input type="hidden" value="<?php echo $id; ?>" name="saldo_userid" >
	        <input type="hidden" value="<?php echo $mbID; ?>" name="saldo_mbid" >
	        <input type="hidden" value="<?php echo $bedrijfsnaam; ?>" name="saldo_bedrijfsnaam" >
	        <input type="hidden" value="<?php echo $emailadres; ?>" name="saldo_contactemail" >
	      </div>
	</div>
	    
	 <div class="control-group">
		<label class="control-label" for="input01">Saldo <span style="color:red;">*</span></label>
	      <div class="controls">
	        <input type="text" class="input-xlarge" id="saldo_saldo" name="saldo_saldo">
	       
	      </div>
	</div>
	<div class="control-group">
		<label class="control-label" for="input01">Prijs per check <span style="color:red;">*</span></label>
	      <div class="controls">
	        <input type="text" class="input-xlarge" id="saldo_prijs" name="saldo_prijs">
	       
	      </div>
	</div>
</fieldset>
	
	  </div>
  <div class="modal-footer">
  	 <button class="btn btn-primary">Voeg saldo toe</button>
  	 </form>
    <button class="btn" data-dismiss="modal" aria-hidden="true">Annuleer</button>
   
  </div>
</div>

<!-- Modal -->
<div id="myModalOpmerking" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <h3 id="myModalLabel">Voeg de opmerking toe</h3>
  </div>
  <div class="modal-body">
    <form class="form-horizontal pull-left " id="registerHere" method="post" action="<?php echo base_url();?>index.php/gebruikers/insert_opmerking">
	  <fieldset>
	    <div class="control-group">
	      <div class="controls">
	        <input type="text" value="<?php echo $id; ?>" name="opmerking_userid" >
	        <input type="text" value="<?php echo $naam; ?>" name="opmerking_naam" >
	      </div>
	</div>
	    
	 <div class="control-group">
		<label class="control-label" for="input01">Opmerking <span style="color:red;">*</span></label>
	      <div class="controls">
	        <textarea rows="5" class="input-xlarge" id="opmerking_opmerking" name="opmerking_opmerking"></textarea><br>
	        <input type="checkbox" name="opmerking_actie"  value="1"  > Markeer als actiepunt
	      </div>
	</div>
</fieldset>
	
	  </div>
  <div class="modal-footer">
  	 <button class="btn btn-primary">Voeg opmerking toe</button>
  	 </form>
    <button class="btn" data-dismiss="modal" aria-hidden="true">Annuleer</button>
   
  </div>
</div>


<!-- walter saldo -->
<div id="myModalsaldo" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <h3 id="myModalLabel">Saldo aanpassen</h3>
  </div>
  <div class="modal-body">
    <form class="form-horizontal pull-left " id="registerHere" method="post" action="<?php echo base_url();?>index.php/gebruikers/insert_saldowalter">
	  <fieldset>
	    <div class="control-group">
	    
	      <div class="controls">
	     
	        <input type="hidden" value="<?php echo $id; ?>" name="saldo_userid" >
	        
	      </div>
	</div>
	    
	 <div class="control-group">
		<label class="control-label" for="input01">Huidig saldo <span style="color:red;">*</span></label>
	      <div class="controls">
	        <input type="text" class="input-xlarge" id="saldo_saldo" name="saldo_saldo">
	       
	      </div>
	</div>
	
</fieldset>
	
	  </div>
  <div class="modal-footer">
  	 <button class="btn btn-primary">Pas saldo aan</button>
  	 </form>
    <button class="btn" data-dismiss="modal" aria-hidden="true">Annuleer</button>
   
  </div>
</div>

<div id="modalpass" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="modalpassLabel" aria-hidden="true">
  <div class="modal-header">
    <h3 id="myModalLabel">Nieuw wachtwoord sturen?</h3>
  </div>
  <div class="modal-body">
   		<p>Je staat op het punt een nieuw wachtwoord te sturen naar deze gebruiker.</p>
   		<p>Weet je dat zeker?</p>
	  </div>
  <div class="modal-footer">
  	 <form class="form-horizontal pull-left " id="registerHere" method="post" action="<?php echo base_url();?>index.php/gebruikers/send_nieuwwachtwoord">
	  	 <input type="hidden" value="<?php echo $id; ?>" name="ww_userid" >
	  	 <button class="btn">Stuur nieuw wachtwoord toe</button>
  	 </form>
    <button class="btn btn-danger" data-dismiss="modal" aria-hidden="true">Annuleer</button>
   
  </div>
</div>

      <div class="row">
        <div class="span1">
        	
        </div><!--/span-->
         <div class="span10">
         		<?php if($saldosucces == 'true') {
         				echo "<div class='alert fade in alert-success'><button type='button' class='close' data-dismiss='alert'>X</button><strong>Saldo is met succes opgehoogd, en een factuur verzonden.</div>";

					};

					?>
				<?php if($wwsucces == 'true') {
         				echo "<div class='alert fade in alert-success'><button type='button' class='close' data-dismiss='alert'>X</button><strong>Er is een nieuw wachtwoord verzonden naar de klant.</div>";

					};

					?>
				<?php if($edtsucces == 'true') {
         				echo "<div class='alert fade in alert-success'><button type='button' class='close' data-dismiss='alert'>X</button><strong>De gebruikersgegevens zijn aangepast.</div>";

					};

					?>
         	<legend>Gebruikersgegevens ( <?php echo $bedrijfsnaam ?> )</legend>
				<?PHP 
				// factuur check
				$ist=""; 
				foreach ($invoiceinfo as $invoice ) {
						               			
						               		if($invoice->state == 'late') {$ist="hold"; $fcon="red";  }

						               	}

				
				// saldo check
				if ($saldo==0) { $scon="red"; }
				?>





       			<div class="tabbable"> <!-- Only required for left/right tabs -->
				  <ul class="nav nav-tabs">
				    <li class="active"><a href="#tab1" data-toggle="tab" class="<?PHP echo $scon; ?>">Gebruikersgegevens</a></li>
				    <li><a href="#tab2" data-toggle="tab">Overige gegevens</a></li>
				    <li><a href="#tab6" data-toggle="tab">Gebruikers opmerkingen</a></li>
				    <li><a href="#tab3" data-toggle="tab" class="<?PHP echo $fcon; ?>">Financieel</a></li>
				    <li><a href="#tab4" data-toggle="tab">Laatste uploads</a></li>
				  <li><a href="#tab5" data-toggle="tab">Logging</a></li> 
				  </ul>
				  <div class="tab-content">
				    <div class="tab-pane active" id="tab1">
				     <div class="control-group">
						<label class="control-label" for="input01">Gebruikersnaam</label>
					      <div class="controls">
					        <input type="text" class="input-xlarge uneditable-input" id="user_email" name="gebruikersnaam" value="<?php echo $gebruikersnaam ?>">
					      </div>
					</div>
					<div class="control-group">
						<label class="control-label" for="input01">Wachtwoord</span></label>
					      <div class="controls">
					        <input type="text" class="input-xlarge uneditable-input" id="user_email" name="wachtwoord" value="<?php echo $wachtwoord ?>">
  							<a href="#modalpass" role="button" class="btn btn-small btn-success" data-toggle="modal">Stuur nieuw wachtwoord</a>
					      </div>
					</div>
					<div class="control-group">
						<label class="control-label" for="input01">Laatse login</label>
					      <div class="controls">
					        <input type="text" class="input-xlarge uneditable-input" id="user_email" name="laatstelogin" value="<?php echo $laatstelogin ?>">
					      </div>
					</div>
					<div class="control-group">
						<label class="control-label" for="input01">Saldo</label>
					      <div class="controls">
					        <input type="text" class="input-xlarge uneditable-input" id="user_email" name="laatstelogin" value="<?php echo $saldo ?>">
					        <?php  if($saldo <= 5) 
					        { 
					        	echo "<i class='icon-warning-sign icon-2x' style='color:red;'></i>" ;
					    	}

					        ?>
					      <a href="#myModal" role="button" class="btn btn-small btn-success" data-toggle="modal">Saldo ophogen</a>  <a href="#myModalsaldo" role="button" class="btn btn-small btn-primary" data-toggle="modal">Saldo aanpassen</a>
					      </div>
					</div>
					<div class="control-group">
						<label class="control-label" for="input01">Moneybird klantid</label>
					      <div class="controls">
					        <input type="text" class="input-xlarge uneditable-input" id="user_email" name="mbid" value="<?php echo $mbID ?>">
					      </div>
					</div>
					<div class="control-group">
						<label class="control-label" for="input01">Gebruik de portal</label>
					      <div class="controls">
					        <input type="text" class="input-xlarge uneditable-input" id="user_email" name="portal" value="<?php if($portal == 'BWT') { echo 'Bewusttoetsen';} else { echo 'NVM Woontoets'; } ?>">
					      </div>
					</div>
				    </div>
				    <div class="tab-pane" id="tab2">
				    	<form class="form-horizontal pull-left " id="registerHere" method="post" action="<?php echo base_url();?>index.php/gebruikers/updategegevens">
				    	<div class="control-group">
						<label class="control-label" for="input01">Bedrijfsnaam</label>
					      <div class="controls">
					        <input type="text" class="input-xlarge uneditable-input" id="bedrijfsnaam" name="bedrijfsnaam" value="<?php echo $bedrijfsnaam ?>">
					        <input type="hidden" class="input-xlarge uneditable-input" id="uid" name="uid" value="<?php echo $id ?>">
					      </div>
					</div>
				      <div class="control-group">
						<label class="control-label" for="input01">Adres</label>
					      <div class="controls">
					        <input type="text" class="input-xlarge" id="adres" name="adres" value="<?php echo $adres ?>">
					       
					      </div>
					</div>
					 <div class="control-group">
						<label class="control-label" for="input01">Postcode</label>
					      <div class="controls">
					        <input type="text" class="input-xlarge" id="postcode" name="postcode" value="<?php echo $postcode ?>">
					       
					      </div>
					</div>
					 <div class="control-group">
						<label class="control-label" for="input01">Plaats</label>
					      <div class="controls">
					        <input type="text" class="input-xlarge" id="plaats" name="plaats" value="<?php echo $plaats ?>">
					       
					      </div>
					</div>
					 <div class="control-group">
						<label class="control-label" for="input01">Telefoonnummer</label>
					      <div class="controls">
					        <input type="text" class="input-xlarge" id="telefoon" name="telefoon" value="<?php echo $telfoonnummer ?>">
					       
					      </div>
					</div>
					 <div class="control-group">
						<label class="control-label" for="input01">Mobiel nummer</label>
					      <div class="controls">
					        <input type="text" class="input-xlarge" id="mobiel" name="mobiel" value="<?php echo $mobielnummer ?>">
					       
					      </div>
					</div>
					 <div class="control-group">
						<label class="control-label" for="input01">E-mailadres</label>
					      <div class="controls">
					        <input type="text" class="input-xlarge" id="email" name="email" value="<?php echo $emailadres ?>">
					       
					      </div>
					</div>
					 <div class="control-group">
						<label class="control-label" for="input01">Contact persoon</label>
					      <div class="controls">
					        <input type="text" class="input-xlarge" id="contact_persoon" name="contact_persoon" value="<?php echo $contactpersoon ?>">
					       
					      </div>
					</div>
					 <div class="control-group">
						<label class="control-label" for="input01">Website</label>
					      <div class="controls">
					        <input type="text" class="input-xlarge" id="contact_persoon" name="website" value="<?php echo $website ?>">
					       
					      </div>
					</div>
					<div class="control-group">
						<label class="control-label" for="input01"></label>
					      <div class="controls">
					       <button type="submit" class="btn btn-primary" rel="tooltip" title="first tooltip">Sla gegevens op</button>
					       
					      </div>
					
					</div>
				</form>
				    </div>
					 <div class="tab-pane" id="tab3">
					 	<h2>Financieel</h2>
					 	<div class="well">
						          <table class="table">
						              <thead>
						                <tr>
						                  <th>Bekijk factuur</th>
						                  <th>Factuur nummer</th>
						                  <th>Factuur datum</th>
						                  <th>Bedrag</th>
						                  <th>Status</th>
						                </tr>
						              </thead>
						              <tbody>
						               <?php
						               if($mbID > 0) {
						               	foreach ($invoiceinfo as $invoice ) {
						               			echo "<tr>";
						               			echo "<td><a href='".$invoice->url."' target='_blank'>Bekijk factuur</a></td>";
						                       echo "<td>".$invoice->invoice_id."</td>";
						                       echo "<td>".$invoice->invoice_date->format("d-m-Y")."</td>";
						                       echo "<td>".number_format($invoice->total_price_incl_tax, 2, ",", "")." (incl. BTW)</td>";
						               		if($invoice->state == 'paid') {
						                        echo "<td><span style='color:green;'>Betaald</span></td>";
						                      }
						                      elseif ($invoice->state == 'late') {
						                        echo "<td><span style='color:red;'>Te laat</span></td>";
						                      }
						                      else{
						                        echo "<td>Openstaand</td>";
						                      } 
						                      echo "</tr>";
						               	}
						               }
						               ?>
						              </tbody>
						            </table>
						</div>
					 </div>
				    <div class="tab-pane" id="tab4">
						<h2>Scans</h2>
						<div class="well">
						          <table class="table">
						              <thead>
						                <tr>
						                  <th></th>
						                  <th>Naam</th>
						                  <th>Scan datum</th>
						                  <th>Status</th>
						                </tr>
						              </thead>
						              <tbody>
						                <?php
						                  foreach ($qrylaatstescans->result() as $row)
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
						                       echo "<td><a href='../../../../../../index.php/scanoverzicht/scandetails/".$row->IDCid."'><i class='icon-search'></i></a></td>";
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
										    </div>
						 <div class="tab-pane" id="tab5">
						 	<h2>Logging van klant acties</h2>
						 	<div class="well">
						          <table class="table">
						              <thead>
						                <tr>
						                  <th>Type actie</th>
						                  <th>Actie omschrijving</th>
						                  <th>Datum en tijd</th>
						                </tr>
						              </thead>
						              <tbody>
						                <?php
						                  foreach ($qrylogging->result() as $row)
						                    {
						                      echo "<tr>";
						                      echo "<td>".$row->TypeActie."</td>";
						                      echo "<td>".$row->ActieOmschrijving."</td>";
						                      echo "<td>".$row->ActieDatum."</td>";
						                      echo "</tr>"; 
						                    }
						                ?>
						              </tbody>
						            </table>
						</div>
						 </div>
						  <div class="tab-pane" id="tab6">
							<h2>Gebruikers opmerkingen</h2>
							<?php 
								if($qryopmerkingen->result()) { echo "<a href='#myModalOpmerking' role='button' class='btn btn-small btn-success' data-toggle='modal'>Voeg een opmerking toe</a><br /><br />"; }
							?>
							<div class="well well-large"> 
							<?php if($qryopmerkingen->result()) { ?>
							  <table class="table">
						          <thead>
						            <tr>
						                <th>Datum</th>
						                <th>Door</th>
						                <th>Opmerking</th>
						                <th>Actie</th>
						            </tr>
						      </thead>
						      <tbody>
						                <?php
						                  foreach ($qryopmerkingen->result() as $row)
						                    {
						                      echo "<tr>";
						                      echo "<td>".$row->Datum."</td>";
						                      echo "<td>".$row->Gebruiker."</td>";
						                      echo "<td>".$row->Opmerking."</td>";
						                     
						                      echo "<td>";

						                      if($row->Actie == 1) {echo "<i class='icon-warning-sign icon-2x' style='color:red;'></i>" ;}
						                      echo "</td>";
						                      echo "</tr>"; 
						                    } 
						                ?>
						              </tbody>
						            </table>
						            <?php 
						            	} else {
						            		echo "Geen opmerkingen gevonden voor deze klant.  <a href='#myModalOpmerking' role='button' class='btn btn-small btn-success' data-toggle='modal'>Voeg een opmerking toe</a>";
						            	}

						            ?>
							</div>
						</div>
										  </div>

										</div>
        </div><!--/span-->
        <div class="span1">
       
        </div><!--/span-->
      </div><!--/row-->
\