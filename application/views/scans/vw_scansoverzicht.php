<?php

$query = $this->mod_sql->sql_scanoverzicht($go, $zoekw);



		

	?>


<div class="container">
      <div class="row">
        <div class="span8">
			
			<?PHP
			
			

        	if(isset($zoekw)) { echo "<h2>Upload gezocht op: </i>".$zoekw."</i></h2>"; } 
        			   else   { echo "<h2>Laatste 100 scans</h2>";}

			?>

			
			<div class="well">
			          <table class="table">
			              <thead>
			                <tr>
			                  <th></th>
			                  <th>Nr.</th>
			                  <th>Bedrijfsnaam</th>
			                  <th>Naam</th>
			                  <th>Scan datum</th>
			                  <th>Status</th>
			                </tr>
			              </thead>
			              <tbody>
			                <?php
			                $x=0;
			                  foreach ($query as $row)
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
			                      $x++;
			                      
			                      if(isset($zoekw)) {
			                      	 echo "<td><a href='../scanoverzicht/scandetails/".$row->IDCid."'><i class='icon-search'></i></a></td>";
			                      	} else {
			                      	echo "<td><a href='scanoverzicht/scandetails/".$row->IDCid."'><i class='icon-search'></i></a></td>";
			                 		}	
			                      echo "<td>".$x."</td>";
			                      echo "<td class='bl'><a href='../gebruikers/haalgebruikersgegevens/".$row->UID."/false/false/false'>".$row->Bedrijfsnaam."</a></td>";
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
        



        <div class="span4"><!-- span4 -->
           <form class="" name="selectform" method="post" action="<?php echo base_url();?>index.php/scans/scanselect">
            <h2>Selecteer</h2>
            
         <div class="control-group"><!-- control-group -->
                <div class="controls input-group" ><!-- controls -->
                <span class="input-group-addon">
                  <input type="radio" name="go" onclick="document.selectform.submit();" id="checkbox" value="0" <?php if($go==0) { echo 'checked';} ?> ><span class="selectlabel">Alles</span><br>
                </span>
                  <input type="radio" name="go" onclick="document.selectform.submit();" id="checkbox" value="1" <?php if($go==1) { echo 'checked';} ?> ><span class="selectlabel">Goedgekeurd</span><br>
                  <input type="radio" name="go" onclick="document.selectform.submit();" id="checkbox" value="3" <?php if($go==3) { echo 'checked';} ?> ><span class="selectlabel">Afgekeurd</span><br>
                  <input type="radio" name="go" onclick="document.selectform.submit();" id="checkbox" value="999" <?php if($go==999) { echo 'checked';} ?> ><span class="selectlabel">Gereject</span>
                 </span>
                 <input type="hidden" id="achternaam" name="achternaam" value="<? if(isset($zoekw)) {echo $zoekw; } ?>">
                </div><!-- /controls -->
          </div><!--  /control-group -->
          <div class="control-group"><!-- control-group -->
            <label class="control-label" for="input01"></label>
                <div class="controls"><!-- controls -->
                 
                 </form>
                </div><!-- /controls -->
          
          </div><!-- /control-group -->
        </div><!--/span4-->

        <div class="span4"><!-- span4 -->
           <form class="" id="zoekform" method="post" action="<?php echo base_url();?>index.php/scans/scanzoeken">
            <h2>Zoek een upload</h2>
            
         <div class="control-group"><!-- control-group -->
            <label class="control-label" for="input01">Achternaam</label>
                <div class="controls"><!-- controls -->
                  <input type="text" class="input-xlarge" id="achternaam" name="achternaam">
                </div><!-- /controls -->
          </div><!--  /control-group -->
          <div class="control-group"><!-- control-group -->
            <label class="control-label" for="input01"></label>
                <div class="controls"><!-- controls -->
                 <button type="submit" class="btn btn-primary" rel="tooltip" title="first tooltip">Zoek upload</button>
                 </form>
                </div><!-- /controls -->
          
          </div><!-- /control-group -->
        </div><!--/span4-->

      </div><!--/row-->

    