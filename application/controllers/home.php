<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start(); //we need to call PHP's session object to access it through CI
class Home extends CI_Controller {

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

     $this->load->model('mod_sql', '', $data);
     $this->load->view('vw_header', $data);
     $this->load->view('vw_home', '');
     $this->load->view('vw_footer', '');

      //print_r($data);
    }
    else
    {
      //If no session, redirect to login page
      redirect('', 'refresh');
	}
  }
  
  function logout()
  {
    $this->session->unset_userdata('logged_in');
    session_destroy();
    redirect('home', 'refresh');
  }


}

?>