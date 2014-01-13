<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start(); //we need to call PHP's session object to access it through CI
class scans extends CI_Controller {

  function __construct()
  {
    parent::__construct();
    
  }


function scanzoeken(){
   if($this->session->userdata('logged_in'))
    {
      $session_data = $this->session->userdata('logged_in');
      $data['username'] = $session_data['username'];
      $data['id'] = $session_data['id'];
      $data['naam'] = $session_data['naam'];
      $data['zoekw'] = $this->input->post('achternaam');
      $data['go'] = 1;
      $data['af'] = 1;
      $data['re'] = 1;
      $this->load->view('vw_headervervolg', $data);
      $this->load->view('scans/vw_scansoverzicht', $data);
      $this->load->view('vw_footervervolg', '');
    }

}

function scanselect(){
   if($this->session->userdata('logged_in'))
    {
      $session_data = $this->session->userdata('logged_in');
      $data['username'] = $session_data['username'];
      $data['id'] = $session_data['id'];
      $data['naam'] = $session_data['naam'];
      $data['go'] = $this->input->post('go');
      $data['af'] = $this->input->post('af');
      $data['re'] = $this->input->post('re');
      $data['zoekw'] = $this->input->post('achternaam');
      $this->load->view('vw_headervervolg', $data);
      $this->load->view('scans/vw_scansoverzicht', $data);
      $this->load->view('vw_footervervolg', '');
    }

}
  
}



?>