<?php
/**
* 
*/
class gebruikersaanmaak_module extends CI_Model
{

    function gebruikeraanmakenwalter($mbid)
    {
        $this->load->library('encrypt');
        $pw = $this->input->post('wachtwoord');

        $encrypted_string = $this->encrypt->encode($pw);

        $insertdata = array(
                	'Bedrijfsnaam' => $this->input->post('bedrijfsnaam'),
                    'Gebruikersnaam' => $this->input->post('gebruikersnaam'),
                    'Wachtwoord' =>  $encrypted_string,
                    'Saldo' => $this->input->post('aantal_checks'),
                    'Type_check' => $this->input->post('gebr_type'),
                    'mbID' => $mbid

        );


        $this->db->insert('DataCgebruikers', $insertdata);

        //We willen dat er een UID terug gestuurd wordt zodat we de user details kunnen invoeren
		$UID = mysql_insert_id();

        $inserinfo = array(
                    'GebruikersID' => $UID, 
                    'Adres' => $this->input->post('adres'),
                    'Postcode' => $this->input->post('postcode'),
                    'Plaats' => $this->input->post('plaats'),
                    'Telefoon' => $this->input->post('telefoon'),
                    'mobiel' => $this->input->post('mobiel'),
                    'emailadres' => $this->input->post('email'),
                    'Contact_persoon' => $this->input->post('contact_persoon'),
                    'website' => $this->input->post('website')
        );

        $this->db->insert('DataCGebruikersNaw', $inserinfo);

        $UIDinfo = mysql_insert_id();

        if($UIDinfo) {

            //FF loggen
            $session_data = $this->session->userdata('logged_in');
            $logarr = array(
                    'BeheerderID' => $session_data['id'],
                    'GebruikersID' => $UID,
                    'TypeActie' => 'Aanmaak',
                    'ActieOmschrijving' => 'Gebruikers is handmatig toegevoegd door '.$session_data['naam'],
                    'ActieDatum' => date("y/m/d : H:i:s", time())
            );

             $this->db->insert('DataCLogging', $logarr);


		return $UID;
    } else {
        return false;
    }
    }

     function gebruikeraanmaken($mbid)
    {
        $this->load->library('encrypt');
        $pw = 'DataCheckerGebruiker!';

        $encrypted_string = $this->encrypt->encode($pw);

        $insertdata = array(
                    'Bedrijfsnaam' => $this->input->post('bedrijfsnaam'),
                    'Gebruikersnaam' => $this->input->post('gebruikersnaam'),
                    'Wachtwoord' =>  $encrypted_string,
                    'Saldo' => $this->input->post('aantal_checks'),
                    'Type_check' => $this->input->post('gebr_type'),
                    'mbID' => $mbid

        );


        $this->db->insert('DataCgebruikers', $insertdata);

        //We willen dat er een UID terug gestuurd wordt zodat we de user details kunnen invoeren
        $UID = mysql_insert_id();

        $inserinfo = array(
                    'GebruikersID' => $UID, 
                    'Adres' => $this->input->post('adres'),
                    'Postcode' => $this->input->post('postcode'),
                    'Plaats' => $this->input->post('plaats'),
                    'Telefoon' => $this->input->post('telefoon'),
                    'mobiel' => $this->input->post('mobiel'),
                    'emailadres' => $this->input->post('user_email'),
                    'Contact_persoon' => $this->input->post('contact_persoon'),
                    'website' => $this->input->post('website')
        );

        $this->db->insert('DataCGebruikersNaw', $inserinfo);

        $UIDinfo = mysql_insert_id();

        if($UIDinfo) {

            $typecheck = $this->input->post('gebr_type');

            if($typecheck == "BWT") {
                $url = 'http://www.bewusttoetsen.nl';
                $toets = 'Bewusttoetsen';
            } ELSE {
                $url = 'http://www.nvmwoontoets.nl';
                $toets = 'de NVMwoontoets';
            }


            $email_to = $this->input->post('user_email');
            $email_naam = $this->input->post('contact_persoon');
            $email_gebruikersnaam = $this->input->post('gebruikersnaam');
            $email_ww = $this->encrypt->decode($encrypted_string);

            $email_bericht = "Beste ".$email_naam.",<br /><br />
                             Hierbij de inloggegevens voor ".$toets.".<br /><br />

                             <b>Gebruikersnaam: ".$email_gebruikersnaam."<br />
                             Wachtwoord: ".$email_ww." (U zult na de eerste keer inloggen gevraagd worden om dit wachtwoord aan te passen.)<br />
                             Login url: ".$url."</b><br /><br />

                             Bij eventuele vragen kunt u contact opnemen met onze helpdesk via helpdesk@datachecker.nl of via het telefoonnummer: 085 401 2655.<br /><br />

                             Met vriendelijke groet,<br /><br />

                             Klantenservice<br />
                             DataChecker";


            $this->load->library('email');

            $this->email->from('support@datachecker.nl', 'DataChecker Support');
            $this->email->reply_to('helpdesk@datachecker.nl', 'Helpdesk DataChecker');
            $this->email->to($email_to);  
            $this->email->bcc('yarno@webrandit.nl'); 

            $this->email->subject('Gebruikers gegevens DataChecker');
            $this->email->message($email_bericht); 

            $this->email->send();

            //FF loggen
            $session_data = $this->session->userdata('logged_in');
            $logarr = array(
                    'BeheerderID' => $session_data['id'],
                    'GebruikersID' => $UID,
                    'TypeActie' => 'mail',
                    'ActieOmschrijving' => 'Gebruikers gegegevens email verstuurd door '.$session_data['naam'],
                    'ActieDatum' => date("y/m/d : H:i:s", time())
            );

             $this->db->insert('DataCLogging', $logarr);


        return $UID;
    } else {
        return false;
    }
    }
    
    function updatembid($mbid,$uid) 
    {
        //Het moneybirdid updaten
        $data = array(
               'mbID' => $mbid
            );

        $this->db->where('UID', $uid);
        $this->db->update('DataCgebruikers', $data); 
        if($this->db->affected_rows()) {
            return true;
        } else {
            return false;
        }
    }

    function gebruikerupdate($userID)
    {
      
    }


    
}