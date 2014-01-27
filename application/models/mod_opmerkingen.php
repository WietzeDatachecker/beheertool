<?php
	class mod_opmerkingen extends CI_Model {

		function insertopmerking() {

			//Even de insertarr vullen
			$insertdata = array(
                    'Gebruiker' => $this->input->post('opmerking_naam'),
                    'GebruikersID' => $this->input->post('opmerking_userid'),
                    'Opmerking' => $this->input->post('opmerking_opmerking'),
                    'Actie' => $this->input->post('opmerking_actie'),
                    'Datum' => date("y/m/d : H:i:s", time())
       		 );

			//$this->db->where('GebruikersID', $this->input->post('opmerking_userid'));
			$this->db->insert('DataCOpmerkingen', $insertdata);

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


function deleteActie() {

            //Even de insertarr vullen
            $insertdata = array(
                    'Actie' => $this->input->post('Actie_actie')
                    
                    
             );
            $id=$this->input->post('Oid');
            $this->db->where('UID', $id);
            $this->db->update('DataCOpmerkingen', $insertdata);

            //FF loggen

            if($this->db->affected_rows()) {

            $session_data = $this->session->userdata('logged_in');
            $logarr = array(
                    'BeheerderID' => $session_data['id'],
                    'GebruikersID' => $this->input->post('blokeer_userid'),
                    'TypeActie' => 'Actie',
                    'ActieOmschrijving' => 'Geblokeerd door '.$this->input->post('blokeer_naam'),
                    'ActieDatum' => date("y/m/d : H:i:s", time())
            );

             $this->db->insert('DataCLogging', $logarr);

            return true;
        }
    }




	}

?>