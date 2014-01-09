<?php
			  
		if($zoekw == '') { 
			  $query = $this->db->query('SELECT *, DataCgebruikers.Bedrijfsnaam FROM DataCUploads INNER JOIN DataCgebruikers ON DataCUploads.UserID=DataCgebruikers.UID ORDER BY DataCUploads.UID DESC LIMIT 100');
							} else {
									echo 'gezocht: '.$zoekw;
			  $query = $this->db->query("SELECT *, DataCgebruikers.Bedrijfsnaam FROM DataCUploads INNER JOIN DataCgebruikers ON DataCUploads.UserID=DataCgebruikers.UID WHERE DataCUploads.Achternaam='%$zoekw%'  ORDER BY DataCUploads.UID DESC ");				
							}


	?>


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
           <form class="" id="zoekform" method="post" action="<?php echo base_url();?>index.php/scans/scanzoeken">
            <h2>Zoek een upload</h2>
            
         <div class="control-group">
            <label class="control-label" for="input01">Achternaam</label>
                <div class="controls">
                  <input type="text" class="input-xlarge" id="achternaam" name="achternaam">
                </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="input01"></label>
                <div class="controls">
                 <button type="submit" class="btn btn-primary" rel="tooltip" title="first tooltip">Zoek upload</button>
                 </form>
                </div>
          
          </div>
        </div><!--/span-->



      </div><!--/row-->

    