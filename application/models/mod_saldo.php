<?php
	class mod_saldo extends CI_Model {

		function updatesaldo () {

			// Huidge sakdo halen

			$qrysaldo = $this->db->query('SELECT Saldo FROM DataCgebruikers WHERE UID ='.$this->input->post('saldo_userid'));
			foreach ($qrysaldo->result() as $row)
				{	
					$startsaldo = $row->Saldo;
					$Ophogen = $this->input->post('saldo_saldo');
				    $optellen = $startsaldo + $Ophogen;
				}
			//echo "Start saldo is ".$startsaldo."<br />";
			//echo "Ophoog saldo is ".$Ophogen."<br />";
			//echo "Saldo is ".$optellen;

			// in een array stoppen
			$insertdata = array(
                    'Saldo' => $optellen
       		 );

			$this->db->where('UID', $this->input->post('saldo_userid'));
			$this->db->update('DataCgebruikers', $insertdata);

			//FF loggen

			if($this->db->affected_rows()) {

            $session_data = $this->session->userdata('logged_in');
            $logarr = array(
                    'BeheerderID' => $session_data['id'],
                    'GebruikersID' => $this->input->post('saldo_userid'),
                    'TypeActie' => 'Saldo',
                    'ActieOmschrijving' => 'Het saldo is opgehoogd met '.$this->input->post('saldo_saldo').' Op aanvraag van '.$this->input->post('saldo_aanvrager').' door '.$session_data['naam'],
                    'ActieDatum' => date("y/m/d : H:i:s", time())
            );

             $this->db->insert('DataCLogging', $logarr);

             return true;

             }

		}

		function updatesaldowalter () {

			// Huidge sakdo halen

			// in een array stoppen
			$insertdata = array(
                    'Saldo' => $this->input->post('saldo_saldo')
       		 );

			$this->db->where('UID', $this->input->post('saldo_userid'));
			$this->db->update('DataCgebruikers', $insertdata);

			//FF loggen

			if($this->db->affected_rows()) {

            $session_data = $this->session->userdata('logged_in');
            $logarr = array(
                    'BeheerderID' => $session_data['id'],
                    'GebruikersID' => $this->input->post('saldo_userid'),
                    'TypeActie' => 'Saldo',
                    'ActieOmschrijving' => 'Het saldo is aangepast naar de juiste hoeveelheid door '.$session_data['naam'],
                    'ActieDatum' => date("y/m/d : H:i:s", time())
            );

             $this->db->insert('DataCLogging', $logarr);

             return true;

             }

		}



	}

?>