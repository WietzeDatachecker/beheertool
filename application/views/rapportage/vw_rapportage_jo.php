<?php


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
   
   

	$vandaag = Date('Y-m-d');
	$morgen = Date('Y-m-d', strtotime("+1 days"));
	$datum = Date('d-m-Y');
 
if (isset($jr)) { if($jr>=1 ) { $jr="$jr";  } else { $jr=date('Y'); } } else { $jr=date('Y'); }

    //klanten ophalen
    $qryklanten = $this->mod_sql->sql_qryklanten();

        
    // jaargrafiek
  
   $jaaroverzicht = $this->mod_sql->sql_jaaroverzicht($jr);
    // laatste komma verwijderen
    $aJRm = substr($jaaroverzicht[aJRm], 0, -1);
    $aJRb = substr($jaaroverzicht[aJRb], 0, -1);
    $aJRp = substr($jaaroverzicht[aJRp], 0, -1);
  
    // jaargrafiek goed fout reject
  
   $jaaroverzicht_gfr = $this->mod_sql->sql_jaaroverzicht_gfr($jr, $kn);
    // laatste komma verwijderen
    $aJRg = substr($jaaroverzicht_gfr[aJRg], 0, -1);
    $aJRf = substr($jaaroverzicht_gfr[aJRf], 0, -1);
    $aJRr = substr($jaaroverzicht_gfr[aJRr], 0, -1);
      
   

 
    
   

    
   
?>
<div class="container">
                <div class="tabbable"> <!-- Only required for left/right tabs -->
                  <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab1" data-toggle="tab"  >Jaar overzicht gebruiker</a></li>
                    
                    
                 </ul>
                

                  <div class="tab-content">
                    <div class="tab-pane active" id="tab1"> <!-- TAB 1 -->

                      

                    

     
  
         
  



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



               
        

        <div class="" style=" padding-top: 30px;" >
        
        
        
         <form class="" id="zoekform" method="post" action="<?php echo base_url();?>index.php/rapportage/getjaar">
        <table>
            
            <tr>
               
                <td>
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
            
                
                <td>
                    <?php
                    $l1=(empty($kn) ? '' : $kn);
                    ?>
                    <select name="klantenbox" >
                      <option value="">- Alles -</option>
                     
                      <?php
                        
                        foreach ($qryklanten->result() as $row)
                            {
                            if ($kn==$row->UID) { $txtbr=', '.$row->Bedrijfsnaam; }
                               echo "<option value='".$row->UID."'  ".($l1 == $row->UID ? ' selected' : '')." >".$row->Bedrijfsnaam." (".$row->UID.")</option>";
                            }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>   
                <td> 
                <button class="btn btn-primary">Go</button>
                </td>
            </tr>
           
            
            
        </table>
        </form>
        </div><!--/ span 2-->

<br>
    <div style="padding-bottom: 30px;">                   
<?PHP

/**
    //controle:
    echo $aJRg.'<br>';  
    echo $aJRf.'<br>';  
    echo $aJRr.'<br>';   
*/
    if (isset($jr)) {$txtjr=$jr;} else { $txtjr=date('Y'); }
?>


<script type="text/javascript">
$(function () {
        $('#container-gfr').highcharts({
            colors: [
   '#DFF0D8', 
   '#DBA3A3', 
   '#F2DEDE', 
   '#80699B', 
   '#3D96AE', 
   '#DB843D', 
   '#92A8CD', 
   '#A47D7C', 
   '#B5CA92'
],
    
            chart: {
                type: 'column'
            },
    
            title: {
                text: 'Overzicht jaar: <?PHP echo $txtjr .''. $txtbr; ?> '
            },
    
            xAxis: {
                categories: ['Jan', 'Feb', 'Maa', 'Apr', 'Mei', 'Jun','Jul','Aug','Sept','Okt','Nov','Dec']
            },
    
            yAxis: {
                allowDecimals: false,
                min: 0,
                title: {
                    text: 'Aantallen'
                }
            },
    
            tooltip: {
                formatter: function() {
                    return '<b>'+ this.x +'</b><br/>'+
                        this.series.name +': '+ this.y +'<br/>'+
                        'Total: '+ this.point.stackTotal;
                }
            },
    
            plotOptions: {
                column: {
                    stacking: 'normal'
                }
            },
    
            series: [{
                name: 'Goed',
                data: [<?PHP echo $aJRg; ?>],
                stack: 'male'
            }, {
                name: 'Afkeur',
                data: [<?PHP echo $aJRf; ?>],
                stack: 'male'
            }, {
                name: 'Reject',
                data: [<?PHP echo $aJRr; ?>],
                stack: 'male'
            }]
        });
    });
    

        </script>
         <div id="container-gfr" style="min-width: 900; max-width: 900px; height: 400px; margin: 0 auto"></div>
        </div>

       

   </div><!-- /TAB! -->



                </div>
            </div>





        <script src="../../js/highcharts.js"></script>
        <script src="../js/highcharts.js"></script>
        <script src="../../js/modules/exporting.js"></script>
        <script src="../js/modules/exporting.js"></script>

      