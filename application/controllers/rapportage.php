<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start(); //we need to call PHP's session object to access it through CI
class rapportage extends CI_Controller {

  function __construct()
  {
    parent::__construct();
    //$this->load->model('mod_scans','',TRUE);
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
      $this->load->view('rapportage/vw_rapportage', '');
      $this->load->view('vw_footer', '');
    }
   
 }

 function klantrapportage(){
   if($this->session->userdata('logged_in'))
    {
      $session_data = $this->session->userdata('logged_in');
      $data['username'] = $session_data['username'];
      $data['id'] = $session_data['id'];
      $data['naam'] = $session_data['naam'];
      $p = $this->input->post();
      $data['kn'] = $this->input->post('klantenbox');
      $data['tr'] = $this->input->post('typerap');
      $data['br'] = $this->input->post('bronrap');
      $data['jr'] = $this->input->post('jaarrap');
      
            
      
      $this->load->view('vw_header', $data);
      $this->load->view('rapportage/vw_rapportage', $data);
      $this->load->view('vw_footer', '');
    }

}

}