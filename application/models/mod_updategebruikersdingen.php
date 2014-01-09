<?php
/**
* 
*/
class mod_updategebruikersdingen extends CI_Model
{

	function updategegevens ()
	{	
		$updatebedrnaam = array(
				'Bedrijfsnaam' => $this->input->post('bedrijfsnaam')
			);

		//array vullen met NAW dingen
		$updatenaw = array(
				'Adres' => $this->input->post('adres'),
                'Postcode' => $this->input->post('postcode'),
                'Plaats' => $this->input->post('plaats'),
                'Telefoon' => $this->input->post('telefoon'),
                'mobiel' => $this->input->post('mobiel'),
                'emailadres' => $this->input->post('email'),
                'website' => $this->input->post('website'),
                'Contact_persoon' => $this->input->post('contact_persoon')
        	);

        //Updaten van bedrijfsnaam
        $this->db->where('UID', $this->input->post('uid'));
		$this->db->update('DataCgebruikers', $updatebedrnaam);

		//Updaten van NAW
		$this->db->where('GebruikersID', $this->input->post('uid'));
		$this->db->update('DataCGebruikersNaw', $updatenaw);

		//FF loggen

		if($this->db->affected_rows()) {

            $session_data = $this->session->userdata('logged_in');
            $logarr = array(
                    'BeheerderID' => $session_data['id'],
                    'GebruikersID' => $this->input->post('uid'),
                    'TypeActie' => 'Edit',
                    'ActieOmschrijving' => 'De gebruikersgegevens zijn aangepast door '.$session_data['naam'],
                    'ActieDatum' => date("y/m/d : H:i:s", time())
            );

            $this->db->insert('DataCLogging', $logarr);

            return true;

        }

	}

}
?>