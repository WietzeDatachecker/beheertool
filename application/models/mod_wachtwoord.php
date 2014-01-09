<?php
	class mod_wachtwoord extends CI_Model {


		function resetwachtwoord ()
			{
				
				// encriptie
				$this->load->library('encrypt');
        		$pw = 'DataCheckerGebruiker!';

        		$encrypted_string = $this->encrypt->encode($pw);

        		$updatearr = array(
                	'Wachtwoord' => $encrypted_string
        		);

        		$this->db->where('UID', $this->input->post('ww_userid'));
				$this->db->update('DataCgebruikers', $updatearr);

				if($this->db->affected_rows()) {

        		//Eerst even wat data ophalen
				$qry = $this->db->query('SELECT DataCgebruikers.Gebruikersnaam,DataCGebruikersNaw.emailadres, DataCgebruikers.Type_check  FROM `DataCgebruikers` LEFT OUTER JOIN DataCGebruikersNaw ON DataCgebruikers.UID=DataCGebruikersNaw.GebruikersID WHERE DataCgebruikers.UID ='.$this->input->post('ww_userid'));

				foreach ($qry->result() as $row)
					{	
						$username = $row->Gebruikersnaam;
						$emailuser = $row->emailadres;
						$typecheck = $row->Type_check;

						if($typecheck == "BWT") {
			                $url = 'http://www.bewusttoetsen.nl';
			          
			            } ELSE {
			                $url = 'http://www.nvmwoontoets.nl';
			            }
					}


				$email_to = $emailuser;
	            $email_gebruikersnaam = $username;
	            $email_ww = $this->encrypt->decode($encrypted_string);

	            $email_bericht = "Geachte,<br /><br />
	                             Hierbij uw nieuwe wachtwoord voor het DataChecker systeem.<br /><br />
	                             
	                             Gebruikersnaam: ".$email_gebruikersnaam."<br />
	                             Wachtwoord: ".$email_ww."<br />
	                             Login url: ".$url."<br /><br />

	                             Bij eventuele vragen kunt u contact opnemen met onze helpdesk via helpdesk@datachecker.nl of via het telefoonnummer: 085 401 2655.<br /><br />

	                             DataChecker";


	            $this->load->library('email');

	            $this->email->from('support@datachecker.nl', 'DataChecker Support');
	            $this->email->reply_to('helpdesk@datachecker.nl', 'Helpdesk DataChecker');
	            $this->email->to($email_to);
	            $bcclist = array('yarno@webrandit.nl', 'info@datachecker.nl');
	            $this->email->bcc($bcclist); 

	            $this->email->subject('Nieuw wachtwoord voor het DataChecker systeem');
	            $this->email->message($email_bericht); 

	            $this->email->send();

	            //FF loggen
	            $session_data = $this->session->userdata('logged_in');
	            $logarr = array(
	                    'BeheerderID' => $session_data['id'],
	                    'GebruikersID' => $this->input->post('ww_userid'),
	                    'TypeActie' => 'mail',
	                    'ActieOmschrijving' => 'Nieuw wachtwoord naar de klant verzonden door '.$session_data['naam'],
	                    'ActieDatum' => date("y/m/d : H:i:s", time())
	            );

	             $this->db->insert('DataCLogging', $logarr);
	         }

			}

	}

?>