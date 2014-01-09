
<div class="container">
      <div class="row">
        <div class="span2"></div><!--/span-->
        <div class="span8">

        	<?php 
        		// Hier het formulier opbouwen

        		//echo $mbid;
        	?>

        	<form class="form-horizontal pull-left " id="registerHere" method="post" action="<?php echo base_url();?>index.php/gebruikers/insert_gebruikerwalter">
	  <fieldset>
	    <legend><?php echo $title; ?></legend>
	    <div class="control-group">
	      <label class="control-label" for="input01">Bedrijfsnaam <span style="color:red;">*</span></label>
	      <div class="controls">
	        <input type="text" class="input-xlarge" id="bedrijfsnaam" name="bedrijfsnaam" >
	        
	      </div>
	</div>
	    
	 <div class="control-group">
		<label class="control-label" for="input01">E-mailadres <span style="color:red;">*</span></label>
	      <div class="controls">
	        <input type="text" class="input-xlarge" id="user_email" name="user_email">
	       
	      </div>
	</div>
	
	 <div class="control-group">
		<label class="control-label" for="input01">Gebruikersnaam<span style="color:red;">*</span> </label>
	      <div class="controls">
	        <input type="text" class="input-xlarge" id="gebruikersnaam" name="gebruikersnaam" >
	       
	      </div>
	</div>
	<div class="control-group">
		<label class="control-label" for="input01">Wachtwoord<span style="color:red;">*</span> </label>
	      <div class="controls">
	        <input type="text" class="input-xlarge" id="wachtwoord" name="wachtwoord" >
	       
	      </div>
	</div>
	<div class="control-group">
		<label class="control-label" for="input01">Saldo<span style="color:red;">*</span> </label>
	      <div class="controls">
	        <input type="text" class="input-xlarge" id="aantal_checks" name="aantal_checks" >
	       
	      </div>
	</div>
	<div class="control-group">
		<label class="control-label" for="input01">Type gebruiker <span style="color:red;">*</span> </label>
	      <div class="controls">
	        <select name="gebr_type">
			  <option>- Kies -</option>
			  <option value="BWT">Bewusttoetsen</option>
			 <option value="NVM">NVM Woontoets</option>
			</select>
	      </div>
	</div>
	

	 <legend>Overige gegevens</legend>
	 
	 <div class="control-group">
		<label class="control-label" for="input01">Adres</label>
	      <div class="controls">
	        <input type="text" class="input-xlarge" id="adres" name="adres" >
	       
	      </div>
	</div>
	 <div class="control-group">
		<label class="control-label" for="input01">Postcode</label>
	      <div class="controls">
	        <input type="text" class="input-xlarge" id="postcode" name="postcode" >
	       
	      </div>
	</div>
	 <div class="control-group">
		<label class="control-label" for="input01">Plaats</label>
	      <div class="controls">
	        <input type="text" class="input-xlarge" id="plaats" name="plaats" >
	       
	      </div>
	</div>
	 <div class="control-group">
		<label class="control-label" for="input01">Telefoonnummer</label>
	      <div class="controls">
	        <input type="text" class="input-xlarge" id="telefoon" name="telefoon" >
	       
	      </div>
	</div>
	 <div class="control-group">
		<label class="control-label" for="input01">Mobiel nummer</label>
	      <div class="controls">
	        <input type="text" class="input-xlarge" id="mobiel" name="mobiel" >
	       
	      </div>
	</div>
	 <div class="control-group">
		<label class="control-label" for="input01">E-mailadres</label>
	      <div class="controls">
	        <input type="text" class="input-xlarge" id="email" name="email" >
	       
	      </div>
	</div>
	<div class="control-group">
		<label class="control-label" for="input01">Contact persoon</label>
	      <div class="controls">
	        <input type="text" class="input-xlarge" id="contact_persoon" name="contact_persoon" >
	       
	      </div>
	</div>
	 <div class="control-group">
		<label class="control-label" for="input01">Website</label>
	      <div class="controls">
	        <input type="text" class="input-xlarge" id="website" name="website" >
	       
	      </div>
	</div>
	   
	   <div class="control-group">
		<label class="control-label" for="input01"></label>
	      <div class="controls">
	       <button type="submit" class="btn btn-primary" rel="tooltip" title="first tooltip">Maak gebruiker aan</button>
	       
	      </div>
	
	</div>
	  </fieldset>
	</form>
        </div>
        <div class="span2"></div><!--/span-->
      </div><!--/row-->