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
      $data['go'] = 0;
      $this->load->view('vw_header', $data);
      $this->load->view('scans/vw_scansoverzicht', $data);
      $this->load->view('vw_footer', '');
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
      $data['zoekw'] = $this->input->post('achternaam');
      $this->load->view('vw_header', $data);
      $this->load->view('scans/vw_scansoverzicht', $data);
      $this->load->view('vw_footer', '');
    }

}
  
}



?>