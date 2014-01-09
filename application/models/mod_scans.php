<?php
class mod_scans extends CI_Model {

	public function __construct()
	{
		
	}

	public function get_scandetails($guid)
	{

		require_once(BASEPATH.'libraries/nusoap'.EXT);
		$wsdl = 'https://secweb.idchecker.nl/WorldConnector.asmx?wsdl';
		$username = "DatacheckerWG";
		$password = "NewChange632";
		$userID = '2081';
		
		$client = new nusoap_client($wsdl,true);
		$client->setCredentials($username, $password, 'basic', '');
		$client->setDebugLevel(1);

		$xml_id='	<RetrieveDataIdentityCardComplete xmlns="https://secweb.idchecker.nl/">
	     				<UniqueGuid>'.$guid.'</UniqueGuid>
				      	<Clientref></Clientref>
				      	<Userid>'.$userID.'</Userid>
				      	<password>'.$password.'</password>
				    	</RetrieveDataIdentityCardComplete>';

		$result = $client->call('RetrieveDataIdentityCardComplete',$xml_id, 'https://secweb.idchecker.nl/'); 

		if ($client->fault)
		{
			  
			return $result;

		} else {
		            // Check for errors
		   $err=$client->getError();

		    if ($err)
		       {
		        return $result;

		    } else {
				
				return $result;
			}
		}
	}

	public function get_datacheckdata($guid)
	{

		require_once(BASEPATH.'libraries/nusoap'.EXT);
		$wsdl = 'https://secweb.idchecker.nl/WorldConnector.asmx?wsdl';
		$username = "DatacheckerWG";
		$password = "NewChange632";
		$userID = '2081';
		
		$client = new nusoap_client($wsdl,true);
		$client->setCredentials($username, $password, 'basic', '');
		$client->setDebugLevel(1);
		
		$xml_datacheck='<GetDataCheckDataNewBETA xmlns="https://secweb.idchecker.nl/">
		     				<UniqueGuid>'.$guid.'</UniqueGuid>
					      	<Clientref></Clientref>
					      	<Userid>'.$userID.'</Userid>
					      	<password>'.$password.'</password>
				    	</GetDataCheckDataNewBETA>';

		$result_data = $client->call('GetDataCheckDataNewBETA',$xml_datacheck, 'https://secweb.idchecker.nl/'); 

		if ($client->fault)
		{
			  
			return $result_data;

		} else {
		            // Check for errors
		   $err=$client->getError();

		    if ($err)
		       {
		        return $result_data;

		    } else {
				
				return $result_data;
			}
		}
	}

	public function getresultdescrip($resid)
	{
		$this->db-> select('NL');
		$this->db-> from('DataCDataResultaatCodes');
		$this->db->where('FocumCode', $resid);

		$qrycode = $this->db->get();

			foreach ($qrycode->result() as $row)
				{
					$resultdescrip = $row->NL;

					return $resultdescrip;

				}

	}
}