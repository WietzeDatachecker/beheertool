<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class VerifyLogin extends CI_Controller {

  function __construct()
  {
    parent::__construct();
    $this->load->model('registration_model','',TRUE);
  }

  function index()
  {
    //This method will have the credentials validation
    $this->load->helper('form');
    $this->load->library('form_validation');

     //form validatie
      $this->form_validation->set_rules('bedrijfsnaam', 'Bedrijfsnaam', 'required');
      $this->form_validation->set_rules('user_email', 'E-mailadres', 'required');
      $this->form_validation->set_rules('aantal_checks', 'Aantal checks', 'required');

     
       if($this->form_validation->run() == FALSE)
      {
      //Naar de aanmaak pagina
        $arr = array(
                      'title' => 'Maak gebruiker aan',
                      'test' => 'test yarno'
                    );

        $this->load->view('gebruikers/vw_gebruikersaanmaken',$arr);
      }
      else
      {
        //Module aanroepen
         $this->Gebruikersaanmaak_module->gebruikeraanmaken();
        //Go to private area
        $this->load->view('gebruikers/vw_gebruikersaanmaken');
      }
      
      $this->load->view('vw_footer', '');
    }
    
  }
?>