<?php
$config = array(
    'clientname' => 'webrandit', // see Moneybird URL: yourclientname.moneybird.nl
    'emailaddress' => 'info@webrandit.nl', // You set this when creating the account
    'password' => 'webrandapi', // The password you set in Moneybird when you confirmed the e-mail address
);

// Create a Transport
$transport = new Moneybird\HttpClient();
$transport->setAuth(
	$config['emailaddress'],
	$config['password']
);
$connector = new Moneybird\ApiConnector(
	$config['clientname'],
	$transport, 
	new Moneybird\XmlMapper() // create a mapper
);
?>