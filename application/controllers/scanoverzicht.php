<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start(); //we need to call PHP's session object to access it through CI
class scanoverzicht extends CI_Controller {

  function __construct()
  {
    parent::__construct();
    $this->load->model('mod_scans','',TRUE);
  }

  function index()
  {
    if($this->session->userdata('logged_in'))
    {
      $session_data = $this->session->userdata('logged_in');
      $data['username'] = $session_data['username'];
      $data['id'] = $session_data['id'];
      $data['naam'] = $session_data['naam'];
      $this->load->view('vw_header', $data);
      $this->load->view('scans/vw_scansoverzicht', $data);
      $this->load->view('vw_footervervolg', '');
    }
   
 }

 public function haalresultbeschrijving($resultid) {
   if($this->session->userdata('logged_in'))
    {
      $res = $resultid;
      $descrip = $this->mod_scans->getresultdescrip($res);

      if($descrip) {

        return $descrip;
      }

    }

 }

 function uploadszoeken(){
   if($this->session->userdata('logged_in'))
    {
      $session_data = $this->session->userdata('logged_in');
      $data['username'] = $session_data['username'];
      $data['id'] = $session_data['id'];
      $data['naam'] = $session_data['naam'];
      $data['zoekw'] = $this->input->post('txtachternaam');
      $this->load->view('vw_headervervolg', $data);
      $this->load->view('gebruikers/vw_gebruikers', $data);
      $this->load->view('vw_footervervolg', '');
    }

}

 function scandetails($scanid){
   if($this->session->userdata('logged_in'))
    {
      $session_data = $this->session->userdata('logged_in');
      $data['username'] = $session_data['username'];
      $data['id'] = $session_data['id'];
      $data['naam'] = $session_data['naam'];

      $data['id'] = $scanid;

      $result_id = $this->mod_scans->get_scandetails($scanid);
      $result_data = $this->mod_scans->get_datacheckdata($scanid);
      //print_r($result_data);
       if($result_id )
        {
          if($result_data) 
            { 
              $datacheckuitgevoerd = 'true' ;
            } else {  
              $datacheckuitgevoerd = 'false' ;
            }

            if($result_data['GetDataCheckDataNewBETAResult']['ErrorMessage'] == '') {
              echo "Geen error";
              //print_r($result_id);
              //print_r($result_data);

              //Een apparte array maken met alles wat voor comp is.
              $comparr = array();
              $bedrnaamarr = array();

              //We willen alle gegevens per ID ophalen

              $masterarr = $result_data['GetDataCheckDataNewBETAResult']['Comp_Master']['Expl_Comp_Master'];
              $arrAdr = $result_data['GetDataCheckDataNewBETAResult']['Comp_Addresses']['Expl_Comp_Addresses'];
              $naamarr = $result_data['GetDataCheckDataNewBETAResult']['Comp_Tradenames']['Expl_Comp_Tradenames'];
              $bnamearr = $result_data['GetDataCheckDataNewBETAResult']['Comp_Businessnames']['Expl_Comp_Businessnames'];
              print_r($masterarr);
              $aantalmaster = count(array_unique($masterarr, SORT_REGULAR));
              $aantalNaam = count(array_unique($naamarr, SORT_REGULAR));
              $comoutarr = array();

              //print_r($bedrnaamarr);
              $y = 1 -1;
              $ind = 0;

              print_r($masterarr);
 if($aantalmaster > 0) {
              while($y <= $aantalmaster) 
                { 
                  if($y <= $aantalmaster ) {
                    echo $aantalmaster;

                    if($masterid = $result_data['GetDataCheckDataNewBETAResult']['Comp_Master']['Expl_Comp_Master'][$y]['UID_COMP'])
                    {
                      if( $ind < 3)
                      {
                        if($ind < 1)
                        {
                          /*
                        if($result_data['GetDataCheckDataNewBETAResult']['Comp_Tradenames']['Expl_Comp_Tradenames'][$y]['UID_Comp'] == $masterid )
                        {
                          if($result_data['GetDataCheckDataNewBETAResult']['Comp_Tradenames']['Expl_Comp_Tradenames'][$y]['UID_Comp'] == $result_data['GetDataCheckDataNewBETAResult']['Comp_Businessnames']['Expl_Comp_Businessnames'][$y]['UID_Comp'])
                            {
                              $beduid = $result_data['GetDataCheckDataNewBETAResult']['Comp_Tradenames']['Expl_Comp_Tradenames'][$y]['UID_Comp'];
                              $bedrnaam = $result_data['GetDataCheckDataNewBETAResult']['Comp_Tradenames']['Expl_Comp_Tradenames'][$y]['Item'];
                              $bdr2uid = $result_data['GetDataCheckDataNewBETAResult']['Comp_Businessnames']['Expl_Comp_Businessnames'][$y]['UID_Comp'];
                              $bdr2 = $result_data['GetDataCheckDataNewBETAResult']['Comp_Businessnames']['Expl_Comp_Businessnames'][$y]['Item'];
                              $comoutarr['comp_type'] =  $result_data['GetDataCheckDataNewBETAResult']['Comp_Addresses']['Expl_Comp_Addresses'][$y]['Type'];
                              $comoutarr['comp_Building'] = $result_data['GetDataCheckDataNewBETAResult']['Comp_Addresses']['Expl_Comp_Addresses'][$y]['Building']; 
                              $comoutarr['comp_straat'] = $result_data['GetDataCheckDataNewBETAResult']['Comp_Addresses']['Expl_Comp_Addresses'][$y]['Street'];
                              $comoutarr['comp_huisnummer'] = $result_data['GetDataCheckDataNewBETAResult']['Comp_Addresses']['Expl_Comp_Addresses'][$y]['Housenumber']; 
                              $comoutarr['comp_extentie'] = $result_data['GetDataCheckDataNewBETAResult']['Comp_Addresses']['Expl_Comp_Addresses'][$y]['Extension'];
                              $comoutarr['comp_postcode'] = $result_data['GetDataCheckDataNewBETAResult']['Comp_Addresses']['Expl_Comp_Addresses'][$y]['Zipcode'];
                              $comoutarr['comp_plaats'] = $result_data['GetDataCheckDataNewBETAResult']['Comp_Addresses']['Expl_Comp_Addresses'][$y]['City']; 
                              $comoutarr['comp_mutatie'] = $result_data['GetDataCheckDataNewBETAResult']['Comp_Addresses']['Expl_Comp_Addresses'][$y]['Mutationdata'];
                              $comoutarr['comp_cocnum'] = $result_data['GetDataCheckDataNewBETAResult']['Comp_Company']['Expl_Comp_Company'][$y]['Cocnumber']; 
                              $comoutarr['comp_cocsubnumber'] = $result_data['GetDataCheckDataNewBETAResult']['Comp_Company']['Expl_Comp_Company'][$y]['Cocsubnumber'];
                              $comoutarr['comp_status'] = $result_data['GetDataCheckDataNewBETAResult']['Comp_Company']['Expl_Comp_Company'][$y]['Status']; 
                              $comoutarr['comp_joctitle'] = $result_data['GetDataCheckDataNewBETAResult']['Comp_Company']['Expl_Comp_Company'][$y]['Jobtitle']; 
                              $comoutarr['comp_mutatiedat'] = $result_data['GetDataCheckDataNewBETAResult']['Comp_Company']['Expl_Comp_Company'][$y]['Mutationdate'];

                              //echo "<br />Bedrijfsnaam is ".$bedrnaam."(".$beduid.") en is ".$bdr2."(".$bdr2uid.")<br />";
                              $comoutarr['comp_naam'] = $bedrnaam.", ".$bdr2;
                              $comoutarr['comp_type'] =  $result_data['GetDataCheckDataNewBETAResult']['Comp_Addresses']['Expl_Comp_Addresses'][$y]['Type'];
                              $comoutarr['comp_Building'] = $result_data['GetDataCheckDataNewBETAResult']['Comp_Addresses']['Expl_Comp_Addresses'][$y]['Building']; 
                              $comoutarr['comp_straat'] = $result_data['GetDataCheckDataNewBETAResult']['Comp_Addresses']['Expl_Comp_Addresses'][$y]['Street'];
                              $comoutarr['comp_huisnummer'] = $result_data['GetDataCheckDataNewBETAResult']['Comp_Addresses']['Expl_Comp_Addresses'][$y]['Housenumber']; 
                              $comoutarr['comp_extentie'] = $result_data['GetDataCheckDataNewBETAResult']['Comp_Addresses']['Expl_Comp_Addresses'][$y]['Extension'];
                              $comoutarr['comp_postcode'] = $result_data['GetDataCheckDataNewBETAResult']['Comp_Addresses']['Expl_Comp_Addresses'][$y]['Zipcode'];
                              $comoutarr['comp_plaats'] = $result_data['GetDataCheckDataNewBETAResult']['Comp_Addresses']['Expl_Comp_Addresses'][$y]['City']; 
                              $comoutarr['comp_mutatie'] = $result_data['GetDataCheckDataNewBETAResult']['Comp_Addresses']['Expl_Comp_Addresses'][$y]['Mutationdata'];
                              $comoutarr['comp_cocnum'] = $result_data['GetDataCheckDataNewBETAResult']['Comp_Company']['Expl_Comp_Company'][$y]['Cocnumber']; 
                              $comoutarr['comp_cocsubnumber'] = $result_data['GetDataCheckDataNewBETAResult']['Comp_Company']['Expl_Comp_Company'][$y]['Cocsubnumber'];
                              $comoutarr['comp_status'] = $result_data['GetDataCheckDataNewBETAResult']['Comp_Company']['Expl_Comp_Company'][$y]['Status']; 
                              $comoutarr['comp_joctitle'] = $result_data['GetDataCheckDataNewBETAResult']['Comp_Company']['Expl_Comp_Company'][$y]['Jobtitle']; 
                              $comoutarr['comp_mutatiedat'] = $result_data['GetDataCheckDataNewBETAResult']['Comp_Company']['Expl_Comp_Company'][$y]['Mutationdate'];

                              $ind = 3;
                             // echo $y."<br />";
                            } else {
                              
                              $bedr2id = $result_data['GetDataCheckDataNewBETAResult']['Comp_Tradenames']['Expl_Comp_Tradenames'][$y]['UID_Comp'];
                              $bedr2naam = $result_data['GetDataCheckDataNewBETAResult']['Comp_Tradenames']['Expl_Comp_Tradenames'][$y]['Item'];
                              //echo "<br />Bedrijfsnaam is ".$bedr2naam."(".$bedr2id.")";

                              $comoutarr['comp_naam'] = $bedr2naam;
                              $comoutarr['comp_type'] =  $result_data['GetDataCheckDataNewBETAResult']['Comp_Addresses']['Expl_Comp_Addresses'][$y]['Type'];
                              $comoutarr['comp_Building'] = $result_data['GetDataCheckDataNewBETAResult']['Comp_Addresses']['Expl_Comp_Addresses'][$y]['Building']; 
                              $comoutarr['comp_straat'] = $result_data['GetDataCheckDataNewBETAResult']['Comp_Addresses']['Expl_Comp_Addresses'][$y]['Street'];
                              $comoutarr['comp_huisnummer'] = $result_data['GetDataCheckDataNewBETAResult']['Comp_Addresses']['Expl_Comp_Addresses'][$y]['Housenumber']; 
                              $comoutarr['comp_extentie'] = $result_data['GetDataCheckDataNewBETAResult']['Comp_Addresses']['Expl_Comp_Addresses'][$y]['Extension'];
                              $comoutarr['comp_postcode'] = $result_data['GetDataCheckDataNewBETAResult']['Comp_Addresses']['Expl_Comp_Addresses'][$y]['Zipcode'];
                              $comoutarr['comp_plaats'] = $result_data['GetDataCheckDataNewBETAResult']['Comp_Addresses']['Expl_Comp_Addresses'][$y]['City']; 
                              $comoutarr['comp_mutatie'] = $result_data['GetDataCheckDataNewBETAResult']['Comp_Addresses']['Expl_Comp_Addresses'][$y]['Mutationdata'];
                              $comoutarr['comp_cocnum'] = $result_data['GetDataCheckDataNewBETAResult']['Comp_Company']['Expl_Comp_Company'][$y]['Cocnumber']; 
                              $comoutarr['comp_cocsubnumber'] = $result_data['GetDataCheckDataNewBETAResult']['Comp_Company']['Expl_Comp_Company'][$y]['Cocsubnumber'];
                              $comoutarr['comp_status'] = $result_data['GetDataCheckDataNewBETAResult']['Comp_Company']['Expl_Comp_Company'][$y]['Status']; 
                              $comoutarr['comp_joctitle'] = $result_data['GetDataCheckDataNewBETAResult']['Comp_Company']['Expl_Comp_Company'][$y]['Jobtitle']; 
                              $comoutarr['comp_mutatiedat'] = $result_data['GetDataCheckDataNewBETAResult']['Comp_Company']['Expl_Comp_Company'][$y]['Mutationdate'];
                              $ind = 3;
                              //echo $y."<br />";
                            };
                           
                          
                        }; */
                      } else {

                        if($result_data['GetDataCheckDataNewBETAResult']['Comp_Tradenames']['Expl_Comp_Tradenames'][$ind]['UID_Comp'] == $result_data['GetDataCheckDataNewBETAResult']['Comp_Businessnames']['Expl_Comp_Businessnames'][$ind]['UID_Comp'])
                            {
                              $beduid4 = $result_data['GetDataCheckDataNewBETAResult']['Comp_Tradenames']['Expl_Comp_Tradenames'][$ind]['UID_Comp'];
                              $bedrnaam4 = $result_data['GetDataCheckDataNewBETAResult']['Comp_Tradenames']['Expl_Comp_Tradenames'][$ind]['Item'];
                              $bdr5uid = $result_data['GetDataCheckDataNewBETAResult']['Comp_Businessnames']['Expl_Comp_Businessnames'][$ind]['UID_Comp'];
                              $bdr5 = $result_data['GetDataCheckDataNewBETAResult']['Comp_Businessnames']['Expl_Comp_Businessnames'][$ind]['Item'];
                              $comoutarr['comp_type'] =  $result_data['GetDataCheckDataNewBETAResult']['Comp_Addresses']['Expl_Comp_Addresses'][$y]['Type'];
                              $comoutarr['comp_Building'] = $result_data['GetDataCheckDataNewBETAResult']['Comp_Addresses']['Expl_Comp_Addresses'][$y]['Building']; 
                              $comoutarr['comp_straat'] = $result_data['GetDataCheckDataNewBETAResult']['Comp_Addresses']['Expl_Comp_Addresses'][$y]['Street'];
                              $comoutarr['comp_huisnummer'] = $result_data['GetDataCheckDataNewBETAResult']['Comp_Addresses']['Expl_Comp_Addresses'][$y]['Housenumber']; 
                              $comoutarr['comp_extentie'] = $result_data['GetDataCheckDataNewBETAResult']['Comp_Addresses']['Expl_Comp_Addresses'][$y]['Extension'];
                              $comoutarr['comp_postcode'] = $result_data['GetDataCheckDataNewBETAResult']['Comp_Addresses']['Expl_Comp_Addresses'][$y]['Zipcode'];
                              $comoutarr['comp_plaats'] = $result_data['GetDataCheckDataNewBETAResult']['Comp_Addresses']['Expl_Comp_Addresses'][$y]['City']; 
                              $comoutarr['comp_mutatie'] = $result_data['GetDataCheckDataNewBETAResult']['Comp_Addresses']['Expl_Comp_Addresses'][$y]['Mutationdata'];
                              $comoutarr['comp_cocnum'] = $result_data['GetDataCheckDataNewBETAResult']['Comp_Company']['Expl_Comp_Company'][$y]['Cocnumber']; 
                              $comoutarr['comp_cocsubnumber'] = $result_data['GetDataCheckDataNewBETAResult']['Comp_Company']['Expl_Comp_Company'][$y]['Cocsubnumber'];
                              $comoutarr['comp_status'] = $result_data['GetDataCheckDataNewBETAResult']['Comp_Company']['Expl_Comp_Company'][$y]['Status']; 
                              $comoutarr['comp_joctitle'] = $result_data['GetDataCheckDataNewBETAResult']['Comp_Company']['Expl_Comp_Company'][$y]['Jobtitle']; 
                              $comoutarr['comp_mutatiedat'] = $result_data['GetDataCheckDataNewBETAResult']['Comp_Company']['Expl_Comp_Company'][$y]['Mutationdate'];

                              //echo "<br />Bedrijfsnaam is ".$bedrnaam4."(".$beduid4.") en is ".$bdr5."(".$bdr5uid.")<br />";
                              $comoutarr['comp_naam'] = $bedrnaam4.", ".$bdr5;
                              $comoutarr['comp_type'] =  $result_data['GetDataCheckDataNewBETAResult']['Comp_Addresses']['Expl_Comp_Addresses'][$y]['Type'];
                              $comoutarr['comp_Building'] = $result_data['GetDataCheckDataNewBETAResult']['Comp_Addresses']['Expl_Comp_Addresses'][$y]['Building']; 
                              $comoutarr['comp_straat'] = $result_data['GetDataCheckDataNewBETAResult']['Comp_Addresses']['Expl_Comp_Addresses'][$y]['Street'];
                              $comoutarr['comp_huisnummer'] = $result_data['GetDataCheckDataNewBETAResult']['Comp_Addresses']['Expl_Comp_Addresses'][$y]['Housenumber']; 
                              $comoutarr['comp_extentie'] = $result_data['GetDataCheckDataNewBETAResult']['Comp_Addresses']['Expl_Comp_Addresses'][$y]['Extension'];
                              $comoutarr['comp_postcode'] = $result_data['GetDataCheckDataNewBETAResult']['Comp_Addresses']['Expl_Comp_Addresses'][$y]['Zipcode'];
                              $comoutarr['comp_plaats'] = $result_data['GetDataCheckDataNewBETAResult']['Comp_Addresses']['Expl_Comp_Addresses'][$y]['City']; 
                              $comoutarr['comp_mutatie'] = $result_data['GetDataCheckDataNewBETAResult']['Comp_Addresses']['Expl_Comp_Addresses'][$y]['Mutationdata'];
                              $comoutarr['comp_cocnum'] = $result_data['GetDataCheckDataNewBETAResult']['Comp_Company']['Expl_Comp_Company'][$y]['Cocnumber']; 
                              $comoutarr['comp_cocsubnumber'] = $result_data['GetDataCheckDataNewBETAResult']['Comp_Company']['Expl_Comp_Company'][$y]['Cocsubnumber'];
                              $comoutarr['comp_status'] = $result_data['GetDataCheckDataNewBETAResult']['Comp_Company']['Expl_Comp_Company'][$y]['Status']; 
                              $comoutarr['comp_joctitle'] = $result_data['GetDataCheckDataNewBETAResult']['Comp_Company']['Expl_Comp_Company'][$y]['Jobtitle']; 
                              $comoutarr['comp_mutatiedat'] = $result_data['GetDataCheckDataNewBETAResult']['Comp_Company']['Expl_Comp_Company'][$y]['Mutationdate'];

                              $ind = 3;
                             // echo $y."<br />";
                            } else {
                              
                              $bedr6id = $result_data['GetDataCheckDataNewBETAResult']['Comp_Tradenames']['Expl_Comp_Tradenames'][$ind]['UID_Comp'];
                              $bedr6naam = $result_data['GetDataCheckDataNewBETAResult']['Comp_Tradenames']['Expl_Comp_Tradenames'][$ind]['Item'];
                              //echo "<br />Bedrijfsnaam is ".$bedr6naam."(".$bedr6id.")";

                              $comoutarr['comp_naam'] = $bedr6naam;
                              $comoutarr['comp_type'] =  $result_data['GetDataCheckDataNewBETAResult']['Comp_Addresses']['Expl_Comp_Addresses'][$y]['Type'];
                              $comoutarr['comp_Building'] = $result_data['GetDataCheckDataNewBETAResult']['Comp_Addresses']['Expl_Comp_Addresses'][$y]['Building']; 
                              $comoutarr['comp_straat'] = $result_data['GetDataCheckDataNewBETAResult']['Comp_Addresses']['Expl_Comp_Addresses'][$y]['Street'];
                              $comoutarr['comp_huisnummer'] = $result_data['GetDataCheckDataNewBETAResult']['Comp_Addresses']['Expl_Comp_Addresses'][$y]['Housenumber']; 
                              $comoutarr['comp_extentie'] = $result_data['GetDataCheckDataNewBETAResult']['Comp_Addresses']['Expl_Comp_Addresses'][$y]['Extension'];
                              $comoutarr['comp_postcode'] = $result_data['GetDataCheckDataNewBETAResult']['Comp_Addresses']['Expl_Comp_Addresses'][$y]['Zipcode'];
                              $comoutarr['comp_plaats'] = $result_data['GetDataCheckDataNewBETAResult']['Comp_Addresses']['Expl_Comp_Addresses'][$y]['City']; 
                              $comoutarr['comp_mutatie'] = $result_data['GetDataCheckDataNewBETAResult']['Comp_Addresses']['Expl_Comp_Addresses'][$y]['Mutationdata'];
                              $comoutarr['comp_cocnum'] = $result_data['GetDataCheckDataNewBETAResult']['Comp_Company']['Expl_Comp_Company'][$y]['Cocnumber']; 
                              $comoutarr['comp_cocsubnumber'] = $result_data['GetDataCheckDataNewBETAResult']['Comp_Company']['Expl_Comp_Company'][$y]['Cocsubnumber'];
                              $comoutarr['comp_status'] = $result_data['GetDataCheckDataNewBETAResult']['Comp_Company']['Expl_Comp_Company'][$y]['Status']; 
                              $comoutarr['comp_joctitle'] = $result_data['GetDataCheckDataNewBETAResult']['Comp_Company']['Expl_Comp_Company'][$y]['Jobtitle']; 
                              $comoutarr['comp_mutatiedat'] = $result_data['GetDataCheckDataNewBETAResult']['Comp_Company']['Expl_Comp_Company'][$y]['Mutationdate'];
                              $ind = 3;
                              //echo $y."<br />";
                            };

                      }
                      }
                      else {

                            $id3 = $result_data['GetDataCheckDataNewBETAResult']['Comp_Businessnames']['Expl_Comp_Businessnames'][$y]['UID_Comp'];
                            $naam3 = $result_data['GetDataCheckDataNewBETAResult']['Comp_Businessnames']['Expl_Comp_Businessnames'][$y]['Item'];
                           // echo "<br />Bedrijfsnaam is ".$naam3."(".$id3.")";
                            //echo $y."<br />";
                            $comoutarr['comp_naam'] = $naam3;
                            $comoutarr['comp_type'] =  $result_data['GetDataCheckDataNewBETAResult']['Comp_Addresses']['Expl_Comp_Addresses'][$y]['Type'];
                              $comoutarr['comp_Building'] = $result_data['GetDataCheckDataNewBETAResult']['Comp_Addresses']['Expl_Comp_Addresses'][$y]['Building']; 
                              $comoutarr['comp_straat'] = $result_data['GetDataCheckDataNewBETAResult']['Comp_Addresses']['Expl_Comp_Addresses'][$y]['Street'];
                              $comoutarr['comp_huisnummer'] = $result_data['GetDataCheckDataNewBETAResult']['Comp_Addresses']['Expl_Comp_Addresses'][$y]['Housenumber']; 
                              $comoutarr['comp_extentie'] = $result_data['GetDataCheckDataNewBETAResult']['Comp_Addresses']['Expl_Comp_Addresses'][$y]['Extension'];
                              $comoutarr['comp_postcode'] = $result_data['GetDataCheckDataNewBETAResult']['Comp_Addresses']['Expl_Comp_Addresses'][$y]['Zipcode'];
                              $comoutarr['comp_plaats'] = $result_data['GetDataCheckDataNewBETAResult']['Comp_Addresses']['Expl_Comp_Addresses'][$y]['City']; 
                              $comoutarr['comp_mutatie'] = $result_data['GetDataCheckDataNewBETAResult']['Comp_Addresses']['Expl_Comp_Addresses'][$y]['Mutationdata'];
                              $comoutarr['comp_cocnum'] = $result_data['GetDataCheckDataNewBETAResult']['Comp_Company']['Expl_Comp_Company'][$y]['Cocnumber']; 
                              $comoutarr['comp_cocsubnumber'] = $result_data['GetDataCheckDataNewBETAResult']['Comp_Company']['Expl_Comp_Company'][$y]['Cocsubnumber'];
                              $comoutarr['comp_status'] = $result_data['GetDataCheckDataNewBETAResult']['Comp_Company']['Expl_Comp_Company'][$y]['Status']; 
                              $comoutarr['comp_joctitle'] = $result_data['GetDataCheckDataNewBETAResult']['Comp_Company']['Expl_Comp_Company'][$y]['Jobtitle']; 
                              $comoutarr['comp_mutatiedat'] = $result_data['GetDataCheckDataNewBETAResult']['Comp_Company']['Expl_Comp_Company'][$y]['Mutationdate'];
                            $ind = 1;

                        };

                    };
                      array_push($comparr, $comoutarr);
                      $y++;
                       
                  };

                };

                for ($y = 0; $y <= $aantalmaster - 1; $y++) 
                { 
                  $masterid = $result_data['GetDataCheckDataNewBETAResult']['Comp_Master']['Expl_Comp_Master'][$y]['UID_COMP'];
                  
                  


                  for ($i = 0; $i <= $aantalNaam - 1; $i++) 
                  { 
                    $compid = $result_data['GetDataCheckDataNewBETAResult']['Comp_Addresses']['Expl_Comp_Addresses'][$i]['UID_Comp'];
                    if( $compid == $masterid) {
                     
                      
                    }
 }
                  };
                  }
                  $si = 0;
                  if($result_data['GetDataCheckDataNewBETAResult']['Solv_Master']['Expl_Solv_Master'] != ''){
                  
                    $solarretjes = array();
                    $judgearr = array();
                    $gerechtelijkearr = array();
                    $curaarray = array();

                    $solarretjes = $result_data['GetDataCheckDataNewBETAResult']['Solv_Master']['Expl_Solv_Master'];
                    $judgearr = $result_data['GetDataCheckDataNewBETAResult']['Solv_Judges']['Expl_Solv_Judges'];
                    $gerechtelijkearr = $result_data['GetDataCheckDataNewBETAResult']['Solv_Publications']['Expl_Solv_Publications'];
                    $curaarray = $result_data['GetDataCheckDataNewBETAResult']['Solv_Curator']['Expl_Solv_Curator'];
                  } else {
                    
                  }


                  //Adres dingen
                  //Adres[Prop]
                  $proparr = array();
                  $arrprop = array();

                  if(empty($result_data['GetDataCheckDataNewBETAResult']['Prop'])) {
                    //Niks gevonden
                    $arrprop['adr_oppervlakte'] = '';
                    $arrprop['adr_waarde'] = '';
                    $arrprop['adr_cultivatie'] = '';  
                    $arrprop['adr_bebouwd'] = '';

                    //Even kijken of er move gegevens zijn
                    if(empty($result_data['GetDataCheckDataNewBETAResult']['Move'])) {
                      //Niks gevonden
                    } else {
                      //Wel iets gevonden dus toevoegen
                      $arrprop['move_res'] = $this->mod_scans->getresultdescrip($result_data['GetDataCheckDataNewBETAResult']['Move']['Expl_Move']['Result']);
                      $arrprop['move_adres'] = $result_data['GetDataCheckDataNewBETAResult']['Move']['Expl_Move']['Street'];
                      $arrprop['move_nummer'] = $result_data['GetDataCheckDataNewBETAResult']['Move']['Expl_Move']['Housenumber'];
                      $arrprop['move_extentie'] = $result_data['GetDataCheckDataNewBETAResult']['Move']['Expl_Move']['Extension'];
                      $arrprop['move_postcode'] = $result_data['GetDataCheckDataNewBETAResult']['Move']['Expl_Move']['Zipcode'];
                      $arrprop['move_plaats'] = $result_data['GetDataCheckDataNewBETAResult']['Move']['Expl_Move']['City'];
                      $arrprop['move_datum'] = $result_data['GetDataCheckDataNewBETAResult']['Move']['Expl_Move']['MutationDate'];
                    }

                    array_push($proparr, $arrprop);
                  } else {
                    //Wel iets gevonden
                    $arrprop['adr_oppervlakte'] = $result_data['GetDataCheckDataNewBETAResult']['Prop']['Expl_Prop']['Area'];
                    $arrprop['adr_waarde'] = $result_data['GetDataCheckDataNewBETAResult']['Prop']['Expl_Prop']['Value'];
                    $arrprop['adr_cultivatie'] = $this->mod_scans->getresultdescrip($result_data['GetDataCheckDataNewBETAResult']['Prop']['Expl_Prop']['Culture']);  
                    $arrprop['adr_bebouwd'] = $this->mod_scans->getresultdescrip($result_data['GetDataCheckDataNewBETAResult']['Prop']['Expl_Prop']['Indication']);

                    //Even kijken of er move gegevens zijn
                    if(empty($result_data['GetDataCheckDataNewBETAResult']['Move'])) {
                      //Niks gevonden
                    } else {
                      //Wel iets gevonden dus toevoegen
                      $arrprop['move_res'] = $this->mod_scans->getresultdescrip($result_data['GetDataCheckDataNewBETAResult']['Move']['Expl_Move']['Result']);
                      $arrprop['move_adres'] = $result_data['GetDataCheckDataNewBETAResult']['Move']['Expl_Move']['Street'];
                      $arrprop['move_nummer'] = $result_data['GetDataCheckDataNewBETAResult']['Move']['Expl_Move']['Housenumber'];
                      $arrprop['move_extentie'] = $result_data['GetDataCheckDataNewBETAResult']['Move']['Expl_Move']['Extension'];
                      $arrprop['move_postcode'] = $result_data['GetDataCheckDataNewBETAResult']['Move']['Expl_Move']['Zipcode'];
                      $arrprop['move_plaats'] = $result_data['GetDataCheckDataNewBETAResult']['Move']['Expl_Move']['City'];
                      $arrprop['move_datum'] = $result_data['GetDataCheckDataNewBETAResult']['Move']['Expl_Move']['MutationDate'];
                    }

                    array_push($proparr, $arrprop);  
                  }

                  $fotourl = '';
                  if(empty($result_data['GetDataCheckDataNewBETAResult']['Foto']))
                  {
                    //Niks gevonden
                    $fotourl = '';
                  } else {
                    $fotourl = $result_data['GetDataCheckDataNewBETAResult']['Foto']['Expl_Foto']['Image'];
                  }


                  $idarr = array();
          //We stoppen het in een array

                  if(empty($result_data['GetDataCheckDataNewBETAResult']['Name']['Expl_Name'])) {
                    $datacheckuitgevoerd = false;

                    if($result_data['GetDataCheckDataNewBETAResult']['Errorcode'] <> '13003') {
                      $datreden = 'Er is iets niet goed gegegaan met het uitvoeren van de datacheck. Neem contact op met IDchecker';
                    } else {
                      $datreden = 'Er is geen datacheck aangevraagd';
                    }

                    $idarr = array(
                    'id_voornaam' => $result_id['RetrieveDataIdentityCardCompleteResult']['ForeName'],
                    'id_achternaam' => $result_id['RetrieveDataIdentityCardCompleteResult']['Surname'],
                    'id_gebdat' => $result_id['RetrieveDataIdentityCardCompleteResult']['DateOfBirth'],
                    'id_expdat' => $result_id['RetrieveDataIdentityCardCompleteResult']['Expirarydate'],
                    'id_status' => $result_id['RetrieveDataIdentityCardCompleteResult']['Status'],
                    'id_land' => $result_id['RetrieveDataIdentityCardCompleteResult']['CountryInDutch'],
                    'id_rapurl' => $result_id['RetrieveDataIdentityCardCompleteResult']['HyperlinkIdcheckerReport'],
                    'id_front' => $result_id['RetrieveDataIdentityCardCompleteResult']['FrontsideImageCropped'],
                    //'id_back' => $result_id['RetrieveDataIdentityCardCompleteResult']['BacksideImageCropped'],
                    //Overige checks voor het id
                    'id_pasfoto' => $result_id['RetrieveDataIdentityCardCompleteResult']['PassphotoOK'],
                    'id_laminaat' => $result_id['RetrieveDataIdentityCardCompleteResult']['LaminateCheck'],
                    'id_lettertype' => $result_id['RetrieveDataIdentityCardCompleteResult']['LettertypeCheck'],
                    'id_spelfouten' => $result_id['RetrieveDataIdentityCardCompleteResult']['LettertypeOK'],
                    'id_kineholo' => $result_id['RetrieveDataIdentityCardCompleteResult']['KinegramHologramCheck'],
                    'id_imageperf' => $result_id['RetrieveDataIdentityCardCompleteResult']['ImagePerfCheck'],
                    'id_idnum' => $result_id['RetrieveDataIdentityCardCompleteResult']['DocumentNumberCheck'],
                    'id_basisbedr' => $result_id['RetrieveDataIdentityCardCompleteResult']['BasicPrintingCheck'],
                    //DataCheck dingen
                    'datagedaan' => $datacheckuitgevoerd,
                    'id_vis' => $result_data['GetDataCheckDataNewBETAResult']['DocnumberRegisteredAsStolen'],
                    'datareden' => $datreden
                    //Persoon[NAME]
                    );
            } else {

          $idarr = array(
            'id_voornaam' => $result_id['RetrieveDataIdentityCardCompleteResult']['ForeName'],
            'id_achternaam' => $result_id['RetrieveDataIdentityCardCompleteResult']['Surname'],
            'id_gebdat' => $result_id['RetrieveDataIdentityCardCompleteResult']['DateOfBirth'],
            'id_expdat' => $result_id['RetrieveDataIdentityCardCompleteResult']['Expirarydate'],
            'id_status' => $result_id['RetrieveDataIdentityCardCompleteResult']['Status'],
            'id_land' => $result_id['RetrieveDataIdentityCardCompleteResult']['CountryInDutch'],
            'id_rapurl' => $result_id['RetrieveDataIdentityCardCompleteResult']['HyperlinkIdcheckerReport'],
            'id_front' => $result_id['RetrieveDataIdentityCardCompleteResult']['FrontsideImageCropped'],
            //'id_back' => $result_id['RetrieveDataIdentityCardCompleteResult']['BacksideImageCropped'],
            //Overige checks voor het id
            'id_pasfoto' => $result_id['RetrieveDataIdentityCardCompleteResult']['PassphotoOK'],
            'id_laminaat' => $result_id['RetrieveDataIdentityCardCompleteResult']['LaminateCheck'],
            'id_lettertype' => $result_id['RetrieveDataIdentityCardCompleteResult']['LettertypeCheck'],
            'id_spelfouten' => $result_id['RetrieveDataIdentityCardCompleteResult']['LettertypeOK'],
            'id_kineholo' => $result_id['RetrieveDataIdentityCardCompleteResult']['KinegramHologramCheck'],
            'id_imageperf' => $result_id['RetrieveDataIdentityCardCompleteResult']['ImagePerfCheck'],
            'id_idnum' => $result_id['RetrieveDataIdentityCardCompleteResult']['DocumentNumberCheck'],
            'id_basisbedr' => $result_id['RetrieveDataIdentityCardCompleteResult']['BasicPrintingCheck'],
            //DataCheck dingen
            'datagedaan' => $datacheckuitgevoerd,
            'id_vis' => $result_data['GetDataCheckDataNewBETAResult']['DocnumberRegisteredAsStolen'],
            'datareden' => '',
            //Persoon[NAME]
            // Aftesten of er een datacheck is uitgevoerd.
            
          'pers_resultaat' => $this->mod_scans->getresultdescrip($result_data['GetDataCheckDataNewBETAResult']['Name']['Expl_Name']['Result']),
            'pers_geslacht' => $result_data['GetDataCheckDataNewBETAResult']['Name']['Expl_Name']['Sexe'],
            'pers_Naam' => $result_data['GetDataCheckDataNewBETAResult']['Name']['Expl_Name']['LastName'],
            'pers_tussenvoegsel' => $result_data['GetDataCheckDataNewBETAResult']['Name']['Expl_Name']['Prefix'],
            'pers_initialen' => $result_data['GetDataCheckDataNewBETAResult']['Name']['Expl_Name']['Initials'],
            'pers_voornamen' => $result_data['GetDataCheckDataNewBETAResult']['Name']['Expl_Name']['FirstNames'],
            'pers_geboortedat' => $result_data['GetDataCheckDataNewBETAResult']['Name']['Expl_Name']['BirthDate'],
            'pers_overleden' => $result_data['GetDataCheckDataNewBETAResult']['Name']['Expl_Name']['Deceased'],
            'pers_overledenDatum' => $result_data['GetDataCheckDataNewBETAResult']['Name']['Expl_Name']['DeceaseDate'],
            'pers_huisnummer' => $result_data['GetDataCheckDataNewBETAResult']['Call']['Expl_Call']['Housenumber'],
            'pers_toevoeging' => $result_data['GetDataCheckDataNewBETAResult']['Call']['Expl_Call']['Extension'],
            'pers_postcode' => $result_data['GetDataCheckDataNewBETAResult']['Call']['Expl_Call']['Zipcode'],
             //Adres[POST]
            'adr_resultaat' => $this->mod_scans->getresultdescrip($result_data['GetDataCheckDataNewBETAResult']['Post']['Expl_Post']['Result']),
            'adr_res_desc' => $result_data['GetDataCheckDataNewBETAResult']['Post']['Expl_Post']['Result'],
            'adr_straat' => $result_data['GetDataCheckDataNewBETAResult']['Post']['Expl_Post']['Street'],
            'adr_huisnummer' => $result_data['GetDataCheckDataNewBETAResult']['Post']['Expl_Post']['HouseNumber'],
            'adr_extentie' => $result_data['GetDataCheckDataNewBETAResult']['Post']['Expl_Post']['Extension'],
            'adr_postcode' => $result_data['GetDataCheckDataNewBETAResult']['Post']['Expl_Post']['ZipCode'],
            'adr_plaats' => $result_data['GetDataCheckDataNewBETAResult']['Post']['Expl_Post']['City'],
            'adr_provincie' => $result_data['GetDataCheckDataNewBETAResult']['Post']['Expl_Post']['State'],
            //Adres[Addr]
            'adr_eigendom' => $this->mod_scans->getresultdescrip($result_data['GetDataCheckDataNewBETAResult']['Addr']['Expl_ADDR']['OwnerShip']),
            'adr_perceel' => $this->mod_scans->getresultdescrip($result_data['GetDataCheckDataNewBETAResult']['Addr']['Expl_ADDR']['ParcelType']."P"),
            'adr_aantalbedr' => $result_data['GetDataCheckDataNewBETAResult']['Addr']['Expl_ADDR']['Companies'],
            //Adres[Prop]
            'prop_array' => $proparr,
            //Adres[Foto]
            'adr_foto' => $fotourl,
            //Telefoon[Tele]
            'tel_array' => $result_data['GetDataCheckDataNewBETAResult']['Tele']['Expl_Tele'],
            //bedrijfsgegevens[Comp]
            'comp_array' => $comparr,
            //Gerechtelijke[Solv]
            'solv_array' => $solarretjes,
            //judge
            'judge_arr' => $judgearr,
            //Ger uitspraken []
            'uispr_array' => $gerechtelijkearr,
            //Curator [cura]
            'cura_array' => $curaarray,
            //Krediet[Debt]
            'debt_resultaat' => $this->mod_scans->getresultdescrip($result_data['GetDataCheckDataNewBETAResult']['Debt']['Expl_Debt']['Result']),
            'debt_persoon' => $result_data['GetDataCheckDataNewBETAResult']['Debt']['Expl_Debt']['Person'],
            'debt_adres' => $result_data['GetDataCheckDataNewBETAResult']['Debt']['Expl_Debt']['Address'],
            'debt_postcode' => $result_data['GetDataCheckDataNewBETAResult']['Debt']['Expl_Debt']['ZipCode'],
            //Historisch bevragingen[mtch]
            'hb_aantalbevr' => $result_data['GetDataCheckDataNewBETAResult']['Hits']['Expl_Hits']['CountPerson'],
            'hb_aantaladres' => $result_data['GetDataCheckDataNewBETAResult']['Hits']['Expl_Hits']['DistinctAddress']
          );
}
          

          $this->load->view('scans/vw_headervervolg', $data);
          $this->load->view('scans/vw_scandetail.php', $idarr);
          $this->load->view('scans/vw_footervervolg', '');

            } else {
              
              $datacheckuitgevoerd = 'false' ;

              //Alleen IDcheck laten zien
                  $idarr = array();
              //We stoppen het in een array
                 // print_r($result_id);
              $idarr = array(
                'id_voornaam' => $result_id['RetrieveDataIdentityCardCompleteResult']['ForeName'],
                'id_achternaam' => $result_id['RetrieveDataIdentityCardCompleteResult']['Surname'],
                'id_gebdat' => $result_id['RetrieveDataIdentityCardCompleteResult']['DateOfBirth'],
                'id_expdat' => $result_id['RetrieveDataIdentityCardCompleteResult']['Expirarydate'],
                'id_status' => $result_id['RetrieveDataIdentityCardCompleteResult']['Status'],
                'id_land' => $result_id['RetrieveDataIdentityCardCompleteResult']['CountryInDutch'],
                'id_rapurl' => $result_id['RetrieveDataIdentityCardCompleteResult']['HyperlinkIdcheckerReport'],
                'id_front' => $result_id['RetrieveDataIdentityCardCompleteResult']['FrontsideImageCropped'],
                'id_reason' => $result_id['RetrieveDataIdentityCardCompleteResult']['RejectReason'],
                //'id_back' => $result_id['RetrieveDataIdentityCardCompleteResult']['BacksideImageCropped'],
                //Overige checks voor het id
                'id_pasfoto' => $result_id['RetrieveDataIdentityCardCompleteResult']['PassphotoOK'],
                'id_laminaat' => $result_id['RetrieveDataIdentityCardCompleteResult']['LaminateCheck'],
                'id_lettertype' => $result_id['RetrieveDataIdentityCardCompleteResult']['LettertypeCheck'],
                'id_spelfouten' => $result_id['RetrieveDataIdentityCardCompleteResult']['LettertypeOK'],
                'id_kineholo' => $result_id['RetrieveDataIdentityCardCompleteResult']['KinegramHologramCheck'],
                'id_imageperf' => $result_id['RetrieveDataIdentityCardCompleteResult']['ImagePerfCheck'],
                'id_idnum' => $result_id['RetrieveDataIdentityCardCompleteResult']['DocumentNumberCheck'],
                'id_basisbedr' => $result_id['RetrieveDataIdentityCardCompleteResult']['BasicPrintingCheck'],
                //DataCheck dingen
                'datagedaan' => $datacheckuitgevoerd,
                'id_vis' => $result_data['GetDataCheckDataNewBETAResult']['DocnumberRegisteredAsStolen']
                );

             // /print_r($idarr);

              $this->load->view('scans/vw_headervervolg', $data);
              $this->load->view('scans/vw_scandetail.php', $idarr);
              $this->load->view('scans/vw_footervervolg', '');

            }
              
              

             

              
              
          
          
        }
    }

}
 
}

?>