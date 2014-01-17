<div class="container">
      <div class="row">
        <div class="span8">
        	<div class="btn-toolbar">
    <a href="gebruikers/gebruikersaanmaken" class="btn btn-primary" >Maak nieuwe gebruiker aan</a>
</div>
<div class="well">
    <table class="table">
      <thead>
        <tr>
          <th style="width: 36px;"></th>
          <th>#</th>
          <th>Bedrijfsnaam</th>
          <th>Gebruikersnaam</th>
          <th>Saldo</th>
        </tr>
      </thead>
      <tbody>
      	<?php

        if(isset($zoekw)) { 
  			
                 $query = $this->db->query("SELECT * FROM `DataCgebruikers` WHERE Bedrijfsnaam like '%".$zoekw."%'");

                  foreach ($query->result() as $row) {
                     if($row->Saldo <= 5 ) {
                        echo "<tr class='error'>";
                      }
                      else
                      {
                      echo "<tr>";
                      }
                    $type =  $row->Type_check;
                    echo "<td><a href='../gebruikers/haalgebruikersgegevens/".$row->UID."/false/false/false'><i class='icon-pencil'></i></a>";
                    echo "<td>".$row->UID."</td>";
                    echo "<td class='bl'><a href='../gebruikers/haalgebruikersgegevens/".$row->UID."/false/false/false'>".$row->Bedrijfsnaam."</a></td>";
                    echo "<td>".$row->Gebruikersnaam."</td>";
                    echo "<td>".$row->Saldo."</td>";
                     echo "<td>"; 
                     if (isset($type)) { echo '<img src="../img/'.$type.'.png"  class="nvmicon" alt=""/>'; } else {}
                    echo "</td>";
                    echo "</tr>";
                  }    
          } else {
            $query = $this->db->query('SELECT * FROM DataCgebruikers ORDER BY UID DESC');

                  foreach ($query->result() as $row) {
                     if($row->Saldo <= 5 ) {
                        echo "<tr class='error'>";
                      }
                      else
                      {
                      echo "<tr>";
                      }
                    $type =  $row->Type_check;
                    echo "<td><a href='gebruikers/haalgebruikersgegevens/".$row->UID."/false/false/false'><i class='icon-pencil'></i></a>";
                    echo "<td>".$row->UID."</td>";
                    echo "<td class='bl'><a href='gebruikers/haalgebruikersgegevens/".$row->UID."/false/false/false'>".$row->Bedrijfsnaam."</a></td>";
                    echo "<td>".$row->Gebruikersnaam."</td>";
                    echo "<td>".$row->Saldo."</td>";
                    echo "<td>"; 
                     if (isset($type)) { echo '<img src="../img/'.$type.'.png"  class="nvmicon" alt=""/>'; } else {}
                     
                    echo "</td>";
                    echo "</tr>";
                  }
            
           
          }
        ?>
      </tbody>
    </table>
</div>

<div class="modal small hide fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <h3 id="myModalLabel">Verwijder bevestiging</h3>
    </div>
    <div class="modal-body">
        <p class="error-text">Weet je zeker dat je deze gebruiker wilt verwijderen?</p>
    </div>
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">Annuleer</button>
        <button class="btn btn-danger" data-dismiss="modal">Verwijder</button>
    </div>
</div>
        </div><!--/span-->
        <div class="span4">
           <form class="" id="zoekform" method="post" action="<?php echo base_url();?>index.php/gebruikers/gebruikerszoeken">
            <h2>Zoek een gebruiker</h2>
            
         <div class="control-group">
            <label class="control-label" for="input01">Bedrijfsnaam</label>
                <div class="controls">
                  <input type="text" class="input-xlarge" id="bedrijfsnaam" name="bedrijfsnaam">
                </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="input01"></label>
                <div class="controls">
                 <button type="submit" class="btn btn-primary" rel="tooltip" title="first tooltip">Zoek gebruiker</button>
                 </form>
                </div>
          
          </div>
        </div><!--/span-->
      </div><!--/row-->

      