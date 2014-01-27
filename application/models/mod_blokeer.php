<?php
	class mod_blokeer extends CI_Model {

		function blokeergebruiker() {

			//Even de insertarr vullen
			$insertdata = array(
                    'Ingetrokken' => $this->input->post('Ingetrokken_ingetrokken')
                    
                    
       		 );
            $id=$this->input->post('blokeer_userid');
			$this->db->where('UID', $id);
			$this->db->update('DataCgebruikers', $insertdata);

			//FF loggen

			if($this->db->affected_rows()) {

            $session_data = $this->session->userdata('logged_in');
            $logarr = array(
                    'BeheerderID' => $session_data['id'],
                    'GebruikersID' => $this->input->post('blokeer_userid'),
                    'TypeActie' => 'Blok',
                    'ActieOmschrijving' => 'Geblokeerd door '.$this->input->post('blokeer_naam'),
                    'ActieDatum' => date("y/m/d : H:i:s", time())
            );

             $this->db->insert('DataCLogging', $logarr);

			return true;
		}
	}

function deblokeergebruiker() {

            //Even de insertarr vullen
            $insertdata = array(
                    'Ingetrokken' => $this->input->post('Ingetrokken_ingetrokken')
                    
                    
             );
            $id=$this->input->post('blokeer_userid');
            $this->db->where('UID', $id);
            $this->db->update('DataCgebruikers', $insertdata);

            //FF loggen

            if($this->db->affected_rows()) {

            $session_data = $this->session->userdata('logged_in');
            $logarr = array(
                    'BeheerderID' => $session_data['id'],
                    'GebruikersID' => $this->input->post('blokeer_userid'),
                    'TypeActie' => 'Blok',
                    'ActieOmschrijving' => 'Gedeblokeerd door '.$this->input->post('blokeer_naam'),
                    'ActieDatum' => date("y/m/d : H:i:s", time())
            );

             $this->db->insert('DataCLogging', $logarr);

            return true;
        }
    }


	}

?>