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
    $jaar = $this->mod_sql->sql_jaar($kn);
      
     //dag
    $dag = $this->mod_sql->sql_dag($kn);
   
    
    
    //klanten ophalen
    $qryklanten = $this->mod_sql->sql_qryklanten();
 
    // NVM, BWT of PPC
    /**
    $qrynvm = $this->mod_sql->sql_qrynvm($tr, $jr);
    $qrybwt = $this->mod_sql->sql_qrybwt($tr, $jr);
    $qryppc = $this->mod_sql->sql_qryppc($tr, $jr);
    $qrynvb = $this->mod_sql->sql_qrynvb($tr, $jr);
*/

if($br>"") {
    // variabel  incl NVM BWT en PPC
    $varinbp = $this->mod_sql->sql_varinbp($tr, $jr, $kn, $br);
    $vtt=$varinbp[totaal];
    $vtg=$varinbp[goed];
    $vta=$varinbp[fout];
    $vtr=$varinbp[reje];
    $vth=$varinbp[beha];

} else {
    // variabel 
    $vari = $this->mod_sql->sql_vari($tr, $jr, $kn, $br);
    $vtt=$vari[totaal];
    $vtg=$vari[goed];
    $vta=$vari[fout];
    $vtr=$vari[reje];
    $vth=$vari[beha];

    

}    
    
   

    
   
?>
<div class="container">
                <div class="tabbable"> <!-- Only required for left/right tabs -->
                  <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab1" data-toggle="tab"  >Raportage selectie</a></li>
                    <li><a href="#tab2" data-toggle="tab" >Jaar overzicht</a></li>
                 </ul>


                  <div class="tab-content">
                    <div class="tab-pane active" id="tab1"> <!-- TAB 1 -->

                      

                    

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
                 	 
                    <?PHP  print_r($dag[totaal]); ?>
                </td>
            </tr>
            <tr>
                <td>Aantal goedgekeurd:</td>
                <td>
                     
                    <?PHP  print_r($dag[goed]); ?>
                </td>
            </tr>
            <tr>
                <td>Aantal afgekeurd:</td>
                <td>
                     
                    <?PHP  print_r($dag[fout]); ?>
                </td>
            </tr>
            <tr>
                <td>Aantal reject:</td>
                <td>
                     
                    <?PHP  print_r($dag[reje]); ?>
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
                     
                      <?PHP  print_r($jaar[totaal]); ?> 
                           
                     
                </td>
            </tr>
            <tr>
                <td>Aantal goedgekeurd:</td>
                <td>
                     
                    <?PHP  print_r($jaar[goed]); ?> 
                   
                </td>
            </tr>
            <tr>
                <td>Aantal afgekeurd:</td>
                <td>
                     
                     <?PHP  print_r($jaar[fout]); ?> 
                </td>
            </tr>
            <tr>
                <td>Aantal reject:</td>
                <td>
                     
                     <?PHP  print_r($jaar[reje]); ?> 
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
                    <?PHP echo  $vtt;  ?>
                </td>
            </tr>
            <tr>
                <td>Aantal goedgekeurd:</td>
                <td>
                    <?PHP echo  $vtg;  ?>
                </td>
            </tr>
            <tr>
                <td>Aantal afgekeurd:</td>
                <td>
                   <?PHP echo  $vta;  ?>
                </td>
            </tr>
            <tr>
                <td>Aantal reject:</td>
                <td>
                   <?PHP echo  $vtr;  ?>
                </td>
            </tr>
            <tr>
                <td>Aantal in behandeling:</td>
                <td>
                   <?PHP echo  $vth;  ?>
                </td>
            </tr>
      </table>

        </div> <!-- box infoin -->
        


  

        <div id="output" style="max-width: 500px; height: 400px; margin: 0 auto"></div>
      <br/>
     </div><!-- / box berekening -->
   

</div><!-- /TAB! -->

                </div>
            </div>




        <script src="../../js/highcharts.js"></script>
        <script src="../js/highcharts.js"></script>
        <script src="../../js/modules/exporting.js"></script>
        <script src="../js/modules/exporting.js"></script>