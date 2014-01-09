<?php
class mod_moneybird extends CI_Model {



	function getinvoice($mbID)
	{
		require_once(BASEPATH.'libraries/Moneybird/ApiConnector'.EXT);

		$mbapi = new MoneybirdApi('datachecker', 'api@datachecker.nl', 'WebrandApiDataC!');
		//$mbapi = new MoneybirdApi('webrandit', 'yarno.vanoort@webrandit.nl', '1fietser');

		// Get the MoneyBird contact belonging to the customer id
		$contact = $mbapi->getContactByCustomerId($mbID);

		// Retrieve the sent invoices of the contact
		$invoices = $contact->getInvoices('sent');

		return $invoices;

	}

	function maakfactuur($mbID,$aantal,$prijs,$ontvanger)
	{
		require_once(BASEPATH.'libraries/Moneybird/ApiConnector'.EXT);

		$mbapi = new MoneybirdApi('datachecker', 'api@datachecker.nl', 'WebrandApiDataC!');
		//$mbapi = new MoneybirdApi('webrandit', 'yarno.vanoort@webrandit.nl', '1fietser');

		$contactId = $mbID;
		
		$contact = $mbapi->getContactByCustomerId($contactId);

		# Now that we have a contact, we can build and save the invoice
		$invoice = new MoneybirdInvoice;

		# An invoice contains one or more invoice lines
		# If you need more lines, you can just add more elements of $line to the $lines array
		$lines = array();
		$line = new MoneybirdInvoiceLine;
		$line->description  = 'DataChecker saldo opgehoogd';
		$line->amount       = $aantal;            // The number of items or hours you delivered
		$line->price        = $prijs;           // The price per item or per hour (total price is calculated by Moneybird!)
		$line->tax          = 0.21;         // Tax percentage (0.0 if not applicable)
		$lines[] = $line;

		# Add the contact details to the invoice
		$invoice->setContact($contact);

		# Add your invoice lines to the invoice
		$invoice->details = $lines;

		# Save the invoice to Moneybird (as a draft, it's not send yet)
		$savedInvoice = $mbapi->saveInvoice($invoice);

		# Send the invoice via e-mail
		# You don't need to use $sendInfo, if you omit it or set it to `null` Moneybird will use the defaults as a fallback 
		# (i.e. $contact->email as the recipient and your default body message from your Moneybird settings)
		$sendInfo = new MoneybirdInvoiceSendInformation('email', ''.$ontvanger.'', 'Geachte klant, Hierbij uw factuur voor het aanschaffen van '.$aantal.' checks voor DataChecker.');

		# Send It!
		$mbapi->sendInvoice($savedInvoice, $sendInfo);

		return true;

	}

	function maakfactuurNieuwklant($mbID,$aantal,$prijs,$licentie,$ontvanger)
	{
		require_once(BASEPATH.'libraries/Moneybird/ApiConnector'.EXT);

		$mbapi = new MoneybirdApi('datachecker', 'api@datachecker.nl', 'WebrandApiDataC!');
		//$mbapi = new MoneybirdApi('webrandit', 'yarno.vanoort@webrandit.nl', '1fietser');

		$contactId = $mbID;
		$contact = $mbapi->getContactByCustomerId($contactId);

		# Now that we have a contact, we can build and save the invoice
		$invoice = new MoneybirdInvoice;

		# An invoice contains one or more invoice lines
		# If you need more lines, you can just add more elements of $line to the $lines array
		$lines = array();
		$line = new MoneybirdInvoiceLine;
		$line->description  = 'DataChecker saldo';
		$line->amount       = $aantal;            // The number of items or hours you delivered
		$line->price        = $prijs;           // The price per item or per hour (total price is calculated by Moneybird!)
		$line->tax          = 0.21;
		$lines[] = $line;
		if($licentie > 0)  //Als we licentiekosten hebben dan voegen we deze toe
			{	
				$line2 = new MoneybirdInvoiceLine;
				$line2->description  = 'DataChecker licentiekosten';
				$line2->amount       = 1;            // The number of items or hours you delivered
				$line2->price        = $licentie;           // The price per item or per hour (total price is calculated by Moneybird!)
				$line2->tax          = 0.21;
				array_push($lines, $line2);      
			}
		

		
		# Add the contact details to the invoice
		$invoice->setContact($contact);

		# Add your invoice lines to the invoice
		$invoice->details = $lines;

		# Save the invoice to Moneybird (as a draft, it's not send yet)
		$savedInvoice = $mbapi->saveInvoice($invoice);

		# Send the invoice via e-mail
		# You don't need to use $sendInfo, if you omit it or set it to `null` Moneybird will use the defaults as a fallback 
		# (i.e. $contact->email as the recipient and your default body message from your Moneybird settings)
		$sendInfo = new MoneybirdInvoiceSendInformation('email', ''.$ontvanger.'', 'Geachte klant, Hierbij uw factuur voor het aanschaffen van '.$aantal.' checks voor DataChecker.');

		# Send It!
		$mbapi->sendInvoice($savedInvoice, $sendInfo);

		return true;

	}

	function GetContact()
	{
		require_once(BASEPATH.'libraries/Moneybird/ApiConnector'.EXT);

		$mbapi = new MoneybirdApi('datachecker', 'api@datachecker.nl', 'WebrandApiDataC!');
		//$mbapi = new MoneybirdApi('webrandit', 'yarno.vanoort@webrandit.nl', '1fietser');

		// Get the MoneyBird contact belonging to the customer id
		$contacts = $mbapi->getContacts();

		return $contacts;

	}

	function MaakNieuwContact()
	{
		require_once(BASEPATH.'libraries/Moneybird/ApiConnector'.EXT);

		$mbapi = new MoneybirdApi('datachecker', 'api@datachecker.nl', 'WebrandApiDataC!');
		//$mbapi = new MoneybirdApi('webrandit', 'yarno.vanoort@webrandit.nl', '1fietser');

		//Eerst even de velden Vullen
		$newContact = new MoneyBirdContact;
	    $newContact->address1       = $this->input->post('adres');
	    $newContact->zipcode        = $this->input->post('postcode');
	    $newContact->city           = $this->input->post('plaats');
	    $newContact->company_name   = $this->input->post('bedrijfsnaam');      // not required when using first_name && last_name
	    $newContact->country        = 'Nederland';
	    $newContact->customer_id    = '';               						// your own (unique!) customer id, NOT the moneybird id
	    $newContact->email          = $this->input->post('email');
	    $newContact->first_name     = $this->input->post('contact_persoon');      // not required when using company_name
	    $newContact->last_name      = '';                    					// not required when using company_name
	   
	   	//Opslaan die gebruiker
	    $contact = $mbapi->saveContact($newContact);

	    return $contact;

	}

	function MaakNieuwContactsaldoupdate($adres,$postcode,$plaats,$bedrijfsnaam,$email,$naam)
	{
		require_once(BASEPATH.'libraries/Moneybird/ApiConnector'.EXT);

		$mbapi = new MoneybirdApi('datachecker', 'api@datachecker.nl', 'WebrandApiDataC!');
		//$mbapi = new MoneybirdApi('webrandit', 'yarno.vanoort@webrandit.nl', '1fietser');

		//Eerst even de velden Vullen
		$newContact = new MoneyBirdContact;
	    $newContact->address1       = $adres;
	    $newContact->zipcode        = $postcode;
	    $newContact->city           = $plaats;
	    $newContact->company_name   = $bedrijfsnaam;      // not required when using first_name && last_name
	    $newContact->country        = 'Nederland';
	    $newContact->customer_id    = '';               						// your own (unique!) customer id, NOT the moneybird id
	    $newContact->email          = $email;
	    $newContact->first_name     = $naam;      // not required when using company_name
	    $newContact->last_name      = '';                    					// not required when using company_name
	   
	   	//Opslaan die gebruiker
	    $contact = $mbapi->saveContact($newContact);

	    return $contact;

	}
}
?>