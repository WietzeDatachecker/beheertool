<?php
    $datum = date("j F Y");
    $dagvanweek = date("l");
    $arraydag = array(
        "Zondag",
        "Maandag",
        "Dinsdag",
        "Woensdag",
        "Donderdag",
        "Vrijdag",
        "Zaterdag"
    );
    $dagvanweek = $arraydag[date("w")];
    $arraymaand = array(
        "Januari" =>1,
        "Februari" =>2,
        "Maart" =>3,
        "April" =>4,
        "Mei" =>5,
        "Juni" =>6,
        "Juli" =>7,
        "Augustus" =>8,
        "September" =>9,
        "Oktober" =>10,
        "November" =>11,
        "December" =>12
    );
     $arrayjaar = array(
        "2013",
        "2014",
        "2015",
        "2016",
        "2017",
        "2018",
        "2019",
        "2020"
    );

    

    //$datum = date("j ") . $arraymaand[date("n") - 1] . date(" Y");
   

	$vandaag = Date('Y-m-d');
	$morgen = Date('Y-m-d', strtotime("+1 days"));
	$datum = Date('d-m-Y');
 
    
if (isset($kn)) { if($kn>=1 ) { $sqlkn="AND UserID=$kn";  } else { $sqlkn=""; } } else { $sqlkn=""; }

if (isset($tr)) { if($tr>=1 ) { $sqltr="= $tr";  } else { $sqltr=">= 1"; } } else { $sqltr=">= 1"; }

if (isset($jr)) { if($jr>=1 ) { $sqljr="$jr";  } else { $sqljr="YEAR(NOW())"; } } else { $sqljr="YEAR(NOW())"; }

if (isset($br)) { if($br>"" ) { $sqlbr="AND DataCgebruikers.Type_check='$br'";   } else { $sqlbr=""; } } else { $sqlbr=""; }
    

    //jaar
    $qrytotaaljaar = $this->db->query("SELECT COUNT(UID) as totaal FROM  `DataCUploads`  WHERE YEAR( CAST( Starttijd AS DATE ) ) = YEAR( NOW( ) ) AND Voornaam <>  'yarno pieter' AND Voornaam <> 'yarno' AND Voornaam <> 'Walter David Alexander' $sqlkn ");
    $qryjaargoed   = $this->db->query("SELECT COUNT(UID) as totaal FROM  `DataCUploads`  WHERE YEAR( CAST( Starttijd AS DATE ) ) = YEAR( NOW( ) ) AND Voornaam <>  'yarno pieter' AND Voornaam <> 'yarno' AND Voornaam <> 'Walter David Alexander' AND Status in (1,2) $sqlkn");
    $qryjaarfout   = $this->db->query("SELECT COUNT(UID) as totaal FROM  `DataCUploads`  WHERE YEAR( CAST( Starttijd AS DATE ) ) = YEAR( NOW( ) ) AND Voornaam <>  'yarno pieter' AND Voornaam <> 'yarno' AND Voornaam <> 'Walter David Alexander' AND Status in (3) $sqlkn");
    $qryjaarreje   = $this->db->query("SELECT COUNT(UID) as totaal FROM  `DataCUploads`  WHERE YEAR( CAST( Starttijd AS DATE ) ) = YEAR( NOW( ) ) AND Voornaam <>  'yarno pieter' AND Voornaam <> 'yarno' AND Voornaam <> 'Walter David Alexander' AND Status in (999) $sqlkn");

    //dag
    $qrytotaaldag   = $this->db->query("SELECT COUNT(UID) as totaal FROM `DataCUploads` WHERE Starttijd > '".$vandaag." 00:00:00' AND Starttijd < '".$morgen." 00:00:00' ORDER BY UID ASC");
    $qrydaggoed     = $this->db->query("SELECT COUNT(UID) as totaal FROM `DataCUploads` WHERE Starttijd > '".$vandaag." 00:00:00' AND Starttijd < '".$morgen." 00:00:00' AND Status IN (1,2)  ORDER BY UID ASC");
    $qrydagfout     = $this->db->query("SELECT COUNT(UID) as totaal FROM `DataCUploads` WHERE Starttijd > '".$vandaag." 00:00:00' AND Starttijd < '".$morgen." 00:00:00' AND Status IN (3)  ORDER BY UID ASC");
    $qrydagreje     = $this->db->query("SELECT COUNT(UID) as totaal FROM `DataCUploads` WHERE Starttijd > '".$vandaag." 00:00:00' AND Starttijd < '".$morgen." 00:00:00' AND Status IN (999)  ORDER BY UID ASC");
    

  

    //klanten ophalen
    $qryklanten = $this->db->query("SELECT UID, Bedrijfsnaam FROM  `DataCgebruikers` ORDER BY Bedrijfsnaam ASC ");
    // NVM or BWT

    $qrynvm = $this->db->query("SELECT COUNT(DataCUploads.UID) as totaal , DataCgebruikers.Type_check   FROM DataCUploads JOIN DataCgebruikers ON DataCUploads.UserID = DataCgebruikers.UID WHERE MONTH(CAST(Starttijd as date)) $sqltr AND YEAR(CAST(Starttijd as date)) = $sqljr AND DataCgebruikers.Type_check = 'NVM'  ");
    $qrybwt = $this->db->query("SELECT COUNT(DataCUploads.UID) as totaal , DataCgebruikers.Type_check   FROM DataCUploads JOIN DataCgebruikers ON DataCUploads.UserID = DataCgebruikers.UID WHERE MONTH(CAST(Starttijd as date)) $sqltr AND YEAR(CAST(Starttijd as date)) = $sqljr AND DataCgebruikers.Type_check = 'BWT'  "); 
    $qryppc = $this->db->query("SELECT COUNT(DataCUploads.UID) as totaal , DataCgebruikers.Type_check   FROM DataCUploads JOIN DataCgebruikers ON DataCUploads.UserID = DataCgebruikers.UID WHERE MONTH(CAST(Starttijd as date)) $sqltr AND YEAR(CAST(Starttijd as date)) = $sqljr AND DataCgebruikers.Type_check = 'PPC'  "); 
    $qrynvb = $this->db->query("SELECT COUNT(DataCUploads.UID) as totaal , DataCgebruikers.Type_check   FROM DataCUploads JOIN DataCgebruikers ON DataCUploads.UserID = DataCgebruikers.UID WHERE MONTH(CAST(Starttijd as date)) $sqltr AND YEAR(CAST(Starttijd as date)) = $sqljr AND DataCgebruikers.Type_check = 'NVMB' "); 


if($br>"") {
    // variabel  BRON
    $qrytotaalvariabel=$this->db->query("SELECT COUNT(DataCUploads.UID) as totaal , DataCgebruikers.Type_check   FROM DataCUploads JOIN DataCgebruikers ON DataCUploads.UserID = DataCgebruikers.UID WHERE MONTH(CAST(Starttijd as date)) $sqltr AND YEAR(CAST(Starttijd as date)) = $sqljr $sqlbr ");
    $qryvariabelgoed = $this->db->query("SELECT COUNT(DataCUploads.UID) as totaal , DataCgebruikers.Type_check   FROM DataCUploads JOIN DataCgebruikers ON DataCUploads.UserID = DataCgebruikers.UID WHERE MONTH(CAST(Starttijd as date)) $sqltr AND YEAR(CAST(Starttijd as date)) = $sqljr AND Status IN (1,2) $sqlbr  ");
    $qryvariabelfout = $this->db->query("SELECT COUNT(DataCUploads.UID) as totaal , DataCgebruikers.Type_check   FROM DataCUploads JOIN DataCgebruikers ON DataCUploads.UserID = DataCgebruikers.UID WHERE MONTH(CAST(Starttijd as date)) $sqltr AND YEAR(CAST(Starttijd as date)) = $sqljr AND Status IN (3)  $sqlbr  ");
    $qryvariabelreje = $this->db->query("SELECT COUNT(DataCUploads.UID) as totaal , DataCgebruikers.Type_check   FROM DataCUploads JOIN DataCgebruikers ON DataCUploads.UserID = DataCgebruikers.UID WHERE MONTH(CAST(Starttijd as date)) $sqltr AND YEAR(CAST(Starttijd as date)) = $sqljr AND Status IN (999)  $sqlbr  ");
    $qryvariabelbeha = $this->db->query("SELECT COUNT(DataCUploads.UID) as totaal , DataCgebruikers.Type_check   FROM DataCUploads JOIN DataCgebruikers ON DataCUploads.UserID = DataCgebruikers.UID WHERE MONTH(CAST(Starttijd as date)) $sqltr AND YEAR(CAST(Starttijd as date)) = $sqljr AND Status IN (4000) $sqlbr  ");
} else {
  //variabel
    $qrytotaalvariabel = $this->db->query("SELECT COUNT(UID) as totaal FROM `DataCUploads` WHERE MONTH(CAST(Starttijd as date)) $sqltr AND YEAR(CAST(Starttijd as date)) = $sqljr $sqlkn ");
    $qryvariabelgoed   = $this->db->query("SELECT COUNT(UID) as totaal FROM `DataCUploads` WHERE MONTH(CAST(Starttijd as date)) $sqltr AND YEAR(CAST(Starttijd as date)) = $sqljr AND Status IN (1,2) $sqlkn ORDER BY UID ASC");
    $qryvariabelfout   = $this->db->query("SELECT COUNT(UID) as totaal FROM `DataCUploads` WHERE MONTH(CAST(Starttijd as date)) $sqltr AND YEAR(CAST(Starttijd as date)) = $sqljr AND Status IN (3) $sqlkn ORDER BY UID ASC");
    $qryvariabelreje   = $this->db->query("SELECT COUNT(UID) as totaal FROM `DataCUploads` WHERE MONTH(CAST(Starttijd as date)) $sqltr AND YEAR(CAST(Starttijd as date)) = $sqljr AND Status IN (999) $sqlkn ORDER BY UID ASC");
    $qryvariabelbeha   = $this->db->query("SELECT COUNT(UID) as totaal FROM `DataCUploads` WHERE MONTH(CAST(Starttijd as date)) $sqltr AND YEAR(CAST(Starttijd as date)) = $sqljr AND Status IN (4000) $sqlkn ORDER BY UID ASC");
}    
    
   

    foreach ($qryvariabelgoed->result() as $row) {$vtg=$row->totaal;  }                     
    foreach ($qryvariabelfout->result() as $row) {$vta=$row->totaal;  } 
    foreach ($qryvariabelreje->result() as $row) {$vtr=$row->totaal;  } 
    foreach ($qryvariabelbeha->result() as $row) {$vbh=$row->totaal;  }  

    
    
?>


<div class="container">
      <div class="row">
        <div class="span7">
         
        <div class="infoboxtop"> <!-- infobox -->

         <h3> 
            <?php echo "$dagvanweek $datum";    ?> 
     	 </h3>
         <table>
            <tr>
                <td width="190px"> Totaal aantal checks:</td>
                <td>
                 	 <?php
                 	 	
                        foreach ($qrytotaaldag->result() as $row)
                            {
                                echo $row->totaal;
                            }
            		?>
                </td>
            </tr>
            <tr>
                <td>Aantal goedgekeurd:</td>
                <td>
                     <?php
                        
                        foreach ($qrydaggoed->result() as $row)
                            {
                                echo $row->totaal;
                            }
                    ?>
                </td>
            </tr>
            <tr>
                <td>Aantal afgekeurd:</td>
                <td>
                     <?php
                        
                        foreach ($qrydagfout->result() as $row)
                            {
                                echo $row->totaal;
                            }
                    ?>
                </td>
            </tr>
            <tr>
                <td>Aantal reject:</td>
                <td>
                     <?php
                        
                        foreach ($qrydagreje->result() as $row)
                            {
                                echo $row->totaal;
                            }
                    ?>
                </td>
            </tr>
      </table>
  </div> <!--- /infobox  -->

        <div class="infoboxtop"> <!-- infobox //totalen huidig jaar-->

         <h3> 
            Totalen 
            <?php
                setlocale(LC_TIME, 'NL_nl'); 
                echo strftime('%Y',time()); 
                 

            ?>
         </h3>
         <table>
            <tr>
                <td width="190px"> Totaal aantal checks:</td>
                <td>
                     <?php
                        
                        foreach ($qrytotaaljaar->result() as $row)
                            {
                                echo $row->totaal;
                            }
                      ?>
                </td>
            </tr>
            <tr>
                <td>Aantal goedgekeurd:</td>
                <td>
                     <?php
                        
                        foreach ($qryjaargoed->result() as $row)
                            {
                                echo $row->totaal;
                            }
                    ?>
                </td>
            </tr>
            <tr>
                <td>Aantal afgekeurd:</td>
                <td>
                     <?php
                        
                        foreach ($qryjaarfout->result() as $row)
                            {
                                echo $row->totaal;
                            }
                    ?>
                </td>
            </tr>
            <tr>
                <td>Aantal reject:</td>
                <td>
                     <?php
                        
                        foreach ($qryjaarreje->result() as $row)
                            {
                                echo $row->totaal;
                            }
                    ?>
                </td>
            </tr>
      </table>
  </div> <!--- /infobox -->

      <br/>
      
        </div><!--/span-->
        <div class="span5">
        <h3>Klant rapportage</h3>
        <?php 
        
               // echo "Klant is ".$kn." type rapport is ".$tr." Bron:".$br;
          
        ?>
         <form class="" id="zoekform" method="post" action="<?php echo base_url();?>index.php/rapportage/klantrapportage">
        <table>
            <tr>
                <td width="165px">Selecteer een klant</td>
                <td>
                    <?php
                    $l1=(empty($kn) ? '' : $kn);
                    ?>
                    <select name="klantenbox" >
                      <option value="">- Alles -</option>
                     
                      <?php
                        
                        foreach ($qryklanten->result() as $row)
                            {
                               echo "<option value='".$row->UID."'  ".($l1 == $row->UID ? ' selected' : '')." >".$row->Bedrijfsnaam." (".$row->UID.")</option>";
                            }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td width="165px">Rapportage periode</td>
                <td>
                    <?php $l2=(empty($tr) ? '' : $tr); ?>
                     <select name="typerap" class="maandselect">
                     <option value="0">- Alles -</option> 
                    <?php
                        
                        foreach ($arraymaand as $value => $key) 
                            {
                               echo "<option value='".$key."'  ".($l2 == $key ? ' selected' : '')." >".$value." </option>";
                            }
                    ?>
                    </select>
                     <?php $l4=(empty($jr) ? '' : $jr); ?>
                     <select name="jaarrap" class="jaarselect">
                     <option value="">- Alles -</option>
                    <?php
                        
                        foreach ($arrayjaar as $value) 
                            {
                               echo "<option value='".$value."'  ".($l4 == $value ? ' selected' : '')." >".$value." </option>";
                            }
                    ?>
                    </select>
                </td>
            </tr>
           
            <tr>
                <td width="165px">Bron</td>
                <td>
                    <?php $l3=(empty($br) ? '' : $br); ?>
                    <select name="bronrap">
                      <option value="">- Kies -</option>
                      <option value="NVM" <? echo ($l3 == "NVM" ? ' selected' : '') ?>>NVMwoontoets </option>
                      <option value="BWT" <? echo ($l3 == "BWT" ? ' selected' : '') ?>>Bewusttoetsen </option>
                      <option value="PPC" <? echo ($l3 == "PPC" ? ' selected' : '') ?>>PayperCheck </option>
                      <option value="NVMB" <? echo ($l3 == "NVMBN" ? ' selected' : '') ?>>Businesstoets </option>
                    </select> 
                </td>
            </tr>
            <tr>
                <td></td>
                <td><button class="btn btn-primary">Genereer rapport</button></td>
            </tr>
        </table>
        </form>
        </div><!--/span-->
      </div><!--/row-->


<div class="infoboxmain"> <!-- boxberekening -->
        <?PHP
         setlocale(LC_TIME, 'NL_nl'); 
                $st_date= strftime('%B',time()); 

                foreach ($arraymaand as $value => $key) 
                            {
                               //echo "<option value='".$key."'  ".($l2 == $key ? ' selected' : '')." >".$value." </option>";
                               if (isset($tr)) {if ($tr==$key) { $DV=$value; } }
                            } 
                             if (isset($DV)) { $textrapportage=$DV.' '.$jr ; } else { if(isset($jr)) { $textrapportage=$jr;} } 
        ?>
    <!-- begin java script High charts NVM/bewust/PPC-->

    <script type="text/javascript">
        $(function () {
            $('#output').highcharts({
                chart: {
                    plotBackgroundColor: null,
                    plotBorderWidth: null,
                    plotShadow: false
                },
                title: {
                    text: 'Rapportage van : <?PHP echo $textrapportage; ?> '
                },
                tooltip: {
                    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                },
                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        dataLabels: {
                            enabled: true,
                            color: '#000000',
                            connectorColor: '#000000',
                            format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                        }
                    }
                },
                series: [{
                    type: 'pie',
                    name: '',
                    data: [
                        <?PHP  if($vtg>0) { ?>['Goedgekeurd',   <?PHP echo $vtg; ?>], <?PHP } ?> 
                        <?PHP  if($vta>0) { ?>['Afgekeurd',     <?PHP echo $vta; ?>], <?PHP } ?> 
                        <?PHP  if($vtr>0) { ?>['Reject',        <?PHP echo $vtr; ?>], <?PHP } ?> 
                        <?PHP  if($vbh>0) { ?>['In behandeling',      <?PHP echo $vbh; ?>]  <?PHP } ?> 
                    ]
                }]
            });
        });
            

</script>
<!-- /end highcharts -->

      <div class="infoboxin"> <!-- infoboxin -->
      <h3>Totalen van: 
            <?php
                           
                           echo  $textrapportage;
            ?> 
        </h3>
        <table>
            <tr>
                <td width="190px"> Totaal aantal checks:</td>
                <td>
                     <?php
                        
                        foreach ($qrytotaalvariabel->result() as $row)
                            {
                                echo $row->totaal;
                            }
                    ?>
                </td>
            </tr>
            <tr>
                <td>Aantal goedgekeurd:</td>
                <td>
                     <?php
                        
                        foreach ($qryvariabelgoed->result() as $row)
                            {
                                echo $row->totaal;
                            }
                    ?>
                </td>
            </tr>
            <tr>
                <td>Aantal afgekeurd:</td>
                <td>
                     <?php
                        
                        foreach ($qryvariabelfout->result() as $row)
                            {
                                echo $row->totaal;
                            }
                    ?>
                </td>
            </tr>
            <tr>
                <td>Aantal reject:</td>
                <td>
                     <?php
                        
                        foreach ($qryvariabelreje->result() as $row)
                            {
                                echo $row->totaal;
                            }
                    ?>


                </td>
            </tr>
            <tr>
                <td>Aantal in behandeling:</td>
                <td>
                     <?php
                        
                        foreach ($qryvariabelbeha->result() as $row)
                            {
                                echo $row->totaal;
                            }
                    ?>


                </td>
            </tr>
      </table>

        </div> <!-- box infoin -->
        


  
        <script src="../../js/highcharts.js"></script>
        <script src="../js/highcharts.js"></script>
        <script src="../../js/modules/exporting.js"></script>
        <script src="../js/modules/exporting.js"></script>

        <div id="output" style="max-width: 500px; height: 400px; margin: 0 auto"></div>
      <br/>
     </div><!-- / box berekening -->
     <?PHP
         //$qrynaam   = $this->db->query("SELECT * FROM  `DataCUploads`  WHERE UID>1 AND Voornaam>'' GROUP BY Achternaam  ORDER BY UID ASC " );
         $qrytnaa   = $this->db->query("SELECT *, COUNT(UID) as totaal FROM  `DataCUploads`  WHERE UID>1 AND Voornaam <>  'yarno pieter' AND Voornaam <> 'yarno' AND Voornaam <> 'Walter David Alexander' AND Voornaam>''  GROUP BY  Voornaam  ORDER BY UID ASC " );
        
                        
                         foreach ($qrytnaa->result() as $row)
                            {
                                $nr=$row->totaal;
                                if ($nr>=2 ) { 

                                echo $row->totaal.' == <br>';
                                $aa=$row->Voornaam; 
                               
                                //echo $row->Achternaam.' '.$row->Voornaam'<br>';

                                
                                $qrynaam   = $this->db->query("SELECT * FROM  DataCUploads  WHERE Voornaam='$aa'  AND Voornaam <>  'yarno pieter' AND Voornaam <> 'yarno' AND Voornaam <> 'Walter David Alexander' GROUP BY Achternaam ORDER BY Voornaam ASC " );
                                             foreach ($qrynaam->result() as $row)
                                        {
                                        
                                            echo $row->Geboortedatum.' | '.$row->Voornaam.' |  '.$row->Achternaam . ' || '.$row->UID . ' || '.$row->Status.'<br>' ;
                                        }

                                 }
                 
                            }
                        
                    
    ?> 