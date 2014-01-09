
<?php
	$this->load->helper('date');
?>
<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
    <h3 id="myModalLabel">Documenten</h3>
  </div>
  <div class="modal-body">
    <p><?php echo '<img src="data:image/jpg;base64,' .$id_front. '" />'; ?></p>

  </div>
</div>

<div class="container">

      <div class="row">
        <div class="span1">
			
        </div><!--/span-->
        <div class="span10">
       	<h2>Upload details</h2>
       	  <ul class="nav nav-tabs">
				    <li class="active"><a href="#tab1" data-toggle="tab">Versneld overzicht</a></li>
				    <li><a href="#tab2" data-toggle="tab">Document gegevens</a></li>
				    <?php if($datagedaan == 'true' ) { echo'<li><a href="#tab3" data-toggle="tab">Persoonsgegevens</a></li>'; } else { echo''; } ?>
				    <?php if($datagedaan == 'true' ) { echo'<li><a href="#tab4" data-toggle="tab">Adres gegevens</a></li>'; } else { echo''; } ?>
				    <?php if($datagedaan == 'true' ) { echo'<li><a href="#tab5" data-toggle="tab">Telefoon gegevens</a></li>'; } else { echo''; } ?>
				    <?php if($datagedaan == 'true' ) { echo'<li><a href="#tab6" data-toggle="tab">Bedrijfsgegevens</a></li>'; } else { echo''; } ?>
				    <?php if($datagedaan == 'true' ) { echo'<li><a href="#tab11" data-toggle="tab">Solventie gegevens</a></li>'; } else { echo''; } ?>
				    <?php if($datagedaan == 'true' ) { echo'<li><a href="#tab7" data-toggle="tab">Curatele informatie</a></li>'; } else { echo''; } ?>
				    <?php if($datagedaan == 'true' ) { echo'<li><a href="#tab8" data-toggle="tab">Gerechtelijke uitspraken</a></li>'; } else { echo''; } ?>
				    <?php if($datagedaan == 'true' ) { echo'<li><a href="#tab9" data-toggle="tab">Kredietscores</a></li>'; } else { echo''; } ?>
				    <?php if($datagedaan == 'true' ) { echo'<li><a href="#tab10" data-toggle="tab">Historische bevragingen</a></li>'; } else { echo''; } ?>
				  </ul>
				  <div class="tab-content">

				    <div class="tab-pane active" id="tab1">
				    		<div class="span4">
				    	<h2>Document status</h2>
				    	<table >  
					        <thead>  
					          <tr>  
					            <th><?php if($id_status == 1 OR  $id_status == 2) { echo'<span class="label label-success" style="font-size:20px; padding:15px;">Goedgekeurd</span>'; } else { echo'<span class="label label-important" style="font-size:20px; padding:15px;">Afgekeurd of gereject</span>'; } ?></th>
					          </tr>  
					        </thead>  
					    </table> 
					    <h2>DataCheck status</h2>
				    	<table >  
					        <thead>  
					          <tr>  
					            <th><?php if($datagedaan == 'true' ) { echo'<span class="label label-success" style="font-size:20px; padding:15px;">Uitgevoerd</span>'; } else { echo'<span class="label label-important" style="font-size:20px; padding:15px;">Niet uitgevoerd</span>'; } ?></th>
					          </tr>  
					        </thead>  
					    </table>
					</div>

						<div class="span5">
							<?php 
							if($datareden == 'Er is geen datacheck aangevraagd') { 
								echo "<h3>Er is geen datacheck aangevraagd voor deze toets</h3>";
							} elseif($datareden <> '') {
								echo '<h3>'.$datareden.'</h3>';
							} else {

								$kleur = 'groen'; //Het is standaard groen
								//Het stoplicht gedeelte
								//Adres
								if($adr_res_desc == 'N99') {
									//Stoplicht is rood
									$kleur = 'rood';
								} 

								if($debt_persoon > 5) {
									//Het stoplicht is rood
									$kleur = 'rood';	
								} elseif ($debt_persoon < 6 ) {
									if($debt_persoon > 0) {
										//Het stoplicht is oranje
										$kleur = 'oranje';	
									}
								}

								if($uispr_array[1]['Code'] == 'FAIL') {
									//Het stoplicht is rood
									$kleur = 'rood';
								}

								if($id_status == 1 OR $id_status == 2) {
									//stoplicht zetten
									echo '<img src="http://www.datachecker.nl/Databeheer/img/stoplichten/stoplicht_'.$kleur.'.png">';
								} else {
									//Geen stoplicht er is geen toets gedaan 

								}
							}
							?>
							</div>
				    </div>
				    <div class="tab-pane" id="tab2">
				    	
				    			<div class="span7">
				    	<h2>Document gegevens</h2>
				    	<table >  
					        <tbody>  
					          <tr>
					          	<td><b>Naam:</b></td>
					          	<td><?php echo $id_voornaam." ".$id_achternaam; ?></td>
					          </tr>
					           <tr>
					          	<td><b>Geboortedatum:</b></td>
					          	<td><?php echo date('d-m-Y', strtotime($id_gebdat)); ?></td>
					          </tr>  
					           <tr>
					          	<td><b>Land:</b></td>
					          	<td><?php echo $id_land; ?></td>
					          </tr> 
					          <tr>
					          	<td><b>Expiratiedatum:</b></td>
					          	<td><?php echo date('d-m-Y', strtotime($id_expdat)); ?></td>
					          </tr> 
					          <tr>
					          	<td><b>Status:</b></td>
					          	<td><?php if($id_status == 1 OR  $id_status == 2) { echo "<span style='color:green'>Goedgekeurd</span>"; } elseif($id_status == 3) { echo "<span style='color:red'>Afgekeurd</span>"; } else { echo "<span style='color:red'>Gereject</span>"; }  ?></td>
					          </tr>
					          <?php 
					          	if($id_reason != '') {

					          		echo '<tr><td></td><td><span style="color:red">'.$id_reason.'</span></td></tr>';

					          	}
					          ?>
					          <tr>
					          	<td width="160px"><b>Vermist of gestolen:</b></td>
					          	<td><?php if($id_vis == 'false') { echo "Document staat niet als vermist of gestolen"; } else { echo "<span style='color:red'>Document staat als vermist of gestolen</span>"; } ?></td>
					          </tr>
					          <tr>
					          	<td><b>Rapportage:</b></td>
					          	<td><?php if($id_rapurl != '') { echo 'Beschikbaar'; } else { echo 'Niet beschikbaar'; } ?></td>
					          </tr>   
					        <tbody>
					    </table><br />
					    <h2>Overige document gegevens</h2>
					    <table > 
					    <tbody>  
					          <tr>
					          	<td width="100px"><b>Pasfoto:</b></td>
					          	<td width="70px"><?php if($id_pasfoto == 'true') { echo "<span style='color:green'>Goed</span>"; } else { echo "<span style='color:red'>Fout</span>"; } ?></td>
					          	<td width="230px"><b>Laminaat cq. fotovervanging:</b></td>
					          	<td><?php if($id_laminaat == 'Check_Ok') { echo "<span style='color:green'>Goed</span>"; } elseif($id_laminaat == 'Check_Error') { echo "<span style='color:red'>Fout</span>"; } else { echo "Niet uitgevoerd"; }  ?></td>
					          </tr>
					           <tr>
					          	<td><b>Lettertype:</b></td>
					          	<td><?php if($id_lettertype == 'Check_Ok') { echo "<span style='color:green'>Goed</span>"; } elseif($id_lettertype == 'Check_Error') { echo "<span style='color:red'>Fout</span>"; } else { echo "Niet uitgevoerd"; }  ?></td>
					          	<td><b>Spelfouten:</b></td>
					          	<td><?php if($id_spelfouten == 'true') { echo "<span style='color:green'>Goed</span>"; } else { echo "<span style='color:red'>Fout</span>"; } ?></td>
					          </tr>
					          <tr>
					          	<td width="175px"><b>Kinegram / Hologram:</b></td>
					          	<td><?php if($id_kineholo == 'Check_Ok') { echo "<span style='color:green'>Goed</span>"; } elseif($id_kineholo == 'Check_Error') { echo "<span style='color:red'>Fout</span>"; } else { echo "Niet uitgevoerd"; }  ?></td>
					          	<td><b>Imageperf:</b></td>
					          	<td><?php if($id_imageperf == 'Check_Ok') { echo "<span style='color:green'>Goed</span>"; } elseif($id_imageperf == 'Check_Error') { echo "<span style='color:red'>Fout</span>"; } else { echo "Niet uitgevoerd"; }  ?></td>
					          </tr>
					          <tr>
					          	<td><b>IDNummer:</b></td>
					          	<td><?php if($id_idnum == 'true') { echo "<span style='color:green'>Goed</span>"; } else { echo "<span style='color:red'>Fout</span>"; } ?></td>
					          	<td><b>Basisbedrukking:</b></td>
					          	<td><?php if($id_basisbedr == 'Check_Ok') { echo "<span style='color:green'>Goed</span>"; } elseif($id_basisbedr == 'Check_Error') { echo "<span style='color:red'>Fout</span>"; } else { echo "Niet uitgevoerd"; } ?></td>
					          </tr>   
					        <tbody>
					       </table> 	
					    	</div>
					    	<div class="span2">
					    		<a href="#myModal" role="button" class="btn btn-primary btn-large" data-toggle="modal"><i class="icon-file-alt wit"></i> Bekijk documenten</a><br /><br />
					    		<?php
					    			if($id_rapurl != '') {
					    				echo '<a href="'.$id_rapurl.'" class="btn btn-primary btn-large" target="_blank"><i class="icon-file-alt wit"></i> Haal rapportage IDchecker</a><br /><br />';
					    			}
					    		?>
					    	</div>
					    
				    </div>
				    <div class="tab-pane" id="tab3">
				    	<div class="span5">
				    	<h2>Persoons gegevens</h2>
				    	<table >  
					        <tbody>  
					          <tr>
					          	<td><b>Resultaat:</b></td>
					          	<td><?php echo $pers_resultaat; ?></td>
					          </tr>
					           <tr>
					          	<td><b>Geslacht:</b></td>
					          	<td><?php if($pers_geslacht == 'F') { echo "Vrouw"; } elseif($pers_geslacht == "M") { echo "Man"; } else { echo "Onbekend"; } ?></td>
					          </tr>  
					           <tr>
					          	<td><b>Naam:</b></td>
					          	<td><?php echo $pers_Naam; ?></td>
					          </tr> 
					          <tr>
					          	<td><b>Voornamen:</b></td>
					          	<td><?php echo $pers_voornamen; ?></td>
					          </tr> 
					          <tr>
					          	<td><b>Geboren:</b></td>
					          	<td><?php if($pers_geboortedat == '1900-01-01T00:00:00') { echo 'Niet beschikbaar';} else { echo date('d-m-Y', strtotime($pers_geboortedat)); } ?></td>
					          </tr>
					          <tr>
					          	<td width="95px"><b>Overleden:</b></td>
					          	<td><?php if($pers_overleden != '') { echo "<span style='color:red'>Ja</span> (".date('d-m-Y', strtotime($pers_overledenDatum)).")"; } else { echo "<span >Nee</span>"; } ?></td>
					          </tr>
					        <tbody>
					    </table>
					</div>
					<div class="span4">
						<h2>Opgeschoonde data</h2>
				    	<table >  
					        <tbody>  
					          <tr>
					          	<td><b>Geslacht:</b></td>
					          	<td><?php if($pers_geslacht == 'F') { echo "V"; } elseif($pers_geslacht == "M") { echo "M"; } else { echo "Onbekend"; } ?></td>
					          </tr>
					           <tr>
					          	<td><b>Initialen:</b></td>
					          	<td><?php echo $pers_initialen; ?></td>
					          </tr>  
					           <tr>
					          	<td><b>Achternaam:</b></td>
					          	<td><?php echo $pers_Naam; ?></td>
					          </tr> 
					          <tr>
					          	<td><b>Huisnummer:</b></td>
					          	<td><?php echo $pers_huisnummer; ?></td>
					          </tr> 
					          <tr>
					          	<td><b>Toevoeging:</b></td>
					          	<td><?php echo $pers_toevoeging; ?></td>
					          </tr>
					          <tr>
					          	<td width="105px"><b>Postcode:</b></td>
					          	<td><?php echo $pers_postcode; ?></td>
					          </tr>
					        <tbody>
					    </table>
					</div>
				    </div>
				    <div class="tab-pane" id="tab4">
				    	<div class="span5">
				    		<h2>Adres</h2>
				    		<table >  
					        <tbody>  
					          <tr>
					          	<td width="115px"><b>Resultaat:</b></td>
					          	<td><?php echo $adr_resultaat; ?></td>
					          </tr>
					           <tr>
					          	<td><b>Adres:</b></td>
					          	<td><?php echo $adr_straat." ".$adr_huisnummer." ".$adr_extentie; ?></td>
					          </tr> 
					          <tr>
					          	<td><b></b></td>
					          	<td><?php echo $adr_postcode." ".$adr_plaats; ?></td>
					          </tr> 
					           <tr>
					          	<td><b>Gemeente:</b></td>
					          	<td><?php echo $adr_plaats; ?></td>
					          </tr> 
					          <tr>
					          	<td><b>Provincie:</b></td>
					          	<td><?php echo $adr_provincie; ?></td>
					          </tr> 
					        <tbody>
					    </table>
					    <?php 
					    	$countarr = count(array_unique($prop_array, SORT_REGULAR)); 
					    	if($countarr > 0) {
						    	for ($i = 0; $i <= $countarr - 1; $i++)
						    	{	echo "<br />";
						    		echo "<table>";
						    		echo "<tbody>";
						    		echo "<tr>";
						    		echo "<td width='115px'><b>Resultaat:</b></td>";
						          	echo "<td>".$prop_array[$i]['move_res']."</td>";
						          	echo "</tr>";
						    		echo "<tr>";
						    		echo "<td><b>Adres:</b></td>";
						          	echo "<td>".$prop_array[$i]['move_adres']." ".$prop_array[$i]['move_nummer']." ".$prop_array[$i]['move_extentie']."</td>";
						         	echo "</tr>"; 
						          	echo "<tr>";
						    		echo "<td><b></b></td>";
						          	echo "<td>".$prop_array[$i]['move_postcode']." ".$prop_array[$i]['move_plaats']."</td>";
						          	echo "</tr>";
						    		echo "<tr>";
						    		echo "<td><b>Mutatiedatum:</b></td>";
						          	echo "<td>".$prop_array[$i]['move_datum']."</td>";
						          	echo "</tr>";
						          	echo "<tbody>";
						    		echo "</table>";
						    		echo "<br />";
						    		}
					    	}
					     ?>
					    
				    		
					    <h2>Overige gegevens</h2>
				    		<table >  
					        <tbody>  
					          <tr>
					          	<td width="210px"><b>Eigendom:</b></td>
					          	<td><?php echo $adr_eigendom; ?></td>
					          </tr>
					           <tr>
					          	<td><b>Perceeltype:</b></td>
					          	<td><?php echo $adr_perceel; ?></td>
					          </tr> 
					          <tr>
					          	<td><b>Aantal bedrijven op adres:</b></td>
					          	<td><?php echo $adr_aantalbedr; ?></td>
					          </tr> 
					           <tr>
					          	<td><b>Oppervlakte in m2:</b></td>
					          	<td><?php echo $prop_array[0]['adr_oppervlakte']; ?></td>
					          </tr> 
					          <tr>
					          	<td><b>Waarde in euro's:</b></td>
					          	<td><?php echo $prop_array[0]['adr_waarde']; ?></td>
					          </tr>
					          <tr>
					          	<td><b>Cultivatie:</b></td>
					          	<td><?php echo $prop_array[0]['adr_cultivatie']; ?></td>
					          </tr> 
					          <tr>
					          	<td><b>Bebouwd:</b></td>
					          	<td><?php echo $prop_array[0]['adr_bebouwd']; ?></td>
					          </tr> 
					        <tbody>
					    </table>
				    	</div>
				    	<div class="span4">
				    		<p><br /><br /><?php if($adr_foto != '') { echo '<img src="data:image/jpg;base64,' .$adr_foto. '" />'; } else { echo 'Geen foto gevonden'; } ?></p>
				    	</div>
				    </div>
				    <div class="tab-pane" id="tab5">
				    	<h2>Telefoon</h2>
				    	
					    	<?php 
					    	

					    	$uniques = count(array_unique($tel_array, SORT_REGULAR)); 
					    	//print_r($tel_array);
					    	
					    	if($uniques > 0) {
						    	for ($i = 0; $i <= $uniques - 1; $i++) 
						    	{	
						    		echo "<table >";
						    		echo "<tbody>";
						    		echo "<tr>";
						    		echo "<td><b>Resultaat:</b></td>";
						    		echo "<td>".$this->mod_scans->getresultdescrip($tel_array[$i]['Result'])."</td>";
						    		echo "</tr>";
						    		echo "<tr>";
						    		echo "<td><b>Naam:</b></td>";
						    		echo "<td>".$tel_array[$i]['Name']."</td>";
						    		echo "</tr>";
						    		echo "<tr>";
						    		echo "<td><b>Adres:</b></td>";
						    		echo "<td>".$tel_array[$i]['Street']." ".$tel_array[$i]['Housenumber']." ".$tel_array[$i]['Extension']."</td>";
						    		echo "</tr>";
						    		echo "<td></td>";
						    		echo "<td>".$tel_array[$i]['Zipcode']." ".$tel_array[$i]['City']."</td>";
						    		echo "</tr>";
						    		echo "<tr>";
						    		echo "<td width='145px;'><b>Telefoonnummer:</b></td>";
						    		echo "<td>".$tel_array[$i]['PhoneNumber']."</td>";
						    		echo "</tr>";
						    		echo "<tbody>";
						    		echo "</table>";
						    		echo "<br /><br />";

						    	}

						    }	

						   
						   


					    	?>
				    	
				    </div>
				    <div class="tab-pane" id="tab6">
				    	<h2>Bedrijfsgegevens</h2>
				    	<?php
				    		//Even testen hoeveel arrys er in de array zitten
					    	$comuni = count(array_unique($comp_array, SORT_REGULAR)); 
					    	if($comuni > 0) {
						    	for ($i = 0; $i <= $comuni - 1; $i++)
						    	{	
						    		echo "<table >";
						    		echo "<tbody>";
						    		echo "<tr>";
						    		echo "<td><b>Bedrijfsnaam:</b></td>";
						    		echo "<td>".$comp_array[$i]['comp_naam']."</td>";
						    		echo "</tr>";
						    		echo "<tr>";
						    		echo "<td><b>Adres:</b></td>";
						    		echo "<td>".$comp_array[$i]['comp_straat']." ".$comp_array[$i]['comp_huisnummer']." ".$comp_array[$i]['comp_extentie']."</td>";
						    		echo "</tr>";
						    		echo "<tr>";
						    		echo "<td></td>";
						    		echo "<td>".$comp_array[$i]['comp_postcode']." ".$comp_array[$i]['comp_plaats']."</td>";
						    		echo "</tr>";
						    		echo "<tr>";
						    		echo "<td><b>Type adres:</b></td>";
						    		echo "<td>".$this->mod_scans->getresultdescrip($comp_array[$i]['comp_type']."CC")."</td>";
						    		echo "</tr>";
						    		echo "<tr>";
						    		echo "<td width='145px;'><b>KVK Nummer:</b></td>";
						    		echo "<td>".$comp_array[$i]['comp_cocnum']."</td>";
						    		echo "</tr>";
						    		echo "<tr>";
						    		echo "<td width='145px;'><b>Status bedrijf:</b></td>";
						    		echo "<td>".$this->mod_scans->getresultdescrip($comp_array[$i]['comp_status']."C")."</td>";
						    		echo "</tr>";
						    		echo "<tr>";
						    		echo "<td width='145px;'><b>Mutatiedatum:</b></td>";
						    		echo "<td>".date('d-m-Y', strtotime($comp_array[$i]['comp_mutatie']))."</td>";
						    		echo "</tr>";
						    		echo "<tbody>";
						    		echo "</table>";
						    		echo "<br /><br />";

						    	}
						    } else {
						    	echo "Geen bedrijfsgegevens gevonden.";
						    }
				    	?>
				    </div>
				    <div class="tab-pane" id="tab11">
				    	<h2>Solventie</h2>
				    	<?php
				    		//Even testen hoeveel arrys er in de array zitten
				    		//print_r($solv_array);

				    		//print_r($solv_array);
				    		//print_r($judge_arr);

				    		$solvuni = count(array_unique($solv_array, SORT_REGULAR));
				    		$solvjudge = count(array_unique($judge_arr, SORT_REGULAR));
					    	
					    	if($solvuni > 0) {

					    	for ($i = 0; $i <= $solvuni - 1; $i++)
					    	{	
					    		if($solv_array[$i]['Number'] != '') {
						    		echo "<table >";
						    		echo "<tbody>";
						    		echo "<tr>";
						    		echo "<td><b>Insolv.nummer:</b></td>";
						    		echo "<td>".$solv_array[$i]['Number']."</td>";
						    		echo "</tr>";
						    		echo "<tr>";
						    		echo "<td><b>Schuldsaneringsnummer(s):</b></td>";
						    		echo "<td>".$solv_array[$i]['Wsnpssknrdebtot']."</td>";
						    		echo "</tr>";
						    		echo "<tr>";
						    		echo "<td><b>Rechtbank:</b></td>";
						    		echo "<td>".$solv_array[$i]['Court']."</td>";
						    		echo "</tr>";
						    		echo "<tr>";
						    		echo "<td><b>Ressort:</b></td>";
						    		echo "<td>".$solv_array[$i]['Jurisdiction']."</td>";
						    		echo "</tr>";
						    		echo "<tr>";
						    		echo "<td width='215px;'><b>Arrondisement:</b></td>";
						    		echo "<td>".$solv_array[$i]['District']."</td>";
						    		echo "</tr>";
						    		echo "<tr>";
						    		echo "<td><b>Rechter-commisaris:</b></td>";
						    		echo "<td>".$judge_arr['Initials']." ".$judge_arr['Prefix']." ".$judge_arr['Lastname']."</td>";
						    		echo "</tr>";
						    		echo "<tbody>";
						    		echo "</table>";
						    		echo "<br /><br />";
						    	}
					    	}
					    } else {

					    	echo "Geen solventie gegevens gevonden.";
					    }
				    	?>
				    </div>
				    <div class="tab-pane" id="tab7">
				    	<h2>Curatele informatie</h2>
				    	<?php 
					    	//print_r($cura_array);
					    	if($cura_array[0]['Initials'] != '') {
					    		
					    		echo "<table >";
					    		echo "<tbody>";
					    		echo "<tr>";
					    		echo "<td><b>Curator</b></td>";
					    		echo "<td>".$cura_array[0]['Initials']." ".$cura_array[0]['Prefix']." ".$cura_array[0]['Lastname']."</td>";
					    		echo "</tr>";
					    		echo "<tr>";
					    		echo "<td><b>Kantoor:</b></td>";
					    		echo "<td>".$cura_array[0]['Building']."</td>";
					    		echo "</tr>";
					    		echo "<tr>";
					    		echo "<td><b>Adres:</b></td>";
					    		echo "<td>".$cura_array[0]['Street']." ".$cura_array[0]['Housenumber']."</td>";
					    		echo "</tr>";
					    		echo "<tr>";
					    		echo "<td><b>Telefoon:</b></td>";
					    		echo "<td>".$cura_array[0]['PhoneNumber']."</td>";
					    		echo "</tr>";
					    		echo "<tr>";
					    		echo "<td><b>Fax:</b></td>";
					    		echo "<td>".$cura_array[0]['FaxNumber']."</td>";
					    		echo "</tr>";
					    		echo "<tr>";
					    		echo "<td width='120px;'><b>Mutatiedatum:</b></td>";
					    		echo "<td>".date('d-m-Y', strtotime($cura_array[0]['Mutationdate']))."</td>";
					    		echo "</tr>";
					    		echo "<tbody>";
					    		echo "</table>";
					    		echo "<br /><br />";	

					    	} else {
					    		echo 'Geen curatele informatie gevonden.';
					    	}
				    	?>
				    	
				    </div>
				    <div class="tab-pane" id="tab8">
				    	<h2>Gerechtelijke uitspraken</h2>
				    	<?php
				    		//Even testen hoeveel arrys er in de array zitten
				    		//print_r($solv_array);

				    		$uisprarr = count(array_unique($uispr_array, SORT_REGULAR)); 
					    	
					    	if($uisprarr > 0) {

					    	for ($i = 0; $i <= $uisprarr - 1; $i++)
					    	{	
					    		echo "<table >";
					    		echo "<tbody>";
					    		echo "<tr>";
					    		echo "<td><b>Code</b></td>";
					    		echo "<td>".$uispr_array[$i]['Code']."</td>";
					    		echo "</tr>";
					    		echo "<tr>";
					    		echo "<td><b>Omschrijving:</b></td>";
					    		echo "<td>".$uispr_array[$i]['Description']."</td>";
					    		echo "</tr>";
					    		echo "<tr>";
					    		echo "<td width='145px;'><b>Uitspraak op:</b></td>";
					    		echo "<td>".date('d-m-Y', strtotime($uispr_array[$i]['Verdictdate']))."</td>";
					    		echo "</tr>";
					    		echo "<tbody>";
					    		echo "</table>";
					    		echo "<br /><br />";

					    	}
					    } else {

					    	echo "Geen gerechtelijke uitspraken gevonden.";
					    }
				    	?>
				    </div>
				    <div class="tab-pane" id="tab9">
				    	<h2>Krediet scores</h2>
				    	<table >  
					        <tbody>  
					          <tr>
					          	<td width="100px"><b>Resultaat:</b></td>
					          	<td><?php echo $debt_resultaat; ?></td>
					          </tr>
					           <tr>
					          	<td><b>Persoon:</b></td>
					          	<td><img src="http://www.datachecker.nl/Databeheer/img/thermometers/th<?php echo $debt_persoon; ?>.png"></td>
					          </tr> 
					          <tr>
					          	<td><b>Adres:</b></td>
					          	<td><img src="http://www.datachecker.nl/Databeheer/img/thermometers/th<?php echo $debt_adres; ?>.png"></td>
					          </tr> 
					           <tr>
					          	<td><b>Postcode:</b></td>
					          	<td><img src="http://www.datachecker.nl/Databeheer/img/thermometers/th<?php echo $debt_postcode; ?>.png"></td>
					          </tr> 
					          
					        <tbody>
					    </table>
				    </div>
				    <div class="tab-pane" id="tab10">
				    	<h2>Historische bevragingen</h2>
				    	<table >  
					        <tbody>  
					          <tr>
					          	<td width="270px"><b>Aantal bevragingen op persoon:</b></td>
					          	<td><?php echo $hb_aantalbevr; ?></td>
					          </tr>
					           <tr>
					          	<td ><b>Aantal bevragingen op adres:</b></td>
					          	<td><?php echo $hb_aantaladres; ?></td>
					          </tr> 
					          
					        <tbody>
					    </table>
				    </div>
				  </div>
        </div><!--/span-->
        <div class="span1">
			
        </div><!--/span-->
      </div><!--/row-->

