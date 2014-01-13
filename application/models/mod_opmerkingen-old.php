<?php
	class mod_opmerkingen extends CI_Model {

		function insertopmerking() {

			//Even de insertarr vullen
			$insertdata = array(
                    'Gebruiker' => $this->input->post('opmerking_naam'),
                    'GebruikersID' => $this->input->post('opmerking_opmerking'),
                    'Datum' => date("y/m/d : H:i:s", time())
       		 );

			$this->db->where('GebruikersID', $this->input->post('opmerking_userid'));
			$this->db->update('DataCOpmerkingen', $insertdata);

			//FF loggen

			if($this->db->affected_rows()) {

            $session_data = $this->session->userdata('logged_in');
            $logarr = array(
                    'BeheerderID' => $session_data['id'],
                    'GebruikersID' => $this->input->post('opmerking_userid'),
                    'TypeActie' => 'Opmerking',
                    'ActieOmschrijving' => 'Er is een opmerking toegevoegd door '.$this->input->post('opmerking_naam'),
                    'ActieDatum' => date("y/m/d : H:i:s", time())
            );

             $this->db->insert('DataCLogging', $logarr);

			return true;
		}
	}


	}

?>