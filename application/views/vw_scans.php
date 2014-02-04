<?php
    $query = $this->mod_sql->sql_homeoverzicht();

?>


<h2>Laatste 15 scans</h2>
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