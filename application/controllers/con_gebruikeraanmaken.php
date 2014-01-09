<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class gebruiker extends CI_Controller {

  function __construct()
  {
    parent::__construct();
   
  }

  function index()
  {
    //This method will have the credentials validation
    $this->maakgebruikeraan()
    
  }
  
  function maakgebruikeraan()
  {
      $this->load->view($classurl.'vw_headervervolg', $data);
      $this->load->view('gebruikers/vw_gebruikersaanmaken');
      $this->load->view($classurl.'vw_footervervolg', '');
    }
  }
}
?>