<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start(); //we need to call PHP's session object to access it through CI
class gebruikers extends CI_Controller {

  function __construct()
  {
    parent::__construct();
    
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
      $this->load->view('gebruikers/vw_gebruikers', '');
      $this->load->view('vw_footer', '');
    }
   
 }

 function gebruikerszoeken(){
   if($this->session->userdata('logged_in'))
    {
      $session_data = $this->session->userdata('logged_in');
      $data['username'] = $session_data['username'];
      $data['id'] = $session_data['id'];
      $data['naam'] = $session_data['naam'];
      $data['zoekw'] = $this->input->post('bedrijfsnaam');
      $this->load->view('vw_headervervolg', $data);
      $this->load->view('gebruikers/vw_gebruikers', $data);
      $this->load->view('vw_footervervolg', '');
    }

}



 function gebruikersaanmaken(){


    if($this->session->userdata('logged_in'))

      $classurl = "";
    {
      $session_data = $this->session->userdata('logged_in');
      $data['username'] = $session_data['username'];
      $data['id'] = $session_data['id'];
      $data['naam'] = $session_data['naam'];

      

      $this->load->view($classurl.'vw_headervervolg', $data);
          
           

          $arr = array(
                          'title' => 'Maak gebruiker aan',
                          'test' => 'test yarno'
                        );

          //Er is nog niks of er is iets fout dus naar aanmaken
          

          $this->load->view('gebruikers/vw_gebruikersaanmaken',$arr);
       
          
          $this->load->view($classurl.'vw_footervervolg', '');
        }
    
   }

   function gebruikersaanmakenwalter(){


    if($this->session->userdata('logged_in'))

      $classurl = "";
    {
      $session_data = $this->session->userdata('logged_in');
      $data['username'] = $session_data['username'];
      $data['id'] = $session_data['id'];
      $data['naam'] = $session_data['naam'];

      

      $this->load->view($classurl.'vw_headervervolg', $data);
          
           

          $arr = array(
                          'title' => 'Maak gebruiker aan',
                          'test' => 'test yarno'
                        );

          //Er is nog niks of er is iets fout dus naar aanmaken
          

          $this->load->view('gebruikers/vw_gebruikersaanmakenwalter',$arr);
       
          
          $this->load->view($classurl.'vw_footervervolg', '');
        }
    
   }

  function insert_gebruiker() {

      $this->load->helper('form');
      $this->load->library('form_validation');

      //form validatie
      $this->form_validation->set_rules('bedrijfsnaam', 'Bedrijfsnaam', 'required');
      $this->form_validation->set_rules('user_email', 'E-mailadres', 'required');
      $this->form_validation->set_rules('aantal_checks', 'Aantal checks', 'required');

        if($this->form_validation->run() == FALSE)
        {
          //Er is iets niet ingevuld....
           $arr = array(
                          'title' => 'Maak gebruiker aan',
                          'test' => 'test yarno'
                        );

           $this->load->view('gebruikers/vw_gebruikersaanmaken',$arr);
        }
        else
        {
          //Moneybird factuur aanmaken
          if($this->input->post('licentie_pj') != '' ) {
              $licentieprijs = $this->input->post('licentie_pj');
            } else {
              $licentieprijs = 0;
            }

          $this->load->model('mod_moneybird','',TRUE);
          $continfo = $this->mod_moneybird->GetContact();


          $moneyID = 0;

         foreach ($continfo as $contact) {
              if($contact->name == $this->input->post('bedrijfsnaam')){
               $moneyID = $contact->customer_id ;
              }
            }

          If($moneyID > 0) {
            
            

            //Moneybird gebruiker gevonden dus factuur aanmaken
            $mbbool = $this->mod_moneybird->maakfactuurNieuwklant($moneyID,$this->input->post('aantal_checks'),$this->input->post('prijs_per_check'),$licentieprijs,$this->input->post('email'));
          } else {
            //Nog geen moneybird gebruiker dus aanmaken
            $contactnieuw = $this->mod_moneybird->MaakNieuwContact();
             $moneyID = $contactnieuw->customer_id ;
            
            if($moneyID > 0) {
            //Nu de factuur aanmaken
            $mbbool = $this->mod_moneybird->maakfactuurNieuwklant($moneyID,$this->input->post('aantal_checks'),$this->input->post('prijs_per_check'),$licentieprijs,$this->input->post('email'));
            }
          }

          //Gebruiker aanmaken in DB
          $this->load->model('gebruikersaanmaak_module');
          $retbool = $this->gebruikersaanmaak_module->gebruikeraanmaken($moneyID);

          if($retbool > 0)
          {
            $classurl = "";
            $session_data = $this->session->userdata('logged_in');
            $data['username'] = $session_data['username'];
            $data['id'] = $session_data['id'];
            $data['naam'] = $session_data['naam'];
            $this->load->view($classurl.'vw_headervervolg', $data);

            $arrresponse = array(
                            'Bedrijfsnaam' => $this->input->post('bedrijfsnaam'),
                            'Gebruikersnaam' => $this->input->post('user_email'),
                            'Saldo' => $this->input->post('aantal_checks'),
                            'userid' => $retbool
            );

            $this->load->view('gebruikers/success',$arrresponse);//loading success view
             $this->load->view($classurl.'vw_footervervolg', '');
          } else {
            $this->load->view('gebruikers/mislukt');//loading success view
          }
        }
  }

function insert_gebruikerwalter() {

      $this->load->helper('form');
      $this->load->library('form_validation');

      //form validatie
      $this->form_validation->set_rules('bedrijfsnaam', 'Bedrijfsnaam', 'required');
      $this->form_validation->set_rules('user_email', 'E-mailadres', 'required');
    
        if($this->form_validation->run() == FALSE)
        {
          //Er is iets niet ingevuld....
           $arr = array(
                          'title' => 'Maak gebruiker aan',
                          'test' => 'test yarno'
                        );

           $this->load->view('gebruikers/vw_gebruikersaanmakenwalter',$arr);
        }
        else
        {
          //Moneybird factuur aanmaken

          $this->load->model('mod_moneybird','',TRUE);
          $continfo = $this->mod_moneybird->GetContact();


          $moneyID = 0;

         foreach ($continfo as $contact) {
              if($contact->name == $this->input->post('bedrijfsnaam')){
               $moneyID = $contact->customer_id ;
              }
            }


          //Gebruiker aanmaken in DB
          $this->load->model('gebruikersaanmaak_module');
          $retbool = $this->gebruikersaanmaak_module->gebruikeraanmakenwalter($moneyID);

          if($retbool > 0)
          {
            $classurl = "";
            $session_data = $this->session->userdata('logged_in');
            $data['username'] = $session_data['username'];
            $data['id'] = $session_data['id'];
            $data['naam'] = $session_data['naam'];
            $this->load->view($classurl.'vw_headervervolg', $data);

            $arrresponse = array(
                            'Bedrijfsnaam' => $this->input->post('bedrijfsnaam'),
                            'Gebruikersnaam' => $this->input->post('user_email'),
                            'Saldo' => $this->input->post('aantal_checks'),
                            'userid' => $retbool
            );

            $this->load->view('gebruikers/success',$arrresponse);//loading success view
             $this->load->view($classurl.'vw_footervervolg', '');
          } else {
            $this->load->view('gebruikers/mislukt');//loading success view
          }
        }
  }

function haalgebruikersgegevens($gebr_id, $saldosucces, $wwsucces, $edtsucces){
   if($this->session->userdata('logged_in'))
    {
      $this->load->model('mod_moneybird','',TRUE);
      $session_data = $this->session->userdata('logged_in');
      $data['username'] = $session_data['username'];
      $data['id'] = $session_data['id'];
      $data['naam'] = $session_data['naam'];

      $arrgebr = array(
            'id' => $gebr_id,
            'saldosucces' => $saldosucces,
            'wwsucces' => $wwsucces,
            'edtsucces' => $edtsucces
            );
    
      $this->load->view('gebruikers/vw_headervervolg', $data);
      $this->load->view('gebruikers/vw_editgebruiker', $arrgebr);
      $this->load->view('gebruikers/vw_footervervolg', '');
    }

}

function insert_saldo() {  

      $this->load->helper('form');
      $this->load->library('form_validation'); 

      $this->form_validation->set_rules('saldo_aanvrager', 'Aanvrager', 'required');
      $this->form_validation->set_rules('saldo_saldo', 'Saldo', 'required');  

         if($this->form_validation->run() == FALSE)
        {

        } else 
        {
          //inserten dat saldo
          $this->load->model('mod_saldo');
          $retbool = $this->mod_saldo->updatesaldo();

          if($retbool ==  'true') {
            //Moneybird sectie even factuur maken
            $this->load->model('mod_moneybird');
            //Hier wil ik een hack
            $contactId = $this->input->post('saldo_mbid');
            if($contactId == 0) {
              //we moeten even kijken of we deze klant kunnen vinden in MB
              $continfo = $this->mod_moneybird->GetContact();
              foreach ($continfo as $contact) {
                if($contact->name == $this->input->post('saldo_bedrijfsnaam')){
                 $contactId = $contact->customer_id;
                 if($contactId > 0) {
                 //Als ik hem gevonden heb wil ik ook even het mbid updaten van deze klant
                 $this->load->model('gebruikersaanmaak_module');
                 $bmbid = $this->gebruikersaanmaak_module->updatembid($contactId,$this->input->post('saldo_userid'));
                 } 

                } 
                
                     
                   
                }
                if($contactId == 0) {
                  //Nog steeds niks gevonden dus een nieuwe aanmaken in MB

                  $qrygegevens = $this->db->query('SELECT * FROM `DataCgebruikers` LEFT OUTER JOIN DataCGebruikersNaw ON DataCgebruikers.UID=DataCGebruikersNaw.GebruikersID WHERE DataCgebruikers.UID ='.$this->input->post('saldo_userid') );

                  foreach ($qrygegevens->result() as $row)
                    {
                      //gebruikers gegevens
                      $bedrijfsnaam = $row->Bedrijfsnaam;
                      //adres gegevens
                      $adres = $row->Adres;
                      $postcode = $row->Postcode;
                      $plaats = $row->Plaats;
                      $emailadres = $row->emailadres;
                      $contactpersoon = $row->Contact_persoon;

                      
                    }
                    //echo $bedrijfsnaam;
                    $contactIdnieuw = $this->mod_moneybird->MaakNieuwContactsaldoupdate($adres,$postcode,$plaats,$bedrijfsnaam,$emailadres,$contactpersoon);
                    $contactId = $contactIdnieuw->customer_id;
                    // Aangemaakt dus even updaten
                    $this->load->model('gebruikersaanmaak_module');
                    $bmbid = $this->gebruikersaanmaak_module->updatembid($contactId,$this->input->post('saldo_userid'));
                    //echo "Het nieuwe id = ".$contactId;
              }
            }

            $mbbool = $this->mod_moneybird->maakfactuur($contactId,$this->input->post('saldo_saldo'),$this->input->post('saldo_prijs'),$this->input->post('saldo_contactemail'));
          }

          if($mbbool == 'true') {
            //ff loggen
            $session_data = $this->session->userdata('logged_in');
            $logarr = array(
                    'BeheerderID' => $session_data['id'],
                    'GebruikersID' => $this->input->post('saldo_userid'),
                    'TypeActie' => 'Factuur',
                    'ActieOmschrijving' => 'Er is een factuur verzonden via Moneybird voor het ophogen van het saldo door '.$session_data['naam'],
                    'ActieDatum' => date("y/m/d : H:i:s", time())
            );

             $this->db->insert('DataCLogging', $logarr);

          }
          //$this->haalgebruikersgegevens($this->input->post('saldo_userid'),true,false);
          redirect('gebruikers/haalgebruikersgegevens/'.$this->input->post('saldo_userid').'/true/false/false', 'refresh'); 
        }


  }

  function insert_saldowalter() {  

      $this->load->helper('form');
      $this->load->library('form_validation'); 

      $this->form_validation->set_rules('saldo_saldo', 'Saldo', 'required');  

         if($this->form_validation->run() == FALSE)
        {

        } else 
        {
          //inserten dat saldo
          $this->load->model('mod_saldo');
          $retbool = $this->mod_saldo->updatesaldowalter();

          //$this->haalgebruikersgegevens($this->input->post('saldo_userid'),true,false);
          redirect('gebruikers/haalgebruikersgegevens/'.$this->input->post('saldo_userid').'/true/false/false', 'refresh'); 
        }


  }

 function send_nieuwwachtwoord()
    {

       $this->load->model('mod_wachtwoord');
       $resbool = $this->mod_wachtwoord->resetwachtwoord();

       redirect('gebruikers/haalgebruikersgegevens/'.$this->input->post('ww_userid').'/false/true/false', 'refresh'); 



    }

  function updategegevens() 
  {
    $this->load->model('mod_updategebruikersdingen');
    $resbool = $this->mod_updategebruikersdingen->updategegevens();

    if($resbool == 'true') 
    {
      redirect('gebruikers/haalgebruikersgegevens/'.$this->input->post('uid').'/false/false/true', 'refresh'); 
    }
  }

  function insert_opmerking() {  

      $this->load->helper('form');
      $this->load->library('form_validation'); 

      $this->form_validation->set_rules('opmerking_opmerking', 'Opmerking', 'required');
     
         if($this->form_validation->run() == FALSE)
        {

        } else {
         //Even de opmerking inserten
          $this->load->model('mod_opmerkingen');
          $retbool = $this->mod_opmerkingen->insertopmerking();
          
          if($retbool == 'true') {
            //Insertgelukt en redirect
            redirect('gebruikers/haalgebruikersgegevens/'.$this->input->post('opmerking_userid').'/false/false/false', 'refresh');
          }

           
        }
      }
  
  
}



?>